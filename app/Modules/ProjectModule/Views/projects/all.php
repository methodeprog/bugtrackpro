<!-- app/Modules/ProjectModule/Views/projects/all.php -->
<div class="container mt-4">
    <h2 class="mb-4">Tous les projets</h2>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <a href="<?= site_url('dashboard/projects/create') ?>" class="btn btn-primary mb-3">Créer un nouveau projet</a>

    <?php if (!empty($projects) && is_array($projects)) : ?>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nom du projet</th>
                    <th>Description</th>
                    <th>Organisation</th>
                    <th>Date de création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projects as $project): ?>
                    <tr>
                        <td><?= esc($project['name']) ?></td>
                        <td><?= esc($project['description']) ?></td>
                        <td><?= esc($project['url']) ?></td>
                        <td><?= isset($organizations[$project['organization_id']]) ? esc($organizations[$project['organization_id']]) : 'N/A' ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($project['created_at'])) ?></td>
                        <td>
                            <a href="<?= site_url('dashboard/projects/edit/' . $project['id']) ?>" class="btn btn-sm btn-primary">Modifier</a>
                            <a href="<?= site_url('dashboard/projects/delete/' . $project['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce projet ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Aucun projet trouvé.</p>
    <?php endif; ?>
</div>
