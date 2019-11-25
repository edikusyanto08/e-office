<div class="tab-content bg-white shadow mb-3" style="font-size: 14px; padding: 5px 10px; border-radius: 10px;">
    <div class="tab-pane fade show active" id="suratmasuk" role="tabpanel" aria-labelledby="pills-table-content-tab">
        <div class="row mt-3">
            <div class="col-sm-6">
                <h5 class="font-weight-bold text-center text-sm-left ml-3">Surat Keluar</h5>
            </div>
            <?php if ($cek_status_karyawan != null) { ?>
            <div class="col-sm-6 text-center text-sm-right">
                <a href="<?= base_url(); ?>home/formsuratkeluar"
                    class="font-weight-bold ml-3 btn btn-sm btn-primary text-white " style="margin-right: 10px;">Buat
                    Surat</a>
            </div>
            <?php } ?>
        </div>
        <hr>
        <div>
            <?php if ($suratkeluar != null) { ?>
            <?php //var_dump($atasan); 
                    ?>
            <table class="table table-borderless">
                <?php $i = 0;
                        foreach ($suratkeluar as $key) { ?>
                <?php if ($key->pembuat == $this->session->userdata('sisule_cms_nip')) { ?>
                <tr>
                    <td class="text-center" style="width: 5%;">
                        <div class="border-left-primary">
                            <img class="ml-3" src="<?= base_url('assets/image/pns/' . $key->image); ?>" alt=""
                                style="width: 40px; height: 40px; border-radius: 100%;">
                        </div>
                    </td>
                    <td style="font-size: 14px;">
                        <span class="font-weight-bold">
                            <?= $key->nama; ?>
                        </span> -
                        <span class="text-capitalize text-primary">
                            <?= $key->nama_instansi; ?>
                        </span>
                        <br>
                        <?= $key->nomor_surat_keluar; ?> - <?= $key->perihal; ?>
                    </td>
                    <td align="center">
                        <?php if ($key->status == 0) { ?>
                        <span class="bg-warning text-white"
                            style="padding: 3px; font-size: 10px; border-radius: 5px;">Produksi</span>
                        <?php } elseif ($key->status == 1) { ?>
                        <span class="bg-info text-white"
                            style="padding: 3px; font-size: 10px; border-radius: 5px;">Disetujui</span>
                        <?php } elseif ($key->status == 2) { ?>
                        <span class="bg-success text-white"
                            style="padding: 3px; font-size: 10px; border-radius: 5px;">Selesai</span>
                        <?php } ?>
                    </td>
                    <td class="text-right">
                        <a href="<?= base_url('home/prosessuratkeluar/' . $key->slug_surat); ?>"
                            class="btn btn-sm btn-primary font-weight-bold">Lihat</a>
                        <?php if ($pembuatsurat[$i]->pembuat == $this->session->userdata('sisule_cms_nip')) { ?>
                        <a href="<?= base_url('surat/hapussuratkeluar/' . $key->slug_surat); ?>"
                            class="btn btn-sm btn-light font-weight-bold"
                            onclick="javascript: return confirm('Anda yakin hapus ?')">Hapus</a>
                        <?php } ?>
                    </td>
                </tr>
                <?php } elseif ($agendaris != null) { ?>
                <tr>
                    <td class="text-center" style="width: 5%;">
                        <div class="border-left-default">
                            <img class="ml-3" src="<?= base_url('assets/image/pns/' . $pembuatsurat[$i]->image); ?>"
                                alt="" style="width: 40px; height: 40px; border-radius: 100%;">
                        </div>
                    </td>
                    <td style="font-size: 14px;">
                        <span class="font-weight-bold">
                            <?= $pembuatsurat[$i]->nama; ?>
                        </span> -
                        <span class="text-capitalize text-primary">
                            <?= $pembuatsurat[$i]->nama_instansi; ?>
                        </span>
                        <br>
                        <?= $key->nomor_surat_keluar; ?> - <?= $key->perihal; ?>
                    </td>
                    <td align="center">
                        <?php if ($key->status == 0) { ?>
                        <span class="bg-warning text-white"
                            style="padding: 3px; font-size: 10px; border-radius: 5px;">Produksi</span>
                        <?php } elseif ($key->status == 1) { ?>
                        <span class="bg-info text-white"
                            style="padding: 3px; font-size: 10px; border-radius: 5px;">Disetujui</span>
                        <?php } elseif ($key->status == 2) { ?>
                        <span class="bg-success text-white"
                            style="padding: 3px; font-size: 10px; border-radius: 5px;">Selesai</span>
                        <?php } ?>
                    </td>
                    <td class="text-right">
                        <a href="<?= base_url('home/prosessuratkeluar/' . $key->slug_surat); ?>"
                            class="btn btn-sm btn-primary font-weight-bold">Lihat</a>
                        <?php if ($pembuatsurat[$i]->pembuat == $this->session->userdata('sisule_cms_nip')) { ?>
                        <a href="<?= base_url('surat/hapussuratkeluar/' . $key->slug_surat); ?>"
                            class="btn btn-sm btn-light font-weight-bold"
                            onclick="javascript: return confirm('Anda yakin hapus ?')">Hapus</a>
                        <?php } ?>
                    </td>
                </tr>

                <?php } elseif ($key->pembuat != $this->session->userdata('sisule_cms_nip') && $atasan[$i]->atasan == $this->session->userdata('sisule_cms_nip')) { ?>

                <tr>
                    <td class="text-center" style="width: 5%;">
                        <div class="border-left-default">
                            <img class="ml-3" src="<?= base_url('assets/image/pns/' . $pembuatsurat[$i]->image); ?>"
                                alt="" style="width: 40px; height: 40px; border-radius: 100%;">
                        </div>
                    </td>
                    <td style="font-size: 14px;">
                        <span class="font-weight-bold">
                            <?= $pembuatsurat[$i]->nama; ?>
                        </span> -
                        <span class="text-capitalize text-primary">
                            <?= $pembuatsurat[$i]->nama_instansi; ?>
                        </span>
                        <br>
                        <?= $key->nomor_surat_keluar; ?> - <?= $key->perihal; ?>
                    </td>
                    <td align="center">
                        <?php if ($key->status == 0) { ?>
                        <span class="bg-warning text-white"
                            style="padding: 3px; font-size: 10px; border-radius: 5px;">Produksi</span>
                        <?php } elseif ($key->status == 1) { ?>
                        <span class="bg-info text-white"
                            style="padding: 3px; font-size: 10px; border-radius: 5px;">Disetujui</span>
                        <?php } elseif ($key->status == 2) { ?>
                        <span class="bg-success text-white"
                            style="padding: 3px; font-size: 10px; border-radius: 5px;">Selesai</span>
                        <?php } ?>
                    </td>
                    <td class="text-right">
                        <a href="<?= base_url('home/prosessuratkeluar/' . $key->slug_surat); ?>"
                            class="btn btn-sm btn-primary font-weight-bold">Lihat</a>
                        <?php if ($pembuatsurat[$i]->pembuat == $this->session->userdata('sisule_cms_nip')) { ?>
                        <a href="<?= base_url('surat/hapussuratkeluar/' . $key->slug_surat); ?>"
                            class="btn btn-sm btn-light font-weight-bold"
                            onclick="javascript: return confirm('Anda yakin hapus ?')">Hapus</a>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
                <?php $i++;
                        } ?>
            </table>
            <?php } else { ?>
            <p class="text-center mt-5">
                Data tidak ditemukan.
            </p>
            <?php } ?>
        </div>
    </div>
    <?php echo $this->pagination->create_links(); ?>
</div>