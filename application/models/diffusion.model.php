<?php
/**
 * Created by PhpStorm.
 * User: wangyc
 * Date: 15/01/2017
 * Time: 15:57
 */
namespace Poisson;
defined('Poisson') or die('Acces interdit');

class DiffusionModel{

    public function lister(){

        $db = \F3il\Database::getInstance();
        $sql = "SELECT diffuser.ID_NEWS as id_news,diffuser.ORDRE as ordre,diffuser.TEMPSDIFFUSION as tempsdiffusion,image.CHEMIN as chemin,utilisateurs.nom,news.DATEHEURECREATION as dateheurecreation,news.ID as id,news.TITRE as titre FROM `news` LEFT JOIN `utilisateurs` ON news.ID_UTILISATEUR = utilisateurs.id LEFT JOIN `image` ON news.ID_IMAGE = image.ID INNER JOIN `diffuser` ON diffuser.ID_NEWS = news.ID"
                ." WHERE diffuser.ID_DIFFUSION=1"
                ." ORDER BY diffuser.ORDRE"
                ;
        try {
            $req = $db->prepare($sql);
            $req->execute();
        } catch (\PDOException $ex) {
            throw new \F3il\SqlError($sql, $req, $ex);
        }
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function ajouter($id,$order){
        $db = \F3il\Database::getInstance();
        $sql = "INSERT INTO diffuser SET "
                . " ID_DIFFUSION = 1"
                . ", ID_NEWS = :id_news"
                . ", ORDRE = :ordre"
                . ",TEMPSDIFFUSION = 30";


        try {
            $req = $db->prepare($sql);
            $req->bindValue(':id_news', $id);
            $req->bindValue(':ordre', $order);
            $req->execute();
        } catch (\PDOException $ex) {
            throw new \F3il\Error("Erreur SQL " . $ex->getMessage());
        }
        $this->update();
    }

    public function ordremaxi(){
        $db = \F3il\Database::getInstance();
        $sql = "SELECT MAX(diffuser.ORDRE) as maxi FROM `diffuser` WHERE diffuser.ID_DIFFUSION=1";
        try {
            $req = $db->prepare($sql);
            $req->execute();
        } catch (\PDOException $ex) {
            die('Erreur SQL ' . $ex->getMessage());
        }
        $maximale=$req->fetch(\PDO::FETCH_ASSOC);
        $maximale['maxi']=$maximale['maxi'];
        return $maximale['maxi'];
    }

    public function newsetat($id){
        $db = \F3il\Database::getInstance();
        $sql = "SELECT COUNT(*) as nombre FROM `diffuser` WHERE diffuser.ID_NEWS=:id_news AND diffuser.ID_DIFFUSION=1";
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':id_news', $id);
            $req->execute();
        } catch (\PDOException $ex) {
            die('Erreur SQL ' . $ex->getMessage());
        }
        $numbre=$req->fetch(\PDO::FETCH_ASSOC);
        if ($numbre['nombre'] == 0){
            return false;
        }
        else{
            return true;
        }
    }

    public function supprimerorder($ordre){

        $db = \F3il\Database::getInstance();
        $sql = "DELETE FROM `diffuser` WHERE `ORDRE`=:ordre AND diffuser.ID_DIFFUSION=1";
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':ordre', $ordre);
            $req->execute();
        } catch (\PDOException $ex) {
            die('Erreur SQL ' . $ex->getMessage());
        }

        $sql = "UPDATE `diffuser` SET `ORDRE`=`ORDRE`-1 WHERE `ORDRE`>:ordre AND diffuser.ID_DIFFUSION=1";
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':ordre', $ordre);
            $req->execute();
        } catch (\PDOException $ex) {
            die('Erreur SQL ' . $ex->getMessage());
        }
        $this->update();
    }

    public function update(){
        $db = \F3il\Database::getInstance();
        $sql = "UPDATE `diffusion` SET `DERNIEREMODIFICATION` = :modification";
        try {
            $req = $db->prepare($sql);
            $modification=date('Y-m-d H:i:s');
            $req->bindValue(':modification', $modification);
            $req->execute();
        } catch (\PDOException $ex) {
            die('Erreur SQL ' . $ex->getMessage());
        }
    }

    public function update_modification(){
        $db = \F3il\Database::getInstance();
        $sql = "SELECT diffusion.DERNIEREMODIFICATION FROM `diffusion`";
        try {
            $req = $db->prepare($sql);
            $req->execute();
        } catch (\PDOException $ex) {
            die('Erreur SQL ' . $ex->getMessage());
        }
        $modification=$req->fetch(\PDO::FETCH_ASSOC);
        return $modification['DERNIEREMODIFICATION'];
    }

    public function touteffacer(){
        $db = \F3il\Database::getInstance();
        $sql = "DELETE FROM `diffuser` WHERE 1";
        try {
            $req = $db->prepare($sql);
            $req->execute();
        } catch (\PDOException $ex) {
            die('Erreur SQL ' . $ex->getMessage());
        }
    }

    public function modifiertemps($ordre,$temps){
        $db = \F3il\Database::getInstance();
        $sql = "UPDATE `diffuser` SET `TEMPSDIFFUSION` = :temps"
                . " WHERE `ORDRE`=:ordre";
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':temps',$temps);
            $req->bindValue(':ordre',$ordre);
            $req->execute();
        } catch (\PDOException $ex) {
            die('Erreur SQL ' . $ex->getMessage());
        }
        $this->update();
    }


}