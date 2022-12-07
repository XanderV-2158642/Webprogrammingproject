<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>


<main class="container">
    <h1>Notifications</h1>

    <?php for ($i = count($notifications) - 1; $i > -1; $i--):
        $notification = $notifications[$i];?>
        <div class="card position-relative" style=" border-radius: 0; margin-bottom: 10px;">
            <div class="card-body">
                <h5><a class="link-dark" href="/Product/productpage/<?=$notification['product']['product_id']?>"><?=$notification['product']['product_title']?></a> is back in stock!</h5>
                <a class="badge rounded-pill text-bg-danger no-link" href="/Notifications/removenotification/<?=$notification['notification']['notification_id']?>" style="text-decoration: none;">remove</a>
            </div>
            <?php if (!$notification['notification']['beenread']):?>
                <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                    <span class="visually-hidden">New alerts</span>
                </span>
            <?php endif;?>
        </div>
    <?php endfor;?>
</main>

<?= $this->endSection('content')?>