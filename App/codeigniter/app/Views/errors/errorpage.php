<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('/css/bootstrap.css');?>">
    <title>Sorry!</title>
</head>
<body>
    <main class="container"></main>
    <div style = "padding: 80px; background-color: #ff4500d0;">
        <div class="text-center">
            <h1>Error</h1>
        </div>
        <div class="card text-center" style="padding: 40px; margin-left: 10px; margin-right: 10px; ">
            <h1><?= $errormessage?></h1>
        </div>
    </div>
    
</body>
</html>