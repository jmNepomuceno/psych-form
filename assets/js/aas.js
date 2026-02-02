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
    // Update total dynamically on radio click
    $('input[type=radio]').on('click', function() {
        const total = calculateAUDITScore();
        $('#totalScore').val(total);
    });

    // Submit form
    $('#submitForm').on('click', function () {
        const totalScore = calculateAUDITScore();
        const severity = getAUDITSeverity(totalScore);

        // Highlight severity row in table
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
            $('#auditConfirmSubmit').prop('disabled', true);
            $('input[name="auditConsentChoice"]').prop('checked', false);
            $('#auditContactNumber').val('');
        } else {
            $('#auditConsentSection').hide();
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
        } else {
            $('#auditContactSection').slideUp();
            $('#auditContactNumber').val('');
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

                // Redirect to dashboard
                window.location.href = 'http://192.168.42.15:8035/';
            }
        });
    });
});
