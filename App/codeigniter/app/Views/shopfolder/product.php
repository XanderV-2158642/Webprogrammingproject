<?= $this->extend('Layouts/shoplayout') ?>

<?= $this->section('content') ?>

<main class = "container">
    <div class = "row">
        <div class = "col-sm-6">
            <div id="carouselExampleControls" class="carousel slide" data-mdb-ride="carousel" data-mdb-interval="false">
                <div class="carousel-inner">
                    <?php 
                    $first = true;
                    foreach($pictures as $picture): ?>
                        <div class="carousel-item <?=($first? "active" : "")?>" data-mdb-interval="false" style="background-color: #EEEEEE;">
                            <img src=<?=base_url("/Images/Product")."/".$picture['picture_name']?> alt="Image of product" style="max-width: 600px; max-height: 300px; width:100%; height:100%; object-fit: contain;">
                        </div>
                    <?php $first = false; endforeach; ?>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
        <div class ="col-sm-6">
            <div class="card" style="padding: 10px; margin-bottom:10px;">
                <div class="row">
                    <div class="col-sm-6">
                        <h2><?= $product['product_title'] ?></h2>
                        <h4><?= $product['product_sort'] ?></h4>
                    </div>
                    <div class="col-sm-6">
                        <?php if ($product['product_type'] !== 'electricity'):?>
                            <h3><?= $product['product_size']." ".$sizeunit[$product['product_type']]?></h3>
                        <?php endif;?>
                        <h3 style="display: inline;">€<?= $product['product_price']?></h3>
                        <h5 class="text-black-50" style="display: inline;"> /<?= $packaging[$product['product_type']]?></h5>
                    </div>
                </div>
                <div>
                    <p> 
                        <?= $product['product_description'] ?><br>
                    </p>
                    <p>
                        From: <?= $product['product_heritage'] ?>
                    </p>
                </div>
            </div>
            <div>
                <a href="#" class = " btn btn-primary"> Add to cart</a>
            </div>
        </div>
    </div>

    <div>
        <h3>Reviews</h3>
        <?php foreach ($reviews as $review): ?>
            <div class = "card" style = "margin-bottom: 10px">
                <div class = "card-body">
                    <h5><?=$review['writer'] ?></h5>
                    <p class= "card-text"><?=$review['rating'] ?>/5</p>
                    <p class= "card-text"><?=$review['overview'] ?></p>
                </div>
            </div>
        <?php endforeach ?>
        
    </div>
</main>




<?= $this->endSection('content')?>