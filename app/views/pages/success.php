<?php require APPROOT . '/views/include/header.php'; ?>
<div class="container-fluid">
    <?php require APPROOT . '/views/include/navbar.php'; ?>
    <div class="row justify-content-center height-min-80vh-override-class" >

        <div class="card col-11 col-sm-8 col-md-5 my-auto p-3 " style="width:
        18rem;">

            <img class="card-img-top" src="<?php echo
                URLROOT . 'images/success-icon.svg'?> " alt="Card image cap"
                 width="50" height="50">

            <div class="card-body">
                <h5 class="card-title text-center"> <?php echo(isset($data['title']) ? $data['title'] : 'Succès!');
                        ?> </h5>
                <p class="card-text text-center"><?php echo(isset
                    ($data['message']) ?
                        $data['message'] : 'Merci. Votre demarche est prise en compte.');
                    ?></p>
                <a href=" <?php echo(isset($data['url']) ? $data['url'] :
                    URLROOT . 'cds');
                ?> " class="btn btn-dark btn-block"><?php echo(isset($data['urlTitle']) ? $data['urlTitle'] :
                        'Accueil');
                    ?></a>
            </div>
        </div>
    </div>

</div>
<?php require APPROOT . '/views/include/footer.php'; ?>
