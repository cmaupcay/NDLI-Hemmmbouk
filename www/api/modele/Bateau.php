<?php
include_once __RACINE__ . 'modele/ModeleBD.php';
include_once __RACINE__ . 'modele/Article.php';

    class Bateau extends ModeleBD
    {
	public $article;
        public function informations(): array
        { return ['idBateau', 'nomBateau']; }
		public function table() : string { return 'bateau'; }

        public function __construct(?int $id = null, ?BD &$bd = null)
        { parent::__construct($id, $bd);
	  $this->article = new Article();
	}
		
        
        private $nomBateau;
        public function nomBateau() : ?string { return $this->nomBateau; }
        public function modifier_nomBateau(?string $valeur) { $this->nomBateau = $valeur; }
?>
