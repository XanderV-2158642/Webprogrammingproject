<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('/css/bootstrap.css');?>">
    <?php if(isset($stylesheets)):
        foreach ($stylesheets as $stylesheet):?>
        <link rel= "stylesheet" href="<?= base_url($stylesheet);?>">
        <?php endforeach; endif;?>
    <title>Energyshop</title>
</head>
<body>
<header class = "container" style = "margin-bottom: 50px;">
    <h1>Energyshop</h1>
    <nav class= "navbar navbar-expand-lg" style = "background-color: #EEEEEE;">
        <a class="navbar-brand" href="/">Home</a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" aria-current="page" href="/Cart">Cart</a></li>
            <li class="nav-item"><a class="nav-link" aria-current="page" href="/Messages">Messages</a></li>
            <li class="nav-item"><a class="nav-link" aria-current="page" href="/Orders">Orders</a></li>
        </ul>
        <span class="navbar-text">Your energy solution</span>
    </nav>  
</header>

<!-- ------------------------Header--------------------- -->


    
<?= $this->renderSection('content') ?>



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

<script src="<?= base_url('/JS/bootstrap.js')?>"></script>
</body>
</html>