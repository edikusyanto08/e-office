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
<div class="col-lg-12">
    <div class="card shadow">
        <div class="card-header border-bottom">
            <h6 class="m-0">Form - Update</h6>
        </div>
        <div class="card-body">
            <?= form_open('user/perbaharuiuser'); ?>
            <input type="hidden" value="<?= $param; ?>" id="user_id" name="user_id">
            <input type="hidden" value="<?php if ($user != null) {
                                            echo $user[0]->nip;
                                        } ?>" id="user_id" name="nip_asal">
            <form>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <div class="wrap-input100" data-validate="Enter nip">
                                <input type="text" class="form-control" name="nip" required id="nip" value="<?php if ($user != null) {
                                                                                                                echo $user[0]->nip;
                                                                                                            } ?>">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: -25px;">
                            <label for="username">Username</label>
                            <div class="wrap-input100" data-validate="Enter username">
                                <input type="text" class="form-control" name="username" required id="username"
                                    value="<?php if ($user != null) {
                                                                                                                            echo $user[0]->username;
                                                                                                                        } ?>">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: -25px; margin-bottom: -25px;">
                            <label for="password">Password</label>
                            <div class="wrap-input100" data-validate="Enter password">
                                <span class="btn-show-pass">
                                    <i class="zmdi zmdi-eye"></i>
                                </span>
                                <input class="form-control" type="password" name="password" id="password"
                                    value="<?php if ($user != null) {
                                                                                                                        echo $user[0]->password;
                                                                                                                    } ?>">
                            </div>
                            <div class="custom-control custom-checkbox" style="margin-top: -25px;">
                                <input type="checkbox" class="custom-control-input" id="formsCheckboxDefault" value="1"
                                    name="checkpassword">
                                <label class="custom-control-label text-capitalize"
                                    for="formsCheckboxDefault">perbaharui password</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <p class="text-capitalize">Instansi : <br>
                            <span class="text-primary">
                                <?php if ($instansi != null) {
                                    echo $instansi[0]->nama_instansi;
                                } else {
                                    echo '-';
                                } ?></span></p>
                        <p class="text-capitalize">Hak Akses : <br>
                            <span class="text-primary">
                                <?php if ($user != null) {
                                    echo $user[0]->hak;
                                } else {
                                    echo '-';
                                } ?></span></p>
                    </div>
                </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-auto">
                    <a href="<?= base_url(); ?>home/user">
                        <div class="btn btn-default">Kembali</div>
                    </a>
                </div>
                <div class="col-auto ml-auto">
                    <input type="submit" class="btn btn-primary" value="Perbaharui" id="submit">
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