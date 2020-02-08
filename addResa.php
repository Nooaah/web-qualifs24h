<?php header("Content-type: text/javascript");
session_start();

$bdd = new PDO("mysql:host=localhost;dbname=qualifs24h;charset=utf8", 'root', 'root');

$getid = intval($_GET['id']);
$getStormtrooper = htmlspecialchars($_GET['stormtrooper']);

$add = $bdd->prepare('INSERT INTO reservations(id_tiefighter, id_stormtrooper, date, heure, minute) VALUES(?, ?, NOW(), ?, ?)');
$add->execute(array($getid, $getStormtrooper, date('H'), date('i')));

?>
window.location = 'index.php';