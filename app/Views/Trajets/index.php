<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-4">
    <h2>Liste des trajets</h2>

    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>Départ</th>
                <th>Arrivée</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Places</th>
                <th>Proposé par</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($trajets as $t): ?>
                <tr>
                    <td><?= htmlspecialchars($t['depart']) ?></td>
                    <td><?= htmlspecialchars($t['arrivee']) ?></td>
                    <td><?= htmlspecialchars($t['date_trajet']) ?></td>
                    <td><?= htmlspecialchars($t['heure_depart']) ?></td>
                    <td><?= htmlspecialchars($t['nb_places']) ?></td>
                    <td><?= htmlspecialchars($t['prenom'] . ' ' . $t['nom']) ?></td>
                    <td>
                        <!-- Bouton d'information -->
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#infoModal<?= $t['id'] ?>">
                            Détails
                        </button>

                        <?php if ($_SESSION['user']['id'] == $t['employe_id'] || $_SESSION['user']['is_admin']): ?>
                            <a href="/trajets/<?= $t['id'] ?>/modifier" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="/trajets/<?= $t['id'] ?>/supprimer" method="POST" style="display:inline;">
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>

                <!-- Modale Bootstrap -->
                <div class="modal fade" id="infoModal<?= $t['id'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $t['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel<?= $t['id'] ?>">Infos du conducteur</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Nom :</strong> <?= htmlspecialchars($t['prenom'] . ' ' . $t['nom']) ?></p>
                                <p><strong>Email :</strong> <?= htmlspecialchars($t['email']) ?></p>
                                <p><strong>Téléphone :</strong> <?= htmlspecialchars($t['telephone']) ?></p>
                                <p><strong>Total de places :</strong> <?= htmlspecialchars($t['nb_places']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>

