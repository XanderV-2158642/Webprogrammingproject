<?= $this->extend('Layouts/shoplayout') ?>

<?= $this->section('content') ?>

<main class = "container">

    <form class="form" style = "margin-bottom: 30px;" method="get" action="/Shop/wood">
        <div class="row w-75 mx-auto">
            <div class="col d-flex align-items-center justify-content-center" style = "margin-bottom: 10px;">
                <div>
                    <h4>Filter</h4>
                    <div class = "form-check">
                        <input class="form-check-input" type="checkbox" id="Pellets" value="pellet" name = "product_sort[]" <?= (in_array('pellet', $form['sorts']) ? 'checked' : '')?>>
                        <label class="form-check-label" for = "">Pellets</label>
                    </div>
                    <div class = "form-check">
                        <input class="form-check-input" type="checkbox" id="Briquettes" value="briquette" name = "product_sort[]" <?= (in_array('briquette', $form['sorts']) ? 'checked' : '')?>>
                        <label class="form-check-label" for = "">Briquettes</label>
                    </div>
                    <div class = "form-check">
                        <input class="form-check-input" type="checkbox" id="Firewood" value="firewood" name = "product_sort[]" <?= (in_array('firewood', $form['sorts']) ? 'checked' : '')?>>
                        <label class="form-check-label" for = "">Firewood</label>
                    </div>
                </div>
            </div>
            <div class = "col d-flex align-items-center justify-content-center" style = "margin-bottom: 10px;">
                <div>
                    <h4>Heritage</h4>
                    <select id="Heritage" name="heritage">
                        <option value="All" <?=($form['heritage'] == 'All' ||$form['heritage'] == '')? 'selected' : ''?>>All</option>
                        <?php foreach($countries as $country) : ?>
                            <option value = "<?= $country ?>" <?=$country == $form['heritage'] ? 'selected' : ''?>><?= $country ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class = "col d-flex align-items-center justify-content-center" style = "margin-bottom: 10px;">
                <div>
                    <h4>Price</h4>
                    <label for="minPrice">Minimum Price</label><br>
                    <input type="number" id="minPrice" name ="min_price" value="<?= set_value('min_price', $form['minprice']) ?>"><br>
                    <label for="minPrice">Maximum Price</label><br>
                    <input type="number" id="maxPrice" name="max_price" value="<?= set_value('max_price', $form['maxprice']) ?>">
                </div>
            </div>
            <div class = "col d-flex align-items-center justify-content-center" style = "margin-bottom: 10px;">
                <div>
                    <h4>Search</h4><br>
                    <input type="submit" value="Confirm">
                </div>
            </div>
        </div>
    </form>



    <!--Product cards -->
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
                            <a href="/Product/productpage/<?= $product['product_id']?>" class="btn btn-primary">Buy</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
    <!--Product cards -->

    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item <?= $pagenr == 1 ? 'disabled' : ''?>">
                <a class="page-link" href="/Shop/wood/<?=$pagenr-1?>/<?=$filteruri?>">Previous</a>
            </li>

            <!--first page-->
            <?php if ($pagenr != 1): ?>
                <li class="page-item"><a class="page-link" href="/Shop/wood/1/<?=$filteruri?>">1</a></li>
            <?php endif;?>

            <?php if (($pagenr - 2) > 2): ?>
                <li class="page_item disabled"><a class="page-link" href="">...</a></li>
            <?php endif;?>


            <!--2 pages before this-->
            <?php for ($i = -2; $i < 0 ; $i++):
                if (($pagenr + $i)>1):?>
                <li class="page-item">
                    <a class="page-link" href="/Shop/wood/<?=$pagenr + $i?>/<?=$filteruri?>"><?= $pagenr + $i?></a>
                </li>
            <?php endif ; endfor;?>

            <!--this page-->
            <li class="page-item active">
                <span class="page-link"><?=$pagenr?></span>
            </li>

            <!--2 pages after this-->
            <?php for ($i = 1; $i < 3 ; $i++):
                if (($pagenr + $i)<$lastpage):?>
                <li class="page-item">
                    <a class="page-link" href="/Shop/wood/<?=$pagenr + $i?>/<?=$filteruri?>"><?= $pagenr + $i?></a>
                </li>
            <?php endif ; endfor;?>


            <?php if (($pagenr + 3) < $lastpage): ?>
                <li class="page_item disabled"><a class="page-link" href="">...</a></li>
            <?php endif;?>


            <!--last page-->
            <?php if ($pagenr != $lastpage): ?>
                <li class="page-item"><a class="page-link" href="/Shop/wood/<?=$lastpage?>/<?=$filteruri?>"><?= $lastpage?></a></li>
            <?php endif;?>

            
            <li class="page-item">
                <a class="page-link <?= ($pagenr == $lastpage) ? 'disabled': ''?>" href="/Shop/wood/<?=$pagenr+1?>/<?=$filteruri?>">Next</a>
            </li>
        </ul>
    </nav>

    



</main>

<?= $this->endSection('content')?>