<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CreerURLSondage
 *
 * @author Naïm Attoumane
 */
session_start();

require_once '../models/Connexion.php';
require_once '../models/Questions.php';
require_once '../models/User.php';

class CreerURLSondageController{
    //put your code here
    private $id;
    private $mesQuestions = array();
    private $cnx;
    private $nomFichier;
    
    function __construct($nomFichier) {
        $this->nomFichier = $nomFichier;
        $tampon = explode("_", $nomFichier);
        $this->id = $tampon[1]; 
        $this->cnx = Connexion::seConnecter("mysql", "localhost", "sondage", "root", ""); 
        $this->mesQuestions = $this->getQuestions();
    }
    
    private function getClotureSondage() {
        $requete = "SELECT STATUT FROM sondage WHERE `ID_SONDAGE` = ?";
        $cmd = $this->cnx->prepare($requete);
        $cmd->bindValue(1, $this->id, PDO::PARAM_INT);
        $cmd->execute();
        foreach($cmd as $enr) {
            $statut = $enr['STATUT'];
        }
        return $statut;
    }
    
    private function getTypeSondage() {
        $requete = "SELECT TYPE_SONDAGE FROM sondage WHERE `ID_SONDAGE` = ?";
        $cmd = $this->cnx->prepare($requete);
        $cmd->bindValue(1, $this->id, PDO::PARAM_INT);
        $cmd->execute();
        foreach($cmd as $enr) {
            $type = $enr['TYPE_SONDAGE'];
        }
        return $type;
    }
    
    public function genererSondage() {
        $str = "";
        if($this->getTypeSondage() == 1 && !isset($_SESSION['membre'])) {
            $str .= "Vous devez etre authentifie pour repondre a ce sondage";
        } else {
            if($this->getClotureSondage() == 4) {
                $str .= "SONDAGE CLOTURE";
            } else {
                $str .= "<form name='sondage' method='post' action='" . $this->nomFichier . ".php'>";
                $str .= "<table>";
                if (isset($_SESSION['membre'])) {
                    $str .= "<tr>";
                    $str .= "<td>Voulez-vous repondre anonynement ?</td>";
                    $str .= "<td><label>OUI</label><input type = 'radio' name = 'anonyme' value = '0'>";
                    $str .= "<label>NON</label><input type = 'radio' name = 'anonyme' value = '1' checked = 'checked'></td>";
                    $str .= "</tr>";
                }
                for ($i = 0; $i < COUNT($this->mesQuestions); $i++) {
                    $str .= "<tr>";
                    $str .= "<td><label>" . $this->mesQuestions[$i]->getLibelle() . "</label></td>";
                    if ($this->mesQuestions[$i]->getType() == 0) {
                        $str .= "<td><input type = 'text' name = 'reponse" . $i . "'></td>";
                    } else {
                        $str .= "<td><label>OUI</label><input type = 'radio' name = 'reponse" . $i . "' value = 'OUI' checked = 'checked'>";
                        $str .= "<label>NON</label><input type = 'radio' name = 'reponse" . $i . "' value = 'NON'></td>";
                    }
                    $str .= "</tr>";
                }
                $str .= "<tr>";
                $str .= "<td><input type = 'submit' name = 'valider' value = 'VALIDER'></td>";
                $str .= "</tr>";
                $str .= "</table>";
                $str .= "</form>";
            }
        }
        return $str;
    }
    
    public function verificationChamps() {
        for($i = 0; $i < COUNT($this->mesQuestions); $i++) {
            if($_POST['reponse'.$i] == "") {
                return false;
                break;
            }
        }
        return true;
    }
    
    public function validerSondage() {
        if(isset($_SESSION['membre'])) {
            if($_POST['anonyme'] == 0) {
                $idUser = null;
            } else {
                $idUser = $_SESSION['idMembre'];
            }
        } else {
            $user = new User($this->cnx,true,$_SERVER["REMOTE_ADDR"]);
            $user->ajouterUser();
            $idUser = $user->getId();
        }

        for($i = 0; $i < COUNT($this->mesQuestions); $i++) {
            $requete = "INSERT INTO reponse (ID_QUESTION,ID_USER,REPONSE) VALUES (?,?,?)";
            $cmd = $this->cnx->prepare($requete);
            $cmd->bindValue(1, $this->mesQuestions[$i]->getId(), PDO::PARAM_INT);
            $cmd->bindValue(2, $idUser, PDO::PARAM_INT);
            $cmd->bindValue(3, $_POST['reponse'.$i], PDO::PARAM_STR);
            $cmd->execute();
        }
    }
    
    private function getQuestions() { 
        $tabQuestions = array();
        $requete = "SELECT ID_QUESTION, LIBELLE_QUESTION , TYPE_SONDAGE FROM questions WHERE `ID_SONDAGE` = ?";
        $cmd = $this->cnx->prepare($requete);
        $cmd->bindValue(1, $this->id, PDO::PARAM_INT);
        $cmd->execute();
        foreach($cmd as $enr) {
            $question = new Questions($enr['ID_QUESTION'],$enr['LIBELLE_QUESTION'],$enr['TYPE_SONDAGE']);
            array_push($tabQuestions, $question);
        }
        return $tabQuestions;
    }

}

?>
