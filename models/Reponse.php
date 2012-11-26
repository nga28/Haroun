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
    
    function __construct($id = "", $libelle = "", $nb = "") {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->nb = $nb;
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



}

?>
