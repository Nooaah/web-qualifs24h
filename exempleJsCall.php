<?php header("Content-type: text/javascript");
session_start();

$bdd = new PDO("mysql:host=localhost;dbname=qualifs24h;charset=utf8", 'root', 'root');

?>
alert('test')