<?php
include_once __RACINE__ . 'modele/ModeleBD.php';
include_once __RACINE__ . 'modele/Article.php';

    class Bateau extends ModeleBD
    {
	    public $article;
        public function informations(): array
        { return ['id', 'nomBateau', 'idArticle']; }
		public function table() : string { return 'bateau'; }

        public function __construct(?int $id = null, ?BD &$bd = null)
        { 
            parent::__construct($id, $bd);
	        $this->article = new Article($this->idArticle, $bd);
    	}
		
        private $_nomBateau;
        public function nomBateau() : ?string { return $this->_nomBateau; }
        public function modifier_nomBateau(?string $valeur) { $this->_nomBateau = $valeur; }
        
        private $_idArticle;
        public function idArticle() : ?int { return $this->_idArticle; }
        public function modifier_idArticle(?int $valeur) { $this->_idArticle = $valeur; }
    }
