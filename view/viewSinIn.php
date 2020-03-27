<?php
require('env.php');
$titlePage = "Connexion";

ob_start();
?>

    <div class="row justify-content-center">
        <div class="col-lg-4 mx-auto ">
            <h4>Connexion :</h4>
            <form action="/?type=user&action=sinIn" method="POST">
                <div class="form-group mb-2">
                    <label for="pseudo">Pseudo :
                        <input type="text" id="pseudo" name="pseudo" class="form-control <?php if(isset($_GET['info']) && $_GET['info'] === "echec"){?>border border-danger<?php }?>" placeholder="Pseudo" required>
                    </label>
                </div>
                <div class="form-group mb-2">
                    <label for="password">Mot de passe :
                        <input type="password" id="password" name="password" class="form-control <?php if(isset($_GET['info']) && $_GET['info'] === "echec"){?> border border-danger<?php }?>" placeholder="Mot de passe" required>
                    </label>
                </div>
                <?php
                if(isset($_GET['info']) && $_GET['info'] === "echec"){
                    ?>
                    <p>Identifiant ou mot de passe incorrect</p>
                    <?php
                }
                ?>
                <div class="form-group mt-2">
                    <button type="submit">Connexion</button>
                </div>
            </form>
            <p>Pas encore inscrit ? <a href="/?type=user&action=forRegistration"> C'est pas ici !</a></p>


        </div>

    </div>

<?php
$content = ob_get_clean();

require('template.php');