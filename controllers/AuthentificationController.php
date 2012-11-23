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
            $id = $resultat['ID_USER'];
            $nom = $resultat['NOM_USER'];
            $prenom = $resultat['PRENOM_USER'];
            $adresse = $resultat['ADRESSE_USER'];
            $cp = $resultat['CP_USER'];
            $ville = $resultat['VILLE_USER'];
            $mail = $resultat['MAIL_USER'];
            $mdp = $resultat['MDP_USER'];
            $ip = $resultat['IP'];
            $qualite = $resultat['QUALITE'];
            $object_membre = new Membres($mail, $mdp, $id, $ip, $nom, $prenom, $adresse, $cp, $ville, $qualite);
            $obj_serialise = serialize($object_membre);
            $_SESSION['membre'] = $obj_serialise;
            header('Location: index.php');
        }
            
    }
    
}

?>
