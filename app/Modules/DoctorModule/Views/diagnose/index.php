<h2>Liste des logs médicaux</h2>
<?php if (session()->getFlashdata('success')): ?>
    <p style="color:green"><?= session()->getFlashdata('success') ?></p>
<?php endif; ?>
<table border="1" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Erreur liée</th>
            <th>Recommandation</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($logs as $log): ?>
        <tr>
            <td><?= esc($log['id']) ?></td>
            <td><?= esc($log['error_log_id']) ?></td>
            <td><?= esc($log['recommendation']) ?></td>
            <td><a href="/doctor/edit/<?= $log['id'] ?>">Modifier</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
