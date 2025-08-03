<?= view('DoctorModule\Views\partials\header') ?>

<h2>Ajouter une recommandation</h2>

<form method="post" action="<?= base_url('doctor/update/' . $log['id']) ?>">
    <div>
        <label>Message d’erreur :</label>
        <pre><?= esc($log['error_message']) ?></pre>
    </div>

    <div>
        <label>Recommandation :</label>
        <textarea name="recommendation" rows="5" style="width:100%"><?= esc($log['recommendation']) ?></textarea>
    </div>

    <button type="submit">Enregistrer</button>
</form>

<?= view('DoctorModule\Views\partials\footer') ?>
