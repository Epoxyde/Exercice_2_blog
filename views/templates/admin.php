<?php
/**
 * Affichage de la partie admin :
 * monitoring et gestion des articles.
 */

// Détermine l'ordre du prochain tri.
// Si la colonne est déjà triée en ASC, le prochain clic passe en DESC.
// Sinon, le prochain clic passe en ASC.
function getNextOrder(string $column, string $sort, string $order): string
{
    if ($sort === $column && strtoupper($order) === 'ASC') {
        return 'DESC';
    }

    return 'ASC';
}
?>

<h2>Monitoring des articles</h2>

<div class="adminArticle">
    <table class="monitoringTable">
        <thead>
            <tr>
                <th>
                    <a href="index.php?action=admin&sort=title&order=<?= getNextOrder('title', $sort, $order) ?>">
                        Titre
                    </a>
                </th>

                <th>
                    <a href="index.php?action=admin&sort=views&order=<?= getNextOrder('views', $sort, $order) ?>">
                        Vues
                    </a>
                </th>

                <th>
                    <a href="index.php?action=admin&sort=comments&order=<?= getNextOrder('comments', $sort, $order) ?>">
                        Commentaires
                    </a>
                </th>

                <th>
                    <a href="index.php?action=admin&sort=date&order=<?= getNextOrder('date', $sort, $order) ?>">
                        Date de publication
                    </a>
                </th>

                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($articles as $article) { ?>
                <tr>
                    <td><?= htmlspecialchars($article->getTitle()) ?></td>
                    <td><?= $article->getViews() ?></td>
                    <td><?= $article->getCommentCount() ?></td>
                    <td><?= $article->getDateCreation()->format('d/m/Y H:i') ?></td>
                    <td>
                        <a class="submit"
                           href="index.php?action=showUpdateArticleForm&id=<?= $article->getId() ?>">
                            Modifier
                        </a>

                        <a class="submit"
                           href="index.php?action=deleteArticle&id=<?= $article->getId() ?>"
                           <?= Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer cet article ?") ?>>
                            Supprimer
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<a class="submit" href="index.php?action=showUpdateArticleForm">
    Ajouter un article
</a>