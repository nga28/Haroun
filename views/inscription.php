<!--FORMULAIRE D'INSCRIPTION-->
<form id="formID" class="formular" method="post" action="index.php?page=Inscription">
    <fieldset>
        <legend>Utilisateur</legend>
        <label>
            <span>Nom : </span>
            <input class="validate[required,custom[onlyLetter],length[0,100]] text-input" type="text" name="nom" id="nom" />
        </label>
        <label>
            <span>Prénom : </span>
            <input class="validate[required,custom[onlyLetter]] text-input" type="text" name="prenom" id="prenom" />
        </label>
    </fieldset>
    <fieldset>
        <legend>Email</legend>
        <label>
            <span>Email  : </span>
            <input class="validate[required,custom[email]] text-input" type="text" name="mail" id="email"  />
        </label>

    </fieldset>
    <fieldset>
        <legend>Mot de Passe</legend>
        <label>
            <span>Mot de Passe : </span>
            <input class="validate[required,length[6,11]] text-input" type="password" name="mdp1"  id="mdp1" />
        </label>
        <label>
            <span>Confirmation mot de passe : </span>
            <input class="validate[required,confirm[#mdp1]] text-input" type="password" name="mdp2"  id="mdp2" />
        </label>
    </fieldset>
    <fieldset>
        <legend>Adresse</legend>
        <label>
            <span>Adresse  : </span>
            <input class="validate[required,custom[noSpecialCaracters]] text-input" type="text" name="adresse" id="adresse"  />
        </label>
        <label>
            <span>Code Postal  : </span>
            <input class="validate[required,length[5,5]] text-input" type="text" name="cp" id="cp"  />
        </label>
        <label>
            <span>Ville  : </span>
            <input class="validate[required,custom[onlyLetter],length[0,100]] text-input" type="text" name="ville" id="ville"  />
        </label>

    </fieldset>
    <fieldset>
        <legend>Conditions</legend>
        <div class="infos">Accepter les conditions d'utilisation, ci-dessous : en cochant la case j'accepte les conditions d'utilisation de ce site</div>
        <label>
            <span class="checkbox">J'accepte les conditions : </span>
            <input class="validate[required] checkbox" type="checkbox"  id="agree"  name="agree"/>
        </label>
        <input class="submit" type="submit" name = "valider" value="Valider" />
    </fieldset>
    <p></p>
</form>
