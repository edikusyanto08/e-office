<div class="tab-content bg-white shadow mb-3" style="font-size: 14px; padding: 5px 10px; border-radius: 10px;">
    <div class="tab-pane fade show active" id="suratmasuk" role="tabpanel" aria-labelledby="pills-table-content-tab">
        <div class="border-bottom">
            <p>
                <h5 class="font-weight-bold ml-3">Trash</h5>
            </p>
        </div>
        <table class="table table-borderless table-sm">
            <?php if ($sampah != null) { ?>
            <tbody>
                <?php $i = 0;
                        foreach ($sampah as $surat) { ?>
                <tr class="text-dark ">
                    <?php if ($surat->status == '0') { ?>
                    <td>
                        <div class="border-left-default" style="margin-bottom: 0px;">
                            <p class=" font-weight-bold"
                                style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                                <?php if ($surat->agendaris == $this->session->userdata('sisule_cms_nip')) { ?>
                                <?= $penerima_surat_masuk[$i]->nama ?>
                                <?php } else {
                                                            echo $surat->nama;
                                                        } ?>
                                | <span class="text-capitalize"><?= $surat->perihal; ?></span>
                            </p>
                            <p style="font-size: 11px;  margin-left: 10px; margin-bottom: 0px;">
                                <?= $surat->nomor_surat; ?> | <?= $surat->asal_surat; ?> | <?= $surat->tanggal; ?>
                            </p>
                            <div class="mt-1" style="margin-left: 10px;">
                                <a href="<?= base_url('Surat/restoreFileSampah/' . $surat->slug_surat); ?>"
                                    class="btn btn-primary btn-sm btn-custome font-weight-bold" data-toggle="tooltip"
                                    data-placement="top" title="Restore File"
                                    onclick="javascript: return confirm('Merestore file ?')"
                                    style="font-size: 12px; margin-right: 5px;">Restore</a>
                                <a href="#" class="preview btn btn-light btn-sm btn-custome font-weight-bold"
                                    data-toggle="modal" data-placement="top" title="Detail Informasi"
                                    data-target=".preview-surat-masuk" data-id="<?= $surat->nomor_surat; ?>"
                                    style="font-size: 12px;">Lihat</a>
                                <?php if ($surat->agendaris == $this->session->userdata('sisule_cms_nip')) { ?>
                                <button class="btn btn-default btn-sm btn-custome font-weight-bold hapussuratmasuk text-danger"
                                    data-toggle="tooltip" data-placement="top" title="Hapus Permanen"
                                    data-id="<?= $surat->slug_surat; ?>" style="font-size: 12px;">Hapus</button>
                                <?php } ?>
                            </div>
                        </div>
                    </td>
                    <?php } elseif ($surat->status == '1') { ?>
                    <td>
                        <div class="border-left-danger">
                            <p class="font-weight-bold" style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                                <?php if ($surat->agendaris == $this->session->userdata('sisule_cms_nip')) { ?>
                                <?= $penerima_surat_masuk[$i]->nama ?>
                                <?php } else {
                                                            echo $surat->nama;
                                                        } ?>
                                | <span class="text-capitalize"><?= $surat->perihal; ?></span>
                            </p>
                            <p style="font-size: 11px;  margin-left: 10px; margin-bottom: 0px;">
                                <?= $surat->nomor_surat; ?> | <?= $surat->asal_surat; ?> | <?= $surat->tanggal; ?>
                            </p>
                            <div class="mt-1" style="margin-left: 10px;">
                                <a href="<?= base_url('Surat/restoreFileSampah/' . $surat->slug_surat); ?>"
                                    class="btn btn-primary btn-sm btn-custome font-weight-bold" data-toggle="tooltip"
                                    data-placement="top" title="Restore File"
                                    onclick="javascript: return confirm('Merestore file ?')"
                                    style="font-size: 12px; margin-right: 5px;">Restore</a>
                                <a href="#" class="preview btn btn-light btn-sm btn-custome font-weight-bold"
                                    data-toggle="modal" data-placement="top" title="Detail Informasi"
                                    data-target=".preview-surat-masuk" data-id="<?= $surat->nomor_surat; ?>"
                                    style="font-size: 12px;">Lihat</a>
                                <?php if ($surat->agendaris == $this->session->userdata('sisule_cms_nip')) { ?>
                                <button class="btn btn-default btn-sm btn-custome font-weight-bold hapussuratmasuk text-danger"
                                    data-toggle="tooltip" data-placement="top" title="Hapus Permanen"
                                    data-id="<?= $surat->slug_surat; ?>" style="font-size: 12px;">Hapus</button>
                                <?php } ?>
                            </div>
                        </div>
                    </td>
                    <?php } elseif ($surat->status == '2') { ?>
                    <td style="margin-bottom: 0px;">
                        <div class="border-left-primary">
                            <p class="font-weight-bold" style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                                <?php if ($surat->agendaris == $this->session->userdata('sisule_cms_nip')) { ?>
                                <?= $penerima_surat_masuk[$i]->nama ?>
                                <?php } else {
                                                            echo $surat->nama;
                                                        } ?>
                                | <span class="text-capitalize"><?= $surat->perihal; ?></span>
                            </p>
                            <p style="font-size: 11px;  margin-left: 10px; margin-bottom: 0px;">
                                <?= $surat->nomor_surat; ?> | <?= $surat->asal_surat; ?> | <?= $surat->tanggal; ?>
                            </p>
                            <div class="mt-1" style="margin-left: 10px;">
                                <a href="<?= base_url('Surat/restoreFileSampah/' . $surat->slug_surat); ?>"
                                    class="btn btn-primary btn-sm btn-custome font-weight-bold" data-toggle="tooltip"
                                    data-placement="top" title="Restore File"
                                    onclick="javascript: return confirm('Merestore file ?')"
                                    style="font-size: 12px;">Restore</a>
                                <a href="#" class="preview btn btn-light btn-sm btn-custome font-weight-bold"
                                    data-toggle="modal" data-placement="top" title="Detail Informasi"
                                    data-target=".preview-surat-masuk" data-id="<?= $surat->nomor_surat; ?>"
                                    style="font-size: 12px;">Lihat</a>
                                <?php if ($surat->agendaris == $this->session->userdata('sisule_cms_nip')) { ?>
                                <button class="btn btn-default btn-sm btn-custome font-weight-bold hapussuratmasuk text-danger"
                                    data-toggle="tooltip" data-placement="top" title="Hapus Permanen"
                                    data-id="<?= $surat->slug_surat; ?>" style="font-size: 12px;">Hapus</button>
                                <?php } ?>
                            </div>
                        </div>
                    </td>
                    <?php } ?>
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