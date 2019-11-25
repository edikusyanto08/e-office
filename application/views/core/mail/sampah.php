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
                            <h3 class="page-title">Tong Sampah</h3>
                        </div>
                    </div>
                    <?= $message; ?>
                    <!-- End Page Header -->
                    <div class="row">
                        <div class="col-lg-3">
                            <?php $this->load->view('core/layout/menu-surat'); ?>
                        </div>
                        <div class="col-lg-6">
                            <?php $this->load->view('core/mail/table/table-sampah'); ?>
                        </div>
                        <div class="col-lg-3">
                            <?php $this->load->view('core/layout/keterangan-surat'); ?>
                        </div>
                    </div>
                </div>
                <?php $this->load->view('core/footer'); ?>
            </main>
        </div>
    </div>
    <?php $this->load->view('core/mail/modal/modal-surat-masuk'); ?>
    <input type="hidden" id="url" value="<?= base_url(); ?>">
    <script>
    $(".menu-surat-masuk").addClass("active");
    $(".sampah").addClass("active");
    $(".text-sampah").removeClass('text-primary');
    </script>