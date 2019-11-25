<div class="col-lg-12">
    <div class="card shadow">
        <div class="card-header border-bottom">
            <h5 class="m-0 font-weight-bold">Form</h5>
        </div>
        <div class="card-body">
            <?= form_open('instansi/buatinstansi'); ?>
            <form class="quick-post-form">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="id_instansi">Kode</label>
                            <input type="text" class="form-control" name="id_instansi" required id="id_instansi"
                                placeholder="001"
                                value="<?php if ($param != null) {
                                                                                                                                                echo $param;
                                                                                                                                            } ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama_instansi">Nama Instansi</label>
                    <input type="text" class="form-control" name="nama_instansi" required id="nama_instansi"
                        placeholder="nama lengkap instansi">
                </div>
                <div class="form-group">
                    <label for="singkatan">Singkatan</label>
                    <input type="text" class="form-control" name="singkatan" required id="singkatan"
                        placeholder="nama singkatan instansi">
                </div>
        </div>
        <div class=" card-footer">
            <div class="row">
                <div class="col-auto">
                    <a href="<?= base_url(); ?>home/instansi" class="btn btn-default">Kembali</a>
                </div>
                <div class="col-auto ml-auto">
                    <input type="submit" class="btn btn-primary" name="submit" value="Simpan" id="submit">
                </div>
            </div>
            </form>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<input type="hidden" value="<?= base_url(); ?>" id="url_form_instansi">
<script>
$(document).ready(function() {
    let url_form_instansi = $('#url_form_instansi').val();
    let id_instansi = $('#id_instansi').val();
    if (id_instansi > 0) {
        $.ajax({
            url: url_form_instansi + "instansi/getinstansi",
            data: {
                id_instansi: id_instansi
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('#id_instansi').val(data.instansi[0].id_instansi);
                $('#nama_instansi').val(data.instansi[0].nama_instansi);
                $('#singkatan').val(data.instansi[0].singkatan);
                $('#submit').val('Perbaharui')
            },
            error: function() {
                console.log("failed data request");
            }
        });
    } else {
        $('#nama_instansi').val("");
        $('#singkatan').val("");
    }
});

function goBack() {
    window.history.back();
}
</script>