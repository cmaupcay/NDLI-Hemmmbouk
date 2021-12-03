<?php
    require_once __RACINE__ . 'controleur/Controleur.php';
    require_once __RACINE__ . 'modele/Article.php';

    class URI_Article extends Controleur
    {
        public function executer(array &$server, array &$session, array &$post, array &$get, array &$params, BD &$_BD, Authentification &$_AUTH, Routeur &$_ROUTEUR, ?JetonAuthentification &$_JETON = null)
        {
            if (isset($params[URI]))
            {
                switch (count($params[URI]))
                {
                    case 1: // Afficher la liste des articles renseignée dans l'URI
                        $articles = (new Article())->selection($_BD, null, 'marque = \'' . $params[URI][0] . '\' AND dispo = true');
                        if (count($articles) > 0)
                        {
                            foreach ($articles as $v)
                                if (!$v->est_loue($_BD)) $params[SAUVETEUR][] = $v;
                        }
                        else $_ROUTEUR->redirection('articles');
                        $params[NOM_PAGE] = $params[URI][0];
                        break;
                    case 2: // Afficher l'article désigné dans l'URI (<marque>/<modele>/)
                        $articles = (new Article())->selection(
                            $_BD, null, 'marque = \'' . $params[URI][0] . '\' AND modele = \'' . $params[URI][1] . '\''
                        );
                        if (count($articles) === 1) $params[SAUVETEUR] = $articles[0];
                        else $_ROUTEUR->redirection('articles/' . $params[URI][0]);
                        $params[NOM_PAGE] = $params[URI][0] . ' ' . $params[URI][1];
                        break;
                    default:
                        break;
                }
            } // Afficher la liste de tous les articles
            else
            {
                $articles = (new Article())->selection($_BD, null);
                if (count($articles) > 0)
                {
                    foreach ($articles as $v)
                        if (!$v->est_loue($_BD)) $params[SAUVETEUR][] = $v;
                }
            }
        }
    }
?>
