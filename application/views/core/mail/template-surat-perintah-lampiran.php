<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='shortcut icon' href='<?= base_url(); ?>assets/image/logo.png' type='image/x-icon' />
    <title>E-Surat | Surat Perintah</title>
    <style>
    .border-left {
        border-left: 1px solid black;
    }
    </style>
</head>

<body>
    <table style="width: 30%;" align="right">
        <tr>
            <td colspan="3">
                Lampiran Surat Perintah
            </td>
        </tr>
        <tr>
            <td style="width: 40%;">Nomor</td>
            <td style="width: 5%;">:</td>
            <td style="width: 55%;">2</td>
        </tr>
    </table>
    <br>
    <table border="1" cellpadding="5" cellspacing="0" style="width: 100%;">
        <tr>
            <td>
                No
            </td>
            <td>
                Nama
            </td>
            <td>
                NIP
            </td>
            <td>
                Pangkat, Golongan
            </td>
            <td>
                Jabatan
            </td>
            <td>
                Keterangan
            </td>
        </tr>
        <?php $i = 1;
        foreach ($penerima_perintah as $key) { ?>
        <tr>
            <td valign="baseline">
                <?= $i ?>.
            </td>
            <td valign="baseline">
                <p style="font-weight: bold;"><?= $key->nama; ?></p>
            </td>
            <td valign="baseline">
                <p><?= $key->nip; ?></p>
            </td>
            <td>
                <p><?= $key->pangkat; ?> / <?= $key->golongan; ?></p>
            </td>
            <td>
                <p style="text-transform: capitalize;">
                    <?php if (substr($key->nama_bidang, 0, 6) != 'Kepala') { ?>Kepala
                    <?= $key->nama_bidang; ?>
                    <?php } else {
                            echo $key->nama_bidang;
                        } ?>
                </p>
            </td>
            <td></td>
        </tr>
        <?php $i++;
        } ?>
    </table>
</body>

</html>