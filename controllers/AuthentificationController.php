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
//CONTROLLER QUI VERIFIE L'AUTHENTIFICATION
class AuthentificationController extends Controller{
    //put your code here
    
    public function __construct() {
        
    }
    //AFFICHAGE DE LA PAGE D'AUTHENTIFICATION
    public function loginController() {
        include("views/authentification.php");
    }
    //VERIFICATION DES CHAMPS MAIL ET MDP
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
            //SI LE MEMBRE AUTHENTIFIE EST UN ADMIN
            if($resultat['QUALITE'] == 'BO') {
                //INSTANCIATION D'UN ADMINN UNIQUE
                $object_membre = new Admin($resultat['MAIL_USER'], $resultat['MDP_USER'], $resultat['ID_USER'], $resultat['IP'], $resultat['NOM_USER'], $resultat['PRENOM_USER'], $resultat['ADRESSE_USER'], $resultat['CP_USER'], $resultat['VILLE_USER'], $resultat['QUALITE']);
            } else {
                //INSTANCIATION D'UN MEMBRE
                $object_membre = new Membres($resultat['MAIL_USER'], $resultat['MDP_USER'], $resultat['ID_USER'], $resultat['IP'], $resultat['NOM_USER'], $resultat['PRENOM_USER'], $resultat['ADRESSE_USER'], $resultat['CP_USER'], $resultat['VILLE_USER'], $resultat['QUALITE']);
            }
            //SERIALISATION DE L'ADMIN OU DU MEMBRE
            $obj_serialise = serialize($object_membre);
            //ON STOCKE L'OBJET SERIALISE EN SESSION
            $_SESSION['membre'] = $obj_serialise;
            $_SESSION['idMembre'] = $resultat['ID_USER'];
            //Redirection vers la page Index
            header('Location: index.php?page=Default');
        }
            
    }
    
}

?>
