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
        <form method="post" action="<?php echo isset($data['id']) ? URLROOT . 'cds/update/id=' . $data['id'] : URLROOT . 'cds/add'?>"
              enctype="multipart/form-data" class="">


            <!-----------  TITLE  ----------->
            <div class="form-group">
                <label for="form-cd-title" class="<?php  if(isset
                ($data['errors']['title_error'])) echo 'text-danger';?>"><?php echo
                    isset
                    ($data['errors']['title_error']) ?
                        $data['errors']['title_error'] : 'Titre';
                    ?><sup class="text-danger">*</sup></label>
                <input type="text" class="form-control <?php  if(isset
                ($data['errors']['title_error'])) echo 'is-invalid';?>"
                       id="form-cd-title"
                       placeholder="Entrer le titre..." name="title" value="<?php if
                (isset
                ($data['title'])) echo htmlspecialchars($data['title']);
                ?>" required>
            </div>


            <!-----------  ARTIST  ----------->
            <div class="form-group">
                <label for="form-cd-artist" class="<?php  if(isset
                ($data['errors']['artist_error'])) echo 'text-danger';
                ?>"><?php echo
                    isset
                    ($data['errors']['artist_error']) ?
                        $data['errors']['artist_error'] : 'Artiste';
                    ?><sup class="text-danger">*</sup></label>
                <select name="artist" id="form-cd-artist" class="form-control <?php  if(isset
                ($data['errors']['artist_error'])) echo 'is-invalid'?>" required>
                    <?php foreach ($data['artists'] as $key=>$value):?>
                    <option value="<?= $value ?>" selected="<?php  if(isset
                    ($data['artist'])) echo 'selected'?>"> <?=$value?></option>
                    <?php endforeach; ?>
                </select>

            </div>



            <!-----------  YEAR  ----------->
            <div class="form-group">
                <label for="form-cd-year" class="<?php  if(isset
                ($data['errors']['year_error'])) echo 'text-danger';
                ?>"><?php echo
                    isset
                    ($data['errors']['year_error']) ?
                        $data['errors']['year_error'] : 'Année';
                    ?><sup class="text-danger">*</sup></label>
                <input type="text" class="form-control <?php  if(isset
                ($data['errors']['year_error'])) echo 'is-invalid';?>" id="form-cd-year"
                       placeholder="Entrez l'année de sortie" name="year" value="<?php
                if(isset
                ($data['year'])) echo htmlspecialchars($data['year']);
                ?>" required>
            </div>


            <!-----------  GENRE  ----------->
            <div class="form-group">
                <label for="form-cd-genre" class="<?php  if(isset
                ($data['errors']['genre_error'])) echo 'text-danger';
                ?>"><?php echo
                    isset
                    ($data['errors']['genre_error']) ?
                        $data['errors']['genre_error'] : 'Genre';
                    ?><sup class="text-danger">*</sup></label>
                <input type="text" class="form-control <?php  if(isset
                ($data['errors']['year_error'])) echo 'is-invalid';?>" id="form-cd-genre"
                       placeholder="Entrez le genre" name="genre" value="<?php if(isset
                ($data['genre'])) echo $data['genre'];
                ?>" required>
            </div>


            <!-----------  LABEL  ----------->
            <div class="form-group">
                <label for="form-cd-label" class="<?php  if(isset
                ($data['errors']['label_error'])) echo 'text-danger';
                ?>"><?php echo
                    isset
                    ($data['errors']['label_error']) ?
                        $data['errors']['label_error'] : 'Label';
                    ?><sup class="text-danger">*</sup></label>
                <input type="text" class="form-control <?php  if(isset
                ($data['errors']['label_error'])) echo 'is-invalid';?>"
                       id="form-cd-label"
                       placeholder="Entrez le label" name="label" value="<?php if(isset
                ($data['label'])) echo $data['label'];
                ?>" required>
            </div>
            

            <!-----------  PRICE  ----------->
            <div class="form-group">
                <label for="form-cd-price" class="<?php  if(isset
                ($data['errors']['price_error'])) echo 'text-danger';
                ?>">

                <?php echo isset
                ($data['errors']['price_error']) ?
                    $data['errors']['price_error'] : 'Prix';
                ?><sup class="text-danger">*</sup></label>

                <input type="text" class="form-control <?php  if(isset
                ($data['errors']['price_error'])) echo 'is-invalid';?>" id="form-cd-price"
                       placeholder="Entrez le prix" name="price" value="<?php if(isset
                ($data['price'])) echo $data['price']; ?>" required>
            </div>


            <!-----------  IMG UPLOAD  ----------->

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

                        <div class="image-preview-container <?php echo isset($data['picture']) ? '' :
                            'gray-border-override-class' ?>
                             rounded my-2 ml-2"
                             id="image-preview-container">
                            <img src="" id="image-preview-image" alt="Image Preview"
                                 class="image-preview-image display-none-override-class
                     rounded" >
                            <img src="<?php echo isset($data['picture']) ? URLROOT . 'images/covers/' . $data['picture'] : URLROOT .
                            'images/img-placeholder-icon.svg'?>"
                                 id="image-preview-placeholder"
                                 class="image-preview-placeholder rounded
                          my-auto mx-auto" height="40px" width="40px">
                        </div>

                        <input type="submit" class="btn btn-dark m-2
                        ml-md-auto">
                    </div>

                    <input type="file" name="file" class="visibility-hidden-override-class"
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

