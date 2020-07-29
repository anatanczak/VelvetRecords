<nav class="navbar navbar-dark bg-dark margin-15-override-class">
    <a class="navbar-brand" href=" <?= URLROOT ?> ">
        <img src="<?=
            URLROOT . 'images/vinyl-icon.png'?>" width="30" height="30"
             class="d-inline-block align-top" alt="logo">
        VelvetRecords
    </a>
    <?php if(isset($_SESSION['user_id'])) : ?>
        <a href="<?= URLROOT . 'cds/add' ?>" class="nav-link text-light ml-auto">Ajouter un disc <img src="<?=
            URLROOT . 'images/add-icon.svg' ?>" alt="add icon" class="mx-1" height="15px" width="15px"></a>
         <p class="text-light text-center ml-auto my-auto">Hi, <?=
             $_SESSION['user_name']?></p>
        <a  id="logout-trigger" class="nav-link text-light
        m-0">Log
            out</a>
    <?php else : ?>
    <a id="loginIcon"
       class="d-inline-block
    align-top
    justify-self-end">
        <img src="<?=
            URLROOT . 'images/account-icon.svg'?>" width="30" height="30"
             alt="">
    </a>
    <?php endif; ?>
</nav>
<!-- Success modal -->
<div class="background" id="success-modal">
    <div class="success-icon-wrapper">
        <img src="<?= URLROOT . 'images/success-icon.svg'?>" alt="">
    </div>
</div>
