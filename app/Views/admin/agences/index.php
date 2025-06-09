<?php require __DIR__ . '/../../layout/header.php'; ?>

<div class="container mt-4">
    <h2>Liste des agences</h2>

    <a href="/admin/agences/creer" class="btn btn-success btn-sm mb-3">+ Ajouter une agence</a>

    <table class="table table-bordered">
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
</div>

<?php require __DIR__ . '/../../layout/footer.php'; ?>
