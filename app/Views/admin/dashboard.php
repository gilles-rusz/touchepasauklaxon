<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-4">
    <h2>Tableau de bord administrateur</h2>

    <hr>

    <h3> Employés</h3>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Admin</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employes as $e): ?>
                <tr>
                    <td><?= htmlspecialchars($e['nom']) ?></td>
                    <td><?= htmlspecialchars($e['prenom']) ?></td>
                    <td><?= htmlspecialchars($e['email']) ?></td>
                    <td><?= $e['is_admin'] ? 'Oui' : 'Non' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <hr>

    <h3>Agences</h3>
    <a href="/admin/agences/creer" class="btn btn-success btn-sm mb-2">+ Ajouter une agence</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($agences as $a): ?>
                <tr>
                    <td><?= htmlspecialchars($a['nom']) ?></td>
                    <td>
                        <a href="/admin/agences/<?= $a['id'] ?>/modifier" class="btn btn-warning btn-sm">Modifier</a>
                        <form method="POST" action="/admin/agences/<?= $a['id'] ?>/supprimer" style="display:inline;">
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <hr>

    <h3>Trajets</h3>
    <table class="table table-bordered table-striped">
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
                        <form method="POST" action="/trajets/<?= $t['id'] ?>/supprimer" onsubmit="return confirm('Supprimer ce trajet ?');">
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
