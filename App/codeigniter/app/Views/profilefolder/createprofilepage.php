<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<main class="container-xv text-center">
    <div class = "form-layout-xv m-auto">
        <?php if(isset($validation)) : ?>
            <div class="alert alert-danger text-center">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif ; ?>
        <form method = "post" action="/Profile/createprofile" id="form" enctype="multipart/form-data">
            <h2>Fill in the form to create an account</h2>
            <div class="form-floating">
                <input type="text" name="user_name" class = "form-control" id="username">
                <label for="username" >Full Name</label>
            </div>
            <div class = "form-floating">
                <textarea class="form-control" name="user_description" id = "description"></textarea>
                <label for="description">Description</label>
            </div>
            <div class="form-floating">
                <input type="text"  name="user_phone" class="form-control" id="phone">
                <label for="phone">Phone Number</label>               
            </div>
            <div class="form-floating">
                <input type="email" name = "user_email" class = "form-control" id="email">
                <label for="email">Email Address</label>
            </div>
            <div class = "mb-3">
                <input type="file" multiple name="user_picture[]" class = "form-control" id="image">
                <label for="image" style= " text-align: right;">Upload profile picture(s)</label>
            </div>
            <div class="form-floating">
                <input type="password" name = "user_password"class = "form-control" id="password">
                <label for="passwword">Password</label>
            </div>
            <div class="form-floating">
                <input type="password" name = "confirmpassword"class = "form-control" id="password2">
                <label for="password2">Confirm password</label>
            </div>
            <button type="submit" class = "btn btn-db-xv">Create account</button>
        </form>
    </div>
</main>

<script src="<?= base_url('/JS/createprofile.js')?>"></script>

<?= $this->endSection('content') ?>