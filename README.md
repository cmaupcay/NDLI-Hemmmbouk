# Les HEMMMBOUK
Nuit de l'info 2021


Ce guide contient un guide d'installation pour setup le site ainsi que les détails demandés pour les différentes spécifications demandées par les défis 

Tutoriel d'installation et de mise en route du site et de la base de données associée

*********************

Déploiement vercel 
==


Création de vercel
-

Rendez vous sur le site vercel.com et créez un nouveau projet.

+ Sélectionnez "import Third Party Git Repository"
+ indiquez l'url du repository github
+ validez

Modification du Fichier BD.ini
-



Spécifications défis secondaires
==

### Défi VIVERIS : World Wide


La fonctionnalité de traduction se fait via l'utilisation de l'api de lingva dans le fichier Traduction.php

La traductuion fonctionne de la manière suivante:
+ une liste permet de changer la langue du site
+ une fois la langue changée, lors du chargement de la page, on appelle l'api pour traduire depuis le francais dans la langue sélectionnée
+ l'affichage est traduit et affiché
