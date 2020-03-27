<?php
$titlePage = "Gestion des commentaires";
ob_start();

while($comment = $comments->fetch()){
    ?>
    <div class="row mb-4">
        <div class="col-lg-10">
            <p>Commentaire de : <?= $comment['pseudo'] ?> posté le <?= $comment['published_date'] ?></p>
            <p><?= $comment['content']?></p>

        </div>
        <div class="col-lg-2">
            <p><a href="/?type=chapter&action=acceptComment&idComment=<?= $comment['id']?>">Valider</a></p>
            <p><a href="/?type=chapter&action=deleteComment&idComment=<?= $comment['id']?>">Supprimer définitvement</a></p>
        </div>
    </div>
    <?php
}

$content = ob_get_clean();

require('template.php');