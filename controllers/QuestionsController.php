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

class QuestionsController extends Controller {
    //put your code here
    protected $mesQuestions = array();
            
    function __construct() {
        $this->mesQuestions = Sondage::getQuestions(parent::getCnx(),$_SESSION['id']);
        if(isset($_REQUEST['action'])) {
            if($_REQUEST['action'] == 'suppr') {
                $this->mesQuestions[$_REQUEST['id']]->supprimerQuestion(parent::getCnx());
            }
        }
    }
    //AFFICHAGE DU FORMULAIRE DE QUESTIONS
    public function afficherFormulaire() {
        include 'views/questions.php';
    }
    
    //RECUPERATION DES QUESTIONS DE LA BDD
    public function getQuestionsFromBD() {
        $str = "";
        $str .= "<center>";
        $str .= "<table border = '1' id='hor-minimalist-b'><thead><tr><th scope='col'>Libelle</th><th scope='col'>Type</th><th scope='col'>Actions</th></tr></thead>";
        $str .= "<tbody>";
        for($i = 0; $i < COUNT($this->mesQuestions); $i++) {
            $str .= "<tr id = 'ligne'>";
            $str .= "<td>".$this->mesQuestions[$i]->getLibelle()."</td>";
            if($this->mesQuestions[$i]->getType() == 0) {
                $str .= "<td>OUVERTE</td>";
            } else if ($this->mesQuestions[$i]->getType() == 1){
                $str .= "<td>FERMEE</td>";
            } else {
                $str .= "<td>NUMERIQUE</td>";
            }
            $str .= "<td><input type='button' id = 'suppr' value='SUPPRIMER' name='supprimer' onclick ='supprimerQuestion(".$i.");'/></td>";
            $str .= "</tr>";
        }
        $str .= "</tbody>";
        $str .= "</table>";
        $str .= "</center>";
        return $str;
        
        
    }
     
    
}

?>
