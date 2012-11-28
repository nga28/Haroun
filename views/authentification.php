<!--FORMULAIRE D'AUTHENTIFICATION-->
<form id="formID" class="formular" method="post" action="index.php?page=Authentification">
    <fieldset>
        <legend>AUTHENTIFICATION</legend>
        <label>
            <span>Email  : </span>
            <input class="validate[required,custom[email]] text-input" type="text" name="mail" id="mail"  />
        </label>
        <label>
            <span>Mot de Passe : </span>
            <input class="validate[required] text-input" type="password" name="mdp"  id="mdp" />
            <input class="submit" type="submit" name = "valider" value="Valider" />
        </label>
    </fieldset>
</form>
