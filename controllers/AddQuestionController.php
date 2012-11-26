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
require_once 'controllers/Controller.php';
require_once 'models/Sondage.php';
require_once 'models/Connexion.php';

class AddQuestionController extends Controller {
    //put your code here
            
    function __construct() {
        $question = new Questions($_SESSION['id'],$_REQUEST['q']['libelle'],$_REQUEST['q']['type']);
        $question->ajouterQuestions(Connexion::seConnecter("mysql", "localhost", "sondage", "root", ""));
    }
   
}

?>
