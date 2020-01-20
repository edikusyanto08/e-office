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
                <?php if ($key->pembuat == $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
                <tr>
                    <td style="font-size: 14px;">
                        <div class="border-left-primary">
                            <div style="margin-left: 10px;">
                                <span class="text-capitalize font-weight-bold text-primary">
                                    <?= $key->nama_instansi; ?> - <?= $key->nomor_surat_keluar; ?>
                                </span>
                            </div>
                            <div class="text-capitalize" style="margin-left: 10px;">
                                <?= $key->perihal; ?>
                            </div>
                        </div>
                    </td>
                    <td class="text-right">
                        <a href="#"
                            class="btn btn-sm btn-primary font-weight-bold lihatDetailSuratKeluar" data-id="<?= $key->nomor_surat_keluar; ?>" data-toggle="modal" data-target=".surat-keluar" data-toggle="tooltip" data-placement="top" title="Forward">Lihat</a>
                        <?php if ($pembuatsurat[$i]->pembuat == $this->session->userdata('sisule_cms_satuan_kerja')) { ?>
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