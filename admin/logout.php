<?php 
	session_start();
	session_destroy();
	header("Location: https://uni.kramar.im/admin/login.php");
?>