<?php
// Charge automatiquement les classes appelées
require '../../../app/Autoloader.php';

// Charge la fonction de vérification des inputs
require '../../../app/functions/checkInput.php';

$result = array(
    'title'           => '',
    'actors'          => '',
    'director'        => '',
    'producer'        => '',
    'year_of_prod'    => '',
    'language'        => '',
    'category'        => '',
    'storyline'       => '',
    'video'           => '',
    'title_error'     => '',
    'actors_error'    => '',
    'director_error'  => '',
    'producer_error'  => '',
    'storyline_error' => '',
    'video_error'     => '',
    // Initialisation saisie valide
    'isSuccess'       => true,
    // Initialisation existence film
    'isMovie'         => false,
    // Initialisation insertion réussie
    'isInsert'        => false
);

// Réupération de valeurs POST
$result['title']        = checkInput($_POST['title']);
$result['actors']       = checkInput($_POST['actors']);
$result['director']     = checkInput($_POST['director']);
$result['producer']     = checkInput($_POST['producer']);
$result['year_of_prod'] = checkInput($_POST['year_of_prod']);
$result['language']     = checkInput($_POST['language']);
$result['category']     = checkInput($_POST['category']);
$result['storyline']    = checkInput($_POST['storyline']);
$result['video']        = checkInput($_POST['video']);

// Champ "titre" comporte moins de 5 caractères
if(strlen($result['title']) < 5) :
    // Erreur
    $result['isSuccess'] = false;
    $result['title_error'] = 'Le champ titre doit contenir au moins 5 caractères';
endif;

// Champ "acteurs" comporte moins de 5 caractères
if (strlen($result['actors']) < 5) :
    // Erreur
    $result['isSuccess'] = false;
    $result['actors_error'] = 'Le champ acteurs doit contenir au moins 5 caractères';
endif;

// Champ "réalisateur" comporte moins de 5 caractères
if (strlen($result['director']) < 5) :
    // Erreur
    $result['isSuccess'] = false;
    $result['director_error'] = 'Le champ réalisateur doit contenir au moins 5 caractères';
endif;

// Champ "producteur" comporte moins de 5 caractères
if (strlen($result['producer']) < 5) :
    // Erreur
    $result['isSuccess'] = false;
    $result['producer_error'] = 'Le champ producteur doit contenir au moins 5 caractères';
endif;

// Champ "synopsis" comporte moins de 5 caractères
if (strlen($result['storyline']) < 5) :
    // Erreur
    $result['isSuccess'] = false;
    $result['storyline_error'] = 'Le champ synopsis doit contenir au moins 5 caractères';
endif;

// Champ "lien vers la vidéo" doit être une URL valide
if (!filter_var($result['video'], FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)) :
    // Erreur
    $result['isSuccess'] = false;
    $result['video_error'] = 'Le lien vers la vidéo doit être une URL valide';
endif;

// Saisie valide
if($result['isSuccess']) :
    require_once '../../../app/Database.php';
    require_once('../../../public/identifiants.php');
    require_once '../../../app/tables/Movie.php';
    $db = new App\Database($db_name, $db_host, $db_user, $db_pass);
    // Requête SQL : récupère la liste des films sous forme d'objets
    $statement = 'SELECT * FROM movies ORDER BY title ASC;';
    $class     = '\App\Tables\Movie';
    $movies    = $db->query($statement, $class);
    foreach($movies as $movie) :

        // Nom du film existe
        if($result['title'] == $movie->getTitle()) :
            // Erreur
           $result['isMovie'] = true;
        endif;

    endforeach;
    // Nom du film n'existe pas
    if(!$result['isMovie']) :
        // Requête SQL : insère un nouveau film (titre, acteurs, réalisateur, producteur, année de production, langue, catégorie, synopsis, lien vers la video)
        $statement = '
        INSERT INTO movies(title, actors, director, producer, year_of_prod, language, category, storyline, video)
        VALUES(:title, :actors, :director, :producer, :year_of_prod, :language, :category, :storyline, :video);
        ';
        $attributs = array(
            'title'        => $result['title'],
            'actors'       => $result['actors'],
            'director'     => $result['director'],
            'producer'     => $result['producer'],
            'year_of_prod' => $result['year_of_prod'],
            'language'     => $result['language'],
            'category'     => $result['category'],
            'storyline'    => $result['storyline'],
            'video'        => $result['video'],
            );
        $movie = $db->execute($statement, $attributs);

        if($result['isMovie'] !== null) :
            $result['isInsert'] = true;
        endif;

    // Nom du film n'existe pas
    endif;
// Saisie valide
endif;

echo json_encode($result);
