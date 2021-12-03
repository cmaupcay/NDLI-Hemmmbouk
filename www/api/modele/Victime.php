<?php
include_once __RACINE__ . 'modele/ModeleBD.php';
include_once __RACINE__ . 'modele/Article.php';

    class Victime extends ModeleBD
    {
	    public $article;
        public function informations(): array
        { return ['id', 'nomVictime', 'prenomVictime', 'age', 'sexe', 'decede', 'idSortie', 'idArticle']; }
		public function table() : string { return 'victime'; }

        public function __construct(?int $id = null, ?BD &$bd = null)
        {
            parent::__construct($id, $bd);
	        $this->article = new Article($this->_idArticle, $bd);
	    }
        
        private $_nomVictime;
        public function nomVictime() : ?string { return $this->_nomVictime; }
        public function modifier_nomVictime(?string $valeur) { $this->_nomVictime = $valeur; }
		
		private $_prenomVictime;
        public function prenomVictime() : ?string { return $this->_prenomVictime; } 
        public function modifier_prenomVictime(?string $valeur) { $this->_prenomVictime = $valeur; }
		
		private $_age;
        public function age() : ?int { return $this->_age; }
        public function modifier_age(?int $valeur) { $this->_age = $valeur; }
		
		private $_sexe;
        public function sexe() : ?string { return $this->_sexe; }
        public function modifier_sexe(?string $valeur) { $this->_sexe = $valeur; }
	
        private $_decede;
        public function decede() : ?bool { return $this->_decede; }
        public function modifier_decede(?bool $valeur) { $this->_decede = $valeur; }
	
        private $_idSortie;
        public function idSortie() : ?int { return $this->_idSortie; }
        public function modifier_idSortie(?int $valeur) { $this->_idSortie = $valeur; }
        
        private $_idArticle;
        public function idArticle() : ?int { return $this->_idArticle; }
        public function modifier_idArticle(?int $valeur) { $this->_idArticle = $valeur; }
	}
		
?>
