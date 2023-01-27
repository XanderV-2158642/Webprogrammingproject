<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<main class="container-xv">
    <h2>Messages with <?=$corresponder['user_name']?></h2>
    <div class="mx-auto w-75 ">
        <div class="row">
            <div class="col">
                <h5><?=$corresponder['user_name']?></h5>
            </div>
            <div class="col text-end">
                <h5>You</h5>
            </div>
        </div>
        <?php foreach ($messages as $message):
            $message ?>
            <div class="card" style="margin-bottom: 8px; width: fit-content; max-width: 75%; <?=($corr_id == $message['receiver_id']) ? "margin-left: auto; margin-right: 0;" : "" ?>">
                <div class="card-body">
                    <p class = "card-text"> <?= $message['message']?></p>
                </div>
            </div>
        <?php endforeach; ?>
        <hr>
    </div>
    <div class="mx-auto w-75 text-center">
        <a href="/Messages/writemessage/<?=$corr_id?>" class="btn btn-db-xv">Respond</a>
    </div>
</main>



<?= $this->endSection('content')?>