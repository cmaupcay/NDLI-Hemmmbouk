<?php
include_once __RACINE__ . 'modele/ModeleBD.php';
include_once __RACINE__ . 'modele/Article.php';

    class Sortie extends ModeleBD
    {
	public $article;
        public function informations(): array
        { return ['id', 'date', 'infos', 'idArticle']; }
		public function table() : string { return 'sortie'; }

        public function __construct(?int $id = null, ?BD &$bd = null)
        { 
            parent::__construct($id, $bd);
	        $this->article = new Article($this->_idArticle, $bd);
	    }
		
        private $_date;
        public function date() : ?string { return ($this->_date === null) ? null : $this->_date->format('Y-m-d'); }
		public function DT_date() : ?DateTime { return $this->date; }
        public function modifierdate(?string $valeur) { $this->date = new DateTime($valeur); }
      
		private $_infos;
        public function infos() : ?array { return $this->_infos; }
        public function modifier_infos(?string $valeur) { $this->_infos = json_decode($valeur, true); }

        private $_idArticle;
        public function idArticle() : ?int { return $this->_idArticle; }
        public function modifier_idArticle(?int $valeur) { $this->_idArticle = $valeur; }
    }
?>
