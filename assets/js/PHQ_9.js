const populate_sample_phq9 = () => {
    // ====== PATIENT INFO ======
    $('input[name="patient_name"]').val('Juan D. Reyes');
    $('input[name="age_sex"]').val('25/M');
    $('input[name="exam_date"]').val('2026-01-28');

    // ====== PHQ-9 QUESTIONS ======
    // Sample answers (randomized 0-3 for demo)
    const phq9Answers = [1, 2, 0, 1, 3, 2, 0, 1, 2]; // corresponds to q1-q9
    phq9Answers.forEach((val, idx) => {
        $(`input[name="q${idx + 1}"][value="${val}"]`).prop('checked', true).trigger('change');
    });

    // ====== FUNCTIONAL DIFFICULTY ======
    $('input[name="difficulty"][value="1"]').prop('checked', true); // Somewhat difficult

    // ====== SIGNATURE ======
    $('input[name="physician"]').val('Dr. Maria Santos');
    $('input[name="license_no"]').val('12345-DOH');
    $('input[name="physician_date"]').val('2026-01-28');

    // ====== TOTAL SCORE (optional calculation trigger) ======
    if($('#totalScore').length) {
        $('input[type="radio"]').first().trigger('change'); // trigger recalculation
    }

    console.log('Sample PHQ-9 form populated!');
};

$(document).ready(function () {

    // Parse id parameter from URL
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    console.log(id)

    if (id) {
        // fetch data and populate
        $.get('../assets/php/get_phq9.php', { id: id }, function (data) {
            console.log(data)
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
        for (let i = 1; i <= 9; i++) {
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


    $('#submitForm').on('click', function () {
        // Collect form data
        let formData = {};

        // ====== PATIENT INFO ======
        formData.patient_name = $('input[name="patient_name"]').val();
        formData.age_sex = $('input[name="age_sex"]').val();
        formData.exam_date = $('input[name="exam_date"]').val();

        // ====== PHQ-9 QUESTIONS ======
        for (let i = 1; i <= 9; i++) {
            formData['q' + i] = $('input[name="q' + i + '"]:checked').val() || 0;
        }

        // ====== FUNCTIONAL DIFFICULTY ======
        formData.difficulty = $('input[name="difficulty"]:checked').val() || 0;

        // ====== SIGNATURE ======
        formData.physician = $('input[name="physician"]').val();
        formData.license_no = $('input[name="license_no"]').val();
        formData.physician_date = $('input[name="physician_date"]').val();

        // ====== TOTAL SCORE ======
        formData.total_score = $('#totalScore').val();

        // AJAX request to save PHQ-9
        $.ajax({
            url: '../assets/php/save_phq9.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                console.log(response);

                // ====== RESET FORM FIELDS ======
                $('input[type="text"], input[type="date"]').val(''); // clear text and date inputs
                $('input[type="radio"]').prop('checked', false); // clear all radio buttons
                $('#totalScore').val(''); // clear total score if exists
            },
            error: function () {
                alert('Error saving PHQ-9');
            }
        });
    });

});
