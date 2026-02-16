$(document).ready(function () {
    // Prevent repeated showing (per session)
    if (!sessionStorage.getItem("adminAnnouncementShown")) {

        var adminAnnouncementModal = new bootstrap.Modal(
            document.getElementById('adminAnnouncementModal'),
            {
                backdrop: 'static',
                keyboard: false
            }
        );

        adminAnnouncementModal.show();

        sessionStorage.setItem("adminAnnouncementShown", "true");
    }

     // Announcement
    $('#btnAnnouncement').on('click', function(){
        var modal = new bootstrap.Modal(
            document.getElementById('adminAnnouncementModal')
        );
        modal.show();
    });

    // Suggestion
    $('#btnSuggestion').on('click', function(){
        var modal = new bootstrap.Modal(
            document.getElementById('suggestionModal')
        );
        modal.show();
    });

    // Concern
    $('#btnConcern').on('click', function(){
        var modal = new bootstrap.Modal(
            document.getElementById('concernModal')
        );
        modal.show();
    });


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
                emerContactCol(),
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
                emerContactCol(),
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
                emerContactCol(),
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
                emerContactCol(),
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
                emerContactCol(),
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
                emerContactCol(),
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

    // ===== Submit Suggestion =====
    $('#suggestionForm').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url: '../assets/php/save_suggestion.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function(){
                $('.suggestion-submit-btn').prop('disabled', true).text('Submitting...');
            },
            success: function(res){
                if(res.success){
                    $('#suggestionResponse').html('<div class="alert alert-success">'+res.message+'</div>');
                    $('#suggestionForm')[0].reset();
                    loadSuggestionsModal(); // reload table
                } else {
                    $('#suggestionResponse').html('<div class="alert alert-danger">'+res.message+'</div>');
                }
            },
            complete: function(){
                $('.suggestion-submit-btn').prop('disabled', false).text('Submit Suggestion');
            }
        });
    });

    // ===== Load Suggestions Table in Modal =====
    function loadSuggestionsModal(){
        $.ajax({
            url: '../assets/php/get_suggestions.php',
            type: 'GET',
            dataType: 'json',
            success: function(data){
                let tbody = '';
                data.forEach((item,index) => {
                    tbody += `<tr>
                        <td>${index+1}</td>
                        <td>${item.fullName}</td>
                        <td>${item.subject}</td>
                        <td>${item.message}</td>
                        <td>${item.status}</td>
                        <td>${item.adminResponse || '-'}</td>
                        <td>
                            <button class="btn btn-sm btn-primary btn-respond" 
                                data-id="${item.concernID}" 
                                data-subject="${item.subject}">
                                Respond
                            </button>
                        </td>
                    </tr>`;
                });
                $('#suggestionsTableModal tbody').html(tbody);
            }
        });
    }

    // Initial load
    loadSuggestionsModal();

    // ===== Respond Button Click =====
    $(document).on('click', '.btn-respond', function(){
        let concernID = $(this).data('id');
        let subject   = $(this).data('subject');
        $('#respondConcernID').val(concernID);
        $('#respondModalSubject').text(subject);
        $('#respondModal').modal('show');
    });

    // ===== Submit Admin Response =====
    $('#respondForm').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url: '../assets/php/save_suggestion_response.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function(){
                $('#respondForm button[type="submit"]').prop('disabled', true).text('Sending...');
            },
            success: function(res){
                if(res.success){
                    $('#responseMessage').html('<div class="alert alert-success">'+res.message+'</div>');
                    setTimeout(() => {
                        $('#respondModal').modal('hide');
                        $('#responseMessage').html('');
                        $('#respondForm')[0].reset();
                        loadSuggestionsModal(); // reload table
                    }, 1200);
                } else {
                    $('#responseMessage').html('<div class="alert alert-danger">'+res.message+'</div>');
                }
            },
            complete: function(){
                $('#respondForm button[type="submit"]').prop('disabled', false).text('Send Response');
            }
        });
    });

    // ===== Submit Concern =====
    $('#concernForm').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url: '../assets/php/save_concern.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function(){
                $('.concern-submit-btn').prop('disabled', true).text('Submitting...');
            },
            success: function(res){
                if(res.success){
                    $('#concernResponse').html('<div class="alert alert-success">'+res.message+'</div>');
                    $('#concernForm')[0].reset();
                    loadConcernsModal();
                } else {
                    $('#concernResponse').html('<div class="alert alert-danger">'+res.message+'</div>');
                }
            },
            complete: function(){
                $('.concern-submit-btn').prop('disabled', false).text('Submit Concern');
            }
        });
    });

    // ===== Load Concerns Table =====
    function loadConcernsModal(){
        $.ajax({
            url: '../assets/php/get_concerns.php',
            type: 'GET',
            dataType: 'json',
            success: function(data){
                let tbody = '';
                data.forEach((item,index) => {
                    tbody += `<tr>
                        <td>${index+1}</td>
                        <td>${item.fullName}</td>
                        <td>${item.subject}</td>
                        <td>${item.message}</td>
                        <td>${item.status}</td>
                        <td>${item.adminResponse || '-'}</td>
                        <td>
                            <button class="btn btn-sm btn-primary btn-respond-concern" 
                                data-id="${item.concernID}" 
                                data-subject="${item.subject}">
                                Respond
                            </button>
                        </td>
                    </tr>`;
                });
                $('#concernsTableModal tbody').html(tbody);
            }
        });
    }

    // Initial load
    loadConcernsModal();

    // ===== Respond Button Click =====
    $(document).on('click', '.btn-respond-concern', function(){
        let concernID = $(this).data('id');
        let subject   = $(this).data('subject');
        $('#respondBugConcernID').val(concernID);
        $('#respondConcernModalSubject').text(subject);
        $('#respondConcernModal').modal('show');
    });

    // ===== Submit Admin Response for Concern =====
    $(document).on('submit', '#respondConcernForm', function(e){
        e.preventDefault();

        let form = $(this); // the current form inside the modal
         console.log('Form element:', form);             // logs the jQuery object
        console.log('Serialized data:', form.serialize()); // logs the actual POST data
        $.ajax({
            url: '../assets/php/save_concern_response.php',
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            beforeSend: function(){
                form.find('button[type="submit"]').prop('disabled', true).text('Sending...');
            },
            success: function(res){
                if(res.success){
                    $('#respondConcernMessage').html('<div class="alert alert-success">'+res.message+'</div>');
                    setTimeout(() => {
                        $('#respondConcernModal').modal('hide');
                        $('#respondConcernMessage').html('');
                        form[0].reset();
                        loadConcernsModal(); // reload table
                    }, 1200);
                } else {
                    $('#respondConcernMessage').html('<div class="alert alert-danger">'+res.message+'</div>');
                }
            },
            complete: function(){
                form.find('button[type="submit"]').prop('disabled', false).text('Send Response');
            }
        });
    });


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
        render: v => (v ?? '') === '' ? 'N/A' : v
    };
}


function contactCol() {
    return {
        data: 'contact_number',
        render: v => v || 'N/A'
    };
}

function emerContactCol(){
    return {
        data: 'emergency_contact',
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
        fager: [
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
        parq: [
            { min: 0, max: 0, label: 'Cleared for Physical Activity' },
            { min: 1, max: 1, label: 'Medical Clearance Required' }
        ]
    };

    
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
        .attr('class', 'severity-badge ' + severity.toLowerCase().replace(/\s/g,'-'));

    // Build severity table dynamically
    const tableRows = severityConfig[type].map(item => {
        return `<tr data-min="${item.min}" data-max="${item.max}">
                    <td>${item.min}${item.min !== item.max ? '–' + item.max : ''}</td>
                    <td>${item.label}</td>
                </tr>`;
    }).join('');

    $('.severity-table tbody').html(tableRows);

    // Highlight the correct row
    $('.severity-table tr').removeClass('active').each(function() {
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



