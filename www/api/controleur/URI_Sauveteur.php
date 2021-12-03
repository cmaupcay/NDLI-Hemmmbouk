<?php
    require_once __RACINE__ . 'controleur/Controleur.php';
    require_once __RACINE__ . 'modele/Sauveteur.php';

    class URI_Sauveteur extends Controleur
    {
        public function executer(array &$server, array &$session, array &$post, array &$get, array &$params, BD &$_BD, Authentification &$_AUTH, Routeur &$_ROUTEUR, ?JetonAuthentification &$_JETON = null)
        {
            if (isset($params[URI]))
            {
                switch (count($params[URI]))
                {
                    case 1: // Afficher la liste des sauveteurs renseignée dans l'URI
                        $sauveteurs = (new Sauveteur())->selection($_BD, null, 'marque = \'' . $params[URI][0] . '\' AND dispo = true');
                        if (count($sauveteurs) > 0)
                        {
                            foreach ($sauveteurs as $v)
                                if (!$v->est_loue($_BD)) $params[SAUVETEUR][] = $v;
                        }
                        else $_ROUTEUR->redirection('sauveteurs');
                        $params[NOM_PAGE] = $params[URI][0];
                        break;
                    case 2: // Afficher le sauveteur désigné dans l'URI (<marque>/<modele>/)
                        $sauveteurs = (new Sauveteur())->selection(
                            $_BD, null, 'marque = \'' . $params[URI][0] . '\' AND modele = \'' . $params[URI][1] . '\''
                        );
                        if (count($sauveteurs) === 1) $params[SAUVETEUR] = $sauveteurs[0];
                        else $_ROUTEUR->redirection('sauveteurs/' . $params[URI][0]);
                        $params[NOM_PAGE] = $params[URI][0] . ' ' . $params[URI][1];
                        break;
                    default:
                        break;
                }
            } // Afficher la liste de tous les sauveteurs
            else
            {
                $sauveteurs = (new Sauveteur())->selection($_BD, null);
                if (count($sauveteurs) > 0)
                {
                    foreach ($sauveteurs as $v)
                        if (!$v->est_loue($_BD)) $params[SAUVETEUR][] = $v;
                }
            }
        }
    }
?>
