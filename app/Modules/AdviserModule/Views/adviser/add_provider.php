<form method="post" action="/adviser/ai-providers/store">
    <label>Nom :</label>
    <input type="text" name="name" required>

    <label>Fournisseur :</label>
    <select name="provider" required>
        <option value="openai">OpenAI</option>
        <option value="huggingface">Hugging Face</option>
        <!-- d’autres à venir -->
    </select>

    <label>Clé API :</label>
    <input type="text" name="api_key" required>

    <button type="submit">Ajouter</button>
</form>
