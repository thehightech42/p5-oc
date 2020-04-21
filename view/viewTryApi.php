<?php
$titlePage = "Test de l'API";

ob_start();
?>
    <div class="mt-3">
    <h4>Calculer une mensualité :</h4>
        <form id="formApi">
            <div class="form-group">
                <label for="capital">Capital à emprunter :</label>
                <p><input type="number" class="form-control" id="capital" aria-describedby="emailHelp" placeholder="Entrer le capital à emprunter"><span> €</span></p>  
            </div>

            <div class="form-group">
                <label for="rate">Taux d'intérêt :</label>
                <p><input type="number" class="form-control" id="rate" placeholder="Entrer le taux d'intérêt" min="0.5" max="5" step="0.01"> <span> %</span></p>
            </div>

            <div class="form-group">
                <label for="duration">Durée </label>
                <select class="form-control" id="duration">
                <?php
                    for($i = 2; $i<= 30; $i++){
                        ?>
                            <option value="<?=$i?>"><?=$i?> ans</option>
                        <?php
                    }
                ?>
                </select>
                
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <div id="block-information" class="mt-4">
            <h4>Information sur le prêt :</h4>
            <p>La mensualité est de : <span id="mensualite">0</span> €</p> 
            <p>Le coût du crédit sera de : <span id="creditCost">0</span> €</p>
    </div>

    <div id="divFortab">
    
    </div>
<?php
$content = ob_get_clean();

ob_start();
?>
    <script src="js/ajax.js"></script>
    <script src="js/ControleApi.js"></script>
    <script>
        let apicredit = new ControleApi('formApi', 'divFortab');
    </script>

<?php
$script = ob_get_clean();

require('template.php');