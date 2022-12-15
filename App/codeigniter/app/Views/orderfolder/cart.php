<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<main class="container-xv">
    <?php if(isset($emptycart)): ?>
        <div>
            <h2>Cart</h2>
            <h3>Your cart is empty</h3>
        </div>
    <?php else:?>


    <div class = "row">
        <div class="col-sm-8">
            <h2>Cart</h2>
            <?php $i = 0; foreach ($products as $product):
                $i++;?>
                <div class="card card-xv">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h3><a href="/Product/productpage/<?= $product['product_id']?>" class="text-link-xv"><?= $product['product_title']?></a></h3>
                                <div>
                                    <h6><?=$product['product_amount']?> items left!</h6>
                                </div>
                                <a href="/Cart/removeproduct/<?=$product['itemrow']['cart_item_id']?>" class="btn btn-dr-xv">Remove product</a>
                            </div>

                            <div class="col-md-5">
                                <form action="Cart/editline/<?=$product['itemrow']['cart_item_id']?>" method="post" id="postForm<?= $i ?>">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="form-floating">
                                                <input type="number" id="productAmount<?=$i?>" name="product_amount" class="form-control" value = "<?= set_value('product_amount', $product['itemrow']['product_amount'])?>">
                                                <label for="productAmount">Amount</label>
                                            </div> 
                                        </div>
                                        <div class="col-4">
                                            <button class="btn btn-db-xv" type="submit" id="changebutton<?=$i?>">Change</button>
                                        </div>
                                    </div>
                                    <div>
                                        <p id = "message<?=$i?>"></p>
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
            <div class="checkout-xv">
                <h4>Pricing</h4>
                <h5 id="Totalprice">total: €<?= $price?></h5>
                <a href="/Checkout" class = "btn btn-db-xv text-center" onclick=""> Checkout </a>
            </div>
        </div>
    </div>
    <?php endif;?>
</main>

<?php if(!isset($emptycart)): ?>
<script>
    var item_amount = <?=$i?>;
    

    for(i = 1; i < item_amount+1; i++){
        var id = 'postForm' + i;
        document.getElementById(id).addEventListener('submit', prevent);
    }
    
    for(i = 1; i < item_amount+1; i++){
        var id = 'changebutton' + i;
        document.getElementById(id).style.visibility = 'hidden';
    }

    var elementcollection = new Array();
    for(i = 1; i < item_amount+1; i++){
        var id = 'productAmount' + i;
        elementcollection.push(document.getElementById(id));
    }
    console.log(elementcollection)

    elementcollection.forEach(function(elem){
        elem.addEventListener('input', function(){
            doChange(elem);
        });
    });


    function prevent(e){
        e.preventDefault();
    }


    function doChange(elem){
        var element_id = elem.id;

        var index = element_id.slice(13);

        var input = elem.value;
        var params = "number="+input;

        var url = "<?=base_url("/Cart/ajaxtest")?>/" + index

        fetch(url, {
            method: "post",
            headers: {
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest"
            },
            body: JSON.stringify({
                number: input
            })
        }).then(response => {
            return response.json();
        }).then((data) => {
            id = "message" + data.num
            document.getElementById(id).innerText = data.message;
            elem.value = data.newval;
            changePrice();
        })
    }

    function changePrice(){
        var url = "<?=base_url('/Cart/getTotalprice')?>";
        fetch(url, {
            method: "get",
            headers: {
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest"
            }
        }).then(response => {
            return response.json();
        }).then(data => {
            var price = data.price;
            var rounded = price.toFixed(2);
            document.getElementById('Totalprice').innerText = "total: €" + rounded;
        })
    }

</script>
<?php endif;?>
<?= $this->endSection('content')?>