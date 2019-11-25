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
                            <h3 class="page-title">User</h3>
                        </div>
                    </div>
                    <!-- End Page Header -->
                    <?php $this->load->view('core/organisasi/table/table-user'); ?>
                </div>
                <?php $this->load->view('core/footer'); ?>
            </main>
        </div>
    </div>
    <input type="hidden" id="url" value="<?= base_url(); ?>">
    <input type="hidden" value="<?= base_url(); ?>" id="url_user">
    <script>
    let url_user = $('#url_user').val();
    $('document').ready(function() {
        $.ajax({
            url: url_user + "user/listUser",
            data: {
                id: null
            },
            method: 'post',
            success: function(data) {
                $('.table_user').html(data);
                $('.hapususer').on("click", function() {
                    let id_user = $(this).data('id');
                    console.log(id_user);
                    Swal.fire({
                        title: 'Yakin menghapus pengguna ini?',
                        text: "Data akan dihapus secara permanen",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#addbc1',
                        cancelButtonColor: '#1e84d4',
                        confirmButtonText: 'Ya, Hapus saja!',
                        cancelButtonText: 'Tidak',
                    }).then((result) => {
                        if (result.value) {
                            let id_user = $(this).data('id');
                            $.ajax({
                                url: url_user + "user/hapususer",
                                data: {
                                    id: id_user
                                },
                                method: 'post',
                                success: function(data) {
                                    Swal.fire({
                                        title: 'Dihapus!',
                                        text: 'Data berhasil dihapus.',
                                        type: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#addbc1',
                                        cancelButtonColor: '#1e84d4',
                                        confirmButtonText: 'Ya, Hapus saja!',
                                        cancelButtonText: 'Tidak',
                                    }).then((result) => {
                                        location.reload();
                                    });
                                }
                            });
                        }
                    });
                });
            },
            error: function() {
                console.log("failed data request");
            }
        });
    });
    $('#cariuser').keyup(function() {
        let key = $(this).val();
        $.ajax({
            url: url_user + "user/cariuser",
            data: {
                id: key
            },
            method: 'post',
            success: function(data) {
                $('.table_user').html(data);
                $('.hapususer').on("click", function() {
                    Swal.fire({
                        title: 'Yakin menghapus user ini?',
                        text: "Data akan dihapus secara permanen",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#addbc1',
                        cancelButtonColor: '#1e84d4',
                        confirmButtonText: 'Ya, Hapus saja!',
                        cancelButtonText: 'Tidak',
                    }).then((result) => {
                        let id_user = $(this).data('id');
                        $.ajax({
                            url: url + "user/hapususer",
                            data: {
                                id: id_user
                            },
                            method: 'post',
                            success: function(data) {
                                if (result.value) {
                                    Swal.fire(
                                        'Dihapus!',
                                        'Data berhasil dihapus.',
                                        'success'
                                    )
                                }
                            }
                        });
                    })
                });
            },
            error: function() {
                console.log("failed data request");
            }
        });
    });
    $('.hapususerghoib').on('click', function() {
        let id_user = $(this).data('id');
        Swal.fire({
            title: 'Yakin menghapus pengguna ini?',
            text: "Data akan dihapus secara permanen",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#addbc1',
            cancelButtonColor: '#1e84d4',
            confirmButtonText: 'Ya, Hapus saja!',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.value) {
                let id_user = $(this).data('id');
                console.log(id_user);
                $.ajax({
                    url: url_user + "user/hapususer",
                    data: {
                        id: id_user
                    },
                    method: 'post',
                    success: function(data) {
                        Swal.fire({
                            title: 'Dihapus!',
                            text: 'Data berhasil dihapus.',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#addbc1',
                            cancelButtonColor: '#1e84d4',
                            confirmButtonText: 'Ya, Hapus saja!',
                            cancelButtonText: 'Tidak',
                        }).then((result) => {
                            location.reload();
                        });
                    }
                });
            }
        });
    });
    $(".menu-user").addClass("active");
    </script>