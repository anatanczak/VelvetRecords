<?php require APPROOT . '/views/include/header.php'; ?>
<?php require APPROOT . '/views/include/deletionConfirmationModal.php'; ?>
<div class="container-fluid">
<?php require APPROOT . '/views/include/navbar.php'; ?>
</div>
<div class="container d-flex justify-content-center align-items-center
height-min-90vh-override-class">

    <div class="row p-5
    lightgray-rounded-corners-override-class
     my-auto">
        <div class="col-12 col-md-6 d-flex flex-row-reverse">
            <img class="img-fluid rounded"
                 src="<?php echo isset($cd->disc_picture) ?
                     URLROOT . 'images/covers/' .
                     $cd->disc_picture : URLROOT . 'images/covers/default-cover.jpg' ?>" alt="cd cover"
                 title="cd cover">
        </div>

        <div class="col-12 col-md-6 mt-3 mt-md-0 d-flex flex-column
        ">
            <h1 class="text-center text-md-left"> <?php echo
                $cd->disc_title
                ?> </h1>
            <p class="text-center text-md-left"> <span class="font-weight-bold">Artist : </span><?=
                $cd->artist_name ?> </p>
            <p class="text-center text-md-left"><span
                        class="font-weight-bold">Label : </span><?=
                $cd->disc_label
            ?> </p>
            <p class="text-center text-md-left"><span
                        class="font-weight-bold">Genre : </span><?=
                $cd->disc_genre
            ?> </p>
            <p class="text-center text-md-left"><span
                        class="font-weight-bold">Année : </span><?=
                $cd->disc_year
            ?> </p>
            <p class="h2 text-center text-md-left text-info mt-1"><?=
                $cd->disc_price ?> €
            </p>
          <!----------- ADD BUTTONS TO MODIFY DISCS IF THE USER IS LOGGED IN
            ---------------->
            <?php if(isset($_SESSION['user_id'])) { ?>
            <div class="text-center text-md-left mt-2 mt-md-auto">

                <a href="<?= URLROOT . 'cds/update/id=' . $cd->disc_id?>" class=""><img src="<?= URLROOT . 'images/modify-icon.svg' ?>"
                                          alt="add icon" class="" height="30px"
                                          width="30px"></a>
                <a id="trash-icon"
                   class=""><img
                            src="<?=
                    URLROOT . 'images/trash-can-icon.svg' ?>"
                                          alt="add icon" class="" height="30px"
                                          width="30px"></a>
            </div>

            <?php } ?>

        </div>

    </div>


</div>

<?php require APPROOT . '/views/include/footer.php'; ?>

