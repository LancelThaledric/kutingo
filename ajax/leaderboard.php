<?php
/*
    Leader boards
    
    Get the N first players in the database.
    Param : N (GET)
*/

$username = 'root';
$password = '';


$nb = $_GET['n'];
if(!$nb) $nb = 10;

// SQL

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=kutingo_db', $username, $password);
}
catch(Exception $e)
{
        exit('Erreur : '.$e->getMessage());
}

$reponse = $bdd->query('SELECT pseudo, score FROM leaderboard ORDER BY score DESC LIMIT 0, '.$nb);


// Display

echo '<ul>';

while ($donnees = $reponse->fetch())
{
	echo '<li><ul><li>'.utf8_encode($donnees['pseudo']) . '</li><li>'.$donnees['score'].'</li></ul></li>';
}

echo '</ul>';

$reponse->closeCursor();

?>