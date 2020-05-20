<?php
require('env.php')
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title> <?= $titlePage; ?> </title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

        <meta name="title" content="<?= $titlePage ?>"/>
        <meta name="description" content="Antonin Pfistner | Etudiant développeur Web Full Stack"/>
        <meta name="url" content="http://p5.antoninpfistner.fr"/>

        <meta name="twitter:card" content="summary"/>
        <meta name="twitter:title" content="<?= $titlePage ?>"/>
        <meta name="twitter:description" content="Antonin Pfistner | Etudiant développeur Web Full Stack"/>

        <meta property="og:title" content="<?= $titlePage ?>"/>
        <meta property="og:description" content="Antonin Pfistner | Etudiant développeur Web Full Stack"/>
        <meta property="og:type" content="Un blog d'étudiant avec une api calculer des informations de crédit."/>
        <meta property="og:url" content="http://p5.antoninpfistner.fr"/>

        <!--CSS Bootstrap-->
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <!-- Style -->
        <link rel="stylesheet" type="text/css" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-shims.min.css" media="all">
        <link rel="stylesheet" type="text/css" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css" media="all">
        <link rel="stylesheet" type="text/css" href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" media="all">
        <link rel="stylesheet" type="text/css" href="<?= $pathStyle ?>">
    </head>

    <body>
    <div id="body-page" class="container-fluid p-0">
        <div class="row m-0 p-0">
            <div class="col-lg-12 p-0">
                <?php include('view/nav.php');?>
            </div>
        </div>


        <?php if(!isset($_GET['type']) || $_GET['type'] === "home"){ ?>
            <div class="row m-0 p-0">
                <div class="col-lg-12 p-0">
                    <?= $content ; ?>
                </div>
            </div>

            <?php

        }elseif($_GET['type'] === 'administration' ){
            ?>
            <div class="row m-0 mb-5 screen">
                <div class="col-lg-11 mx-auto">
                    <?= $content ?>
                </div>
            </div>
            <?php
        }
        else{
            ?>
            <div class="row mt-5 ml-0 mr-0 mb-5 screen">
                <div class="col-lg-8 mx-auto">
                    <?= $content ?>
                </div>
            </div>
            <?php
        }
        ?>
        <footer>
                <?php include('view/footer.php');;?>
        </footer>

        <?php
        if(!isset($_COOKIE['info-cookie']) || $_COOKIE['info-cookie'] !== "YES"){
            ?>
            <div class="row fixed-bottom pl-5 pr-5 pb-1 pt-2" id="info-cookie">
                <div class="col-lg-12 bloc-cookie align-items-center">
                    <p class="text-cookie ">Pour améliorer l'expérience utilisateur, ce site a recours à l'utilisation de cookies. Aucunes données ne seront vendues.</p> <button id="button-cookie">Ok</button>
                </div>
            </div>
        <?php
        }
        ?>
    </div>


    <!--Script Bootstrap-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- Autre script-->
    <?php
    if(!isset($_COOKIE['info-cookie']) || $_COOKIE['info-cookie'] !== "YES") {
        ?>
        <script src="js/gestion.js"></script>
        <?php
    }
    if(isset($script)){
        echo $script ;
    }
    
    ?>

    </body>

</html>