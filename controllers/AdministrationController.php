<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdministrationController
 *
 * @author Naïm Attoumane
 */
require_once 'models/Admin.php';
require_once 'models/Sondage.php';
require_once 'controllers/Controller.php';

//CONTROLLER DE L'ADMIN
class AdministrationController extends Controller{
    //put your code here
    function __construct() {
        
    }
    //FONCTION QUI RECUPERE TOUS LES SONDAGES DE LA BDD ET GENERE LE TABLEAU
    public function getSondages() {
        $membre = unserialize($_SESSION['membre']);
        $tab = $membre->administrationSondages(parent::getCnx());
        $str = "";
        $str .= "<center>";
        $str .= "<table border = '1' id = 'hor-minimalist-b'><thead><tr><th scope='col'>Libelle</th><th scope='col' width ='150'>Type</th><th scope='col'>Date cloture</th><th scope='col' width ='150'>Publication</th><th scope='col' width ='150'>URL</th><th scope='col' width ='150'>Actions</th>";
        for($i = 0; $i < COUNT($tab); $i++) {
            $bgcolor = "";
            //SI MEMBRE DEMANDE UNE MODIFICATION
            if($tab[$i]->getStatut() == 1) {
                $bgcolor = "bgcolor = 'red'";
            } else if($tab[$i]->getStatut() == 2) {
                $bgcolor = "bgcolor = 'green'";
            }
            $str .= "<tr ".$bgcolor.">";
            $str .= "<td>".$tab[$i]->getNom()."</td>";
            if($tab[$i]->getType() == 0) {
                $str .= "<td>PUBLIC</td>";
            } else {
                $str .= "<td>PRIVE</td>";
            }
            if($tab[$i]->getDateCloture())
                $str .= "<td>".  $this->formaterDate($tab[$i]->getDateCloture())."</td>";
            else
                $str .= "<td></td>";
            if($tab[$i]->getEtat() == 0) {
                $str .= "<td>PAS PUBLIE</td>";
            } else {
                $str .= "<td>PUBLIE</td>";
            }
            $str .= "<td><a href = ".$tab[$i]->getUrl().">".$tab[$i]->getUrl()."</a></td>";
            if($tab[$i]->getStatut() == 1)
                $str .= "<td><form method='POST'><input type = 'hidden' name = 'id' value = '".$i."'><input type='submit' value='SUPPRIMER' name='supprimer' class = 'rounded gkbutton'/><input type='submit' value='ACCEPTER' name='accepter' class = 'rounded gkbutton'/><input type='submit' value='REFUSER' name='refuser' class = 'rounded gkbutton'/></td></form>";
            else
                if($tab[$i]->getDateCloture() != "" || $tab[$i]->getEtat() == 0) {
                    $str .= "<td><form method='POST'><input type = 'hidden' name = 'id' value = '".$i."'><input type='submit' value='SUPPRIMER' name='supprimer' class = 'rounded gkbutton'/></td></form>";
                } else
                    $str .= "<td><form method='POST'><input type = 'hidden' name = 'id' value = '".$i."'><input type='submit' value='SUPPRIMER' name='supprimer' class = 'rounded gkbutton'/><input type='submit' value='CLOTURER' name='cloturer' class = 'rounded gkbutton'/></td></form>";
            $str .= "</tr>";
        }
        $str .= "</center>";
        $str .= "</table>";
        //SELON L'ACTION EXECUTEE PAR L'ADMINISTRATEUR
        if(isset($_POST['cloturer'])) {
            $membre->cloturerSondage(parent::getCnx(), $tab[$_POST['id']]->getId());
            header('Location: index.php?page=Administration');
        }
        
        if(isset($_POST['supprimer'])) {
            $membre->supprimerSondage(parent::getCnx(), $tab[$_POST['id']]->getId());
            header('Location: index.php?page=Administration');
        }
        
        if(isset($_POST['accepter'])) {
            $membre->autoriserModificationSondage(parent::getCnx(), $tab[$_POST['id']]->getId());
            header('Location: index.php?page=Administration');
        }
        
        if(isset($_POST['refuser'])) {
            $membre->refuserModificationSondage(parent::getCnx(), $tab[$_POST['id']]->getId());
            header('Location: index.php?page=Administration');
        }
        
        return $str;
    }
    
    private function formaterDate($date) {
        $tab = explode('-', $date);
        return $tab[2]."/".$tab[1]."/".$tab[0];
    }
}
?>
