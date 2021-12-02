<?php
include_once 'modele/ModeleBD.php';

    class Bateau extends ModeleBD
    {
        public function informations(): array
        { return ['idBateau', 'nomBateau']; }
		public function table() : string { return 'bateau'; }

        public function __construct(?int $id = null, ?BD &$bd = null)
        { parent::__construct($id, $bd); }
		
        
        private $nomBateau;
        public function nomBateau() : ?string { return $this->nomBateau; }
        public function modifier_nomBateau(?string $valeur) { $this->nomBateau = $valeur; }
?>
