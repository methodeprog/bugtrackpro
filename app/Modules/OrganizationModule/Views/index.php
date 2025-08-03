<h2>Liste des Organisations</h2>

<?php if (session()->getFlashdata('success')): ?>
  <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<a href="<?= base_url('dashboard/organizations/create') ?>" class="btn btn-success mb-3">Nouvelle organisation</a>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>Nom</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($organizations as $org): ?>
      <tr>
        <td><?= esc($org['name']) ?></td>
        <td><?= esc($org['description']) ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
