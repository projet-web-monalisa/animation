<?PHP
include "config.php";
class TroupeC {


	function ajouterTroupe($troupe)
	{    

		$sql="insert into troupe (id, nom, type,image) VALUES (:id, :nom, :type,:image)";
		$db = config::getConnexion();
		try{
			$req=$db->prepare($sql);

			$id=$troupe->get_id();
			$nom=$troupe->get_nom();
			$type=$troupe->get_type();
			$image=$troupe->get_image();



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
	
	
	function afficherTroupe(){
		$sql="SElECT * From troupe";
		$c = config::getConnexion();
		return ($c->query($sql));
	}
	function supprimerTroupe($id){
		
		$sql="DELETE FROM troupe where id= :id";
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
	function modifierTroupe($troupe){
		$c = config::getConnexion();
		try{
		$stmt=$c->prepare("UPDATE troupe SET nom=:nom,type=:type ,image=:image where id=:id");
		
		$stmt->bindValue(":nom",$troupe->get_nom());
		$stmt->bindValue(":type",$troupe->get_type());
		$stmt->bindValue(":image",$troupe->get_image());
		$stmt->bindValue(":id",$troupe->get_id());
		$stmt->execute();
		
		}
		catch (Exception $e){
        		echo 'Erruer: ' .$e->getMessage();
        	}
	}
	function recupererTroupe($id){
        $sql="SELECT * from troupe where id= $id";
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
	
	function recherchertroupe($HI){
        $sql="SELECT * from troupe where nom LIKE '%$HI%' or type LIKE '%$HI%' or id LIKE '%$HI%'";
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
	function Number()
    {
        $sql="SELECT COUNT(id) as QTE FROM troupe";
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
	function triertroupe(){
        $sql="select * From troupe Order by nom ASC";
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
}

?>