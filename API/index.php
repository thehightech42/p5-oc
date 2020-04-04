<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$arrayJson = [];
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