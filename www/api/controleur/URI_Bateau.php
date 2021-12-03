<?php
    require_once __RACINE__ . 'controleur/Controleur.php';
    require_once __RACINE__ . 'modele/Bateau.php';

    class URI_Bateau extends Controleur
    {
        public function executer(array &$server, array &$session, array &$post, array &$get, array &$params, BD &$_BD, Authentification &$_AUTH, Routeur &$_ROUTEUR, ?JetonAuthentification &$_JETON = null)
        {
            if (isset($params[URI]))
            {

                switch (count($params[URI]))
                {
                    case 1: // Afficher la liste des bateaux disponibles et de la marque renseignée dans l'URI
                        $bateaux = (new Bateau())->selection($_BD, null, 'marque = \'' . $params[URI][0] . '\' AND dispo = true');
                        if (count($bateaux) > 0)
                        {
                            foreach ($bateaux as $v)
                                if (!$v->est_loue($_BD)) $params[BATEAU][] = $v;
                        }
                        else $_ROUTEUR->redirection('bateaux');
                        $params[NOM_PAGE] = $params[URI][0];
                        break;
                    case 2: // Afficher le véhicule désigné dans l'URI (<marque>/<modele>/)
                        $bateau = (new Bateau())->selection(
                            $_BD, null, 'marque = \'' . $params[URI][0] . '\' AND modele = \'' . $params[URI][1] . '\''
                        );
                        if (count($bateau) === 1) $params[BATEAU] = $bateau[0];
                        else $_ROUTEUR->redirection('bateaux/' . $params[URI][0]);
                        $params[NOM_PAGE] = $params[URI][0] . ' ' . $params[URI][1];
                        break;
                    default:
                        break;
                }
            } // Afficher la liste de tous les véhicules disponibles
            else
            {
                $bateaux = (new Bateau())->selection($_BD, null);
                if (count($bateaux) > 0)
                {
                    foreach ($bateaux as $v)
                        if (!$v->est_loue($_BD)) $params[BATEAU][] = $v;
                }
            }
        }
    }
?>
