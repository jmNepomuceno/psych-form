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

const severityConfig = {
    gad7: [
        { min: 0, max: 4, label: 'Minimal' },
        { min: 5, max: 9, label: 'Mild' },
        { min: 10, max: 14, label: 'Moderate' },
        { min: 15, max: 21, label: 'Severe' }
    ],
    phq9: [
        { min: 0, max: 4, label: 'Minimal' },
        { min: 5, max: 9, label: 'Mild' },
        { min: 10, max: 14, label: 'Moderate' },
        { min: 15, max: 19, label: 'Moderately Severe' },
        { min: 20, max: 27, label: 'Severe' }
    ],
    audit: [
        { min: 0, max: 7, label: 'Low Risk' },
        { min: 8, max: 15, label: 'Moderate Risk' },
        { min: 16, max: 19, label: 'High Risk' },
        { min: 20, max: 40, label: 'Possible Dependence' }
    ],
    ftnd: [
        { min: 0, max: 2, label: 'Very Low' },
        { min: 3, max: 4, label: 'Low' },
        { min: 5, max: 5, label: 'Moderate' },
        { min: 6, max: 7, label: 'High' },
        { min: 8, max: 10, label: 'Very High' }
    ],
    pss: [
        { min: 0, max: 13, label: 'Low Stress' },
        { min: 14, max: 26, label: 'Moderate Stress' },
        { min: 27, max: 40, label: 'High Stress' }
    ],
    psqi: [
        { min: 0, max: 4, label: 'Good' },
        { min: 5, max: 10, label: 'Poor' },
        { min: 11, max: 21, label: 'Very Poor' }
    ],
    parq: [] // 🚫 no score table
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
                if(res.length > 0){
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
                                <td>${row.total_score ? row.total_score : "N/A"}</td>
                                <td>
                                    <span class="severity-badge ${row.severity ? row.severity.toLowerCase() : "none"}">
                                        ${row.severity ? row.severity : row.result}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn-view"
                                        data-id="${row.id}"
                                        data-type="${type}"
                                        data-score="${row.total_score ? row.total_score : "N/A"}"
                                        data-severity="${row.severity ? row.severity : row.result}">
                                        View
                                    </button>
                                </td>
                            </tr>
                        `);
                    });

                    $('#prevAssessModal').fadeIn();
                }else{
                    showNotificationModal(
                        'Notification',
                        "No Data Yet",
                        'warning'
                    );
                }
                
            }
        });
    });

    $(document).on('click', '.btn-view', function () {
        const id = $(this).data('id');
        const type = $(this).data('type');
        const score = $(this).data('score');
        const severity = $(this).data('severity');

        const config = assessmentConfig[type];

        $('#viewModalTitle').text(config.title);

        // ===============================
        // SCORE + SEVERITY DISPLAY
        // ===============================
        if (type === 'parq') {
            $('#viewScore').text('N/A');
            $('#viewSeverity')
                .text(severity)
                .attr('class', 'severity-badge ' + severity.toLowerCase().replace(/\s/g, '-'));

            $('.severity-table tbody').html(`
                <tr>
                    <td colspan="2" class="text-center">No score scale for PAR-Q+</td>
                </tr>
            `);
        } else {
            $('#viewScore').text(score);
            $('#viewSeverity')
                .text(severity)
                .attr('class', 'severity-badge ' + severity.toLowerCase().replace(/\s/g, '-'));

            // ===============================
            // Build severity table dynamically
            // ===============================
            const rows = severityConfig[type].map(item => `
                <tr data-min="${item.min}" data-max="${item.max}">
                    <td>${item.min}${item.min !== item.max ? '–' + item.max : ''}</td>
                    <td>${item.label}</td>
                </tr>
            `).join('');

            $('.severity-table tbody').html(rows);

            // Highlight correct row
            $('.severity-table tr').removeClass('active').each(function () {
                const min = $(this).data('min');
                const max = $(this).data('max');
                if (score >= min && score <= max) {
                    $(this).addClass('active');
                }
            });
        }

        // ===============================
        // Load read-only form
        // ===============================
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
