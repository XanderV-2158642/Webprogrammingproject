<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<main class="container text-center">
    <div class = "m-auto" style="max-width: 400px; padding: 15px;">
        <?php if(isset($validation)) : ?>
            <div class="text-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif ; ?>
        <form method = "post" action="/profile/createprofile" id="form" enctype="multipart/form-data">
            <h2>Fill in the form to create an account</h2>
            <div class="form-floating">
                <input type="text" name="user_name" class = "form-control" id="username">
                <label >Full Name</label>
            </div>
            <div class = "form-floating">
                <textarea class="form-control" name="user_description" id = "description"></textarea>
                <label for="">Description</label>
            </div>
            <div class="form-floating">
                <input type="text"  name="user_phone" class="form-control" id="phone">
                <label for="">Phone Number</label>               
            </div>
            <div class="form-floating">
                <input type="email" name = "user_email" class = "form-control" id="email">
                <label for="">Email Address</label>
            </div>
            <div class = "mb-3">
                <input type="file" multiple name="user_picture[]" class = "form-control" id="image">
                <label for="" style= " text-align: right;">Upload profile picture(s)</label>
            </div>
            <div class="form-floating">
                <input type="password" name = "user_password"class = "form-control" id="password">
                <label for="">Password</label>
            </div>
            <div class="form-floating" style =" margin-bottom: 10px;">
                <input type="password" name = "confirmpassword"class = "form-control" id="password2">
                <label for="">Confirm password</label>
            </div>
            <button type="submit" class = "btn btn-lg btn-primary">Create account</button>
        </form>
    </div>
</main>

<script src="<?= base_url('/JS/createprofile.js')?>"></script>

<?= $this->endSection('content') ?>