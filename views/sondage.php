<?php require_once 'controllers/SondageController.php';?>

<form name="sondage" method="post" action="index.php?page=Sondage">
    <table>
        <tr>
            <td>Nom</td>
            <td><input type="text" name="nom" value="" /></td>
        </tr>
        <tr>
            <td>Sujet</td>
            <td>
                <select name ="sujet">
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
            </td>
        </tr>
       <tr>
            <td>Public <input type="radio" name="type" value="0" checked="checked" /></td>
            <td>Prive <input type="radio" name="type" value="1" /></td>
        </tr>
        <tr>
            <td><input type="submit" value="Valider" name="valider" /></td>
        </tr>
    </table>
</form>

