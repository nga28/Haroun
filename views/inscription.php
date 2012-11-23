<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<form name="inscr" action="index.php?page=Inscription" method="POST">
    <table>
        <tr>
            <td>Nom</td>
            <td><input type="text" name="nom" value="a" /></td>
        </tr>
        
        <tr>
            <td>Prenom</td>
            <td><input type="text" name="prenom" value="a" /></td>
        </tr>
        
        <tr>
            <td>Adresse</td>
            <td><input type="text" name="adresse" value="a" /></td>
        </tr>
        
        <tr>
            <td>CP</td>
            <td><input type="text" name="cp" value="93100" /></td>
        </tr>
        
        <tr>
            <td>Ville</td>
            <td><input type="text" name="ville" value="Montreuil" /></td>
        </tr>
        
        <tr>
            <td>Mail</td>
            <td><input type="text" name="mail" value="a@a.fr" /></td>
        </tr>
        
        <tr>
            <td>Mot de passe</td>
            <td><input type="password" name="mdp1" value="a" /></td>
        </tr>
        
        <tr>
            <td>Retaper le mot de passe</td>
            <td><input type="password" name="mdp2" value="a" /></td>
        </tr>
        
        <tr>
            <td><input type ="submit" name ="valider" value ="Valider"></td>
        </tr>
    </table>
</form>