<?php
$titlePage ="Formulaire de contact";
require('env.php');
ob_start();
?>
    <script src="https://cdn.tiny.cloud/1/<?= $TOKEN?>/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mymessage',
            height : 500
        });
    </script>
<?php
$script = ob_get_clean();

ob_start();
?>
    <div class="col-lg-12 p-0 mb-2">
        <h4>Formulaire de contact</h4>
    </div>

    <form id="contact-form" name="contact-form" action="/?type=user&action=contact" method="POST">
        <div class="row mt-3">
                <div class="col-md-6 mt-3">
                    <div class="md-form mb-0">
                        <label for="name" class="mb-0">Nom et Prénom</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-6 mt-3">
                    <div class="md-form mb-0">
                        <label for="email" class="mb-0">Votre Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                        <small id="mailHelp" class="form-text text-muted">Celle-ci sera utilisée pour vous répondre</small>

                    </div>
                </div>
        </div>

        <div class="row">
            <div class="col-lg-12 mt-3">
                <div class="md-form mb-0">
                    <label for="subject" class="mb-0">Sujet</label>
                    <input type="text" id="subject" name="subject" class="form-control" required>
                    <small id="sujetHelp" class="form-text text-muted">Pour quelle raison vous contactez-nous ?</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="md-form">
                    <label for="message" class="mb-0">Votre message</label>
                    <textarea type="text" id="test" name="message" rows="2" class="form-control md-textarea"></textarea>
                    <small id="messageHelp" class="form-text text-muted">Afin d'avoir une réponse, merci de poser le minimum de questions et faire un petit message.</small>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mt-5">
                <button type="submit">Envoyer le formulaire</button>
            </div>
        </div>
    </form>

<?php
if(is_string($info)){
    echo $info;
}
?>

<?php
$content = ob_get_clean();

require('template.php');
