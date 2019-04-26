<?php
include "../../entities/chanteur.php";
include "../../core/chanteurC.php";
$chanteurC=new chanteurC();
$id=$_POST["id"];
$nom=$_POST["nom"];
$type=$_POST["type"];
$image=$_FILES["img"];


// upload image
 $folder = "" ;
 if (!empty($_FILES)) {
	$file = $_FILES['img'];
	if ($file['name'] != '') {
		$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
		$extensions = array("jpg","png");
		if (in_array($ext, $extensions)) {
			$name_p = $file['name'];
			$path = "/img".$name_p;
			if (move_uploaded_file($file['tmp_name'], $path)) {
				$folder = $name_p;
			}
		}
	}
}


$chanteur=new chanteur($id, $nom,$type,$folder);
      var_dump($chanteur);

	  $chanteurC->ajouterchanteur($chanteur);

	

	header('Location: formulaireafficher.php');






	
	?>

