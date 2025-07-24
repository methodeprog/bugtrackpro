<h2>Test du fournisseur : <?= esc($provider['name']) ?></h2>

<form method="post" action="/adviser/ai-providers/test/send/<?= $provider['id'] ?>">
    <textarea name="prompt" rows="5" style="width:100%" placeholder="Tapez un message à envoyer à l'IA"><?= set_value('prompt') ?></textarea><br>
    <button type="submit">Envoyer</button>
</form>

<?php if ($response !== null): ?>
    <h3>Réponse de l'IA :</h3>
    <pre><?= esc($response) ?></pre>
<?php endif; ?>

<a href="/adviser/ai-providers">← Retour à la liste</a>
