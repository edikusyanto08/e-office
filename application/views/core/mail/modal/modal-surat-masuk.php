<!-- modal teruskan surat masuk -->
<div class="modal fade bd-example-modal-lg surat-teruskan" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <span class="text-dark font-weight-bold">Teruskan Surat Masuk</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="font-size: 12px;">
                <h6 class="font-weight-bold" style="font-size: 14px; color: #000;">Informasi</h6>
                <table class="table table-borderless table-sm text-capitalize" style="font-size: 14px;">
                    <tr style="color: #000;">
                        <td style="width: 20%;">No. Surat</td>
                        <td style="width: 2%;">:</td>
                        <td><span id="no_surat" class="info_no_surat"></td>
                    </tr>
                    <tr style="color: #000;">
                        <td>Diterima</td>
                        <td style="width: 2%;">:</td>
                        <td><span class="info_waktu_surat_masuk"></span></td>
                    </tr>
                    <tr style="color: #000;">
                        <td>Perihal</td>
                        <td style="width: 2%;">:</td>
                        <td><span class="info_perihal"></span></td>
                    </tr>
                    <tr style="color: #000;">
                        <td>Asal Surat</td>
                        <td style="width: 2%;">:</td>
                        <td><span class="info_asal_surat"></span></td>
                    </tr>
                    <tr>
                        <td colspan="3"><hr></td>
                    </tr>
                    <tr ><td colspan="3"> <h6 class="font-weight-bold" style="font-size: 14px; color: #000; margin-left: -8px;">Pelaksanaan</h6></td></tr>
                    <tr style="color: #000;">
                        <td>Waktu</td>
                        <td style="width: 2%;">:</td>
                        <td><span class="info_pelaksanaan"></span></span></td>
                    </tr>
                    <tr style="color: #000;">
                        <td>Tempat</td>
                        <td style="width: 2%;">:</td>
                        <td><span class="info_tempat"></span></td>
                    </tr>
                    <tr>
                        <td colspan="3"><hr></td>
                    </tr>
                </table>
                <h6 class="font-weight-bold" style="font-size: 14px; color: #000;">Teruskan</h6>
                <div class="form-group">
                    <label for="sifat" class="font-weight-bold text-dark">Pilih Penerima Surat</label>
                    <select class="custom-select" id="penerima_surat" name="penerima_surat">
                        <option value="0">Pilih Penerima Surat</option>
                        <?php foreach ($penerima as $obj) { ?>
                            <option value="<?= $obj->kode_struktur_organisasi; ?>"><?= $obj->nama; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm font-weight-bold sendTerusanSuratMasuk" data-dismiss="modal"
                    aria-label="Close">Kirim</button>
            </div>
        </div>
    </div>
</div>
<!-- modal surat disposisi -->
<div class="modal fade bd-example-modal-lg surat-disposisi" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="text-dark font-weight-bold">Form Surat Disposisi</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="font-size: 12px;">
                <!-- informasi surat -->
                <p class="font-weight-bold" style="font-size: 14px; color: #000;">Informasi</p>
                <table class="table table-borderless table-sm" style="font-size: 14px;">
                    <tr>
                        <td style="width: 15%;">
                            No. Surat
                        </td>
                        <td style="width: 1%;">:</td>
                        <td style="color: #000;">
                            <span class="info_no_surat get_info_no_surat">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Diterima
                        </td>
                        <td>:</td>
                        <td style="color: #000;">
                            <span class="info_waktu_surat_masuk"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Perihal
                        </td>
                        <td>:</td>
                        <td class="text-capitalize" style="color: #000;">
                            <span class="info_perihal"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Asal Surat
                        </td>
                        <td>:</td>
                        <td class="text-capitalize" style="color: #000;">
                            <span class="info_asal_surat"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Lampiran
                        </td>
                        <td>:</td>
                        <td style="color: #000;">
                            <span class="info_jumlah_dokumen"></span>
                        </td>
                    </tr>
                </table>
                <hr>
                <!-- form -->
                <p class="font-weight-bold" style="font-size: 14px; color: #000;">Form Disposisi</p>
                <div class="row">
                    <div class="col-lg-4 border-right">
                        <input type="hidden" name="id_surat_" class="form-control form-control-sm id_surat_">
                        <div class="form-group">
                            <label for="sifat" class=" font-weight-bold">Sifat</label>
                            <select class="custom-select custom-select-sm sifat_" id="sifat" name="sifat">
                                <option value="sangat segera">Sangat Segera</option>
                                <option value="segera">Segera</option>
                                <option value="rahasia">Rahasia</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="catatan" class="font-weight-bold">Catatan</label>
                            <textarea style="font-size: 14px;" name="catatan" id="" cols="5" rows="4"
                                class="form-control catatan_"></textarea>
                        </div>
                        <div class="form-group">
                            <label class=" font-weight-bold">Harapan</label>
                            <div class="custom-control custom-checkbox" style="text-size: 12px;">
                                <input type="checkbox" class="custom-control-input" id="tanggapan" value="1">
                                <label class="custom-control-label" for="tanggapan">Tanggapan dan Saran</label>
                            </div>
                            <div class="custom-control custom-checkbox" style="text-size: 12px;">
                                <input type="checkbox" class="custom-control-input" id="lanjutkan" value="1">
                                <label class="custom-control-label" for="lanjutkan">Proses lebih lanjut</label>
                            </div>
                            <div class="custom-control custom-checkbox" style="text-size: 12px;">
                                <input type="checkbox" class="custom-control-input" id="koordinasikan" value="1">
                                <label class="custom-control-label" for="koordinasikan">Koordinasi dan
                                    Konfirmasikan</label>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <label for="penerima_surat" class=" font-weight-bold">List Penerima Disposisi</label>
                            <div style="font-size: 13px;" style="margin-top: -100px;">
                                <span class="daftar_penerima_disposisi">-</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <h6>Apakah anda akan ikut menghadiri kegiatan berdasarkan surat masuk ini?</h6>
                        <div class="custom-control custom-checkbox" style="text-size: 12px;">
                            <input type="checkbox" class="custom-control-input" id="ikutsertakegiatan" value="1">
                            <label class="custom-control-label" for="ikutsertakegiatan">Ya, Saya ikut.</label>
                        </div>
                        <br>
                        <label for="cariPNS" class=" font-weight-bold">Search</label>
                        <form action="#">
                            <div class="form-group">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" autofocuss
                                        autocomplete="off" laceholder="Cari Penerima Disposisi Surat" id="cariPNS">
                                </div>
                                <div id="result"></div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-lg-6 m-0  text-center text-sm-left">
                                <label class="font-weight-bold" for="penerima">Daftar Calon Penerima Surat Keluar <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-lg-6 ml-auto text-center text-sm-right">
                                <button type="button" class="btn btn-default btn-sm resetDisposisi font-weight-bold"
                                    id="reset-disposisi">Reset Calon Penerima</button>
                            </div>
                        </div>
                        <table class="table table-sm">
                            <tbody id="tbl_result"></tbody>
                        </table>
                        <br>
                      
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm font-weight-bold sendDisposisi" data-dismiss="modal"
                    aria-label="Close">Kirim <i class=" fas fa-shipping-fast"></i></button>
            </div>
        </div>
    </div>
</div>

<!-- modal preview surat masuk -->
<div class="modal fade bd-example-modal-lg preview-surat-masuk" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="text-dark font-weight-bold">Preview Surat Masuk</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 class="font-weight-bold" style="font-size: 14px; color: #000;">Informasi</h6>
                <table class="table table-borderless table-sm text-capitalize" style="font-size: 14px;">
                    <tr style="color: #000;">
                        <td style="width: 20%;">No. Surat</td>
                        <td style="width: 2%;">:</td>
                        <td><span class="info_no_surat"></td>
                    </tr>
                    <tr style="color: #000;">
                        <td>Diterima</td>
                        <td style="width: 2%;">:</td>
                        <td><span class="info_waktu_surat_masuk"></span></td>
                    </tr>
                    <tr style="color: #000;">
                        <td>Lampiran</td>
                        <td style="width: 2%;">:</td>
                        <td><span class="info_jumlah_dokumen"></span></td>
                    </tr>
                    <tr style="color: #000;">
                        <td>Perihal</td>
                        <td style="width: 2%;">:</td>
                        <td><span class="info_perihal"></span></td>
                    </tr>
                    <tr style="color: #000;">
                        <td>Asal Surat</td>
                        <td style="width: 2%;">:</td>
                        <td><span class="info_asal_surat"></span></td>
                    </tr>
                    <tr style="color: #000;">
                        <td>Pelaksanaan</td>
                        <td style="width: 2%;">:</td>
                        <td><span class="info_pelaksanaan"></span></td>
                    </tr>
                    <tr style="color: #000;">
                        <td>Tempat</td>
                        <td style="width: 2%;">:</td>
                        <td><span class="info_tempat"></span></td>
                    </tr>
                </table>
                <p style="font-size: 13px;">
                    <span class="daftar_penerima_disposisi" style=" color: #000;">-</span>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal"> Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- modal detail surat keluar -->
<div class="modal fade bd-example-modal-lg surat-keluar" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <span class="text-dark font-weight-bold">Detail Informasi Surat Keluar</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="font-size: 12px;">
                <h6 class="font-weight-bold" style="font-size: 14px; color: #000;">Informasi</h6>
                <table class="table table-borderless table-sm text-capitalize" style="font-size: 14px;">
                    <tr style="color: #000;">
                        <td style="width: 20%;">No. Surat</td>
                        <td style="width: 2%;">:</td>
                        <td><span id="no_surat" class="info_no_surat"></td>
                    </tr>
                    <tr style="color: #000;">
                        <td>Diterima</td>
                        <td style="width: 2%;">:</td>
                        <td><span class="info_waktu_surat_masuk"></span></td>
                    </tr>
                    <tr style="color: #000;">
                        <td>Perihal</td>
                        <td style="width: 2%;">:</td>
                        <td><span class="info_perihal"></span></td>
                    </tr>
                    <tr>
                        <td colspan="3"><hr></td>
                    </tr>
                    <tr ><td colspan="3"> <h6 class="font-weight-bold" style="font-size: 14px; color: #000; margin-left: -8px;">Pelaksanaan</h6></td></tr>
                    <tr style="color: #000;">
                        <td>Waktu</td>
                        <td style="width: 2%;">:</td>
                        <td><span class="info_pelaksanaan"></span></span></td>
                    </tr>
                    <tr style="color: #000;">
                        <td>Tempat</td>
                        <td style="width: 2%;">:</td>
                        <td><span class="info_tempat"></span></td>
                    </tr>
                    <tr>
                        <td colspan="3"><hr></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <h6 class="font-weight-bold" style="font-size: 14px; color: #000;">Penerima Surat</h6>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><span class="penerima_surat"></span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- modal arsip -->
<div class="modal fade bd-example-modal-lg arsip-surat" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="text-dark font-weight-bold">Arsip Surat</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="font-size: 14px;">
            <?= form_open_multipart('surat/savearsip'); ?>
                <form>
                    
                    <div class="form-group">
                        <label for="select_arsip">Pilih Surat <span class="text-danger">*</span></label>
                        <select class="custom-select" id="select_arsip" name="select_arsip">
                            <option value="0">Pilih Surat Yang Akan Diarsipkan</option>
                            <?php foreach ($unarsip_nota_dinas as $key) { ?>
                            <option value="<?= $key->nomor_nota_dinas; ?>" class="text-uppercase"><?= $key->nomor_nota_dinas; ?> - <?= $key->asal_surat; ?> - <?= $key->perihal; ?> - ( <?= $key->nomor_surat; ?> )</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Unggah Dokumen <span class="text-danger">*</span></label>
                        <div>
                            <input type="file" name="upload_arsip" />
                        </div>
                        <small id="uploadHelp" class="form-text text-muted text-capitalize"><i>Lampiran harus berisi file PDF.</i></small>
                    </div>
                
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-sm btn-primary font-weight-bold" value="Simpan">
                </form>
            </div>
        </div>
    </div>
</div>