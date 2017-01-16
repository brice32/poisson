<?php
/**
 * Created by PhpStorm.
 * User: wangyc
 * Date: 07/12/2016
 * Time: 23:42
 */
namespace Poisson;
defined("Poisson") or die("Acess interdit utilisateur-liste");
\F3il\Messages::setMessageRenderer('\Poisson\MessagesHelper::messagesRenderer');
$this->setPageTitle('Utilisateur-Liste');
?>
<h2>Liste des utilisateurs</h2>
[%MESSAGES%]
<div id="datagrid-commands">
    <a href="?controller=utilisateur&action=creer">
        <button class="btn btn-primary">Nouvel Utilisateur</button>
    </a>
</div>
<table class="table table-condensed table-bordered table-striped table-hover">
    <thead>
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Login</th>
        <th>Admin</th>
        <th>Création</th>
        <th>Connextion</th>
        <th>Id</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $data=$this->utilisateurs;
    foreach($data as $U):
        ?>
    <tr>
        <td><?php echo $U['nom'];?></td>
        <td><?php echo $U['prenom'];?></td>
        <td><?php echo $U['email'];?></td>
        <td><?php echo $U['login'];?></td>
        <td><?php echo $U['admin'];?></td>
        <td><?php echo $U['creation'];?></td>
        <td><?php echo $U['connexion'];?></td>
        <td><?php echo $U['id'];?></td>
        <td><button name="id" value="<?php echo $U['id'];?>" class="btn btn-default btn-xs glyphicon glyphicon-edit" form="edit-form" title="Editer">
                <button name="id" value="<?php echo $U['id'];?>" class="btn btn-default btn-xs glyphicon glyphicon-trash" form="delete-form" title="Supprimer">
        </td>
    </tr>
        <?php
    endforeach;
    ?>

<!--    <tr>-->
<!--        <td>WANG</td>-->
<!--        <td>Yuchen</td>-->
<!--        <td>wangyc32@gmail.com</td>-->
<!--        <td>wangy</td>-->
<!--        <td>0000-00 00:00:00</td>-->
<!--        <td>0000-00 00:00:00</td>-->
<!--        <td>4</td>-->
<!--        <td></td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>WANG</td>-->
<!--        <td>Yuchen</td>-->
<!--        <td>wangyc32@gmail.com</td>-->
<!--        <td>wangy</td>-->
<!--        <td>0000-00 00:00:00</td>-->
<!--        <td>0000-00 00:00:00</td>-->
<!--        <td>1</td>-->
<!--        <td></td>-->
<!--    </tr>-->
    </tbody>
</table>
<form id="delete-form" method="POST" action="?controller=utilisateur&action=supprimer">
<!--    <input type="hidden" name="controller" value="utilisateur"/>-->
<!--    <input type="hidden" name="action" value="supprimer"/>-->
</form>
<form id="edit-form" method="POST" action="?controller=utilisateur&action=editer">
<!--    <input type="hidden" name="controller" value="utilisateur"/>-->
<!--    <input type="hidden" name="action" value="editer"/>-->
</form>

