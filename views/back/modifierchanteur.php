<?php
include "../../entities/chanteur.php";
include "../../core/chanteurC.php";

$platc = new chanteurC();
if (isset($_POST["Modifier"])) {


 
    $nom = $_POST["nom"];
    $type = $_POST["type"];
    
    $image = $_FILES["image"];
    
    $message = "";
    if ($nom == "") {
        $message = "chanteur  Name must be filled ";
    } else if ($type == "") {
        $message = "chanteur type must be filled ";
    } 
    else {
        if (isset($image["tmp_name"]) && $image["tmp_name"] != "") {

            $filePath = "img/" . basename($image["name"]);
            move_uploaded_file($image["tmp_name"], $filePath);
        }

        $message = "successfully edited  new chanteur";
    }
    $_SESSION["message"] = $message;


    var_dump($_GET['id'] + 0);
    var_dump($nom);
    $p = new chanteur($_GET['id'],$nom, $type, $image['name']);
    var_dump($p);

    $platc->modifier_chanteur($p, (int)$_GET["id"]);
} else {
    echo "vous devez selectionée un chanteur !!!";
}

header('Location:formulaireafficher.php');

?>
