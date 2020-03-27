<?php
$titlePage = "Gestion du compte";

ob_start();
?>
    <div class="row">
        <div class="col-lg-12">
            <h4>Gestion du compte</h4>

            <form action="/?type=user&action=manageAccount" method="POST">

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
                            border border-danger
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
                    <small id="pseudoHelp" class="form-text text-muted">Il sera utilisé pour poster des messages et vous connecter.</small>
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" class="form-control
                    <?php
                    if(!isset($userInformation['mail']) && isset($userInformation['first_name'])){
                        ?>
                             border border-danger
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
                    <small id="emailHelp" class="form-text text-muted">Nous ne partagerons jamais votre e-mail !</small>
                </div>

                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>



        </div>
    </div>


<?php
$content = ob_get_clean();

require('template.php');