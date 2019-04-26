<?php
include_once 'config.php';
if(isset($_GET['motclef']))
{
	$motclef=($_GET['motclef'];
		$q=array('motclef'=>$motclef. '%');
		$cnx = config::getConnexion();
		$sql='SELECT nom,type from chanteur where nom like :motclef or type like :motclef ';
		$req=$cnx->prepare($sql);
		$req->execute($q);
		$count=$req->rowCount($sql);
		if($count==1){
			while($result = $req->fetch(PDO::FETCH_OBJ)){
				echo "nom :".$result->nom."<br/>nom:".$result->nom;
			}
		}
		else
			{echo"aucun resultat pour ".$motclef ;}

}

?>