<style>
label,
input {
    font-size: 14px;
    color: #000;
}
</style>
<div class="card">
    <h5 class="card-header border-bottom font-weight-bold">Form Nota Dinas</h5>
    <div class="card-body">
        <?= form_open_multipart('surat/createNotaDinas'); ?>
        <form action="">
            <input type="hidden" name="nomor_agenda" class="agenda" value="<?= $info_file[0]->nomor_agenda; ?>">
            <div class="form-group">
                <label for="no_nota" class="text-dark">Nomor Nota Dinas</label>
                <input type="text" class="form-control" autocomplete="off" name="no_nota" value="<?php if ($info_file[0]->nota != null) {
                                                                                                        echo $info_file[0]->nota;
                                                                                                    } ?>">
            </div>
            <div class="form-group">
                <label for="isi" class="text-dark">Laporan</label>
                <textarea name="laporan" id="nota_dinas" class="form-control" name="laporan" rows="15"
                    cols="40"><?php if ($info_file[0]->nota != null) {
                                                                                                                        echo $nota_dinas[0]->laporan;
                                                                                                                    } ?></textarea>
            </div>
            <div class="form-group">
                <label for="upload">Upload Berkas</label>
                <div class="mb-3">
                    <input type="file" name="userfile[]" multiple="multiple">
                </div>
            </div>
            <div class="form-group">
                <label for="Uploaded">Berkas Terupload</label>
                <div>
                    <?php
                    foreach ($lampiran as $key) { ?>
                    <img src="<?= base_url('assets/file/nota-dinas/' . $key->nama_file); ?>" alt="text"
                        class="img img-thumbnail mb-1" style="width: 150px; height: 150px;">
                    <?php } ?>
                </div>
            </div>
            <label class="mb-2">Tembusan</label>
            <?php $i = 0;
            foreach ($bidang as $key) { ?>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" value="<?= $key->nip; ?>"
                    id="<?= $key->nama_bidang; ?>" name="tembusan[]">
                <label class="custom-control-label text-capitalize text-dark" for="<?= $key->nama_bidang; ?>"
                    style="font-size: 12px;">
                    <?= $key->nama_bidang; ?>
                </label>
            </div>
            <?php $i++;
            } ?>
    </div>
    <div class="modal-footer">
        <a href="javascript:history.go(-1)" style="font-size: 12px;"
            class="float-left mr-auto font-weight-bold">Kembali</a>
        <button type="submit" class="btn btn-primary btn-sm simpanNotaDinas font-weight-bold" value="Perbaharui"
            name="send">Perbaharui</button>
        <button type="button" class="btn btn-light btn-sm batalkanNotaDinas font-weight-bold"
            data-dismiss="modal">Batalkan</button>
    </div>
    </form>
    <?= form_close(); ?>
</div>
<script>
$(document).ready(function() {
    let nomor_agenda = $('.agenda').val();
    console.log(nomor_agenda);
    $.ajax({
        url: base_url +
            "Surat/getTembusanNotaDinas",
        data: {
            id: nomor_agenda
        },
        method: 'post',
        dataType: 'json',
        success: function(data) {
            $(':checkbox:checked').each(function(i) {
                val[i] = $(this).val();
            });
        },
        error: function() {
            console.log('data was not found');
        }
    });
});
</script>