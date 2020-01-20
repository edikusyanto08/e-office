<!-- modal nota dinas -->
<div class="modal fade bd-example-modal-lg redisposisi" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true" style="font-size: 14px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="text-dark">Form Redisposisi</span>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?php echo form_open('Surat/redisposisi'); ?>
            <div class="modal-body">
                <input type="hidden" name="nomor_surat" class="form-control form-control-sm nomor_surat">
                <h6>Informasi</h6>
                <table class="table table-borderless table-sm" style="font-size: 14px;">
                    <tr>
                        <td style="width: 20%;">
                            No. Surat
                        </td>
                        <td style="width: 1%;">:</td>
                        <td style="color: #000;">
                            <span class="info_no_surat get_info_no_surat">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Diterima
                        </td>
                        <td>:</td>
                        <td style="color: #000;">
                            <span class="info_waktu_surat_masuk"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Perihal
                        </td>
                        <td>:</td>
                        <td class="text-capitalize" style="color: #000;">
                            <span class="info_perihal"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Asal Surat
                        </td>
                        <td>:</td>
                        <td class="text-capitalize" style="color: #000;">
                            <span class="info_asal_surat"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Lampiran
                        </td>
                        <td>:</td>
                        <td style="color: #000;">
                            <span class="info_jumlah_dokumen"></span>
                        </td>
                    </tr>
                </table>
                <h6>Disposisi Ke</h6>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tujuan">Penerima <sup class="text-danger">*</sup></label>
                            <select class="custom-select custom-select-sm" id="tujuan" name="penerima_redisposisi">
                                <option value="0">Pilih Disposisi</option>
                                <?php foreach ($redisposisi as $obj) { ?>
                                <option value="<?= $obj->kode_struktur_organisasi; ?>"><?= $obj->nama; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-sm btn-primary font-weight-bold sendRedisposisi" value="Simpan">
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>