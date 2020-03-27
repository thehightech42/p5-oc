<?php
use P5\Gestion\Gestion;
ob_start();

$titlePage = "Listes des articles";

//require_once('gestion/Gestion.php');
$gestion = new Gestion;

?>
    <div class="container"><?php
    while($chapter = $chapters->fetch()){

    ?>
    <div class="row justify-content-center mt-3">
        <div class="col-lg-12">

            <h4>Article <?= $chapter['chapter_number'] .' - '. $chapter['chapter_name']?></h4>
            <?php $text = $gestion->reductionText($chapter['chapter_content'], 500); ?>
            <p class="mb-0"><a href="/?type=chapter&action=chapter&idChapter=<?= $chapter['id']?>"><?= $text ?></a></p>

        </div>

    </div>
        <hr>

    <?php
    };
    ?></div><?php
$content = ob_get_clean();

require('template.php');