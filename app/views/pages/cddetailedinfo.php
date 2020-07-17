<?php require APPROOT . '/views/include/header.php'; ?>
<div class="container-fluid">
<?php require APPROOT . '/views/include/navbar.php'; ?>
</div>
<div class="container justify-content-center mt-5">

    <form>
        <div class="form-group">
            <label for="formGroupExampleInput">Example label</label>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">Another label</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
        </div>
    </form>



    <div class="row mt-4">
        <div class="col-12 col-md-6 d-flex flex-row-reverse">
            <img class="img-fluid rounded"
                 src="<?php echo
                URLROOT . 'images/covers/' .
                $cd->disc_picture?>" alt="cd cover"
                 title="cd cover">
        </div>

        <div class="col-12 col-md-6 mt-3 mt-md-0 d-flex flex-column
        justify-content-center">
            <h1 class="text-center text-md-left"> <?php echo
                $cd->disc_title
                ?> </h1>
            <p class="text-center text-md-left"><?php echo $cd->artist_name; ?> </p>
            <p class="text-center text-md-left"><?php echo $cd->disc_label; ?> </p>
            <p class="text-center text-md-left"><?php echo $cd->disc_genre; ?> </p>
            <p class="text-center text-md-left"><?php echo $cd->disc_year; ?> </p>
            <p class="h3 text-center text-md-left"><?php echo $cd->disc_price; ?> </p>


        </div>
    </div>

    <div class="d-flex  justify-content-center align-items-center">
        <a class="btn btn-info
                            violet-color-override-class"
           href="<?php ?>"> Modifier</a>
        <a class="btn btn-info
                            violet-color-override-class"
           href="<?php ?>"> Modifier</a>
        <a class="btn btn-info
                            violet-color-override-class" href="<?php ?>">
            Modifier</a>
    </div>

    <div class="row mt-5  ml-1 mr-1 ml-md-0 mr-md-0 justify-content-center">
        <a class=" col-12 btn btn-info btn-block
                            violet-color-override-class"
           href="<?php ?>"> Modifier</a>
        <a class="  col-12 btn btn-info btn-block
                            violet-color-override-class"
           href="<?php ?>"> Modifier</a>
        <a class="  col-12 btn btn-info btn-block
                            violet-color-override-class" href="<?php ?>">
            Modifier</a>
    </div>

</div>

<?php require APPROOT . '/views/include/footer.php'; ?>

