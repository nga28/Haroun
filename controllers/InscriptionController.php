<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InscriptionController
 *
 * @author Naïm Attoumane
 */
require_once 'models/Membres.php';
require_once 'models/User.php';

class InscriptionController extends Controller{
    //put your code here
    
    function __construct() {
        
    }

    public function inscriptionController() {
        include("views/inscription.php");
    }
    
    public function verificationChamps() {
        if(isset($_POST['valider'])) {
            //Champs vides
            if(empty($_POST['mail']) || empty($_POST['mdp1']) || empty($_POST['mdp2']) || empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['adresse']) || empty($_POST['cp']) || empty($_POST['ville'])) {
                return 0;
            } else {
                //MDP1 DIFFERENT MP2
                if($_POST['mdp1'] != $_POST['mdp2']) {
                    return 1;
                } else 
                    return 2;
            }
        }
        return -1;
    }
    
    public function verificationInscription() {
        $user = new User($this->getCnx(),$_SERVER["REMOTE_ADDR"]);
        //INSCRIPTION DANS LA TABLE USER
        $user->ajouterUser();
        //INSCRIPTION DANS LA TABLE MEMBRE
        $mail = $_POST['mail'];
        $mdp = $_POST['mdp1'];
        $id = $user->getId();
        $ip = $user->getIp();
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $cp = $_POST['cp'];
        $ville = $_POST['ville'];
        $qualite = "FO";
        $membre = new Membres($mail, $mdp, $this->getCnx(),$id, $ip, $nom, $prenom, $adresse, $cp, $ville, $qualite);
        $membre->ajouterMembre();
    }
}

?>
