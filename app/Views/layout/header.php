<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Touche pas au klaxon</title>
    <link rel="stylesheet" href="/assets/bootstrap.min.css">
</head>
<body>

<header class="bg-light py-3 mb-4 border-bottom">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="<?= isset($_SESSION['user']) && $_SESSION['user']['is_admin'] ? '/admin' : '/' ?>" class="h4 text-dark text-decoration-none">
            Touche pas au klaxon
        </a>

        <div>
            <?php if (!isset($_SESSION['user'])): ?>
                <a href="/login" class="btn btn-outline-primary">Connexion</a>

            <?php elseif ($_SESSION['user']['is_admin']): ?>
                <a href="/admin" class="btn btn-outline-dark me-2">Tableau de bord</a>
                <a href="/admin/agences" class="btn btn-outline-dark me-2">Agences</a>
                <a href="/trajets" class="btn btn-outline-dark me-2">Trajets</a>
                <a href="/logout" class="btn btn-danger">Déconnexion</a>

            <?php else: ?>
                <a href="/trajets/creer" class="btn btn-outline-success me-2">Proposer un trajet</a>
                <span class="me-2"><?= htmlspecialchars($_SESSION['user']['prenom']) ?> <?= htmlspecialchars($_SESSION['user']['nom']) ?></span>
                <a href="/logout" class="btn btn-danger">Déconnexion</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<?php if (!empty($_SESSION['flash']['success'])): ?>
    <div class="container">
        <div class="alert alert-success">
            <?= $_SESSION['flash']['success'] ?>
        </div>
    </div>
    <?php unset($_SESSION['flash']['success']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['flash']['error'])): ?>
    <div class="container">
        <div class="alert alert-danger">
            <?= $_SESSION['flash']['error'] ?>
        </div>
    </div>
    <?php unset($_SESSION['flash']['error']); ?>
<?php endif; ?>
