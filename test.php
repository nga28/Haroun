<?php

function __autoload($classe)
	{
		if(file_exists("$classe.php")) require_once("$classe.php");
		else throw new Exception("<br/>Impossible de charger la classe [$classe].");
	}

	try
	{
		$tintin = new Personne("Albert", "Tintin", 20);
		echo "<br/>$tintin->nom";

		$casta = new Personne("Laetitia", "Casta", 32);
		echo "<br/>$casta->nom";

		$paris = new Ville("75","Paris");
		echo "<br/>$paris->ville";

		// --- La classe Pays n'existe pas
		$france = new Pays("France");
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
	}

?>
