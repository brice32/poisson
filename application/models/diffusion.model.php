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
        $sql = "SELECT diffuser.*,image.chemin,utilisateurs.nom,news.dateheurecreation,news.id,news.titre FROM `news` LEFT JOIN `utilisateurs` ON news.id_utilisateur = utilisateurs.id LEFT JOIN `image` ON news.id_image = image.id INNER JOIN `diffuser` ON diffuser.id_news = news.id"
                ." WHERE diffuser.id_diffusion=1"
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
                . " id_diffusion = 1"
                . ", id_news = :id_news"
                . ", ordre = :ordre"
                . ",tempsdiffusion = 30";


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
        $sql = "SELECT MAX(diffuser.ordre) as maxi FROM `diffuser` WHERE diffuser.id_diffusion=1";
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
        $sql = "SELECT COUNT(*) as nombre FROM `diffuser` WHERE diffuser.id_news=:id_news AND diffuser.id_diffusion=1";
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
        $sql = "DELETE FROM `diffuser` WHERE `ordre`=:ordre AND diffuser.id_diffusion=1";
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':ordre', $ordre);
            $req->execute();
        } catch (\PDOException $ex) {
            die('Erreur SQL ' . $ex->getMessage());
        }

        $sql = "UPDATE `diffuser` SET `ordre`=`ordre`-1 WHERE `ordre`>:ordre AND diffuser.id_diffusion=1";
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
        $sql = "UPDATE `diffusion` SET `dernieremodification` = :modification";
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
        $sql = "SELECT diffusion.dernieremodification FROM `diffusion`";
        try {
            $req = $db->prepare($sql);
            $req->execute();
        } catch (\PDOException $ex) {
            die('Erreur SQL ' . $ex->getMessage());
        }
        $modification=$req->fetch(\PDO::FETCH_ASSOC);
        return $modification['dernieremodification'];
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


}