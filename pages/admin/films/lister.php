<header>
    <h1>Liste des films</h1>
</header>

<main>
        <!-- Ajouter -->
        <a href="../public/index.php?p=ajouter_film" class="btn btn-light-green btn-sm">ajouter</a>

    <section>

        <table class="table table-bordered table-hover table-sm">

            <!-- Table head -->
            <thead class="mdb-color darken-3">
                <tr class="text-white">
                    <th>Nom du film</th>
                    <th>Réalisateur</th>
                    <th>Année de production</th>
                    <th>Actions</th>
                </tr>
            <!-- Table head -->
            </thead>

            <!-- Table body -->
            <tbody>

                <?php
                // Requête SQL : récupère la liste des films sous forme d'objets
                $statement = 'SELECT * FROM movies ORDER BY title ASC;';
                $movies      = $db->query($statement, '\App\Tables\Movie');
                foreach($movies as $movie) :
                ?>

                <tr>
                    <td><?= $movie->getTitle(); ?></td>
                    <td><?= $movie->getDirector(); ?></td>
                    <td><?= $movie->getYear(); ?></td>
                    <td>
                        <?= $movie->btn_voir(); ?>
                    </td>
                </tr>

                <?php endforeach; ?>

            <!-- Table body -->
            </tbody>
        <!-- Table -->
        </table>
    </section>
</main>
