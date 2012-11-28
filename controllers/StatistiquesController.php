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
    private $nomFichier;
    
    function __construct() {
        $this->id = $_POST['id'];
        $this->cnx = parent::getCnx();
        $this->mesQuestions = Sondage::getQuestions($this->cnx,  $this->id);
        $this->nomFichier = "statistiques_sondage_".$this->id.".csv";
    }     
    
    //AFFICHAGE DU TABLEAU DE STATS
    public function afficherPage() {
        include 'views/statistiques.php';
        return "<center><a href ='csv/".$this->nomFichier."'><button class = 'rounded gkbutton'>EXPORTER CSV</button></a></center>";
    }
    
    //RETOURNE LES QUESTIONS DU SONDAGE 
    public function getMesQuestions() {
        return $this->mesQuestions;
    }
    
    //RETOURNE LE NB DE VOTANTS
    public function getNbVotants() {
        
        $requete = "SELECT DISTINCT(COUNT(REPONSE)) AS 'nb' FROM questions , reponse , sondage WHERE questions.ID_QUESTION = reponse.ID_QUESTION AND sondage.ID_SONDAGE = questions.ID_SONDAGE AND sondage.ID_SONDAGE = ? GROUP BY questions.ID_QUESTION";
        $cmd = $this->cnx->prepare($requete);
        $cmd->bindValue(1, $this->id, PDO::PARAM_INT);
        $cmd->execute();
        foreach($cmd as $enr) {
            $nbVotants = $enr['nb'];
        }
        return $nbVotants;
    }
    //RETOURNE LES REPONSES DE LA QUESTION
    public function getReponses($id) {
        $tabReponses = array();
        $requete = "SELECT LIBELLE_QUESTION , ID_REPONSE , REPONSE , COUNT(REPONSE) AS 'nb' FROM questions , reponse WHERE questions.ID_QUESTION = reponse.ID_QUESTION AND reponse.id_QUESTION = ? GROUP BY reponse ORDER BY REPONSE";
        $cmd = $this->cnx->prepare($requete);
        $cmd->bindValue(1, $id, PDO::PARAM_INT);
        $cmd->execute();
        foreach($cmd as $enr) {
            $reponse = new Reponse($enr['ID_REPONSE'],$enr['REPONSE'],$enr['nb'],$enr['LIBELLE_QUESTION']);
            array_push($tabReponses, $reponse);
        }
        return $tabReponses;
    }
    //CREER FICHIER CSV DE STATS
    public function creerCSV($donnees) {
        $leFichier = fopen("./csv/".$this->nomFichier, "wb");
        fclose($leFichier);
        $fp = fopen("./csv/".$this->nomFichier,"w"); // ouverture du fichier en écriture
        foreach ($donnees as $fields) {
            fputcsv($fp, $fields , ";");
        }
        fclose($fp);
    }
}

?>
