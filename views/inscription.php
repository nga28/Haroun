<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>Inscription</title>
		<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<link rel="stylesheet" href="css/template.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<script src="js/jquery.js" type="text/javascript"></script>	
		<script src="js/jquery.validationEngine-fr.js" type="text/javascript"></script>  
		<script src="js/jquery.validationEngine.js" type="text/javascript"></script>

	</head>
	<body>
		<form id="formID" class="formular" method="post" action="">
			<fieldset>
				<legend>Utilisateur</legend>
				<label>
					<span>Nom : </span>
					<input class="validate[required,custom[onlyLetter],length[0,100]] text-input" type="text" name="nom" id="nom" />
				</label>
				<label>
					<span>Prénom : </span>
					<input class="validate[required,custom[onlyLetter],length[0,100]] text-input" type="text" name="prenom" id="prenom" />
				</label>
				
		<!--		
				<label>
					<span>Date : (format YYYY-MM-DD)</span>
					<input class="validate[required,custom[date]] text-input" type="text" name="date"  id="date" />
				</label>
		!-->		
				
				<label>
					<span>Age : </span>
					<input class="validate[required,custom[onlyNumber],length[0,3]] text-input" type="text" name="age"  id="age" />
				</label>
					
				
			</fieldset>
			<fieldset>
				<legend>Mot de Passe</legend>
				<label>
					<span>Mot de Passe : </span>
					<input class="validate[required,length[6,11]] text-input" type="password" name="mdp"  id="mdp" />
				</label>
				<label>
					<span>Confirmation mot de passe : </span>
					<input class="validate[required,confirm[password]] text-input" type="password" name="mdp2"  id="mdp2" />
				</label>
			</fieldset>
			<fieldset>
				<legend>Email</legend>
				<label>
					<span>Email  : </span>
					<input class="validate[required,custom[email]] text-input" type="text" name="mail" id="email"  />
				</label>
				<label>
					<span>Confirmation email : </span>
					<input class="validate[required,confirm[email]] text-input" type="text" name="mail2"  id="email2" />
				</label>
			</fieldset>
			<fieldset>
				

			</fieldset>
			<fieldset>
				<legend>Conditions</legend>
				<div class="infos">Accepter les conditions d'utilisation, ci-dessous : en cochant la case j'accepte les conditions d'utilisation de ce site</div>
				<label>
					<span class="checkbox">J'accepte les conditions : </span>
					<input class="validate[required] checkbox" type="checkbox"  id="agree"  name="agree"/>
				</label>
			</fieldset>
			<p><input class="submit" type="submit" value="Valider" /></p>
<hr/>
</form>
		
	</body>
</html>