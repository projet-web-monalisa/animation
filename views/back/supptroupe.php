<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 29/03/2019
 * Time: 19:47
 */

include "../../core/TroupeC.php";


$plat=new TroupeC();
var_dump($_GET['id']+0);

    $plat->supprimerTroupe($_GET['id']+0);

    header('Location: formulaireaffichertroupe.php');

?>