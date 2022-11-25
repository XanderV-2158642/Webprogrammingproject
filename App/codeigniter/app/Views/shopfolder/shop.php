<?= $this->extend('Layouts/shoplayout') ?>

<?= $this->section('content') ?>

<main class = "container">
    <!-- Product cards -->
    <div class = "row m-auto">
        <?php foreach ($products as $product):?>
            <div class="card mb-3 w-75 mx-auto">
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?php if (isset($product['picture_name'])){echo base_url('/images/product')."/".$product['picture_name'];}?>" class="img-fluid rounded-start" alt="..." style="width: 400px; height: 300px; object-fit: contain;">
                    </div>
                    <div class="col-md-5">
                        <div class="card-body">
                            <h4 class="card-title"><?= $product['product_title']?></h4>
                            <h5 class=""><?= $product['product_sort']?></h5>
                            <p class="card-text"><?= $product['product_description']?></p>
                            <p class="card-text"><small class="text-muted">from: <?= $product['product_heritage']?></small></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-body">
                            <h5 style="display: inline;">€<?= $product['product_price']?>&nbsp</h5>
                            <h5 class="text-black-50" style="display: inline;">per <?= $product['package']?></h5><br>
                            <?php if ($product['product_type'] !== 'electricity'):?>
                            <h5 class="text-black-50">of <?= $product['product_size']." ".$product['unit']?></h5>
                            <?php else: echo '<br>'; endif;?>
                            <a href="/product/productpage/<?= $product['product_id']?>" class="btn btn-primary">Buy</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
    <!-- Product cards -->

    <p>*Filters are only accesible after choosing certain product*</p>
</main>

<?= $this->endSection('content')?>