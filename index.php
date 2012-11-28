<?php
//DEBUT DE LA SESSION
session_start();
//INCLUSION DES FICHIERS
require_once 'models/Membres.php';
require_once 'models/Admin.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <!--INCLUSION DES FICHIERS CSS ET JAVASCRIPT-->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title></title>
        <link href ="css/style.css" rel ="stylesheet" type ="text/css" />
        <script type="text/javascript" src="jquery-ui-1.9.1/js/jquery-1.8.2.js"></script>
        <link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
        <link rel="stylesheet" href="css/template.css" type="text/css" media="screen" title="no title" charset="utf-8" />
        <link href="css/button.css" rel="stylesheet" type="text/css">
        <script src="jquery-ui-1.9.1/js/jquery.js" type="text/javascript"></script>	
        <script src="jquery-ui-1.9.1/js/jquery.validationEngine-fr.js" type="text/javascript"></script>  
        <script src="jquery-ui-1.9.1/js/jquery.validationEngine.js" type="text/javascript"></script>
    </head>
    <body>
            <header>
                <!--BARRE DE NAVIGATION-->
                <nav>
                <div id = "page-wrap">
		<div id="top-bar"></div>
                <div id="zone-bar"> 
                    <a href ="index.php?page=Default"><span>Accueil</span></a>
                    <!--SI L'UTILISATEUR N'EST PAS AUTHENTIFIE-->
                    <?php
                    if (!isset($_SESSION['membre'])) {
                    ?>
                        <a href ="index.php?page=Authentification"><span>Authentification</span></a>
                        <a href ="index.php?page=Inscription"><span>Inscription</span></a>
                    <?php
                        ?>
                    <!--SI L'UTILISATEUR EST UN ADMIN-->
                        <?php
                    } else {
                        $membre = unserialize($_SESSION['membre']);
                        if ($membre->getQualite() == 'BO') {
                        ?>
                            <a href ="index.php?page=Administration">Administration</a>
                            <?php
                        }
                        ?>
                        <!--SI L'UTILISATEUR EST AUTHENTIFIE-->
                        <a href ="index.php?page=Sondage">Sondage</a>
                        <a href ="index.php?page=MesSondages">Mes sondages</a>
                        <a href ="index.php?page=Deconnexion">Deconnexion</a>
                        <?php
                    }
                    ?>  
                </div>
                </div>
                </nav>
            </header> 
            <section>
                <div id ="espace"></div>
                <!--INCLUSION DE LA PAGE ROUTE QUI REDIRIGE VERS LE CONTROLLER-->
                <?php 
                    if(!isset($_REQUEST['page'])) {
                        //SI PAS DE CONTROLLER SPECIFIE AFFICHAGE DE LA PAGE ACCUEIL
                        header('Location : index.php?page=Default');
                    } else 
                        include("route.php") 
                ?>
            </section>
            <footer>
                <div id ="piedPage">
                    SITE REALISE PAR NAIM ATTOUMANE , ARNAUD DUCLUZAUD ©
                </div>    
            </footer>
    </body>
</html>

