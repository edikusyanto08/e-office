<!DOCTYPE html>
<html lang="en">

<head>
    <!-- tittle -->
    <title>Download - Surat Elektronik</title>
    <!-- css -->
    <link rel='shortcut icon' href='<?= base_url(); ?>assets/image/logo.png' type='image/x-icon' />
</head>

<body>
    <div
        style="text-align: center; text-transform: uppercase; font-size: 14px; line-height: 25px; margin-bottom: 10px;">
        <span style="font-size: 16px; font-weight: bold;">
            <?= $file[0]->perihal; ?>
        </span> <br>
        <?= $file[0]->asal_surat; ?> -
        <?= $file[0]->nomor_surat; ?>
    </div>
    <?php foreach ($file as $key) { ?>
    <?php if (file_exists("assets/file/surat-masuk/" . $key->nama_file)) { ?>
    <?php
                    list($width, $height, $type, $attr)  = getimagesize("assets/file/surat-masuk/" . $key->nama_file);
                    if ($height > 900) {
                        ?>
    <p style="text-align: center;">
        <img src="<?= base_url('assets/file/surat-masuk/' . $key->nama_file); ?>" alt="" style="height: 900px;">
    </p>
    <?php } else { ?>
    <p style="text-align: center;">
        <img src="<?= base_url('assets/file/surat-masuk/' . $key->nama_file); ?>" alt="">
    </p>
    <?php } ?>
    <?php } ?>
    <?php } ?>
</body>
.

</html>