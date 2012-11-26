<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sondage
 *
 * @author Naïm Attoumane
 */
require_once 'models/Membres.php';
require_once 'models/Questions.php';

class Sondage {
    //put your code here
    private $id;
    private $nom;
    private $type;
    private $dateCloture;
    private $etat;
    private $url;
    private $statut;
    
    function __construct($nom = "", $type = "" , $id = "" , $dateCloture = "", $etat ="" , $url = "" , $statut = "") {
        $this->id = $id;
        $this->nom = $nom;
        $this->type = $type;
        $this->dateCloture = $dateCloture;
        $this->etat = $etat;
        $this->url = $url;
        $this->statut = $statut;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getNom() {
        return $this->nom;
    }

    public function getType() {
        return $this->type;
    }

    public function getDateCloture() {
        return $this->dateCloture;
    }

    public function getEtat() {
        return $this->etat;
    }
    
    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }
    
    public function getStatut() {
        return $this->statut;
    }
    
        
    public function validerSondage($cnx,$idSujet) {
        $membre = unserialize($_SESSION['membre']);
        $requete = "INSERT INTO sondage (ID_USER,TYPE_SONDAGE,NOM_SONDAGE,ID_SUJET,STATUT) VALUES (?,?,?,?,?)";
        $cmd = $cnx->prepare($requete);
        $cmd->bindValue(1, $membre->getId(), PDO::PARAM_INT);
        $cmd->bindValue(2, $this->type, PDO::PARAM_STR);
        $cmd->bindValue(3, $this->nom, PDO::PARAM_STR);
        $cmd->bindValue(4, $idSujet, PDO::PARAM_INT);
        $cmd->bindValue(5, 0, PDO::PARAM_INT);
        if($cmd->execute())
            return true;
    }
    
    public function supprimerSondage($cnx) {
        if($this->getNombreQuestions($cnx) != 0) {
            return false;
        } else {
            $requete = "DELETE FROM sondage WHERE ID_SONDAGE = ?";
            $cmd = $cnx->prepare($requete);
            $cmd->bindValue(1, $this->id, PDO::PARAM_INT);
            if($cmd->execute())
                return true;
        }
        
    }
    
    public function demanderModification($cnx) {
        $requete = "UPDATE sondage SET STATUT = 1 WHERE ID_SONDAGE = ?";
        $cmd = $cnx->prepare($requete);
        $cmd->bindValue(1, $this->id, PDO::PARAM_INT);
        $cmd->execute();
    }
    
    public function publierSondage($cnx) {
        $tampon = str_replace(' ','',  $this->nom);
        $nomFichier = $tampon."_".$this->id;
        $url = "sondages/".$tampon."_".$this->id.".php";
        $requete = "UPDATE sondage SET ETAT_SONDAGE = ? , URL = ? WHERE ID_SONDAGE = ?";
        $cmd = $cnx->prepare($requete);
        $cmd->bindValue(1, 1, PDO::PARAM_INT);
        $cmd->bindValue(2, $url, PDO::PARAM_STR);
        $cmd->bindValue(3, $this->id, PDO::PARAM_INT);
        if($cmd->execute()) {
            $this->creerFichier($nomFichier);
        }
        return true;       
    }
    
    public function modifierSondage($cnx) {
        $requete = "UPDATE sondage SET STATUT = 0 WHERE ID_SONDAGE = ?";
        $cmd = $cnx->prepare($requete);
        $cmd->bindValue(1, $this->id, PDO::PARAM_INT);
        if($cmd->execute())
            return true;
    }
    
    private function formaterDateMysql() {
        $tab = explode('.', date("m.d.Y"));
        return $tab[2]."-".$tab[0]."-".$tab[1];
    }
    
    private function creerFichier($nomFichier) {
        $leFichier = fopen("./sondages/".$nomFichier.".php", "wb");
        fclose($leFichier);
        $fp = fopen("./sondages/".$nomFichier.".php","w"); // ouverture du fichier en écriture
        $str = "";
        fputs($fp, "<?php \n"); 
        $str.= "require_once '../controllers/CreerURLSondageController.php'; \n";
        $str.= '$controller = new CreerURLSondageController("'.$nomFichier.'");';
        $str.= 'echo $controller->genererSondage();';
        $str.= 'if(isset($_POST["valider"])) { if($controller->verificationChamps()) $controller->validerSondage(); else echo "Veuillez renseigner tous les champs"; }';
        fputs($fp,$str);
        fputs($fp, "?>"); 
        fclose($fp);  
    }
    
    public function getNombreQuestions($cnx) {
        $requete = "SELECT COUNT(ID_QUESTION) AS 'nb' FROM questions WHERE `ID_SONDAGE` = ?";
        $cmd = $cnx->prepare($requete);
        $cmd->bindValue(1, $this->id, PDO::PARAM_INT);
        $cmd->execute();
        foreach($cmd as $enr) {
            foreach ($enr as $valeur) {
                return $valeur;
            }
        }
    }
    public static function getQuestions($cnx,$id) {
        $tabQuestions = array();
        $requete = "SELECT ID_QUESTION, LIBELLE_QUESTION , TYPE_SONDAGE FROM questions WHERE `ID_SONDAGE` = ?";
        $cmd = $cnx->prepare($requete);
        $cmd->bindValue(1, $id, PDO::PARAM_INT);
        $cmd->execute();
        foreach($cmd as $enr) {
            $question = new Questions($enr['ID_QUESTION'],$enr['LIBELLE_QUESTION'],$enr['TYPE_SONDAGE']);
            array_push($tabQuestions, $question);
        }
        return $tabQuestions;
    }
    
}

?>
