<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Bug Manager App</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .sidebar {
      width: 240px;
      background-color: #f8f9fa;
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      padding-top: 60px;
      overflow-y: auto;
      z-index: 1030;
    }
    .main-content {
      margin-left: 240px;
      padding: 1rem;
      margin-top: 60px;
    }
    .navbar-top {
      position: fixed;
      top: 0;
      left: 240px;
      right: 0;
      z-index: 1040;
    }
    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }
      .main-content {
        margin-left: 0;
      }
      .navbar-top {
        left: 0;
      }
    }
  </style>
</head>
<body>

<!-- SIDEBAR GAUCHE -->
<div class="sidebar border-end">
  <ul class="nav flex-column p-2">
    <li class="nav-item"><a class="nav-link" href="/dashboard"><i class="bi bi-speedometer2"></i> Tableau de bord</a></li>
    <li class="nav-item"><a class="nav-link" href="<?= base_url('dashboard/organizations') ?>"><i class="bi bi-diagram-3"></i> Organization</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('dashboard/projects') ?>"><i class="bi bi-diagram-3"></i> Projets</a></li>
    <li class="nav-item"><a class="nav-link" href="/bugs"><i class="bi bi-bug"></i> Bugs signalés</a></li>
    <li class="nav-item"><a class="nav-link" href="/timeline"><i class="bi bi-clock-history"></i> Timeline</a></li>
    <li class="nav-item"><a class="nav-link" href="/attachments"><i class="bi bi-paperclip"></i> Pièces jointes</a></li>
    <li class="nav-item"><a class="nav-link" href="/comments"><i class="bi bi-chat-dots"></i> Commentaires</a></li>
    <li class="nav-item"><a class="nav-link" href="/monitoring"><i class="bi bi-bar-chart-line"></i> Monitoring</a></li>
    <li class="nav-item"><a class="nav-link" href="/resolutions"><i class="bi bi-tools"></i> Résolutions</a></li>
    <li class="nav-item"><a class="nav-link" href="/documentation"><i class="bi bi-journal-code"></i> Documentation</a></li>
    <li class="nav-item"><a class="nav-link" href="/webhooks"><i class="bi bi-link-45deg"></i> Webhooks</a></li>
    <li class="nav-item"><a class="nav-link" href="/audit"><i class="bi bi-shield-check"></i> Journal d’audit</a></li>
  </ul>
</div>

<!-- NAVBAR TOP DROIT -->
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-top border-bottom">
  <div class="container-fluid justify-content-end">
    <ul class="navbar-nav align-items-center">
      <li class="nav-item me-3">
        <a class="nav-link position-relative" href="#">
          <i class="bi bi-bell fs-5"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
        </a>
      </li>
      <li class="nav-item me-3">
        <a class="nav-link" href="#"><i class="bi bi-translate fs-5"></i></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
          <i class="bi bi-person-circle fs-5 me-1"></i> Méthode
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="/profile">Mon profil</a></li>
          <li><a class="dropdown-item" href="/settings">Paramètres</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item text-danger" href="/logout">Déconnexion</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>

<!-- CONTENU PRINCIPAL -->
<main class="main-content">
  <h1>Bienvenue dans la plateforme de gestion des bugs</h1>
  <p>Choisissez un module dans le menu de gauche pour commencer.</p>
</main>

<!-- JS Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
