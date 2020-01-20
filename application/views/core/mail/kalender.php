<head>
    <meta charset='utf-8' />
    <link href='<?= base_url(); ?>assets/calendar/packages/core/main.css' rel='stylesheet' />
    <link href='<?= base_url(); ?>assets/calendar/packages/daygrid/main.css' rel='stylesheet' />
    <link href='<?= base_url(); ?>assets/calendar/packages/timegrid/main.css' rel='stylesheet' />
    <link href='<?= base_url(); ?>assets/calendar/packages/list/main.css' rel='stylesheet' />
    <script src='<?= base_url(); ?>assets/calendar/packages/core/main.js'></script>
    <script src='<?= base_url(); ?>assets/calendar/packages/interaction/main.js'></script>
    <script src='<?= base_url(); ?>assets/calendar/packages/daygrid/main.js'></script>
    <script src='<?= base_url(); ?>assets/calendar/packages/timegrid/main.js'></script>
    <script src='<?= base_url(); ?>assets/calendar/packages/list/main.js'></script>

    <style>
    body {
        padding: 0;
        width: 100%;
    }

    .fc-title,
    .fc-time {
        color: #fff;
    }

    .fc-center {
        font-weight: bold;
    }

    #calendar {
        max-width: 900px;
        margin: 0 auto;
    }
    </style>
</head>

<body class="h-100">
    <input type="hidden" id="url" value="<?= base_url(); ?>">
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '-' + dd;
        var base_url_surat = $('#url').val();
        var kegiatan = mm;
        var event;
        $.ajax({
            url: base_url_surat +
                "Surat/kalenderKegiatan",
            data: {
                kalender: kegiatan
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                    },
                    defaultDate: today,
                    navLinks: true, // can click day/week names to navigate views

                    weekNumbers: true,
                    weekNumbersWithinDays: true,
                    weekNumberCalculation: 'ISO',

                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    events: [{
                        "title": 'Dinas Komunikasi & Informatika Provinsi Jawa Barat',
                        "start": '2019-10-30', //yyyy-mm-dd
                        "end": '2019-10-30'
                    }]
                });
                calendar.render();
            },
            error: function() {
                console.log('data not found');
            }
        });
    });
    </script>
    <div class="container-fluid">
        <div class="row">
            <!-- Main Sidebar -->
            <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
                <?php $this->load->view('core/layout/side-top'); ?>`
            </aside>
            <!-- End Main Sidebar -->
            <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
                <div class="main-navbar sticky-top bg-white">
                    <!-- Main Navbar -->
                    <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
                        <?php $this->load->view('core/layout/navbar-top'); ?>
                        <nav class="nav">
                            <a href="#"
                                class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left"
                                data-toggle="collapse" data-target=".header-navbar" aria-expanded="false"
                                aria-controls="header-navbar">
                                <i class="material-icons">&#xE5D2;</i>
                            </a>
                        </nav>
                    </nav>
                </div>
                <!-- / .main-navbar -->
                <div class="main-content-container container-fluid px-4">
                    <!-- Page Header -->
                    <div class="page-header row no-gutters py-4">
                        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                            <span class="text-uppercase page-subtitle">Dashboard</span>
                            <h3 class="page-title">Kalender Kegiatan</h3>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h5 class="m-0 font-weight-bold">Kalender</h5>
                            </div>
                            <div class="card-body pt-0 mt-3">
                                <?php $this->load->view('core/mail/form/kalender'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $this->load->view('core/footer'); ?>
            </main>
        </div>
    </div>
    <input type="hidden" id="url" value="<?= base_url(); ?>">
    <script>
    $(".menu-kalender").addClass("active");
    </script>