<?php
require('env.php')
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-test">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand pr-5" href="/">Antonin</br>PFISTNER</a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item pr-2">
                <a class="nav-link text-white" href="/?type=chapter&action=chapterList">Articles</a>
            </li>
            <li class="nav-item pr-2">
                <a class="nav-link text-white" href="/?type=credit&action=amortizationTable">Générer un tableau </br> d'amortissement</a>
            </li>
            <li class="nav-item pr-2">
                <a class="nav-link text-white" href="/?type=credit&action=api">API</a>
            </li>
            <li class="nav-item pr-2">
                <a class="nav-link text-white" href="/?type=user&action=forContact">Contact</a>
            </li>
            
            <?php
                if(isset($_SESSION['admin']) && $_SESSION['admin'] === "1"){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link text-white pr-2" href="/?type=administration">Administration</br>des articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white pr-2" href="/?type=chapter&action=forAddChapter">Ajouter un article</a>
                    </li>
                    <?php
                }

            ?>
            <!--<li class="nav-item">
                <a class="nav-link" href="index.php?type=test&action=hash">Hash</a>
            </li>-->
        </ul>
        <ul class="navbar-nav mr-0 ">
            <?php
            if(isset($_SESSION['pseudo'])){
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= $_SESSION['pseudo'];?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/?type=user&action=forManageAccount">Gestion du compte</a>
                        <a class="dropdown-item" href="/?type=user&action=forUpdatePassword">Changer le mot de passe</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="/?type=user&action=endSession" class="btn btn-info" role="button" aria-pressed="true">Deconnexion</a>
                </li>
            <?php
            }else{
                ?>
            <li>
                <a href="/?type=user&action=forSinIn" class="btn btn-secondary" role="button" aria-pressed="true">Connexion</a>
                <a href="/?type=user&action=add" class="btn btn-info" role="button" aria-pressed="true">Inscription</a>
            </li>
            <?php
            }
            ?>


        </ul>
    </div>
</nav>