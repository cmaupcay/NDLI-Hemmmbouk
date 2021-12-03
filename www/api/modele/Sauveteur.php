<?php
include_once __RACINE__ . 'modele/ModeleBD.php';
include_once __RACINE__ . 'modele/Article.php';

    class Sauveteur extends ModeleBD
    {
	public $article;
        public function informations(): array
        { return ['id', 'nomSauveteur', 'prenomSauveteur', 'Poste', 'idArticle']; }
		public function table() : string { return 'sauveteur'; }

        public function __construct(?int $id = null, ?BD &$bd = null)
        { 
            parent::__construct($id, $bd);
	        $this->article = new Article($this->idArticle, $bd);
	    }
		
        
        private $_nomSauveteur;
        public function nomSauveteur() : ?string { return $this->_nomSauveteur; }
        public function modifier_nomSauveteur(?string $valeur) { $this->_nomSauveteur = $valeur; }
		
		private $_prenomSauveteur;
        public function prenomSauveteur() : ?string { return $this->_prenomSauveteur; }
        public function modifier_prenomSauveteur(?string $valeur) { $this->_prenomSauveteur = $valeur; }
		
		private $_Poste;
        public function Poste() : ?string { return $this->_Poste; }
        public function modifier_Poste(?string $valeur) { $this->_Poste = $valeur; }
		
	    private $_idArticle;
        public function idArticle() : ?int { return $this->_idArticle; }
        public function modifier_idArticle(?int $valeur) { $this->_idArticle = $valeur; }
    }
?>
