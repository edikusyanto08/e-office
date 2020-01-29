<body class="h-100">

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
                            <h3 class="page-title">Statistik</h3>
                        </div>
                    </div>
                    <!-- End Page Header -->
                    <div class="row">
                        <div class="col-lg col-md-6 col-sm-6 mb-4">
                            <div class="stats-small stats-small--1 card card-small">
                                <div class="card-body p-0 d-flex">
                                    <div class="d-flex flex-column m-auto">
                                        <div class="stats-small__data text-center">
                                            <span class="stats-small__label text-uppercase">inbox</span>
                                            <h6 class="stats-small__value count my-3"><?= count($countSuratMasuk); ?>
                                            </h6>
                                        </div>
                                    </div>
                                    <canvas height="120" class="blog-overview-stats-small-1"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg col-md-6 col-sm-6 mb-4">
                            <div class="stats-small stats-small--1 card card-small">
                                <div class="card-body p-0 d-flex">
                                    <div class="d-flex flex-column m-auto">
                                        <div class="stats-small__data text-center">
                                            <span class="stats-small__label text-uppercase">Disposisi</span>
                                            <h6 class="stats-small__value count my-3"><?= count($count_disposisi); ?>
                                            </h6>
                                        </div>
                                    </div>
                                    <canvas height="120" class="blog-overview-stats-small-2"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg col-md-4 col-sm-6 mb-4">
                            <div class="stats-small stats-small--1 card card-small">
                                <div class="card-body p-0 d-flex">
                                    <div class="d-flex flex-column m-auto">
                                        <div class="stats-small__data text-center">
                                            <span class="stats-small__label text-uppercase">SP & SPPD</span>
                                            <h6 class="stats-small__value count my-3"><?= count($countSuratPerintah); ?>
                                            </h6>
                                        </div>
                                    </div>
                                    <canvas height="120" class="blog-overview-stats-small-3"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg col-md-4 col-sm-6 mb-4">
                            <div class="stats-small stats-small--1 card card-small">
                                <div class="card-body p-0 d-flex">
                                    <div class="d-flex flex-column m-auto">
                                        <div class="stats-small__data text-center">
                                            <span class="stats-small__label text-uppercase">Nota Dinas</span>
                                            <h6 class="stats-small__value count my-3"><?= count($countNotaDinas); ?>
                                            </h6>
                                        </div>
                                    </div>
                                    <canvas height="120" class="blog-overview-stats-small-4"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg col-md-4 col-sm-6 mb-4">
                            <div class="stats-small stats-small--1 card card-small">
                                <div class="card-body p-0 d-flex">
                                    <div class="d-flex flex-column m-auto">
                                        <div class="stats-small__data text-center">
                                            <span class="stats-small__label text-uppercase">Dokumen Dihapus</span>
                                            <h6 class="stats-small__value count my-3"><?= count($countMailSampah); ?>
                                            </h6>
                                        </div>
                                    </div>
                                    <canvas height="120" class="blog-overview-stats-small-5"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                            <div class="card card-small">
                                <div class="card-header border-bottom">
                                    <h6 class="m-0">Statistik Surat Masuk - <?= date('Y'); ?></h6>
                                </div>
                                <div class="card-body pt-0">
                                    <canvas height="130" style="max-width: 100% !important;"
                                        class="surat-masuk-statistik"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                            <div class="card card-small">
                                <div class="card-header border-bottom">
                                    <h6 class="m-0">Statistik Surat Keluar - <?= date('Y'); ?></h6>
                                </div>
                                <div class="card-body pt-0">
                                    <canvas height="130" style="max-width: 100% !important;"
                                        class="surat-keluar-statistik"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $this->load->view('core/footer'); ?>
            </main>

        </div>
    </div>
    <?php $this->load->view('core/mail/modal/modal-surat-masuk'); ?>
    <input type="hidden" id="base_url_statistik" value="<?= base_url(); ?>">
    <input type="hidden" id="url" value="<?= base_url(); ?>">
    <script>
    $(".menu-statistik").addClass("active");
    $(".inbox").addClass("active");
    $(".text-inbox").removeClass('text-primary');
    </script>