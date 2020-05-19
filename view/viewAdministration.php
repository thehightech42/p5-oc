<?php
require('env.php');
$titlePage = "Administration";
ob_start();
?>

    <div class="row ml-0 mr-0 d-flex bloc-Top-total-admin">
            <div class="bloc-Top-Admin half">
                <div class="row m-0">
                    <h5>Commentaires signalés :</h5>
                </div>
                <?php
                if($commentsReport->rowcount() === 0){
                    ?>
                    <div class="col-lg-12">
                        <p>Aucun commentaire signalé actuellement !</p>
                    </div>
                    <?php
                }else{
                    while($commentReport = $commentsReport->fetch()) {
                        ?>
                        <div class="row m-0 justify-content-between">
                            <div class="col-lg-10 p-0">
                                <p class="mb-0">Commentaire de : <?= $commentReport['pseudo'] ?> posté le <?= $commentReport['day'] ?>.<?= $commentReport['month'] ?>.<?= $commentReport['year'] ?></p>
                                <p class="mb-0"><?= $commentReport['content']?></p>

                            </div>

                            <div class="col-lg-1 p-0">
                                <p class="mb-1"><a href="/?type=chapter&action=acceptComment&idComment=<?= $commentReport['id']?>"><i class="fas fa-check"></i></i></a></p>
                                <p class="mb-1"><a href="/?type=chapter&action=deleteComment&idComment=<?= $commentReport['id']?>"><i class="fas fa-trash-alt"></i></a></p>
                            </div>
                        </div>
                        <hr>
                        <?php
                    }

                }
                ?>
            </div>

            <div class="bloc-Top-Admin half">
                <div class="row m-0">
                    <div class="col-lg-12 p-0">
                        <h5>Les 10 derniers commentaires :</h5>
                    </div>
                </div>
                <?php
                while($lastComment = $tenLastComments->fetch()) {
                    ?>
                    <div class="row m-0">
                        <div class="col-lg-12 p-0">
                            <p class="mb-0">Commentaire posté par <?= $lastComment['pseudo'] ?> le <?= $lastComment['day'] ?>.<?= $lastComment['month'] ?>.<?= $lastComment['year'] ?> - <?= $lastComment['content'] ?></p>
                        </div>
                    </div>
                    <hr/>
                    <?php
                }
                ?>

            </div>

    </div>

    <div class="row mt-5 ml-0 mr-0 justify-content-between bloc-Top-Admin">
        <h5 class="col-lg-12">Gestions des articles :</h5>
        <?php
            while($chapter = $chapters->fetch()){

        ?>
        <div class="col-lg-8">
            <a href="/?type=chapter&action=chapter&idChapter=<?= $chapter['id']?>">
                <h6><?=$chapter['chapter_name']?></h6>
            </a>
        </div>


        <div class="col-lg-1">
            <p><a href="/?type=chapter&action=forUpdateChapter&idChapter=<?= $chapter['id'] ?>"><i class="fas fa-pencil-alt"></i></a></p>
        </div>
        <div class="col-lg-1">
            <p><a href="/?type=chapter&action=deleteChapter&idChapter=<?= $chapter['id'] ?>"><i class="fas fa-trash-alt"></i></a></p>
        </div>

        <?php
            }
        ?>

    </div>

<?php
$content = ob_get_clean();

require('template.php');