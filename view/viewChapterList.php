<?php
use P5\Gestion\Gestion;
ob_start();

$titlePage = "Articles";

$gestion = new Gestion;
?>
    <div class="container d-flex flex-column justify-content-between h-100">

        <div class="row ">
            <?php while($chapter = $chapters->fetch()){?>
                <div class="col-lg-12 mb-2 mt-5">
                    <h4 class="mb-0">Article <?= $chapter['chapter_number'] .' - '. $chapter['chapter_name']?></h4>
                    <?php $text = $gestion->reductionText($chapter['chapter_content'], 500); ?>
                    <p class="mb-1 mt-1"><?php $date = new \DateTime($chapter['published_date']); echo $date->format('d - M - Y')?></p>
                    <p class="mb-0"><a href="/?type=chapter&action=chapter&idChapter=<?= $chapter['id']?>"><?= $text ?></a></p>
                    <hr class="mt-3 mx-0">
                </div>
            <?php }; ?>
        </div>

        <div class="row mh-100">
        <?php
            echo $navPage;
        ?>
        </div>

    </div>

<?php
$content = ob_get_clean();

require('template.php');