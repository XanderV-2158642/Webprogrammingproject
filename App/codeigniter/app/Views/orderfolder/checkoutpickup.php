<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<main class="container-xv">
    <h2>Pickup</h2>
    <div class="row">
        <div class="col-sm-6 form-xv">
            <?php if(isset($validation)) : ?>
                <div class="alert alert-danger text-center">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif ; ?>
            <form action="/Checkout/pickup" method="post">
                <div class="form-floating inputfield-xv">
                    <input class="form-control" type="date" name="date" id="date" required>
                    <label for="date">Date</label>
                </div>
                <div class="form-floating inputfield-xv">
                    <input class="form-control inputfield-xv" type="time" name="time" id="time" required>
                    <label for="time">Time</label>
                </div>
                <button class="btn btn-db-xv" type="submit">Order</button>
            </form>
        </div>
        <div class="col-sm-6">
            <?php foreach ($products as $product):?>
                <div class="card card-xv">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h3><?=$product['product_title']?></h3>
                                <h5>Amount: <?=$product['itemrow']['product_amount']?></h5>
                            </div>
                            <div class="col-6">
                                <h4>€<?=$product['product_price']?> a piece</h4>
                                <h4>Calculated price: €<?=$product['calcprice']?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
            <h4>Total price: €<?= $price?></h4>
        </div>
    </div>
</main>


<?= $this->endSection('content')?>