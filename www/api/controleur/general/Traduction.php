<?php
require_once __RACINE__ . 'controleur/Controleur.php';

class Traduction extends _Controleur {

    protected $_api;

    public function informations(): array
    {
        return ['api'];
    }

    public function traduire(string $langue, string $texte) : string
    {
        if ($langue === 'fr') return $texte;
        $this->_api = $this->_api . $langue . '/' .  urlencode($texte);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->_api);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


        $result = curl_exec($curl);
        $data = json_decode($result, true); 

        if (isset($data['translation'])) return $data['translation'];
        return $texte;
    }

    public function traduire_page(array &$session, array &$texte)
    {
        foreach ($texte as $nom => &$txt)
        {
            if (is_array($txt)) $this->traduire_page($session, $txt);
            else $texte[$nom] = $this->traduire($session[LANGUE], $txt);
        }
    }


};


?>