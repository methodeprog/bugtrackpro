<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <h2>Connexion</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <p style="color:red"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>

    <form method="post" action="<?= site_url('/auth/login') ?>">
        <?= csrf_field() ?>
        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Mot de passe:</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
