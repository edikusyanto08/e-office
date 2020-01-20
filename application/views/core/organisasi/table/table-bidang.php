<style>
.btn-custome {
    padding: 2px 5px;
}
</style>
<div class="row">
    <div class="col-lg-auto col-lg-12 mb-3">
        <div class="card shadow">
            <div class="card-header border-bottom">
                <div class="row">
                    <div class="col-lg-2">
                        <h5 class="m-0 font-weight-bold text-center text-uppercase text-sm-left mb-3">Unit Kerja</h5>
                        
                    </div>
                    <div class="col-lg-10 text-center text-sm-right">
                        <a href="#"
                            class="text-xs font-weight-bold text-capitalize mb-1 btn btn-primary btn-sm tambah_bidang_kerja"
                            data-toggle="modal" data-target="#tambah_bidang_kerja">Tambah <span
                                class="badge badge-light font-weight-bold ml-2"
                                style="font-size: 11px;"><?= count($countBidang) - count($pasif); ?></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless" style="line-height: 25px;">
                    <tbody>
                        <?php if ($bidang != null) { ?>
                        <?php $i = 1;
                                foreach ($bidang as $key) { ?>
                        <?php if ($key->jumlah_atasan <= '1') { ?>
                        <tr>
                            <td colspan="2">
                                Kode - <?= $key->kode_bidang; ?>
                            </td>
                        </tr>
                        <?php } ?>
                        <tr class="text-capitalize">
                            <td class="text-center" style="width: 4%; ">
                                <img src="<?= base_url('assets/image/pns/') . $key->image; ?>" alt=""
                                    style="width: 45px; height: 45px;" class="rounded-circle">
                            </td>
                            <td class="text-dark" style="font-size: 14px;"><span
                                    class="text-uppercase"><?= $key->nama_bidang; ?> - </span>
                                <span class="text-primary"><?= $key->tipe; ?></span><br>
                                <div>
                                    <a href="#" data-id="<?= $key->id; ?>"
                                        class="ubah_pejabat text-capitalize btn btn-sm btn-primary font-weight-bold mb-1 btn-custome"
                                        data-toggle="modal" data-target="#ubah_pejabat_bidang"
                                        style="text-decoration: none;">Setting</a>
                                    <a href="#" data-id="<?= $key->id; ?>"
                                        class="ubah_bidang_kerja  text-capitalize btn btn-sm btn-light  mb-1 font-weight-bold  btn-custome"
                                        data-toggle="modal" data-target="#ubah_bidang_kerja"
                                        style="text-decoration: none;">perbaharui</a>
                                    <a href="<?= base_url("bidang/hapusbidangkerja/" . $key->id); ?>"
                                        onclick="javascript: return confirm('Anda yakin hapus ?')" data-toggle="tooltip"
                                        data-placement="top" title="Hapus Bidang"
                                        class="text-capitalize btn btn-sm btn-default mb-1  font-weight-bold text-danger btn-custome"
                                        style="text-decoration: none;">Hapus</a>
                                </div>
                            </td>
                        </tr>
                        <?php $i++;
                                } ?>
                        <?php } else { ?>
                        <tr>
                            <td>Tabel Kosong</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-header border-bottom">
                <h5 class="m-0 font-weight-bold text-uppercase">Unit Kerja Tanpa Pejabat </h5>
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless" style="line-height: 30px;">
                    <tbody>
                        <?php if ($pasif != null) { ?>
                        <tr class="font-weight-bold">
                            <td class="text-center" style="width: 5%;">
                                Kode
                            </td>
                            <td>
                                Nama Bidang
                            </td>
                        </tr>
                        <?php $i = 1;
                                foreach ($pasif as $key) { ?>
                        <tr class=" text-capitalize">
                            <td class="text-center"> <?= $key->kode_bidang; ?></td>
                            <td class="text-dark" style="font-size: 14px;"><span
                                    class="text-uppercase"><?= $key->nama_bidang; ?></span>
                                <br>
                                <a href="#" data-id="<?= $key->id; ?>"
                                    class="ubah_pejabat text-capitalize btn btn-sm btn-primary font-weight-bold mb-1  btn-custome"
                                    data-toggle="modal" data-target="#ubah_pejabat_bidang"
                                    style="text-decoration: none;">Setting</a>
                                <a href="#" data-id="<?= $key->id; ?>"
                                    class="ubah_bidang_kerja  text-capitalize btn btn-sm btn-light mb-1  font-weight-bold  btn-custome"
                                    data-toggle="modal" data-target="#ubah_bidang_kerja"
                                    style="text-decoration: none;">Pebaharui</a>
                                <a href="<?= base_url("bidang/hapusbidangkerja/" . $key->id); ?>"
                                    onclick="javascript: return confirm('Anda yakin hapus ?')" data-toggle="tooltip"
                                    data-placement="top" title="Hapus Bidang"
                                    class="text-capitalize btn btn-sm btn-default font-weight-bold text-danger mb-1 btn-custome"
                                    style="text-decoration: none;">Hapus</a>
                            </td>
                        </tr>
                        <?php $i++;
                                } ?>
                        <?php } else { ?>
                        <tr>
                            <td>Tabel Kosong</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php $this->load->view('core/organisasi/modal/modal-bidang'); ?>
</div>