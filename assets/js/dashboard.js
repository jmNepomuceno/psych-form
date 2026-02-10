$(document).ready(function () {

    /* ==========================
       FORM CONFIGURATION
    ========================== */
    const forms = {
        phq9: {
            key: 'phq9',
            table: '#table-phq9',
            panel: '#panel-phq9',
            count: '#phqCount',
            fetch: '../assets/php/fetch_phq9.php',
            columns: [
                rowNumber(),
                col('patient_name'),
                contactCol(),
                col('total_score'),
                severityCol(),
                col('created_at'),
                viewBtn('phq9')
            ]
        },

        gad7: {
            key: 'gad7',
            table: '#table-gad7',
            panel: '#panel-gad7',
            count: '#gadCount',
            fetch: '../assets/php/fetch_gad7.php',
            columns: [
                rowNumber(),
                col('patient_name'),
                contactCol(),
                col('total_score'),
                severityCol(),
                col('created_at'),
                viewBtn('gad7')
            ]
        },

        audit: {
            key: 'audit',
            table: '#table-audit',
            panel: '#panel-audit',
            count: '#auditCount',
            fetch: '../assets/php/fetch_audit.php',
            columns: [
                rowNumber(),
                col('patient_name'),
                contactCol(),
                col('total_score'),
                severityCol(),
                col('created_at'),
                viewBtn('audit')
            ]
        },

        parq: {
            key: 'parq',
            table: '#table-parq',
            panel: '#panel-parq',
            count: '#parqCount',
            fetch: '../assets/php/fetch_parq.php',
            columns: [
                rowNumber(),

                { title: 'Full Name', data: 'patient_name' },

                { title: 'Age / Sex', data: 'age_sex' },

                {
                    title: 'Result',
                    data: 'result',
                    render: r => r || 'No risk identified'
                },

                {
                    title: 'Clearance',
                    data: 'result',
                    render: r => {
                        if (!r) {
                            return '<span class="badge badge-green">CLEARED</span>';
                        }

                        return r.toLowerCase().includes('medical')
                            ? '<span class="badge badge-red">NEEDS CLEARANCE</span>'
                            : '<span class="badge badge-green">CLEARED</span>';
                    }
                },

                { title: 'Date', data: 'created_at' },

                viewBtn('parq')
            ]
        },

        psqi: {
            key: 'psqi',
            table: '#table-psqi',
            panel: '#panel-psqi',
            count: '#psqiCount',
            fetch: '../assets/php/fetch_psqi.php',
            columns: [
                rowNumber(),
                col('patient_name'),
                contactCol(),
                col('total_score'),
                severityCol(),
                col('created_at'),
                viewBtn('psqi')
            ]
        },

        fager: {
            key: 'fager',
            table: '#table-fager',
            panel: '#panel-fager',
            count: '#fagerCount',
            fetch: '../assets/php/fetch_ftnd.php',
            columns: [
                rowNumber(),
                col('patient_name'),
                contactCol(),
                col('total_score'),
                severityCol(),
                col('created_at'),
                viewBtn('fager')
            ]
        },

        pss: {
            key: 'pss',
            table: '#table-pss',
            panel: '#panel-pss',
            count: '#pssCount',
            fetch: '../assets/php/fetch_pss.php',
            columns: [
                rowNumber(),
                col('patient_name'),
                contactCol(),
                col('total_score'),
                severityCol(),
                col('created_at'),
                viewBtn('pss')
            ]
        }
        
    };

    function loadAllCounts() {
        Object.values(forms).forEach(cfg => {
            $.ajax({
                url: cfg.fetch,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $(cfg.count).text(data.length);
                },
                error: function () {
                    $(cfg.count).text('0');
                }
            });
        });
    }
    
    const initialized = {};

    /* ==========================
       INIT FIRST TAB ONLY
    ========================== */
    loadAllCounts();
    initTable(forms.phq9);

    /* ==========================
       TAB SWITCHING
    ========================== */
    $('.tab-btn').on('click', function () {
        const target = $(this).data('target');

        $('.tab-btn').removeClass('active');
        $(this).addClass('active');

        $('.table-panel').removeClass('active').hide();
        $(`#panel-${target}`).addClass('active').fadeIn();

        if (!initialized[target]) {
            initTable(forms[target]);
        } 
        else {
            $(forms[target].table).DataTable().columns.adjust();
        }
    });

    /* ==========================
       MODAL EVENTS
    ========================== */
    $('.modal-close').on('click', closeModal);

    $('#viewModal').on('click', function (e) {
        if (e.target === this) closeModal();
    });

    /* ==========================
       DATATABLE INITIALIZER
    ========================== */
    function initTable(cfg) {
        const table = $(cfg.table).DataTable({
            ajax: {
                url: cfg.fetch,
                type: 'GET',
                dataType: 'json',
                dataSrc: function (data) {
                    console.log(`Data returned for ${cfg.key}:`, data); // debug log
                    $(cfg.count).text(data.length);
                    return data;
                }
            },
            columns: cfg.columns,
            order: [[cfg.columns.length - 2, 'desc']],
            pageLength: 10,
            responsive: true,
            columnDefs: [
                { className: 'text-center', targets: '_all' }
            ],
            createdRow: function (row, data) {
                if (!data || !data.severity) return; // skip if no severity

                const sev = data.severity.toLowerCase();

                // map any keyword to a color
                if (sev.includes('mild')) {
                    $(row).css('background', '#d1fae5');
                } else if (sev.includes('moderate')) {
                    $(row).css('background', '#ffedd5');
                } else if (sev.includes('severe') || sev.includes('very poor') || sev.includes('high')) {
                    $(row).css('background', '#fee2e2');
                } else {
                    // optional: default color if severity doesn't match
                    $(row).css('background', '');
                }
            }
        });

        initialized[cfg.key] = true;
    }

});

/* ==========================
   COLUMN HELPERS
========================== */
function rowNumber() {
    return {
        data: null,
        render: (d, t, r, m) => m.row + 1
    };
}

function col(name) {
    return {
        data: name,
        render: v => v || 'N/A'
    };
}

function contactCol() {
    return {
        data: 'contact_number',
        render: v => v || 'N/A'
    };
}

function severityCol() {
    return {
        data: 'severity',
        render: v => v || 'N/A'
    };
}

function viewBtn(type) {
    return {
        data: null,
        render: row => `
            <button class="btn-view"
                onclick="viewForm(
                    '${type}',
                    ${row.id},
                    ${row.total_score},
                    '${row.severity}'
                )">
                View
            </button>
        `
    };
}


/* ==========================
   VIEW MODAL
========================== */
function viewForm(type, id, score, severity) {

    const titles = {
        phq9: 'PHQ-9 Assessment',
        gad7: 'GAD-7 Assessment',
        audit: 'AUDIT Assessment',
        parq: 'PAR-Q+ Assessment',
        psqi: 'PSQI Assessment',
        fager: 'Fagerstrom Test Assessment',
        pss: 'Perceived Stress Scale'
    };

    const urls = {
        phq9: '../public/PHQ_9.php',
        gad7: '../public/GAD_7.php',
        audit: '../public/aas.php',
        parq: '../public/PARQ.php',
        psqi: '../public/sqa.php',
        fager: '../public/FTND.php',
        pss: '../public/psc.php'
    };

    $('#modalTitle').text(titles[type]);

    // SCORE + SEVERITY
    $('#viewScore').text(score);
    $('#viewSeverity')
        .text(severity)
        .attr('class', 'severity-badge ' + severity.toLowerCase());

    // Highlight severity row (same logic as home.js)
    $('.severity-table tr').removeClass('active').each(function () {
        const min = $(this).data('min');
        const max = $(this).data('max');
        if (score >= min && score <= max) {
            $(this).addClass('active');
        }
    });

    // Load read-only form
    $('#assessmentFrame').attr(
        'src',
        `${urls[type]}?id=${id}&view=1`
    );

    $('#viewModal').fadeIn();
}


function closeModal() {
    $('#viewModal').fadeOut();
}



