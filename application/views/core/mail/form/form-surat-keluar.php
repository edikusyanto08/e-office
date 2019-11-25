<style>
label,
input {
    font-size: 14px;
    color: #000;
}
</style>
<div class="card">
    <h5 class="card-header border-bottom font-weight-bold">Form Surat Keluar</h5>
    <div class="card-body">
        <?= form_open_multipart('surat/createSuratKeluar'); ?>
        <form>
            <input type="hidden" name="nomor_agenda" class="agenda">
            <div class="form-group">
                <label for="no_surat_keluar" class="text-dark">Nomor Surat</label>
                <input type="text" class="form-control" autocomplete="off" id="nomor_surat_keluar"
                    name="nomor_surat_keluar" placeholder="XX/XX/XX" required>
            </div>
            <div class="form-group">
                <label for="jenis" class="text-dark">Diperuntukan</label>
                <div class="row col-lg-3">
                    <select class="custom-select" id="jenis" name="jenis">
                        <option value="1">Internal Instansi</option>
                        <option value="2">External Instansi</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="perihal" class="text-dark">Perihal</label>
                <input type="text" class="form-control" autocomplete="off" name="perihal" placeholder="Undangan"
                    required>
            </div>
            <div class="form-group">
                <label for="nota_dinas" class="text-dark">Isi Surat</label>
                <textarea name="isi" id="nota_dinas" class="form-control" name="isi" rows="40" cols="40"></textarea>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="start">Tanggal Kegiatan <sup class="text-danger">*</sup></label>
                        <input type="text" name="start" id="start" class="form-control start" autocomplete="off"
                            placeholder="mm/dd/yyyy" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="end">Tanggal Selesai Kegiatan <sup class="text-danger">*</sup></label>
                        <input type="text" name="end" id="end" class="form-control end" autocomplete="off"
                            placeholder="mm/dd/yyyy" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Waktu Kegiatan <sup class="text-danger">*</sup></label>
                        <div class="input-group">
                            <input type="text" name="waktu_kegiatan" id="waktu_kegiatan"
                                class="form-control waktu_kegiatan" autocomplete="off" placeholder="09.00" required>
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
                <input type="text" name="tempat_pelaksanaan" id="tempat_pelaksanaan"
                    class="form-control tempat_pelaksanaan" autocomplete="off" placeholder="Jln. Raya Ciamis ..."
                    required>
            </div>
            <div class="form-group">
                <label for="upload">Upload Lampiran</label>
                <div class="mb-3">
                    <input type="file" name="userfile[]" multiple="multiple">
                </div>
            </div>
            <div class="form-group">
                <label for="no_nota" class="text-dark">Cari Penerima Surat</label>
                <div class="form-group">
                    <div class="form-group">
                        <input type="text" class="form-control " autofocuss autocomplete="off"
                            laceholder="Cari Penerima Disposisi Surat" id="cariPNSSuratKeluar"
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
                        id="reset-disposisi">Reset</button>
                </p>
            </div>
    </div>
    <div class="modal-footer">
        <a href="javascript:history.go(-1)" style="font-size: 12px;"
            class="float-left mr-auto font-weight-bold">Kembali</a>
        <input type="submit" class="btn btn-primary btn-sm simpanNotaDinas font-weight-bold" value="Simpan" name="send">
    </div>
    </form>
</div>