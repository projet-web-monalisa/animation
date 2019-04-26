<?php
include "../../entities/Troupe.php";
include "../../core/TroupeC.php";
$troupeC=new TroupeC();
$id=$_POST["id"];
$nom=$_POST["nom"];
$type=$_POST["type"];
//$image=$_FILES["image"];

// upload image
$image = "" ;
if (!empty($_FILES)) {
	$file = $_FILES['image'];
	if ($file['name'] != '') {
		$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
		$extensions = array("jpg","png");
		if (in_array($ext, $extensions)) {
			$name_p = $file['name'];
			$path = "img/".$name_p;
			if (move_uploaded_file($file['tmp_name'], $path)) {
				$image = $name_p;
			}
		}
	}
}


$troupe=new Troupe($id, $nom, $type,$image);
      //var_dump($troupe);

	  $troupeC->ajouterTroupe($troupe);

	
	$troupeC=new TroupeC();
	header('Location:formulaireaffichertroupe.php');
	
	?>

