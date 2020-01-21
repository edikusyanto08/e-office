<div class="tab-content bg-white shadow mb-3" style="font-size: 14px; padding: 5px 10px; border-radius: 10px;">
    <div class="border-bottom">
        <p>
            <h5 class="font-weight-bold ml-3">Nota Dinas</h5>
        </p>
    </div>
    <table class="table table-borderless table-sm">
        <?php if ($notaDinas != null) { ?>
        <tbody>
            <?php $i = 0;
                    foreach ($notaDinas as $key) { ?>
            <tr style="font-size: 14x; color: #5a5c69;">
                <?php if ($penulisNotaDinas[$i]->penerima  == $this->session->userdata('sisule_cms_nip')) { ?>
                <td>
                    <div class="border-left-success">
                        <p style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                            <span class="font-weight-bold"><?= $key->nama_bidang; ?> |
                                <?= $key->nomor_nota_dinas; ?></span>
                            <br>
                            <span class="text-capitalize" style="font-size: 12px;"><?= $key->tanggal; ?> |
                                <?= $key->perihal; ?></span>
                        </p>
                        <div class="mt-1" style="margin-left: 10px;">
                            <?php if ($key->nip != $this->session->userdata('sisule_cms_nip')) { ?>
                            <a href="<?= base_url('Home/formupdatenotadinas/' . $key->slug_surat); ?>"
                                class="btn btn-primary btn-sm btn-custome text-capitalize font-weight-bold mb-1">Perbaharui
                            </a>
                            <?php } ?>
                            <a class="btn btn-light btn-sm btn-custome font-weight-bold mb-1"
                                href="<?= base_url('Surat/getFileNotaDinas/' . $key->slug_nota); ?>" target="_blank">
                                Unduh
                            </a>
                        </div>
                    </div>
                </td>
                <?php } elseif ($penulisNotaDinas[$i]->penulis == $this->session->userdata('sisule_cms_nip')) { ?>
                <td>
                    <div class="border-left-success">
                        <p style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                            <span class="font-weight-bold"> <?= $key->nama_bidang; ?> |
                                <?= $key->nomor_nota_dinas; ?>
                            </span> <br>
                            <span class="text-capitalize" style="font-size: 12px;"> <?= $key->tanggal; ?> |
                                <?= $key->perihal; ?></span>
                        </p>
                        <div class="mt-1" style="margin-left: 10px;">
                            <?php if ($key->penerima_nota != $this->session->userdata('sisule_cms_nip')) { ?>
                            <a href="<?= base_url('Home/formupdatenotadinas/' . $key->slug_surat); ?>"
                                class="btn btn-primary btn-sm btn-custome text-capitalize font-weight-bold mb-1">Perbaharui
                            </a>
                            <?php } ?>
                            <a class="btn btn-light btn-sm btn-custome font-weight-bold mb-1"
                                href="<?= base_url('Surat/getFileNotaDinas/' . $key->slug_nota); ?>" target="_blank">
                                Unduh
                            </a>
                        </div>
                    </div>
                </td>
                <?php } else { ?>
                <?php if ($key->nip == $this->session->userdata('sisule_cms_nip')) { ?>
                <td>
                    <div class="border-left-success">
                        <p style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                            <span class="font-weight-bold">
                                <?= $penulisNotaDinas[$i]->nama_bidang; ?> |
                                <?= $key->nomor_nota_dinas; ?>
                            </span> <br>
                            <span class="text-capitalize" style="font-size: 12px;"><?= $key->tanggal; ?> |
                                <?= $key->perihal; ?></span>
                        </p>
                        <div class="mt-1" style="margin-left: 10px;">
                            <?php if ($key->nip != $this->session->userdata('sisule_cms_nip')) { ?>
                            <a href="<?= base_url('Home/formupdatenotadinas/' . $key->slug_surat); ?>"
                                class="btn btn-primary btn-sm btn-custome text-capitalize font-weight-bold mb-1">Perbaharui
                            </a>
                            <?php } ?>
                            <a class="btn btn-light btn-sm btn-custome font-weight-bold mb-1"
                                href="<?= base_url('Surat/getFileNotaDinas/' . $key->slug_nota); ?>" target="_blank">
                                Unduh
                            </a>
                        </div>
                    </div>
                </td>
                <?php } else { ?>
                <td>
                    <div class="border-left-success">
                        <p style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                            <span class="font-weight-bold">
                                <?= $penulisNotaDinas[$i]->nama_bidang; ?> |
                                <?= $key->nomor_nota_dinas; ?>
                            </span> <br>
                            <span class="text-capitalize" style="font-size: 12px;"><?= $key->tanggal; ?> |
                                <?= $key->perihal; ?></span>
                        </p>
                        <div class="mt-1" style="margin-left: 10px;">
                            <?php if ($key->nip != $this->session->userdata('sisule_cms_nip')) { ?>
                            <a href="<?= base_url('Home/formupdatenotadinas/' . $key->slug_surat); ?>"
                                class="btn btn-primary btn-sm btn-custome text-capitalize font-weight-bold mb-1">Perbaharui
                            </a>
                            <?php } ?>
                            <a class="btn btn-light btn-sm btn-custome font-weight-bold mb-1"
                                href="<?= base_url('Surat/getFileNotaDinas/' . $key->slug_nota); ?>" target="_blank">
                                Unduh
                            </a>
                        </div>
                    </div>
                </td>
                <?php } ?>
                <?php } ?>
            </tr>
            <?php $i++;
                    } ?>
        </tbody>
        <?php } else {  ?>
        <div class="mt-4 text-center text-capitalize">
            data tidak ditemukan
        </div>
        <?php } ?>
    </table>
</div>
<?php echo $this->pagination->create_links(); ?>