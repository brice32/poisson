<?php
namespace Poisson;

use F3il\Database;
use F3il\Error;

defined('Poisson') or die('Acces interdit');

class UtilisateursModel implements \F3il\AuthenticationInterface
{
    public function lister()
    {
        $db = \F3il\Database::getInstance();

        $sql = "SELECT * FROM utilisateurs ORDER by nom, prenom";
        try {
            $req = $db->prepare($sql);
            $req->execute();
        } catch (\PDOException $ex) {
            throw new \F3il\SqlError($sql, $req, $ex);
        }
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function supprimer($id)
    {
        $db = \F3il\Database::getInstance();

        $sql = "DELETE FROM utilisateurs WHERE id = :id";
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':id', $id);
            $req->execute();

        } catch (\PDOException $ex) {
            die('Erreur SQL ' . $ex->getMessage());
        }
    }

    public function creer(array $data)
    {
        $db = \F3il\Database::getInstance();
        $sql = "INSERT INTO utilisateurs SET "
            . " nom = :nom"
            . ", prenom = :prenom"
            . ", email = :email"
            . ", login = :login"
            . ", motdepasse = :motdepasse"
            . ", creation = :creation";
        $req = $db->prepare($sql);
        $req->bindValue(':nom', $data['nom']);
        $req->bindValue(':prenom', $data['prenom']);
        $req->bindValue(':email', $data['email']);
        $req->bindValue(':login', $data['login']);
        $data['creation']=date('Y-m-d H:i:s');
        $req->bindValue(':creation',$data['creation']);
        $authentication=\F3il\Authentication::getInstance();
//        $data['motdepasse'] = $this->hash($data['motdepasse'],$this->auth_getSalt($this->auth_getUserByLogin($data['login'])));
        $data['motdepasse'] = $authentication->hash($data['motdepasse'],$data['creation']);
        $req->bindValue(':motdepasse', $data['motdepasse']);
        try {
            $req->execute();
        } catch (\PDOException $ex) {
            throw new \F3il\Error("Erreur SQL " . $ex->getMessage());
        }
    }

    public function loginExistant($login, $id)
    {
        $db = \F3il\Database::getInstance();
        if (0) {
            $sql = "SELECT COUNT(*) as numbre FROM `utilisateurs` WHERE login = :login"
                . ", AND id <> :id";
            try {
                $req = $db->prepare($sql);
                $req->bindValue(':login', $login);
                $req->bindValue(':id', $id);
                $req->execute();
            } catch (\PDOException $ex) {
                die('Erreur SQL ' . $ex->getMessage());
            }
        } else {
            $sql = "SELECT COUNT(*) as numbre FROM `utilisateurs` WHERE login = :login";
            try {
                $req = $db->prepare($sql);
                $req->bindValue(':login', $login);
                $req->execute();
            } catch (\PDOException $ex) {
                die('Erreur SQL ' . $ex->getMessage());
            }
        }
        $numbre=$req->fetch(\PDO::FETCH_ASSOC);
//        return ;

        if ($numbre['numbre'] == 0) {
            return true;
        } else {
            return false;
        }

    }

    public function lire($id)
    {
        $db = \F3il\Database::getInstance();

        $sql = "SELECT * FROM `utilisateurs` WHERE id = :id";

        try {
            $req = $db->prepare($sql);
            $req->bindValue(':id', $id);
            $req->execute();
        } catch (\PDOException $ex) {
            die('Erreur SQL ' . $ex->getMessage());
        }
        return $req->fetch(\PDO::FETCH_ASSOC);
    }

    public function mettreAJour($data)
    {
        $db = \F3il\Database::getInstance();
        $sql = "UPDATE `utilisateurs` SET "
            . " nom = :nom "
            . ", prenom = :prenom "
            . ", email = :email "
            . ", login = :login ";
        if (!empty($data['motdepasse'])) {
            $sql .= ", motdepasse = :motdepasse "
                . ", creation = :creation";
        }

        $sql .= " WHERE id= :id";

        $req = $db->prepare($sql);
        try {
            $req->bindValue(':nom', $data['nom']);
            $req->bindValue(':prenom', $data['prenom']);
            $req->bindValue(':login', $data['login']);
            $req->bindValue(':email', $data['email']);
            if (!empty($data['motdepasse'])) {
                $data['motdepasse']=date('Y-m-d H:i:s');
                $req->bindValue(':creation', $data['motdepasse']);
                $authentication=\F3il\Authentication::getInstance();
                $data['motdepasse'] = $authentication->hash($data['motdepasse'],$data['creation']);
                $req->bindValue(':motdepasse', $data['motdepasse']);
            }
            $req->bindValue(':id', $data['id']);
            $req->execute();
        } catch (\PDOException $ex) {
            throw new \F3il\Error("Erreur SQL " . $ex->getMessage());
        }
    }

    public function auth_getLoginKey() {
//        $db = \F3il\Database::getInstance();
//
//        $sql = "SELECT login FROM utilisateurs";
//        $req = $db->prepare($sql);
//        try {
//            $req->execute();
//        } catch (\PDOException $ex) {
//            throw new \F3il\Error("Erreur SQL ".$ex->getMessage());
//        }
//
//        return $req->fetchAll(\PDO::FETCH_ASSOC);
        return "login";
    }

    public function auth_getPasswordKey() {
//        $db = \F3il\Database::getInstance();
//
//        $sql = "SELECT motdepasse FROM utilisateurs";
//        $req = $db->prepare($sql);
//        try {
//            $req->execute();
//        } catch (\PDOException $ex) {
//            throw new \F3il\Error("Erreur SQL ".$ex->getMessage());
//        }
//
//        return $req->fetchAll(\PDO::FETCH_ASSOC);
        return "motdepasse";
    }

    public function auth_getUserById($id) {
        return $this->lire($id);
    }

    public function auth_getUserByLogin($login) {
        $db = \F3il\Database::getInstance();

        $sql = "SELECT * FROM `utilisateurs` WHERE login = :login";

        try {
            $req = $db->prepare($sql);
            $req->bindValue(':login', $login);
            $req->execute();
        } catch (\PDOException $ex) {
            die('Erreur SQL ' . $ex->getMessage());
        }
        return $req->fetch(\PDO::FETCH_ASSOC);
    }

    public function auth_getUserIdKey() {
//        $db = \F3il\Database::getInstance();
//
//        $sql = "SELECT id FROM utilisateurs";
//        $req = $db->prepare($sql);
//        try {
//            $req->execute();
//        } catch (\PDOException $ex) {
//            throw new \F3il\Error("Erreur SQL ".$ex->getMessage());
//        }
//
//        return $req->fetchAll(\PDO::FETCH_ASSOC);
        return "id";
    }

    public function auth_getSalt($user)
    {
        // TODO: Implement auth_getSalt() method.
        if(array_key_exists('creation',$user)){
            return $user['creation'];
        }
        else{
            throw new Error("Probleme dans utilisateurs.model auth_getSalt. ");
        }
    }
}

