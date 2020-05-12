<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

if(isset($_GET['key'])){
    $connexionBDD = tryIdentityClient($_GET['key']);
    $arrayJson = [];

    if(is_string($connexionBDD)){
        contentJson(false, $connexionBDD);
    }
    elseif($connexionBDD === false){
        contentJson(false, "Merci de vous créer un compte pour utiliser l'API.");
    }
    else{

        if(isset($_GET['capital']) && isset($_GET['rate']) && isset($_GET['duration']) ){
            $durationMonth = $_GET['duration'] * 12; 
            $rate = $_GET['rate']/100;
            $mensualite = ($_GET['capital'] * ($rate/12)) / (1 - pow( (1+($rate/12)), -$durationMonth ));
            $capitalStay = intval($_GET['capital']); 
        
            $resultat = []; 
            $resultat['mensualite'] = round($mensualite, 2); 
            $resultat['creditCost'] = round(($mensualite*$durationMonth) - $_GET['capital'], 2);
            $resultat['table'] = amortizationTable($mensualite);
        
            contentJson(true, "Tous les informations sont conformes", $resultat);
        
        }else{
            $resultat =  [];
            $resultat['capital'] = isset($_GET['capital']); 
            $resultat['rate'] = isset($_GET['rate']);
            $resultat['duration'] = isset($_GET['duration']);
            
        
            contentJson(false, "Il manque des données", $resultat);
        }

    }
}else{
    contentJson(false, "Merci d'ajouter une clé dans à votre requette. Pour en avoir une crée vous un compte sur https://p5.antoninpfistner.fr");
}




function contentJson(bool $success, string $msg, array $resultat = null){
    $arrayJson["success"] = $success;
    $arrayJson['message'] = $msg; 
    if($resultat !== null){
        $arrayJson['resultat'] = $resultat; 
    }

    echo json_encode($arrayJson);
}

function amortizationTable($mensualite){
    $capitalStay = intval($_GET['capital']); 
    $rate = $_GET['rate']/100;
    $durationMonth = $_GET['duration']*12;
    $mens = $mensualite;

    $table = [];
    array_push($table, ["Echéance", "Capital", "Mensualité", "Intérêt", "Part Du Capital", "Capital restant du"]); 
    for($i = 1; $i <= $durationMonth; $i++){
        $ligne = [];
        array_push($ligne, $i, $capitalStay, $mens);

        $interest = $capitalStay * ($rate/12);
        $capitalPart = ($mens - $interest);
        $capitalStay = $capitalStay - $capitalPart;
        
        array_push($ligne, $interest, $capitalPart, $capitalStay); 
        $table[$i] = $ligne;
        array_push($table, $table[$i]);
    }

    return $table;
}

function tryIdentityClient(string $key){
    try{
        require('envAPI.php');
        $bd = new \PDO('mysql:host='.$domaineBDD.';dbname='.$BDDName.';charset=utf8', ''.$username.'', ''.$password.'');
    }catch (\Exception $e){
        return ('Erreur de connexion à la BDD, merci de contacter l\'administrateur ou de vous reconnecter plus tard.');
    }
    $controlKey = $bd->prepare('SELECT * FROM users WHERE key_api = :key_api');
        $result = $controlKey->execute(array("key_api" => $key));
        if($controlKey->rowcount() === 1){
            // var_dump($controlKey);
            return true;
        }else{
            return false;
        }
}