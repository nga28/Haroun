<?php
session_start();
require_once 'models/Membres.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <script type="text/javascript" src="/jquery-ui-1.9.1.custom/js/jquery-1.8.2.js"></script>
        <script type="text/javascript" src="jquery-ui-1.9.1.custom/js/jquery-ui-1.9.1.custom.js"></script>
        <script type="text/javascript" src="jquery-ui-1.9.1.custom/js/jquery-ui-1.9.1.custom.min.js"></script>
        <script type="text/javascript" src="jquery-ui-1.9.1.custom/development-bundle/ui/i18n/jquery.ui.datepicker-fr.js"></script>
        <title></title>
        <!--.<link href ="css/style.css" rel ="stylesheet" type ="text/css" />-->

        <script language="JavaScript">
            <!--


            function refuserToucheEntree(event)
            {
    
                if(!event && window.event) {
                    event = window.event;
                }
                // IE
                if(event.keyCode == 13) {
                    event.returnValue = false;
                    event.cancelBubble = true;
                }
                // DOM
                if(event.which == 13) {
                    event.preventDefault();
                    event.stopPropagation();
                }
            }

            //datepicker
            $(function() {
                $.datepicker.setDefaults( $.datepicker.regional[ "" ] );
                $( "#datepicker" ).datepicker( $.datepicker.regional[ "fr" ] );
            });  


            // Coloration pour la vérification !
            function couleur(obj) {
                obj.style.backgroundColor = "#FFFFFF";	 
            }


		

            function check() {
                var msg = "";
 
 
                //ici nous vérifions si le champs nom et vide, changeons la couleur du champs et définissons un message d'alerte
                if ($('#nom').val() == "") {
                    msg += "Veuillez saisir votre nom.\n";
                    $('#nom').css('background','#F3C200');
                }
 
                //meme manipulation pour le service
                if ($('#prenom').val() == "") {
                    msg += "Veuillez saisir votre service.\n";
                    $('#prenom').css('background','#F3C200');
                }
	
                //meme manipulation pour le demandeur
                if ($('#adresse').val() == "") {
                    msg += "Veuillez saisir le demandeur.\n";
                    $('#adresse').css('background','#F3C200');
                }

                //meme manipulation pour le demandeur
                if ($('#cp').val() == "") {
                    msg += "Veuillez saisir le demandeur.\n";
                    $('#cp').css('background','#F3C200');
                }
	
                //meme manipulation pour le site
                if ($('#ville').val() == "") {
                    msg += "Veuillez saisir le site d'intervention.\n";
                    $('#ville').css('background','#F3C200');
                }
	
	
                //meme manipulation pour le numero de fiche
                if ($('#mail').val() == "") {
                    msg += "Veuillez saisir le num\351ro de fiche.\n";
                    $('#mail').css('background','#F3C200');
                }
	

	
                // pour le domaine
	
                //meme manipulation pour le demandeur
                if ($('#mdp1').val() == "") {
                    msg += "Veuillez saisir le demandeur.\n";
                    $('#mdp1').css('background','#F3C200');
                
                }
                    
                    //meme manipulation pour le demandeur
                if ($('#adresse').val() == "") {
                    msg += "Veuillez saisir le demandeur.\n";
                    $('#adresse').css('background','#F3C200');
                }

	
                //Si aucun message d'alerte a été initialisé on retourne TRUE
                if (msg == "") return(true);
 
                //Si un message d'alerte a été initialisé on lance l'alerte
                else	{
                    alert(msg);
                    return(false);
                }
            }

            //-->
        </script>







    </head>
    <body onkeypress="refuserToucheEntree(event);">
        <div id ="contenu ">

            <header>
                <nav>
                    <?php
                    if (!isset($_SESSION['membre'])) {
                        ?>
                        <a href ="index.php?page=Authentification">Authentification</a>
                        <a href ="index.php?page=Inscription">Inscription</a>
                        <?php
                    } else {
                        $membre = unserialize($_SESSION['membre']);
//                        echo $membre;
                        if ($membre->getQualite() == 'BO') {
                            ?>
                            <a href ="index.php?page=Administration">Administration</a>
                            <?php
                        }
                        ?>
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

