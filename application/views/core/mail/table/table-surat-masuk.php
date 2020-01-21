<div class="tab-content bg-white shadow mb-3" style="font-size: 14px; padding: 5px 10px; border-radius: 10px;">
    <div class="tab-pane fade show active" id="suratmasuk" role="tabpanel" aria-labelledby="pills-table-content-tab">
        <div class="border-bottom">
            <p>
                <h5 class="font-weight-bold ml-3">Surat Masuk</h5>
            </p>
        </div>
        <table class="table table-borderless table-sm">
            <?php if ($surat != null) { ?>
            <tbody>
                <?php $i = 0;
                        foreach ($surat as $surat) { ?>
                <tr style="color: #5a5c69;">
                    <!-- ketika belum didispoisis oleh kepala dinas -->
                    <?php if ($surat->status == '0') { ?>
                        <?php if ($surat->penangguhan == '1') { ?>
                        <td style="margin-bottom: 0px;">
                            <div class="border-left-warning">
                                <a href="#" class="preview" data-toggle="modal" data-placement="top"
                                    title="Detail Informasi" data-target=".preview-surat-masuk"
                                    data-id="<?= $surat->nomor_surat; ?>"
                                    style="font-size: 14px; color: rgb(90, 92, 105); ">
                                    <p class="font-weight-bold"
                                        style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                                        <?php if ($surat->agendaris_surat == $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                                        <?= $penerima_surat_masuk[$i]->nama_bidang ?>
                                        <?php } elseif($surat->pembuat == $this->session->userdata('sisule_cms_satuan_kerja') && $surat->agendaris_surat == $this->session->userdata('sisule_cms_satuan_kerja')) {
                                                                            echo $penerima_surat_masuk[$i]->nama_bidang;
                                                                        }else{ echo $surat->nama_bidang; }?>
                                        | <span class="text-capitalize"><?= $surat->perihal; ?></span>
                                    </p>
                                    <p class="text-capitalize"
                                        style="font-size: 12px;  margin-left: 10px; margin-bottom: 0px;">
                                        <?= $surat->nomor_surat; ?> | <?= $surat->asal_surat; ?> | <?= $surat->tanggal; ?>
                                    </p>
                                </a>
                                <div class="mt-1">
                                    <div class="row" style="margin-left: 10px;">
                                    <div class="col-xs-9">
                                        <?php if ($surat->agendaris_surat == $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                                            <?php if($surat->external == 0 && $surat->internal == 0 ){ ?>
                                                <a href="<?= base_url('home/updatesuratmasuk/' . $surat->slug_surat); ?>"
                                                class="btn btn-dark btn-sm font-weight-bold btn-custome" data-toggle="tooltip"
                                                data-placement="top" title="Perbaharui" style="font-size: 12px;">Edit</a>
                                            <?php } ?>
                                    <?php } else { ?>
                                        <?php if($surat->agendaris_surat != $this->session->userdata('sisule_cms_satuan_kerja') && $penerima_surat_masuk[$i]->kode_struktur_organisasi == $this->session->userdata('sisule_cms_satuan_kerja') && $surat->keterangan_pembuatan == '0') { ?>
                                        <a href="#" class="btn btn-primary btn-sm disposisiSurat font-weight-bold  btn-custome"
                                            data-toggle="modal" data-target=".surat-disposisi" data-toggle="tooltip"
                                            data-placement="top" title="Disposisi"
                                            data-id="<?= $surat->nomor_surat; ?>">Disposisi</a>
                                        <?php }else{ ?>
                                        <?php if($surat->agendaris_instansi != $this->session->userdata('sisule_cms_satuan_kerja')){ ?>
                                                <a href="#" class="btn btn-primary btn-sm disposisiSurat font-weight-bold  btn-custome"
                                                data-toggle="modal" data-target=".surat-disposisi" data-toggle="tooltip"
                                                data-placement="top" title="Disposisi"
                                                data-id="<?= $surat->nomor_surat; ?>">Disposisi</a>
                                            <?php }else{ ?>
                                            <a href="#" class="btn btn-primary btn-sm preview font-weight-bold btn-custome"
                                                data-toggle="modal" data-target=".surat-teruskan" data-toggle="tooltip"
                                                data-placement="top" title="Forward"
                                                data-id="<?= $surat->nomor_surat; ?>">Teruskan</a>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if($surat->keterangan_pembuatan == '1') { ?>
                                    <a href="<?= site_url('Surat/getFileSuratMasuk/' . $surat->slug_surat); ?>"
                                        class="btn btn-sm btn-light font-weight-bold btn-custome" target="_blank"
                                        data-toggle="tooltip" data-placement="top" title="Download">
                                        Unduh</a>
                                        </div>  
                                    <?php } elseif($surat->keterangan_pembuatan == '0') { ?>
                                    <a href="<?= site_url('Surat/getFileSuratMasuk/' . $surat->slug_surat); ?>"
                                        class="btn btn-sm btn-light font-weight-bold btn-custome" target="_blank"
                                        data-toggle="tooltip" data-placement="top" title="Download">
                                        Unduh</a>
                                        </div>
                                    <?php } else{ ?>

                                    <?php } ?>
                                        <div class="col-xs-2">
                                        <?php if ($surat->agendaris_surat == $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                                            <?php if($surat->external == 0 && $surat->internal == 0 ){ ?>
                                            <a href="<?= base_url('Surat/deleteSuratMasukSementara/' . $surat->slug_surat); ?>"
                                        class="btn btn-default btn-sm font-weight-bold text-danger btn-custome" data-toggle="tooltip"
                                        data-placement="top" title="Hapus Sementara"
                                        onclick="javascript: return confirm('Anda yakin hapus ?')"
                                        style="font-size: 12px;">Hapus</a>
                                            <?php } ?>
                                        <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <?php } else { ?>
                        <td >
                            <div class="border-left-default">
                                <a href="#" class="preview" data-toggle="modal" data-placement="top"
                                    title="Detail Informasi" data-target=".preview-surat-masuk"
                                    data-id="<?= $surat->nomor_surat; ?>"
                                    style="font-size: 14px; color: rgb(90, 92, 105); ">
                                    <p class="font-weight-bold"
                                        style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                                        <!-- pembuat -->
                                        <?php if ($surat->agendaris_surat == $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                                        <?= $penerima_surat_masuk[$i]->nama_bidang; ?>
                                        <?php } elseif($surat->pembuat == $this->session->userdata('sisule_cms_satuan_kerja') && $surat->agendaris_surat == $this->session->userdata('sisule_cms_satuan_kerja')) {
                                                                            echo $penerima_surat_masuk[$i]->nama_bidang;
                                                                        }else{ echo $surat->nama_bidang; }?>
                                        <!-- nomor & perihal surat -->
                                        | <span class="text-capitalize"><?= $surat->perihal; ?></span>
                                    </p>
                                    <p class="text-capitalize"
                                        style="font-size: 12px;  margin-left: 10px; margin-bottom: 0px;">
                                        <?= $surat->nomor_surat; ?> | <?= $surat->asal_surat; ?> | <?= $surat->tanggal; ?>
                                    </p>
                                </a>
                                <div class="mt-1">
                                <div class="row" style="margin-left: 10px;">
                                        <div class="col-xs-9">
                                        <?php if ($surat->agendaris_surat == $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                                            <?php if($surat->external == 0 && $surat->internal == 0 ){ ?>
                                                <a href="<?= base_url('home/updatesuratmasuk/' . $surat->slug_surat); ?>"
                                                class="btn btn-dark btn-sm font-weight-bold  btn-custome" data-toggle="tooltip"
                                                data-placement="top" title="Perbaharui" style="font-size: 12px;">Edit</a>
                                            <?php } ?>
                                    <?php } else { ?>
                                        <?php if($surat->agendaris_surat != $this->session->userdata('sisule_cms_satuan_kerja') && $penerima_surat_masuk[$i]->kode_struktur_organisasi == $this->session->userdata('sisule_cms_satuan_kerja') && $surat->keterangan_pembuatan == '0') { ?>
                                        <a href="#" class="btn btn-primary btn-sm disposisiSurat font-weight-bold  btn-custome"
                                            data-toggle="modal" data-target=".surat-disposisi" data-toggle="tooltip"
                                            data-placement="top" title="Disposisi"
                                            data-id="<?= $surat->nomor_surat; ?>">Disposisi</a>
                                        <?php }else{ ?>
                                            <?php if($surat->agendaris_instansi != $this->session->userdata('sisule_cms_satuan_kerja')){ ?>
                                                <a href="#" class="btn btn-primary btn-sm disposisiSurat font-weight-bold  btn-custome"
                                                data-toggle="modal" data-target=".surat-disposisi" data-toggle="tooltip"
                                                data-placement="top" title="Disposisi"
                                                data-id="<?= $surat->nomor_surat; ?>">Disposisi</a>
                                            <?php }else{ ?>
                                            <a href="#" class="btn btn-primary btn-sm preview font-weight-bold btn-custome"
                                                data-toggle="modal" data-target=".surat-teruskan" data-toggle="tooltip"
                                                data-placement="top" title="Forward"
                                                data-id="<?= $surat->nomor_surat; ?>">Teruskan</a>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                    <a href="<?= site_url('Surat/getFileSuratMasuk/' . $surat->slug_surat); ?>"
                                        class="btn btn-sm btn-light font-weight-bold  btn-custome" target="_blank"
                                        data-toggle="tooltip" data-placement="top" title="Download">
                                        Unduh</a>
                                        </div>
                                        <div class="col-xs-2">
                                        <?php if ($surat->agendaris_surat == $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                                            <?php if($surat->external == 0 && $surat->internal == 0 ){ ?>
                                            <a href="<?= base_url('Surat/deleteSuratMasukSementara/' . $surat->slug_surat); ?>"
                                        class="btn btn-default btn-sm font-weight-bold text-danger  btn-custome" data-toggle="tooltip"
                                        data-placement="top" title="Hapus Sementara"
                                        onclick="javascript: return confirm('Anda yakin hapus ?')"
                                        style="font-size: 12px;">Hapus</a>
                                            <?php } ?>
                                        <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <?php } ?>
                    <!-- ketika sudah didisposisi oleh kepala dinas -->
                    <?php } elseif ($surat->status == '1') { ?>
                    <?php if ($surat->penangguhan == '1') { ?>
                    <td >
                        <div class="border-left-warning">
                            <a href="#" class="preview" data-toggle="modal" data-placement="top"
                                title="Detail Informasi" data-target=".preview-surat-masuk"
                                data-id="<?= $surat->nomor_surat; ?>"
                                style="font-size: 14px; color: rgb(90, 92, 105); ">
                                <p class="font-weight-bold"
                                    style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                                    <!-- pembuat -->
                                    <?php if ($surat->agendaris_surat == $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                                    <?= $penerima_surat_masuk[$i]->nama_bidang ?>
                                    <?php } elseif($surat->pembuat == $this->session->userdata('sisule_cms_satuan_kerja') && $surat->agendaris_surat == $this->session->userdata('sisule_cms_satuan_kerja')) {
                                                                        echo $penerima_surat_masuk[$i]->nama_bidang;
                                                                    }else{ echo $surat->nama_bidang; }?>
                                    | <span class="text-capitalize"><?= $surat->perihal; ?></span>
                                </p>
                                <p class="text-capitalize"
                                    style="font-size: 12px;  margin-left: 10px; margin-bottom: 0px;">
                                    <?= $surat->nomor_surat; ?> | <?= $surat->asal_surat; ?> | <?= $surat->tanggal; ?>
                                </p>
                            </a>
                            <div class="mt-1">
                            <div class="row"  style="margin-left: 10px;">
                            <div class="col-xs-9">
                                    <?php if ($surat->agendaris_surat == $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                                        <?php if($surat->external == 0 && $surat->internal == 0 ){ ?>
                                            <a href="<?= base_url('home/updatesuratmasuk/' . $surat->slug_surat); ?>"
                                            class="btn btn-dark btn-sm font-weight-bold  btn-custome" data-toggle="tooltip"
                                            data-placement="top" title="Perbaharui" style="font-size: 12px;">Edit</a>
                                        <?php } ?>
                                <?php } else { ?>
                                    <a href="#" class="btn btn-primary btn-sm disposisiSurat font-weight-bold  btn-custome"
                                    data-toggle="modal" data-target=".surat-disposisi" data-toggle="tooltip"
                                    data-placement="top" title="Disposisi"
                                    data-id="<?= $surat->nomor_surat; ?>">Disposisi</a>
                                <?php } ?>
                                <a href="<?= site_url('Surat/getFileSuratMasuk/' . $surat->slug_surat); ?>"
                                    class="btn btn-sm btn-light font-weight-bold  btn-custome" target="_blank"
                                    data-toggle="tooltip" data-placement="top" title="Download">
                                    Unduh</a>
                                    </div>
                                    <div class="col-xs-2">
                                    <?php if ($surat->agendaris_surat == $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                                         <?php if($surat->external == 0 && $surat->internal == 0 ){ ?>
                                        <a href="<?= base_url('Surat/deleteSuratMasukSementara/' . $surat->slug_surat); ?>"
                                    class="btn btn-default btn-sm font-weight-bold text-danger  btn-custome" data-toggle="tooltip"
                                    data-placement="top" title="Hapus Sementara"
                                    onclick="javascript: return confirm('Anda yakin hapus ?')"
                                    style="font-size: 12px;">Hapus</a>
                                        <?php } ?>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <?php } else { ?>
                    <td >
                        <div class="border-left-danger">
                            <a href="#" class="preview" data-toggle="modal" data-placement="top"
                                title="Detail Informasi" data-target=".preview-surat-masuk"
                                data-id="<?= $surat->nomor_surat; ?>"
                                style="font-size: 14px; color: rgb(90, 92, 105); ">
                                <p class="font-weight-bold"
                                    style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                                <!-- pembuat -->
                                <?php if ($surat->agendaris_surat == $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                                    <?= $penerima_surat_masuk[$i]->nama_bidang ?>
                                    <?php } elseif($surat->pembuat == $this->session->userdata('sisule_cms_satuan_kerja') && $surat->agendaris_surat == $this->session->userdata('sisule_cms_satuan_kerja')) {
                                                                        echo $penerima_surat_masuk[$i]->nama_bidang;
                                                                    }else{ echo $surat->nama_bidang; }?>
                                    | <span class="text-capitalize"><?= $surat->perihal; ?></span>
                                </p>
                                <p class="text-capitalize"
                                    style="font-size: 12px;  margin-left: 10px; margin-bottom: 0px;">
                                    <?= $surat->nomor_surat; ?> | <?= $surat->asal_surat; ?> | <?= $surat->tanggal; ?>
                                </p>
                            </a>
                            <div class="mt-1" >
                            <div class="row" style="margin-left: 10px;">
                            <div class="col-xs-9">
                                    <?php if ($surat->agendaris_surat == $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                                         <?php if($surat->external == 0 && $surat->internal == 0 ){ ?>
                                            <a href="<?= base_url('home/updatesuratmasuk/' . $surat->slug_surat); ?>"
                                            class="btn btn-dark btn-sm font-weight-bold  btn-custome" data-toggle="tooltip"
                                            data-placement="top" title="Perbaharui" style="font-size: 12px;">Edit</a>
                                        <?php } ?>
                                <?php } else { ?>
                                    <a href="#" class="btn btn-primary btn-sm disposisiSurat font-weight-bold  btn-custome"
                                    data-toggle="modal" data-target=".surat-disposisi" data-toggle="tooltip"
                                    data-placement="top" title="Disposisi"
                                    data-id="<?= $surat->nomor_surat; ?>">Disposisi</a>
                                <?php } ?>
                                <a href="<?= site_url('Surat/getFileSuratMasuk/' . $surat->slug_surat); ?>"
                                    class="btn btn-sm btn-light font-weight-bold  btn-custome" target="_blank"
                                    data-toggle="tooltip" data-placement="top" title="Download">
                                    Unduh</a>
                                    </div>
                                    <div class="col-xs-2">
                                    <?php if ($surat->agendaris_surat == $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                                         <?php if($surat->external == 0 && $surat->internal == 0 ){ ?>
                                        <a href="<?= base_url('Surat/deleteSuratMasukSementara/' . $surat->slug_surat); ?>"
                                    class="btn btn-default btn-sm font-weight-bold text-danger  btn-custome" data-toggle="tooltip"
                                    data-placement="top" title="Hapus Sementara"
                                    onclick="javascript: return confirm('Anda yakin hapus ?')"
                                    style="font-size: 12px;">Hapus</a>
                                        <?php } ?>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <?php } ?>
                    <!-- ketika selesai didisposisi -->
                    <?php } elseif ($surat->status == '2') { ?>
                    <?php if ($surat->penangguhan == '1') { ?>
                    <td >
                        <div class="border-left-warning">
                            <a href="#" class="preview" data-toggle="modal" data-placement="top"
                                title="Detail Informasi" data-target=".preview-surat-masuk"
                                data-id="<?= $surat->nomor_surat; ?>"
                                style="font-size: 14px; color: rgb(90, 92, 105); ">
                                <p class="font-weight-bold"
                                    style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                                <!-- pembuat -->
                                <?php if ($surat->agendaris_surat == $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                                    <?= $penerima_surat_masuk[$i]->nama_bidang ?>
                                    <?php } elseif($surat->pembuat == $this->session->userdata('sisule_cms_satuan_kerja') && $surat->agendaris_surat == $this->session->userdata('sisule_cms_satuan_kerja')) {
                                                                        echo $penerima_surat_masuk[$i]->nama_bidang;
                                                                    }else{ echo $surat->nama_bidang; }?>
                                    | <span class="text-capitalize"><?= $surat->perihal; ?></span>
                                </p>
                                <p class="text-capitalize"
                                    style="font-size: 12px;  margin-left: 10px; margin-bottom: 0px;">
                                    <?= $surat->nomor_surat; ?> | <?= $surat->asal_surat; ?> | <?= $surat->tanggal; ?>
                                </p>
                            </a>
                            <div class="mt-1">
                            <div class="row"  style="margin-left: 10px;">
                            <div class="col-xs-9">
                                    <?php if ($surat->agendaris_surat == $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                                         <?php if($surat->external == 0 && $surat->internal == 0 ){ ?>
                                            <a href="<?= base_url('home/updatesuratmasuk/' . $surat->slug_surat); ?>"
                                            class="btn btn-dark btn-sm font-weight-bold  btn-custome" data-toggle="tooltip"
                                            data-placement="top" title="Perbaharui" style="font-size: 12px;">Edit</a>
                                        <?php } ?>
                                <?php } else { ?>
                                    <a href="#" class="btn btn-primary btn-sm disposisiSurat font-weight-bold  btn-custome"
                                    data-toggle="modal" data-target=".surat-disposisi" data-toggle="tooltip"
                                    data-placement="top" title="Disposisi"
                                    data-id="<?= $surat->nomor_surat; ?>">Disposisi</a>
                                <?php } ?>
                                <a href="<?= site_url('Surat/getFileSuratMasuk/' . $surat->slug_surat); ?>"
                                    class="btn btn-sm btn-light font-weight-bold  btn-custome" target="_blank"
                                    data-toggle="tooltip" data-placement="top" title="Download">
                                    Unduh</a>
                                    </div>
                                    <div class="col-xs-2">
                                    <?php if ($surat->agendaris_surat == $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                                         <?php if($surat->external == 0 && $surat->internal == 0 ){ ?>
                                        <a href="<?= base_url('Surat/deleteSuratMasukSementara/' . $surat->slug_surat); ?>"
                                    class="btn btn-default btn-sm font-weight-bold text-danger  btn-custome" data-toggle="tooltip"
                                    data-placement="top" title="Hapus Sementara"
                                    onclick="javascript: return confirm('Anda yakin hapus ?')"
                                    style="font-size: 12px;">Hapus</a>
                                        <?php } ?>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <?php } else { ?>
                    <td >
                        <div class="border-left-primary">
                            <a href="#" class="preview" data-toggle="modal" data-placement="top"
                                title="Detail Informasi" data-target=".preview-surat-masuk"
                                data-id="<?= $surat->nomor_surat; ?>"
                                style="font-size: 14px; color: rgb(90, 92, 105); ">
                                <p class="font-weight-bold "
                                    style="font-size: 14px; margin-left: 10px; margin-bottom: 0px;">
                                    <!-- pembuat -->
                                    <?php if ($surat->agendaris_surat == $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                                    <?= $penerima_surat_masuk[$i]->nama_bidang ?>
                                    <?php } elseif($surat->pembuat == $this->session->userdata('sisule_cms_satuan_kerja') && $surat->agendaris_surat == $this->session->userdata('sisule_cms_satuan_kerja')) {
                                                                        echo $penerima_surat_masuk[$i]->nama_bidang;
                                                                    }else{ echo $surat->nama_bidang; }?>
                                    | <span class="text-capitalize"><?= $surat->perihal; ?></span>
                                </p>
                                <p class="text-capitalize"
                                    style="font-size: 12px;  margin-left: 10px; margin-bottom: 0px;">
                                    <?= $surat->nomor_surat; ?> | <?= $surat->asal_surat; ?> | <?= $surat->tanggal; ?>
                                </p>
                            </a>
                            <div class="mt-1">
                            <div class="row" style="margin-left: 10px;">
                            <div class="col-xs-9">
                                    <?php if ($surat->agendaris_surat == $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                                        <?php if($surat->external == 0 && $surat->internal == 0 ){ ?>
                                            <a href="<?= base_url('home/updatesuratmasuk/' . $surat->slug_surat); ?>"
                                            class="btn btn-dark btn-sm font-weight-bold btn-custome" data-toggle="tooltip"
                                            data-placement="top" title="Perbaharui" style="font-size: 12px;">Edit</a>
                                        <?php } ?>
                                <?php } else { ?>
                                    <a href="#" class="btn btn-primary btn-sm disposisiSurat font-weight-bold  btn-custome"
                                    data-toggle="modal" data-target=".surat-disposisi" data-toggle="tooltip"
                                    data-placement="top" title="Disposisi"
                                    data-id="<?= $surat->nomor_surat; ?>">Disposisi</a>
                                <?php } ?>
                                <a href="<?= site_url('Surat/getFileSuratMasuk/' . $surat->slug_surat); ?>"
                                    class="btn btn-sm btn-light font-weight-bold  btn-custome" target="_blank"
                                    data-toggle="tooltip" data-placement="top" title="Download">
                                    Unduh</a>
                                    </div>
                                    <div class="col-xs-2">
                                    <?php if ($surat->agendaris_surat == $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                                         <?php if($surat->external == 0 && $surat->internal == 0 ){ ?>
                                        <a href="<?= base_url('Surat/deleteSuratMasukSementara/' . $surat->slug_surat); ?>"
                                    class="btn btn-default btn-sm font-weight-bold text-danger  btn-custome" data-toggle="tooltip"
                                    data-placement="top" title="Hapus Sementara"
                                    onclick="javascript: return confirm('Anda yakin hapus ?')"
                                    style="font-size: 12px;">Hapus</a>
                                        <?php } ?>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <?php } ?>
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
    <?= $this->pagination->create_links(); ?>
</div>