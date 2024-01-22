<h1>Donner une critique</h1>
<form action="./?action=donner_critique" method="POST">
    <label for="note">Note (de 1 à 5) :</label>
    <input type="number" name="note" min="1" max="5" required>

    <label for="commentaire">Commentaire :</label>
    <textarea name="commentaire" rows="4" cols="50" required></textarea>

    <label for="dateVisite">Date de visite :</label>
    <input type="date" name="dateVisite" required>

    <input type="submit" value="Soumettre">
</form>
