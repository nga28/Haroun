<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sujet
 *
 * @author Naïm Attoumane
 */
class Sujet {
    //put your code here
    private $libelle;
    private $id;
    
    function __construct($libelle = "", $id = "") {
        $this->libelle = $libelle;
        $this->id = $id;
    }
    
    public function getLibelle() {
        return $this->libelle;
    }

    public function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getSujet($cnx) {
        $tabSujet = array();
        $requete = "SELECT ID_SUJET, LIBELLE_SUJET FROM sujet";
        $cmd = $cnx->prepare($requete);
        $cmd->execute();
        foreach($cmd as $enr) {
            $sujet = new Sujet($enr['LIBELLE_SUJET'],$enr['ID_SUJET']);
            array_push($tabSujet, $sujet);
        }
        return $tabSujet;
        
    }
}

?>
