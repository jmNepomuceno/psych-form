const test = (i) => {
    console.log(i);

    // ====== PATIENT INFO ======
    $('input[name="patient_name"]').val('Juan D. Reyes ' + i);
    $('input[name="age_sex"]').val('25/M');
    $('input[name="exam_date"]').val('2026-01-28');

    // ====== FTND QUESTIONS ======
    const ftndAnswers = [3,0,1,1,1,1]; // corresponds to q1-q6
    ftndAnswers.forEach((val, idx) => {
        $(`input[name="q${idx + 1}"][value="${val}"]`).prop('checked', true);
    });

    // ====== TOTAL SCORE ======
    let total = 0;
    $('input[type=radio]:checked').each(function() {
        const val = parseInt($(this).val());
        if (!isNaN(val)) total += val;
    });
    $('#totalScore').val(total);

    console.log('Sample FTND form populated with total score:', $('#totalScore').val());
};

function getFTNDSeverity(score) {
    if (score <= 2) return 'Very Low';
    if (score <= 4) return 'Low';
    if (score === 5) return 'Moderate';
    if (score <= 7) return 'High';
    return 'Very High';
}


$(document).ready(function() {


    // Parse id parameter from URL
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');

    if (id) {
        $.get('../assets/php/get_ftnd.php', { id: id }, function (data) {
            console.log("data:", data);
            if (!data) return;

            // ===== PATIENT INFO =====
            $('input[name="patient_name"]').val(data.patient_name);
            $('input[name="age_sex"]').val(data.age_sex);
            $('input[name="exam_date"]').val(data.exam_date);

            // ===== GENERIC POPULATOR =====
            Object.keys(data).forEach(key => {

                // text / number inputs
                const input = $(`input[name="${key}"]`);
                if (input.length && input.attr('type') !== 'radio') {
                    input.val(data[key]);
                }

                // radios
                $(`input[type="radio"][name="${key}"][value="${data[key]}"]`)
                    .prop('checked', true);
            });

            // ===== TOTAL SCORE =====
            $('#totalScore').val(data.total_score); // adjust selector if needed

            // ===== READ-ONLY VIEW MODE =====
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

        // Loop through all 9 questions
        for (let i = 1; i <= 10; i++) {
            let selected = $('input[name="q' + i + '"]:checked');

            if (selected.length) {
                let val = parseInt(selected.val());

                totalScore += val;
                columnTotals[val] += val; // keeps track of column totals
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

    // 1️⃣ Update total score dynamically on radio click
    $('input[type=radio]').on('click', function() {
        let total = 0;
        $('input[type=radio]:checked').each(function() {
            const val = parseInt($(this).val());
            if (!isNaN(val)) total += val;
        });
        $('#totalScore').val(total);
    });

    // 2️⃣ Submit form via AJAX
    // $('#submitForm').on('click', function() {
    //     const formData = {
    //         patient_name: $('input[name="patient_name"]').val(),
    //         age_sex: $('input[name="age_sex"]').val(),
    //         exam_date: $('input[name="exam_date"]').val(),
    //         total_score: $('#totalScore').val()
    //     };

    //     // Add question answers
    //     for (let i = 1; i <= 6; i++) {
    //         formData['q' + i] = $('input[name="q' + i + '"]:checked').val() || '';
    //     }

    //     console.log(formData)
    //     // AJAX request
    //     $.ajax({
    //         url: '../assets/php/save_ftnd.php', // PHP script to handle saving
    //         method: 'POST',
    //         data: formData,
    //         success: function(response) {
    //             $('input').val('').prop('checked', false);
    //             $('#totalScore').val('');

    //             window.location.href = 'http://192.168.42.15:8035/';
    //         },
    //         error: function(xhr, status, error) {
    //             console.error('Error:', error);
    //             alert('Failed to submit form.');
    //         }
    //     });
    // });

    // $('#submitForm').on('click', function () {

    //     let totalScore = parseInt($('#totalScore').val() || 0);
    //     let severity = getFTNDSeverity(totalScore);

    //     // Highlight row
    //     $('.severity-table tbody tr').removeClass('active').each(function () {
    //         let min = $(this).data('min');
    //         let max = $(this).data('max');

    //         if (totalScore >= min && totalScore <= max) {
    //             $(this).addClass('active');
    //         }
    //     });

    //     $('#ftndResultScore').text(totalScore);
    //     $('#ftndResultSeverity')
    //         .removeClass()
    //         .addClass('severity-badge severity-' + severity.replace(' ', ''))
    //         .text(severity);

    //     // Consent logic (High / Very High)
    //     if (severity === 'High' || severity === 'Very High') {
    //         $('#ftndConsentSection').show();
    //         $('#ftndContactSection').hide();
    //         $('#ftndConfirmSubmit').prop('disabled', true);
    //         $('input[name="ftndConsentChoice"]').prop('checked', false);
    //         $('#ftndContactNumber').val('');
    //     } else {
    //         $('#ftndConsentSection').hide();
    //         $('#ftndContactSection').hide();
    //         $('#ftndConfirmSubmit').prop('disabled', false);
    //     }

    //     $('#ftndResultModal').fadeIn();
    // });

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
        // FTND Questions Validation (q1–q6)
        // ===============================
        for (let i = 1; i <= 6; i++) {
            if (!$('input[name="q' + i + '"]:checked').length) {
                isValid = false;
                missingFields.push('Question ' + i);
            }
        }

        // ===============================
        // Stop if any field is missing
        // ===============================
        if (!isValid) {

            const message = `
                Please complete all required fields before proceeding.<br><br>
                <strong>Missing:</strong><br>
                • ${missingFields.join('<br>• ')}
            `;

            showNotificationModal(
                'Incomplete Form',
                message,
                'warning'
            );

            return; // 🚫 block submission
        }

        // ===============================
        // Compute score ONLY if valid
        // ===============================
        let totalScore = parseInt($('#totalScore').val() || 0);
        let severity = getFTNDSeverity(totalScore);

        // Highlight row
        $('.severity-table tbody tr').removeClass('active').each(function () {
            let min = $(this).data('min');
            let max = $(this).data('max');

            if (totalScore >= min && totalScore <= max) {
                $(this).addClass('active');
            }
        });

        $('#ftndResultScore').text(totalScore);
        $('#ftndResultSeverity')
            .removeClass()
            .addClass('severity-badge severity-' + severity.replace(/\s/g, ''))
            .text(severity);

        // Consent logic (High / Very High)
        if (severity === 'High' || severity === 'Very High') {
            $('#ftndConsentSection').show();
            $('#ftndContactSection').hide();
            $('#ftndContactSectionEmer').hide();
            $('#ftndConfirmSubmit').prop('disabled', true);
            $('input[name="ftndConsentChoice"]').prop('checked', false);
            $('#ftndContactNumber').val('');
        } else {
            $('#ftndConsentSection').hide();
            $('#ftndContactSection').hide();
            $('#ftndContactSectionEmer').hide();
            $('#ftndConfirmSubmit').prop('disabled', false);
        }

        $('#ftndResultModal').fadeIn();
    });


    $('input[name="ftndConsentChoice"]').on('change', function () {
        $('#ftndConfirmSubmit').prop('disabled', false);

        if (this.value === 'agree') {
            $('#ftndContactSectionEmer').slideDown();
            $('#ftndContactSection').slideDown();
        } else {
            $('#ftndContactSectionEmer').slideUp();
            $('#ftndContactSection').slideUp();
            $('#ftndContactNumber').val('');
            $('#ftndContactNumberEmer').val('');
        }
    });

    $('#ftndConfirmSubmit').on('click', function () {
        let formData = {};

        formData.patient_name = $('input[name="patient_name"]').val();
        formData.age_sex = $('input[name="age_sex"]').val();
        formData.exam_date = $('input[name="exam_date"]').val();

        for (let i = 1; i <= 6; i++) {
            formData['q' + i] = $('input[name="q' + i + '"]:checked').val() || 0;
        }

        formData.total_score = $('#ftndResultScore').text();
        formData.severity = $('#ftndResultSeverity').text();
        formData.contact_number = $('#ftndContactNumber').val() || null;
        formData.contact_number_emer = $('#ftndContactNumberEmer').val() || null;

        $.ajax({
            url: '../assets/php/save_ftnd.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function () {
                $('#ftndResultModal').fadeOut();
                $('input').val('').prop('checked', false);
                $('#totalScore').val('');

                $('.modal-ok-btn').text("Return")
                showNotificationModal(
                    'Successfuly Submitted',
                    "",
                    'success'
                );

                // window.location.href = 'http://192.168.42.15:8035/public/home.php';
            }
        });
    });

});
