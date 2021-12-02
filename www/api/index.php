<?php
    $racine =  __DIR__ . '\\';
    if (!is_dir($racine))
        $racine = 'www\\' . __DIR__ . '\\';
    define('__RACINE__', $racine);
    unset($racine);

    require_once __RACINE__ .  'controleur/general/App.php';

    $_APP = new App("ini/app.ini");
    $_APP->proceder($_SERVER, $_SESSION, $_POST, $_GET, $_COOKIE);
?>