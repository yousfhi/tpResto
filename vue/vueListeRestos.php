
<h1>Liste des restaurants</h1>

<?php
foreach ( $listeRestos as $unR){
//for ($i = 0; $i < count($listeRestos); $i++) {
   // $lesPhotos = getPhotosByIdR($listeRestos[$i]['idR']);
    $lesPhotos = getPhotosByIdR($unR['idR']);
    ?>

    <div class="card">
        <div class="photoCard">
            <?php if (count($lesPhotos) > 0) { ?>
                <img src="photos/<?= $lesPhotos[0]["cheminP"] ?>" alt="photo du restaurant" />
            <?php } ?>


        </div>
        <div class="descrCard"><?php echo "<a href='./?action=detail&idR=" . $unR['idR'] . "'>" . $unR['nomR'] . "</a>"; ?>
            <br />
            <?= $unR["numAdrR"] ?>
            <?= $unR["voieAdrR"] ?>
            <br />
            <?= $unR["cpR"] ?>
            <?= $unR["villeR"] ?>
        </div>
        <div class="tagCard">
            <ul id="tagFood">		


            </ul>


        </div>

    </div>





    <?php
}
?>


