<?php
	include('auth.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>

<h2>Prihlásenie</h2>
<p class="text-success text-center"><?php echo $login; ?></p>
<form action="auth.php" method="post">

    <div class="container">
        <label for="unm"><b>Meno</b></label>
        <input type="text" placeholder="Meno" id="unm" name="unm" required>


        <label for="pwd"><b>Heslo</b></label>
        <input type="password" placeholder="Heslo" id="pwd" name="pwd" required>

        <button type="submit">Prihlásiť</button>
    </div>
</form>

</body>
</html>

