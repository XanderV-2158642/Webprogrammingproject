<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<?php if(isset($profilenotfound)):?>

    <div class="container text-center">
        <h1>Profile not found</h1>
    </div>

<?php else:?>

<main class="container">
    <h2>Profile page</h2>
    <div class="row" style="margin-bottom: 10px;" >
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
                <a href="#" class = "btn btn-primary" style="margin-bottom: 10px;"> Message this user</a>
            <?php endif; ?>
        </div>
    </div>
    <?php if($page === $loggedinuser):?>
        <a href="/profile/logout" class = "btn btn-secondary" style="margin-bottom: 10px;">Log out</a>
        <a href="/profile/edit" class = "btn btn-warning" style="margin-bottom: 10px; float: right;">Edit profile</a></br>
        <hr>
        <a href="/product/createproduct" class = "btn btn-primary" style="margin-bottom: 10px;"> Sell new product</a>
    <?php endif;?>
        <h5>Active products</h5>
        <?php foreach($products as $product): ?>
            <div class = "card" style = "margin-bottom: 10px">
                <div class = "card-body">
                    <div style ="margin-bottom: 10px;">
                        <h5 style="display: inline;"><a href="/product/productpage/<?= $product['product_id']?>" class="link-dark" ><?=$product['product_title'] ?></a></h5>
                        <p style="display: inline; float: right; padding: 0; margin: 0;">€<?= $product['product_price']?></p>
                        <?php if ($product['product_type'] !== 'electricity'):?>
                            <h6><?= $product['product_sort']?></h6>
                        <?php endif;?>
                    </div>
                    <div>
                        <?php if($page === $loggedinuser):?>
                        <a href="/product/edit/<?= $product['product_id']?>" class = " btn btn-warning">Edit</a>                       
                        <a href="#" class = "btn btn-danger text-end" style="float: right;">Remove</a>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    

</main>

<?php endif;?>
<?= $this->endSection('content') ?>