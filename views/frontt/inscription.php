<?php include "../../entities/utilisateur.php";
include "../../core/utilisateurC.php";


if ( isset($_POST['nom']) and isset($_POST['email']) and isset($_POST['password'])){

	
	$chanteur1C=new UtilisateurC();

	
$chanteur1=new utilisateur($_POST['nom'],$_POST['email'],$_POST['password']);

$chanteur1C->ajouterutilisateur($chanteur1);


	header('Location: ../../views/frontt/login_register.html');
		alert("chanteur Ajouté");





	}
	else{
	echo "verifier les champs"; 
}
?>