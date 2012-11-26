<?php
require_once 'controllers/Controller.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$controller = new StatistiquesController();
$tabQuestions = $controller->getMesQuestions();
$nbVotants = $controller->getNbVotants($_POST['id']);
?>
<table>
    <caption>STATISTIQUES</caption>
    
    <colgroup>
    	<col span="1" width="300" style="background-color:#B8C7D3" />
        <col span="1" width="75" style="background-color: #CCCCCC" />
    </colgroup>
    <?php for ($i = 0; $i < COUNT($tabQuestions); $i++)  { ?>
    <thead>
        <tr>
            <th id="nav" abbr="Nav" scope="col"><?php echo $tabQuestions[$i]->getLibelle(); ?></th>
            <th id="nb" abbr="Nb" scope="col">Nombre</th>
        </tr>
    </thead>
    <?php 
        $tabReponses = $controller->getReponses($tabQuestions[$i]->getId());
        for ($j = 0; $j < COUNT($tabReponses); $j++)  {
    ?>
    <tbody>
        <tr>
            <td headers="nav"><?php echo $tabReponses[$j]->getLibelle(); ?></td>
            <td>
                <?php 
                    $percent = round(($tabReponses[$j]->getNb()/$nbVotants) * 100,2);
                    echo $tabReponses[$j]->getNb()." (".$percent." %)"; 
                ?>
            </td>
        </tr>
    </tbody>
    <?php 
        
        }
    }
    
    ?>
</table>