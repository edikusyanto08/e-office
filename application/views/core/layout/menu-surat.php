<style>
a:hover {
    text-decoration: none;
}
</style>
<?php if (count($agendaris) > 0) { ?>
<div class="mb-3">
    <a href="<?= base_url(); ?>home/formSuratMasuk" class="shadow">
        <div class="card shadow  _surat_masuk" data-toggle="modal" data-target=".surat-masuk">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Buat Surat</div>
                    </div>
                    <div class="col-auto">
                        <i class=" fas fa-envelope fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
<?php } ?>
<div class="nav flex-column nav-pills mb-3 bg-white shadow" id="v-pills-tab" role="tablist" aria-orientation="vertical"
    style="font-size: 14px; padding: 10px; border-radius: 10px;">
    <div class="border-bottom">
        <p>
            <h5 class="font-weight-bold ml-3">Menu</h5>
        </p>
    </div>
    <div class="mt-3">
        <ul class="nav-item" style="list-style:none;">
            <li>
                <a href="<?= base_url(); ?>home/suratmasuk" class="nav-link inbox">
                    <i class="fas fa-inbox"></i>
                    <span style="margin-left:15px;">Inbox</span>
                    <span class="badge float-right text-inbox text-primary"
                        style="font-size: 13px;"><?= count($countSuratMasuk); ?></span>
                </a>
            </li>
            <li>
                <a href="<?= base_url(); ?>home/suratdisposisi" class="nav-link disposisi">
                    <i class="fas fa-paper-plane"></i>
                    <span style="margin-left:15px;">Disposisi</span>
                    <span class="badge float-right text-disposisi text-primary"
                        style="font-size: 13px;"><?= count($count_disposisi); ?></span>
                </a>
            </li>
            <li>
                <a href="<?= base_url(); ?>home/suratperintah" class="nav-link supir">
                    <i class="fas fa-envelope"></i>
                    <span style="margin-left:15px;">SP & SPPD</span>
                    <span class="badge float-right text-supir text-primary"
                        style="font-size: 13px;"><?= count($countSuratPerintah); ?></span>
                </a>
            </li>
            <li>
                <a href="<?= base_url(); ?>home/suratnotadinas" class="nav-link nodin">
                    <i class="fas fa-envelope"></i>
                    <span style="margin-left:15px;">Nota Dinas</span>
                    <span class="badge float-right text-nodin text-primary"
                        style="font-size: 13px;"><?= count($countNotaDinas); ?></span>
                </a>
            </li>
            <li>
            <a href="<?= base_url(); ?>home/arsip" class="nav-link arsip">
                <i class="fas fa-archive "></i>
                <span style="margin-left:15px;">Arsip</span>
            </a>
        </li>
            <li>
                <a href="<?= base_url(); ?>home/sampah" class="nav-link sampah">
                    <i class="fas fa-trash"></i>
                    <span style="margin-left:15px;">Trash</span>
                    <span class="badge float-right text-sampah  text-primary"
                        style="font-size: 13px;"><?= count($countSampah); ?></span>
                </a>
            </li>
            <?php if (count($agendaris) > 0) { ?>
            <li>
                <a href="<?= base_url(); ?>home/Pengagendaan" class="nav-link darat">
                    <i class="far fa-calendar-alt"></i>
                    <span style="margin-left:10px;">Pengagendaan</span>
                    <span class="badge float-right text-darat text-primary"
                        style="font-size: 13px;"><?= count($countAgenda); ?></span>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>

</div>