<header>
    <h1>Nouveau film</h1>
</header>

<main>
    <section>
        <!-- Retour -->
                    <a href="../public/index.php?p=films" class="btn btn-blue-grey btn-sm mt-5">retour</a>
        <form id="form" action="" method ="post" >
            <!-- Titre -->
            <div class="form-group mt-2">
                <label for="title" class="mt-2">Titre</label>
                <input id="title" class="form-control" type="text" name="title">
                <p class="comments" style="color: red;"></p>
            </div>
            <!-- Acteurs -->
            <div id="actors" class="form-group mt-2">
                <label for="actors" class="mt-2">Acteurs</label>
                <input id="actors" class="form-control" type="text" name="actors">
                <p class="comments" style="color: red;"></p>
            </div>
            <!-- Réalisateur -->
            <div class="form-group mt-2">
                <label for="director" class="mt-2">Réalisateur</label>
                <input id="director" class="form-control" type="text" name="director">
                <p class="comments" style="color: red;"></p>
            </div>
            <!-- Producteur -->
            <divclass="form-group mt-2">
                <label for="producer" class="mt-2">Producteur</label>
                <input id="producer" class="form-control" type="text" name="producer">
                <p class="comments" style="color: red;"></p>
            </div>
            <!-- Année -->
            <div class="form-group mt-2">
                <label for="year_of_prod">Année de production</label>
                <select class="form-control" id="year_of_prod" name="year_of_prod">
                    <?php
                    for($year = 1970; $year < 2019; $year++)  :
                        ?> <option><?= $year; ?></option><?php
                    endfor;
                    ?>
                </select>
            </div>
            <!-- Langue -->
            <div class="form-group mt-2">
                <label for="language">Langue</label>
                <select class="form-control" id="language" name="language">
                    <?php
                    $languages = array('français', 'anglais');
                    foreach($languages as $language)  :
                        ?> <option><?= $language; ?></option><?php
                    endforeach;
                    ?>
                </select>
            </div>
            <!-- Catégorie -->
            <div class="form-group mt-2">
                <label for="category">Catégorie</label>
                <select class="form-control" id="category" name="category">
                    <?php
                    $categories = array('sans', 'science fiction');
                    foreach($categories as $category)  :
                        ?> <option><?= $category; ?></option><?php
                    endforeach;
                    ?>
                </select>
            </div>
            <!-- Synopsis -->
            <div class="form-group mt-2">
                <label for="storyline" class="mt-2">Synopsis</label>
                <textarea id="storyline" class="form-control" type="text" name="storyline"></textarea>
                <p id="error_storyline" class="comments" style="color: red;"></p>
            </div>
            <!-- Lien vers la vidéo -->
            <div class="form-group mt-2">
                <label for="video" class="mt-2">Lien vers la vidéo</label>
                <input id="video" class="form-control" type="text" name="video">
                <p id="error_video" class="comments" style="color: red;"></p>
            </div>


            <!-- Valider -->
            <input type="submit" value="valider" class="btn btn-deep-orange btn-sm mt-5">


        </form>

    </section>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

    //Formulaire de contact : transmission des données
    jQuery("#form").submit(function (e) {

        e.preventDefault();
        // Supprimer les alertes et les messages d'erreur
        jQuery("p.alert").remove();
        jQuery(".comments").empty();
        // Scroll vers le haut
        jQuery("html, body").animate({ scrollTop: 0 }, "slow");
        let postdata = jQuery("#form").serialize();


        jQuery.ajax({
            type: "post",
            url: "../pages/admin/films/traitement.php",
            data: postdata,
            dataType: 'json',
            success: function (result) {

                // Saisie valide
                if (result.isSuccess) {

                    // Existence d'un film
                    if(result.isMovie) {

                        jQuery("section").prepend('<p class="alert alert-warning">Le nom du film existe déjà</p>');

                    // Insertion d'un film d'un film
                    } else if(result.isInsert) {

                        jQuery("section").prepend('<p class="alert alert-success">Le film a bien été ajouté</p>');
                        jQuery("#form").remove();
                    }

                // Pas de saisie valide
                } else {

                    // Message d'erreurs
                    jQuery("section").prepend('<p class="alert alert alert-warning">Le formuaire contient des erreurs</p>');
                    jQuery("#title + .comments").html(result.title_error);
                    jQuery("#actors + .comments").text(result.actors_error);
                    jQuery("#director + .comments").html(result.director_error);
                    jQuery("#producer + .comments").html(result.producer_error);
                    jQuery("#storyline + .comments").html(result.storyline_error);
                    jQuery("#video + .comments").html(result.video_error);
                }
            }
        });

    });

</script>
