<?php

if(isset($_POST['password'])){
    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
}else{
    $hash = " - ";
}


ob_start();
?>
<h3>Visualisation d'un hash !</h3>

<form action="index.php?type=test&action=hash" method="POST">
    <label>Votre mot de passe : <input class="form-control" type="text" name="password"> </label>
    <button type="submit">Valider</button>
</form>

<h3>
    Le hash : <?= $hash ?>
</h3>



<?php
$content = ob_get_clean();
$titlePage = "Hash Password";



require('template.php');