<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Connexion
 *
 * @author Naïm Attoumane
 */
class Connexion {

    //put your code here

    private static $instance;
    private $pilote;
    private $host;
    private $database;
    private $user;
    private $mdp;

    //CONSTRUCTEUR EN PRIVEE ACCESSIBLE SEULEMENT DANS LA CLASSE 
    private function __construct($pilote, $host, $database, $user, $mdp) {
        $this->pilote = $pilote;
        $this->host = $host;
        $this->database = $database;
        $this->user = $user;
        $this->mdp = $mdp;
    }

    public function getPilote() {
        return $this->pilote;
    }

    public function setPilote($pilote) {
        $this->pilote = $pilote;
    }

    public function getHost() {
        return $this->host;
    }

    public function setHost($host) {
        $this->host = $host;
    }

    public function getDatabase() {
        return $this->database;
    }

    public function setDatabase($database) {
        $this->database = $database;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function getMdp() {
        return $this->mdp;
    }

    public function setMdp($mdp) {
        $this->mdp = $mdp;
    }

    public static function seConnecter($pilote, $host, $database, $user, $mdp) {
        if (!isset(self::$instance)) {
            $classe = __CLASS__;
            self::$instance = new $classe($pilote, $host, $database, $user, $mdp);
            try {
                self::$instance = new PDO($pilote . ':host=' . $host . ';dbname=' . $database, $user, $mdp);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->exec("SET NAMES 'UTF8'");
            } catch (Exception $e) {
                $e->getMessage();
            }
        }
        return self::$instance;
    }

    public function __clone() {
        trigger_error('Le clonage est interdit.', E_USER_ERROR);
    }

}

?>
