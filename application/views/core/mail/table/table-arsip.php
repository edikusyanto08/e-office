<div class="tab-content bg-white shadow mb-3" style="font-size: 14px; padding: 5px 10px; border-radius: 10px;">
    <div class="border-bottom">
        <p>
        <div class="row">
                
            </div>
        </p>
    </div>
    <table class="table table-borderless table-sm">
        <?php if ($arsip != null) { ?>
        <tbody>
            <?php $i = 0;
                    foreach ($arsip as $key) { ?>
            <tr style="font-size: 14x; color: #5a5c69;">
                <td>
                    <div class="border-left-success">
                        <p style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                            <span class="font-weight-bold text-capitalize">
                                <?= $key->asal_surat; ?> - <?= $key->nomor_nota_dinas; ?> - <?= $key->perihal; ?>
                            </span> <br> 
                            <span style="font-size : 12px; "><?= $key->nama_bidang; ?> - <?= $key->created; ?></span>
                        </p>
                        <div class="mt-1" style="margin-left: 10px;">
                            <a class="btn btn-light btn-sm btn-custome font-weight-bold mb-1"
                                href="<?= base_url('Surat/downloadArsip/' . $key->slug_arsip); ?>" target="_blank">
                                Unduh
                            </a>
                        </div>
                    </div>
                </td>
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