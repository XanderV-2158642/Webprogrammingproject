<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<main class="container">
    <div class = "row">

        <div class="col-sm-8">
            <h2>Checkout</h2>
            <?php foreach ($products as $product): ?>
                <div class="card">
                    <div class="card-body">
                        <h3><a href="#" class = "link-dark"><?= $product['title']?></a></h3>
                        <a href="#" class="btn btn-danger">Remove product</a>
                    </div>
                </div>
            <?php endforeach;?>
        </div>

        <div class = "col-sm-4 text-center">
            <h4>Pricing</h4>
            <h5>total: €<?= $price?></h5>
            <a href="#" class = "btn btn-primary text-center"> Buy </a>
        </div>

    </div>
</main>


<?= $this->endSection('content')?>