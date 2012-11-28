<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AddQuestionController
 *
 * @author Naïm Attoumane
 */
//CONTROLLER QUI INSTANCIE UNE QUESTION POUR ETRE AJOUTEE EN BDD
require_once 'controllers/Controller.php';
require_once 'models/Sondage.php';
require_once 'models/Connexion.php';

class AddQuestionController extends Controller {
    //put your code here
            
    function __construct() {
        $question = new Questions($_SESSION['id'],$_REQUEST['libelle'],$_REQUEST['type']);
        $question->ajouterQuestions(Connexion::seConnecter("mysql", "localhost", "sondage", "root", ""));
    }
   
}

?>
