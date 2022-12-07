<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>


<main class="container">

    <div style="margin-left: auto; margin-right: 0; width: fit-content; margin-bottom: 10px;">
        <a href="/Notifications" class = "btn btn-primary position-relative">Notifications
            <?php if ($na > 0): ?>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                <?=$na?>
                <span class="visually-hidden">unread messages</span>
            </span>
            <?php endif;?>
        </a>
    </div>
    <h2 style = "text-align: center">Welcome to the Energyshop</h2>

    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. At magni similique eligendi ipsam qui, accusamus, iure temporibus natus illo odit, harum aut sequi blanditiis reprehenderit consequatur culpa voluptates! Illo, nihil.</p>

    <div class = "row">
            <div class = "card w-75 mx-auto" style = "margin-bottom: 10px;">
                <div class = "card-body">
                    <h4>Shop</h4>
                    <p class= "card-text"></p>
                    <a href="/Shop" class = " btn btn-primary">Go to Shop</a>
                </div>
            </div>
            <div class = "card w-75 mx-auto" style = "margin-bottom: 10px;">
                <div class = "card-body">
                    <h4>User profile</h4>
                    <p class= "card-text"></p>
                    <a href="/Profile" class = " btn btn-primary">Go to your profile</a>
                </div>
            </div>
            <div class = "card w-75 mx-auto" style = "margin-bottom: 10px;">
                <div class = "card-body">
                    <h4>About us</h4>
                    <p class= "card-text"></p>
                    <a href="#" class = " btn btn-primary">Go to About us</a>
                </div>
            </div>
        </div>
</main>


<?= $this->endSection('content')?>