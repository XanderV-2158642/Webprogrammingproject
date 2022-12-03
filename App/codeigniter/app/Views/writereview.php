<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<main class="container">
    <h2>Review for <?= $product['product_title']?></h2>
    <?php if(isset($validation)) : ?>
        <div class="alert alert-danger text-center">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif ; ?>
    <form action="/reviews/writereview/<?=$product['product_id']?>" method="post">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-floating">
                    <input class="form-control" type="number" name="score" id="score">
                    <label for="score">Rate this item from 1 to 5</label>
                </div>
                <button class="btn btn-primary" type="submit" style="margin: 10px;">Submit</button>
            </div>
            <div class="col-sm-8">
                <div class="form-floating">
                    <textarea class="form-control" name="description" id="description" style="height:100px;"></textarea>
                    <label for="id">Explain your score</label>
                </div>
            </div>
        </div>
    </form>
</main>


<?= $this->endSection('content')?>