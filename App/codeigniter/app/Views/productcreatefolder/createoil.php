<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<main class="container">
    <div class="">
    <h2>Add an oil product</h2>
        <?php if(isset($validation)) : ?>
            <div class="alert alert-danger text-center">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif ; ?>
        <form action="/product/createoil" class = "w-75" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
                <label for="producttitle" class="col-sm-3 col-form-label">Title</label>
                <div class = "col-sm-9">
                    <input type="text" name="product_title" class="form-control" id = "producttitle">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3 col-form-label">
                    <label for="productprice" >Price&nbsp;</label><small class="text-black-50">per package</small>
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
                    <label for="" >Package size&nbsp;</label>
                    <small class="text-black-50">in Liters</small>
                </div>
                <div class = "col-sm-9">
                    <input type="number" name="product_size" class="form-control" id = "productsize" step=".5">
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-sm-3 col-form-label">
                    <label for="productamount" >Amount&nbsp;</label>
                    <small class="text-black-50">of packages</small>
                </div>
                <div class = "col-sm-9">
                    <input type="number" name="product_amount" class="form-control" id = "productamount">
                </div>
            </div>

            <fieldset class="row mb-3">
                <legend class ="col-form-label col-sm-3">Sort</legend>
                <div class = "col-sm-9">
                    <div class ="form-check">
                        <input type="radio" name="product_sort" value="petroluem" id="synthetic" class="form-check-input">
                        <label for="" class="form-check-label">Petroluem</label>
                    </div>
                    <div class ="form-check">
                        <input type="radio" name="product_sort" value="synthetic" id="synthetic" class="form-check-input">
                        <label for="" class="form-check-label">Synthetic</label>
                    </div>
                    <div class ="form-check">
                        <input type="radio" name="product_sort" value="other" id="other" class="form-check-input" checked>
                        <label for="" class="form-check-label">Other</label>
                    </div>
                </div>
            </fieldset>

            <div class = "row mb-3">
            <label for="description" class="col-sm-3 col-form-label">Description</label>
                <div class = "col-sm-9">
                    <textarea class="form-control" name ="product_description" id="description"></textarea>
                </div>   
            </div>

            <div class = "row mb-3">
                <label for="" class="col-form-label col-sm-3" >Upload product picture(s)</label>
                <div class="col-sm-9">
                    <input type="file" multiple name="product_picture[]" class = "form-control" id="image">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</main>

<?= $this->endSection('content') ?>