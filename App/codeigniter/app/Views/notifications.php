<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>


<main class="container-xv">
    <h1>Notifications</h1>

    <?php for ($i = count($notifications) - 1; $i > -1; $i--):
        $notification = $notifications[$i];?>
        <div class="card card-xv position-relative">
            <div class="card-body">
                <h5><a class="text-link-xv" href="/Product/productpage/<?=$notification['product']['product_id']?>"><?=$notification['product']['product_title']?></a> is back in stock!</h5>
                <a class="btn btn-dr-xv" href="/Notifications/removenotification/<?=$notification['notification']['notification_id']?>">remove</a>
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