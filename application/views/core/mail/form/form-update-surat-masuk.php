<style>
label,
input {
    font-size: 14px;
    color: #000;
}
</style>
<div class="card">
    <h5 class="card-header border-bottom font-weight-bold">Form Pembaharuan Surat Masuk</h5>
    <div class="card-body">
        <?= form_open_multipart('surat/updatesuratmasuk'); ?>
        <form action="">

            <div class="form-group">
                <label for="asal_surat" style="font-size: 13px;">Asal Surat <sup class="text-danger">*</sup></label>
                <input type="text" name="asal_surat" class="form-control asal_surat text-capitalize" id="asal_surat"
                    data-toggle="tooltip" data-placement="top" title="Isilah dengan instansi pengirim surat" required
                    placeholder="Sekretariat Daerah Kabupaten Ciamis ..." autocomplete="off"
                    value="<?= $surat[0]->asal_surat; ?>">
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="no_surat" style="font-size: 13px;">Nomor Surat <sup
                                class="text-danger">*</sup></label>
                        <input type="text" name="nomor_surat" class="form-control no_surat" id="no_surat"
                            data-toggle="tooltip" data-placement="top" title="Input dengan nomor surat masuk." required
                            placeholder="123/123/..." autocomplete="off" value="<?= $surat[0]->nomor_surat; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="waktu" style="font-size: 13px;">Tanggal Surat <sup
                                class="text-danger">*</sup></label>
                        <input type="text" name="waktu" class="form-control waktu text-uppercase" id="waktu"
                            autocomplete="off" required placeholder="mm/dd/yyyy" value="<?= $surat[0]->tanggal; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="perihal" style="font-size: 13px;">Perihal <sup class="text-danger">*</sup></label>
                        <textarea style="font-size: 13px;" name="perihal" id="perihal" cols="20" rows="2"
                            class="form-control text-capitalize perihal" id="perihal" required
                            placeholder="Undangan ..."><?= $surat[0]->perihal; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="start" style="font-size: 13px;">Tanggal Kegiatan <sup
                                class="text-danger">*</sup></label>
                        <input type="text" name="start" id="start" class="form-control start text-uppercase"
                            autocomplete="off" placeholder="mm/dd/yyyy" value="<?= $surat[0]->mulai_kegiatan; ?>"
                            required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="end" style="font-size: 13px;">Tanggal Selesai Kegiatan <sup
                                class="text-danger">*</sup></label>
                        <input type="text" name="end" id="end" class="form-control end text-uppercase"
                            autocomplete="off" placeholder="mm/dd/yyyy" value="<?= $surat[0]->akhir_kegiatan; ?>"
                            required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label style="font-size: 13px;">Waktu Kegiatan <sup class="text-danger">*</sup></label>
                        <div class="input-group">
                            <input type="text" name="waktu_kegiatan" id="waktu_kegiatan"
                                class="form-control waktu_kegiatan text-uppercase" autocomplete="off"
                                placeholder="09.00" value="<?= $surat[0]->waktu_kegiatan; ?>" required>
                            <div class="input-group-append input-group-sm">
                                <span class="input-group-text input-group-sm" id="basic-addon2"
                                    style="font-size: 11px;">WIB</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="tempat_pelaksanaan" style="font-size: 13px;">Tempat Kegiatan <sup
                        class="text-danger">*</sup></label>
                <input type="text" name="tempat_pelaksanaan" id="tempat_pelaksanaan"
                    class="form-control tempat_pelaksanaan text-capitalize" autocomplete="off"
                    placeholder="Jln. Raya Ciamis ..." value="<?= $surat[0]->tempat; ?>" required>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <input type="hidden" name="nomor_surat_awal" class="form-control nomor_surat_awal"
                            id="nomor_surat_awal" required autocomplete="off" value="<?= $surat[0]->nomor_surat; ?>">
                    </div>
                </div>
            </div>
    </div>
    <div class="modal-footer">
        <div class="mr-auto">
            <a href="<?= base_url(); ?>home/suratmasuk" class="btn btn-light font-weight-bold"
                data-dismiss="modal">Batalkan</a>
        </div>
        <button type="submit" class="btn btn-primary font-weight-bold" id="submit-surat-masuk"
            value="submit-surat-masuk"> Perbaharui</button>

    </div>
    </form>
</div>