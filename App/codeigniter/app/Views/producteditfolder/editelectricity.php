<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<main class="container-xv">
    <div class="">
        <h2>edit this oil product</h2>
        <?php if(isset($validation)) : ?>
            <div class="alert alert-danger text-center">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif ; ?>
        <form action="/Product/edit/<?=$product['product_id']?>" class = "w-75 bot-space-xv" method="post" enctype="multipart/form-data" id="form">
            <div class="row mb-3">
                <label for="producttitle" class="col-sm-3 col-form-label">Title</label>
                <div class = "col-sm-9">
                    <input type="text" name="product_title" class="form-control" id = "producttitle" value="<?=set_value('product_title', $product['product_title']);?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3 col-form-label">
                    <label for="productprice" >Price&nbsp;</label>
                    <small class="text-black-50">per KWH</small>
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
                    <label for="productamount" >Amount&nbsp;</label>
                    <small class="text-black-50">available in KWH</small>
                </div>
                <div class = "col-sm-9">
                    <input type="number" name="product_amount" class="form-control" id = "productamount" value="<?=set_value('product_amount', $product['product_amount']);?>">
                </div>
            </div>

            <div class = "row mb-3">
            <label for="description" class="col-sm-3 col-form-label">Description</label>
                <div class = "col-sm-9">
                    <textarea class="form-control" name ="product_description" id="description"><?=set_value('product_description', $product['product_description']);?></textarea>
                </div>   
            </div>

            <div class = "row mb-3">
                <label for="image" class="col-form-label col-sm-3" >Upload extra product picture(s)</label>
                <div class="col-sm-9">
                    <input type="file" multiple name="product_picture[]" class = "form-control" id="image">
                </div>
            </div>

            <button type="submit" class="btn btn-ve-xv">Update</button>
        </form>
        <div class="row">
            <?php foreach($pictures as $picdata): ?>
                <div class="col-sm text-center">
                    <img src="/Images/Product/<?= $picdata['picture_name']?>" style="max-width: 600px; max-height: 300px; margin-bottom: 10px;"></br>
                    <?php if(sizeof($pictures)>1):?>
                        <a href="/Product/removepic/<?= $picdata['picture_id']?>" class = "btn btn-dr-xv" style="margin-bottom: 10px;">remove Picture</a>
                    <?php else:?>
                        <small>You cant remove this image because a product always needs an image</small>
                    <?php endif;?>
                </div>
            <?php endforeach;?>
        </div>
        <div>
            <?php if(isset($video)):?>
                <div id="video" class="text-center">
                    <iframe src="<?=base_url("/Videos/Product")."/".$video['video_name']?>" class="img-fluid" style="width: 100%; height: 300px; object-fit: contain;"></iframe>
                    <a href="/Product/removevid/<?= $video['video_id']?>" class = "btn btn-dr-xv" style=" max-width: 9rem; width: fit-content;">remove Video</a>
                </div>
            <?php endif;?>   
        </div>
    </div>
</main>

<script src="<?= base_url('/JS/editproduct.js')?>"></script>

<?= $this->endSection('content') ?>