<?php
    $racine =  __DIR__ . '/';
    var_dump(scandir(__DIR__));
    if (!is_dir($racine))
    {
        $racine = explode('/', __DIR__);
        array_pop($racine);
        $racine[] = 'www';
        $racine[] = 'api';
        $racine = implode('/', $racine);
    }
    define('__RACINE__', $racine);
    unset($racine);
    var_dump(__RACINE__);

    require_once __RACINE__ .  'controleur/general/App.php';

    $_APP = new App("ini/app.ini");
    $_APP->proceder($_SERVER, $_SESSION, $_POST, $_GET, $_COOKIE);
?>