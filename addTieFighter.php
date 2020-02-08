<?php header("Content-type: text/javascript");
session_start();

$bdd = new PDO("mysql:host=localhost;dbname=qualifs24h;charset=utf8", 'root', 'root');

$getName = htmlspecialchars($_GET['nom']);

$add = $bdd->prepare('INSERT INTO tiefighters(numero) VALUES(?)');
$add->execute(array($getName));

?>
window.location = 'index.php';