<style>
.wrap-input100 {
    border-bottom: 0px;
}

label {
    font-size: 14px;
}
</style>
<div class="col-lg-12">
    <div class="card shadow">
        <div class="card-header border-bottom">
            <h6 class="m-0">Profil</h6>
        </div>
        <div class="card-body">
            <?= form_open('profil/perbaharuiprofil'); ?>
            <div class="mb-3 text-capitalize">
                <h6 class="text-black">profil</h6>
            </div>
            <form class="quick-post-form">
                <table class="table table-borderless table-sm table-responsive" style="font-size: 14px;">
                    <tr>
                        <td style="width: 10%;">Nama</td>
                        <td style="width: 2%;">:</td>
                        <td style="width: 28%;">
                            <?php if (isset($profile[0]->nama)) { ?>
                            <?= $profile[0]->nama; ?>
                            <?php } else {
                                echo "-";
                            } ?>
                        </td>
                        <td style="width: 20%;">Nama Jabatan</td>
                        <td style="width: 2%;">:</td>
                        <td class="text-capitalize" style="width: 38%;">
                            <?php if (isset($bidang[0]->nama_bidang)) { ?>
                            <?= $bidang[0]->nama_bidang; ?>
                            <?php } else {
                                echo "-";
                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Pangkat</td>
                        <td>:</td>
                        <td>
                            <?php if (isset($profile[0]->pangkat)) { ?>
                            <?= $profile[0]->pangkat; ?>
                            <?php } else {
                                echo "-";
                            } ?>
                        </td>
                        <td>Jenis Jabatan</td>
                        <td>:</td>
                        <td class="text-capitalize">
                            <?php if (isset($bidang[0]->tipe)) { ?>
                            <?= $bidang[0]->tipe; ?>
                            <?php } else {
                                echo "-";
                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Golongan</td>
                        <td>:</td>
                        <td>
                            <?php if (isset($profile[0]->golongan)) { ?>
                            <?= $profile[0]->golongan; ?>
                            <?php } else {
                                echo "-";
                            } ?>
                        </td>
                        <td>Instansi</td>
                        <td>:</td>
                        <td class="text-capitalize">
                            <?php if (isset($instansi[0]->nama_instansi)) { ?>
                            <?= $instansi[0]->nama_instansi; ?>
                            <?php } else {
                                echo "-";
                            } ?>
                        </td>
                    </tr>
                </table>
                <hr>
                <div class="mb-4 text-capitalize">
                    <h6 class="text-black">Akun</h6>
                </div>
                <div class="row" style="margin-bottom: -25px;">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <div class="wrap-input100" data-validate="Enter username">
                                <input type="text" class="form-control" name="username" required id="username"
                                    value="<?= $login[0]->username; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="wrap-input100" data-validate="Enter password">
                                <span class="btn-show-pass">
                                    <i class="zmdi zmdi-eye"></i>
                                </span>
                                <input class="form-control" type="password" name="password" id="password"
                                    value="<?= $login[0]->password; ?>">
                            </div>
                        </div>
                        <div class="custom-control custom-checkbox" style="margin-top: -25px;">
                            <input type="checkbox" class="custom-control-input" id="formsCheckboxDefault" value="1"
                                name="checkpassword">
                            <label class="custom-control-label text-capitalize" for="formsCheckboxDefault"
                                style="font-size: 14px;">ya, perbaharui password</label>
                        </div>
                    </div>
                </div>
        </div>
        <div class=" card-footer">
            <div class="row">
                <div class="col-auto">
                    <a href="<?= base_url(); ?>home" class="btn btn-default">Kembali</a>
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