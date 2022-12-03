<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<main class="container">
    <h2>Orders</h2>
    <hr>
    <h3>Buyer</h3>
    <div>
        <h4>Placed orders</h4>
        <?php foreach($placed_orders as $p_o):?>
            <div class="card w-75" style="margin-bottom: 10px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <h5 class="card_title"><?=$p_o['product']['product_title']?></h5>
                            <small>Amount: <?=$p_o['order']['amount']?></small>
                            <p class="card-text">€<?=$p_o['product']['product_price']*$p_o['order']['amount']?></p>
                        </div>
                        <div class="col-sm-4">
                            <?php if(isset($p_o['order']['delivered'])):?>
                                <h6>Delivery</h6>
                                <p style="margin:0"><?= $p_o['order']['address']['p1']?></p>
                                <p style="margin:0"><?= $p_o['order']['address']['p2']?></p>
                            <?php elseif(isset($p_o['order']['pickedup'])): ?>
                                <h6>PickUp</h6>
                                <p style="margin:0"><?=$p_o['order']['date']?></p>
                                <p style="margin:0">at <?=$p_o['order']['time']?></p>
                            <?php endif;?>
                        </div>
                        <div class="col-sm-4 text-center">
                            <?php if(isset($p_o['order']['delivered'])):
                                    if($p_o['order']['delivered']):?>
                                        <a href="" class="btn btn-secondary disabled" style="margin-bottom:5px;">Order delivered</a><br>
                                        <a href="" class="btn btn-primary">Write review</a>
                                    <?php else:?>
                                        <a href="/Orders/cancelorder/delivery/<?= $p_o['order']['order_id']?>" class="btn btn-danger">Cancel</a>
                                    <?php endif;?>          
                            <?php elseif(isset($p_o['order']['pickedup'])):
                                if($p_o['order']['pickedup']):?>
                                    <a href="" class="btn btn-secondary disabled" style="margin-bottom:5px;">Order picked up</a><br>
                                    <a href="" class="btn btn-primary">Write review</a>
                                <?php else:?>
                                    <a href="/Orders/cancelorder/pickup/<?= $p_o['order']['order_id']?>" class="btn btn-danger">Cancel</a>
                                <?php endif;?>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
    <div>
        <h4>Delivered orders</h4>
        <?php foreach($placed_orders_delivered as $p_o_d):?>
            <div class="card w-75" style="margin-bottom: 10px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <h5 class="card_title"><?=$p_o_d['product']['product_title']?></h5>
                            <small>Amount: <?=$p_o_d['order']['amount']?></small>
                            <p class="card-text">€<?=$p_o_d['product']['product_price']*$p_o_d['order']['amount']?></p>
                        </div>
                        <div class="col-sm-4">
                            <?php if(isset($p_o_d['order']['delivered'])):?>
                                <h6>Delivery</h6>
                                <p style="margin:0"><?= $p_o_d['order']['address']['p1']?></p>
                                <p style="margin:0"><?= $p_o_d['order']['address']['p2']?></p>
                            <?php elseif(isset($p_o_d['order']['pickedup'])): ?>
                                <h6>PickUp</h6>
                                <p style="margin:0"><?=$p_o_d['order']['date']?></p>
                                <p style="margin:0">at <?=$p_o_d['order']['time']?></p>
                            <?php endif;?>
                        </div>
                        <div class="col-sm-4 text-center">
                            <?php if(isset($p_o_d['order']['delivered'])):
                                    if($p_o_d['order']['delivered']):?>
                                        <a href="" class="btn btn-secondary disabled" style="margin-bottom:5px;">Order delivered</a><br>
                                        <?php if(!isset($p_o_d['order']['reviewwritten'])):?>
                                            <a href="/reviews/writereview/<?=$p_o_d['product']['product_id']?>" class="btn btn-primary">Write review</a>
                                        <?php endif;?>
                                    <?php else:?>
                                        <a href="/Orders/cancelorder/delivery/<?= $p_o_d['order']['order_id']?>" class="btn btn-danger">Cancel</a>
                                    <?php endif;?>          
                            <?php elseif(isset($p_o_d['order']['pickedup'])):
                                if($p_o_d['order']['pickedup']):?>
                                    <a href="" class="btn btn-secondary disabled" style="margin-bottom:5px;">Order picked up</a><br>
                                    <?php if(!isset($p_o_d['order']['reviewwritten'])):?>
                                        <a href="/reviews/writereview/<?=$p_o_d['product']['product_id']?>" class="btn btn-primary">Write review</a>
                                    <?php endif;?>
                                <?php else:?>
                                    <a href="/Orders/cancelorder/pickup/<?= $p_o_d['order']['order_id']?>" class="btn btn-danger">Cancel</a>
                                <?php endif;?>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
    <hr>
    <h3>Seller</h3>
    <div>
        <h4>Orders to handle</h4>
        <?php foreach($unhandled_orders as $u_o):?>
            <div class="card w-75" style="margin-bottom: 10px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <h5 class="card_title"><?=$u_o['product']['product_title']?></h5>
                            <small>Amount: <?=$u_o['order']['amount']?></small>
                            <p class="card-text">€<?=$u_o['product']['product_price']*$u_o['order']['amount']?></p>
                        </div>
                        <div class="col-sm-4">
                            <?php if(isset($u_o['order']['delivered'])):?>
                                <h6>Delivery</h6>
                                <p style="margin:0"><?= $u_o['order']['address']['p1']?></p>
                                <p style="margin:0"><?= $u_o['order']['address']['p2']?></p>
                            <?php elseif(isset($u_o['order']['pickedup'])): ?>
                                <h6>PickUp</h6>
                                <p style="margin:0"><?=$u_o['order']['date']?></p>
                                <p style="margin:0">at <?=$u_o['order']['time']?></p>
                            <?php endif;?>
                        </div>
                        <div class="col-sm-4 text-center">
                            <?php if(isset($u_o['order']['delivered'])):?>
                                    <a href="/Orders/completeOrder/delivery/<?=$u_o['order']['order_id']?>" class="btn btn-success">Confirm delivery</a>
                            <?php elseif(isset($u_o['order']['pickedup'])):?>
                                <a href="/Orders/completeOrder/pickup/<?=$u_o['order']['order_id']?>" class="btn btn-success">Confirm pickup</a>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
    <div>
        <h4>Delivered orders</h4>
        <?php foreach($delivered_orders as $d_o):?>
            <div class="card w-75" style="margin-bottom: 10px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <h5 class="card_title"><?=$d_o['product']['product_title']?></h5>
                            <small>Amount: <?=$d_o['order']['amount']?></small>
                            <p class="card-text">€<?=$d_o['product']['product_price']*$d_o['order']['amount']?></p>
                        </div>
                        <div class="col-sm-4">
                            <?php if(isset($d_o['order']['delivered'])):?>
                                <h6>Delivery</h6>
                                <p style="margin:0"><?= $d_o['order']['address']['p1']?></p>
                                <p style="margin:0"><?= $d_o['order']['address']['p2']?></p>
                            <?php elseif(isset($d_o['order']['pickedup'])): ?>
                                <h6>PickUp</h6>
                                <p style="margin:0"><?=$d_o['order']['date']?></p>
                                <p style="margin:0">at <?=$d_o['order']['time']?></p>
                            <?php endif;?>
                        </div>
                        <div class="col-sm-4 text-center">
                            <?php if(isset($d_o['order']['delivered'])):?>
                                        <a href="" class="btn btn-secondary disabled">Order delivered</a>     
                            <?php elseif(isset($d_o['order']['pickedup'])):?>
                                <a href="" class="btn btn-secondary disabled">Order picked up</a>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
</main>



<?= $this->endSection('content')?>