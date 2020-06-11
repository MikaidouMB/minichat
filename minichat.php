<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>Mini-chat</title>
    </head>

<h1>
    Mini-chat
</h1>

<form action="minichat_post.php" method="POST">

<div>
    <label for="pseudo">Pseudo :</label>
    <input type="text" id="pseudo" name="pseudo" value = "joe"/>
</div>


<div>
<label for="message">Message :</label>
    <textarea id="message" name="message" rows="5" cols="45">
Votre message ici.
</textarea>
</div>

<div class="button">
<button type="submit" value="Valider">Envoyer le message</button>
</form>

<?php
// Connexion à la base de données
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// Récupération des 10 derniers messages
$reponse = $bdd->query('SELECT pseudo, message FROM post_mini_chat ORDER BY ID DESC LIMIT 0, 10');

// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
while ($donnees = $reponse->fetch()) {
    echo '<p><strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . htmlspecialchars($donnees['message']) . '</p>';
}

$reponse->closeCursor();
?>
<p>
<a href="minichat.php">Rafraichir la page</a>
</p>

