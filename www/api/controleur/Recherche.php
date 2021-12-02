<?php
    require_once __RACINE__ . 'controleur/Controleur.php';

    class Recherche extends Controleur
    {
        public function informations(): array { return []; }
        public function executer(array &$server, array &$session, array &$post, array &$get, array &$params, BD &$_BD, Authentification &$_AUTH, Routeur &$_ROUTEUR, ?JetonAuthentification &$_JETON = null)
        {
            if (isset($params[REC_REQUETE]))
                $params[REC_REPONSE] = self::rechercher($params[REC_REQUETE]);
        }

        static public function rechercher(string $requete) : array
        {

        }
    }