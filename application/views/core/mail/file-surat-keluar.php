<!DOCTYPE html>
<html lang="en">

<head>
    <!-- tittle -->
    <title>Download - Surat Elektronik</title>
    <!-- css -->
    <link rel='shortcut icon' href='<?= base_url(); ?>assets/image/logo.png' type='image/x-icon' />
</head>

<body>
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

</html>