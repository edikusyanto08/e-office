<style>
.btn-custome {
    padding: 2px 5px;
}
</style>
<div class="row">
    <div class="col-lg-8 mb-3">
        <div class="card mb-3">
            <div class="card-body">
                <?php $this->load->view('core/organisasi/form/search-user'); ?>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-lg-6 mb-3">
                        <h5 class="m-0 font-weight-bold text-center text-sm-left text-uppercase">Pengguna Aplikasi</h5>
                    </div>
                    <div class="col-lg-6 ml-auto text-center text-sm-right">
                        <a href="<?= base_url('home/formuser/'); ?>"
                            class="text-xs font-weight-bold text-capitalize mb-1 btn btn-primary btn-sm">Tambah Pengguna <span class="badge badge-light font-weight-bold ml-2"
                                style="font-size: 11px;"><?= count($countUser); ?></span></a>
                    </div>
                </div>
                <p class="row border-top">
                    <div class="table_user"></div>
                </p>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="font-weight-bold text-uppercase">Pengguna tidak terverifikasi</h5>
                <table class="table table-sm">
                    <?php $i = 1;
                    foreach ($unregistered as $key) { ?>
                    <tr>
                        <td>
                            <a>
                                <span style="font-size: 14px;">
                                    <?= $key->nip; ?> - <?= $key->username;  ?> - <?= $key->hak; ?>
                                </span>
                                <div class="mt-1" style="font-size: 14px;">
                                    <span><a href="<?= base_url("home/formupdateuser/" . $key->user_id); ?>"
                                            class="btn btn-sm btn-primary font-weight-bold btn-custome">Perbaharui</a></span>
                                    <span><a href="#"
                                            class="btn btn-sm btn-default font-weight-bold text-black-50 btn-custome hapususerghoib"
                                            data-toggle="tooltip" data-placement="top" title="Hapus user"
                                            data-id="<?= $key->user_id; ?>">Hapus</a></span>
                                </div>
                            </a>
                        </td>
                    </tr>
                    <?php $i++;
                    } ?>
                </table>
            </div>
        </div>
    </div>
</div>