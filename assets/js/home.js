const assessmentConfig = {
    gad7: {
        title: 'GAD-7 Assessment',
        viewUrl: '../public/GAD_7.php'
    },
    phq9: {
        title: 'PHQ-9 Assessment',
        viewUrl: '../public/PHQ_9.php'
    },
    ftnd: {
        title: 'Fagerström Test',
        viewUrl: '../public/FTND.php'
    },
    psqi: {
        title: 'PSQI Assessment',
        viewUrl: '../public/sqa.php'
    },
    pss: {
        title: 'Perceived Stress Scale',
        viewUrl: '../public/psc.php'
    },
    audit: {
        title: 'AUDIT Assessment',
        viewUrl: '../public/aas.php'
    },
    parq: {
        title: 'PAR-Q+ Assessment',
        viewUrl: '../public/parq.php'
    }
};


$(document).ready(function () {
    $('.prev-assess-btns').on('click', function () {

        const type = $(this).data('type');
        const config = assessmentConfig[type];

        if (!config) return;

        $('#prevAssessTable').html(`
            <tr><td colspan="5">Loading assessments...</td></tr>
        `);

        $('#viewModalTitle').text(config.title);
        console.log(type)
        $.ajax({
            url: '../assets/php/get_previous_assesment.php',
            method: 'POST',
            data: { type },
            dataType: 'json',
            success: function (res) {
                console.log(res)
                $('#prevAssessTable').empty();

                if (!res.length) {
                    $('#prevAssessTable').html(`
                        <tr><td colspan="5">No previous records found.</td></tr>
                    `);
                    return;
                }

                res.forEach(row => {
                    $('#prevAssessTable').append(`
                        <tr>
                            <td>${row.exam_date}</td>
                            <td>${row.patient_name}</td>
                            <td>${row.total_score}</td>
                            <td>
                                <span class="severity-badge ${row.severity.toLowerCase()}">
                                    ${row.severity}
                                </span>
                            </td>
                            <td>
                                <button class="btn-view"
                                    data-id="${row.id}"
                                    data-type="${type}"
                                    data-score="${row.total_score}"
                                    data-severity="${row.severity}">
                                    View
                                </button>
                            </td>
                        </tr>
                    `);
                });

                $('#prevAssessModal').fadeIn();
            }
        });
    });

    $(document).on('click', '.btn-view', function () {

        const id = $(this).data('id');
        const type = $(this).data('type');
        const score = $(this).data('score');
        const severity = $(this).data('severity');

        const config = assessmentConfig[type];

        $('#viewScore').text(score);
        $('#viewSeverity')
            .text(severity)
            .attr('class', 'severity-badge ' + severity.toLowerCase());

        $('.severity-table tr').removeClass('active').each(function () {
            const min = $(this).data('min');
            const max = $(this).data('max');
            if (score >= min && score <= max) {
                $(this).addClass('active');
            }
        });

        $('#assessmentFrame').attr(
            'src',
            `${config.viewUrl}?id=${id}&view=1`
        );

        $('#prevAssessModal').hide();
        $('#viewAssessModal').fadeIn();
    });


    $('.close-prev-modal').on('click', () => {
        $('#prevAssessModal').fadeOut();
    });

    $('.close-view-modal').on('click', () => {
        $('#viewAssessModal').fadeOut();
    });


    $('#backToList').on('click', function () {
        $('#viewAssessModal').hide();
        $('#prevAssessModal').fadeIn();
    });
});
