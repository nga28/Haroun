<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AuthentificationController
 *
 * @author Naïm Attoumane
 */
require_once 'models/Membres.php';
require_once 'models/User.php';
require_once 'models/Admin.php';
require_once 'models/Connexion.php';
require_once 'Controller.php';

class AuthentificationController extends Controller{
    //put your code here
    
    public function __construct() {
        
    }

    public function loginController() {
        include("views/authentification.php");
    }
    
    public function verificationChamps() {
        if(isset($_POST['valider'])) {
            if(empty($_POST['mail']) || empty($_POST['mdp'])) {
                return 0;
            } else {
                return 1;
            }
        }
        return -1;
    }
    
    public function verificationLogin() {
        $membres = new Membres($_POST['mail'], $_POST['mdp']);
        $resultat = $membres->authentification(parent::getCnx());
        if($resultat != false) {
            if($resultat['QUALITE'] == 'BO') {
                $object_membre = new Admin($resultat['MAIL_USER'], $resultat['MDP_USER'], $resultat['ID_USER'], $resultat['IP'], $resultat['NOM_USER'], $resultat['PRENOM_USER'], $resultat['ADRESSE_USER'], $resultat['CP_USER'], $resultat['VILLE_USER'], $resultat['QUALITE']);
            } else {
                $object_membre = new Membres($resultat['MAIL_USER'], $resultat['MDP_USER'], $resultat['ID_USER'], $resultat['IP'], $resultat['NOM_USER'], $resultat['PRENOM_USER'], $resultat['ADRESSE_USER'], $resultat['CP_USER'], $resultat['VILLE_USER'], $resultat['QUALITE']);
            }
            $obj_serialise = serialize($object_membre);
            $_SESSION['membre'] = $obj_serialise;
            $_SESSION['idMembre'] = $resultat['ID_USER'];
            header('Location: index.php');
        }
            
    }
    
}

?>
