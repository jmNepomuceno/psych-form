$(document).ready(function () {
        /* ==========================
        GAD-7 DATATABLE
        ========================== */
        $('#gadTable').DataTable({
            ajax: {
                url: '../assets/php/fetch_gad7.php',
                type: 'GET',
                dataType: 'json',
                dataSrc: ''
            },
            columns: [
                { data: null, render: (data, type, row, meta) => meta.row + 1 },
                { data: 'patient_name' },
                { data: 'contact_number', render: num => num ? num : 'N/A' },
                { data: 'total_score' },
                { data: 'severity', render: sev => sev ? sev : 'N/A' },
                { data: 'created_at' },
                { data: 'id', render: id => `<button class="btn-view" onclick="viewGAD7(${id})">View</button>` }
            ],
            order: [[5, 'desc']],
            pageLength: 10,
            responsive: true,
            columnDefs: [
                { className: "text-center", targets: [0, 3, 4, 6] }
            ],
            createdRow: function(row, data) {
                if (data.severity) {
                    let severity = data.severity.toLowerCase();
                    if (severity === 'mild') $(row).css('background-color', '#d1fae5');      // light green
                    else if (severity === 'moderate') $(row).css('background-color', '#ffedd5'); // light orange
                    else if (severity === 'severe') $(row).css('background-color', '#fee2e2');   // light red
                }
            }
        });


        /* ==========================
        PHQ-9 DATATABLE
        ========================== */
        $('#phqTable').DataTable({
            ajax: {
                url: '../assets/php/fetch_phq9.php',
                type: 'GET',
                dataType: 'json',
                dataSrc: ''
            },
            columns: [
                { data: null, render: (data, type, row, meta) => meta.row + 1 },
                { data: 'patient_name' },
                { data: 'contact_number', render: num => num ? num : 'N/A' },
                { data: 'total_score' },
                { data: 'severity', render: sev => sev ? sev : 'N/A' },
                { data: 'created_at' },
                { data: 'id', render: id => `<button class="btn-view" onclick="viewPHQ9(${id})">View</button>` }
            ],
            order: [[5, 'desc']],
            pageLength: 10,
            responsive: true,
            columnDefs: [
                { className: "text-center", targets: [0, 3, 4, 6] }
            ],
            createdRow: function(row, data) {
                if (data.severity) {
                    let severity = data.severity.toLowerCase();
                    if (severity === 'mild') $(row).css('background-color', '#d1fae5');
                    else if (severity === 'moderate') $(row).css('background-color', '#ffedd5');
                    else if (severity === 'severe') $(row).css('background-color', '#fee2e2');
                }
            }
        });




        $('.modal-close').on('click', function () {
            $('#viewModal').fadeOut();
        });

        // Close when clicking outside the box
        $('#viewModal').on('click', function (e) {
            if (e.target === this) {
                $(this).fadeOut();
            }
        });

    });

    /* ==========================
    VIEW FUNCTIONS
    ========================== */

    function viewPHQ9(id) {
        $('#modalTitle').text('PHQ-9 Assessment');
        $('#modalContent').html('<iframe src="../public/PHQ_9.php?id=' + id + '" style="width:100%;height:80vh;border:none;"></iframe>');
        $('#viewModal').fadeIn();
    }

    function viewGAD7(id) {
        $('#modalTitle').text('GAD-7 Assessment');
        $('#modalContent').html(
            '<iframe src="../public/GAD_7.php?id=' + id + '" style="width:100%;height:80vh;border:none;"></iframe>'
        );
        $('#viewModal').fadeIn();
    }



    
