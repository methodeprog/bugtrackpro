<h2>Fournisseurs IA</h2>
<a href="/adviser/ai-providers/create">+ Ajouter</a>
<ul>
<?php foreach ($providers as $p): ?>
    <li><?= esc($p['name']) ?> (<?= esc($p['provider']) ?>)</li>
<?php endforeach ?>
</ul>
