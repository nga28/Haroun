<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>





<form name="inscr" action="index.php?page=Inscription" method="POST" enctype="application/x-www-form-urlencoded" onSubmit="return check();">
    <fieldset>
        <table>
            <tr>
                <td><label>Nom</label></td>
                <td><input type="text" name="nom" value="" onKeyUp="javascript:couleur(this);" /></td>
            </tr>

            <tr>
                <td><label>Prenom</label></td>
                <td><input type="text" name="prenom" value="" onKeyUp="javascript:couleur(this);" /></td>
            </tr>

            <tr>
                <td><label>Adresse</label></td>
                <td><input type="text" name="adresse" value="" onKeyUp="javascript:couleur(this);" /></td>
            </tr>

            <tr>
                <td><label>CP</label></td>
                <td><input type="text" name="cp" value="" onKeyUp="javascript:couleur(this);"/></td>
            </tr>

            <tr>
                <td><label>Ville</label></td>
                <td><input type="text" name="ville" value="" onKeyUp="javascript:couleur(this);"/></td>
            </tr>

            <tr>
                <td><label>Mail</label></td>
                <td><input type="text" name="mail" value="" onKeyUp="javascript:couleur(this);" /></td>
            </tr>

            <tr>
                <td><label>Mot de passe</label></td>
                <td><input type="password" name="mdp1" value="" onKeyUp="javascript:couleur(this);"/></td>
            </tr>

            <tr>
                <td><label>Retaper le mot de passe</label></td>
                <td><input type="password" name="mdp2" value="" onKeyUp="javascript:couleur(this);" /></td>
            </tr>

            <tr>
                <td><input type ="submit" name ="valider" value ="Valider"></td>
            </tr>        
        </table>
    </fieldset>
</form>

