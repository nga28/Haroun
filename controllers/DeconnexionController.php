<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DeconnexionController
 *
 * @author Naïm Attoumane
 */
require_once 'models/Membres.php';
//CONTROLLER DECONNEXION
class DeconnexionController extends Controller{
    //put your code here
    function __construct() {
        
    }
    //FONCTION DECONNEXION
    public function getDeconnexion() {
        Membres::deconnexion();
        header('Location: index.php?page=Default');
    }
}

?>
