<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Surat | Surat Perintah</title>
    <style>
    table {
        border-collapse: collapse;
    }

    .table,
    .th,
    .td {
        border: 1px solid black;
    }

    .table-left-right-bottom {
        border-left: 1px solid black;
        border-right: 1px solid black;
        border-bottom: 1px solid black;
    }

    .table-left-right {
        border-left: 1px solid black;
        border-right: 1px solid black;
    }
    </style>
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
    <table style="width: 30%;" align="right">
        <tr>
            <td style="width: 40%;">Lembar Ke</td>
            <td style="width: 5%;">:</td>
            <td style="width: 55%;">1</td>
        </tr>
        <tr>
            <td>Kode No</td>
            <td>:</td>
            <td><?= $penerima_spd[0]->id_instansi; ?></td>
        </tr>
        <tr>
            <td>Nomor</td>
            <td>:</td>
            <td><?= $penerima_spd[0]->nomor_perjalanan; ?></td>
        </tr>
    </table>
    <br>
    <table style="width: 100%;">
        <tr>
            <td align="center" style="text-transform: uppercase; font-weight: bold;">Surat Perjalanan Dinas</td>
        </tr>
    </table>
    <br>
    <table cellpadding="5" cellspacing="0" style="width: 100%; line-height: 20px;">
        <tr>
            <td class="table" valign="baseline">1.</td>
            <td class="table" valign="baseline">Pejabat Pembuat Komitmen</td>
            <td class="table" valign="baseline"><?= $pembuat_spd[0]->nama; ?></td>
        </tr>
        <tr>
            <td class="table" valign="baseline">2.</td>
            <td class="table" valign="baseline">Nama / NIP Pegawai yang melaksanakan perjalanan dinas</td>
            <td class="table" valign="baseline"><?= $penerima_spd[0]->nama; ?></td>
        </tr>
        <tr>
            <td class="table-left-right" valign="baseline">
                3.
            </td>
            <td class="table-left-right" valign="baseline">
                <p>
                    a. Pangkat & Golongan
                </p>
                <p>
                    b. Jabatan / Instansi
                </p>

            </td>
            <td class="table-left-right" valign="baseline">
                <p>
                    a. <?= $penerima_spd[0]->pangkat; ?>, <?= $penerima_spd[0]->golongan; ?>
                </p>
                <p style="text-transform: capitalize;">
                    b. <?= $penerima_spd[0]->nama_bidang; ?>
                </p>

            </td>
        </tr>
        <tr>
            <td class="table-left-right-bottom" style="border-top: 1px white solid;"></td>
            <td class="table-left-right-bottom">
                <p>c. Tingkat Biaya Perjalanan Dinas</p>
            </td>
            <td class="table-left-right-bottom">
                <p>c. - </p>
            </td>
        </tr>
        <tr>
            <td class="table" valign="baseline">4.</td>
            <td class="table" valign="baseline">Maksud Perjalanan Dinas</td>
            <td class="table" valign="baseline" style="text-transform: capitalize;">
                <?= $penerima_spd[0]->tujuan_keberangkatan; ?></td>
        </tr>
        <tr>
            <td class="table" valign="baseline">5.</td>
            <td class="table" valign="baseline">Alat angkut yang dipergunakan</td>
            <td class="table" valign="baseline"><?= $penerima_spd[0]->kendaraan; ?></td>
        </tr>
        <tr>
            <td class="table" valign="baseline">6.</td>
            <td class="table" valign="baseline">
                <p>
                    a. Tempat Berangkat
                </p>
                <p>
                    b. Tempat Tujuan
                </p>
            </td>
            <td class="table" valign="baseline">
                <p>
                    a. Kantor Dinas
                </p>
                <p>
                    b. <span style="text-transform: capitalize;"><?= $penerima_spd[0]->tempat; ?></span>
                </p>
            </td>
        </tr>
        <tr>
            <td class="table" valign="baseline">7.</td>
            <td class="table" valign="baseline">
                <p>
                    a. Lamanya Perjalanan Dinas
                </p>
                <p>
                    b. Tanggal Berangkat
                </p>
                <p>
                    c. Tanggal Harus Kembali / Tiba ditempat Baru
                </p>
            </td>
            <td class="table" valign="baseline">
                <p>
                    <?php $total_hari = $berangkat->diff($pulang);
                    echo $total_hari->days + 1 . ' hari'; ?>
                </p>
                <p>
                    <?= $keberangkatan; ?>
                </p>
                <p>
                    <?= $kepulangan; ?>
                </p>
            </td>
        </tr>
        <tr>
            <td class="table" valign="baseline">8.</td>
            <td class="table" valign="baseline">
                <p>
                    Pengikut :
                </p>
                <?php $i = 1;
                if (count($penerima_spd) > 1) { ?>
                <?php foreach ($penerima_spd as $key) { ?>
                <?php if ($penerima_spd[0]->nama != $key->nama) { ?>
                <p><?= $key->nama; ?></p>
                <?php } ?>
                <?php $i++;
                        } ?>
                <?php } else { ?>
                <p> - </p>
                <?php } ?>
            </td>
            <td class="table" valign="baseline">
                <p>
                    Keterangan :
                </p>
                <p>
                    -
                </p>
            </td>
        </tr>
        <tr>
            <td class="table-left-right" valign="baseline">9.</td>
            <td class="table-left-right" valign="baseline">
                <div>
                    Pembebanan Anggaran
                </div>
            </td>
            <td class="table-left-right" valign="baseline">
            </td>
        </tr>
        <tr>
            <td valign="baseline" class="table-left-right"></td>
            <td valign="baseline" class="table-left-right">
                <div>
                    a. Instansi
                </div>
            </td>
            <td valign="baseline" class="table-left-right">
                <div>a. <span style="text-transform: capitalize;"> <?= $penerima_spd[0]->nama_instansi; ?></span></div>

            </td>
        </tr>
        <tr>
            <td valign="baseline" class="table-left-right-bottom"></td>
            <td valign="baseline" class="table-left-right-bottom">
                <div>
                    b. Akun
                </div>
            </td>
            <td valign="baseline" class="table-left-right-bottom">
                <div>b. -</div>
            </td>
        </tr>
        <tr>
            <td class="table" valign="baseline">10.</td>
            <td class="table" valign="baseline">Keterangan</td>
            <td class="table" valign="baseline">-</td>
        </tr>
    </table>
    <table style="width: 100%;">
        <tr>
            <td valign="baseline" style="width: 60%; ">
                * Coret yang tidak perlu
            </td>
            <td valign="baseline">
                <p>
                    <span style="font-weight: bold;">Dikeluarkan di :</span> <span
                        style="text-transform: capitalize;"><?= $penerima_spd[0]->nama_instansi; ?></span>
                </p>
            </td>
        </tr>
        <tr>
            <td></td>
            <td valign="baseline">
                <p>
                    <span style="font-weight: bold;">Pada Tanggal :</span> <?= $agenda; ?>
                </p>
            </td>
        </tr>
    </table>
</body>

</html>