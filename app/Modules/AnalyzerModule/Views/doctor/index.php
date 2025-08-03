<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Doctor Module</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    .error-card { border: 1px solid #ccc; padding: 10px; margin-bottom: 10px; }
    .recommendation { background: #f9f9f9; padding: 10px; margin-top: 5px; }
  </style>
</head>
<body>
  <h2>🩺 Liste des erreurs détectées</h2>
  <div id="error-list">Chargement...</div>

  <script>
    async function loadErrors() {
      const res = await fetch('/doctor/errors');
      const errors = await res.json();
      const list = document.getElementById('error-list');
      list.innerHTML = '';

      errors.forEach(error => {
        const card = document.createElement('div');
        card.className = 'error-card';
        card.innerHTML = `
          <strong>${error.message}</strong><br>
          <small>${error.created_at}</small><br>
          <button onclick="loadRecommendation(${error.id}, this)">Obtenir une recommandation</button>
          <div class="recommendation" id="rec-${error.id}"></div>
        `;
        list.appendChild(card);
      });
    }

    async function loadRecommendation(id, btn) {
      btn.disabled = true;
      const res = await fetch('/doctor/recommendation/' + id);
      const data = await res.json();
      document.getElementById('rec-' + id).innerText = data.recommendation;
      btn.disabled = false;
    }

    loadErrors();
  </script>
</body>
</html>
