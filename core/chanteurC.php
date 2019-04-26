<?php
	include_once "config.php";

	class chanteurC
	{
		function ajouterchanteurr($chanteur)
    {
		$query='insert into chanteur (id, nom, type,image) values( ?, ?,?,?);';
		$conn = config::getConnexion();
        $prep = $conn->prepare($query);
        $prep->bindValue(1, $chanteur->get_id(), PDO::PARAM_INT);
        $prep->bindValue(2, $chanteur->get_nom(), PDO::PARAM_INT);
        $prep->bindValue(3, $chanteur->get_type(), PDO::PARAM_STR);
        $prep->bindValue(4, $chanteur->get_image(), PDO::PARAM_STR);
        
        $prep->execute();
    }
        function ajouterchanteur($chanteur)
   		{    

   			$sql="insert into chanteur (id, nom, type,image) values (:id, :nom, :type,:image)";
   			$db = config::getConnexion();
   			try{
   				$req=$db->prepare($sql);

   				$id=$chanteur->get_id();
   				$nom=$chanteur->get_nom();
				   $type=$chanteur->get_type();
				   $image=$chanteur->get_image();
   				



   				$req->bindValue(':id',$id);
				$req->bindValue(':nom', $nom);
				$req->bindValue(':type', $type);
				$req->bindValue(':image',$image);
			
				$req->execute();


   			}
        	catch (Exception $e){
        		echo 'Erruer: ' .$e->getMessage();
        	}			
       }
     





		function afficherChanteur(){
		$sql="SElECT * From chanteur";
		$c = config::getConnexion();
		return ($c->query($sql));
		
	}
	function affichertype($type)
	{
  		$db = config::getConnexion();
       		$sql="SELECT * FROM chanteur where type=:type order by id  desc";

		try{
 		$req=$db->prepare($sql);
 				$req->bindValue(':type',$type);

 	    $req->execute();
 		$listetache= $req->fetchALL(PDO::FETCH_OBJ);
		return $listetache;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }	
	}


	function modifier_chanteur($chanteur)
	{
		$c = config::getConnexion();
		try{
		$stmt=$c->prepare("UPDATE chanteur SET nom=:nom,type=:type ,image=:image where id=:id");
		
		$stmt->bindValue(":nom",$chanteur->get_nom());
		$stmt->bindValue(":type",$chanteur->get_type());
		$stmt->bindValue(":image",$chanteur->get_image());
		$stmt->bindValue(":id",$chanteur->get_id());
		$stmt->execute();
		
		}
		catch (Exception $e){
        		echo 'Erruer: ' .$e->getMessage();
        	}

	}
	function recupererchanteur($id){
        $sql="SELECT * from chanteur where id= $id";
        $db = config::getConnexion();
        try{
            $sth = $db->prepare($sql);
            $sth->execute();
            $liste = $sth->fetch();
            return $liste;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }
    function rechercherchant($HI){
        $sql="SELECT * from chanteur where nom LIKE '%$HI%' or type LIKE '%$HI%' or id LIKE '%$HI%'";
        $db = config::getConnexion();
        try{
            $sth = $db->prepare($sql);
            $sth->execute();
            $liste = $sth->fetchAll();
            return $liste;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }


	 function rechercherchanteurs($search)
	{
		$db = config::getConnexion();
		$sql = "SELECT * FROM chanteur WHERE MATCH(nom,type) AGAINST(:search IN NATURAL LANGUAGE MODE);";
		
		$req = $db->prepare($sql);
		$req->bindValue(':search',$search);
		$req->execute();
		$result = $req->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}
	function Number()
    {
        $sql="SELECT COUNT(id) as QTE FROM chanteur";
        $db=config::getConnexion();
        try{
            $query=$db->prepare($sql);
            $query->execute();
            $l=$query->fetch();
            return $l;
        }
        catch(Exception $e)
        {
            die('Erreur: '.$e->getMessage());
        }
    }

    function trierchanteur(){
        $sql="select * From chanteur Order by nom ASC";
        $db = config::getConnexion();
        try{
            $sth = $db->prepare($sql);
            $sth->execute();
            $liste = $sth->fetchAll();
            return $liste;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }




function supprimer_chanteur($id)
	{
		$sql="DELETE FROM chanteur where id= :id";
        $db = config::getConnexion();
        $req=$db->prepare($sql);
        $req->bindValue(':id',$id);
        try{
            $req->execute();
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }

	}
	 function findNextAutoIncrementId()
	{
		$db = config::getConnexion();
		$sql = "SELECT auto_increment FROM INFORMATION_SCHEMA.TABLES
				WHERE table_name = 'chanteur' LIMIT 1 OFFSET 1;";
		$req = $db->prepare($sql);
		$req->execute();
		$result = $req->fetch(PDO::FETCH_OBJ);
		return $result;
	}
	 function afficherChanteurPNG()
	{
		$db=Config::getConnexion();
		$sql="SELECT * FROM chanteur WHERE urlImage LIKE '%.png' OR '%.PNG'";
		$req = $db->prepare($sql);
   
		$req->execute();
		$result = $req->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}
	
		function upload($index,$destination,$maxsize=FALSE,$extensions=FALSE)
{
  
     if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return FALSE;
  
     if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return FALSE;
 
     $ext = substr(strrchr($_FILES[$index]['name'],'.'),1);
     if ($extensions !== FALSE AND !in_array($ext,$extensions)) return FALSE;
   
     return move_uploaded_file($_FILES[$index]['tmp_name'],$destination);
}
 function triNom()
	{
		$db = config::getConnexion();
    	$sql = "SELECT * FROM chanteur ORDER BY id ASC;";
		
		$req = $db->prepare($sql);
		$req->execute();
		$result = $req->fetchAll(PDO::FETCH_OBJ);
		return $result;
	
	}
	 function triNomDesc()
	{
		$db = config::getConnexion();
    	$sql = "SELECT * FROM chanteur ORDER BY id DESC;";
		
		$req = $db->prepare($sql);
		$req->execute();
		$result = $req->fetchAll(PDO::FETCH_OBJ);
		return $result;
	
	}
	

  function triNomA()
	{
		$db = config::getConnexion();
    	$sql = " SELECT * FROM chanteur ORDER BY nom ASC";
		
		$req = $db->prepare($sql);
		$req->execute();
		$result = $req->fetchAll(PDO::FETCH_OBJ);
		return $result;
	
	}
  function triNomZ()
	{
		$db = config::getConnexion();
    	$sql = " SELECT * FROM chanteur ORDER BY nom DESC";
		
		$req = $db->prepare($sql);
		$req->execute();
		$result = $req->fetchAll(PDO::FETCH_OBJ);
		return $result;
	
	}
	}
?>
	



	
