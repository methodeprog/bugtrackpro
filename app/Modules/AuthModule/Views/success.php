<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blur Admin</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900italic,900&subset=latin,greek,greek-ext,vietnamese,cyrillic-ext,latin-ext,cyrillic" rel="stylesheet" type="text/css">

    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/img/favicon-16x16.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/img/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('assets/img/favicon-96x96.png') ?>">

    <link rel="stylesheet" href="<?= base_url('admin_assets/styles/vendor-72d47c3353.css') ?>">
    <link rel="stylesheet" href="<?= base_url('admin_assets/styles/auth-20116342ad.css') ?>">
</head>
<body>
    <main class="auth-main">
        <div class="auth-block">
              <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

        </div>
    </main>
</body>
</html>
