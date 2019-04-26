<?php
include_once 'config.php';
include '../entities/chanteur.php';
require '../core/chanteurC.php';
if(isset($_POST["search"]))

  {	//$produit=new produit(/*$_POST['idProduit'],*/$_POST['nom'],$_POST['description'],$_POST['prix'],$_POST['promotion'],$_POST['quantite'],$_POST['prixPromotion'],$_POST['urlImage'],$_POST['idProduitsCategorie'],$_POST['idPromotion']);

	//var_dump($produit);
  $search=$_POST['search'];
	
	header("location: formulaireafficher.php?search=$search");}
	else  {
		echo "erreur";
	}

?>