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

class MesSondagesController extends Controller{
    //put your code here
    function __construct() {
        
    }
    
    public function getMesSondages() {
        $membre = unserialize($_SESSION['membre']);
        $tab = $membre->recupererMesSondages(parent::getCnx());
        $str = "";
        $str .= "<table border = '1'><tr><th>NOM</th><th>TYPE</th><th>DATE CLOTURE</th><th>ETAT</th><th>ACTIONS</th></tr>";
        for($i = 0; $i < COUNT($tab); $i++) {
            $str .= "<tr>";
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
            if($tab[$i]->getEtat() == 0) 
                $str .= "<td><form method='POST'><input type = 'hidden' name = 'id' value = '".$i."'><input type='submit' value='SUPPRIMER' name='supprimer' /><input type='submit' value='PUBLIER' name='publier' /><input type='submit' value='MODIFIER' name='modifier' /></td></form>";
            else
                $str .= "<td><form method='POST'><input type = 'hidden' name = 'id' value = '".$i."'><input type='submit' value='SUPPRIMER' name='supprimer' /><input type='submit' value='MODIFIER' name='modifier' / disabled></td></form>";
            $str .= "</tr>";
        }
        $str .= "</table>";
        if(isset($_POST['supprimer'])) {
            if($tab[$_POST['id']]->supprimerSondage(parent::getCnx())) {
                header('Location: index.php?page=MesSondages');
            }
        }
        
        if(isset($_POST['publier'])) {
            if($tab[$_POST['id']]->publierSondage(parent::getCnx())) {
                header('Location: index.php?page=MesSondages');
            }
        }
        
        if(isset($_POST['modifier'])) {
            $_SESSION['id'] = $tab[$_POST['id']]->getId();
            header('Location: index.php?page=AddQuestion');
        }
        return $str;
    }
}

?>
