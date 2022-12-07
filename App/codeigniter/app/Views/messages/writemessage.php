<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<main class="container">
    <h2>Message to <?= $receiver['user_name']?></h2>
    <?php if(isset($validation)) : ?>
        <div class="alert alert-danger text-center">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif ; ?>
    <form action="/Messages/writemessage/<?=$receiver['user_id']?>" method="post">
        <div class="row">
            <div class="col-sm-4">
                <button class="btn btn-primary" type="submit" style="margin: 10px;">Send</button>
            </div>
            <div class="col-sm-8">
                <div class="form-floating">
                    <textarea class="form-control" name="message" id="message" style="height:100px;"></textarea>
                    <label for="message">Type your message here</label>
                </div>
            </div>
        </div>
    </form>
</main>


<?= $this->endSection('content')?>