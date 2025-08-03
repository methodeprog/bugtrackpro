<!-- app/Modules/ProjectModule/Views/projects/create.php -->
<div class="container mt-4">
    <h2>Créer un projet pour l'organisation #<?= esc($organization_id) ?></h2>

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
        <input type="hidden" name="organization_id" value="<?= esc($organization_id) ?>">

        <div class="form-group">
            <label for="name">Nom du projet</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= old('name') ?>" required>
        </div>
                <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"><?= old('description') ?></textarea>
        </div>
<div class="form-group">
    <label for="url">URL du projet</label>
    <input type="url" name="url" id="url" class="form-control" value="<?= esc(old('url', $project['url'] ?? '')) ?>" placeholder="https://exemple.com" required>
</div>



        <button type="submit" class="btn btn-success mt-2">Créer</button>
    </form>
</div>


