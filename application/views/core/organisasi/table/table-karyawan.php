<style>
.btn-custome {
    padding: 2px 5px;
}
</style>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow">
            <div class="card-header border-bottom">
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <h5 class="m-0 font-weight-bold text-center text-sm-left">Karyawan</h5>
                    </div>
                    <div class="col-lg-6 ml-auto text-center text-sm-right">
                        <a href="#" class="text-xs font-weight-bold text-capitalize mb-1 btn btn-primary btn-sm"
                            data-toggle="modal" data-target="#form_pegawai" class="tambah_pegawai"
                            id="tambah_pegawai">Tambah <span class="badge badge-light font-weight-bold ml-2"
                                style="font-size: 11px;"><?= count($countKaryawan); ?></span></a></a>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tbody>
                        <?php if (count($karyawan) > 0) { ?>
                        <?php
                                foreach ($karyawan as $key) { ?>
                        <tr class="h6 text-capitalize">
                            <td>
                                <img class="    rounded-circle"
                                    src="<?= base_url('assets/image/pns/' . $key->image); ?>" alt=""
                                    style="width: 45px; height: 45px;"></td>
                            <td class="text-dark" style="font-size: 14px;">
                                <div>
                                    Nama : <span class="font-weight-bold text-primary "
                                        style="font-size: 14px;"><?= $key->nama; ?></span> Pangkat : <span
                                        class="font-weight-bold text-primary"><?= $key->pangkat; ?></span>, Golongan :
                                    <span class="font-weight-bold text-primary"><?= $key->golongan; ?></span>
                                </div>
                                <a href="#" data-id="<?= $key->nip; ?>"
                                    class="aktifkan_user btn btn-sm btn-primary font-weight-bold btn-custome"
                                    data-toggle="modal" data-target="#form_create_user"
                                    style="text-decoration: none;">Akun
                                </a>
                                <a href="#" data-id="<?= $key->nip; ?>"
                                    class="editData btn btn-sm btn-light font-weight-bold btn-custome"
                                    data-toggle="modal" data-target="#form_pegawai"
                                    style="text-decoration: none;">perbaharui</a>
                                <a href="<?= base_url("karyawan/deleteKaryawan/" . $key->slug); ?>"
                                    onclick="javascript: return confirm('Anda yakin hapus ?')" data-toggle="tooltip"
                                    data-placement="top" title="Hapus Bidang"
                                    class="btn btn-sm btn-default font-weight-bold text-danger btn-custome"
                                    style="text-decoration: none;">Hapus</a>
                            </td>
                            <td class="text-primary" style="font-size: 20px;">
                                <?php if ($key->aktifasi_app > 0) { ?>
                                <i class="material-icons">verified_user</i>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php
                                }
                            } else { ?>
                        <tr>
                            <td class="text-capitalize">
                                tabel kosong
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>
    <?php $this->load->view('core/organisasi/modal/modal-karyawan'); ?>
</div>