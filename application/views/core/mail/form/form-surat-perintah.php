<style>
label,
input {
    font-size: 14px;
    color: #000;
}
</style>
<div class="card">
    <h5 class="card-header border-bottom font-weight-bold">Form Surat Perintah</h5>
    <div class="card-body">
        <p style="font-size: 14px;">
            <span class="text-danger">* Penting <br>
                - Apabila dibutuhkan surat perintah maka isi form surat perintah <br>
                - Apabila dibutuhkan surat perjalanan dinas maka isi form surat perintah dan form surat perjalanan dinas
                <br>
                - Apabila tidak dibutuhkan surat perintah & surat perjalanan dinas maka user dapat langsung menekan /
                klik skip.
            </span>
        </p>
        <?= form_open('Surat/createSuratPerintah'); ?>
        <form action="">
            <h6 class="font-weight-bold">Form SP (Surat Perintah)</h6>
            <p style="font-size: 12px; text-transform: capitalize;">
                Surat perintah dikeluarkan oleh dinas melalui sekretariat dinas dan diverifikasi oleh sekretariat dinas
                dan telah disetujui oleh kepala dinas.
            </p>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="no_perintah">No. Perintah</label>
                        <input type="text" class="form-control" id="no_perintah" placeholder="123/123/123/..."
                            name="no_perintah">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="slug" name="slug" value="<?= $slug; ?>">
                    </div>
                </div>
            </div>
            <hr>
            <h6 class="font-weight-bold">Form SPD (Surat Perjalanan Dinas)</h6>
            <p style="font-size: 12px; text-transform: capitalize;">
                Surat perjalanan dinas dikeluarkan oleh dinas melalui sekretariat dinas dan diverifikasi oleh
                sekretariat dinas dan telah disetujui oleh kepala dinas.
            </p>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="no_perjalanan_dinas">No. Perjalanan Dinas</label>
                        <input type="text" class="form-control" id="no_perjalanan_dinas" placeholder="123/123/123/..."
                            name="no_perjalanan">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4    ">
                    <label for="kendaraan">Kendaraan</label>
                    <select class="custom-select" id="kendaraan" name="kendaraan">
                        <option value="Mobil Dinas">Mobil Dinas / Kendaraan Dinas</option>
                        <option value="Angkutan Umum">Angkutan Umum</option>
                        <option value="Kendaraan Pribadi">Kendaraan Pribadi</option>
                        <option value="Kabupaten/Kota Lain">Kabupaten/Kota Lain</option>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="keberangkatan">Tanggal Berangkat</label>
                        <input type="text" class="form-control" id="keberangkatan" placeholder="MM/DD/YYYY"
                            name="keberangkatan">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="kepulangan">Tanggal Kepulangan</label>
                        <input type="text" class="form-control" id="kepulangan" placeholder="MM/DD/YYYY"
                            name="kepulangan">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="tujuan">Tujuan Perjalanan</label>
                        <input type="text" class="form-control text-capitalize" id="tujuan"
                            placeholder="menghadiri undangan" name="tujuan">
                    </div>
                </div>
            </div>
    </div>
    <div class="modal-footer">
        <a href="<?= base_url('Surat/tanpaSuratPerintah/' . $agenda_surat[0]->slug_surat); ?>"
            class="float-left btn btn-dark btn-sm">Skip</a>
        <a href="<?= base_url(); ?>home/Pengagendaan" class="btn btn-light btn-sm mr-auto" data-dismiss="modal">
            Batalkan</a>
        <button type="submit" class="btn btn-primary btn-sm simpanNotaDinas"><i class="fas fa-cloud-upload-alt"></i>
            Simpan </button>
    </div>
    </form>
    <?= form_close(); ?>
</div>