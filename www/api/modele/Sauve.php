<?php
include_once 'modele/ModeleBD.php';

    class Sauve extends ModeleBD
    {
        public function informations(): array
        { return ['idSauve', 'nomSauve', 'prenomSauve', 'age', 'sexe', 'idSauveteur']; }
		public function table() : string { return 'sauve'; }

        public function __construct(?int $id = null, ?BD &$bd = null)
        { parent::__construct($id, $bd); }
		
        
        private $nomSauve;
        public function nomSauve() : ?string { return $this->nomSauve; }
        public function modifier_nomSauve(?string $valeur) { $this->nomSauve = $valeur; }
		
		private $prenomSauve;
        public function prenomSauve() : ?string { return $this->prenomSauve; }
        public function modifier_prenomSauve(?string $valeur) { $this->prenomSauve = $valeur; }
		
		private $age;
        public function age() : ?int { return $this->age; }
        public function modifier_age(?int $valeur) { $this->age = $valeur; }
		
		private $sexe;
        public function sexe() : ?string { return $this->sexe; }
        public function modifier_sexe(?string $valeur) { $this->sexe = $valeur; }
		
		private $idSauveteur;
        public function idSauveteur() : ?int { return $this->idSauveteur; }
        public function modifier_idSauveteur(?int $valeur) { $this->idSauveteur = $valeur; }
?>
