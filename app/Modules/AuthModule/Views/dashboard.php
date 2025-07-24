<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bienvenue, <?= esc($user->name ?? 'Utilisateur') ?> !</h1>
    <p>Email : <?= esc($user->email ?? 'N/A') ?></p>
    <a href="<?= site_url('/auth/logout') ?>">Se déconnecter</a>
</body>
</html>
