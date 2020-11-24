<?php
$host = "localhost:3075";
$user = "kramar.im";
$pwd = "{}p[tgFy7!1dJkDFIKuvxZXyM\#D,b-Dn";
$databaza = "uni.kramar.im";

$conn = new mysqli($host,$user,$pwd,$databaza);
if($conn->connect_error){
    die("Nedá sa pripojiť k db: " . $conn->connect_error);
}
?>