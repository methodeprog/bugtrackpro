
<?= isset($validation) ? $validation->listErrors() : '' ?>

<form action="<?= base_url('dashboard/organizations/store') ?>" method="post">
  <div class="form-group">
    <label for="name">Nom de l'organisation</label>
    <input type="text" class="form-control" name="name" id="name" required>
  </div>

  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" name="description" id="description"></textarea>
  </div>

   <button type="submit" class="btn btn-primary">Créer</button>
</form>
