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
    protected $id;
    private $nom;
    private $prenom;
    private $adresse;
    private $cp;
    private $ville;
    private $qualite;
    private $mail;
    private $mdp;
    private $mesSondages = array();
    
    function __construct($mail="", $mdp="",$id = "",$ip = "", $nom = "", $prenom ="", $adresse = "", $cp = "", $ville = "", $qualite = "") {
        parent::__construct($ip);
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
    
    public function getId() {
        return $this->id;
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
    
    public function ajouterMembre($cnx) {
        $requete = "INSERT INTO membre (ID_USER,NOM_USER,PRENOM_USER,ADRESSE_USER,CP_USER,VILLE_USER,MAIL_USER,MDP_USER,QUALITE,IP) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $cmd = $cnx->prepare($requete);
        $cmd->bindValue(1, $this->id, PDO::PARAM_INT);
        $cmd->bindValue(2, $this->nom, PDO::PARAM_STR);
        $cmd->bindValue(3, $this->prenom, PDO::PARAM_STR);
        $cmd->bindValue(4, $this->adresse, PDO::PARAM_STR);
        $cmd->bindValue(5, $this->cp, PDO::PARAM_STR);
        $cmd->bindValue(6, $this->ville, PDO::PARAM_STR);
        $cmd->bindValue(7, $this->mail, PDO::PARAM_STR);
        $cmd->bindValue(8, $this->mdp, PDO::PARAM_STR);
        $cmd->bindValue(9, $this->qualite, PDO::PARAM_STR);
        $cmd->bindValue(10, $_SERVER["REMOTE_ADDR"], PDO::PARAM_STR);
        if($cmd->execute())
            return true;
    }
    
    public function recupererMesSondages($cnx) {
        $tabSondage = array();
        $id = $this->id;
        $requeteMail = "SELECT ID_SONDAGE , NOM_SONDAGE , TYPE_SONDAGE , DATE_CLOTURE , ETAT_SONDAGE FROM sondage WHERE ID_USER = ? ORDER BY NOM_SONDAGE";
        $cmd = $cnx->prepare($requeteMail);
        $cmd->bindParam(1, $id ,PDO::PARAM_STR);
        $cmd->execute();
        
        if ($cmd->setFetchMode(PDO::FETCH_ASSOC)) {
            foreach ($cmd as $enr) {
                $sondage = new Sondage($enr['NOM_SONDAGE'],$enr['TYPE_SONDAGE'],$enr['ID_SONDAGE'],$enr['DATE_CLOTURE'],$enr['ETAT_SONDAGE']);
                array_push($tabSondage, $sondage);
            }
            return $tabSondage;
        }
        return false;
    }
}

?>
