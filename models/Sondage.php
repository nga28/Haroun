<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sondage
 *
 * @author Naïm Attoumane
 */
require_once 'models/Membres.php';

class Sondage {
    //put your code here
    private $id;
    private $nom;
    private $type;
    private $dateCloture;
    private $etat;
    private $mesQuestions = array();
    
    function __construct($nom = "", $type = "" , $id = "" , $dateCloture = "", $etat ="") {
        $this->id = $id;
        $this->nom = $nom;
        $this->type = $type;
        $this->dateCloture = $dateCloture;
        $this->etat = $etat;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getNom() {
        return $this->nom;
    }

    public function getType() {
        return $this->type;
    }

    public function getDateCloture() {
        return $this->dateCloture;
    }

    public function getEtat() {
        return $this->etat;
    }

        
    public function validerSondage($cnx) {
        $membre = unserialize($_SESSION['membre']);
        $requete = "INSERT INTO sondage (ID_USER,TYPE_SONDAGE,NOM_SONDAGE) VALUES (?,?,?)";
        $cmd = $cnx->prepare($requete);
        $cmd->bindValue(1, $membre->getId(), PDO::PARAM_INT);
        $cmd->bindValue(2, $this->type, PDO::PARAM_STR);
        $cmd->bindValue(3, $this->nom, PDO::PARAM_STR);
        if($cmd->execute())
            return true;
    }
    
    public function supprimerSondage($cnx) {
        $requete = "DELETE FROM sondage WHERE ID_SONDAGE = ?";
        $cmd = $cnx->prepare($requete);
        $cmd->bindValue(1, $this->id, PDO::PARAM_INT);
        if($cmd->execute())
            return true;
    }
    
    public function publierSondage($cnx) {
        $requete = "UPDATE sondage SET ETAT_SONDAGE = 1 WHERE ID_SONDAGE = ?";
        $cmd = $cnx->prepare($requete);
        $cmd->bindValue(1, $this->id, PDO::PARAM_INT);
        if($cmd->execute())
            return true;
    }
    
    public function modifierSondage($cnx) {
        $requete = "UPDATE sondage SET ETAT_SONDAGE = 1 WHERE ID_SONDAGE = ?";
        $cmd = $cnx->prepare($requete);
        $cmd->bindValue(1, $this->id, PDO::PARAM_INT);
        if($cmd->execute())
            return true;
    }
    
    private function formaterDateMysql() {
        $tab = explode('.', date("m.d.Y"));
        return $tab[2]."-".$tab[0]."-".$tab[1];
    }

}

?>
