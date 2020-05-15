<?php

$titlePage = "Error"; 

if($e->getCode() !== 0){
    $errorCode = $e->getCode();
}

$errorMsg = $e->getMessage();
ob_start();

?>
    <div class="row align-items-center mt-5 pt-5">
        <div class="col-lg-4">
            <?php 
            if(isset($errorCode) && $errorCode === 404){
            ?>
                <img src="img/404.jpg" class="w-75 mx-auto d-block" alt="Image représentative d'une erreur 404.">
            <?php
            }else{
            ?>
                <img src="img/500.jpg" class="w-75 mx-auto d-block" alt="Image drôle représentative d'une erreur variable.">
            <?php
            }
            ?>
            
        </div>

        <div class="col-lg-8">

            <h1 class="text-center"><?php  echo "Erreur : " ;
            if(isset($errorCode)){
                echo $errorCode." - ";
                }
                echo $e->getMessage()?>
                
                </h1>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">

        </div>
    </div>

<?php

$content = ob_get_clean(); 

require('template.php');