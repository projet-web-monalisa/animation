<?php
include_once "config.php";
	class UtilisateurC
	{
		function ajouterutilisateur($chanteur)
   		{    

   			$sql="insert into utilisateur (nom, email, password) VALUES (
				    :nom, :email,:password)";
   			$db = config::getConnexion();
   			try{
   				$req=$db->prepare($sql);

   			
   				$nom=$chanteur->get_nom();
   				$email=$chanteur->get_email();
   				$password=$chanteur->get_password();



   				
				$req->bindValue(':nom', $nom);
				$req->bindValue(':email', $email);
				$req->bindValue(':password', $password);
			
				$req->execute();


   			}
        	catch (Exception $e){
        		echo 'Erruer: ' .$e->getMessage();
        	}			
       }
     

		public function verifierLogin($login,$password)
		{
			$db = config::getConnexion();
			$sql = 'SELECT COUNT(*) AS count,login,password FROM utilisateur WHERE login = :login AND password = :password AND role = 1 LIMIT 1';
			$req = $db->prepare($sql);
			$req->bindValue(':login',$login);
			$req->bindValue(':password',$password);
			$req->execute();
			$result = $req->fetch(PDO::FETCH_OBJ);
			return $result;
		}

		public function verifierLoginFront($login,$password)
		{
			$db = config::getConnexion();
			$sql = 'SELECT COUNT(*) AS count,login,password,id_utilisateur,nom,prenom,email FROM utilisateur WHERE login = :login AND password = :password LIMIT 1';
			$req = $db->prepare($sql);
			$req->bindValue(':login',$login);
			$req->bindValue(':password',$password);
			$req->execute();
			$result = $req->fetch(PDO::FETCH_OBJ);
			return $result;
		}
		public function rechercherMail($idUtilisateur)
		{
			$db = config::getConnexion();
			$sql='select email from utilisateur where id_utilisateur=:ID';
			$req = $db->prepare($sql);
			$req->bindValue(':ID',$idUtilisateur);
			$req->execute();
			return $req;

		}


	}

		


 ?>