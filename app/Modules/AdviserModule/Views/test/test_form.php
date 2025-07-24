<h2>Test manuel d'une requête IA</h2>

<?php if ($error): ?>
    <div style="color:red;">Erreur : <?= esc($error) ?></div>
<?php endif; ?>

<form method="post" action="/adviser/ai-test/send">
    <label for="provider">Choisir un fournisseur IA :</label><br>
    <select name="provider" id="provider" required>
        <option value="">-- Sélectionner --</option>
        <?php foreach ($providers as $p): ?>
            <option value="<?= $p['id'] ?>" <?= ($selectedProvider == $p['id']) ? 'selected' : '' ?>>
                <?= esc($p['name']) ?> (<?= esc($p['provider']) ?>)
            </option>
        <?php endforeach ?>
    </select><br><br>

    <label for="prompt">Message / Erreur à envoyer :</label><br>
    <textarea name="prompt" id="prompt" rows="5" style="width: 100%" required><?= esc($prompt) ?></textarea><br><br>

    <button type="submit">Envoyer à l'IA</button>
</form>

<?php if ($response !== null): ?>
    <h3>Réponse de l'IA :</h3>
    <pre><?= esc($response) ?></pre>
<?php endif; ?>
