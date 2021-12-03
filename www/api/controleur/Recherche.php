<?php
    require_once __RACINE__ . 'controleur/Controleur.php';
    require_once __RACINE__ . 'modele/Bateau.php';
    require_once __RACINE__ . 'modele/Sauveteur.php';
    require_once __RACINE__ . 'modele/Sortie.php';
    require_once __RACINE__ . 'modele/Victime.php';

    class Recherche extends Controleur
    {
        public function informations(): array { return []; }
        public function executer(array &$server, array &$session, array &$post, array &$get, array &$params, BD &$_BD, Authentification &$_AUTH, Routeur &$_ROUTEUR, ?JetonAuthentification &$_JETON = null)
        {
            if (isset($post[REC_REQUETE]))
                $params[REC_REPONSE] = self::rechercher($post[REC_REQUETE], $_BD);
            else if (isset($params[REC_REQUETE]))
                $params[REC_REPONSE] = self::rechercher($params[REC_REQUETE], $_BD);
        }

        static public function rechercher(string $requete, BD &$_BD) : array
        {
            $res = [];

            $res[BATEAU] = (new Bateau())->selection($_BD, null, 'nomBateau LIKE "' . $requete . '"');
            $res[SAUVETEUR] = (new Sauveteur())->selection($_BD, null, '(nomSauveteur LIKE "' . $requete . '" OR prenomSauveteur LIKE "' . $requete . '" OR Poste LIKE "' . $requete . '")');
            $res[SORTIE] = (new Sortie())->selection($_BD, null);
            foreach ($res[SORTIE] as $i => $e)
                foreach ($e->infos() as $val)
                    if (!str_contains($val, $requete))
                    {
                        unset($res[SORTIE][$i]);
                        break;
                    }
            $res[VICTIME] = (new Victime())->selection($_BD, null, '(nomVictime LIKE "' . $requete . '" OR prenomVictime LIKE "' . $requete . '")');

            return $res;
        }
    }