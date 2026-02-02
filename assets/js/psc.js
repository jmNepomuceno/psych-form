// ===========================
// TEST FUNCTION: auto-fill PSS
// ===========================
const test = (i) => {
    console.log('Test run:', i);

    // ====== PATIENT INFO ======
    $('input[name="patient_name"]').val('Juan D. Reyes ' + i);
    $('input[name="age_sex"]').val('25/M');
    $('input[name="exam_date"]').val('2026-01-28');

    // ====== PSS-10 QUESTIONS ======
    // Random sample answers 0-4 for testing
    const pssAnswers = [3,2,1,0,1,2,1,0,3,2];

    pssAnswers.forEach((val, idx) => {
        $(`input[name="q${idx + 1}"][value="${val}"]`).prop('checked', true);
    });

    // ====== TOTAL SCORE ======
    const total = calculatePSSScore();
    $('#totalScore').val(total);

    console.log('Sample PSS form populated with total score:', total);
};

// ===========================
// SCORE CALCULATION FUNCTION
// ===========================
function calculatePSSScore() {
    let total = 0;

    // Reverse scored items: 4,5,7,8
    const reverseItems = [4,5,7,8];

    $('input[type=radio]:checked').each(function() {
        const name = $(this).attr('name');
        let val = parseInt($(this).val());

        if (reverseItems.includes(parseInt(name.replace('q','')))) {
            val = 4 - val; // reverse scoring
        }

        if (!isNaN(val)) total += val;
    });

    return total;
}

// ===========================
// SEVERITY FUNCTION
// ===========================
function getPSSSeverity(score) {
    if (score <= 13) return 'Low Stress';
    if (score <= 26) return 'Moderate Stress';
    return 'High Stress';
}

$(document).ready(function() {
    // Update total dynamically on radio click
    $('input[type=radio]').on('click', function() {
        const total = calculatePSSScore();
        $('#totalScore').val(total);
    });

    // Submit form
    $('#submitForm').on('click', function () {
        const totalScore = calculatePSSScore();
        const severity = getPSSSeverity(totalScore);

        // Highlight severity row in table
        $('.severity-table tbody tr').removeClass('active').each(function () {
            const min = parseInt($(this).data('min'));
            const max = parseInt($(this).data('max'));
            if (totalScore >= min && totalScore <= max) {
                $(this).addClass('active');
            }
        });

        // Update result in modal
        $('#pssResultScore').text(totalScore);
        $('#pssResultSeverity')
            .removeClass()
            .addClass('severity-badge severity-' + severity.replace(' ', ''))
            .text(severity);

        // Consent logic (High Stress only)
        if (severity === 'High Stress') {
            $('#pssConsentSection').show();       // show consent section
            $('#pssContactSection').hide();       // hide contact input initially
            $('#pssConfirmSubmit').prop('disabled', true); // disable confirm until user selects
            $('input[name="pssConsentChoice"]').prop('checked', false); // reset radios
            $('#pssContactNumber').val('');       // clear contact field
        } else {
            $('#pssConsentSection').hide();
            $('#pssContactSection').hide();
            $('#pssConfirmSubmit').prop('disabled', false); // enable confirm immediately
        }

        // Show modal
        $('#pssResultModal').fadeIn();
    });

    $('input[name="pssConsentChoice"]').on('change', function () {
        $('#pssConfirmSubmit').prop('disabled', false);

        if (this.value === 'agree') {
            $('#pssContactSection').slideDown();
        } else {
            $('#pssContactSection').slideUp();
            $('#pssContactNumber').val('');
        }
    });


    // Confirm submit
    $('#pssConfirmSubmit').on('click', function () {
        let formData = {};

        formData.patient_name = $('input[name="patient_name"]').val();
        formData.age_sex = $('input[name="age_sex"]').val();
        formData.exam_date = $('input[name="exam_date"]').val();

        for (let i = 1; i <= 10; i++) {
            formData['q' + i] = $('input[name="q' + i + '"]:checked').val() || 0;
        }
        
        formData.total_score = $('#pssResultScore').text();
        formData.severity = $('#pssResultSeverity').text();
        formData.contact_number = $('#pssContactNumber').val() || null;


        console.log(formData)

        $.ajax({
            url: '../assets/php/save_pss.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function () {
                $('#pssResultModal').fadeOut();
                $('input').val('').prop('checked', false);
                $('#totalScore').val('');

                // Redirect to dashboard
                window.location.href = 'http://192.168.42.15:8035/';
            }
        });
    });
});
