<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h3 style="text-align: center;">Daftar Penerima Surat</h3>
    <br>
    <table border="1" cellspacing="0" cellpadding="4" style="width: 100%; line-height: 25px;">
        <tr>
            <td style="text-align: center; font-weight: bold;">No</td>
            <td style="text-align: center; font-weight: bold;">NIP - Nama</td>
            <td style="text-align: center; font-weight: bold;">Jabatan</td>
        </tr>
        <?php $i = 1;
        foreach ($penerima_surat as $key) { ?>
        <tr>
            <td style="width: 5%; text-align: center;"><?= $i; ?></td>
            <td style="width: 50%;"><?= $key->nama; ?></td>
            <td style="text-transform:capitalize;"><?= $key->nama_bidang; ?> </td>
        </tr>
        <?php $i++;
        } ?>
    </table>
</body>

</html>