<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>


<main class = "container text-center">
    <div>
        <h2>Choose the product type you want to sell</h2>
    </div>
    <div >
        <a href="/Product/createwood" class = "btn btn-db-xv">Wood product</a>
    </div>
    <div >
        <a href="/Product/createoil" class = "btn btn-db-xv">Oil product</a>
    </div>
    <div >
        <a href="/Product/creategas" class = "btn btn-db-xv">Gas product</a>
    </div>
    <div >
        <a href="/Product/createelec" class = "btn btn-db-xv">Electricity product</a>
    </div>
</main>

<?= $this->endSection('content') ?>