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
        $ordres=array("news.dateheurecreation DESC","news.dateheurecreation","utilisateurs.nom DESC","utilisateurs.nom");
        if(isset($_SESSION['ordre'])){
            $key=$_SESSION['ordre']-1;
        }
        else{
            $key=0;
        }
        $ordre=$ordres[$key];
        $db = \F3il\Database::getInstance();

        $sql = "SELECT image.chemin,utilisateurs.nom,news.dateheurecreation,news.id,news.titre FROM `news` LEFT JOIN `utilisateurs` ON news.id_utilisateur = utilisateurs.id LEFT JOIN `image` ON news.id_image = image.id"
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