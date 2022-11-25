<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<main class="container">
    <div class="">
        <h2>edit this oil product</h2>
        <?php if(isset($validation)) : ?>
            <div class="alert alert-danger text-center">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif ; ?>
        <form action="/product/edit/<?=$product['product_id']?>" class = "w-75" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
                <label for="producttitle" class="col-sm-3 col-form-label">Title</label>
                <div class = "col-sm-9">
                    <input type="text" name="product_title" class="form-control" id = "producttitle" value="<?=set_value('product_title', $product['product_title']);?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3 col-form-label">
                    <label for="productprice" >Price&nbsp;</label><small class="text-black-50">per package</small>
                </div>
                <div class = "col-sm-9">
                    <input type="number" name ="product_price" class="form-control" id = "productprice" step=".01" value="<?=set_value('product_price', $product['product_price']);?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="productheritage" class="col-sm-3 col-form-label">Heritage</label>
                <div class = "col-sm-9">
                    <input type="text" name= "product_heritage" class="form-control" id = "productheritage" value="<?=set_value('product_heritage', $product['product_heritage']);?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3 col-form-label">
                    <label for="" >Package size&nbsp;</label>
                    <small class="text-black-50">In Liters</small>
                </div>
                <div class = "col-sm-9">
                    <input type="number" name="product_size" class="form-control" id = "productsize" step=".5" value="<?=set_value('product_size', $product['product_size']);?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3 col-form-label">
                    <label for="productamount" >Amount&nbsp;</label>
                    <small class="text-black-50">of packages</small>
                </div>
                <div class = "col-sm-9">
                    <input type="number" name="product_amount" class="form-control" id = "productamount" value="<?=set_value('product_amount', $product['product_amount']);?>">
                </div>
            </div>

            <fieldset class="row mb-3">
                <legend class ="col-form-label col-sm-3">Sort</legend>
                <div class = "col-sm-9">
                    <div class ="form-check">
                        <input type="radio" name="product_sort" value="petroluem" id="petroluem" class="form-check-input" <?= ($product['product_sort'] =='petroleum' ? 'checked' : '')?>>
                        <label for="pellet" class="form-check-label">Petroluem</label>
                    </div>
                    <div class ="form-check">
                        <input type="radio" name="product_sort" value="synthetic" id="synthetic" class="form-check-input" <?= ($product['product_sort'] =='synthetic' ? 'checked' : '')?>>
                        <label for="briquette" class="form-check-label">Synthetic</label>
                    </div>
                    <div class ="form-check">
                        <input type="radio" name="product_sort" value="other" id="other" class="form-check-input" <?= ($product['product_sort'] =='other' ? 'checked' : '')?>>
                        <label for="other" class="form-check-label">Other</label>
                    </div>
                </div>
            </fieldset>

            <div class = "row mb-3">
            <label for="description" class="col-sm-3 col-form-label">Description</label>
                <div class = "col-sm-9">
                    <textarea class="form-control" name ="product_description" id="description"><?=set_value('product_description', $product['product_description']);?></textarea>
                </div>   
            </div>

            <div class = "row mb-3">
                <label for="" class="col-form-label col-sm-3" >Upload extra product picture(s)</label>
                <div class="col-sm-9">
                    <input type="file" multiple name="product_picture[]" class = "form-control" id="image">
                </div>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
        <div class="row">
                <?php foreach($pictures as $picdata): ?>
                    <div class="col-sm text-center">
                        <img src="/Images/Product/<?= $picdata['picture_name']?>" style="max-width: 600px; max-height: 300px; margin-bottom: 10px;"></br>
                        <?php if(sizeof($pictures)>1):?>
                            <a href="/product/removepic/<?= $picdata['picture_id']?>" class = "btn btn-danger" style="margin-bottom: 10px;">remove Picture</a>
                        <?php else:?>
                            <small>You cant remove this image because a product always needs an image</small>
                        <?php endif;?>
                    </div>
                <?php endforeach;?>
            </div>
    </div>
</main>

<?= $this->endSection('content') ?>