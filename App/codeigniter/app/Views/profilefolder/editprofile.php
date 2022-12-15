<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>


<main class="container-xv">
    <div class = "m-auto">
        <?php  if(session()->get('success')): ?>
            <div class = "alert alert-success text-center" role = "alert">
                <h6>Account Updated succesfully</h6>
            </div>
        <?php endif ;?>
        <?php if(isset($validation)) : ?>
            <div class="alert alert-danger text-center">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif ; ?>
        <form method = "post" action="/Profile/edit" id="form" enctype="multipart/form-data">
            <h2>Edit the field you want to change</h2>
            <div class ="row">
                <div class="col-sm" >
                    <div class="form-floating">
                        <input type="text" name="user_name" class = "form-control" id="username" value="<?= set_value('user_name', $user['user_name']) ?>">
                        <label for="username">Full Name</label>
                    </div>
                    <div class="form-floating">
                        <input type="text"  name="user_phone" class="form-control" id="phone" value="<?= set_value('user_phone', $user['user_phone']) ?>">
                        <label for="phone">Phone Number</label>               
                    </div>
                    <div class="form-floating">
                        <input type="email" name = "user_email" class = "form-control" id="email" value="">
                        <label for="email">Email Address</label>
                    </div>
                    <div class = "mb-3">
                        <input type="file" multiple name="picture[]" class = "form-control" id="image">
                        <label for="image" style= " text-align: right;">Add Pictures</label>
                    </div>
                </div>
                <div class="col-sm">
                    <div class = "form-floating">
                        <textarea class="form-control" name="user_description" id = "description" style="height: 240px;"><?= $user['user_description'] ?></textarea>
                        <label for="description">Description</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-floating">
                        <input type="password" name = "user_password" class = "form-control" id="password">
                        <label for="password">Password</label>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-floating" >
                        <input type="password" name = "confirmpassword"class = "form-control" id="password2">
                        <label for="password2">Confirm password</label>
                    </div>   
                </div>
            </div>
            <button type="submit" class = "btn btn-ve-xv">Confirm changes</button>
        </form>
        <div class="row">
            <?php 
            $iterate = 0;
            foreach($pictures as $picdata): ?>
                <div class="col-sm text-center">
                <img src="/Images/Profile/<?= $picdata['picture_name']?>" style="max-width: 600px; max-height: 300px; margin-bottom: 10px;"></br>
                <a href="/Profile/removepic/<?= $iterate?>" class = "btn btn-dr-xv">remove Picture</a>
                </div>
            <?php 
            $iterate = $iterate +1;
            endforeach;?>
        </div>
    </div>
</main>


<script src="<?= base_url('/JS/editprofile.js')?>"></script>

<?= $this->endSection('content') ?>