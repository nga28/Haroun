<html>
            <head>
                <script type='text/javascript' src='../jquery-ui-1.9.1/js/jquery-1.8.2.js'></script>
                <script type='text/javascript' src='../jquery-ui-1.9.1/js/jquery.js'></script>
                <script type='text/javascript' src='../jquery-ui-1.9.1/js/jquery.validationEngine-fr.js'></script>
                <script type='text/javascript' src='../jquery-ui-1.9.1/js/jquery.validationEngine.js'></script>
                <link rel='stylesheet' href='../css/template.css' type='text/css' media='screen' title='no title' charset='utf-8' />
                <link rel='stylesheet' href='../css/validationEngine.jquery.css' type='text/css' media='screen' title='no title' charset='utf-8' />
                <link href="../css/button.css" rel="stylesheet" type="text/css">
            </head><?php 
require_once '../controllers/CreerURLSondageController.php'; 
$controller = new CreerURLSondageController("TEST_DESIGN_69");echo $controller->genererSondage();if(isset($_POST["valider"])) { if($controller->verificationChamps()) $controller->validerSondage(); else echo "Veuillez renseigner tous les champs"; }?>