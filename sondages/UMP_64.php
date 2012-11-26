<?php 
require_once '../controllers/CreerURLSondageController.php'; 
$controller = new CreerURLSondageController("UMP_64");echo $controller->genererSondage();if(isset($_POST["valider"])) { if($controller->verificationChamps()) $controller->validerSondage(); else echo "Veuillez renseigner tous les champs"; }?>