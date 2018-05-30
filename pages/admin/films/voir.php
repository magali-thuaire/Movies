<header>
    <h1>Informations sur le film</h1>
</header>
<main>

<?php

// Initialisation existence film
$isFilm = false;
// Réupération de l'id du film
$id = checkInput($_GET['id']);

//-------------------- Affichage du film --------------------

// Requête SQL : récupère le film sélectionné sous forme d'objet
$statement = 'SELECT * FROM movies WHERE id = :id;';
$attributs = array('id' => $id);
$class     = '\App\Tables\Movie';
$movie       = $db->prepare($statement, $attributs, $class, true);

// Film existe
if($movie) :
    $isFilm = true;
?>
    <section>
        <!-- Table -->
        <table class="table table-bordered table-hover mt-5">
            <!-- Table body -->
            <tbody>
                <tr>
                    <td>Titre du film</td>
                    <td><?= $movie->getTitle(); ?></td>
                </tr>
                <tr>
                    <td>Acteurs</td>
                    <td><?= $movie->getActors(); ?></td>
                </tr>
                <tr>
                    <td>Réalisateur</td>
                    <td><?= $movie->getDirector(); ?></td>
                </tr>
                <tr>
                    <td>Producteur</td>
                    <td><?= $movie->getProducer(); ?></td>
                </tr>
                <tr>
                    <td>Année de production</td>
                    <td><?= $movie->getYear(); ?></td>
                </tr>
                <tr>
                    <td>Langue</td>
                    <td><?= $movie->getLanguage(); ?></td>
                </tr>
                <tr>
                    <td>Catégorie</td>
                    <td><?= $movie->getCategory(); ?></td>
                </tr>
                <tr>
                    <td>Synopsis</td>
                    <td><?= $movie->getStoryline(); ?></td>
                </tr>
                <tr>
                    <td>Lien vers la vidéo</td>
                    <td><?= $movie->getVideo(); ?></td>
                </tr>
            </tbody>
        <!-- Table -->
        </table>
    <?php

// Film existe
endif;

// Film n'existe pas
if(!$isFilm) :
// Redirection vers la page initiale
header('Location: ../public/index.php?p=erreur_item');
endif;
?>

<!-- Retour -->
<a href="../public/index.php?p=films" class="btn btn-blue-grey btn-sm mt-5">retour</a>

</main>
