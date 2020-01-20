<style>
td {
    color: #5A5C69;
}
</style>
<div class="tab-content bg-white shadow mb-3" style="font-size: 14px; padding: 5px 10px; border-radius: 10px;">
    <div class="border-bottom">
        <p>
            <h5 class="font-weight-bold ml-3">Surat Dispoisisi</h5>
        </p>
    </div>
    <table class="table table-borderless table-sm">
        <tbody>
            <?php if ($disposisi != null || $alldisposisi != null) { ?>
            <!-- agendaris -->
            <?php if ($agendaris != null) { ?>
            <?php $h = 0;
            $c = 0;
                            foreach ($alldisposisi as $alldisposisi) { ?>
            <tr>
                <?php if ($alldisposisi->nota == null) { ?>
                <?php if ($alldisposisi->pembuat_disposisi != $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                <td>
                    <div class="border-left-primary">
                        <p class="text-capitalize font-weight-bold"
                            style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                            <?php if(isset($pembuat_disposisi[$h]->nama)) { ?>
                            <?= $pembuat_disposisi[$h]->nama; ?> |
                            <?php } ?>
                            <?= $alldisposisi->perihal; ?>
                        </p>
                        <p class="text-capitalize" style="font-size: 12px;  margin-left: 10px; margin-bottom: 0px;">
                            <?= $alldisposisi->nomor_surat; ?> | <?= $alldisposisi->waktu_disposisi; ?> | <span
                                class="text-danger font-weight-bold"> <?= $alldisposisi->sifat; ?></span> |
                            <?= $alldisposisi->nomor_agenda; ?>
                        </p>
                        <div class="mt-1" style="margin-left: 10px;">
                        <?php if(isset($getStatusPenerimaSuratDisposisi[$c]->nomor_surat) && $getStatusPenerimaSuratDisposisi[$c]->nota == null){  ?>
                                <?php if($getStatusPenerimaSuratDisposisi[$c]->nomor_surat == $alldisposisi->nomor_surat) { ?>
                            <?php if ($alldisposisi->pembuat_disposisi != $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                            <a href="<?= base_url('home/formnotadinas/' . $alldisposisi->slug_surat); ?>"
                                class="btn btn-primary btn-sm btn-custome text-capitalize font-weight-bold">selesai</a>
                            <?php $c++; } ?>
                            <?php } ?>
                            <?php } ?>
                            <a class="btn btn-sm btn-light btn-custome font-weight-bold"
                                href="<?= site_url('Surat/getFileDisposisi/' . $alldisposisi->slug_surat); ?>"
                                target="_blank">Unduh</a>
                        </div>
                    </div>
                </td>
                <?php } ?>
                <?php } else { ?>
                <?php if ($alldisposisi->pembuat_disposisi != $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                <td>
                    <div class="border-left-success">
                        <p class="text-capitalize font-weight-bold"
                            style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                            <?php if(isset($pembuat_disposisi[$h]->nama)) { ?>
                            <?= $pembuat_disposisi[$h]->nama; ?> |
                            <?php } ?>
                            <?= $alldisposisi->perihal; ?>
                        </p>
                        <p class="text-capitalize" style="font-size: 12px;  margin-left: 10px; margin-bottom: 0px;">
                            <?= $alldisposisi->nomor_surat; ?> | <?= $alldisposisi->waktu_disposisi; ?> | <span
                                class="text-danger font-weight-bold"> <?= $alldisposisi->sifat; ?></span> |
                            <?= $alldisposisi->nomor_agenda; ?>
                        </p>
                        <div class="mt-1" style="margin-left: 10px;">
                        <?php if(isset($getStatusPenerimaSuratDisposisi[$c]->nomor_surat) && $getStatusPenerimaSuratDisposisi[$c]->nota == null){  ?>
                                <?php if($getStatusPenerimaSuratDisposisi[$c]->nomor_surat == $alldisposisi->nomor_surat) { ?>
                            <?php if ($alldisposisi->pembuat_disposisi != $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                            <a href="<?= base_url('home/formnotadinas/' . $alldisposisi->slug_surat); ?>"
                                class="btn btn-primary btn-sm btn-custome text-capitalize font-weight-bold">selesai</a>
                            <?php $c++; } ?>
                            <?php } ?>
                            <?php } ?>
                            <a class="btn btn-sm btn-light btn-custome font-weight-bold"
                                href="<?= site_url('Surat/getFileDisposisi/' . $alldisposisi->slug_surat); ?>"
                                target="_blank">Unduh</a>
                        </div>
                    </div>
                </td>
                <?php } ?>
                <?php } ?>
            </tr>
            <?php $h++; } ?>
            <?php } else { ?>
            <!-- non agendaris -->
            <?php $i = 0;
                            foreach ($disposisi as $surat) { ?>
            <?php if($surat->nomor_agenda != null) { ?>
                <tr>
                <?php if ($surat->nota == null) { ?>
                <?php if ($surat->pembuat_disposisi != $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                <td>
                    <div class="border-left-primary">
                        <p class="text-capitalize font-weight-bold"
                            style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                            <?= $pembuat_disposisi[$i]->nama; ?> | <?= $surat->perihal; ?>
                        </p>
                        <p class="text-capitalize" style="font-size: 12px;  margin-left: 10px; margin-bottom: 0px;">
                            <?= $surat->nomor_surat; ?> | <?= $surat->waktu_disposisi; ?> | <span
                                class="text-danger font-weight-bold"> <?= $surat->sifat; ?></span> |
                            <?= $surat->nomor_agenda; ?>
                        </p>
                        <div class="mt-1" style="margin-left: 10px;">
                            <?php if ($surat->nota == null) { ?>
                            <?php if ($surat->pembuat_disposisi != $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                            <a href="<?= base_url('home/formnotadinas/' . $surat->slug_surat); ?>"
                                class="btn btn-primary btn-sm btn-custome text-capitalize font-weight-bold">selesai</a>
                            <?php } ?>
                            <?php } ?>
                            <?php if ($surat->jumlah_atasan < $max[0]->jumlah_atasan &&  $surat->pembuat_disposisi != $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                            <a class="btn btn-sm btn-success btn-custome font-weight-bold btn_redisposisi" href="#"
                                data-toggle="modal" data-placement="top" title="Detail Informasi"
                                data-target=".redisposisi" data-id="<?= $surat->nomor_surat; ?>">Redisposisi</a>
                            <?php } ?>
                            <a class="btn btn-sm btn-light btn-custome font-weight-bold"
                                href="<?= site_url('Surat/getFileDisposisi/' . $surat->slug_surat); ?>"
                                target="_blank">Unduh</a>
                        </div>
                    </div>
                </td>
                <?php } else { ?>
                <td>
                    <div class="border-left-primary">
                        <p class="text-capitalize font-weight-bold"
                            style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                            <?= $penerima_disposisi[$i]->nama; ?> | <?= $surat->perihal; ?>
                        </p>
                        <p class="text-capitalize" style="font-size: 12px;  margin-left: 10px; margin-bottom: 0px;">
                            <?= $surat->nomor_surat; ?> | <?= $surat->waktu_disposisi; ?> | <span
                                class="text-danger font-weight-bold"> <?= $surat->sifat; ?></span> |
                            <?= $surat->nomor_agenda; ?>
                        </p>
                        <div class="mt-1" style="margin-left: 10px;">
                            <?php if ($surat->nota == null) { ?>
                            <?php if ($surat->pembuat_disposisi != $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                            <a href="<?= base_url('home/formnotadinas/' . $surat->slug_surat); ?>"
                                class="btn btn-primary btn-sm btn-custome text-capitalize font-weight-bold">selesai</a>
                            <?php } ?>
                            <?php } ?>
                            <?php if ($surat->jumlah_atasan < $max[0]->jumlah_atasan &&  $surat->pembuat_disposisi != $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                            <a class="btn btn-sm btn-success btn-custome font-weight-bold btn_redisposisi" href="#"
                                data-toggle="modal" data-placement="top" title="Detail Informasi"
                                data-target=".redisposisi" data-id="<?= $surat->nomor_surat; ?>">Redisposisi</a>
                            <?php } ?>
                            <a class="btn btn-sm btn-light btn-custome font-weight-bold"
                                href="<?= site_url('Surat/getFileDisposisi/' . $surat->slug_surat); ?>"
                                target="_blank">Unduh</a>
                        </div>
                    </div>
                </td>
                <?php } ?>
                <?php } else { ?>
                <?php if ($surat->pembuat_disposisi != $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                <td>
                    <div class="border-left-success">
                        <p class="text-capitalize font-weight-bold"
                            style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                            <?= $pembuat_disposisi[$i]->nama; ?> | <?= $surat->perihal; ?>
                        </p>
                        <p class="text-capitalize" style="font-size: 12px;  margin-left: 10px; margin-bottom: 0px;">
                            <?= $surat->nomor_surat; ?> | <?= $surat->waktu_disposisi; ?> | <span
                                class="text-danger font-weight-bold"> <?= $surat->sifat; ?></span> |
                            <?= $surat->nomor_agenda; ?>
                        </p>
                        <div class="mt-1" style="margin-left: 10px;">
                            <?php if ($surat->nota == null) { ?>
                            <?php if ($surat->pembuat_disposisi != $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                            <a href="<?= base_url('home/formnotadinas/' . $surat->slug_surat); ?>"
                                class="btn btn-primary btn-sm btn-custome text-capitalize font-weight-bold">selesai</a>
                            <?php } ?>
                            <?php } ?>
                            <?php if ($surat->jumlah_atasan < $max[0]->jumlah_atasan &&  $surat->pembuat_disposisi != $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                            <a class="btn btn-sm btn-success btn-custome font-weight-bold btn_redisposisi" href="#"
                                data-toggle="modal" data-placement="top" title="Detail Informasi"
                                data-target=".redisposisi" data-id="<?= $surat->nomor_surat; ?>">Redisposisi</a>
                            <?php } ?>
                            <a class="btn btn-sm btn-light btn-custome font-weight-bold"
                                href="<?= site_url('Surat/getFileDisposisi/' . $surat->slug_surat); ?>"
                                target="_blank">Unduh</a>
                        </div>
                    </div>
                </td>
                <?php } else { ?>
                <td>
                    <div class="border-left-success">
                        <p class="text-capitalize font-weight-bold"
                            style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                            <?= $penerima_disposisi[$i]->nama; ?> | <?= $surat->perihal; ?>
                        </p>
                        <p class="text-capitalize" style="font-size: 12px;  margin-left: 10px; margin-bottom: 0px;">
                            <?= $surat->nomor_surat; ?> | <?= $surat->waktu_disposisi; ?> | <span
                                class="text-danger font-weight-bold"> <?= $surat->sifat; ?></span> |
                            <?= $surat->nomor_agenda; ?>
                        </p>
                        <div class="mt-1" style="margin-left: 10px;">
                            <?php if ($surat->nota == null) { ?>
                            <?php if ($surat->pembuat_disposisi != $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                            <a href="<?= base_url('home/formnotadinas/' . $surat->slug_surat); ?>"
                                class="btn btn-primary btn-sm btn-custome text-capitalize font-weight-bold">selesai</a>
                            <?php } ?>
                            <?php } ?>
                            <?php if ($surat->jumlah_atasan < $max[0]->jumlah_atasan &&  $surat->pembuat_disposisi != $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                            <a class="btn btn-sm btn-success btn-custome font-weight-bold btn_redisposisi" href="#"
                                data-toggle="modal" data-placement="top" title="Detail Informasi"
                                data-target=".redisposisi" data-id="<?= $surat->nomor_surat; ?>">Redisposisi</a>
                            <?php } ?>
                            <a class="btn btn-sm btn-light btn-custome font-weight-bold"
                                href="<?= site_url('Surat/getFileDisposisi/' . $surat->slug_surat); ?>"
                                target="_blank">Unduh</a>
                        </div>
                    </div>
                </td>
                <?php } ?>
                <?php } ?>
            </tr>
            <?php } ?>
            <?php
                                $i++;
                            } ?>

            <?php } ?>
            <?php }else{  ?>
            <div class="mt-4 text-center text-capitalize">
                data tidak ditemukan
            </div>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php echo $this->pagination->create_links(); ?>
<script>
$('.btn_redisposisi').on('click', function() {
    let base_url = $('#url').val();
    let id = $(this).data('id');
    $.ajax({
        url: base_url + "Surat/getSuratMasuk",
        data: {
            id: id
        },
        method: 'post',
        dataType: 'json',
        success: function(data) {
            $('.info_no_surat').html(data.surat_masuk[0].nomor_surat);
            $('.nomor_surat').val(data.surat_masuk[0].nomor_surat);
            $('.info_waktu_surat_masuk').html(data.surat_masuk[0].tanggal);
            $('.info_asal_surat').html(data.surat_masuk[0].asal_surat);
            $('.info_perihal').html(data.surat_masuk[0].perihal);
            $('.info_jumlah_dokumen').html(data.dokumen);
            $('.info_tempat').html(data.surat_masuk[0].tempat);
        },
        error: function() {
            console.log("failed data request");
        }
    });
});
</script>