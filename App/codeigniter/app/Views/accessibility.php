<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>


<main class="container-xv">
    <div class="w-75 mx-auto">
        <h2> Accesibility Statement</h2>

        <p>EnergyShop is trying to provide a website that can be used by as many people as possible, and to achieve this goal we want to make it accessible to everyone. We try to follow the standards of W3C, and we have focused on the following aspects:</p>
        <ul>
            <li>
                Our website is available for screen readers, every button or link has the destination as content. </br>
                Fields of forms have labels with matching id's, so screen readers know which input field corresponds to which label.</li>
            <li>
                Our website is fully functional without a mouse, you can navigate buttons via tab and shift+tab.</br>
                Fields can be edited by keyboard input and clicks are mimicked by enter.
            </li>
            <li>
                Because we are a platform that lets users upload their own pictures, it is difficult to have an alternate description for images.</br>
                Therefore we suggest to get info of the description of the product itself.
            </li>
        </ul>
        <p>
            We try to do our best to make sure you have the best experience we can deliver, however errors could slip in unnoticed.</br>
            If there are any bugs, mistakes or things that we could improve, feel free to contact us via any of the possible platforms specified in the contact page.
        </p>
    </div>

</main>


<?= $this->endSection('content')?>