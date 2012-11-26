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
    
    public function afficherFormulaire() {
        include 'views/questions.php';
    }
    public function getQuestionsFromBD() {
        $str = "";
        $str .= "<table border = '1' id = 'myTable'><tr><th>LIBELLE</th><th>TYPE</th><th>ACTIONS</th></tr>";
        for($i = 0; $i < COUNT($this->mesQuestions); $i++) {
            $str .= "<tr id = 'ligne'>";
            $str .= "<td>".$this->mesQuestions[$i]->getLibelle()."</td>";
            if($this->mesQuestions[$i]->getType() == 0) {
                $str .= "<td>OUVERTE</td>";
            } else {
                $str .= "<td>FERMEE</td>";
            }
            $str .= "<td><input type='button' id = 'suppr' value='SUPPRIMER' name='supprimer' onclick ='supprimerQuestion(".$i.");'/></td>";
            $str .= "</tr>";
        }
        $str .= "</table>";
        return $str;
        
        
    }
     
    
}

?>
