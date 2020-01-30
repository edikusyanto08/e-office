<style>
    label{
        font-size: 14px;
    }
</style>
<div class="col-lg-12">
    <div class="card shadow">
        <div class="card-header border-bottom">
            <h5 class="m-0 font-weight-bold text-uppercase">Informasi Instansi</h5>
        </div>
        <div class="card-body">
            <?= form_open('instansi/buatinstansi'); ?>
            <input type="hidden" value="<?= $instansi[0]->id_instansi; ?>" id="id_instansi" name="id_instansi">
            <form >
                <div class="form-group">
                    <label for="nama_instansi">Nama Instansi <span class="text-danger">*</span></label>
                    <input type="text" class="form-control text-capitalize" name="nama_instansi" required
                        id="nama_instansi" value="<?= $instansi[0]->nama_instansi; ?>">
                </div>
                <div class="form-group">
                    <label for="singkatan">Singkatan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control text-uppercase" name="singkatan" required id="singkatan"
                        value="<?= $instansi[0]->singkatan; ?>">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat <span class="text-danger">*</span></label>
                    <input type="text" class="form-control text-capitalize" name="alamat" required id="alamat"
                        value="<?= $instansi[0]->alamat; ?>">
                </div>
                <div class="form-group">
                    <label for="telepon">Telepon <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="telepon" required id="telepon"
                        value="<?= $instansi[0]->telepon; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" required id="email"
                        value="<?= $instansi[0]->email; ?>">
                </div>
                <div class="form-group">
                    <label for="fax">Fax </label>
                    <input type="text" class="form-control" name="fax" required id="fax"
                        value="<?= $instansi[0]->fax; ?>">
                </div>
        </div>
        <div class=" card-footer ml-auto">
            <input type="submit" class="btn btn-primary font-weight-bold" value="Perbaharui" id="submit">
            </form>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<input type="hidden" value="<?= base_url(); ?>" id="url">
</script>