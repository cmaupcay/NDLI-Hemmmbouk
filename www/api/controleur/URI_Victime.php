<?php
    require_once __RACINE__ . 'controleur/Controleur.php';
    require_once __RACINE__ . 'modele/Victime.php';

    class URI_Victime extends Controleur
    {
        public function executer(array &$server, array &$session, array &$post, array &$get, array &$params, BD &$_BD, Authentification &$_AUTH, Routeur &$_ROUTEUR, ?JetonAuthentification &$_JETON = null)
        {
            if (isset($params[URI]))
            {
                switch (count($params[URI]))
                {
                    case 1: // Afficher la liste des victimes renseignée dans l'URI
                        $victimes = (new Victime())->selection($_BD, null, 'marque = \'' . $params[URI][0] . '\' AND dispo = true');
                        if (count($victimes) > 0)
                        {
                            foreach ($victimes as $v)
                                if (!$v->est_loue($_BD)) $params[VICTIME][] = $v;
                        }
                        else $_ROUTEUR->redirection('victimes');
                        $params[NOM_PAGE] = $params[URI][0];
                        break;
                    case 2: // Afficher la victime désigné dans l'URI (<marque>/<modele>/)
                        $victimes = (new Victime())->selection(
                            $_BD, null, 'marque = \'' . $params[URI][0] . '\' AND modele = \'' . $params[URI][1] . '\''
                        );
                        if (count($victimes) === 1) $params[VICTIME] = $victimes[0];
                        else $_ROUTEUR->redirection('victimes/' . $params[URI][0]);
                        $params[NOM_PAGE] = $params[URI][0] . ' ' . $params[URI][1];
                        break;
                    default:
                        break;
                }
            } // Afficher la liste de toutes les victimes
            else
            {
                $victimes = (new Victime())->selection($_BD, null);
                if (count($victimes) > 0)
                {
                    foreach ($victimes as $v)
                        if (!$v->est_loue($_BD)) $params[VICTIME][] = $v;
                }
            }
        }
    }
?>
