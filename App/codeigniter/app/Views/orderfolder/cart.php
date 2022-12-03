<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<main class="container">
    <?php if(isset($emptycart)): ?>
        <div>
            <h2>cart</h2>
            <h3>Your cart is empty</h3>
        </div>
    <?php else:?>


    <div class = "row">
        <div class="col-sm-8">
            <h2>Cart</h2>
            <?php foreach ($products as $product): ?>
                <div class="card" style="margin-bottom: 10px;">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-4">
                                <h3><a href="#" class = "link-dark"><?= $product['product_title']?></a></h3>
                                <div>
                                    <h6><?=$product['product_amount']?> items left!</h6>
                                </div>
                                <a href="/cart/removeproduct/<?=$product['itemrow']['cart_item_id']?>" class="btn btn-danger">Remove product</a>
                            </div>

                            <div class="col-md-5">
                                <form action="Cart/editline/<?=$product['itemrow']['cart_item_id']?>" method="post">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-floating">
                                                <input type="number" id="productAmount" name="product_amount" class="form-control" value = "<?= set_value('product_amount', $product['itemrow']['product_amount'])?>">
                                                <label for="productAmount">Amount</label>
                                            </div> 
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-primary" type="submit" style="padding: 15px;">Change</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-3">
                                <h5>Price: <?=$product['product_price']?></h5>
                                <?php if (session()->getFlashdata('amount_input'.$product['itemrow']['cart_item_id'])):?>
                                    <div class="alert alert-danger text-center" style="margin-bottom: 0; padding: 8px;">
                                        <h6><?= session()->getFlashdata('amount_input'.$product['itemrow']['cart_item_id'])?></h6>
                                    </div>
                                <?php endif;?>
                            </div>
                        </div>
                        
                    </div>
                </div>
            <?php endforeach;?>
        </div>

        <div class = "col-sm-4 text-center">
            <h4>Pricing</h4>
            <h5>total: €<?= $price?></h5>
            <a href="/checkout" class = "btn btn-primary text-center"> Checkout </a>
        </div>
    </div>
    <?php endif;?>
</main>


<?= $this->endSection('content')?>