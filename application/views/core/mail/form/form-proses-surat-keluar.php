<style>
a:hover {
    text-decoration: none;
}

table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
}

th,
td {
    text-align: left;
    padding: 8px;
}
</style>

<div class="container-fluid mb-3 bg-white" style=" border: 0px solid white; border-radius: 10px;">
    <div class="row shadow">
        <div class="col" style="overflow-y: auto; ">
            <div style="padding: 20px 0; line-height: 30px;">
                <table class="table table-borderless table-sm"
                    style="margin-bottom: 0px; border: 0px; border-radius: 20px; font-size: 14px;">
                    <tr>
                        <td colspan="6">
                            <span class="font-weight-bold" style="font-size: 18px;">
                                Informasi
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 15%;">Nomor Surat</td>
                        <td style="width: 2%;">:</td>
                        <td style="width: 40%;"><?= $prosessuratkeluar[0]->nomor_surat_keluar; ?></td>
                        <td style="width: 10%;">Dibuat</td>
                        <td style="width: 2%;">:</td>
                        <td style="width: 30%;"><?= $prosessuratkeluar[0]->waktu_membuat; ?> WIB</td>
                    </tr>
                    <tr>
                        <td>Sifat</td>
                        <td>:</td>
                        <td>
                            <?php if ($prosessuratkeluar[0]->jenis == 1) { ?>
                            Internal
                            <?php } elseif ($prosessuratkeluar[0]->jenis == 2) { ?>
                            External
                            <?php } ?>
                        </td>
                        <td>Diperbaharui</td>
                        <td>:</td>
                        <td><?php if ($prosessuratkeluar[0]->waktu_memperbaharui != null) {
                                echo $prosessuratkeluar[0]->waktu_memperbaharui;
                                echo "WIB";
                            } else {
                                echo "-";
                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Perihal</td>
                        <td>:</td>
                        <td><?= $prosessuratkeluar[0]->perihal; ?></td>
                        <td>Status</td>
                        <td>:</td>
                        <td>
                            <?php if ($prosessuratkeluar[0]->izin_atasan != null && $prosessuratkeluar[0]->izin_agendaris != null) { ?>
                            <?php if ($surat_keluar_masuk != null) { ?>
                            <span class="bg-success text-white"
                                style="padding: 3px; font-size: 10px; border-radius: 5px;">Selesai</span>
                            <?php } else { ?>
                            <span class="bg-info text-white"
                                style="padding: 3px; font-size: 10px; border-radius: 5px;">Disetujui</span>
                            <?php } ?>
                            <?php } else { ?>
                            <span class="bg-warning text-white"
                                style="padding: 3px; font-size: 10px; border-radius: 5px;">Produksi</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Penerima</td>
                        <td>:</td>
                        <td colspan="4">
                            <?php foreach ($penerimasurat as $key) { ?>
                            <span class=" text-capitalize" style="line-height: 30px;">
                                <?= $key->nama; ?> <span class="text-primary"><i>(<?= $key->nama_bidang; ?>)</i></span>,
                            </span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <div class="mt-3">
                                <a href="<?= base_url(); ?>home/suratkeluar"
                                    class="btn btn-sm btn-default font-weight-bold text-primary">Kembali</a>
                            </div>
                        </td>
                        <td>
                            <div class="mt-3 text-right">
                                <a href="<?= base_url('surat/getFileSuratKeluar/' . $prosessuratkeluar[0]->slug_surat); ?>"
                                    class="btn btn-sm btn-primary font-weight-bold" target="_blank">Unduh</a>
                                <?php if ($pembuat[0]->nip != $this->session->userdata('sisule_cms_nip')) { ?>
                                <!-- cek apakah izin telah diberikan oleh agendaris atau atasan -->
                                <!-- cek apakah user adalah user atau agendaris -->
                                <?php if (($prosessuratkeluar[0]->izin_atasan != null && $atasan[0]->atasan == $this->session->userdata('sisule_cms_nip'))) { ?>
                                <?php if ($surat_keluar_masuk = null) { ?>
                                <a href="#" class="btn btn-sm btn-success font-weight-bold">Dizinkan</a>
                                <?php } else { ?>
                                <a href="#" class="btn btn-sm btn-dark font-weight-bold">Mengizinkan</a>
                                <?php } ?>
                                <?php } elseif ($prosessuratkeluar[0]->izin_atasan == null && $atasan[0]->atasan == $this->session->userdata('sisule_cms_nip')) { ?>
                                <a href="<?= base_url('surat/izinkansuratkeluar/' . $prosessuratkeluar[0]->slug_surat); ?>"
                                    class="btn btn-sm btn-success font-weight-bold">Izinkan</a>
                                <?php } ?>
                                <?php if ($prosessuratkeluar[0]->izin_agendaris != null && $agendaris[0]->agendaris == 1) { ?>
                                <a href="#" class="btn btn-sm btn-dark font-weight-bold">Mengizinkan</a>
                                <?php } elseif ($prosessuratkeluar[0]->izin_agendaris == null && $agendaris[0]->agendaris == 1) { ?>
                                <a href="<?= base_url('surat/izinkansuratkeluar/' . $prosessuratkeluar[0]->slug_surat); ?>"
                                    class="btn btn-sm btn-success font-weight-bold">Izinkan</a>
                                <?php } ?>
                                <?php } ?>

                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="nav flex-column nav-pills mb-3 bg-white shadow nav-fill" id="v-pills-tab" role="tablist"
            aria-orientation="vertical" style="font-size: 14px; padding: 20px 0px; border-radius: 5px;">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <?php if ($surat_keluar[0]->izin_atasan == null || $surat_keluar[0]->izin_agendaris == null) { ?>
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                        aria-controls="pills-home" aria-selected="false"><span class="badge" style="font-size: 14px;"><i
                                class="fas fa-archive"></i></span>
                        Form</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                        aria-controls="pills-profile" aria-selected="false"><span class="badge"
                            style="font-size: 14px;"><i class="fas fa-comments"></i></span>
                        Komentar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
                        aria-controls="pills-contact" aria-selected="false"><span class="badge"
                            style="font-size: 14px;"><i class="fas fa-paper-plane"></i></span>
                        Kirim</a>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link active" id="pills-contact-tab" data-toggle="pill" href="#pills-contact"
                        role="tab" aria-controls="pills-contact" aria-selected="false"><span class="badge"
                            style="font-size: 14px;"><i class="fas fa-paper-plane"></i></span>
                        Kirim</a>
                </li>
                <?php } ?>
            </ul>
            <?php if ($surat_keluar[0]->izin_atasan == null || $surat_keluar[0]->izin_agendaris == null) { ?>
            <div class="tab-content border-top" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <?php if ($pembuat[0]->nip == $this->session->userdata('sisule_cms_nip')) { ?>
                    <?php $this->load->view('core/mail/pages/surat-keluar-for-pembuat'); ?>
                    <?php } else { ?>
                    <?php $this->load->view('core/mail/pages/surat-keluar-for-stakeholder'); ?>
                    <?php } ?>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <form action="">
                        <div class="row mt-3">
                            <div class="col-lg-12" style="padding: 0 40px;">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Tulis pesan anda disini"
                                        aria-label="Recipient's username " aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <input type="submit" class="btn btn-primary" id="basic-addon2" value="Kirim">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-body">
                                <h5 class="text-uppercase text-center font-weight-bold">
                                    Kirim Surat
                                </h5>
                                <p class="text-center mt-5">
                                    <i class="fas fa-8x fa-lock"></i>
                                </p>
                                <p class="text-center text-capitalize">
                                    Belum Dikirim
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php } else { ?>
            <div class="tab-content border-top" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-contact" role="tabpanel"
                    aria-labelledby="pills-contact-tab">
                    <div class="card-body">
                        <h5 class="text-uppercase text-center font-weight-bold">
                            Kirim Surat
                        </h5>
                        <p class="text-center ">

                            <?php if ($surat_keluar_masuk != null) { ?>
                            <i class="fas fa-8x fa-check-circle text-success mt-5"></i>
                            <?php } else { ?>
                            <?php if ($surat_keluar[0]->pembuat != $this->session->userdata('sisule_cms')) { ?>
                            <a href="<?= base_url('surat/kirimsuratkeluar/' . $surat_keluar[0]->slug_surat); ?>"
                                class="btn btn-primary mt-3">Kirim Surat</a>
                            <?php } ?>
                            <?php } ?>
                        </p>
                        <p class="text-center text-capitalize">
                            <?php if ($surat_keluar_masuk != null) { ?>
                            Sudah Terkirim
                            <?php } else { ?>
                            Belum Terkirim
                            <?php } ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<script>

</script>