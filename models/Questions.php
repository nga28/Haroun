<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Questions
 *
 * @author Naïm Attoumane
 */
class Questions {
    //put your code here
    private $id;
    private $libelle;
    private $type;
    
    function __construct($id = "", $libelle = "", $type = "") {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->type = $type;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    public function getType() {
        return $this->type;
    }

        
    public function ajouterQuestions($cnx) {
        $requete = "INSERT INTO questions (ID_SONDAGE,LIBELLE_QUESTION,TYPE_SONDAGE) VALUES (?,?,?)";
        $cmd = $cnx->prepare($requete);
        $cmd->bindValue(1, $this->id, PDO::PARAM_INT);
        $cmd->bindValue(2, $this->libelle, PDO::PARAM_STR);
        $cmd->bindValue(3, $this->type, PDO::PARAM_STR);
        if($cmd->execute())
            return true;
    }
    
    public function supprimerQuestion($cnx) {
        $requete = "DELETE FROM questions WHERE ID_QUESTION = ?";
        $cmd = $cnx->prepare($requete);
        $cmd->bindValue(1, $this->id, PDO::PARAM_INT);
        if($cmd->execute())
            return true;
    }
    
    
    
}

?>
