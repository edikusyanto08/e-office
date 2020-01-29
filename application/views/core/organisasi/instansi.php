<body class="h-100">
    <div class="container-fluid">
        <div class="row">
            <!-- Main Sidebar -->
            <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
                <?php $this->load->view('core/layout/side-top'); ?>
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
                            <h3 class="page-title">Instansi</h3>
                        </div>
                    </div>
                    <!-- End Page Header -->
                    <?= $message; ?>
                    <div class="row">
                        <?php if ($this->session->userdata('sisule_cms_hak') == 'superadmin') { ?>
                        <?php $this->load->view('core/organisasi/table/table-instansi'); ?>
                        <?php } else { ?>
                        <?php $this->load->view('core/organisasi/form/form-instansi-master'); ?>
                        <?php } ?>
                    </div>
                </div>
                <?php $this->load->view('core/footer'); ?>
            </main>
        </div>
    </div>
    <input type="hidden" value="<?= base_url(); ?>" id="url_instansi">
    <script>
    let url_instansi = $('#url_instansi').val();
    $('document').ready(function() {
        $.ajax({
            url: url_instansi + "instansi/listinstansi",
            data: {
                id: null
            },
            method: 'post',
            success: function(data) {
                $('.table_instansi').html(data);
                $('.hapusinstansi').on("click", function() {
                    Swal.fire({
                        title: 'Yakin menghapus instansi?',
                        text: "Data akan dihapus secara permanen",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#addbc1',
                        cancelButtonColor: '#1e84d4',
                        confirmButtonText: 'Ya, Hapus saja!',
                        cancelButtonText: 'Tidak',
                    }).then((result) => {
                        if (result.value) {
                            let id_instansi = $(this).data('id');
                            console.log(id_instansi);
                            $.ajax({
                                url: url + "instansi/hapusinstansi",
                                data: {
                                    id: id_instansi
                                },
                                method: 'post',
                                success: function(data) {
                                    Swal.fire({
                                        type: 'success',
                                        title: 'Surat Telah Berhasil Dihapus!',
                                        showConfirmButton: true
                                    }).then((result) => {
                                        location.reload();
                                    });
                                }
                            });

                        }
                    })
                });
            },
            error: function() {
                console.log("failed data request");
            }
        });
    });
    $('#cariinstansi').keyup(function() {
        let key = $(this).val();
        $.ajax({
            url: url_instansi + "instansi/cariinstansi",
            data: {
                id: key
            },
            method: 'post',
            success: function(data) {
                $('.table_instansi').html(data);
                $('.hapusinstansi').on("click", function() {
                    Swal.fire({
                        title: 'Yakin menghapus instansi?',
                        text: "Data akan dihapus secara permanen",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#addbc1',
                        cancelButtonColor: '#1e84d4',
                        confirmButtonText: 'Ya, Hapus saja!',
                        cancelButtonText: 'Tidak',
                    }).then((result) => {
                        if (result.value) {
                            let id_instansi = $(this).data('id');
                            console.log(id_instansi);
                            $.ajax({
                                url: url + "instansi/hapusinstansi",
                                data: {
                                    id: id_instansi
                                },
                                method: 'post',
                                success: function(data) {
                                    Swal.fire({
                                        type: 'success',
                                        title: 'Surat Telah Berhasil Dihapus!',
                                        showConfirmButton: true
                                    }).then((result) => {
                                        location.reload();
                                    });
                                }
                            });
                        }
                    })
                });
            },
            error: function() {
                console.log("failed data request");
            }
        });
    });
    $(".menu-instansi").addClass("active");
    </script>