<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'controllers/Controller.php';

if(isset($_GET['page'])) {
    $page = $_GET['page'];
    $page .= "Controller";
    //Controller
    $mainController = new Controller($page);
    $controller = $mainController->getPageController();
    switch ($page) {
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
                echo $controller->verificationInscription();
                break;
        }
        break;
    case 'DefaultController' :
        $controller->test();
        echo "rrrr";
        break;
    }
}

?>
