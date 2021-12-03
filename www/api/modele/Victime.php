<?php
include_once 'modele/ModeleBD.php';

    class Victime extends ModeleBD
    {
	public $article;
        public function informations(): array
        { return ['idVictime', 'nomVictime', 'prenomVictime', 'age', 'sexe', 'decede', 'idSortie', 'idArticle]; }
		public function table() : string { return 'sauve'; }

        public function __construct(?int $id = null, ?BD &$bd = null)
        { parent::__construct($id, $bd);
	  $this->article = new Article();
	  }
		
        
        private $nomVictime;
        public function nomVictime() : ?string { return $this->nomVictime; }
        public function modifier_nomVictime(?string $valeur) { $this->nomVictime = $valeur; }
		
		private $prenomVictime;
        public function prenomVictime() : ?string { return $this->prenomVictime; }
        public function modifier_prenomVictime(?string $valeur) { $this->prenomVictime = $valeur; }
		
		private $age;
        public function age() : ?int { return $this->age; }
        public function modifier_age(?int $valeur) { $this->age = $valeur; }
		
		private $sexe;
        public function sexe() : ?string { return $this->sexe; }
        public function modifier_sexe(?string $valeur) { $this->sexe = $valeur; }
	
	private $decede;
        public function decede() : ?boolean { return $this->decede; }
        public function modifier_decede(?boolean $valeur) { $this->decede = $valeur; }
	
	private $idSortie;
        public function idSortie() : ?int { return $this->idSortie; }
        public function modifier_idSortie(?int $valeur) { $this->idSortie = $valeur; }
	}
		
?>
