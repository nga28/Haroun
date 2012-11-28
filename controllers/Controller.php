<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author Naïm Attoumane
 */

//CONTROLLER PRINCIPAL
require_once 'models/Connexion.php';

class Controller {
    //put your code here
    //ATTRIBUTS DE LA CLASSE
    private $page;
    protected $cnx;
            
    function __construct($page) {
        $this->page = $page;
    }
    //INSTANCIATION DE LA CONNEXION EN PROTECTED POUR LES CLASSES HERITEES
    protected function getCnx() {
        return $this->cnx = Connexion::seConnecter("mysql", "localhost", "sondage", "root", "");
    }
    //RETOURNE LE CONTROLLER SPECIFIQUE
    public function getPageController() {
        require_once($this->page.".php");
        return new $this->page();
        
    }

 
}

?>
