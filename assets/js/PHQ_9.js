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

    // ====== TOTAL SCORE (optional calculation trigger) ======
    if($('#totalScore').length) {
        $('input[type="radio"]').first().trigger('change'); // trigger recalculation
    }

    console.log('Sample PHQ-9 form populated!');
};

function getPHQSeverity(score) {
    if (score <= 4) return 'Minimal';
    if (score <= 9) return 'Mild';
    if (score <= 14) return 'Moderate';
    if (score <= 19) return 'Moderately Severe';
    return 'Severe';
}

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

        let totalScore = parseInt($('#totalScore').val() || 0);
        let severity = getPHQSeverity(totalScore);

        // Highlight severity row
        $('.severity-table tbody tr').removeClass('active');
        $('.severity-table tbody tr').each(function () {
            let min = parseInt($(this).data('min'));
            let max = parseInt($(this).data('max'));
            if (totalScore >= min && totalScore <= max) {
                $(this).addClass('active');
            }
        });

        // Severity badge
        $('#resultScore').text(totalScore);
        $('#resultSeverity')
            .removeClass()
            .addClass('severity-badge severity-' + severity.replace(/\s/g, ''))
            .text(severity);

        // Show consent only if ≥ Moderate
        if (totalScore >= 10) {
            $('#consentSection').show();
            $('#confirmSubmit').prop('disabled', true);
        } else {
            $('#consentSection').hide();
            $('#contactSection').hide();
            $('#confirmSubmit').prop('disabled', false);
        }

        $('#resultModal').fadeIn();

        // Enable confirm once consent chosen
        $('input[name="consentChoice"]').off().on('change', function () {
            $('#confirmSubmit').prop('disabled', false);
            if ($(this).val() === 'agree') {
                $('#contactSection').slideDown();
            } else {
                $('#contactSection').slideUp();
                $('#contactNumber').val('');
            }
        });

        // FINAL SAVE
        $('#confirmSubmit').off().on('click', function () {

            let formData = {};

            formData.patient_name = $('input[name="patient_name"]').val();
            formData.age_sex = $('input[name="age_sex"]').val();
            formData.exam_date = $('input[name="exam_date"]').val();

            for (let i = 1; i <= 9; i++) {
                formData['q' + i] = $('input[name="q' + i + '"]:checked').val() || 0;
            }

            formData.difficulty = $('input[name="difficulty"]:checked').val() || 0;

            formData.total_score = totalScore;
            formData.severity = severity;
            formData.contact_number = $('#contactNumber').val() || null;

            $.ajax({
                url: '../assets/php/save_phq9.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    $('#resultModal').fadeOut();
                    $('input').val('').prop('checked', false);
                    $('#totalScore').val('');

                    // window.location.href = 'http://192.168.42.15:8035/';
                },
                error: function () {
                    alert('Error saving PHQ-9');
                }
            });
        });

    });

    //1
    // 2
    // 3
    // 1
    // 2
    // 3
    // 1
    // 0
    // 1
});
