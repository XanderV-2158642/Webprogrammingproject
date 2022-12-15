<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>


<main class="container-xv text-center">
    <div class = "m-auto" style="max-width: 330px; padding: 15px;">
        <?php  if(isset($succes)): ?>
            <div class = "alert alert-success" role = "alert">
                <h6>Account created succesfully</h6>
            </div>
        <?php endif ;?>
        <?php  if(isset($userfound)): ?>
            <div class = "alert alert-danger" role = "alert">
                <h6>User not found</h6>
            </div>
        <?php endif ;?>
        <?php  if(isset($passworderror)): ?>
            <div class = "alert alert-danger" role = "alert">
                <h6>Password incorrect</h6>
            </div>
        <?php endif ;?>

        <form method = "post" action="/Profile" id ="form">
            <h2>Sign in</h2>
            <div class="form-floating">
                <input type="email" name = "user_email" id= "email" class = "form-control">
                <label for="email">Email Address</label>
            </div>
            <div class="form-floating" style =" margin-bottom: 10px;">
                <input type="password" name = "user_password" id="password" class = "form-control">
                <label for="password">Password</label>
            </div>
            <button type="submit" class = "btn btn-db-xv">Sign in</button>
        </form>
    </div>
    <div>
        <h3>No profile yet?</h3>
        <a href="/Profile/createprofile" class = "btn btn-db-xv">Create Profile</a>
    </div>
</main>

<script src="/JS/login.js"></script>


<?= $this->endSection('content') ?>