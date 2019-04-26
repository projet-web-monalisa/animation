<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 29/03/2019
 * Time: 19:47
 */

include "../../core/chanteurC.php";


$plat=new chanteurC();
var_dump($_GET['id']+0);

    $plat->supprimer_chanteur($_GET['id']+0);

    header('Location: formulaireafficher.php');

?>