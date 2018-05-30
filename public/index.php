<?php
// Charge automatiquement les classes appelées
require '../app/Autoloader.php';
\App\Autoloader::register();

// Charge la fonction de vérification des inputs
require '../app/functions/checkInput.php';

// Définit une valeur GET p pour récupérer une page
if(isset($_GET['p'])) :
    $p = checkInput($_GET['p']);
else :
    $p = 'films';
endif;

// Initialisation des objets
// Prévoir 4 variables $db_name, $db_host, $db_user, $db_pass
require_once('../public/identifiants.php');
$db = new \App\Database($db_name, $db_host, $db_user, $db_pass);

// Stocke dans une variable tout ce qui est affiché
ob_start();

// Tableau associatif des pages requises
$pages = array(
    'films' => '../pages/admin/films/lister.php',
    'ajouter_film' => '../pages/admin/films/ajouter.php',
    'voir_film' => '../pages/admin/films/voir.php',
);

// Si la page demandée existe dans le tableau ci-dessus
if(array_key_exists($p, $pages)) :
    require $pages[$p];
    $title = $p;
    $content = ob_get_clean();

 // Si la page demandée est erreur_item
elseif ($p === 'erreur_item') :
    require '../pages/templates/erreur_item.php';
    $title = 'erreur élément';
    $content = ob_get_clean();

// Si la page demandée n'existe pas
else :
    require '../pages/templates/erreur_page.php';
    $title = 'erreur page';
    $content = ob_get_clean();
endif;

require '../pages/templates/default.php'
 ?>
