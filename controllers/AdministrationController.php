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

class AdministrationController extends Controller{
    //put your code here
    function __construct() {
        
    }
    
    public function getSondages() {
        $membre = unserialize($_SESSION['membre']);
        $tab = $membre->administrationSondages(parent::getCnx());
        $str = "";
        $str .= "<table border = '1'><tr><th>NOM</th><th>TYPE</th><th>DATE CLOTURE</th><th>ETAT</th><th>URL</th><th>ACTIONS</th></tr>";
        for($i = 0; $i < COUNT($tab); $i++) {
            $bgcolor = "";
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
            $str .= "<td>".$tab[$i]->getDateCloture()."</td>";
            if($tab[$i]->getEtat() == 0) {
                $str .= "<td>PAS PUBLIE</td>";
            } else {
                $str .= "<td>PUBLIE</td>";
            }
            $str .= "<td><a href = ".$tab[$i]->getUrl().">".$tab[$i]->getUrl()."</a></td>";
            if($tab[$i]->getStatut() == 1)
                $str .= "<td><form method='POST'><input type = 'hidden' name = 'id' value = '".$i."'><input type='submit' value='SUPPRIMER' name='supprimer' /><input type='submit' value='ACCEPTER' name='accepter' /><input type='submit' value='REFUSER' name='refuser' /></td></form>";
            else
                if($tab[$i]->getDateCloture() != "" || $tab[$i]->getEtat() == 0) {
                    $str .= "<td><form method='POST'><input type = 'hidden' name = 'id' value = '".$i."'><input type='submit' value='SUPPRIMER' name='supprimer' /></td></form>";
                } else
                    $str .= "<td><form method='POST'><input type = 'hidden' name = 'id' value = '".$i."'><input type='submit' value='SUPPRIMER' name='supprimer' /><input type='submit' value='CLOTURER' name='cloturer' /></td></form>";
            $str .= "</tr>";
        }
        $str .= "</table>";
        
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
}
?>
