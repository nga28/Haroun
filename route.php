<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//INCLUSION DU CONTROLLER PRINCIPAL
require_once 'controllers/Controller.php';

//SI LA VARIABLE PAGE EST INITIALISEE ON INSTANCIE LE CONTROLLER SPECIFIQUE
if(isset($_GET['page'])) {
    $page = $_GET['page'];
    $page .= "Controller";
    //Controller
    $mainController = new Controller($page);
    $controller = $mainController->getPageController();
    //SELON LE CONTROLLER QUE L'ON INSTANCIE ON EXECUTE LES METHODES DONT ON A BESOIN
    switch ($page) {
    case 'AdministrationController' :
        echo $controller->getSondages();
        break;
    case 'AuthentificationController' :
        $controller->loginController();
        if($controller->verificationChamps() == 0) {
            echo "Veuillez renseigner tous les champs";
        } else if ($controller->verificationChamps() == 1) {
            $controller->verificationLogin();
            if(!isset($_SESSION['membre'])) {
                echo "Adresse mail et/ou mot de passe invalide(s)";
            }
        }
        
        break;
    case 'DeconnexionController' :
        $controller->getDeconnexion();
        break;
    case 'InscriptionController' :
        $controller->inscriptionController();
        switch($controller->verificationChamps()) {
            case 0 :
                echo "Veuillez renseigner tous les champs";
                break;
            case 1 :
                echo "Mot de passes differents";
                break;
            case 2 :
                if($controller->verificationInscription() == 1) {
                    header('Location : index.php');
                } else if ($controller->verificationInscription() == 0) {
                    echo "Vous etes deja inscris";
                } else {
                   echo "Erreur lors de l'inscription, veuillez reessayer"; 
                }      
                break;
        }
        break;
    case 'SondageController' :
        $controller->creerSondage();
        if($controller->verificationChamps() == 0) {
            echo "Veuillez entrer un nom de sondage";
        } else if($controller->verificationChamps() == 1){
            $controller->enregistrerSondage();
        }
        break;
    case 'MesSondagesController' : 
        echo $controller->getMesSondages();
        break;
    case 'QuestionsController' :
        echo $controller->getQuestionsFromBD();
        $controller->afficherFormulaire();
        break;
    case 'StatistiquesController' :
        echo $controller->afficherPage();
        break;
    case 'DefaultController' :
        $controller->afficherPage();
        break;
    }
}

?>
