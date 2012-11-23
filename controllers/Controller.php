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
require_once 'models/Connexion.php';

class Controller {
    //put your code here
    private $page;
    protected $cnx;
            
    function __construct($page) {
        $this->page = $page;
    }
    
    protected function getCnx() {
        return $this->cnx = Connexion::seConnecter("mysql", "localhost", "sondage", "root", "");
    }
    public function getPageController() {
        require_once($this->page.".php");
        return new $this->page();
        
    }

 
}

?>
