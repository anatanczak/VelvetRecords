<?php require APPROOT . '/views/include/header.php'; ?>
<div class="container-fluid ">
    <?php require APPROOT . '/views/include/navbar.php'; ?>
    <h1 class="col-12 text-center p-3"> <?php echo $pageTitle
        ?> </h1>
    <div class="row justify-content-center">
    <?php foreach($cds as $cd) : ?>

        <section class="lightgray-rounded-corners-override-class col-sm-11 col-md-6
        col-xl-3 m-1 p-2">

            <h2 class="h4 text-center red-text-override-class mb-4"> <?php
                echo $cd->disc_title;  ?> </h2>

            <div class="row justify-content-center">
                <div class="col">
                    <img class="img-fluid rounded" src="<?php echo
                    URLROOT . 'images/covers/' .
                    $cd->disc_picture?>" alt="cd cover"
                     title="cd cover">
                </div>

                <div class="col min-height-override-class-200 d-flex flex-column">
                        <p class="m-0"><span class="font-weight-bold">Artist : </span><?=
                            $cd->artist_name ?> </p>
                        <p class="m-0"><span
                                    class="font-weight-bold">Label : </span><?=
                            $cd->disc_label
                            ?> </p>
                        <p class="m-0"><span
                                    class="font-weight-bold">Année : </span><?=
                            $cd->disc_year
                            ?> </p>
                        <p class="m-0"><span
                                    class="font-weight-bold">Genre : </span><?=
                            $cd->disc_genre
                            ?> </p>
                    <p class="h2 text-info mt-1
                    mt-md-auto"><?=
                        $cd->disc_price ?> €
                    </p>
                </div>
            </div>

            <a class=" btn btn-dark btn-block
                         mt-2 "
                                href="<?php echo $pathToDetailedInfo .'/id='
                                . $cd->disc_id;?>">
                    Détails</a>
        </section>
    <?php endforeach; ?>
    </div>

</div>

<?php require APPROOT . '/views/include/footer.php'; ?>