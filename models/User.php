<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Naïm Attoumane
 */
class User {
    //put your code here
    protected $ip;
    protected $id;
    protected $cnx;
    
    function __construct($cnx, $verif = false, $ip = "") {
        $this->ip = $ip;
        $this->cnx = $cnx;
        if($verif == true)
            $this->id = $this->getNewID();
    }
    
    public function getIp() {
        return $this->ip;
    }

    public function getId() {
        return $this->id;
    }
    
    public function getCnx() {
        return $this->cnx;
    }

            
    public function getNewID() {
        $requeteMail = "SELECT MAX(ID_USER) AS 'max' FROM USER";
        $cmd = $this->cnx->prepare($requeteMail);
        $cmd->execute();
        if($cmd->setFetchMode(PDO::FETCH_ASSOC)){
               foreach($cmd as $enr) {
                  $enr['max'] === $enr['max']++;
               }             
        }
        return $enr['max'];
    }
    
    public function ajouterUser() {
        $requete = "INSERT INTO user (ID_USER,IP) VALUES (?,?)";
        $cmd = $this->cnx->prepare($requete);
        $cmd->bindValue(1, $this->id, PDO::PARAM_INT);
        $cmd->bindValue(2, $this->ip, PDO::PARAM_STR);
        if($cmd->execute())
            return true;
    }

}

?>
