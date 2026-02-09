

const populate_sample_gad7 = (i) => {
    console.log(i)
    // ====== PATIENT INFO ======
    $('input[name="patient_name"]').val('Juan D. Reyes ' + i);
    $('input[name="age_sex"]').val('25/M');
    $('input[name="exam_date"]').val('2026-01-28');

    // ====== GAD-7 QUESTIONS ======
    // Sample answers (randomized 0-3 for demo)
    const gad7Answers = [3, 2, 0, 3, 3, 2, 3]; // corresponds to q1-q7
    gad7Answers.forEach((val, idx) => {
        $(`input[name="q${idx + 1}"][value="${val}"]`).prop('checked', true).trigger('change');
    });

    // ====== FUNCTIONAL DIFFICULTY ======
    $('input[name="difficulty"][value="1"]').prop('checked', true); // Somewhat difficult

    // ====== TOTAL SCORE (optional calculation trigger) ======
    if($('#totalScore').length) {
        $('input[type="radio"]').first().trigger('change'); // trigger recalculation
    }

    console.log('Sample GAD-7 form populated!');
};

function getGADSeverity(score) {
    if (score >= 0 && score <= 4) return 'Minimal';
    if (score >= 5 && score <= 9) return 'Mild';
    if (score >= 10 && score <= 14) return 'Moderate';
    if (score >= 15 && score <= 21) return 'Severe';
    return 'Unknown';
}

$(document).ready(function () {

    // Parse id parameter from URL
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    console.log('GAD-7 ID:', id);

    if (id) {
        // fetch data and populate
        $.get('../assets/php/get_gad7.php', { id: id }, function (data) {
            console.log('GAD-7 Data:', data);
            if (!data) return;

            // ===== PATIENT INFO =====
            $('input[name="patient_name"]').val(data.patient_name);
            $('input[name="age_sex"]').val(data.age_sex);
            $('input[name="exam_date"]').val(data.exam_date);

            // ===== QUESTIONS =====
            for (let i = 1; i <= 7; i++) {
                $(`input[name="q${i}"][value="${data['q' + i]}"]`).prop('checked', true);
            }

            // ===== FUNCTIONAL DIFFICULTY =====
            $(`input[name="difficulty"][value="${data.difficulty}"]`).prop('checked', true);

            // ===== SIGNATURE =====
            $('input[name="physician"]').val(data.physician);
            $('input[name="license_no"]').val(data.license_no);
            $('input[name="physician_date"]').val(data.physician_date);

            // ===== SCORE =====
            $('#totalScore').val(data.total_score);

            // ===== READ-ONLY =====
            $('input').prop('disabled', true);
            $('#submitForm').hide();
        }, 'json');
    }

    $('input[type="radio"]').on('change', function () {
        let totalScore = 0;

        // Column score totals (actual score, not count)
        let columnTotals = {
            0: 0,
            1: 0,
            2: 0,
            3: 0
        };

        // Loop through all 7 questions
        for (let i = 1; i <= 7; i++) {
            let selected = $('input[name="q' + i + '"]:checked');

            if (selected.length) {
                let val = parseInt(selected.val());

                totalScore += val;
                columnTotals[val] += val; // 🔥 key fix
            }
        }

        // Update TOTAL SCORE
        $('#totalScore').val(totalScore);

        // Update COLUMN score section
        $('.score-input').each(function () {
            let score = $(this).data('score');
            $(this).text(columnTotals[score] || 0);
        });
    });

    // User agrees to provide contact number
    $('#agreeContact').on('click', function () {
        $('#contactInputBox').slideDown();
    });

    // User declines
    $('#declineContact').on('click', function () {
        $('#contactInputBox').hide();
        $('#contactNumber').val('');
    });


    // $('#submitForm').on('click', function () {

    //     let totalScore = parseInt($('#totalScore').val() || 0);
    //     let severity = getGADSeverity(totalScore);

    //     // ===== Highlight severity row =====
    //     $('.severity-table tbody tr').removeClass('active').each(function () {
    //         let min = $(this).data('min');
    //         let max = $(this).data('max');

    //         if (totalScore >= min && totalScore <= max) {
    //             $(this).addClass('active');
    //         }
    //     });

    //     // ===== Result values =====
    //     $('#resultScore').text(totalScore);
    //     $('#resultSeverity')
    //         .removeClass()
    //         .addClass('severity-badge severity-' + severity)
    //         .text(severity);

    //     // ===== Consent logic =====
    //     if (severity === 'Moderate' || severity === 'Severe') {
    //         $('#consentSection').show();
    //         $('#contactSection').hide();
    //         $('#confirmSubmit').prop('disabled', true);
    //         $('input[name="consentChoice"]').prop('checked', false);
    //         $('#contactNumber').val('');
    //     } else {
    //         $('#consentSection').hide();
    //         $('#contactSection').hide();
    //         $('#confirmSubmit').prop('disabled', false);
    //     }

    //     $('#resultModal').fadeIn();
    // });


    // ===== Consent choice handler =====
    

    $('#submitForm').on('click', function () {

        let isValid = true;
        let missingFields = [];

        // ===============================
        // Patient Info Validation
        // ===============================
        const patientName = $('input[name="patient_name"]').val().trim();
        const ageSex = $('input[name="age_sex"]').val().trim();
        const examDate = $('input[name="exam_date"]').val();

        if (!patientName) {
            isValid = false;
            missingFields.push('Patient Name');
        }

        if (!ageSex) {
            isValid = false;
            missingFields.push('Age / Sex');
        }

        if (!examDate) {
            isValid = false;
            missingFields.push('Examination Date');
        }

        // ===============================
        // GAD-7 Questions Validation (q1–q7)
        // ===============================
        for (let i = 1; i <= 7; i++) {
            if (!$('input[name="q' + i + '"]:checked').length) {
                isValid = false;
                missingFields.push('Question ' + i);
            }
        }

        // ===============================
        // Stop if invalid
        // ===============================
        if (!isValid) {
            alert(
                'Please complete all required fields before proceeding.\n\nMissing:\n- ' +
                missingFields.join('\n- ')
            );
            return; // 🚫 block modal
        }

        // ===============================
        // Compute score ONLY if valid
        // ===============================
        let totalScore = parseInt($('#totalScore').val() || 0);
        let severity = getGADSeverity(totalScore);

        // ===== Highlight severity row =====
        $('.severity-table tbody tr').removeClass('active').each(function () {
            let min = $(this).data('min');
            let max = $(this).data('max');

            if (totalScore >= min && totalScore <= max) {
                $(this).addClass('active');
            }
        });

        // ===== Result values =====
        $('#resultScore').text(totalScore);
        $('#resultSeverity')
            .removeClass()
            .addClass('severity-badge severity-' + severity)
            .text(severity);

        // ===== Consent logic =====
        if (severity === 'Moderate' || severity === 'Severe') {
            $('#consentSection').show();
            $('#contactSection').hide();
            $('#confirmSubmit').prop('disabled', true);
            $('input[name="consentChoice"]').prop('checked', false);
            $('#contactNumber').val('');
        } else {
            $('#consentSection').hide();
            $('#contactSection').hide();
            $('#confirmSubmit').prop('disabled', false);
        }

        $('#resultModal').fadeIn();
    });


    
    
    $('input[name="consentChoice"]').on('change', function () {

        $('#confirmSubmit').prop('disabled', false);

        if (this.value === 'agree') {
            $('#contactSection').slideDown();
        } else {
            $('#contactSection').slideUp();
            $('#contactNumber').val('');
        }
    });


    // ===== Final submit =====
    $('#confirmSubmit').on('click', function () {

        let formData = {};

        formData.patient_name = $('input[name="patient_name"]').val();
        formData.age_sex = $('input[name="age_sex"]').val();
        formData.exam_date = $('input[name="exam_date"]').val();

        for (let i = 1; i <= 7; i++) {
            formData['q' + i] = $('input[name="q' + i + '"]:checked').val() || 0;
        }

        formData.difficulty = $('input[name="difficulty"]:checked').val() || 0;

        formData.total_score = $('#resultScore').text();
        formData.severity = $('#resultSeverity').text();
        formData.contact_number = $('#contactNumber').val() || null;

        $.ajax({
            url: '../assets/php/save_gad7.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function () {
                $('#resultModal').fadeOut();
                $('input').val('').prop('checked', false);
                $('#totalScore').val('');

                window.location.href = 'http://192.168.42.15:8035/public/home.php';
            }
        });
    });


});
