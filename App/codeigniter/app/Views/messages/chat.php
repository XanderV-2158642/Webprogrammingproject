<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<main class="container">
    <h2>Messages with <?=$corresponder['user_name']?></h2>
    <div class="w-75">
        <div class="row">
            <div class="col">
                <h5><?=$corresponder['user_name']?></h5>
            </div>
            <div class="col text-end">
                <h5>You</h5>
            </div>
        </div>
        <?php for ($i = count($messages)-1; $i > -1; $i--):
            $message = $messages[$i]; ?>
            <div class="card" style="margin-bottom: 8px; width: fit-content; <?=($corr_id == $message['receiver_id']) ? "margin-left: auto; margin-right: 0;" : "" ?>">
                <div class="card-body">
                    <p class = "card-text"> <?= $message['message']?></p>
                </div>
            </div>
        <?php endfor; ?>
        <hr>
    </div>
    <div class="w-75 text-center">
        <a href="/messages/writemessage/<?=$corr_id?>" class="btn btn-primary">Respond</a>
    </div>
</main>



<?= $this->endSection('content')?>