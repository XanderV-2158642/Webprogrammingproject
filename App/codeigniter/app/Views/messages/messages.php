<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<main class="container">
    <h2>Messages</h2>
    <?php for ($i = count($chats)-1; $i > -1; $i--):
        $chat = $chats[$i]; ?>
        <div class="card" style="margin-bottom: 8px;">
            <div class="card-body">
                <h5 class="card-title"><a class="link-dark" href="/messages/chat/<?=$chat['corresponder_id']?>"><?= $chat['corresponder'] ?></a></h5>
                <p class = "card-text"> <?= $chat['lastmessage']?></p>
            </div>
        </div>
    <?php endfor; ?>
</main>



<?= $this->endSection('content')?>