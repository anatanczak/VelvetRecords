<nav class="navbar navbar-dark bg-dark margin-15-override-class">
    <a class="navbar-brand" href=" <?= URLROOT ?> ">
        <img src="<?=
            URLROOT . 'images/vinyl-icon.png'?>" width="30" height="30"
             class="d-inline-block align-top" alt="logo">
        VelvetRecords
    </a>
    <?php if(isset($_SESSION['user_id'])) : ?>
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
