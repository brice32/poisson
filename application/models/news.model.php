<?php
/**
 * Created by PhpStorm.
 * User: wangyc
 * Date: 15/01/2017
 * Time: 15:58
 */
namespace Poisson;
defined('Poisson') or die('Acces interdit');

class NewsModel
{

    public function lister()
    {
        $ordres=array("news.DATEHEURECREATION DESC","news.DATEHEURECREATION","utilisateurs.nom DESC","utilisateurs.nom");
        if(isset($_SESSION['ordre'])){
            $key=$_SESSION['ordre']-1;
        }
        else{
            $key=0;
        }
        $ordre=$ordres[$key];
        $db = \F3il\Database::getInstance();

        $sql = "SELECT image.CHEMIN as chemin,utilisateurs.nom,news.DATEHEURECREATION as dateheurecreation,news.ID as id,news.TITRE as titre FROM `news` LEFT JOIN `utilisateurs` ON news.ID_UTILISATEUR = utilisateurs.id LEFT JOIN `image` ON news.ID_IMAGE = image.ID"
                ." ORDER BY $ordre";
        try {
            $req = $db->prepare($sql);
            $req->execute();
        } catch (\PDOException $ex) {
            throw new \F3il\SqlError($sql, $req, $ex);
        }
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

}