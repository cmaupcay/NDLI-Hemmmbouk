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
	        $this->article = new Article($this->idArticle, $bd);
	    }
		
        private $date;
        public function date() : ?string { return ($this->date === null) ? null : $this->date->format('Y-m-d'); }
		public function DT_date() : ?DateTime { return $this->date; }
        public function modifierdate(?string $valeur) { $this->date = new DateTime($valeur); }
      
        private $nomBateau;
        public function nomBateau() : ?string { return $this->nomBateau; }
        public function modifier_nomBateau(?string $valeur) { $this->nomBateau = $valeur; }

        private $idArticle;
        public function idArticle() : ?int { return $this->idArticle; }
        public function modifier_idArticle(?int $valeur) { $this->idArticle = $valeur; }
    }
?>
