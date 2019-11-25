<div class="card-body">
    <?= form_open_multipart('surat/updateSuratKeluar'); ?>
    <form>
        <input type="hidden" value="<?= $surat_keluar[0]->id_surat_keluar; ?>" name="id_surat_keluar">
        <input type="hidden" value="<?= $surat_keluar[0]->nomor_surat_keluar; ?>" name="old_nomor_surat_keluar">
        <div class="form-group">
            <label for="no_surat_keluar" class="text-dark">Nomor Surat</label>
            <input type="text" class="form-control" autocomplete="off" id="nomor_surat_keluar" name="nomor_surat_keluar"
                placeholder="XX/XX/XX" value="<?= $surat_keluar[0]->nomor_surat_keluar; ?>" required>
        </div>
        <div class="form-group">
            <label for="perihal" class="text-dark">Perihal</label>
            <input type="text" class="form-control" autocomplete="off" name="perihal" placeholder="Undangan"
                value="<?= $surat_keluar[0]->perihal; ?>" required>
        </div>
        <div class="form-group">
            <label for="nota_dinas" class="text-dark">Isi Surat</label>
            <textarea name="isi" id="nota_dinas" class="form-control" name="isi" rows="20"
                cols="40"><?= $surat_keluar[0]->isi; ?></textarea>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="start">Tanggal Kegiatan <sup class="text-danger">*</sup></label>
                    <input type="text" name="start" id="start" class="form-control start" autocomplete="off"
                        placeholder="mm/dd/yyyy" value="<?= $surat_keluar[0]->mulai_kegiatan; ?>" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="end">Tanggal Selesai Kegiatan <sup class="text-danger">*</sup></label>
                    <input type="text" name="end" id="end" class="form-control end" autocomplete="off"
                        placeholder="mm/dd/yyyy" value="<?= $surat_keluar[0]->akhir_kegiatan; ?>" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Waktu Kegiatan <sup class="text-danger">*</sup></label>
                    <div class="input-group">
                        <input type="text" name="waktu_kegiatan" id="waktu_kegiatan" class="form-control waktu_kegiatan"
                            autocomplete="off" placeholder="09.00" value="<?= $surat_keluar[0]->waktu_kegiatan; ?>"
                            required>
                        <div class="input-group-append input-group-sm">
                            <span class="input-group-text input-group-sm" id="basic-addon2"
                                style="font-size: 11px;">WIB</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="tempat_pelaksanaan">Tempat Kegiatan <sup class="text-danger">*</sup></label>
            <input type="text" name="tempat_pelaksanaan" id="tempat_pelaksanaan" class="form-control tempat_pelaksanaan"
                autocomplete="off" placeholder="Jln. Raya Ciamis ..." value="<?= $surat_keluar[0]->tempat; ?>" required>
        </div>
        <div class="form-group">
            <label for="upload">Upload Lampiran</label>
            <div class="mb-3">
                <input type="file" name="userfile[]" multiple="multiple">
            </div>
        </div>
        <div class="form-group">
            <label for="no_nota">Cari Penerima Surat</label>
            <div class="form-group">
                <div class="form-group">
                    <input type="text" class="form-control " autofocuss autocomplete="off"
                        laceholder="Cari Penerima Disposisi Surat" id="cariPNS"
                        placeholder="Tulis instansi / Jabatan Penerima Surat">
                </div>
                <div id="result"></div>
            </div>
            <label for="penerima">Daftar Calon Penerima Surat Keluar</label>
            <table class="table table-sm">
                <tbody id="tbl_result"></tbody>
            </table>
            <br>
            <p class="text-right">
                <button type="button" class="btn btn-light btn-block btn-sm resetDisposisi font-weight-bold"
                    id="reset-disp  osisi">Reset</button>
            </p>
        </div>
</div>
<div class="modal-footer">
    <input type="submit" class="btn btn-primary btn-block simpanNotaDinas font-weight-bold" value="Update" name="send">
</div>
</form>