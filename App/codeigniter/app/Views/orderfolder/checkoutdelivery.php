<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<main class="container">
    <h2>Delivery</h2>
    <div class="row">
        <div class="col-sm-6" style="margin-bottom: 10px;">
            <?php if(isset($validation)) : ?>
                <div class="alert alert-danger text-center">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif ; ?>
            <form action="/checkout/delivery" method="post">
                <div class="form-floating">
                    <input class="form-control" type="text" name="country" id="country">
                    <label for="country">Country</label>
                </div>
                <div class="form-floating">
                    <input class="form-control" type="text" name="city" id="city">
                    <label for="city">City</label>
                </div>
                <div class="form-floating">
                    <input class="form-control" type="text" name="postal" id="postal">
                    <label for="postal">Postal code</label>
                </div>
                <div class="form-floating">
                    <input class="form-control" type="text" name="street" id="street">
                    <label for="street">Street name</label>
                </div>
                <div class="form-floating">
                    <input class="form-control" type="text" name="number" id="number">
                    <label for="number">House number</label>
                </div>
                <button class="btn btn-primary" type="submit">Order</button>
            </form>
        </div>
        <div class="col-sm-6">
            <?php foreach ($products as $product):?>
                <div class="card" style="margin-bottom: 10px;">
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