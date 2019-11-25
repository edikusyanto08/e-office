<div class="tab-content bg-white shadow mb-3" style="font-size: 14px; padding: 5px 10px; border-radius: 10px;">
    <div class="tab-pane fade show active" id="suratmasuk" role="tabpanel" aria-labelledby="pills-table-content-tab">
        <div class="border-bottom">
            <p>
                <h5 class="font-weight-bold ml-3">SP & SPPD</h5>
            </p>
        </div>
        <table class="table table-borderless table-sm">
            <tbody>
                <?php if ($surat_perintah != null) { ?>
                <?php if ($agendaris != null) { ?>
                <?php $h = 0;
                                foreach ($all_sp as $all_sp) { ?>
<?php if ($all_sp->nota != null) { ?>
                <?php if ($all_sp->pembuat_disposisi == $this->session->userdata('sisule_cms_nip')) { ?>
                <tr>
                    <td style="color: #5a5c69;">
                        <div class="border-left-success">
                            <p style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                                <span class="font-weight-bold"><?= $penerima_perintah[$i]->nama; ?> |
                                    <?= $all_sp->perihal; ?></span><br>
                                <span class="text-capitalize"
                                    style="font-size: 12px;"><?= $all_sp->no_perintah; ?></span> |
                                <span class="text-capitalize text-primary font-weight-bold"
                                    style="font-size: 12px;"><?= $all_sp->mulai_kegiatan; ?></span> -
                                <span class="text-capitalize text-danger font-weight-bold"
                                    style="font-size: 12px;"><?= $all_sp->akhir_kegiatan; ?></span>
                            </p>
                            <div class="mt-1" style="margin-left: 10px;">
                                <a href="<?= site_url('Surat/getFileSuratPerintah/' . $all_sp->slug_perintah); ?>"
                                    target="_blank" class="btn btn-sm btn-light btn-custome font-weight-bold">
                                    Unduh
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php } else { ?>
                <tr>
                    <td style="color: #5a5c69;">
                        <div class="border-left-success">
                            <p style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                                <span class="font-weight-bold">
                                    <?= $pembuat_perintah[$h]->nama; ?> | <?= $all_sp->perihal; ?>
                                </span><br>
                                <span class="text-capitalize"
                                    style="font-size: 12px;"><?= $all_sp->no_perintah; ?></span> |
                                <span class="text-capitalize text-primary font-weight-bold"
                                    style="font-size: 12px;"><?= $all_sp->mulai_kegiatan; ?></span> -
                                <span class="text-capitalize text-danger font-weight-bold"
                                    style="font-size: 12px;"><?= $all_sp->akhir_kegiatan; ?></span>
                            </p>
                            <div class="mt-1" style="margin-left: 10px;">
                                <a href="<?= site_url('Surat/getFileSuratPerintah/' . $all_sp->slug_perintah); ?>"
                                    target="_blank" class="btn btn-sm btn-light btn-custome font-weight-bold">
                                    Unduh
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <?php if ($all_sp->pembuat_disposisi == $this->session->userdata('sisule_cms_nip')) { ?>
                <tr>
                    <td style="color: #5a5c69;">
                        <div class="border-left-primary">
                            <p style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                                <span class="font-weight-bold">
                                    <?= $penerima_perintah[$h]->nama; ?> | <?= $all_sp->perihal; ?>
                                </span><br>
                                <span class="text-capitalize"
                                    style="font-size: 12px;"><?= $all_sp->no_perintah; ?></span> |
                                <span class="text-capitalize text-primary font-weight-bold"
                                    style="font-size: 12px;"><?= $all_sp->mulai_kegiatan; ?></span> -
                                <span class="text-capitalize text-danger font-weight-bold"
                                    style="font-size: 12px;"><?= $all_sp->akhir_kegiatan; ?></span>
                            </p>
                            <div class="mt-1" style="margin-left: 10px;">
                                <a href="<?= site_url('Surat/getFileSuratPerintah/' . $all_sp->slug_perintah); ?>"
                                    target="_blank" class="btn btn-sm btn-light btn-custome font-weight-bold">
                                    Unduh
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php } else { ?>
                <tr>
                    <td style="color: #5a5c69;">
                        <div class="border-left-primary">
                            <p style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                                <span class="font-weight-bold">
                                    <?= $pembuat_perintah[$h]->nama; ?> | <?= $all_sp->perihal; ?>
                                </span><br>
                                <span class="text-capitalize"
                                    style="font-size: 12px;"><?= $all_sp->no_perintah; ?></span> |
                                <span class="text-capitalize text-primary font-weight-bold"
                                    style="font-size: 12px;"><?= $all_sp->mulai_kegiatan; ?></span> -
                                <span class="text-capitalize text-danger font-weight-bold"
                                    style="font-size: 12px;"><?= $all_sp->akhir_kegiatan; ?></span>
                            </p>
                            <div class="mt-1" style="margin-left: 10px;">
                                <a href="<?= site_url('Surat/getFileSuratPerintah/' . $all_sp->slug_perintah); ?>"
                                    target="_blank" class="btn btn-sm btn-light btn-custome font-weight-bold">
                                    Unduh
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                <?php } ?>

                <?php $h++;
                                } ?>
                <?php } else { ?>
                <?php $i = 0;
                                foreach ($surat_perintah as $surat) { ?>
                <?php if ($surat->nota != null) { ?>
                <?php if ($surat->pembuat_disposisi == $this->session->userdata('sisule_cms_nip')) { ?>
                <tr>
                    <td style="color: #5a5c69;">
                        <div class="border-left-success">
                            <p style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                                <span class="font-weight-bold"><?= $penerima_perintah[$i]->nama; ?> |
                                    <?= $surat->perihal; ?></span><br>
                                <span class="text-capitalize"
                                    style="font-size: 12px;"><?= $surat->no_perintah; ?></span> |
                                <span class="text-capitalize text-primary font-weight-bold"
                                    style="font-size: 12px;"><?= $surat->mulai_kegiatan; ?></span> -
                                <span class="text-capitalize text-danger font-weight-bold"
                                    style="font-size: 12px;"><?= $surat->akhir_kegiatan; ?></span>
                            </p>
                            <div class="mt-1" style="margin-left: 10px;">
                                <a href="<?= site_url('Surat/getFileSuratPerintah/' . $surat->slug_perintah); ?>"
                                    target="_blank" class="btn btn-sm btn-light btn-custome font-weight-bold">
                                    Unduh
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php } else { ?>
                <tr>
                    <td style="color: #5a5c69;">
                        <div class="border-left-success">
                            <p style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                                <span class="font-weight-bold">
                                    <?= $pembuat_perintah[$i]->nama; ?> | <?= $surat->perihal; ?>
                                </span><br>
                                <span class="text-capitalize"
                                    style="font-size: 12px;"><?= $surat->no_perintah; ?></span> |
                                <span class="text-capitalize text-primary font-weight-bold"
                                    style="font-size: 12px;"><?= $surat->mulai_kegiatan; ?></span> -
                                <span class="text-capitalize text-danger font-weight-bold"
                                    style="font-size: 12px;"><?= $surat->akhir_kegiatan; ?></span>
                            </p>
                            <div class="mt-1" style="margin-left: 10px;">
                                <a href="<?= site_url('Surat/getFileSuratPerintah/' . $surat->slug_perintah); ?>"
                                    target="_blank" class="btn btn-sm btn-light btn-custome font-weight-bold">
                                    Unduh
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <?php if ($surat->pembuat_disposisi == $this->session->userdata('sisule_cms_nip')) { ?>
                <tr>
                    <td style="color: #5a5c69;">
                        <div class="border-left-primary">
                            <p style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                                <span class="font-weight-bold">
                                    <?= $penerima_perintah[$i]->nama; ?> | <?= $surat->perihal; ?>
                                </span><br>
                                <span class="text-capitalize"
                                    style="font-size: 12px;"><?= $surat->no_perintah; ?></span> |
                                <span class="text-capitalize text-primary font-weight-bold"
                                    style="font-size: 12px;"><?= $surat->mulai_kegiatan; ?></span> -
                                <span class="text-capitalize text-danger font-weight-bold"
                                    style="font-size: 12px;"><?= $surat->akhir_kegiatan; ?></span>
                            </p>
                            <div class="mt-1" style="margin-left: 10px;">
                                <a href="<?= site_url('Surat/getFileSuratPerintah/' . $surat->slug_perintah); ?>"
                                    target="_blank" class="btn btn-sm btn-light btn-custome font-weight-bold">
                                    Unduh
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php } else { ?>
                <tr>
                    <td style="color: #5a5c69;">
                        <div class="border-left-primary">
                            <p style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                                <span class="font-weight-bold">
                                    <?= $pembuat_perintah[$i]->nama; ?> | <?= $surat->perihal; ?>
                                </span><br>
                                <span class="text-capitalize"
                                    style="font-size: 12px;"><?= $surat->no_perintah; ?></span> |
                                <span class="text-capitalize text-primary font-weight-bold"
                                    style="font-size: 12px;"><?= $surat->mulai_kegiatan; ?></span> -
                                <span class="text-capitalize text-danger font-weight-bold"
                                    style="font-size: 12px;"><?= $surat->akhir_kegiatan; ?></span>
                            </p>
                            <div class="mt-1" style="margin-left: 10px;">
                                <a href="<?= site_url('Surat/getFileSuratPerintah/' . $surat->slug_perintah); ?>"
                                    target="_blank" class="btn btn-sm btn-light btn-custome font-weight-bold">
                                    Unduh
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                <?php } ?>
                <?php
                                    $i++;
                                } ?>
                <?php } ?>

                <?php } else { ?>
                <div class="mt-4 text-center text-capitalize">
                    data tidak ditemukan
                </div>
                <?php } ?>
            </tbody>
        </table>
        <?php echo $this->pagination->create_links(); ?>
    </div>
</div>