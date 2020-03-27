<?php
namespace P5\Model;
class ManagementBDD {
    public $_bd;
    function __construct()
    {
        $this->_bd = $this->AccesBDD();
    }
    private function AccesBDD(){
        require('env.php');
        $bd = new \PDO('mysql:host='.$domaineBDD.';dbname='.$BDDName.';charset=utf8', ''.$username.'', ''.$password.'');
        try{
            $bd = new \PDO('mysql:host='.$domaineBDD.';dbname='.$BDDName.';charset=utf8', ''.$username.'', ''.$password.'');
        }catch (\Exception $e){
            throw new \Exception('Erreur de connexion à la BDD, merci de contacter l\'administrateur ou de vous reconnecter plus tard.');
        }
        return $bd;
    }

    public function date($table, $id){
        $date = $this->_bd->prepare('SELECT DAY(published_date) AS day, MONTH(published_date) AS month, YEAR(published_date) AS year FROM '.$table.' WHERE id = :id');
        $date->execute(array('id'=>$id));
        return $date;
    }
}