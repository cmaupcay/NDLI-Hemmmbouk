<?php
    define('__RACINE__', __DIR__ . '\\');
    require_once __RACINE__ .  'controleur/general/App.php';

    $_APP = new App("ini/app.ini");
    $_APP->proceder($_SERVER, $_SESSION, $_POST, $_GET, $_COOKIE);
?>