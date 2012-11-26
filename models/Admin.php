<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin
 *
 * @author Naïm Attoumane
 */
require_once 'models/Membres.php';

class Admin extends Membres{
    //put your code here
    private static $instance;
    
    function __construct($mail="", $mdp="",$id = "",$ip = "", $nom = "", $prenom ="", $adresse = "", $cp = "", $ville = "", $qualite = "") {
        
        if (!isset(self::$instance)) {
            self::$instance = parent::__construct($mail , $mdp , $id , $ip , $nom , $prenom , $adresse , $cp , $ville , $qualite);
        }
        
        return self::$instance;
    }
    
    public function administrationSondages($cnx) {
        $tabSondage = array();
        $id = $this->id;
        $requeteMail = "SELECT ID_SONDAGE , NOM_SONDAGE , TYPE_SONDAGE , DATE_CLOTURE , ETAT_SONDAGE , URL , STATUT FROM sondage ORDER BY NOM_SONDAGE";
        $cmd = $cnx->prepare($requeteMail);
        $cmd->execute();
        
        if ($cmd->setFetchMode(PDO::FETCH_ASSOC)) {
            foreach ($cmd as $enr) {
                $sondage = new Sondage($enr['NOM_SONDAGE'],$enr['TYPE_SONDAGE'],$enr['ID_SONDAGE'],$enr['DATE_CLOTURE'],$enr['ETAT_SONDAGE'],$enr['URL'],$enr['STATUT']);
                array_push($tabSondage, $sondage);
            }
            return $tabSondage;
        }
        return false;
    }
    
    private function formaterDateMysql() {
        $tab = explode('.', date("m.d.Y"));
        return $tab[2]."-".$tab[0]."-".$tab[1];
    }
    
    public function cloturerSondage($cnx , $id) {
        $date = $this->formaterDateMysql();
        $requete = "UPDATE sondage SET DATE_CLOTURE = ? , STATUT = ? WHERE ID_SONDAGE = ?";
        $cmd = $cnx->prepare($requete);
        $cmd->bindValue(1, $date, PDO::PARAM_STR);
        $cmd->bindValue(2, 4, PDO::PARAM_INT);
        $cmd->bindValue(3, $id, PDO::PARAM_INT);
        if($cmd->execute())
            return true;
        
    }
    
    public function supprimerSondage($cnx,$id) {
        $requete = "DELETE FROM sondage WHERE ID_SONDAGE = ?";
        $cmd = $cnx->prepare($requete);
        $cmd->bindValue(1, $id, PDO::PARAM_INT);
        if($cmd->execute())
            return true;
    }
    
    public function autoriserModificationSondage($cnx,$id) {
        $requete = "UPDATE sondage SET STATUT = ? WHERE ID_SONDAGE = ?";
        $cmd = $cnx->prepare($requete);
        $cmd->bindValue(1, 2, PDO::PARAM_INT);
        $cmd->bindValue(2, $id, PDO::PARAM_INT);
        if($cmd->execute())
            return true;
    }
    
    public function refuserModificationSondage($cnx,$id) {
        $requete = "UPDATE sondage SET STATUT = ? WHERE ID_SONDAGE = ?";
        $cmd = $cnx->prepare($requete);
        $cmd->bindValue(1, 3, PDO::PARAM_INT);
        $cmd->bindValue(2, $id, PDO::PARAM_INT);
        if($cmd->execute())
            return true;
    }
}

?>
