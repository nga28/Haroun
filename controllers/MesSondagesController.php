<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MesSondagesController
 *
 * @author Naïm Attoumane
 */
require_once 'models/Sondage.php';
require_once 'controllers/Controller.php';
require_once 'controllers/AddQuestionController.php';

class MesSondagesController extends Controller{
    //put your code here
    function __construct() {
        
    }
    //GENERATION DU TABLEAU DE SONDAGES DU MEMBRE
    public function getMesSondages() {
        $membre = unserialize($_SESSION['membre']);
        $tab = $membre->recupererMesSondages(parent::getCnx());
        $str = "";
        $str .= "<center>";
        $str .= "<table border = '1' id = 'hor-minimalist-b'><thead><tr><th scope='col'>Libelle</th><th scope='col' width ='150'>Type</th><th scope='col' width ='150'>Date cloture</th><th scope='col' width ='150'>Publication</th><th scope='col' width ='150'>URL</th><th scope='col' width ='150'>Etat</th><th scope='col' width ='150'>Actions</th></tr></thead>";
        for($i = 0; $i < COUNT($tab); $i++) {
            $str .= "<tr>";
            $str .= "<td>".$tab[$i]->getNom()."</td>";
            if($tab[$i]->getType() == 0) {
                $str .= "<td>PUBLIC</td>";
            } else {
                $str .= "<td>PRIVE</td>";
            }
            if($tab[$i]->getDateCloture() != "")
                $str .= "<td>".$this->formaterDate ($tab[$i]->getDateCloture())."</td>";
            else 
                $str .= "<td></td>";
            if($tab[$i]->getEtat() == 0) {
                $str .= "<td>PAS PUBLIE</td>";
            } else {
                $str .= "<td>PUBLIE</td>";
            }
            $str .= "<td><a href = ".$tab[$i]->getUrl().">".$tab[$i]->getUrl()."</a></td>";
            switch($tab[$i]->getStatut()) {
                case 0 :
                    $disabled = "";
                    $str .= "<td></td>";
                    break;
                case 1 :
                    $disabled = "disabled";
                    $str .= "<td>Demande de modification envoyee a l'administrateur</td>";
                    break;
                case 2 :
                    $disabled = "";
                    $str .= "<td>Modification autorisee par l'administrateur</td>";
                    break;
                case 3 :
                    $disabled = "disabled";
                    $str .= "<td>Modification refusee par l'administrateur</td>";
                    break;
                case 4 :
                    $disabled = "disabled";
                    $str .= "<td>Cloturee</td>";
                    break;
            }
            if($tab[$i]->getDateCloture() != "") {
                $str .= "<td><form method='POST' action = 'index.php?page=Statistiques'><input type = 'hidden' name = 'id' value = '".$tab[$i]->getId()."'><input type='submit' value='STATISTIQUES' name='stats' class ='rounded gkbutton'/></td></form>";
            } else {
                if($tab[$i]->getEtat() == 0) 
                    $str .= "<td><form method='POST'><input type = 'hidden' name = 'id' value = '".$i."'><input type='submit' value='SUPPRIMER' name='supprimer' class ='rounded gkbutton'/><input type='submit' value='PUBLIER' name='publier' class ='rounded gkbutton'/><input type='submit' value='MODIFIER' name='modifier' class ='rounded gkbutton'/></td></form>";
                else
                    $str .= "<td><form method='POST'><input type = 'hidden' name = 'id' value = '".$i."'><input type='submit' value='SUPPRIMER' name='supprimer' class ='rounded gkbutton'/><input type='submit' value='MODIFIER' name='modifier' class ='rounded gkbutton' ".$disabled."></td></form>";
            }
                
            $str .= "</tr>";
        }
        $str .= "</center>";
        $str .= "</table>";
        if(isset($_POST['supprimer'])) {
            if($tab[$_POST['id']]->getNombreQuestions(parent::getCnx()) == 0) {
                if($tab[$_POST['id']]->supprimerSondage(parent::getCnx()))
                    header('Location: index.php?page=MesSondages');
            } else {
                $str .= "Ce sondage ne peut pas etre supprime";
            }
        }
        //ACTION DE L'UTILISATEUR SUR LE SONDAGE
        if(isset($_POST['publier'])) {

            if($tab[$_POST['id']]->getNombreQuestions(parent::getCnx()) <= 4) {
                $str .= "Vous devez ajouter au moins 5 questions";
            } else {
                if($tab[$_POST['id']]->publierSondage(parent::getCnx())) {
                    header('Location: index.php?page=MesSondages');
                }
            }
        }
        
        if(isset($_POST['modifier'])) {
            switch($tab[$_POST['id']]->getStatut()) {
                case 0 : 
                    if($tab[$_POST['id']]->getEtat() == 0) {
                        $_SESSION['id'] = $tab[$_POST['id']]->getId();
                        header('Location: index.php?page=Questions');
                    } else {
                        $tab[$_POST['id']]->demanderModification(parent::getCnx());
                        header('Location: index.php?page=MesSondages');
                    }
                    break;
                case 1 :
                    break;
                case 2 :
                    $_SESSION['id'] = $tab[$_POST['id']]->getId();
                    $tab[$_POST['id']]->modifierSondage(parent::getCnx());
                    header('Location: index.php?page=Questions');
                    break;
                case 3 :
                    break;
            }

        }
                
        return $str;
    }
    
    private function formaterDate($date) {
        $tab = explode('-', $date);
        return $tab[2]."/".$tab[1]."/".$tab[0];
    }
   
}

?>
