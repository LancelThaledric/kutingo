<?php
/*
    Record
    
    Add the score to the database
*/

$username = 'root';
$password = '';


$score = $_POST['score'];
$pseudo = $_POST['pseudo'];

// SQL

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=kutingo_db', $username, $password);
}
catch(Exception $e)
{
        exit('Erreur : '.$e->getMessage());
}

$query = $bdd->prepare('INSERT INTO leaderboard(pseudo, score) VALUES (:pseudo, :score)');
$query->bindValue(':pseudo', $pseudo);
$query->bindValue(':score', $score);
$query->execute();

?>