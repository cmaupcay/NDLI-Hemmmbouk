<?php
    require_once __RACINE__ . 'controleur/Controleur.php';
    require_once __RACINE__ . 'modele/Sortie.php';

    class URI_Sortie extends Controleur
    {
        public function executer(array &$server, array &$session, array &$post, array &$get, array &$params, BD &$_BD, Authentification &$_AUTH, Routeur &$_ROUTEUR, ?JetonAuthentification &$_JETON = null)
        {
            if (isset($params[URI]))
            {
                switch (count($params[URI]))
                {
                    case 1: // Afficher la liste des victimes renseignée dans l'URI
                        $sorties = (new Sortie())->selection($_BD, null, 'marque = \'' . $params[URI][0] . '\' AND dispo = true');
                        if (count($sorties) > 0)
                        {
                            foreach ($sorties as $v)
                                if (!$v->est_loue($_BD)) $params[SORTIE][] = $v;
                        }
                        else $_ROUTEUR->redirection('sorties');
                        $params[NOM_PAGE] = $params[URI][0];
                        break;
                    case 2: // Afficher la victime désigné dans l'URI (<marque>/<modele>/)
                        $sorties = (new Sortie())->selection(
                            $_BD, null, 'marque = \'' . $params[URI][0] . '\' AND modele = \'' . $params[URI][1] . '\''
                        );
                        if (count($sorties) === 1) $params[SORTIE] = $sorties[0];
                        else $_ROUTEUR->redirection('sorties/' . $params[URI][0]);
                        $params[NOM_PAGE] = $params[URI][0] . ' ' . $params[URI][1];
                        break;
                    default:
                        break;
                }
            } // Afficher la liste de toutes les victimes
            else
            {
                $sorties = (new Sortie())->selection($_BD, null);
                if (count($sorties) > 0)
                {
                    foreach ($sorties as $v)
                        if (!$v->est_loue($_BD)) $params[SORTIE][] = $v;
                }
            }
        }
    }
?>
