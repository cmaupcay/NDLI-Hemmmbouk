<?php
    require_once __RACINE__ .  'controleur/general/Vues.php';
    require_once __RACINE__ .  'controleur/general/Routeur.php';
    require_once __RACINE__ .  'controleur/general/Authentification.php';

    $_SERVER['SERVER_ADDR'] = 'hemmmbouk.vercel.app';

    class App extends _Controleur
    {
        public function informations(): array
        { return [
            'debug', 'vue_erreur', 'vue_debug',
            'ini_bd', 'ini_routeur', 'ini_auth', 'ini_vues'
        ]; }

        /// PARAMETRES
        // Mode de déboguage (mode production OU développement)
        private $_debug;
        public function debug() : bool { return $this->_debug; }
        protected function modifier_debug(bool $valeur) { $this->_debug = $valeur; }
        // Vue d'affichage des erreurs fatales (mode production)
        protected $_vue_erreur;
        public function vue_erreur() : string { return $this->_vue_erreur; }
        // Vue d'affichage des erreurs fatales (mode développement)
        protected $_vue_debug;
        public function vue_debug() : string { return $this->_vue_debug; }

        /// CONTROLEURS CENTRAUX
        // Base de données
        protected $_ini_bd;
        private $_bd;
        public function bd() : BD { return $this->_bd; }
        // Routeur
        protected $_ini_routeur;
        private $_routeur;
        public function routeur() : Routeur { return $this->_routeur; }
        // Authentification
        protected $_ini_auth;
        private $_auth;
        public function auth() : Authentification { return $this->_auth; }
        // Vues
        protected $_ini_vues;
        private $_vues;
        public function vues() : Vues { return $this->_vues; }

        public function __construct(string $fichier_ini)
        {
            // Chargement des parametres depuis le fichier $fichier_ini
            parent::__construct($fichier_ini);
            // Initialisation des controleurs centraux depuis les fichiers ini définis dans le fichier $fichier_ini
            $this->_bd = new BD($this->_ini_bd);
            $this->_auth = new Authentification($this->_ini_auth);
            $this->_routeur = new Routeur($this->_ini_routeur);
            $this->_vues = new Vues($this->_ini_vues);   
        }

        public function proceder(array &$server, array &$session, array &$post, array &$get, array &$cookie)
        {
            try 
            {
                $_PARAMS = [
                    TEXT => [
                        NAV => [
                            RECHERCHE_PH => "Rechercher", 
                            MENU => [
                                ['Accueil', 'fas fa-home', "https://". $_SERVER['SERVER_ADDR']],
                                ['Sauveteurs', 'fab fa-watchman-monitoring', "https://" . $_SERVER['SERVER_ADDR'] . "/sauveteurs/"],
                                ['Victimes', 'fas fa-baby', "https://" . $_SERVER['SERVER_ADDR'] . '/victimes/'],
                                ['Bateaux', 'fas fa-ship', "https://" . $_SERVER['SERVER_ADDR'] . '/bateaux/'],
                                ['Mots-croisés', 'fas fa-border-top', "https://" . $_SERVER['SERVER_ADDR'] . '/jeu/']
                            ]
                        ]
                    ]
                ]; // Tableau des paramètres passés à la vue et partagé entre les controleurs

                
                if (isset($post[LANGUE])) $session[LANGUE] = $post[LANGUE];
                else $session[LANGUE] = 'fr';

                // Récupèration du jeton d'authentification
                $_JETON = $this->_auth->jeton($session, $post, $cookie, $server['REMOTE_ADDR'], $this->_bd);   
                // Définition de la vue selon l'URI
                $vue = $this->_routeur->definir_vue($server['REQUEST_URI'], $_PARAMS);
                // Vérification des droits d'accès de l'utilisateur sur la vue définie
                $vue = $this->_auth->verifier_droits($vue, $_JETON, $this->_routeur);
                // Chargement les controleurs liés à la vue défine précedemment
                $controleurs = $this->_routeur->charger_controleurs($vue);
                // Conversion des données de formulaire : permet de gérer les accents
                foreach ($post as &$v) $v = utf8_decode($v);
                // Execution du code des controleurs
                foreach ($controleurs as $c)
                    $c->executer(
                        $server, $session, $post, $get, $_PARAMS,
                        $this->_bd, $this->_auth, $this->_routeur, $_JETON
                    );
                    
                $trad = new Traduction("ini/trad.ini");
                $trad->traduire_page($session, $_PARAMS[TEXT]);
                $_PARAMS[LANGUE] = $trad->langues();

                if (isset($post[DARK_MODE]))
                {
                    if (isset($session[DARK_MODE])) unset($session[DARK_MODE]);
                    else $session[DARK_MODE] = true;
                }
                if (isset($session[DARK_MODE])) $_PARAMS[DARK_MODE] = true;
                // Chargement de la vue (n'a accès qu'au jeton d'authentification et au tableau de paramètres)
                $this->_vues->charger($vue, $post, $get, $_JETON, $_PARAMS);
            }
            // Affichage des erreurs non gérées (erreurs fatales)
            catch (\Throwable $e) 
            {
                // Chargement de la page d'erreur fatale
                if ($this->debug())
                // Mode déboguage
                    $this->_vues->charger($this->_vue_debug, $post, $get, null, [$e]);
                // Mode production
                else $this->_vues->charger($this->_vue_erreur, $post, $get, null, [$e]);
            }
        }
    }