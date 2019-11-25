<div class="col-lg-12">
    <div class="card mb-3">
        <div class="card-body">
            <?php $this->load->view('core/organisasi/form/search-instansi'); ?>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="card shadow">
        <div class="card-header border-bottom">
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <h5 class="m-0 font-weight-bold">Instansi - <?= count($countInstansi); ?></h5>
                </div>
                <div class="col-lg-6 text-right">
                    <a href="<?= base_url('home/forminstansi/'); ?>" class="text-xs font-weight-bold text-capitalize btn btn-primary btn-sm">tambah instansi</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table_instansi"></div>
        </div>
    </div>
</div>