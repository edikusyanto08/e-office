<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <?php if ($file[0]->nama_file != null) { ?>
    <?php foreach ($file as $key) { ?>
    <?php if (file_exists("assets/file/nota-dinas/" . $key->nama_file)) { ?>
    <p class="text-center">
        <img src="<?= base_url('assets/file/nota-dinas/' . $key->nama_file); ?>" alt="">
    </p>
    <?php } ?>
    <?php } ?>
    <?php } ?>
</body>

</html>