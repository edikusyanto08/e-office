<style>
label {
    font-size: 14px;
}
</style>

<!-- Modal pejabat struktural -->
<div class="modal fade tambah_pegawai" id="form_pegawai" tabindex="-1" role="dialog" aria-labelledby="form_pejabat"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header mb-4">
                <h6 class="m-0 font-weight-bold">Form Karyawan</h6>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('karyawan/aksi_upload'); ?>
                <form>
                    <div class="form-group" style="margin-top: -20px;">
                        <label for="customFile">Foto <span class="text-danger">*</span></label>
                        <div class="wadah-img text-center">
                            <img id="blah" src="" alt="" style="width: 100px; height: 100px; border-radius:100%;" />
                        </div>
                        <div class="custom-file mt-3">
                            <input type="file" name="fileToUpload" id="customFile" class="custom-file-input">
                            <label class="custom-file-label" for="customFile">
                                <input type="text" id="imgName" readonly
                                    style="background: white; border:none; width: 100%;"
                                    placeholder="Pilih Foto Profil Pegawai"></i>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control image" name="image" autocomplete="off" id="imgValue">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control iduser" name="id" autocomplete="off">
                        <input type="hidden" class="form-control status" name="status" autocomplete="off">
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="nip" class="text-dark">NIP <span class="text-danger">*</span></label>
                                <input type="text" class="form-control nip" name="nip" autocomplete="off" required
                                    placeholder="12345678 123456 1 123" id="nip">
                            </div>
                            <div class="form-group">
                                <label for="nama" class="text-dark">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control nama" name="nama" autocomplete="off" required
                                    placeholder="Dr. Asep Sunandar S.IP., MM." id="nama">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="pangkat" class="text-dark">Pangkat <span class="text-danger">*</span></label>
                                <input type="text" class="form-control pangkat" name="pangkat" autocomplete="off"
                                    required placeholder="Pembina Utama Muda" id="pangkat">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="golongan" class="text-dark">Golongan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control golongan" name="golongan" autocomplete="off"
                                    required placeholder="II/a" id="golongan">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="submit" name="submit" value="Kirim" class="btn btn-primary btn-sm font-weight-bold send">
            </div>
            </form>
        </div>
    </div>
</div>

<!-- aktifkan user -->
<!-- Modal pejabat struktural -->
<div class="modal fade" id="form_create_user" tabindex="-1" role="dialog" aria-labelledby="form_pejabat"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header mb-4">
                <h6 class="m-0 font-weight-bold">Informasi Akun</h6>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('karyawan/createAccount'); ?>
                <form>
                    <input type="hidden" name="nip" class="nip">
                    <label for="username">Username</label>
                    <div class="wrap-input100 validate-input " data-validate="Username">
                        <input class="input100 username" type="text" name="username">
                        <span class="focus-input100" autocomplete="off"></span>
                    </div>
                    <label for="password">Password</label>
                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input class="input100 password" type="password" name="password">
                        <span class="focus-input100"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="submit" value="kirim" class="btn btn-primary btn-sm send">
            </div>
            </form>
        </div>
    </div>
</div>