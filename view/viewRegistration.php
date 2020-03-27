<?php
$titlePage = "Inscription";
ob_start();
?>

    <script src="js/ControlePassword.js"></script>
    <script>
        console.log('testview');
        let checkPassword = new ControlePassword(document.getElementById("formWithPassword"), document.getElementById("password"), document.getElementById("password1"));
    </script>

<?php
$script = ob_get_clean();
ob_start();
?>

    <div class="row">
        <div class="col-lg-10 mx-auto">
            <h3>Pourquoi s'inscrire ?</h3>
            <ul>
                <li>Pour commenter les chapitres.</li>
                <li>D'autres fonctionnalités arriverons bientôt !</li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 mx-auto">
            <h3>
                Inscription :
            </h3>

        <form id="formWithPassword" action="/?type=user&action=registration" method="POST">
            <div class="form-group">
                <label for="first_name">Prenom :</label>
                <input type="text" class="form-control" id="first_name" aria-describedby="emailHelp" name ="first_name" placeholder="Prenom"
                    <?php
                    if(isset($userInformation['first_name'])){
                        ?>
                        value="<?= $userInformation['first_name']?>"
                        <?php
                    }
                    ?>
                required>
            </div>
            <div class="form-group">
                <label for="last_name">Nom :</label>
                <input type="text" class="form-control" id="last_name" aria-describedby="emailHelp" name ="last_name" placeholder="Nom"
                    <?php
                    if(isset($userInformation['last_name'])){
                        ?>
                        value="<?= $userInformation['last_name']?>"
                        <?php
                    }
                    ?>
                required>
            </div>

            <div class="form-group">
                <label for="pseudo">Pseudo :</label>
                <input type="text" class="form-control
                    <?php
                        if(!isset($userInformation['pseudo']) && isset($userInformation['first_name'])){
                            ?>
                            is-invalid
                            <?php
                        }
                    ?>
                    " id="pseudo" aria-describedby="emailHelp" name ="user_pseudo" placeholder="Entrez votre pseudo"
                    <?php
                    if(isset($userInformation['pseudo'])){
                        ?>
                        value="<?= $userInformation['pseudo']?>"
                        <?php
                    }
                    ?>
                required>
                <div class="invalid-feedback">
                    Pseudo déjà utilisé, merci d'en choisir un autre !
                </div>
                <small id="pseudoHelp" class="form-text text-muted">Il sera utilisé pour poster des commentaires et vous connecter.</small>
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" class="form-control
                    <?php
                        if(!isset($userInformation['mail']) && isset($userInformation['first_name'])){
                            ?>
                             is-invalid
                             <?php
                        }
                    ?>
                    " id="email" aria-describedby="emailHelp" name="user_mail"placeholder="E-Mail"
                    <?php
                    if(isset($userInformation['mail'])){
                        ?>
                        value="<?= $userInformation['mail']?>"
                        <?php
                    }
                    ?>
                required>
                <div class="invalid-feedback">
                    Email déjà utilisé, merci de choisir une autre adresse e-mail !
                </div>
                <small id="emailHelp" class="form-text text-muted">Nous ne partagerons jamais votre e-mail !</small>

            </div>

            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" class="form-control<?php if($tryPass === 0){ ?> is-invalid<?php } ?>" id="password" name="password" placeholder="Mot de passe" required>
            </div>
            <div class="form-group">
                <label for="password1">Mot de passe de confirmation :</label>
                <input type="password" class="form-control <?php if($tryPass === 0){ ?> is-invalid<?php } ?>" id="password1" name="password1" placeholder="Mot de passe" required>
                <div class="invalid-feedback">
                    Les mot de passe ne sont pas identique !
                </div>
            </div>


            <button type="submit" class="btn btn-primary" id="buttonOfRegistration">Envoyer</button>
        </form>

        <?php
            if(!isset($userInformation)){
                ?>
                <p>Vous avez un compte ? <a href="/?type=user&action=forSingIn"> Connectez vous ici !</a></p>
                <?php
            }
        ?>
    </div>
</div>

<?php
$content = ob_get_clean();

require('template.php');