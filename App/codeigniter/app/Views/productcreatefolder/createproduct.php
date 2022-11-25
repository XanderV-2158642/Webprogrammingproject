<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>


<main class = "container text-center">
    <div style="margin-bottom: 20px;">
        <h2>Choose the product type you want to sell</h2>
    </div>
    <div style="margin-bottom: 20px;">
        <a href="/product/createwood" class = "btn btn-primary">Wood product</a>
    </div>
    <div style="margin-bottom: 20px;">
        <a href="/product/createoil" class = "btn btn-primary">Oil product</a>
    </div>
    <div style="margin-bottom: 20px;">
        <a href="/product/creategas" class = "btn btn-primary">Gas product</a>
    </div>
    <div style="margin-bottom: 20px;">
        <a href="/product/createelec" class = "btn btn-primary">Electricity product</a>
    </div>
</main>

<?= $this->endSection('content') ?>