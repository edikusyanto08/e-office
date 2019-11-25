<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
            <td style="width: 40%;">Lembar Ke</td>
            <td style="width: 5%;">:</td>
            <td style="width: 55%;">2</td>
        </tr>
        <tr>
            <td>Kode No</td>
            <td>:</td>
            <td><?= $penerima_spd[0]->id_instansi; ?></td>
        </tr>
    </table>
    <br>
    <table style="width: 100%; line-height: 20px;" class="table">
        <tr>
            <td style="width: 50%;"></td>
            <td valign="baseline" style="width: 3%; text-align: center;" class="border-left"> I. </td>
            <td valign=" baseline">
                <p>
                    Berangkat dari
                    (Tempat Kedudukan)
                </p>
            </td>
            <td valign="baseline" style="width: 2%; text-align: center;">
                <p>:</p>
            </td>
            <td valign="baseline">
                <p style="text-transform: capitalize;">
                    <?= $pembuat_spd[0]->nama_instansi; ?>
                </p>
            </td>
        </tr>
        <tr>
            <td style="width: 50%;"></td>
            <td class="border-left"></td>
            <td valign=" baseline">
                <p>
                    Ke
                </p>
            </td>
            <td valign="baseline" style="width: 2%; text-align: center;">
                <p>:</p>
            </td>
            <td valign="baseline">
                <p>
                    <?= $pembuat_spd[0]->alamat; ?>
                </p>
            </td>
        </tr>
        <tr>
            <td style="width: 50%;"></td>
            <td class="border-left"></td>
            <td valign=" baseline">
                <p>
                    Pada Tanggal
                </p>
            </td>
            <td valign="baseline" style="width: 2%; text-align: center;">
                <p>:</p>
            </td>
            <td valign="baseline">
                <p>
                    <?= $keberangkatan; ?>
                </p>
            </td>
        </tr>
        <tr>
            <td style="width: 50%;"></td>
            <td class="border-left"></td>
            <td colspan="4" style="text-align: center;">
                <p style="text-transform: capitalize;">
                    <?php $raw = str_replace('dinas', '', $pembuat_spd[0]->nama_bidang);
                    echo implode(' ', array_unique(explode(' ', $raw)));
                    echo $pembuat_spd[0]->nama_instansi;  ?></p>
                <br><br><br>
                <p><?= $pembuat_spd[0]->nama; ?></p>
                <p>(<?= $pembuat_spd[0]->nip; ?>)</p>
            </td>
        </tr>
    </table>

    <table class="table" style="width: 100%;">
        <tr>
            <td valign="baseline" style="width: 5%"> II. </td>
            <td valign="baseline" style="width: 15%;">Tiba Di</td>
            <td valign="baseline" style="width: 2%;">:</td>
            <td valign="baseline" style="width: 28%;"></td>
            <td valign="baseline" style="width: 20%;" class="border-left">
                <p>
                    Berangkat dari
                </p>
            </td>
            <td valign="baseline" style="width: 2%; text-align: center;">
                <p>:</p>
            </td>
            <td valign="baseline">
            </td>
        </tr>
        <tr>
            <td></td>
            <td valign="baseline">Pada Tanggal</td>
            <td valign="baseline">:</td>
            <td valign="baseline"></td>
            <td valign=" baseline" class="border-left">
                <p>
                    Ke
                </p>
            </td>
            <td valign="baseline" style="width: 2%; text-align: center;">
                <p>:</p>
            </td>
            <td valign="baseline">
                <p>

                </p>
            </td>
        </tr>
        <tr>
            <td></td>
            <td valign="baseline">Kepala</td>
            <td valign="baseline">:</td>
            <td valign="baseline"></td>
            <td valign=" baseline" class="border-left">
                <p>
                    Pada Tanggal
                </p>
            </td>
            <td valign="baseline" style="width: 2%; text-align: center;">
                <p>:</p>
            </td>
            <td valign="baseline">
                <p>

                </p>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="4" style="text-align: center;" class="border-left">
                <br><br><br><br>
            </td>
        </tr>
    </table>

    <table class="table" style="width: 100%;">
        <tr>
            <td valign="baseline" style="width: 5%"> III. </td>
            <td valign="baseline" style="width: 15%;">Tiba Di</td>
            <td valign="baseline" style="width: 2%;">:</td>
            <td valign="baseline" style="width: 28%;"></td>
            <td valign="baseline" style="width: 20%;" class="border-left">
                <p>
                    Berangkat dari
                </p>
            </td>
            <td valign="baseline" style="width: 2%; text-align: center;">
                <p>:</p>
            </td>
            <td valign="baseline">
            </td>
        </tr>
        <tr>
            <td></td>
            <td valign="baseline">Pada Tanggal</td>
            <td valign="baseline">:</td>
            <td valign="baseline"></td>
            <td valign=" baseline" class="border-left">
                <p>
                    Ke
                </p>
            </td>
            <td valign="baseline" style="width: 2%; text-align: center;">
                <p>:</p>
            </td>
            <td valign="baseline">
                <p>

                </p>
            </td>
        </tr>
        <tr>
            <td></td>
            <td valign="baseline">Kepala</td>
            <td valign="baseline">:</td>
            <td valign="baseline"></td>
            <td valign=" baseline" class="border-left">
                <p>
                    Pada Tanggal
                </p>
            </td>
            <td valign="baseline" style="width: 2%; text-align: center;">
                <p>:</p>
            </td>
            <td valign="baseline">
                <p>

                </p>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="4" style="text-align: center;" class="border-left">
                <br><br><br><br>
            </td>
        </tr>
    </table>

    <table class="table" style="width: 100%;">
        <tr>
            <td valign="baseline" style="width: 5%"> IV. </td>
            <td valign="baseline" style="width: 15%;">Tiba Di</td>
            <td valign="baseline" style="width: 2%;">:</td>
            <td valign="baseline" style="width: 28%;"></td>
            <td valign="baseline" style="width: 20%;" class="border-left">
                <p>
                    Berangkat dari
                </p>
            </td>
            <td valign="baseline" style="width: 2%; text-align: center;">
                <p>:</p>
            </td>
            <td valign="baseline">
                <p>
                </p>
            </td>
        </tr>
        <tr>
            <td></td>
            <td valign="baseline">Pada Tanggal</td>
            <td valign="baseline">:</td>
            <td valign="baseline"></td>
            <td valign=" baseline" class="border-left">
                <p>
                    Ke
                </p>
            </td>
            <td valign="baseline" style="width: 2%; text-align: center;">
                <p>:</p>
            </td>
            <td valign="baseline">
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td valign=" baseline" class="border-left">
                <p>
                    Pada Tanggal
                </p>
            </td>
            <td valign="baseline" style="width: 2%; text-align: center;">
                <p>:</p>
            </td>
            <td valign="baseline">
                <p>
                </p>
            </td>
        </tr>
        <br>
        <tr>
            <td colspan="4" style="text-align: center;" class="border-left">
                <p style="text-transform: capitalize;">
                    <?php $raw = str_replace('dinas', '', $pembuat_spd[0]->nama_bidang);
                    echo implode(' ', array_unique(explode(' ', $raw)));
                    echo $pembuat_spd[0]->nama_instansi;  ?></p>
                <br><br><br>
                <p><?= $pembuat_spd[0]->nama; ?></p>
                <p>(<?= $pembuat_spd[0]->nip; ?>)</p>
            </td>
            <td colspan="4" style="text-align: center;" class="border-left">
                <p style="text-transform: capitalize;">
                    <?php $raw = str_replace('dinas', '', $pembuat_spd[0]->nama_bidang);
                    echo implode(' ', array_unique(explode(' ', $raw)));
                    echo $pembuat_spd[0]->nama_instansi;  ?></p>
                <br><br><br>
                <p><?= $pembuat_spd[0]->nama; ?></p>
                <p>(<?= $pembuat_spd[0]->nip; ?>)</p>
            </td>
        </tr>
    </table>
    <table class="table" style="width: 100%;">
        <tr>
            <td style="width: 5%;" valign="baseline">
                V.
            </td>
            <td>
                Catatan Lain-lain :
            </td>
        </tr>
        <br><br>
    </table>
    <table class="table" style="width: 100%;">
        <tr>
            <td style="width: 5%;" valign="baseline">
                VI.
            </td>
            <td>
                PERHATIAN <br>
                PPK yang menerbitkan SPD, pegawai yang melakukan perjalanan dinas, para pejabat yang
                mengesahkan tanggal berangkat/tiba, serta bendahara pengeluaran bertanggung jawab berdasarkan
                Peraturan-Peraturan Keuangan Negara apabila negara menderita rugi akibat kesalahan, kelalaian, dan
                kealpaannya.
            </td>
        </tr>
    </table>
</body>

</html>