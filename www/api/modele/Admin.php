<?php
include_once __RACINE__ . 'modele/ModeleBD.php';

    class Admin extends ModeleBD
    {
        public function informations(): array
        { return ['id', 'mdp', 'pseudo']; }
		public function table() : string { return 'admin'; }

        public function __construct(?int $id = null, ?BD &$bd = null)
        { parent::__construct($id, $bd); }
		
        private $mdp;
        public function mdp() : ?string { return $this->mdp; }
        public function modifier_mdp(?string $valeur) { $this->mdp = $valeur; }
		
		private $pseudo;
        public function pseudo() : ?string { return $this->pseudo; }
        public function modifier_pseudo(?string $valeur) { $this->pseudo = $valeur; }
    }