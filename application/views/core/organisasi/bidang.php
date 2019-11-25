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
                            <h3 class="page-title">Bidang</h3>
                        </div>
                    </div>
                    <?= $message; ?>
                    <!-- End Page Header -->
                    <?php $this->load->view('core/organisasi/table/table-bidang'); ?>
                </div>
                <?php $this->load->view('core/footer'); ?>
            </main>
        </div>
    </div>
    <input type="hidden" value="<?= base_url(); ?>" id="url_bidang">
    <script>
    var url_bidang = $('#url_bidang').val();
    $('.ubah_pejabat').on('click', function() {
        $('.id').val('');
        $('.nama_bidang').html('');
        $('.nama_pejabat').html('');
        $('.kode_bidang').html('');
        $('.tipe').html('');
        $('#exampleModalLabelPejabat').html('');
        $('#pimpinan').prop('checked', false);
        $('#agendaris').prop('checked', false);
        $('#update_koordinator').prop('checked', false);
        $('#update_atasan').prop('checked', false);
        let id = $(this).data('id');
        $.ajax({
            url: url_bidang + "Bidang/getBidangKerja",
            data: {
                id,
                id
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('.send').html('Perbaharui');
                $('#exampleModalLabelPejabat').html("Pengaturan Pejabat");
                $('.id').val(data.bidang[0].id);
                $('.nama_bidang').html(data.bidang[0].nama_bidang);
                if (data.bidang[0].nama != null) {
                    $('.nama_pejabat').html(data.bidang[0].nama);
                } else {
                    $('.nama_pejabat').html('-');
                }
                $('.kode_bidang').html(data.bidang[0].kode_bidang);
                $('.tipe').html(data.bidang[0].tipe);
                if (data.bidang[0].top > 0) {
                    $('#pimpinan').prop('checked', true);
                }
                if (data.bidang[0].agendaris > 0) {
                    $('#agendaris').prop('checked', true);
                }
            },
            error: function() {
                console.log("failed data request");
            }
        });
    });
    $('.ubah_bidang_kerja').on('click', function() {
        $('.pejabat').html('');
        $('.id').val('');
        $('.pejabat').html('');
        $('.namaskpd').val('');
        $('.tipe').val('');
        $('.atasan').val('');
        let id = $(this).data('id');
        console.log(id);
        $.ajax({
            url: url_bidang + "Bidang/getbidangkerja",
            data: {
                id,
                id
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('.send').html('Perbaharui');
                $('.id').val(data.bidang[0].id);
                if (data.bidang[0].nama != null) {
                    $('.pejabat').html(data.bidang[0].nama);
                } else {
                    $('.pejabat').html('-');
                }
                $('.namaskpd').val(data.bidang[0].nama_bidang);
                $('.update_tipe').val(data.bidang[0].tipe);
                $('.kode_bidang').val(data.bidang[0].kode_bidang);
                $('.atasan').val(data.bidang[0].atasan);
            },
            error: function() {
                console.log("failed data request");
            }
        });
    });
    $(".menu-bidang").addClass("active");
    </script>