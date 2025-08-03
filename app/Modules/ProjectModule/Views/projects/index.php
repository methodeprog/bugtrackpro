<!-- app/Modules/ProjectModule/Views/projects/index.php -->
<div class="container mt-4">
    <h2 class="mb-4">Projets de l’organisation</h2>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <a href="<?= site_url('dashboard/projects/create/' . ($organization_id ?? '')) ?>" class="btn btn-primary mb-3">Créer un projet</a>

    <?php if (!empty($projects) && is_array($projects)) : ?>
        <ul>
            <?php foreach ($projects as $project): ?>
                <li>
                    <strong><?= esc($project['name']) ?></strong> - <?= esc($project['description']) ?>
                    &nbsp; <a href="<?= site_url('dashboard/projects/edit/' . $project['id']) ?>">Modifier</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>Aucun projet trouvé pour cette organisation.</p>
    <?php endif; ?>
</div>
