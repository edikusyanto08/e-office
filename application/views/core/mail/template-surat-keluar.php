<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Surat | Nota Dinas</title>
    <link rel='shortcut icon' href='<?= base_url(); ?>assets/image/logo.png' type='image/x-icon' />
    <style>
    .p {
        text-transform: capitalize;
        text-align: justify;
        text-indent: 0.5in;
    }

    p {
        margin-top: 0px;
        padding: -5px;
    }
    </style>
</head>

<body style="font-family: Times;">
    <table>
        <tr>
            <td>
                <div>
                    <img src="<?= base_url(); ?>assets/image/logo.png" alt="" style="width: 75px;">
                </div>
            </td>
            <td align="center" style="  line-height: 30px;">
                <div class="p"
                    style="text-align: center; font-weight: bold; font-size: 24px; text-transform: uppercase;">
                    PEMERINTAH KABUPATEN CIAMIS
                </div>
                <div class="p"
                    style="text-align: center; font-weight: bold; font-size: 24px; text-transform: uppercase;">
                    <?= $instansi[0]->nama_instansi; ?>
                </div>
                <div class="l" style="font-size: 13px;">
                    <?= $instansi[0]->alamat; ?> Telp. <?= $instansi[0]->telepon; ?> / Fax.
                    <?= $instansi[0]->fax; ?>
                </div>

            </td>
        </tr>
        <tr>
            <td></td>
            <td align=" center">
                <div class="l" style="font-size: 13px; ">
                    Email : <a href="#"><i><?= $instansi[0]->email; ?></i></a>
                </div>
            </td>
        </tr>
    </table>
    <hr>
    <table style="width: 100%; line-height: 25px;">
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Ciamis, 21 Agustus 2019</td>
        </tr>
        <tr>
            <td valign="baseline">Nomor</td>
            <td valign="baseline">:</td>
            <td valign="baseline" style="width: 54%;"><?= $surat_keluar[0]->nomor_surat_keluar; ?></td>
            <td valign="baseline" rowspan="3" colspan="2">
                <div>Kepada :</div>
                <?php if (count($penerima_surat) == 1) { ?>
                <div>Yth, <strong><?= $penerima_surat[0]->nama; ?></strong></div>
                <?php } else { ?>
                <div>Yth, <strong>Bapak/Ibu (Terlampir)</strong></div>
                <?php } ?>
                <div>di Tempat</div>
            </td>
            <td rowspan="3"></td>
        </tr>
        <tr>
            <td>Lampiran</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td valign="baseline">Hal</td>
            <td valign="baseline">:</td>
            <td valign="baseline"><?= $surat_keluar[0]->perihal; ?></td>
        </tr>
    </table>
    <br><br>
    <div class="p" style="line-height: 25px;">
        <?= $surat_keluar[0]->isi; ?>
    </div>
    <br><br>
    <table style="width: 100%;">
        <tr>
            <td></td>
            <td style="width: 40%; text-align: center;">
                <div style="text-transform:capitalize;"><?= $surat_keluar[0]->nama_bidang; ?></div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <p><u><strong><?= $surat_keluar[0]->nama; ?></strong></u></p>
                <p><?= $surat_keluar[0]->pangkat; ?>, <?= $surat_keluar[0]->golongan; ?></p>
                <p>NIP. <?= $surat_keluar[0]->nip; ?></p>
            </td>
        </tr>
    </table>
</body>

</html>