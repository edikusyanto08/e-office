<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>E-Surat | Surat Perintah</title>
</head>

<body>
    <table>
        <tr>
            <td>
                <div>
                    <img src="<?= base_url(); ?>assets/image/logo.png" alt="" style="width: 75px;">
                </div>
            </td>
            <td align="center" style="  line-height: 35px;">
                <p class="p" style="text-align: center; font-weight: bold; font-size: 24px; text-transform: uppercase;">
                    PEMERINTAH KABUPATEN CIAMIS
                </p>
                <p class="p"
                    style="text-align: center; font-weight: bold; font-size: 24px;  text-transform: uppercase;">
                    <?= $instansi[0]->nama_instansi; ?>
                </p>
                <p class="l" style="font-size: 13px;">
                    <?= $instansi[0]->alamat; ?> Telp. <?= $instansi[0]->telepon; ?> / Fax.
                    <?= $instansi[0]->fax; ?>
                </p>
            </td>
        </tr>
        <tr>
            <td></td>
            <td align="center">
                <p class="l" style="font-size: 13px; ">
                    Email : <a href="#" style="margin-top: -10px;"><i> <?= $instansi[0]->email; ?></i></a>
                </p>
            </td>
        </tr>
    </table>
    <hr>
    <table style="width: 100%;">
        <tr>
            <td style="text-align: center; line-height: 20px;">
                <p style="text-transform: uppercase; font-weight: bold;">
                    Surat Perintah
                </p>
                <p style="text-transform: uppercase;">
                    Nomor : <?= $sp[0]->no_perintah; ?>
                </p>
            </td>
        </tr>
    </table>
    <br>
    <table style="width: 100%; line-height: 30px;">
        <tr>
            <td style="width: 15%;" valign="baseline">
                Dasar
            </td>
            <td style="width: 2%;" valign="baseline">
                :
            </td>
            <td valign="baseline" style="text-transform: capitalize;">
                [<?= $sp[0]->nomor_surat; ?>] <?= $sp[0]->asal_surat; ?>, <?= $sp[0]->perihal; ?>
            </td>
        </tr>

    </table>
    <br>
    <table style="width: 100%;">
        <tr>
            <td style="font-weight: bold; text-align: center;">MEMERINTAHKAN</td>
        </tr>
    </table>
    <br>
    <table style="width: 100%;">
        <?php $i = 1;
        foreach ($penerima_perintah as $key) { ?>
        <?php if ($i == 1) { ?>
        <tr>
            <td valign="baseline" style="width: 15%;">
                Kepada
            </td>
            <td valign="baseline" style="width: 2%;">
                :
            </td>
            <td valign="baseline" style="line-height: 20px; width: 3%;">
                <?= $i; ?>.
            </td>
            <td valign="baseline" style="line-height: 20px; width: 15%;">
                <p>Nama</p>
                <p>NIP</p>
                <p>Pangkat/Gol.</p>
                <p>Jabatan</p>
            </td>
            <td valign="baseline" style="line-height: 20px; width: 2%;">
                <p>:</p>
                <p>:</p>
                <p>:</p>
                <p>:</p>
            </td>
            <td valign="baseline" style="line-height: 20px; width: 63%;">
                <p style="font-weight: bold;"><?= $key->nama; ?></p>
                <p><?= $key->nip; ?></p>
                <p><?= $key->pangkat; ?>, <?= $key->golongan; ?></p>
                <p style="text-transform: capitalize;">
                    <?php if (substr($key->nama_bidang, 0, 6) != 'kepala') { ?>Kepala
                    <?= $key->nama_bidang; ?>
                    <?php } else {
                                    echo $key->nama_bidang;
                                } ?>
                </p>
            </td>
        </tr>
        <?php } else { ?>
        <tr>
            <td valign="baseline" style="width: 15%;">
            </td>
            <td valign="baseline" style="width: 2%;">
            </td>
            <td valign="baseline" style="line-height: 20px; width: 3%;">
                <?= $i ?>.
            </td>
            <td valign="baseline" style="line-height: 20px; width: 15%;">
                <p>Nama</p>
                <p>NIP</p>
                <p>Pangkat/Gol.</p>
                <p>Jabatan</p>
            </td>
            <td valign="baseline" style="line-height: 20px; width: 2%;">
                <p>:</p>
                <p>:</p>
                <p>:</p>
                <p>:</p>
            </td>
            <td valign="baseline" style="line-height: 20px; width: 63%;">
                <p style="font-weight: bold;"><?= $key->nama; ?></p>
                <p><?= $key->nip; ?></p>
                <p><?= $key->pangkat; ?> / <?= $key->golongan; ?></p>
                <p style="text-transform: capitalize;">
                    <?php if (substr($key->nama_bidang, 0, 6) != 'kepala') { ?>Kepala
                    <?= $key->nama_bidang; ?>
                    <?php } else {
                                    echo $key->nama_bidang;
                                } ?>
                </p>
            </td>
        </tr>
        <?php } ?>
        <?php $i++;
        } ?>
    </table>
    <br>
    <table style="width: 100%; line-height: 20px;">
        <tr>
            <td valign="baseline" style="width: 15%;">
                <p>Untuk</p>
            </td>
            <td valign="baseline" style="width: 2%;">
                <p>:</p>
            </td>
            <td valign="baseline">
                <p style="text-transform: capitalize;"> <?= $sp[0]->perihal; ?></p>
            </td>
        </tr>
        <tr>
            <td valign="baseline">
                <p>Hari, Tanggal</p>
            </td>
            <td valign="baseline">
                <p>:</p>
            </td>
            <td valign="baseline">
                <p>
                    <?= $date; ?>
                </p>
            </td>
        </tr>
        <tr>
            <td valign="baseline">
                <p>Tempat</p>
            </td>
            <td valign="baseline">
                <p>:</p>
            </td>
            <td valign="baseline">
                <p style="text-transform: capitalize;">
                    <?= $sp[0]->tempat; ?>
                </p>
            </td>
        </tr>
        <tr>
            <td valign="baseline">
                <p>Catatan</p>
            </td>
            <td valign="baseline">
                <p>:</p>
            </td>
            <td valign="baseline">
                <p style="text-transform: capitalize;">-</p>
            </td>
        </tr>
    </table>
    <br>
    <table style="width: 100%;">
        <tr>
            <td>
                Demikian untuk dilaksanakan dengan penuh tanggung jawab.
            </td>
        </tr>
    </table>
    <br>
    <table style="width: 43%;" align="right">
        <tr>
            <td style="text-align: left; line-height: 20px;">
                <p>
                    Dikeluarkan di Ciamis <br>
                    pada tanggal <?= $agenda; ?>
                </p>
            </td>
        </tr>
    </table>
    <table style="width: 50%;" align="right">
        <tr>
            <td style="text-align: center; line-height: 20px;">
                <p style="text-transform: uppercase;">
                    <?= $pembuat_sp[0]->nama_bidang; ?> <br>
                    <?= $pembuat_sp[0]->nama_instansi; ?>
                </p>
            </td>
        </tr>
    </table><br> <br><br>
    <table style="width: 50%;" align="right">
        <tr>
            <td style="text-align: center; line-height: 20px;">
                <p style="text-transform: uppercase;">
                    <p style="font-weight: bold; text-decoration: underline;"><?= $pembuat_sp[0]->nama; ?></p>
                    <p><?= $pembuat_sp[0]->nama_bidang; ?>, <?= $pembuat_sp[0]->golongan; ?></p>
                    <p>NIP. <?= $pembuat_sp[0]->nip; ?></p>
                </p>
            </td>
        </tr>
    </table>
</body>

</html>