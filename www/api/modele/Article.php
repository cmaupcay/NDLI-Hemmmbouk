<?php
include_once 'modele/ModeleBD.php';

    class Article extends ModeleBD
    {
        public function informations(): array
        { return ['idArticle', 'texte', 'image', 'categorie', 'dateCreation', 'dateMAJ']; }
		public function table() : string { return 'article'; }

        public function __construct(?int $id = null, ?BD &$bd = null)
        { parent::__construct($id, $bd); }
		
        
        private $categorie;
        public function categorie() : ?string { return $this->categorie; }
        public function modifier_categorie(?string $valeur) { $this->categorie = $valeur; }
		
		private $dateCreation;
        public function dateCreation() : ?string { return ($this->dateCreation === null) ? null : $this->dateCreation->format('Y-m-d'); }
		public function DT_dateCreation() : ?DateTime { return $this->dateCreation; }
        public function modifierDateCreation(?string $valeur) { $this->DateCreation = new DateTime($valeur); }
		
		private $dateMAJ;
        public function dateMAJ() : ?string { return ($this->dateMAJ === null) ? null : $this->dateMAJ->format('Y-m-d'); }
		public function DT_dateMAJ() : ?DateTime { return $this->dateMAJ; }
        public function modifierdateMAJ(?string $valeur) { $this->dateMAJ = new DateTime($valeur); }
		
		private $texte;
        public function texte() : ?array { return $this->texte; }
        public function modifier_texte(?string $valeur) { $this->texte = json_decode($valeur, true); }
		
		private $image;
        public function image() : ?array { return $this->image; }
        public function modifier_image(?string $valeur) { $this->image = json_decode($valeur, true); }
?>
