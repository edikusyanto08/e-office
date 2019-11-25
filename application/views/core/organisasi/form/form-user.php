<style>
.wrap-input100 {
    border-bottom: 0px;
}

label {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 14px;
}

input {
    font-family: Arial, Helvetica, sans-serif;
}
</style>
<div class="col">
    <div class="card shadow">
        <div class="card-header border-bottom">
            <h6 class="m-0">Form Input User</h6>
        </div>
        <div class="card-body">
            <?= form_open('user/buatuser'); ?>
            <input type="hidden" value="<?= $param; ?>" id="user_id" name="user_id">
            <form class="quick-post-form">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <div class="wrap-input100" data-validate="Enter nip">
                                <input type="text" class="form-control" name="nip" required id="nip">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: -25px;">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <div class="wrap-input100" data-validate="Enter username">
                                <input type="text" class="form-control" name="username" required id="username">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: -25px;">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="wrap-input100" data-validate="Enter password">
                                <span class="btn-show-pass">
                                    <i class="zmdi zmdi-eye"></i>
                                </span>
                                <input class="form-control" type="password" name="password" id="password">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: -20px;">
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label for="instansi">Instansi</label>
                            <select class="form-control text-capitalize" id="instansi" name="instansi">
                                <option selected>Pilih</option>
                                <?php foreach ($instansi as $key) { ?>
                                <option value="<?= $key->id_instansi; ?>"><?= $key->nama_instansi; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="hak">Hak Akses</label>
                            <select class="form-control text-capitalize" id="hak" name="hak">
                                <option selected>Pilih</option>
                                <option value="superadmin">Super Admin</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                </div>
        </div>
        <div class="card-footer border-top">
            <div class="row">
                <div class="col-auto">
                    <a href="<?= base_url(); ?>home/user" class="mr-auto btn btn-default">Kembali</a>
                </div>
                <div class="col-auto ml-auto">
                    <input type="submit" class="btn btn-primary" value="Simpan" id="submit">
                </div>
            </div>
            </form>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<script>
function goBack() {
    window.history.back();
}
</script>