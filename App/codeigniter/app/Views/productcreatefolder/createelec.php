<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<main class="container-xv">
    <div class="">
    <h2>Add an electricity product</h2>
        <?php if(isset($validation)) : ?>
            <div class="alert alert-danger text-center">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif ; ?>

        <?php if(isset($nopicture)) : ?>
            <div class="alert alert-danger text-center">
                <p>please upload a picture<p>
            </div>
        <?php endif ; ?>

        <form action="/Product/createelec" class = "w-75 bot-space-xv" method="post" enctype="multipart/form-data" id="form">
            <div class="row mb-3">
                <label for="producttitle" class="col-sm-3 col-form-label">Title</label>
                <div class = "col-sm-9">
                    <input type="text" name="product_title" class="form-control" id = "producttitle">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3 col-form-label">
                    <label for="productprice" >Price&nbsp;</label>
                    <small class="text-black-50">per KWH</small>
                </div>
                <div class = "col-sm-9">
                    <input type="number" name ="product_price" class="form-control" id = "productprice" step=".01">
                </div>
            </div>

            <div class="row mb-3">
                <label for="productheritage" class="col-sm-3 col-form-label">Heritage</label>
                <div class = "col-sm-9">
                    <input type="text" name= "product_heritage" class="form-control" id = "productheritage">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3 col-form-label">
                    <label for="productamount" >Amount&nbsp;</label>
                    <small class="text-black-50">available in KWH</small>
                </div>
                <div class = "col-sm-9">
                    <input type="number" name="product_amount" class="form-control" id = "productamount">
                </div>
            </div>

            <div class = "row mb-3">
            <label for="description" class="col-sm-3 col-form-label">Description</label>
                <div class = "col-sm-9">
                    <textarea class="form-control" name ="product_description" id="description"></textarea>
                </div>   
            </div>

            <div class = "row mb-3">
                <label for="image" class="col-form-label col-sm-3" >Pictures (and video)</label>
                <div class="col-sm-9">
                    <input type="file" multiple name="product_picture[]" class = "form-control" id="image">
                </div>
            </div>

            <button type="submit" class="btn btn-db-xv">Create</button>
        </form>
    </div>
</main>

<script src="<?= base_url('/JS/createproduct.js')?>"></script>

<?= $this->endSection('content') ?>