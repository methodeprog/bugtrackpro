<!-- app/Modules/ProjectModule/Views/projects/create_from_all.php -->
<div class="container mt-4">
    <h2>Créer un projet</h2>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if (isset($validation)) : ?>
        <div class="alert alert-danger">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('dashboard/projects/store') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="organization_id">Organisation</label>
            <select name="organization_id" id="organization_id" class="form-control" required>
                <option value="">-- Sélectionner une organisation --</option>
                <?php foreach ($organizations as $org): ?>
                    <option value="<?= esc($org['id']) ?>" <?= old('organization_id') == $org['id'] ? 'selected' : '' ?>>
                        <?= esc($org['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="name">Nom du projet</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= old('name') ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"><?= old('description') ?></textarea>
        </div>

        <button type="submit" class="btn btn-success mt-2">Créer</button>
    </form>
</div>
