<?php
include_once __RACINE__ . 'modele/ModeleBD.php';

    class Article extends ModeleBD
    {
        public function informations(): array
        { return ['id', 'texte', 'image', 'categorie', 'dateCreation', 'dateMAJ']; }
		public function table() : string { return 'article'; }

        public function __construct(?int $id = null, ?BD &$bd = null)
        { parent::__construct($id, $bd); }
		
        
        private $_categorie;
        public function categorie() : ?string { return $this->_categorie; }
        public function modifier_categorie(?string $valeur) { $this->_categorie = $valeur; }
		
		private $_dateCreation;
        public function dateCreation() : ?string { return ($this->_dateCreation === null) ? null : $this->_dateCreation->format('Y-m-d'); }
		public function DT_dateCreation() : ?DateTime { return $this->_dateCreation; }
        public function modifierDateCreation(?string $valeur) { $this->_dateCreation = new DateTime($valeur); }
		
		private $_dateMAJ;
        public function dateMAJ() : ?string { return ($this->_dateMAJ === null) ? null : $this->_dateMAJ->format('Y-m-d'); }
		public function DT_dateMAJ() : ?DateTime { return $this->_dateMAJ; }
        public function modifierdateMAJ(?string $valeur) { $this->_dateMAJ = new DateTime($valeur); }
		
		private $_texte;
        public function texte() : ?array { return $this->_texte; }
        public function modifier_texte(?string $valeur) { $this->_texte = json_decode($valeur, true); }
		
		private $_image;
        public function image() : ?array { return $this->_image; }
        public function modifier_image(?string $valeur) { $this->_image = json_decode($valeur, true); }
    }
