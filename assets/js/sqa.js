const test = (i) => {
    console.log('Test run:', i);

    // ====== PATIENT INFO ======
    $('.patient-info input').eq(0).val('Juan D. Reyes ' + i); // Name
    $('.patient-info input').eq(1).val('25/M');               // Age/Sex
    $('.patient-info input').eq(2).val('2026-01-28');        // Date

    // ====== SECTION 1 (Q1–Q5) ======
    const section1Answers = [
        '22:30', // Q1
        15,      // Q2
        '06:30', // Q3
        7,       // Q4
        8        // Q5
    ];

    $('.sqa-table').first().find('tbody tr').each((idx, tr) => {
        $(tr).find('input').val(section1Answers[idx]);
    });

    // ====== SECTION 2 (Q6a–Q6j radios) ======
    const q6Answers = {
        q6a: 2,
        q6b: 1,
        q6c: 0,
        q6d: 1,
        q6e: 3,
        q6f: 0,
        q6g: 1,
        q6h: 0,
        q6i: 2,
        q6j: 1
    };

    Object.keys(q6Answers).forEach(q => {
        $(`input[name="${q}"][value="${q6Answers[q]}"]`).prop('checked', true);
    });

    // Optional "Other reason" text for q6j
    $('.sqa-table').eq(1).find('tbody tr').last().find('input[type="text"]').val('Sample reason ' + i);

    // ====== SECTION 3 (Q7–Q8 selects) ======
    const q7Val = '1'; // Less than once a week
    const q8Val = '2'; // Once or twice a week
    $('.sqa-table').eq(2).find('select').eq(0).val(q7Val);
    $('.sqa-table').eq(2).find('select').eq(1).val(q8Val);

    // ====== SECTION 4 (Q9 radio) ======
    const q9Val = 1; // Fairly Good
    $('.sqa-table').eq(3).find('tbody tr td input').eq(q9Val).prop('checked', true);

    // ====== TOTAL SCORE ======
    let total = 0;

    // Radio buttons (Q6 + Q9)
    $('input[type=radio]:checked').each(function() {
        const val = parseInt($(this).val());
        if (!isNaN(val)) total += val;
    });

    // Selects (Q7–Q8)
    $('.sqa-table').eq(2).find('select').each(function() {
        const val = parseInt($(this).val());
        if (!isNaN(val)) total += val;
    });

    // Update total score box
    $('.total-section input').val(total);

    console.log('Sample PSQI form populated with total score:', total);
};



function getPSQISeverity(score) {
    if(score <= 4) return 'Good';
    if(score <= 10) return 'Poor';
    return 'Very Poor';
}



$(document).ready(function() {

    // ===============================
    // 1️⃣ Update total score dynamically
    // ===============================
    function calculateTotalScore() {
        let total = 0;

        // Include all radio buttons (Q6a–Q6j & Q9)
        $('input[type=radio]:checked').each(function() {
            const val = parseInt($(this).val());
            if (!isNaN(val)) total += val;
        });

        // Include select questions (Q7–Q8)
        $('select[name="q7"], select[name="q8"]').each(function() {
            const val = parseInt($(this).val());
            if (!isNaN(val)) total += val;
        });

        $('#totalScore').val(total);
        return total;
    }

    // Trigger calculation when radio or select changes
    $('input[type=radio], select').on('change', calculateTotalScore);


    // ===============================
    // 2️⃣ Handle form submission & modal
    // ===============================
    $('#submitForm').on('click', function() {

        const totalScore = calculateTotalScore();
        const severity = getPSQISeverity(totalScore);

        // Highlight severity row
        $('.severity-table tbody tr').removeClass('active').each(function () {
            const min = parseInt($(this).data('min'));
            const max = parseInt($(this).data('max'));

            if (totalScore >= min && totalScore <= max) {
                $(this).addClass('active');
            }
        });

        $('#psqiResultScore').text(totalScore);
        $('#psqiResultSeverity')
            .removeClass()
            .addClass('severity-badge severity-' + severity.replace(' ', ''))
            .text(severity);
        console.log(severity)
        // Show/hide follow-up section based on severity
        if (severity === 'Poor' || severity === 'Very Poor') {
            $('#psqiFollowUpSection').show();
            $('#psqiContactSection').hide();
            $('#psqiConfirmSubmit').prop('disabled', true);
            $('input[name="psqiFollowUpChoice"]').prop('checked', false);
            $('#psqiContactNumber').val('');
        } else {
            $('#psqiFollowUpSection').hide();
            $('#psqiContactSection').hide();
            $('#psqiConfirmSubmit').prop('disabled', false);
        }

        $('#psqiResultModal').fadeIn();
    });


    // ===============================
    // 3️⃣ Follow-up consent handling
    // ===============================
    $('input[name="psqiFollowUpChoice"]').on('change', function () {
        $('#psqiConfirmSubmit').prop('disabled', false);

        if (this.value === 'agree') {
            $('#psqiContactSection').slideDown();
        } else {
            $('#psqiContactSection').slideUp();
            $('#psqiContactNumber').val('');
        }
    });


    // ===============================
    // 4️⃣ Confirm & Save
    // ===============================
    $('#psqiConfirmSubmit').on('click', function () {
        let formData = {};

        // Patient Info
        formData.patient_name = $('input[name="patient_name"]').val();
        formData.age_sex = $('input[name="age_sex"]').val();
        formData.exam_date = $('input[name="exam_date"]').val();

        // Section 1 (Q1–Q5)
        for (let i = 1; i <= 5; i++) {
            formData['q' + i] = $('input[name="q' + i + '"]').val() || '';
        }

        // Section 2 (Q6a–Q6j radios)
        const q6letters = ['a','b','c','d','e','f','g','h','i','j'];
        q6letters.forEach(letter => {
            formData['q6' + letter] = $('input[name="q6' + letter + '"]:checked').val() || '';
        });

        // Section 3 (Q7–Q8 selects)
        formData['q7'] = $('select[name="q7"]').val() || '';
        formData['q8'] = $('select[name="q8"]').val() || '';

        // Section 4 (Q9 radio)
        formData['q9'] = $('input[name="q9"]:checked').val() || '';

        // Optional text for Q6j "Other reason"
        formData['q6j_other'] = $('input[name="q6j_other"]').val() || '';

        // Total score and severity
        formData.total_score = $('#psqiResultScore').text();
        formData.severity = $('#psqiResultSeverity').text();

        // Optional contact number
        formData.contact_number = $('#psqiContactNumber').val() || null;

        console.log('Form Data to submit:', formData);

        // ===============================
        // AJAX Submission
        // ===============================
        $.ajax({
            url: '../assets/php/save_sqa.php', // PHP handler for PSQI
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log('Server response:', response);

                // Reset form after submission
                $('input').val('').prop('checked', false);
                $('select').val('');
                $('#totalScore').val('');
                $('.severity-table tbody tr').removeClass('active');
                $('#psqiResultModal').fadeOut();
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Failed to submit form.');
            }
        });
    });

});


