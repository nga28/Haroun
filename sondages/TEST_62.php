<?php 
require_once '../controllers/CreerURLSondageController.php'; 
$controller = new CreerURLSondageController("TEST_62");echo $controller->genererSondage();if(isset($_POST["valider"])) { if($controller->verificationChamps()) $controller->validerSondage(); else echo "Veuillez renseigner tous les champs"; }?>