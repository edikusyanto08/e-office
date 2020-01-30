<style>
    .btn-custome {
        padding: 2px 5px;
    }
</style>

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
                    <h5 class="m-0 font-weight-bold text-center text-sm-left text-uppercase">Instansi</h5>
                </div>
                <div class="col-lg-6 ml-auto text-center text-sm-right">
                    <a href="<?= base_url('home/forminstansi/'); ?>" class="text-xs font-weight-bold text-capitalize mb-1 btn btn-primary btn-sm">tambah instansi <span class="badge badge-light font-weight-bold ml-2"
                                style="font-size: 11px;"><?= count($countInstansi); ?></span></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table_instansi"></div>
        </div>
    </div>
</div>