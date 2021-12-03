<?php
    require_once __RACINE__ . 'controleur/Controleur.php';
    require_once __RACINE__ . 'modele/Article.php';

    class URI_Article extends Controleur
    {
        public function executer(array &$server, array &$session, array &$post, array &$get, array &$params, BD &$_BD, Authentification &$_AUTH, Routeur &$_ROUTEUR, ?JetonAuthentification &$_JETON = null)
        {
            if (isset($params[URI]))
            {
                $params[ARTICLE] = (new Article())->selection($_BD, null, 'id = \'' . $params[URI][0]);

            } // Afficher la liste de tous les articles
            else
            {
                $params[ARTICLE] = (new Article())->selection($_BD, null);

            }
        }
    }
?>
