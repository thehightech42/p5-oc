<?php
$titlePage = "Tableau d'ammortissement";

ob_start();
    ?>
        <script src="js/AmortizationTable.js"></script>
        <script>let amortizationTab = new AmortizationTable('conteneurForm', 'conteneurTab');</script>
    <?php
$script = ob_get_clean();



ob_start();
    ?>
    <div class="row">
        <div class="col-lg-12">
            <h3>L'API en JS</h3>
            <p class="text-justify">Avant de créer l'API, j'ai commencé par créer une class JavaScript, me permettant de calculer la mensualité d'un prêt, son coût ainsi que le tableau d'ammortissement lié. </p>
            <p class="text-justify">La totalité est contrôlé et généré en JavaScript. Cette class, à vocation à être amélioré dans le temps. Soit en ajout de fonctionnalités, en refactorisation ou en séparant en class multiple afin de facilité la lecture.</p>
            <p class="text-justify">Vous pouvez télécharger le fichier en cliquant juste en dessous. </p>
            <p class="text-justify"> <a class="button" href="/js/AmortizationTable.js" download>Télécharger le code ICI !</a></p>
        </div>
    </div>
        <div id="conteneurForm" class="mt-5">

        </div>
        <div id="conteneurTab">
            
        </div>
    <?php
$content = ob_get_clean();



require('template.php');