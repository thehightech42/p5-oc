<?php
$titlePage = "Documentation";

ob_start(); 
?>
    <h4 class="mb-3">Documentation : </h4>
    <div class="row mb-4">
        <div class="col-lg-12">
            <p class="text-justify">L’API-crédit est une API permettant de calculer facilement la mensualité d’un crédit ainsi que le coût de celui-ci dans la cadre d’un crédit à mensualités constantes.</p>
            <p class="text-justify">Un crédit à mensualités constantes signifie que la mensualité est toujours la même. 
                Dans ce cadre, la répartition entre capital et intérêts évolue chaque mois. En effet, plus on avance dans le temps plus la part de capital remboursé est importante et plus  la part de d’intérêt diminue. 
            </p>
            <p class="text-justify">Dans un second temps, l’API permettra le calcul avec un remboursement de capital constant. 
                Cela signifie que la capital remboursé chaque mois sur la durée du crédit reste la même et que la mensualité diminuera dans le temps. 
            </p>
            <p class="text-justify">L’API-crédit s’utilise à l’aide d’une requête AJAX (Asynchronous Javascript + XML) avec des paramètres GET. </p>
            <p class="text-justify">Afin d’utiliser l’API, vous devez vous créer un compte sur <a href="https://p5.antoninpfistner.fr/?type=user&action=forSinIn">ici</a> afin de récupérer une KEY. Celle-ci se trouve sur la page « Gestion de compte ». À tout moment, celle-ci peut être remplacée en cliquant sur « Générer une nouvelle clé ». </p>
            <p class="text-justify">L’API répond au format JSON une suite de données.</p>
        </div>
    </div>

    <hr class="mb-3">

    <h5 class="mb-3">Sans compte :</h5>
    <div class="row justify-content-between mb-4">
        <div class="col-lg-5">
            <img src="img/KeyFalseApi.png" alt="Image de la réponse JSON, en cas de clé erroné." class="w-100">
        </div>
        <div class="col-lg-6">
            <p>Si vous ne possédez pas de compte ou que votre clé est mauvaise, l'API vous renverra le message ci joint.</p>
        </div>
    </div>

    <hr class="mb-3">

    <h5 class="mb-3">Paramètre manquant :</h5>
    <div class="row justify-content-between mb-4">
        <div class="col-lg-6">
            <p>Dans le cadre de manque d’informations, l’API vous informera quelle information manque. Dans la cadre ci-dessus, le taux n’a pas été fourni.</p>
            <img src="img/JSONElementMissing" alt="JSON en cas de paramètre manquant.">
        </div>
        <div class="col-lg-5">
            <img src="img/ElementCreditMissing.png" alt="Image de la réponse JSON, de paramètre manquant" class="w-100">
        </div>
    </div>

    <hr class="mb-3">

    <h5 class="mb-3">Quand tout est conforme l'API vous repondra comme ci-dessous :</h5>
    <div class="row justify-content-between mb-4">
        <div class="col-lg-6">
            <img src="img/RequetteConforme.png" alt="JSON suite à une requette conforme" class="w-75">
        </div>
        <div class="col-lg-6">
            <p>On retrouve la mensualité, le coût du crédit et pour finir, un tableau multi-dimensionnel avec dans lequel se trouve le tableau d’amortissement. La longueur de ce dernier dépendra de fait de la durée en mois du crédit. </p>
        </div>
    </div>
        

<?php 
$content = ob_get_clean();

require('template.php');