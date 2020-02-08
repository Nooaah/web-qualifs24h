<?php header("Content-type: text/javascript");
session_start();

$bdd = new PDO("mysql:host=localhost;dbname=qualifs24h;charset=utf8", 'root', 'root');

$getid = intval($_GET['id']);
$del = $bdd->prepare('DELETE FROM reservations WHERE id_tiefighter = ?');
$del->execute(array($getid));

$up = $bdd->prepare('UPDATE tiefighters SET heure = ?, minute = ? WHERE id = ?');
$up->execute(array(date('H'), date('i'), $getid));

?>
window.location = 'index.php';