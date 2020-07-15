<?php require APPROOT . '/views/include/header.php'; ?>
<div class="container-fluid ">
    <h1 class="text-center red-text-override-class"> <?php echo $pageTitle ?> </h1>
    <div class="row justify-content-center">
    <?php foreach($cds as $cd) : ?>

        <section class="my-personal-override-class col-sm-12 col-md-6
        col-xl-3 m-1 p-2">

            <h2 class="h4 text-center red-text-override-class mb-4"> <?php
                echo $cd->disc_title;  ?> </h2>

            <div class="row justify-content-center">
                <div class="col">
                    <img class="img-fluid" src="<?php echo
                    URLROOT . 'images/covers/' .
                    $cd->disc_picture?>" alt="cd cover"
                     title="cd cover">
                </div>

                <div class="col min-height-override-class-200">
                        <p class="m-0"><?php echo $cd->artist_name; ?></p>
                        <p class="m-0"><?php echo "Label: $cd->disc_label";
                        ?></p>
                        <p class="m-0"><?php echo "Année: $cd->disc_year";
                        ?></p>
                        <p class="m-0"><?php echo "Genre: $cd->disc_genre";
                        ?></p>
                </div>
            </div>

            <button class="btn btn-info btn-block
                        violet-color-override-class mt-2" >Détails</button>
        </section>
    <?php endforeach; ?>
    </div>

</div>
<?php require APPROOT . '/views/include/footer.php'; ?>