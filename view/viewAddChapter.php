<?php
require('env.php');
ob_start();
?>
    <script src="vendor/tinymce/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#mytextarea',
            height : 600,
            plugins : 'advlist autolink link image lists charmap print preview'
        });
    </script>
<?php
$script = ob_get_clean();

$titlePage = "Ajout d'un chapitre";

ob_start();
if(($_GET['action'] === 'forUpdateChapter') || $uptade = true ){
    ?>
    <h4>Mise à jour de article</h4>
    <?php
}else{
    ?>
    <h4>Ajout de article</h4>
    <p>Pour ajouter un articles, il suffit de :</p>
    <?php
}
?>
<ol>
    <li>Donner un nom au articles.</li>
    <li>Donner un numéro au articles.</li>
    <li>Remplir le contenu du articles dans l'interface prévue à cet effet.</li>
</ol>
<p>Les chapitres restent modifiables après publication.</p>

    <form enctype="multipart/form-data"
        <?php
        if( (isset($_GET['type']) && isset($_GET['action']) && $_GET['action'] == "forUpdateChapter") || $uptade = true ){
            ?>
            action="/?type=chapter&action=updateChapter&idChapter=<?=$_GET['idChapter']?>"
            <?php
        }else{
            ?>
            action="/?type=chapter&action=addChapter"
            <?php
        }
        ?>
        method="POST">
        <div class="row">
            <div class="col-lg-5">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nom du Chapitre :</label>
                    <input type="text" class="form-control" id="chapterName" name="chapter_name" placeholder="Nom du Chapitre"
                        <?php
                        if(isset($informationChapter['chapter_name'])){
                            ?>
                            value="<?= $informationChapter['chapter_name']?>"
                            <?php
                        }
                        ?>
                        
                        required>
                </div>
            
                <div class="form-group">
                    <label for="exampleInputPassword1">Numéro du Chapitre :</label>
                    <input type="number" class="form-control<?php
                    if( !isset($informationChapter['chapter_number']) && ( isset($informationChapter['chapter_name']) && isset($informationChapter['chapter_content']) ) ) {
                        ?>
                        is-invalid
                        <?php
                    }
                    ?>
                    " id="chapterNumber" name="chapter_number" required min="1" placeholder="3"
                        <?php
                        if(isset($informationChapter['chapter_number']) ){
                            ?>
                            value="<?= $informationChapter['chapter_number']?>"
                            <?php
                        }
                        ?>
                    >
                    <div class="invalid-feedback">
                        Numéro de chapitre déjà utilisé !
                    </div>
                    <small id="chapterNumberHelp" class="form-text text-muted">Le numéro de chapitre est un numéro unique, utilisé pour le classement des chapitres.</small>
                </div>
            </div>

            <div class="col-lg-5 offset-lg-1 ">
                <div class="form-group">
                        <label for="exampleInputPassword1" class="p-0">Image de l'article :</label>
                            <?php if( (isset($informationChapter['src_img']) && $informationChapter['src_img'] == "1") || (!isset($informationChapter['src_img']) )){?>
                                <input type="file"  class="form-control<?php
                                if(isset($informationChapter['info_img'])) {
                                    ?>
                                    is-invalid
                                    <?php
                                }
                                ?>
                                " id="chapter_image" name="chapter_image">
                                <div class="invalid-feedback">
                                    <?= $informationChapter['info_img']; ?> 
                                </div>
                                <small id="chapterNumberHelp" class="form-text text-muted">Image de mise en avant. </br> Taille de l'image : 5Mo max. </br>Type accepté : JPG - JPEG - PNG - GIF.</small>
                            <?php } else { ?>
                                <div class="row d-flex justify-content-between">
                                    <div class="col-lg-10">
                                        <img src="<?= $informationChapter['src_img']?>" alt="image de mise en avant" class="img-fluid img-form-article">
                                    </div>
                                    <div class="col-lg-2">
                                        <input type='submit' class ="btn btn-primary mt-1 align-right" name="deleteImg" value="Supprimer"/>
                                    </div>
                                    
                                </div>
                            <?php };?>
                    </div>
                </div> 
        </div>        


        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Contenu :</label>
                    <textarea class="form-control" id="mytextarea" name="chapter_content" rows="10">
                        <?php
                        if(isset($informationChapter['chapter_content'])){
                            echo $informationChapter['chapter_content'];
                        }
                        ?>
                    </textarea>
                </div>
            </div>    
        </div>

      <button type="submit" class="btn btn-primary">Publier</button>
    </form>

<?php

$content = ob_get_clean();

require('template.php');