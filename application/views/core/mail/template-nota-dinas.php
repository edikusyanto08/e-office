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
            <td align="center" style="  line-height: 35px;">
                <div class="p"
                    style="text-align: center; font-weight: bold; font-size: 24px; text-transform: uppercase;">
                    PEMERINTAH KABUPATEN CIAMIS
                </div>
                <div class="p"
                    style="text-align: center; font-weight: bold; font-size: 24px;  text-transform: uppercase;">
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
            <td align="center">
                <div class="l" style="font-size: 13px; ">
                    Email : <a href="#"><i><?= $instansi[0]->email; ?></i></a>
                </div>
            </td>
        </tr>
    </table>
    <hr>
    <div align="center" style="line-height: 25px;">
        <span>
            NOTA DINAS
        </span><br>
        <span>
            NOMOR: <?= $penerima[0]->nomor_nota_dinas; ?>
        </span>
    </div><br><br>
    <table valign="baseline" style="line-height: 25px;">
        <tr>
            <td>Yth</td>
            <td>:</td>
            <td><?= $penerima[0]->nama; ?></td>
        </tr>
        <tr>
            <td valign="baseline">Hal</td>
            <td valign="baseline">:</td>
            <td style="text-transform: capitalize;"><?= $penerima[0]->perihal; ?></td>
        </tr>
    </table><br>
    <div class="p" style="line-height: 25px;">
        <?= $penerima[0]->laporan; ?>
    </div>
    <table width="100%">
        <tr>
            <td width="70%"></td>
            <td align="center" style="line-height: 25px;">
                <div>Ciamis, <?= $tanggal_nota; ?></div>
                <div style="text-transform: capitalize;"><?= $penulis[0]->nama_bidang; ?></div>
                <br><br><br>

                <div><?= $penulis[0]->nama; ?></div>
            </td>
        </tr>
    </table><br>
    <div>Tembusan :</div>
    <ul style="line-height: 25px; list-style-type: square;">
        <?php foreach ($tembusan as $key) { ?>
        <li style="text-transform: capitalize;"><?= $key->nama_bidang; ?> <?= $key->nama_instansi; ?></li>
        <?php } ?>
    </ul>
</body>

</html>