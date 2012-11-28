<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reponse
 *
 * @author Naïm Attoumane
 */
class Reponse {
    //put your code here
    private $id;
    private $libelle;
    private $nb;
    private $libelleQuestion;
    
    function __construct($id = "", $libelle = "", $nb = "" , $libelleQuestion = "") {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->nb = $nb;
        $this->libelleQuestion = $libelleQuestion;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    public function getNb() {
        return $this->nb;
    }

    public function getLibelleQuestion() {
        return $this->libelleQuestion;
    }



}

?>
