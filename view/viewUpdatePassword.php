<?php
require('env.php');
$titlePage = "Changer le mot de passe";
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
    <div class="row mx-auto">
        <div class="col-lg-12 p-0">
            <h4>Mise à jour de mot de passe</h4>
            <form id="formWithPassword" action="/?type=user&action=updatePassword" method="POST">
                <div class="form-group">
                    <label for="last_password">Ancien mot de passe</label>
                    <input type="password" class="form-control" id="last_password" name="last_password"  placeholder="Ancien mot de passe">
                </div>
                <div class="form-group">
                    <label for="password">Nouveau mot de passe</label>
                    <input type="password" class="form-control" id="password" name="new_password"  placeholder="Nouveau mot de passe">
                </div>
                <div class="form-group">
                    <label for="password1">Confirmation nouveau mot de passe</label>
                    <input type="password" class="form-control" id="password1" name="new_password1"  placeholder="Confirmation">
                    <div class="invalid-feedback">
                        Les mot de passe ne sont pas identique !
                    </div>
                </div>
                <button type="submit">Changer le mot de passe</button>
            </form>
        </div>
    </div>
<?php

$content = ob_get_clean();
require('template.php');