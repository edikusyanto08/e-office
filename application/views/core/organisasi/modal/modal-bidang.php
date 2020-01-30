<style>
    label{
        font-size: 14px;
    }
</style>
<!-- form tambah bidang kerja -->
<div class="modal fade" id="tambah_bidang_kerja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title font-weight-bold text-uppercase" id="exampleModalLabel">Form Unit Kerja</h6>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('Bidang/addBidangKerja'); ?>
                <form>
                    <input type="hidden" name="id" class="id">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="namaskpd">Nama Unit Kerja  <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="namaskpd" name="nama" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <label for="tipe">Tipe Unit Kerja <span class="text-danger">*</span></label>
                            <table class="table table-borderless table-sm">
                                <td>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="radio" id="formsRadioStruktural" name="tipe" class="custom-control-input" value="struktural" checked>
                                        <label class="custom-control-label " for="formsRadioStruktural">Struktural</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="radio" id="formsRadioPelaksana" name="tipe" class="custom-control-input" value="pelaksana">
                                        <label class="custom-control-label" for="formsRadioPelaksana">Pelaksana</label>
                                    </div>
                                </td>
                            </table>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label for="koordinator">Pilih Pejabat</label>
                            <select class="custom-select" id="koordinator" name="koordinator">
                                <option value="0">Tanpa Pejabat</option>
                                <?php foreach ($karyawan as $key) { ?>
                                <option value="<?= $key->nip; ?>"><?= $key->nama; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="atasan">Pilih Atasan</label>
                                <select class="custom-select" id="atasan" name="atasan">
                                    <option class="text-capitalize" value="0">Tidak Ada</option>
                                    <?php foreach ($atasan as $key) { ?>
                                    <option class="text-uppercase" value="<?= $key->kode_struktur_organisasi; ?>">
                                        <span>
                                            <?= $key->nama_bidang; echo ' - ' . $key->nama_instansi . " - " . $key->kode_bidang  ?>
                                        </span>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm font-weight-bold send">Simpan</button>
                </form>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- form ubah pejabat -->
<div class="modal fade" id="ubah_pejabat_bidang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title font-weight-bold text-uppercase" id="exampleModalLabelPejabat">Pejabat Baru</h6>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?= validation_errors(); ?>
            <?= form_open('Bidang/ubahPejabatBidang'); ?>
            <form>
                <div class="modal-body">
                    <input type="hidden" name="id" class="id">
                    <table class="table table-sm table-borderless" style="font-size: 14px;">
                        <tr>
                            <td style="width: 30%;">Nama Unit Kerja</td>
                            <td style="width: 3%;">:</td>
                            <td class="text-capitalize"><span class="nama_bidang"></span></td>
                        </tr>
                        <tr>
                            <td>Nama Pejabat</td>
                            <td>:</td>
                            <td><span class="nama_pejabat"></span></td>
                        </tr>
                        <tr>
                            <td>Tipe Unit Kerja</td>
                            <td>:</td>
                            <td><span class="tipe text-capitalize"></td>
                        </tr>
                        <tr>
                            <td>Kode Unit Kerja</td>
                            <td>:</td>
                            <td><span class="kode_bidang"></span></td>
                        </tr>
                    </table>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="koordinator" style="font-size: 14px;" class="text-dark">Apakah User ini Berhak Menerima Surat Masuk / Tembusan?</label>
                            <div class="input-group ml-4">
                                <input type="checkbox" name="pimpinan" value="1" id="pimpinan" class="form-check-input">
                                <label class="form-check-label" for="pimpinan" style="font-size: 13px;">
                                    Ya
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="koordinator" style="font-size: 14px;" class="text-dark">Apakah User ini Berhak Melakukan Pengagendaan Surat?</label>
                            <div class="input-group ml-4">
                                <input type="checkbox" name="agendaris" value="1" id="agendaris" class="form-check-input">
                                <label class="form-check-label" for="agendaris" style="font-size: 13px;">
                                    Ya
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="koordinator" style="font-size: 14px;" class="text-dark">Pilih Pejabat Pengganti : </label>
                                <select class="custom-select" id="koordinator" name="koordinator">
                                    <option value="0">Pilih Pejabat</option>
                                    <?php foreach ($karyawan as $pjb) { ?>
                                    <option value="<?= $pjb->nip; ?>"><?= $pjb->nama; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="input-group ml-4">
                                <input type="checkbox" name="update_koordinator" value="1" id="update_koordinator" class="form-check-input">
                                <label class="form-check-label" for="update_koordinator" style="font-size: 13px;">
                                    Ya, Perbaharui Pejabat
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="atasan" style="font-size: 14px;" class="text-dark">Pilih Atasan : </label>
                                <select class="custom-select" id="atasan" name="atasan">
                                    <option class="text-capitalize" value="0">Pilih Atasan</option>
                                    <?php foreach ($atasan as $key) { ?>
                                    <option class="text-uppercase" value="<?= $key->kode_struktur_organisasi; ?>">
                                        <span><?= $key->nama_bidang; echo ' - ' . $key->nama_instansi . " - " . $key->kode_bidang  ?>
                                        </span>
                                    </option>
                                    <?php } ?>
                                   
                                </select>
                            </div>
                            <div class="input-group ml-4">
                                <input type="checkbox" name="update_atasan" value="1" id="update_atasan" class="form-check-input">
                                <label class="form-check-label" for="update_atasan" style="font-size: 13px;">
                                    Ya, Perbaharui Atasan
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary font-weight-bold send">Ubah</button>
                </div>
            </form>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<!-- form edit bidang kerja -->
<div class="modal fade" id="ubah_bidang_kerja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title font-weight-bold text-uppercase" id="exampleModalLabel">Perbaharui Bidang</h6>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?= validation_errors(); ?>
                <?= form_open('Bidang/updateBidangKerja'); ?>
                <form>
                    <input type="hidden" name="id" class="id">
                    <div class="row " style="font-size: 14px;">
                        <div class="col-lg-6">
                            <label for="kode_bidang">Pejabat</label>
                            <div><span class="pejabat"></span></div>
                        </div>
                    </div>
                    <hr>
                    <div class="row" style="font-size: 14px; ">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="namaskpd">Nama Unit Kerja <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control namaskpd" id="namaskpd" name="nama" autocomplete="off" required>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="tipe">Tipe Jabatan</label>
                            <select class="custom-select update_tipe" id="tipe" name="tipe">
                                <option value="struktural">Struktural</option>
                                <option value="pelaksana">Pelaksana</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary font-weight-bold send">Submit</button>
                </form>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>