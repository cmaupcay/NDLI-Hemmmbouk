<?php
include_once 'modele/ModeleBD.php';

    class Sauveteur extends ModeleBD
    {
	public $article;
        public function informations(): array
        { return ['id', 'nomSauveteur', 'prenomSauveteur', 'Poste', 'idBateau', 'idArticle']; }
		public function table() : string { return 'sauveteur'; }

        public function __construct(?int $id = null, ?BD &$bd = null)
        { 
            parent::__construct($id, $bd);
	        $this->article = new Article($this->idArticle, $bd);
	    }
		
        
        private $nomSauveteur;
        public function nomSauveteur() : ?string { return $this->nomSauveteur; }
        public function modifier_nomSauveteur(?string $valeur) { $this->nomSauveteur = $valeur; }
		
		private $prenomSauveteur;
        public function prenomSauveteur() : ?string { return $this->prenomSauveteur; }
        public function modifier_prenomSauveteur(?string $valeur) { $this->prenomSauveteur = $valeur; }
		
		private $Poste;
        public function Poste() : ?string { return $this->Poste; }
        public function modifier_Poste(?string $valeur) { $this->Poste = $valeur; }
		
		private $idBateau;
        public function idBateau() : ?int { return $this->idBateau; }
        public function modifier_idBateau(?int $valeur) { $this->idBateau = $valeur; }
	    
	    private $idArticle;
        public function idArticle() : ?int { return $this->idArticle; }
        public function modifier_idArticle(?int $valeur) { $this->idArticle = $valeur; }
    }
?>
