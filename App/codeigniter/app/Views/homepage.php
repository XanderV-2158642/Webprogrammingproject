<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>


<main class="container-xv">

    <div class="notification-xv">
        <a href="/Notifications" class = "btn btn-db-xv position-relative">Notifications
            <?php if ($na > 0): ?>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                <?=$na?>
                <span class="visually-hidden">unread messages</span>
            </span>
            <?php endif;?>
        </a>
    </div>
    <h2 class="page-title-xv">Welcome to the Energyshop</h2>

    <div class = "card w-75 card-xv" >
        <div class = "card-body">
            <h4>Shop</h4>
            <p class= "card-text"></p>
            <a href="/Shop" class="btn btn-db-xv">Go to Shop</a>
        </div>
    </div>
    <div class = "card w-75 card-xv">
        <div class = "card-body">
            <h4>User profile</h4>
            <p class= "card-text"></p>
            <a href="/Profile" class="btn btn-db-xv">Go to your profile</a>
        </div>
    </div>

</main>


<?= $this->endSection('content')?>