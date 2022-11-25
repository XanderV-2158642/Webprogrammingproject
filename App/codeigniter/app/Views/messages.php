<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<main class="container">
    <h2>Messages</h2>
    <?php foreach ($chats as $chat): ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"> <?= $chat['sender'] ?></h5>
                <p class = "card-text"> <?= $chat['message']?></p>
                <a href="" class="btn btn-success">Respond</a>
                <a href="" class="btn btn-danger">Remove message</a>
            </div>
        </div>
    <?php endforeach; ?>

</main>



<?= $this->endSection('content')?>