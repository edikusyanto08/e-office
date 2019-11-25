<!-- Modal pejabat struktural -->
<div class="modal fade" id="form_create_user" tabindex="-1" role="dialog" aria-labelledby="form_pejabat" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header mb-4">
                <h6 class="m-0">Perbaharui User</h6>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('karyawan/createAccount'); ?>
                <form>
                    <input type="hidden" name="nip" class="nip">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control password" name="password">
                    </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary btn-sm send">
            </div>
            </form>
        </div>
    </div>
</div>