<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<main class="container-xv">
    <h2>Checkout</h2>
    <div class="row">
        <div class="col-sm-6">
        <h4>Choose how you want to get your items</h4>
            <form action="/Checkout" method="post">
                <fieldset>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="ordertype" value="pickup" id="PickupOrder" checked>
                        <label class="form-check-label" for="PickupOrder">Pickup</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="ordertype" value="delivery" id="DeliveryOrder">
                        <label class="form-check-label" for="DeliveryOrder">Delivery</label>
                    </div>
                </fieldset>
                <button class="btn btn-db-xv" type="submit">Confirm</button>
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