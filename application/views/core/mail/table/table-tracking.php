<div class="tab-content bg-white shadow mb-3" style="font-size: 14px; padding: 5px 10px; border-radius: 10px;">
    <div class="tab-pane fade show active" id="suratmasuk" role="tabpanel" aria-labelledby="pills-table-content-tab">
        <div class="border-bottom">
            <p>
                <h5 class="font-weight-bold ml-3">Surat Masuk</h5>
            </p>
        </div>
        <table class="table table-borderless">
            <?php if ($surat != null) { ?>
            <tbody>
                <?php $i = 0;
                        foreach ($surat as $surat) { ?>
                <tr class="text-dark">
                    <?php if ($surat->status == '0') { ?>
                    <?php if ($surat->penangguhan == '1') { ?>
                    <td style="width: 80%;">
                        <p class="font-weight-bold" style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                            <?php if ($surat->agendaris == $this->session->userdata('sisule_cms_nip')) { ?>
                            <?= $penerima_surat_masuk[$i]->nama ?>
                            <?php } else {
                                                                echo $surat->nama;
                                                            } ?>
                            | <span class="text-capitalize"><?= $surat->perihal; ?></span>
                        </p>
                        <p class="text-capitalize" style="font-size: 11px;  margin-left: 10px; margin-bottom: 0px;">
                            <?= $surat->nomor_surat; ?> | <?= $surat->asal_surat; ?> | <?= $surat->tanggal; ?>
                        </p>
                    </td>
                    <?php } else { ?>
                    <td style="width: 80%;">
                        <p class="font-weight-bold" style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                            <?php if ($surat->agendaris == $this->session->userdata('sisule_cms_nip')) { ?>
                            <?= $penerima_surat_masuk[$i]->nama ?>
                            <?php } else {
                                                                echo $surat->nama;
                                                            } ?>
                        </p>
                        <p class="text-capitalize" style="font-size: 11px;  margin-left: 10px; margin-bottom: 0px;">
                            <?= $surat->nomor_surat; ?> | <?= $surat->asal_surat; ?> | <?= $surat->tanggal; ?>
                        </p>
                    </td>
                    <?php } ?>
                    <?php } elseif ($surat->status == '1') { ?>
                    <?php if ($surat->penangguhan == '1') { ?>
                    <td style="width: 80%;">
                        <div class="border-left-warning">
                            <p class="font-weight-bold" style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                                <?php if ($surat->agendaris == $this->session->userdata('sisule_cms_nip')) { ?>
                                <?= $penerima_surat_masuk[$i]->nama ?>
                                <?php } else {
                                                                    echo $surat->nama;
                                                                } ?>
                                | <span class="text-capitalize"><?= $surat->perihal; ?></span>
                            </p>
                            <p class="text-capitalize" style="font-size: 11px;  margin-left: 10px; margin-bottom: 0px;">
                                <?= $surat->nomor_surat; ?> | <?= $surat->asal_surat; ?> | <?= $surat->tanggal; ?>
                            </p>
                        </div>
                    </td>
                    <?php } else { ?>
                    <td style="width: 80%;">
                        <p class="font-weight-bold" style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                            <?php if ($surat->agendaris == $this->session->userdata('sisule_cms_nip')) { ?>
                            <?= $penerima_surat_masuk[$i]->nama ?>
                            <?php } else {
                                                                echo $surat->nama;
                                                            } ?>
                            | <span class="text-capitalize"><?= $surat->perihal; ?></span>
                        </p>
                        <p class="text-capitalize" style="font-size: 11px;  margin-left: 10px; margin-bottom: 0px;">
                            <?= $surat->nomor_surat; ?> | <?= $surat->asal_surat; ?> | <?= $surat->tanggal; ?>
                        </p>
                    </td>
                    <?php } ?>
                    <?php } elseif ($surat->status == '2') { ?>
                    <?php if ($surat->penangguhan == '1') { ?>
                    <td style="width: 80%; margin-bottom: 0px;">
                        <p class="font-weight-bold" style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                            <?php if ($surat->agendaris == $this->session->userdata('sisule_cms_nip')) { ?>
                            <?= $penerima_surat_masuk[$i]->nama ?>
                            <?php } else {
                                                                echo $surat->nama;
                                                            } ?>
                            | <span class="text-capitalize"><?= $surat->perihal; ?></span>
                        </p>
                        <p class="text-capitalize" style="font-size: 11px;  margin-left: 10px; margin-bottom: 0px;">
                            <?= $surat->nomor_surat; ?> | <?= $surat->asal_surat; ?> | <?= $surat->tanggal; ?>
                        </p>
                    </td>
                    <?php } else { ?>
                    <td style="width: 80%; margin-bottom: 0px;">
                        <p class="font-weight-bold" style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                            <?php if ($surat->agendaris == $this->session->userdata('sisule_cms_nip')) { ?>
                            <?= $penerima_surat_masuk[$i]->nama ?>
                            <?php } else {
                                                                echo $surat->nama;
                                                            } ?>
                            | <span class="text-capitalize"><?= $surat->perihal; ?></span>
                        </p>
                        <p class="text-capitalize" style="font-size: 11px;  margin-left: 10px; margin-bottom: 0px;">
                            <?= $surat->nomor_surat; ?> | <?= $surat->asal_surat; ?> | <?= $surat->tanggal; ?>
                        </p>
                    </td>
                    <?php } ?>
                    <?php } ?>
                    <td class="text-right">
                        <a href="#" class="btn btn-sm btn-primary btn-custome font-weight-bold tracking" id="tracking"
                            data-toggle="modal" data-target=".tracking_surat" data-placement="top"
                            title="Lacak surat ini!" data-id="<?= $surat->nomor_surat; ?>">
                            Lacak
                        </a>
                    </td>
                </tr>
                <?php
                            $i++;
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
</div>