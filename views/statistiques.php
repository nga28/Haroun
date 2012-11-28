<?php
require_once 'controllers/Controller.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//INSTANCIATION DU CONTROLLER STATISTIQUES
$controller = new StatistiquesController();
//RECUPERE LES QUESTIONS DU SONDAGE
$tabQuestions = $controller->getMesQuestions();
//TOTAL DE VOTANTS POUR LE SONDAGE
$nbVotants = $controller->getNbVotants();
//TABLEAU QUI VA RECUPERER LES DONNEES A ETRE EXPORTEES AU FORMAT CSV
$donnees = array();
$tampon = array();
?>
<center>
    <!--TABLEAU DE STATS DU SONDAGE SELECTIONNE-->
<table id = "hor-minimalist-b" >
    <?php 
        //boucle sur toutes les questions
        for ($i = 0; $i < COUNT($tabQuestions); $i++)  {
    ?>
    <thead>
        <tr>
            <th id="nav" abbr="Nav" scope="col"><?php echo $tabQuestions[$i]->getLibelle(); ?></th>
            <th id="nb" abbr="Nb" scope="col">Nombre</th>
            <th id="nb" abbr="Nb" scope="col">Pourcentage</th>
            <th id="nb" abbr="Nb" scope="col">Nombre votants</th>
        </tr>
    </thead>
    <?php 
        //TABLEAU QUI RECUPERE TOUTES LES REPONSES POUR LA QUESTION SPECIFIE
        $tabReponses = $controller->getReponses($tabQuestions[$i]->getId());
        for ($j = 0; $j < COUNT($tabReponses); $j++)  {
            $tampon['question'] = $tabReponses[$j]->getLibelleQuestion();
            $tampon['reponse'] = $tabReponses[$j]->getLibelle();
            $tampon['nb'] = $tabReponses[$j]->getNb();
            //AJOUT DES REPONSES DANS LE TABLEAU CSV
            array_push($donnees,$tampon);
    ?>
    <tbody>
        <tr>
            <td headers="nav"><center><?php echo $tabReponses[$j]->getLibelle(); ?></center></td>
            <td>
                <?php 
                    $percent = round(($tabReponses[$j]->getNb()/$nbVotants) * 100,2);
                    echo "<center>".$tabReponses[$j]->getNb()."</center>"; 
                ?>
            </td>
            <td><center><?php echo "(".$percent." %)"; ?></center></td>
            <td><center><?php echo $nbVotants; ?></center></td>
        </tr>
    </tbody>
    <?php 
        
        }
    }
    $controller->creerCSV($donnees);
    ?>
</table>
</center>