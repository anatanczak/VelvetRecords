<?php require APPROOT . '/views/include/header.php'; ?>
<div class="container-fluid">
    <?php require APPROOT . '/views/include/navbar.php'; ?>
</div>
<div class="container justify-content-center mt-5 p-5">
    <?php if(isset($_SESSION['user_id'])) : ?>
<h1 class="text-center">Ajouter un vinyle</h1>

    <!--multipart/form-data is one of the value of enctype attribute, which
    is used in form element that have a file upload. multi-part means form
    data divides into multiple parts and send to server. --->
<form method="post" action=" <?= URLROOT . 'cds/add'?>"
      enctype="multipart/form-data" class="">


    <!-----------  TITLE  ----------->
    <div class="form-group">
        <label for="form-cd-title">Titre</label>
        <input type="text" class="form-control" id="form-cd-title"
               placeholder="Entrer le titre..." value="<?php if(isset($data['title'])) echo $data['title'];
               ?>">
        <span class="invalid-feedback"><?php if(isset
            ($data['errors']['title_error'])) echo $data['errors']['title_error'];
            ?></span>
    </div>


    <!-----------  ARTIST  ----------->
    <div class="form-group">
        <label for="form-cd-artist">Artiste</label>
        <input type="text" class="form-control" id="form-cd-artist"
               placeholder="Entrez le nom de l'artiste" value="<?php if(isset
        ($data['artist'])) echo $data['artist'];
        ?>">
        <span class="invalid-feedback"><?php if(isset
            ($data['errors']['artist_error'])) echo $data['errors']['artist_error'];
            ?></span>
    </div>



    <!-----------  YEAR  ----------->
    <div class="form-group">
        <label for="form-cd-year">Année</label>
        <input type="text" class="form-control" id="form-cd-year"
               placeholder="Entrez l'année de sortie" value="<?php if(isset
        ($data['year'])) echo $data['year'];
        ?>">
        <span class="invalid-feedback"><?php if(isset
            ($data['errors']['year_error'])) echo $data['errors']['year_error'];
            ?></span>
    </div>


    <!-----------  GENRE  ----------->
    <div class="form-group">
        <label for="form-cd-genre">Genre</label>
        <input type="text" class="form-control" id="form-cd-genre"
               placeholder="Entrez le genre" value="<?php if(isset
        ($data['genre'])) echo $data['genre'];
        ?>">
        <span class="invalid-feedback"><?php if(isset
            ($data['errors']['genre_error'])) echo $data['errors']['genre_error'];
            ?></span>
    </div>


    <!-----------  LABEL  ----------->
    <div class="form-group">
        <label for="form-cd-label">Label</label>
        <input type="text" class="form-control" id="form-cd-label"
               placeholder="Entrez le label" value="<?php if(isset
        ($data['label'])) echo $data['label'];
        ?>">
        <span class="invalid-feedback"><?php if(isset
            ($data['errors']['label_error'])) echo $data['errors']['label_error'];
            ?></span>
    </div>


    <!-----------  PRICE  ----------->
    <div class="form-group">
        <label for="form-cd-price">Prix</label>
        <input type="text" class="form-control" id="form-cd-price"
               placeholder="Entrez le prix" value="<?php if(isset
        ($data['price'])) echo $data['price'];
        ?>">
        <span class="invalid-feedback"><?php if(isset
            ($data['errors']['price_error'])) echo $data['errors']['price_error'];
            ?></span>
    </div>

    <!-----------  IMG UPLOAD  ----------->

            <!-----------  TODO: ADD BOOTSTRAP GRID TO FIX LAYOUT ISSUES WITH
             THE IMAGE PREVIEW  ----------->
            <div class="form-group">

                <div class="
                relative-position-override-class width-100-override-class">

                    <div class="d-flex align-items-center justify-content-center
                     flex-wrap
                    absolute-position-override-class width-100-override-class
                    <?php if(isset
                    ($data['errors']['img_upload_error'])) echo 'red-border-override-class px-2';
                    ?> rounded py-2">
                            <span class="my-2 mr-2  <?php echo isset
                            ($data['errors']['img_upload_error']) ? 'invalid-feedback-override-class' : '' ?>"> <?php echo isset
                            ($data['errors']['img_upload_error']) ?  $data['errors']['img_upload_error'] : 'Choisir une image:';
                            ?></span>

                        <label class="btn btn-light m-2"
                               for="form-cd-img-upload">Parcourir
                            les fichiers</label>

                        <div class="image-preview-container
                            gray-border-override-class
                             rounded my-2 ml-2"
                             id="image-preview-container">
                            <img src="" id="image-preview-image" alt="Image Preview"
                                 class="image-preview-image display-none-override-class
                     rounded" >
                            <img src="<?= URLROOT .
                            'images/img-placeholder-icon.svg'?>"
                                 id="image-preview-placeholder"
                                  class="image-preview-placeholder
                          my-auto mx-auto" height="30px" width="30px">
                        </div>

                        <input type="submit" class="btn btn-dark m-2 
                        ml-md-auto">
                    </div>

                    <input type="file" class="visibility-hidden-override-class"
                           id="form-cd-img-upload">
                </div>
            </div>
</form>

    <?php else : ?>

        <div class="container d-flex justify-content-center align-items-center
height-min-80vh-override-class">

            <div class="row p-5 lightgray-rounded-corners-override-class
            my-auto">
                <div class=" mt-md-0 d-flex flex-column">
                    <p class=" h4 text-center text-md-left">Vous devez être
                        connecté pour pouvoir ajouter un vinyle. </p>
                </div>
            </div>
        </div>

    <?php endif; ?>

</div>

<?php require APPROOT . '/views/include/footer.php'; ?>

