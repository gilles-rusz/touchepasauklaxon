<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-4">
    <h2>Trajets disponibles</h2>

    <?php if (empty($trajets)): ?>
        <div class="alert alert-info">Aucun trajet disponible pour le moment.</div>
    <?php else: ?>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Départ</th>
                    <th>Arrivée</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Places disponibles</th>
                    <?php if (isset($_SESSION['user'])): ?>
                        <th>Actions</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($trajets as $trajet): ?>
                    <tr>
                        <td><?= htmlspecialchars($trajet['depart']) ?></td>
                        <td><?= htmlspecialchars($trajet['arrivee']) ?></td>
                        <td><?= htmlspecialchars($trajet['date_trajet']) ?></td>
                        <td><?= htmlspecialchars($trajet['heure_depart']) ?></td>
                        <td><?= htmlspecialchars($trajet['nb_places']) ?></td>

                        <?php if (isset($_SESSION['user'])): ?>
                            <td>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#trajetModal<?= $trajet['id'] ?>">
                                    Voir plus
                                </button>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<!-- Modales Bootstrap par trajet -->
<?php if (isset($_SESSION['user'])): ?>
    <?php foreach ($trajets as $trajet): ?>
        <div class="modal fade" id="trajetModal<?= $trajet['id'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $trajet['id'] ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel<?= $trajet['id'] ?>">Détails du trajet</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Proposé par :</strong> <?= htmlspecialchars($trajet['prenom'] . ' ' . $trajet['nom']) ?></p>
                        <p><strong>Email :</strong> <?= htmlspecialchars($trajet['email']) ?></p>
                        <p><strong>Téléphone :</strong> <?= htmlspecialchars($trajet['telephone']) ?></p>
                        <p><strong>Nombre total de places :</strong> <?= $trajet['nb_places'] ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php require __DIR__ . '/../layout/footer.php'; ?>
