<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-4">
    <h2>Créer un trajet</h2>

    <?php if (!empty($_SESSION['flash']['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['flash']['error'] ?></div>
        <?php unset($_SESSION['flash']['error']); ?>
    <?php endif; ?>

    <form method="POST" action="/trajets">
        <div class="mb-3">
            <label>Départ</label>
            <input type="text" name="depart" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Arrivée</label>
            <input type="text" name="arrivee" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="date_trajet" class="form-control" min="<?= date('Y-m-d') ?>" required>
        </div>
        <div class="mb-3">
            <label>Heure de départ</label>
            <input type="time" name="heure_depart" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nombre de places</label>
            <input type="number" name="nb_places" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label>Nom du conducteur</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']) ?>" readonly>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" value="<?= htmlspecialchars($_SESSION['user']['email']) ?>" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Créer le trajet</button>
    </form>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>

