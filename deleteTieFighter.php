<?php header("Content-type: text/javascript");
session_start();

$bdd = new PDO("mysql:host=localhost;dbname=qualifs24h;charset=utf8", 'root', 'root');

$getid = intval($_GET['id']);
$del = $bdd->prepare('DELETE FROM tiefighters WHERE id = ?');
$del->execute(array($getid));

?>
window.location = 'index.php';