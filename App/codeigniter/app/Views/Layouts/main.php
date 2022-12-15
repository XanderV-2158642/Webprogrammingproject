<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('/css/bootstrap.css');?>">
    <link rel="stylesheet" href="<?= base_url('/css/mainstylesheet.css');?>">
    <?php if(isset($stylesheets)):
        foreach ($stylesheets as $stylesheet):?>
        <link rel= "stylesheet" href="<?= base_url($stylesheet);?>">
        <?php endforeach; endif;?>
    <title>Energyshop</title>
</head>
<body class="d-flex flex-column">
<header class = "header-xv" >
    <h1 class="shop-title-xv">Energyshop</h1>
    <nav class= "navbar navbar-expand-lg navbar-dark navbar-xv">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?=base_url()?>">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>  
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="/Cart">Cart</a></li>
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="/Messages">Messages</a></li>
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="/Orders">Orders</a></li>
                </ul>
                <span class="navbar-text">Your energy solution</span>
            </div>
        </div>
    </nav>
</header>

<!-- ------------------------Header--------------------- -->


    
<?= $this->renderSection('content') ?>



<!-- ------------------------Footer--------------------- -->

<footer class = "flex-shrink-0 footer-xv container-xv">
    <h5 class="text-md-right text-center">Info</h5>
    <div class="container-fluid">
        <div class = "row">
            <div class="col-lg text-center">
                <a class="link-xv" href="#">Contact</a>
            </div>
            <div class="col-lg text-center">
                <a class="link-xv" href="#">Accessibility </a>
            </div>
            <div class="col-lg text-center">
                <a class="link-xv" href="#">Terms of bussiness</a>
            </div>
        </div>
    </div>
    <h5 class="text-md-right text-center">Energy shop</h5>   
</footer>

<script src="<?= base_url('/JS/bootstrap.js')?>"></script>
</body>
</html>