$(document).ready(function () {

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

});
