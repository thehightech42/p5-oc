<?php
require('env.php');
use P5\Gestion\Gestion;

ob_start();
$use_chapter = $chapter->fetch();
$id = $use_chapter['id'];

$date = $dateChapter->fetch();
$this->_gestion = new Gestion;
$monthLetter = $this->_gestion->month($date['month']);


$titlePage = "Article ". $use_chapter['chapter_number'] .' - ' .$use_chapter['chapter_name'];
?>
    <div>
        <h3>Article <?= $use_chapter['chapter_number'] .' - ' .$use_chapter['chapter_name']; ?></h3>
        <p class="mb-4">Publié le <?=$date['day'] ?> <?= $monthLetter ?> <?= $date['year'] ?></p>
        <?php
        if($use_chapter['src_img'] !== "1"){
            ?>
            <img src="<?= $use_chapter['src_img']?>" alt="" class="img-article img-fluid pr-2"/>
            <?php
        }
        ?>

        <p class="mb-0" ><?= $use_chapter['chapter_content']; ?></p>
    </div>


    <div class="mt-5 clearboth">
        <h4>Commentaires :</h4>
<?php

if(isset($_SESSION['pseudo'])){
    ?>
    <form action="/?type=chapter&action=addComment&idChapter=<?= $id; ?>" method="POST" class="mb-3">
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Votre commentaire : </label>
            <input type="text" id="contentComment" name="content" class="form-control" placeholder="Votre commentaire !">
        </div>

        <button type="submit" class="btn btn-primary">Publier</button>
    </form>

    <?php
}
if($comments->rowcount() == 0){
    ?>
    <div class="row">
        <div class="col-lg-10 mt-3">
            <p>Aucun commentaire pour ce chapitre.</p>
        </div>
    </div>
    <?php
}

while($comment = $comments->fetch()){
    ?>
        <div class="row">
            <div class="col-lg-10 mt-3">
                <p class="mb-0">Commentaire de : <?= $comment['pseudo'] ?> posté le <?=  $comment['day'] ?>.<?= $comment['month'] ?>.<?= $comment['year']?></p>
                <p class="mb-0"><?= $comment['content']?></p>
            </div>

            <div class="col-lg-2">
                <a href="/?type=chapter&action=reportComment&idComment=<?= $comment['id']?>&idChapter=<?=$id?>" class="align-middle">Signaler</a>
            </div>
    </div>
    <hr>

<?php
};
?>
    </div>

<?php


$content = ob_get_clean();

require('template.php');
