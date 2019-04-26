<?php
	
	class utilisateur
	{
        private $id_utilisateur;
        private $nom;
        private $prenom;
		private $login;
		private $password;
        private $email;


		function __construct($nom,$email,$password){
		
		$this->nom=$nom;
		
        $this->password=$password;
        $this->email=$email;
	
	}
		
public function get_id_utilisateur()
		{
			return $this->id_utilisateur;
		}

		public function set_id_utilisateur($id_utilisateur)
		{
			$this->id_utilisateur = $id_utilisateur;
		}


		public function get_nom()
		{
			return $this->nom;
		}

		public function set_nom($nom)
		{
			$this->nom = $nom;
		}
		public function get_prenom()
		{
			return $this->prenom;
		}

		public function set_prenom($prenom)
		{
			$this->prenom = $prenom;
		}
		public function get_login(){return $this->login;}

		public function set_login($login)
		{
			$this->login = $login;
		}
        public function get_password(){return $this->password;}

		public function set_password($password)
		{
			$this->password = $password;
        }
        public function get_email(){return $this->email;}

		public function set_email($email)
		{
			$this->email = $email;
		}

	}
?>