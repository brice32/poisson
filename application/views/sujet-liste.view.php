<?php
/**
 * Created by PhpStorm.
 * User: wangy
 * Date: 05/01/2017
 * Time: 14:49
 */
namespace Poisson;
defined('Poisson') or die('Acces interdit');
//$this->addStyleSheet();
?>

    <div class="container">
        <div>
            <h1>Liste De Evenement</h1>
            <button class=""><a href="?controller=enligne&action=ajouterevenement">Ajouter une evenement</a></button>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Titre</th>
                    <th>Lieu</th>
                    <th>Date</th>
                    <th>Modif/Suppr</th>
                </tr>
                </thead>
                <tbody>


                <tr>
                    <td>Le rechercher WEB</td>
                    <td>paris</td>
                    <td>2018-03-08</td>
                    <td>
                        <form method="GET" action="#">
                            <input type="hidden" name="controller" value="enligne"/>
                            <input type="hidden" name="action" value="editer"/>
                            <input type="hidden" name="num_evenement" value="2"/>
                            <button class="btn btn-primary btn-xs"><span
                                        class="glyphicon glyphicon-sm glyphicon-edit"></span></button>

                        </form>
                    </td>
                </tr>

                <tr>
                    <td>Le Rechercher BDD</td>
                    <td>paris</td>
                    <td>2016-04-19</td>
                    <td>
                        <form method="GET" action="#">
                            <input type="hidden" name="controller" value="enligne"/>
                            <input type="hidden" name="action" value="editer"/>
                            <input type="hidden" name="num_evenement" value="3"/>
                            <button class="btn btn-primary btn-xs"><span
                                        class="glyphicon glyphicon-sm glyphicon-edit"></span></button>

                        </form>
                    </td>
                </tr>

                <tr>
                    <td>test01</td>
                    <td>test01</td>
                    <td>2016-04-27</td>
                    <td>
                        <form method="GET" action="#">
                            <input type="hidden" name="controller" value="enligne"/>
                            <input type="hidden" name="action" value="editer"/>
                            <input type="hidden" name="num_evenement" value="5"/>
                            <button class="btn btn-primary btn-xs"><span
                                        class="glyphicon glyphicon-sm glyphicon-edit"></span></button>

                        </form>
                    </td>
                </tr>

                <tr>
                    <td>EI WEB</td>
                    <td>Limoges</td>
                    <td>2016-04-25</td>
                    <td>
                        <form method="GET" action="#">
                            <input type="hidden" name="controller" value="enligne"/>
                            <input type="hidden" name="action" value="editer"/>
                            <input type="hidden" name="num_evenement" value="7"/>
                            <button class="btn btn-primary btn-xs"><span
                                        class="glyphicon glyphicon-sm glyphicon-edit"></span></button>

                        </form>
                    </td>
                </tr>

                <tr>
                    <td>test02</td>
                    <td>test02</td>
                    <td>2016-07-13</td>
                    <td>
                        <form method="GET" action="#">
                            <input type="hidden" name="controller" value="enligne"/>
                            <input type="hidden" name="action" value="editer"/>
                            <input type="hidden" name="num_evenement" value="8"/>
                            <button class="btn btn-primary btn-xs"><span
                                        class="glyphicon glyphicon-sm glyphicon-edit"></span></button>

                        </form>
                    </td>
                </tr>
                </tbody>


            </table>
        </div>

    </div>



