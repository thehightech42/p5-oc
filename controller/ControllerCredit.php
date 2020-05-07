<?php
namespace P5\Controller;

class ControllerCredit{
    public function amortizationTable(){
        require('view/viewAmortizationTable.php');
    }

    public function testAPI(){
        require('view/viewTryApi.php'); 
    }

    public function documentation(){
        require('view/viewDocumentation.php');
    }

}