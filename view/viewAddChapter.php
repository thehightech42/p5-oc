<?php
require('env.php');
ob_start();
?>
    <script src="https://cdn.tiny.cloud/1/<?= $TOKEN?>/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
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
if($_GET['action'] === 'forUpdateChapter'){
    ?>
    <h4>Mise à jour de chapitre</h4>
    <?php
}else{
    ?>
    <h4>Ajout de chapitre</h4>
    <p>Pour ajouter un chapitre, il suffit de :</p>
    <?php
}
?>
<ol>
    <li>Donner un nom au chapitre.</li>
    <li>Donner un numéro au chapitre.</li>
    <li>Remplir le contenu du chapitre dans l'interface prévue à cet effet.</li>
</ol>
<p>Les chapitres restent modifiables après publication.</p>

    <form
            <?php
            if(isset($_GET['type']) && isset($_GET['action']) && $_GET['action'] == "forUpdateChapter"){
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
      <div class="form-group">
        <label for="exampleInputEmail1">Nom du Chapitre :</label>
        <input type="text" class="form-control" id="chapterName" name="chapter_name" placeholder="Nom du Chapitre"
               <?php
               if(isset($upChapter['chapter_name'])){
                   ?>
                   value="<?= $upChapter['chapter_name']?>"
                   <?php
               }elseif(isset($informationChapter['chapter_name'])){
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
        if(!isset($informationChapter['chapter_number']) && isset($informationChapter['chapter_name'])) {
            ?>
            is-invalid
            <?php
        }
        ?>
        " id="chapterNumber" name="chapter_number" required min="1" placeholder="3"
            <?php
            if(isset($upChapter['chapter_number'])){
                ?>
                value="<?= $upChapter['chapter_number']?>"
                <?php
            }
            ?>
          >
          <div class="invalid-feedback">
              Numéro de chapitre déjà utilisé !
          </div>
          <small id="chapterNumberHelp" class="form-text text-muted">Le numéro de chapitre est un numéro unique, utilisé pour le classement des chapitres.</small>
      </div>

        <div class="form-group">
            <label for="exampleFormControlTextarea1">Contenu :</label>
            <textarea class="form-control" id="mytextarea" name="chapter_content" rows="10">
                <?php
                if(isset($upChapter['chapter_content'])){
                    echo $upChapter['chapter_content'];
                }elseif(isset($informationChapter['chapter_content'])){
                    echo $informationChapter['chapter_content'];
                }
                ?>
            </textarea>
        </div>

      <button type="submit" class="btn btn-primary">Publier</button>
    </form>

<?php

$content = ob_get_clean();

require('template.php');