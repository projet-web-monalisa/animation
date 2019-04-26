<?php

	class chanteur
	{
		private $id;
		private $nom;
		private $type;
		private $image;


		 function __construct($id,$nom,$type,$image){
		$this->id=$id;
		$this->nom=$nom;
		$this->type=$type;
		$this->image=$image;
	
	}
		
public function get_id()
		{
			return $this->id;
		}

		public function set_id($id)
		{
			$this->id = $id;
		}


		public function get_nom()
		{
			return $this->nom;
		}

		public function set_nom($nom)
		{
			$this->nom = $nom;
		}
		public function get_type()
		{
			return $this->type;
		}

		public function set_type($type)
		{
			$this->type = $type;
		}
		public function get_image(){return $this->image;}

		public function set_image($image)
		{
			$this->image = $image;
		}
	

	}
?>