$(document).ready(function () {
        /* ==========================
        PHQ-9 DATATABLE
        ========================== */
        $('#phqTable').DataTable({
            ajax: {
                url: '../assets/php/fetch_phq9.php',
                type: 'GET',
                dataSrc: ''
            },
            columns: [
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                { data: 'patient_name' },
                { data: 'created_at' },
                { data: 'total_score' },
                {
                    data: 'id',
                    render: function (id) {
                        return `<button class="btn-view" onclick="viewPHQ9(${id})">View</button>`;
                    }
                }
            ],
            order: [[2, 'desc']]
        });

        /* ==========================
        GAD-7 DATATABLE
        ========================== */
        $('#gadTable').DataTable({
            ajax: {
                url: '../assets/php/fetch_gad7.php',
                type: 'GET',
                dataSrc: ''
            },
            columns: [
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                { data: 'patient_name' },
                { data: 'created_at' },
                { data: 'total_score' },
                {
                    data: 'id',
                    render: function (id) {
                        return `<button class="btn-view" onclick="viewGAD7(${id})">View</button>`;
                    }
                }
            ],
            order: [[2, 'desc']]
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



    
