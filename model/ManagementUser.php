<?php
namespace P5\Model;
require_once('ManagementBDD.php');

class ManagementUser extends ManagementBDD{
    public function tryPseudo($pseudo){
        $reqPseudo = $this->_bd->prepare('SELECT pseudo FROM users WHERE pseudo = :pseudo');
        $reqPseudo->execute(array('pseudo'=> $pseudo));
        return $reqPseudo;

    }
    public function tryMail($mail){
        $reqMail = $this->_bd->prepare('SELECT mail FROM users WHERE mail = :mail');
        $reqMail->execute(array('mail'=> $mail));
        return $reqMail;
    }
    public function takeLoginInformation($pseudo){
        $reqPass = $this->_bd->prepare('SELECT * FROM users WHERE pseudo = :pseudo');
        $reqPass->execute(array('pseudo'=> $pseudo));
        return $reqPass;
    }
    public function registerUser($first_name, $last_name, $pseudo, $mail, $pass_hash, $key){
        $registerUser = $this->_bd->prepare('INSERT INTO users(pseudo, mail, admin, pass_hash, first_name, last_name, registration_date, key_api) VALUES( :pseudo, :mail, :admin, :pass_hash, :first_name, :last_name, :registration_date, :key_api)');
        $registerUser->execute(array(
           'pseudo' => $pseudo,
           'mail' => $mail,
           'admin' => 0,
           'pass_hash' => $pass_hash,
           'first_name' => $first_name,
           'last_name' => $last_name,
           'registration_date' => date('Y-m-d H:i:s'),
           'key_api' => $key
        ));
        return $registerUser;
    }
    public function takeInformationWithId($id){
        $userInfo = $this->_bd->prepare('SELECT * FROM users WHERE id = :id');
        $userInfo->execute(array('id'=> $id));
        return $userInfo;
    }
    public function updateAllUserInformation($first_name, $last_name, $pseudo, $mail){
        $updateUser = $this->_bd->prepare('UPDATE users SET first_name= :first_name, last_name= :last_name, pseudo= :pseudo, mail= :mail WHERE id = :id');
        $updateUser->execute(array(
            'first_name'=> $first_name,
            'last_name'=> $last_name,
            'pseudo'=> $pseudo,
            'mail'=> $mail,
            'id'=> $_SESSION['idUser']
        ));
    }
    public function updateNamesUser($first_name, $last_name){
        $updateName = $this->_bd->prepare('UPDATE users SET first_name= :first_name, last_name= :last_name WHERE id= :id');
        $updateName->execute(array(
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'id'=>$_SESSION['idUser']
        ));
    }
    public function updatePassword($pass_hash){
        $newPassword = $this->_bd->prepare('UPDATE users SET pass_hash = :pass_hash WHERE id = :id');
        $newPassword->execute(array(
            'pass_hash'=>$pass_hash,
            'id'=>$_SESSION['idUser']
        ));
    }

    public function newKey($key){
        $newKey = $this->_bd->prepare('UPDATE users SET key_api = :key_api WHERE id = :id');
        $newKey->execute(array(
            'key_api'=>$key,
            'id'=>$_SESSION['idUser']
        ));
    }
}