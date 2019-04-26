<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>Envoyer une image</title>
       <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	   <style type="text/css">
		label {
			display:block;
			width:150px;
			float:left;
		}
	   </style>
   </head>
   <body>
 
<?php
  if(isset($_POST['validation'])) {
 
	 //Indique si le fichier a été téléchargé
	 if(!is_uploaded_file($_FILES['image']['tmp_name']))
		echo 'Un problème est survenu durant l opération. Veuillez réessayer !';
	 else {
		//liste des extensions possibles    
		$extensions = array('/png', '/gif', '/jpg', '/jpeg');
 
		//récupère la chaîne à partir du dernier / pour connaître l'extension
		$extension = strrchr($_FILES['image']['type'], '/');
 
		//vérifie si l'extension est dans notre tableau            
		if(!in_array($extension, $extensions))
			echo 'Vous devez uploader un fichier de type png, gif, jpg, jpeg.';
		else {         
 
			//on définit la taille maximale
			define('MAXSIZE', 300000);        
			if($_FILES['image']['size'] > MAXSIZE)
			   echo 'Votre image est supérieure à la taille maximale de '.MAXSIZE.' octets';
			else {
				//connexion à la base de données
				try {
					$bdd = new PDO('mysql:host=localhost;dbname=site', 'root', '');
				} catch (Exception $e) {
					exit('Erreur : ' . $e->getMessage());
				}
 
				//Lecture du fichier
				$image = file_get_contents($_FILES['image']['tmp_name']);
 
				$req = $bdd->prepare("INSERT INTO images(nom, description, img, extension) VALUES(:nom, :description, :image, :type)");
				$req->execute(array(
					'nom' => $_POST['nom'],
					'description' => $_POST['description'],
					'image' => $image,
					'type' => $_FILES['image']['type']
					));
 
				echo 'L\'insertion s est bien déroulée !';
			 }
		  }
	  }
  }
?>
 
	<h1>Envoyer une image</h1>
	<form enctype="multipart/form-data" action="traitement.php" method="post">
		<p>
			<label for="nom">Nom : </label><input type="text" name="nom" id="nom" /><br />
			<label for="description">Description : </label><textarea name="description" id="description" rows="10" cols="50"></textarea><br />
			<label for="image">Image : </label><input type="file" name="image" id="image" /><br />
			<label for="validation">Valider : </label><input type="submit" name="validation" id="validation" value="Envoyer" />
		</p>
	</form>
</body>
</html>