<?php
include_once __RACINE__ . 'modele/ModeleBD.php';

    class Admin extends ModeleBD
    {
        public function informations(): array
        { return ['id', 'pseudo']; }
		public function table() : string { return 'admin'; }

        public function __construct(?int $id = null, ?BD &$bd = null)
        { parent::__construct($id, $bd); }
		
        public function mdp(BD &$bd, string $param = 'id') : ?string
        {
            $res = $bd->executer(
                "SELECT mdp FROM " . $this->table() . " WHERE $param = :$param",
                [$param => $this->{$param}()]
            );
            if (isset($res[0], $res[0]['mdp']))
                return $res[0]['mdp'];
            return null;
        }
        
		private $_pseudo;
        public function pseudo() : ?string { return $this->_pseudo; }
        public function modifier_pseudo(?string $valeur) { $this->_pseudo = $valeur; }
    }