<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SondageController
 *
 * @author Naïm Attoumane
 */
require_once 'models/Sondage.php';

class SondageController extends Controller {
    //put your code here
    
    function __construct() {
        
    }
    
    public function creerSondage() {
        include('views/sondage.php');
    }
    
    public function verificationChamps() {
        if(isset($_POST['valider'])) {
            if(empty($_POST['nom'])) {
                return 0;
            } else {
                return 1;
            }
        }
        return -1;
    }
    
    public function enregistrerSondage() {
        $sondage = new Sondage($_POST['nom'],$_POST['type']);
        $sondage->validerSondage(parent::getCnx());
    }
            

}

?>
