<?php
session_start();
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// Insertion du message à l'aide d'une requête préparée

$req = $bdd->prepare('INSERT INTO post_mini_chat (pseudo, message) VALUES(?,?)');
$req->execute(array($_POST['pseudo'], $_POST['message']));

$req->closeCursor();

// Redirection du visiteur vers la page du minichat
header('Location: minichat.php');
