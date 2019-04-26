<?php
   include '../../entities/chanteur.php';
	require '../../core/chanteurC.php';
    if(isset($_POST["search"]))

{	
  $search=$_POST['search'];
	
	header("location: fafficherchanteurFront.php?search=$search");}
	else  {
		echo "erreur";
	}
	

?>