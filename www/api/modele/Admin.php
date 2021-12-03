<?php
include_once __RACINE__ . 'modele/ModeleBD.php';

    class Admin extends ModeleBD
    {
        public function informations(): array
        { return ['id', 'mdp', 'pseudo']; }
		public function table() : string { return 'admin'; }

        public function __construct(?int $id = null, ?BD &$bd = null)
        { parent::__construct($id, $bd); }
		
        private $_mdp;
        public function mdp() : ?string { return $this->_mdp; }
        public function modifier_mdp(?string $valeur) { $this->_mdp = $valeur; }
		
		private $_pseudo;
        public function pseudo() : ?string { return $this->_pseudo; }
        public function modifier_pseudo(?string $valeur) { $this->_pseudo = $valeur; }
    }