<?php
$host = "localhost:3075";
$user = "kramar.im";
$pwd = "{}p[tgFy7!1dJkDFIKuvxZXyM\#D,b-Dn";
$databaza = "uni.kramar.im";
$dtz = new DateTimeZone("Europe/Bratislava");
$now = new DateTime('now', $dtz);

$conn = mysqli_connect("localhost:3075","kramar.im","","uni.kramar.im");

if($conn === false){
    die( $now->format("d-m-Y H:i:s") . " - ERROR: Could not connect. " . mysqli_connect_error());
}

?>