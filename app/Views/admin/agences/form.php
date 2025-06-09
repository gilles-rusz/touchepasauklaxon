<?php require __DIR__ . '/../../layout/header.php'; ?>

<div class="container mt-4">
    <h2><?= isset($agence) ? "Modifier" : "Ajouter" ?> une agence</h2>

    <?php if (!empty($_SESSION['flash']['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['flash']['error'] ?></div>
        <?php unset($_SESSION['flash']['error']); ?>
    <?php endif; ?>

    <form method="POST" action="<?= isset($agence) ? "/admin/agences/{$agence['id']}/modifier" : "/admin/agences" ?>">
        <div class="mb-3">
            <label for="nom">Nom de l'agence</label>
            <input type="text" name="nom" id="nom" class="form-control" required value="<?= $agence['nom'] ?? '' ?>">
        </div>
        <button type="submit" class="btn btn-primary"><?= isset($agence) ? "Enregistrer" : "Créer" ?></button>
    </form>
</div>

<?php require __DIR__ . '/../../layout/footer.php'; ?>
