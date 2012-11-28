<?php require_once 'controllers/SondageController.php';?>
<!--FORMULAIRE D'AJOUT DE SONDAGE-->
<form id="formID" class="formular" method="post" action="index.php?page=Sondage">
    <fieldset>
        <legend>NOUVEAU SONDAGE</legend>
        <label>
            <span>Nom  : </span>
            <input class="validate[required] text-input" type="text" name="nom" id="nom"  />
        </label>
        <label>
            <span>Sujet  : </span>
            <select class="validate[] text-input" type="text" name="sujet" id="sujet">
                <!--RECUPERER LES SUJETS DE DE SONDAGE EN INSTANCIANT LE CONTROLLER-->
                <?php 
                    $controller = new SondageController();
                    $tab = $controller->getSujet();
                    for($i = 0; $i < COUNT($tab); $i++) {
                ?>
                        <option value ="<?php echo $tab[$i]->getId(); ?>"><?php echo $tab[$i]->getLibelle();?></option>
                <?php
                    }
                ?>
            </select>
        </label>
    </fieldset>
    <fieldset>
        <legend>TYPE SONDAGE</legend>
        <table>
            <tr>
                <td>Public <input type="radio" name="type" value="0" checked="checked" /></td>
            </tr>   
            <tr>    
                <td>Prive <input type="radio" name="type" value="1" /></td>
            </tr>
        </table>
            <td><input type="submit" value="Valider" name="valider" /></td>
    </fieldset>
       
    
</form>

