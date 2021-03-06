<style>
label,
input {
    font-size: 14px;
    color: #000;
}
</style>
<div class="card">
    <div class="card-header border-bottom">
        <div class="row">
            <div class="col-lg-6 m-0 font-weight-bold text-center text-sm-left"><h5 class="font-weight-bold">Form Surat Masuk</h5></div>
            <!-- <div class="col-lg-6 ml-auto text-center text-sm-right"><a href="#" class="btn btn-light ">Petunjuk Pengisian</a></div> -->
        </div>
    </div>
    <div class="card-body">
        <?= validation_errors(); ?>
        <?= form_open_multipart('surat/simpansuratmasuk'); ?>
        <form action="">
            <div class="form-group">
                <label for="asal_surat">Asal Surat <span class="text-danger">*</span></label>
                <input type="text" name="asal_surat" class="form-control asal_surat text-capitalize" id="asal_surat"
                    data-toggle="tooltip" data-placement="top" title="Isilah dengan instansi pengirim surat" required
                    placeholder="Sekretariat Daerah Kabupaten Ciamis ..." autocomplete="off">
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="no_surat">Nomor Surat <span class="text-danger">*</span></label>
                        <input type="text" name="nomor_surat" class="form-control no_surat" id="no_surat"
                            data-toggle="tooltip" data-placement="top" title="Input dengan nomor surat masuk." required
                            placeholder="123/123/..." autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="waktu">Tanggal Surat <span class="text-danger">*</span></label>
                        <input type="text" name="waktu" class="form-control waktu text-uppercase" id="waktu"
                            autocomplete="off" required placeholder="mm/dd/yyyy">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tujuan">Penerima <span class="text-danger">*</span></label>
                        <select class="custom-select " id="tujuan" name="tujuan">
                            <option value="0">Pilih Penerima Surat</option>
                            <?php foreach ($penerima as $obj) { ?>
                            <option value="<?= $obj->kode_struktur_organisasi; ?>" class="text-uppercase"><?= $obj->nama_bidang; ?> - <?= $obj->nama; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="perihal">Perihal <span class="text-danger">*</span></label>
                        <textarea name="perihal" id="perihal" cols="20" rows="2"
                            class="form-control text-capitalize perihal" id="perihal" required
                            placeholder="Undangan ..."></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="start">Tanggal Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" name="start" id="start" class="form-control start text-uppercase"
                            autocomplete="off" placeholder="mm/dd/yyyy" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="end">Tanggal Selesai Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" name="end" id="end" class="form-control end text-uppercase"
                            autocomplete="off" placeholder="mm/dd/yyyy" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Waktu Kegiatan <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="waktu_kegiatan" id="waktu_kegiatan"
                                class="form-control waktu_kegiatan text-uppercase" autocomplete="off"
                                placeholder="09.00" required>
                            <div class="input-group-append input-group-sm">
                                <span class="input-group-text input-group-sm" id="basic-addon2"
                                    style="font-size: 11px;">WIB</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="tempat_pelaksanaan">Tempat Kegiatan <span class="text-danger">*</span></label>
                <input type="text" name="tempat_pelaksanaan" id="tempat_pelaksanaan"
                    class="form-control tempat_pelaksanaan text-capitalize" autocomplete="off"
                    placeholder="Jln. Raya Ciamis ..." required>
            </div>
            <div class="form-group">
                <label>Unggah Dokumen <span class="text-danger">*</span></label>
                <div>
                    <input type="file" name="userfile[]" multiple="multiple">
                </div>
                <small id="uploadHelp" class="form-text text-muted"><i>Lampiran harus berupa file gambar dengan extensi jpg, jpeg atau png, file dapat berisi lebih dari satu.</i></small>
            </div>
    </div>
    <div class="modal-footer">
        <div class="mr-auto">
            <a href="<?= base_url(); ?>home" class="btn btn-light batalkansuratmasuk font-weight-bold"
                data-dismiss="modal">Batalkan</a>
        </div>
        <button type="submit" class="btn btn-primary font-weight-bold" id="submit-surat-masuk"
            value="submit-surat-masuk"> Simpan
        </button>
    </div>
    </form>
</div>