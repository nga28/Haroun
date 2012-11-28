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
//CONTROLLER QUI CREER LE SONDAGE SELON L'URL DU SONDAGE 
class CreerURLSondageController{
    //put your code here
    private $id;
    private $mesQuestions = array();
    private $cnx;
    private $nomFichier;
    
    function __construct($nomFichier) {
        $this->nomFichier = $nomFichier;
        $tampon = explode("_", $nomFichier);
        //ID DU SONDAGE EN SEPARANT A PARTIR DU _
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
    //FONCTION QUI GENERE LE SONDAGE 
    public function genererSondage() {
        $str = "";
        //SI LE MEMBRE A CHOISI QU'IL FAUT ETRE AUTHENTIFIE POUR REPONDRE AU SONDAGE 
        if($this->getTypeSondage() == 1 && !isset($_SESSION['membre'])) {
            $str .= "Vous devez etre authentifie pour repondre a ce sondage";
        } else {
            if($this->getClotureSondage() == 4) {
                $str .= "SONDAGE CLOTURE";
            } else {
                $str .= "<form id='formID' class='formular' method='post' action='" . $this->nomFichier . ".php'>";
                $numQuestion = 0;
                for ($i = 0; $i < COUNT($this->mesQuestions); $i++) {
                    $numQuestion++;
                    $str .= "<fieldset>";
                    $str .= "<legend>QUESTION " . $numQuestion . "</legend>";
                    $str .= "<label>";
                    $str .= "<span style = 'font-weight:bold';margin-top:10px>" . $this->mesQuestions[$i]->getLibelle() . "</span>";
                    if ($this->mesQuestions[$i]->getType() == 0) {
                        $str .= "<input class='validate[required] text-input' type='text' name='reponse".$i."' id='nom'  />";
                    } else if($this->mesQuestions[$i]->getType() == 2) {
                        $str .= "<input class='validate[required,custom[onlyNumber]] text-input' type='text' name='reponse".$i."'/>";
                    } else {
                        $str .= "<table style='font-size:12px;margin-top:10px'>
                                    <tr>
                                        <td>OUI <input type='radio' name='reponse".$i."' value='OUI' checked='checked'/></td>
                                    </tr>   
                                    <tr>    
                                        <td>NON <input type='radio' name='reponse".$i."' value='NON'/></td>
                                    </tr>
                                </table>";
                    }
                    $str .= "<label>";
                    $str .= "</fieldset>";
                }
                $str .= "<fieldset>";
                $str .= "<legend>Valider formulaire</legend>";
                $str .= "<input class='rounded gkbutton' type = 'submit' name = 'valider' value = 'VALIDER'>";
                $str .= "</fieldset>";
                $str .= "</form>";
                
            }
        }
        return $str;
    }
    //VERIFICATION SUR TOUS LES CHAMPS DU SONDAGE
    public function verificationChamps() {
        for($i = 0; $i < COUNT($this->mesQuestions); $i++) {
            if($_POST['reponse'.$i] == "") {
                return false;
                break;
            }
        }
        return true;
    }
    
    //VALIDATION DU SONDAGE
    public function validerSondage() {
        if(isset($_SESSION['membre'])) {
            $idUser = $_SESSION['idMembre'];
        } else {
            $user = new User($this->cnx,true,$_SERVER["REMOTE_ADDR"]);
            $user->ajouterUser();
            $idUser = $user->getId();
        }
        
        //BOUCLE SUR LE TABLEAU DE QUESTIONS
        for($i = 0; $i < COUNT($this->mesQuestions); $i++) {
            $requete = "INSERT INTO reponse (ID_QUESTION,ID_USER,REPONSE) VALUES (?,?,?)";
            $cmd = $this->cnx->prepare($requete);
            $cmd->bindValue(1, $this->mesQuestions[$i]->getId(), PDO::PARAM_INT);
            $cmd->bindValue(2, $idUser, PDO::PARAM_INT);
            $cmd->bindValue(3, $_POST['reponse'.$i], PDO::PARAM_STR);
            $cmd->execute();
        }
    }
    //RETOURNE LE TABLEAU DE QUESTIONS DU SONDAGE
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
