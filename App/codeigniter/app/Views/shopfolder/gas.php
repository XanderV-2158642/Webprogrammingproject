<?= $this->extend('Layouts/shoplayout') ?>

<?= $this->section('content') ?>

<main class = "container">

    <form class="form" style = "margin-bottom: 30px;">
        <div class="row w-75 mx-auto">
            <div class="col d-flex align-items-center justify-content-center" style = "margin-bottom: 10px;">
                <div>
                    <h4>Filter</h4>
                    <div class = "form-check">
                        <input class="form-check-input" type="checkbox" value = "" id="natural">
                        <label class="form-check-label" for = "natural">Natural</label>
                    </div>
                    <div class = "form-check">
                        <input class="form-check-input" type="checkbox" value = "" id="bio">
                        <label class="form-check-label" for = "bio">Bio</label>
                    </div>
                    <div class = "form-check">
                        <input class="form-check-input" type="checkbox" value = "" id="butane">
                        <label class="form-check-label" for = "butane">Butane</label>
                    </div>
                    <div class = "form-check">
                        <input class="form-check-input" type="checkbox" value = "" id="propane">
                        <label class="form-check-label" for = "propane">Propane</label>
                    </div>
                </div>
            </div>
            <div class = "col d-flex align-items-center justify-content-center" style = "margin-bottom: 10px;">
                <div>
                    <h4>Heritage</h4>
                    <select id="Herritage">
                        <option selected value="All">All</option>
                        <?php foreach($countries as $country) : ?>
                            <option value = $country> <?= $country ?>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class = "col d-flex align-items-center justify-content-center" style = "margin-bottom: 10px;">
                <div>
                    <h4>Price</h4>
                    <label for="minPrice">Minimum Price</label><br>
                    <input type="number" id="minPrice"><br>
                    <label for="minPrice">Maximum Price</label><br>
                    <input type="number" id="maxPrice">
                </div>
            </div>
            <div class = "col d-flex align-items-center justify-content-center" style = "margin-bottom: 10px;">
                <div>
                    <h4>Search</h4><br>
                    <input type="submit" value="Confirm">
                </div>
            </div>
        </div>
    </form>



    <!--Product cards -->
    <div class = "row ">
        <div class = "card w-75 mx-auto" style = "margin-bottom: 10px">
            <div class = "card-body">
                <h4>Gas</h4>
                <p class= "card-text"></p>
                <a href="#" class = " btn btn-primary">Buy</a>
            </div>
        </div>
        <div class = "card w-75 mx-auto">
            <div class = "card-body">
                <h4>Gas</h4>
                <p class= "card-text"></p>
                <a href="#" class = " btn btn-primary">Buy</a>
            </div>
        </div>
    </div>
    <!--Product cards -->
</main>

<?= $this->endSection('content')?>