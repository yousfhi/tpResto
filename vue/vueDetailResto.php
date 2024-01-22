
<h1><?= $unResto['nomR']; ?>
</h1>

<span id="note">
</span>
<section>
    Cuisine <br />
    <ul id="tagFood">		
        <?php foreach ( $lesTypesCuisine as $unTC){ ?>
            <li class="tag"><span class="tag">#</span><?= $unTC["libelleTC"] ?></li>
        <?php } ?>
    </ul>

</section>
<p id="principal">
    <?php if (count($lesPhotos) > 0) { ?>
        <img src="photos/<?= $lesPhotos[0]["cheminP"] ?>" alt="photo du restaurant" />
    <?php } ?>
    <br />
    <?= $unResto['descR']; ?>
</p>
<h2 id="adresse">
    Adresse
</h2>
<p>
    <?= $unResto['numAdrR']; ?>
    <?= $unResto['voieAdrR']; ?><br />
    <?= $unResto['cpR']; ?>
    <?= $unResto['villeR']; ?>

</p>

<h2 id="photos">
    Photos
</h2>
<ul id="galerie">
    <?php foreach ( $lesPhotos as $unePhoto){ ?>
        <li> <img class="galerie" src="photos/<?= $unePhoto["cheminP"] ?>" alt="" /></li>
    <?php } ?>

</ul>

<h2 id="horaires">
    Horaires
</h2> 
<?= $unResto['horairesR']; ?>


<h2 id="crit">Critiques</h2>

<ul id="critiques">

<?php     
include "getRacine.php"; ?>
    
    <form action="vue/enregistrerCritique.php" method="POST">
        <input type="hidden" name="idRestaurant" value=<?= $unResto['idR']; ?>>
        <label for="note">Note (1-5) :</label>
        <input type="number" name="note" min="1" max="5" required><br>
        <label for="commentaire">Commentaire :</label>
        <textarea name="commentaire" required></textarea><br>
        <label for="dateVisite">Date de Visite :</label>
        <input type="date" name="dateVisite" required><br>
        <button type="submit">Soumettre la Critique</button>
    </form>


<a href="./?action=vueDonnerCritique&idR=<?= $unResto['idR']; ?>">Donner une critique</a>

</ul>

<?php if (count($lesPhotos) > 0) { ?>
    <img src="photos/<?= $lesPhotos[0]["cheminP"] ?>" alt="photo du restaurant" />
<?php } ?>
<br />
<?= $unResto['descR']; ?>

<!-- Ajout de l'image de l'étoile -->
<?php if (isset($aimer)) { ?>
    <a href="./?action=aimer&idR=<?= $unResto['idR']; ?>"><img class="aimer" src="images/aime.png" alt="j'aime ce restaurant"></a>
<?php } else { ?>
    <a href="./?action=aimer&idR=<?= $unResto['idR']; ?>"><img class="aimer" src="images/aimepas.png" alt="je n'aime pas encore ce restaurant"></a>
<?php } ?>



