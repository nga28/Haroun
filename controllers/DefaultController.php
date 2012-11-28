<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DefaultController
 *
 * @author Naïm Attoumane
 */
//CONTROLLER PAR DEFAUT

class DefaultController extends Controller{
    //put your code here
    function __construct() {
        
    }
    //AFFICHAGE DE LA PAGE ACCUEIL
    public function afficherPage() {
        include('views/accueil.php');
    }
}

?>
