// ===========================
// TEST FUNCTION: auto-fill PAR-Q+
// ===========================
const test = () => {
    console.log('PAR-Q+ Test run: single patient');

    // ====== PATIENT INFO ======
    $('input[name="patient_name"]').val('Juan D. Reyes');
    $('input[name="age_sex"]').val('34/M');
    $('input[name="exam_date"]').val('2026-01-28');

    // ====== MAIN QUESTIONS (1–7) ======
    // Realistic answers
    $('input[name="q1"][value="no"]').prop('checked', true);
    $('input[name="q2"][value="no"]').prop('checked', true);
    $('input[name="q3"][value="yes"]').prop('checked', true);

    $('input[name="q4"][value="yes"]').prop('checked', true);
    $('input[name="q4_condition"]').val('Bronchial Asthma');

    $('input[name="q5"][value="yes"]').prop('checked', true);
    $('input[name="q5_medications"]').val('Salbutamol inhaler, as needed');

    $('input[name="q6"][value="yes"]').prop('checked', true);
    $('input[name="q6_condition"]').val('Lower back pain (muscle strain)');

    $('input[name="q7"][value="no"]').prop('checked', true);

    // ====== MAIN QUESTIONS (1–10) ======
    // Mostly NO, with a couple of realistic YES answers
    const mainAnswers = {
        q1: 'no',
        q2: 'no',
        q3: 'yes',  // e.g. chest discomfort during activity
        q4: 'no',
        q5: 'no',
        q6: 'yes',  // e.g. dizziness / fainting history
        q7: 'no',
        q8: 'no',
        q9: 'no',
        q10: 'no'
    };

    Object.keys(mainAnswers).forEach(q => {
        $(`input[name="${q}_"][value="${mainAnswers[q]}"]`)
            .prop('checked', true);
    });

    // ====== FOLLOW-UP QUESTIONS ======

    // Q1 – all NO since main is NO
    ['q1a','q1b','q1c'].forEach(q =>
        $(`input[name="${q}"][value="no"]`).prop('checked', true)
    );

    // Q2 – all NO
    ['q2a','q2b'].forEach(q =>
        $(`input[name="${q}"][value="no"]`).prop('checked', true)
    );

    // Q3 – main is YES → one relevant YES
    $('input[name="q3a"][value="yes"]').prop('checked', true);
    ['q3b','q3c','q3d'].forEach(q =>
        $(`input[name="${q}"][value="no"]`).prop('checked', true)
    );

    // Q4 – all NO
    ['q4a','q4b'].forEach(q =>
        $(`input[name="${q}"][value="no"]`).prop('checked', true)
    );

    // Q5 – all NO
    ['q5a','q5b','q5c','q5d','q5e'].forEach(q =>
        $(`input[name="${q}"][value="no"]`).prop('checked', true)
    );

    // Q6 – main is YES → one realistic follow-up YES
    $('input[name="q6a"][value="yes"]').prop('checked', true);
    $('input[name="q6b"][value="no"]').prop('checked', true);

    // Q7 – all NO
    ['q7a','q7b','q7c','q7d'].forEach(q =>
        $(`input[name="${q}"][value="no"]`).prop('checked', true)
    );

    // Q8 – all NO
    ['q8a','q8b','q8c'].forEach(q =>
        $(`input[name="${q}"][value="no"]`).prop('checked', true)
    );

    // Q9 – all NO
    ['q9a','q9b','q9c'].forEach(q =>
        $(`input[name="${q}"][value="no"]`).prop('checked', true)
    );

    // Q10 – all NO
    ['q10a','q10b','q10c'].forEach(q =>
        $(`input[name="${q}"][value="no"]`).prop('checked', true)
    );

    console.log('✅ Single realistic PAR-Q+ example populated');
};



// ===========================
// CHECK CLEARANCE FUNCTION
// ===========================
function getPARQResult() {
    let needsClearance = false;

    // Check ALL radio inputs
    $('input[type=radio]:checked').each(function () {
        if ($(this).val() === 'yes') {
            needsClearance = true;
            return false; // stop loop early
        }
    });

    return needsClearance
        ? 'Medical Clearance Required'
        : 'Cleared for Physical Activity';
}

$(document).ready(function () {

    // ===========================
    // SUBMIT FORM
    // ===========================
    $('#submitForm').on('click', function () {

        const result = getPARQResult();

        // Update modal text
        $('#parqResultStatus')
            .removeClass()
            .addClass(
                result === 'Cleared for Physical Activity'
                    ? 'result-cleared'
                    : 'result-clearance'
            )
            .text(result);

        // Consent logic (only if clearance required)
        if (result === 'Medical Clearance Required') {
            $('#parqConsentSection').show();
            $('#parqContactSection').hide();
            $('#parqConfirmSubmit').prop('disabled', true);
            $('input[name="parqConsentChoice"]').prop('checked', false);
            $('#parqContactNumber').val('');
        } else {
            $('#parqConsentSection').hide();
            $('#parqContactSection').hide();
            $('#parqConfirmSubmit').prop('disabled', false);
        }

        $('#parqResultModal').fadeIn();
    });

    // ===========================
    // CONSENT CHOICE
    // ===========================
    $('input[name="parqConsentChoice"]').on('change', function () {
        $('#parqConfirmSubmit').prop('disabled', false);

        if (this.value === 'agree') {
            $('#parqContactSection').slideDown();
        } else {
            $('#parqContactSection').slideUp();
            $('#parqContactNumber').val('');
        }
    });

    // ===========================
    // CONFIRM & SAVE
    // ===========================
    $('#parqConfirmSubmit').on('click', function () {

        let formData = {};

        // Patient info
        formData.patient_name = $('input[name="patient_name"]').val();
        formData.age_sex = $('input[name="age_sex"]').val();
        formData.exam_date = $('input[name="exam_date"]').val();

        // All radio values
        $('input[type=radio]:checked').each(function () {
            formData[$(this).attr('name')] = $(this).val();
        });

        formData.result = $('#parqResultStatus').text();
        formData.contact_number = $('#parqContactNumber').val() || null;

        console.log(formData);

        $.ajax({
            url: '../assets/php/save_parq.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (res) {
                console.log(res)
                $('#parqResultModal').fadeOut();
                $('input').val('').prop('checked', false);

                // Redirect to dashboard
                window.location.href = 'http://192.168.42.15:8035/';
            }
        });
    });

});
