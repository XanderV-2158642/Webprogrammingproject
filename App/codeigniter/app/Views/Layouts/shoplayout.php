<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/css/bootstrap.css');?>" media="all">
    <title>Energyshop</title>
</head>
<body>
<header class = "container" style = "margin-bottom: 50px;">
    <h1>Energyshop</h1>
    <nav class= "navbar navbar-expand-lg" style = "background-color: #EEEEEE;">
        <a class="navbar-brand" href="/">Home</a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" aria-current="page" href="#">Cart</a></li>
            <li class="nav-item"><a class="nav-link" aria-current="page" href="#">Messages</a></li>
        </ul>
        <span class="navbar-text">Your energy solution</span>
    </nav>  
</header>

<!-- ------------------------Header--------------------- -->

<div class = "container">
    <h2>Shop</h2>
    <!-- NAVBAR -->
    <div style = "margin-bottom: 20px;">
        <nav class= "navbar navbar-expand-lg" style = "background-color: #EEEEEE;">
            <a class="navbar-brand" href="/shop">Products</a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" aria-current="page" href="/shop/wood">Wood</a></li>
                <li class="nav-item"><a class="nav-link" aria-current="page" href="/shop/oil">Oil</a></li>
                <li class="nav-item"><a class="nav-link" aria-current="page" href="/shop/gas">Gas</a></li>
                <li class="nav-item"><a class="nav-link" aria-current="page" href="/shop/electricity">Electricity</a></li>
            </ul>
            <span class="navbar-text">Pick the product you are searching for</span>
        </nav>
    </div>
    <!-- NAVBAR -->
</div>



<!-- main page -->
<?= $this->renderSection('content') ?>
<!-- main page -->





<!-- ------------------------Footer--------------------- -->

<footer class = "footer, container" 
        style=" padding: 30px; background-color: #EEEEEE; margin-top: 30px;">
    <h5 class="text-md-right" style = "text-align: center; padding-bottom: 20px;">Info</h5>
    <div class = "row">
        <div class="col-sm">
            <ul class="list-unstyled" style = "display: table; margin: 0 auto; ">
                <li><a class = "link-dark" href="#">Contact</a></li>
            </ul>
        </div>
        <div class="col-sm">
            <ul class="list-unstyled" style = "display: table; margin: 0 auto; ">
                <li><a class = "link-dark" href="#">About</a></li>
            </ul>
        </div>
        <div class="col-sm">
            <ul class="list-unstyled" style = "display: table; margin: 0 auto; ">
                <li><a class = "link-dark" href="#">Service</a></li>
            </ul>
        </div>
        <div class="col-sm">
            <ul class="list-unstyled" style = "display: table; margin: 0 auto; ">
                <li><a class = "link-dark" href="#">Terms of bussiness</a></li>
            </ul>
        </div>
    </div>
    <h5 class="text-md-right" style = "text-align: center; padding-top: 30px;">Energy shop</h5>   
</footer>

<script src="<?= base_url("/JS/bootstrap.js")?>"></script>
</body>
</html>