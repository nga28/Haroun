<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QuestionsController
 *
 * @author Naïm Attoumane
 */
require_once 'models/Questions.php';
require_once 'models/Connexion.php';

class QuestionsController {
    //put your code here
    function __construct() {
       
    }
    
    public function afficherFormulaire() {
        include 'views/questions.php';
    }
    
    public function sendQuestions($tab) {
        for($i = 0; $i < count($tab); $i++) {
            $question = new Questions($_SESSION['id'], $tab[$i]['libelle'], $tab[$i]['type']);
            $question->ajouterQuestions(Connexion::seConnecter("mysql", "localhost", "sondage", "root", ""));
        }
    }
    
}

?>
