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
                            <h3 class="page-title">Karyawan</h3>
                        </div>
                    </div>
                    <!-- End Page Header -->
                    <?= $message; ?>
                    <?php $this->load->view('core/organisasi/table/table-karyawan'); ?>
                </div>
                <?php $this->load->view('core/footer'); ?>
            </main>
        </div>
    </div>
    <input type="hidden" value="<?= base_url(); ?>" id="url_karyawan">
    <script>
    $('#form_pegawai').on('hidden.bs.modal', function(e) {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end()
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end()
            .find("#blah")
            .attr('src', '')
            .end()
            .find('.send')
            .val('Kirim')
            .end();
    });
    $(".menu-karyawan").addClass("active");
    var url_karyawan = $('#url_karyawan').val();

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#customFile").change(function() {
        readURL(this);
        var path = this.value;
        var filename = path.replace(/^.*\\/, "");
        document.getElementById("imgValue").value = filename.split(' ').join('_');
        document.getElementById("imgName").value = filename.split(' ').join('_');
    });
    $('.editData').on('click', function() {
        $('#blah').attr('src', "");
        let id = $(this).data('id');
        $.ajax({
            url: url_karyawan + "Karyawan/getKaryawan",
            data: {
                id: id
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#imgValue').val(data.pejabat[0].image);
                $('#imgName').val(data.pejabat[0].image);
                $('.nip').val(data.pejabat[0].nip);
                $('.status').val('asn');
                $('.iduser').val(data.pejabat[0].no);
                $('.nama').val(data.pejabat[0].nama);
                $('.pangkat').val(data.pejabat[0].pangkat);
                $('.golongan').val(data.pejabat[0].golongan);
                $('.send').val('Perbaharui');
                $('#blah').attr('src', url_karyawan + 'assets/image/pns/' + data.pejabat[0].image);
            },
            error: function() {
                console.log("failed data request");
            }
        });
    });
    $('.aktifkan_user').on('click', function() {
        let id_account = $(this).data('id');
        console.log(id_account);
        $.ajax({
            url: url_karyawan + "Karyawan/getAccountKaryawan",
            data: {
                id_account: id_account
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('.nip').val(data.nip[0].nip);
                $('.username').val(data.account[0].username);
                $('.password').val(data.account[0].password);
            },
            error: function() {
                console.log("failed data request");
            }
        });
    });
    </script>