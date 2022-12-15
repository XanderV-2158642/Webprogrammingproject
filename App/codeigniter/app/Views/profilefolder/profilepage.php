<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<?php if(isset($profilenotfound)):?>

    <div class="container text-center">
        <h1>Profile not found</h1>
    </div>

<?php else:?>

<main class="container-xv">
    <h2>Profile page</h2>
    <div class="row" >
        <div class="col-sm-6">
            <div id="carouselExampleControls" class="carousel slide" data-mdb-ride="carousel" data-mdb-interval="false">
                <div class="carousel-inner">
                    <?php 
                    $first = true;
                    foreach($pictures as $picture): ?>
                        <div class="carousel-item <?=($first? "active" : "")?>" data-mdb-interval="false" style="background-color: #EEEEEE;">
                            <img src=<?=base_url("/Images/Profile")."/".$picture['picture_name']?> alt="Image of profile" style="max-width: 600px; max-height: 300px; width:100%; height:100%; object-fit: contain;">
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
    
        <div class="col-sm-6">
            <h2><?= $name?></h2>
            <p><?= $description?></p>
            <h3>Contact</h3>
            <h6><?= $Email?></h6>
            <h6><?= $Phone?></h6>
            <?php if($page !== $loggedinuser): ?>
                <a href="/Messages/writemessage/<?=$page?>" class = "btn btn-db-xv" style="margin-bottom: 10px;"> Message this user</a>
            <?php endif; ?>
        </div>
    </div>
    <?php if($page === $loggedinuser):?>
        <a href="/Profile/logout" class = "btn btn-gr-xv" style="margin-bottom: 10px;">Log out</a>
        <a href="/Profile/edit" class = "btn btn-ye-xv" style="margin-bottom: 10px; float: right;">Edit profile</a></br>
        <hr>
        <a href="/Product/createproduct" class = "btn btn-db-xv" style="margin-bottom: 10px;"> Sell new product</a>
    <?php endif;?>
        <h5>Active products</h5>
        <?php foreach($products as $product): ?>
            <div class = "card" style = "margin-bottom: 10px">
                <div class = "card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h5><a href="/Product/productpage/<?= $product['product_id']?>" class="text-link-xv" ><?=$product['product_title'] ?></a></h5>
                            <?php if ($product['product_type'] !== 'electricity'):?>
                                <h6><?= $product['product_sort']?></h6>
                            <?php endif;?>
                            <p>€<?= $product['product_price']?></p>
                            <?php if ($page === $loggedinuser):?>
                            <p>Amount left: <?=$product['product_amount']?></p>
                            <p>Amount sold: <?=$product['amount_sold']?></p>
                            <?php endif;?>
                        </div>
                        <div class="col-md-5">
                            <p>
                                <?= $product['product_description']?>
                            </p>
                        </div>
                        <?php if($page === $loggedinuser):?>
                            <div class="col-md-2">
                                <a href="/Product/edit/<?= $product['product_id']?>" class = " btn btn-ye-xv">Edit</a>     
                            </div>
                            <div class="col-md-2">               
                                <a href="/Product/removeproduct/<?= $product['product_id']?>" class = "btn btn-dr-xv">Remove</a>
                            </div> 
                        <?php endif;?>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    

</main>

<?php endif;?>
<?= $this->endSection('content') ?>