<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$nom = "wati";
$fp = fopen("../sondages/azerty_2.php","w"); // ouverture du fichier en écriture
$str = "";
fputs($fp, "<?php \n"); // on écrit la première ligne du fichier php
$str.= "require_once '../controllers/CreerURLSondageController.php'; \n";
$str.= "require_once '../models/Connexion.php'; \n";
$str.= '$controller = new CreerURLSondageController("'.$nom.'");';
$str.= '$controller->genererSondage();';
$str.= 'if(isset($_POST["valider"])) { if($controller->verificationChamps()) $controller->validerSondage(); else echo "Veuillez renseigner tous les champs"; }';
fputs($fp,$str);
fputs($fp, "?>"); // on écrit la dernière ligne du fichier php
fclose($fp);  

?>
