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
        <div id="conteneurForm" class="mt-5">

        </div>
        <div id="conteneurTab">
            
        </div>
    <?php
$content = ob_get_clean();



require('template.php');