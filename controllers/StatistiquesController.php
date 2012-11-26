<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StatistiquesController
 *
 * @author Naïm Attoumane
 */
require_once 'controllers/Controller.php';
require_once 'models/Sondage.php';
require_once 'models/Reponse.php';

class StatistiquesController extends Controller{
    //put your code here
    private $mesQuestions = array();
    protected $cnx;
    private $id;
    
    function __construct() {
        $this->id = $_POST['id'];
        $this->mesQuestions = Sondage::getQuestions(parent::getCnx(),  $this->id);
        $this->cnx = Connexion::seConnecter("mysql", "localhost", "sondage", "root", "");
    }           
    
    public function afficherPage() {
        include 'views/statistiques.php';
    }
    
    public function getMesQuestions() {
        return $this->mesQuestions;
    }
    public function getNbVotants($id) {
        
        $requete = "SELECT DISTINCT(COUNT(REPONSE)) AS 'nb' FROM questions , reponse , sondage WHERE questions.ID_QUESTION = reponse.ID_QUESTION AND sondage.ID_SONDAGE = questions.ID_SONDAGE AND sondage.ID_SONDAGE = 62 GROUP BY questions.ID_QUESTION";
        $cmd = $this->cnx->prepare($requete);
        $cmd->bindValue(1, $id, PDO::PARAM_INT);
        $cmd->execute();
        foreach($cmd as $enr) {
            $nbVotants = $enr['nb'];
        }
        return $nbVotants;
    }
    
    public function getReponses($id) {
        $tabReponses = array();
        $requete = "SELECT ID_REPONSE , REPONSE , COUNT(REPONSE) AS 'nb' FROM questions , reponse WHERE questions.ID_QUESTION = reponse.ID_QUESTION AND reponse.id_QUESTION = ? GROUP BY reponse";
        $cmd = $this->cnx->prepare($requete);
        $cmd->bindValue(1, $id, PDO::PARAM_INT);
        $cmd->execute();
        foreach($cmd as $enr) {
            $reponse = new Reponse($enr['ID_REPONSE'],$enr['REPONSE'],$enr['nb']);
            array_push($tabReponses, $reponse);
        }
        return $tabReponses;
    }
    
    
}

?>
