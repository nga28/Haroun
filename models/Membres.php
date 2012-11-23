<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Membres
 *
 * @author Naïm Attoumane
 */
require_once("models/Connexion.php");
require_once("models/User.php");

class Membres extends User{
    //put your code here
    private $nom;
    private $prenom;
    private $adresse;
    private $cp;
    private $ville;
    private $qualite;
    private $mail;
    private $mdp;
    
    function __construct($mail="", $mdp="",$cnx = "",$id = "",$ip = "", $nom = "", $prenom ="", $adresse = "", $cp = "", $ville = "", $qualite = "") {
        parent::__construct($cnx,$ip);
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse = $adresse;
        $this->cp = $cp;
        $this->ville = $ville;
        $this->qualite = $qualite;
        $this->mail = $mail;
        $this->mdp = $mdp;
    }
    
    public function getQualite() {
        return $this->qualite;
    }

    public function authentification($cnx) {
        $requeteMail = "SELECT * FROM MEMBRE WHERE MAIL_USER = ? AND MDP_USER= ?";
        $cmd = $cnx->prepare($requeteMail);
        $cmd->bindParam(1, $this->mail, PDO::PARAM_STR);
        $cmd->bindParam(2, $this->mdp, PDO::PARAM_STR);
        $cmd->execute();
        if($cmd->setFetchMode(PDO::FETCH_ASSOC)){
               foreach($cmd as $enr) {
                   return $enr;
               }        
        }
        return false;
    }
    
    public static function deconnexion() {
        session_destroy();
    }
    
    public function ajouterMembre() {
        $requete = "INSERT INTO membre (ID_USER,IP) VALUES (?,?)";
        $cmd = $this->cnx->prepare($requete);
        $cmd->bindValue(1, $this->getNewID(), PDO::PARAM_INT);
        $cmd->bindValue(2, $this->ip, PDO::PARAM_STR);
        if($cmd->execute())
            return true;
    }

}

?>
