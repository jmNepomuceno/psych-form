// ===========================
// TEST FUNCTION: auto-fill AUDIT
// ===========================
const test = (i) => {
    console.log('Test run:', i);

    // ====== PATIENT INFO ======
    $('input[name="patient_name"]').val('Juan D. Reyes ' + i);
    $('input[name="age_sex"]').val('25/M');
    $('input[name="exam_date"]').val('2026-01-28');

    // ====== AUDIT QUESTIONS ======
    // Random sample answers 0-4 for testing
    const auditAnswers = [1, 2, 0, 1, 2, 1, 0, 3, 1, 2];

    auditAnswers.forEach((val, idx) => {
        $(`input[name="q${idx + 1}"][value="${val}"]`).prop('checked', true);
    });

    // ====== TOTAL SCORE ======
    const total = calculateAUDITScore();
    $('#totalScore').val(total);

    console.log('Sample AUDIT form populated with total score:', total);
};

// ===========================
// SCORE CALCULATION FUNCTION
// ===========================
function calculateAUDITScore() {
    let total = 0;

    $('input[type=radio]:checked').each(function() {
        const val = parseInt($(this).val());
        if (!isNaN(val)) total += val;
    });

    return total;
}

// ===========================
// RISK LEVEL FUNCTION
// ===========================
function getAUDITSeverity(score) {
    if (score <= 7) return 'Low Risk';
    if (score <= 15) return 'Moderate Risk';
    if (score <= 19) return 'High Risk';
    return 'Possible Dependence';
}

$(document).ready(function() {

    // Parse id parameter from URL
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    if (id) {
        // fetch data and populate
        $.get('../assets/php/get_aas.php', { id: id }, function (data) {
            console.log("data:" , data)
            if (!data) return;

            // ===== PATIENT INFO =====
            $('input[name="patient_name"]').val(data.patient_name);
            $('input[name="age_sex"]').val(data.age_sex);
            $('input[name="exam_date"]').val(data.exam_date);

            // ===== QUESTIONS =====
            for (let i = 1; i <= 9; i++) {
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


    // Update total dynamically on radio click
    $('input[type=radio]').on('click', function() {
        const total = calculateAUDITScore();
        $('#totalScore').val(total);
    });

    // Submit form
    // $('#submitForm').on('click', function () {
    //     const totalScore = calculateAUDITScore();
    //     const severity = getAUDITSeverity(totalScore);

    //     // Highlight severity row in table
    //     $('.severity-table tbody tr').removeClass('active').each(function () {
    //         const min = parseInt($(this).data('min'));
    //         const max = parseInt($(this).data('max'));
    //         if (totalScore >= min && totalScore <= max) {
    //             $(this).addClass('active');
    //         }
    //     });

    //     // Update result in modal
    //     $('#auditResultScore').text(totalScore);
    //     $('#auditResultSeverity')
    //         .removeClass()
    //         .addClass('severity-badge severity-' + severity.replace(/ /g, ''))
    //         .text(severity);

    //     // Consent logic (Moderate Risk & above)
    //     if (['Moderate Risk', 'High Risk', 'Possible Dependence'].includes(severity)) {
    //         $('#auditConsentSection').show();
    //         $('#auditContactSection').hide();
    //         $('#auditConfirmSubmit').prop('disabled', true);
    //         $('input[name="auditConsentChoice"]').prop('checked', false);
    //         $('#auditContactNumber').val('');
    //     } else {
    //         $('#auditConsentSection').hide();
    //         $('#auditContactSection').hide();
    //         $('#auditConfirmSubmit').prop('disabled', false);
    //     }

    //     // Show modal
    //     $('#auditResultModal').fadeIn();
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
        // AUDIT Questions Validation (q1–q10)
        // ===============================
        for (let i = 1; i <= 10; i++) {
            if (!$('input[name="q' + i + '"]:checked').length) {
                isValid = false;
                missingFields.push('Question ' + i);
            }
        }

        // ===============================
        // Stop submission if invalid
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
        const totalScore = calculateAUDITScore();
        const severity = getAUDITSeverity(totalScore);

        // Highlight severity row
        $('.severity-table tbody tr').removeClass('active').each(function () {
            const min = parseInt($(this).data('min'));
            const max = parseInt($(this).data('max'));

            if (totalScore >= min && totalScore <= max) {
                $(this).addClass('active');
            }
        });

        // Update result in modal
        $('#auditResultScore').text(totalScore);
        $('#auditResultSeverity')
            .removeClass()
            .addClass('severity-badge severity-' + severity.replace(/ /g, ''))
            .text(severity);

        // Consent logic (Moderate Risk & above)
        if (['Moderate Risk', 'High Risk', 'Possible Dependence'].includes(severity)) {
            $('#auditConsentSection').show();
            $('#auditContactSection').hide();
            $('#auditContactSectionEmer').hide();
            $('#auditConfirmSubmit').prop('disabled', true);
            $('input[name="auditConsentChoice"]').prop('checked', false);
            $('#auditContactNumber').val('');
        } else {
            $('#auditConsentSection').hide();
            $('#auditContactSectionEmer').hide();
            $('#auditContactSection').hide();
            $('#auditConfirmSubmit').prop('disabled', false);
        }

        // Show modal
        $('#auditResultModal').fadeIn();
    });


    // Consent choice
    $('input[name="auditConsentChoice"]').on('change', function () {
        $('#auditConfirmSubmit').prop('disabled', false);

        if (this.value === 'agree') {
            $('#auditContactSection').slideDown();
            $('#auditContactSectionEmer').slideDown();
        } else {
            $('#auditContactSection').slideUp();
            $('#auditContactSectionEmer').slideUp();
            $('#auditContactNumberEmer').val('');
        }
    });

    // Confirm submit
    $('#auditConfirmSubmit').on('click', function () {
        let formData = {};

        formData.patient_name = $('input[name="patient_name"]').val();
        formData.age_sex = $('input[name="age_sex"]').val();
        formData.exam_date = $('input[name="exam_date"]').val();

        for (let i = 1; i <= 10; i++) {
            formData['q' + i] = $('input[name="q' + i + '"]:checked').val() || 0;
        }

        formData.total_score = $('#auditResultScore').text();
        formData.severity = $('#auditResultSeverity').text();
        formData.contact_number = $('#auditContactNumber').val() || null;
        formData.contact_number_emer = $('#auditContactNumberEmer').val() || null;

        console.log(formData);

        $.ajax({
            url: '../assets/php/save_audit.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function () {
                $('#auditResultModal').fadeOut();
                $('input').val('').prop('checked', false);
                $('#totalScore').val('');

                $('.modal-ok-btn').text("Return")
                showNotificationModal(
                    'Successfuly Submitted',
                    "",
                    'success'
                );
                // Redirect to dashboard
                // window.location.href = 'http://192.168.42.15:8035/public/home.php';
            }
        });
    });
});
