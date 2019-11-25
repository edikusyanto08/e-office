<!DOCTYPE html>
<html lang="en">

<head>
    <!-- tittle -->
    <title>Disposisi - Surat Elektronik</title>
    <!-- css -->
    <link rel='shortcut icon' href='<?= base_url(); ?>assets/image/logo.png' type='image/x-icon' />
    <style>
    .table {
        border: 1px solid #000;
    }
    </style>
</head>

<body>
    <table style="width: 100%;">
        <tr>
            <td>
                <div>
                    <img src="<?= base_url(); ?>assets/image/logo.png" alt="" style="width: 75px;">
                </div>
            </td>
            <td align="center" style="line-height: 30px;">
                <p class="p"
                    style="text-align: center; font-weight: bold; font-size: 24px;  text-transform: uppercase;">
                    LEMBAR DISPOSISI
                </p>
                <p class="l" style="font-size: 13px;">
                    <?= $instansi[0]->alamat; ?> Telp. <?= $instansi[0]->telepon; ?> / Fax.<?= $instansi[0]->fax; ?>
                </p>
                <p style="font-size: 13px;">
                    Email : <a href="#" style="margin-top: -10px;"><i> <?= $instansi[0]->email; ?></i></a>
                </p>

            </td>
        </tr>
    </table>
    <hr>
    <table width="100%" class="table" cellpadding="20">
        <tr>
            <td valign="baseline" height="70" style="line-height: 30px;">
                <p style="text-transform: capitalize;">Asal Surat : <?= $disposisi[0]->asal_surat; ?></p>
                <p>No. Surat : <?= $disposisi[0]->nomor_surat; ?></p>
                <p>Tgl. Surat : <?= $tanggal; ?></p><br>
            </td>
            <td valign="baseline" width="43%" style="line-height: 30px;">
                <div style="margin-left: 100px;">
                    <p>Diterima Tgl : <?= $surat_datang; ?></p>
                    <p>No. Agenda : <?= substr($disposisi[0]->nomor_agenda, 4); ?></p>
                    <p style="text-transform: capitalize;">Sifat : <?= $disposisi[0]->sifat; ?></p>
                </div>
            </td>
        </tr>
    </table>
    <table width="100%" style="line-height: 30px;" class="table" cellpadding="20">
        <tr>
            <td valign="baseline" height="50">
                <p style="margin-bottom: 10px;">Perihal :</p>
                <p style="text-transform: capitalize;"> <?= $disposisi[0]->perihal; ?></p>
            </td>
        </tr>
    </table>
    <table width="100%" class="table" cellpadding="20">
        <tr>
            <td valign="baseline" width="60%" height="70" style="line-height: 15px;">
                <div>
                    Diteruskan Kepada :
                </div><br>
                <div>
                    <ul>
                        <?php $i = 0;
                        foreach ($disposisi as $key) { ?>
                        <?php if ($key->pembuat_disposisi != $penerimatugas[$i]->nip) { ?>
                        <li style="line-height:120%;"> <?= $key->nama; ?></li>
                        <br>
                        <?php } ?>
                        <?php $i++;
                        } ?>
                    </ul>

                </div>
            </td>
            <td valign="baseline" style="line-height: 15px;">
                <div>
                    Dengan Hormat Harap :
                </div><br>
                <ul>
                    <?php if ($disposisi[0]->harapan == '100') { ?>
                    <li>Tanggapan dan Saran</li>
                    <?php } elseif ($disposisi[0]->harapan == '010') { ?>
                    <li>Proses Lebih Lanjut</li>
                    <?php } elseif ($disposisi[0]->harapan == '001') { ?>
                    <li>Koordinasi dan Konfirmasikan</li>
                    <?php } elseif ($disposisi[0]->harapan == '110') { ?>
                    <li>Tanggapan dan Saran</li><br>
                    <li>Proses Lebih Lanjut</li>
                    <?php } elseif ($disposisi[0]->harapan == '101') { ?>
                    <li>Tanggapan dan Saran</li><br>
                    <li>Koordinasi dan Konfirmasikan</li>
                    <?php } elseif ($disposisi[0]->harapan == '011') { ?>
                    <li>Proses Lebih Lanjut</li><br>
                    <li>Koordinasi dan Konfirmasikan</li>
                    <?php } elseif ($disposisi[0]->harapan == '111') { ?>
                    <li>Tanggapan dan Saran</li><br>
                    <li>Proses Lebih Lanjut</li><br>
                    <li>Koordinasi dan Konfirmasikan</li>
                    <?php } elseif ($disposisi[0]->harapan == '000') { ?>
                    <div> - </div>
                    <?php } ?>
                </ul>
            </td>
        </tr>
    </table>
    <table width="100%" style="line-height: 30px;" class="table" cellpadding="20">
        <tr>
            <td valign="baseline" width="60%">
                <div>
                    <p>
                        Catatan :
                    </p>
                    <p style="text-transform: Capitalize;">
                        <?= $disposisi[0]->catatan; ?>
                    </p>
                </div>
            </td>
            <td valign="baseline" align="center">
                <div>
                    <p align="center">
                        Nama / Jabatan <br>
                        Paraf dan Tanggal
                    </p><br><br><br>
                    <p align="center">
                        <?= $penugas[0]->nama; ?> / <br>
                        <span style="text-transform: capitalize;"> <?= $bidang[0]->nama_bidang; ?> </span>
                    </p>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>