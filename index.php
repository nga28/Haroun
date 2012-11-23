<?php
session_start();
require_once 'models/Membres.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title></title>
        <!--.<link href ="css/style.css" rel ="stylesheet" type ="text/css" />-->
        <script type="text/javascript" src="js/jquery-1.8.2.js"></script>
    </head>
    <body>
        <div id ="contenu ">
         
        <header>
            <nav>
                <?php
                    if(!isset($_SESSION['membre'])) {
                ?>
                        <a href ="index.php?page=Authentification">Authentification</a>
                        <a href ="index.php?page=Inscription">Inscription</a>
                <?php
                    } else {
                        $membre = unserialize($_SESSION['membre']);
//                        echo $membre;
                        if($membre->getQualite() == 'BO') {
               ?>
                            <a href ="index.php?page=Administration">Administration</a>
               <?php
                        }
               ?>
                       <a href ="index.php?page=Sondage">Sondage</a>
                       <a href ="index.php?page=MesSondages">Mes sondages</a>
                       <a href ="index.php?page=Deconnexion">Deconnexion</a>
               <?php
                    }
               ?>    
    
            </nav>
        </header> 
        <section>
            <?php include("route.php") ?>
        </section>
        <footer>
            
        </footer>
        </div>
    </body>
</html>

