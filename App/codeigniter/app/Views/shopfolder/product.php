<?= $this->extend('Layouts/shoplayout') ?>

<?= $this->section('content') ?>

<main class = "container-xv">
    <div class = "row">
        <div class = "col-sm-6">
            <div id="carouselExampleControls" class="carousel slide" data-mdb-ride="carousel" data-mdb-interval="false">
                <div class="carousel-inner">
                    <?php 
                    $first = true;
                    foreach($pictures as $picture): ?>
                        <div class="carousel-item <?=($first? "active" : "")?> text-center" data-mdb-interval="false" style="background-color: #EEEEEE;">
                            <img src="<?=base_url("/Images/Product")."/".$picture['picture_name']?>" alt="Image of product" class="img-fluid" style="width: 600px; height: 300px; object-fit: contain;">
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
                        <div>
                            <p> 
                                <?= $product['product_description'] ?><br>
                            </p>
                            <p>
                                From: <?= $product['product_heritage'] ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <?php if ($product['product_type'] !== 'electricity'):?>
                            <h3><?= $product['product_size']." ".$sizeunit[$product['product_type']]?></h3>
                        <?php endif;?>
                        <h3 style="display: inline;">€<?= $product['product_price']?></h3>
                        <h3 class="text-black-50" style="display: inline;"> /<?= $packaging[$product['product_type']]?></h3><br><br>
                        <h5 class="text-black-50"><?=$product['product_amount']?> items left</h5>
                    </div>
                </div>                
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?php if ($product['product_amount']>0):?>
                    <form action="/Cart/addtocart/<?=$product['product_id']?>" class="text-center" method="post">
                        <div class="form-floating">           
                            <input type="number" class="form-control" name="product_amount" id="itemamount" style="margin-top: 10px; margin-bottom: 10px;">
                            <label for="itemamount">Amount</label>
                        </div>
                        <div class="form-floating" >
                            <button class="btn btn-db-xv" type="submit">Add to cart</button>
                        </div>
                    </form>
                    <?php else:?>
                        <h6>No items left, Want to receive a notification when item is back in stock?</h6>
                        <a class="btn btn-db-xv" href="/Notifications/addnotification/<?=$product['product_id']?>"> Notify me </a>
                    <?php endif;?>
                </div>
                <div class="col-md-6 text-center">
                    <a href="/Profile/profilepage/<?=$product['user_id']?>" class = "btn btn-ye-xv" style="margin: 10px"> Go to seller profile</a>
                    <?php if (session()->getFlashdata('succesfully_added')):?>
                        <div class="alert alert-success text-center">
                            <h6><?= session()->getFlashdata('succesfully_added')?></h6>
                        </div>
                    <?php endif;?>
                    <?php if (session()->getFlashdata('amount_input')):?>
                        <div class="alert alert-danger text-center">
                            <h6><?= session()->getFlashdata('amount_input')?></h6>
                        </div>
                    <?php endif;?>
                    <?php if (session()->getFlashdata('notifysucces')):?>
                        <div class="alert alert-success text-center">
                            <h6><?= session()->getFlashdata('notifysucces')?></h6>
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>

    <?php if(isset($video)):?>
    <div id="video" class="text-center">
        <iframe src="<?=base_url("/Videos/Product")."/".$video['video_name']?>" class="img-fluid" style="width: 100%; height: 300px; object-fit: contain;"></iframe>
    </div>
    <?php endif;?>

    <div>
        <h3>Reviews</h3>
        <?php foreach ($reviews as $review): ?>
            <div class = "card" style = "margin-bottom: 10px">
                <div class = "card-body">
                    <h5><?=$review['user']['user_name'] ?></h5>
                    <p class= "card-text"><?=$review['score'] ?>/5</p>
                    <p class= "card-text"><?=$review['description'] ?></p>
                </div>
            </div>
        <?php endforeach ?>
        
    </div>
</main>




<?= $this->endSection('content')?>