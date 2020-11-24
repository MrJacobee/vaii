<?php
	session_start();
	$meno = $_SESSION['usrnm'];
	if(empty($meno)){
		header("Location: https://uni.kramar.im/admin/login.php");
	}
	
	require_once "cfg.php";
	$title=$body='';
	$titleErr=$bodyErr='';
	extract($_POST);
	if(isset($_POST['id'] && !empty($_POST['id'])){
		$query="UPDATE blog SET title=?, body=? WHERE id=?";
		$updateQuery = $conn->prepare($query);
		$updateQuery->bind_param('ssi',$title,$body,$id);
		$updateQuery->execute();
	}
	else {
		if(isset($_GET["id"] && !empty(trim($_GET["id"]))){
			$id = trim($_GET["id"]);
			$query = "SELECT  * FROM blog WHERE id=?";
			$selectQuery = $conn->prepare($query);
			$selectQuery->bind_param('i',$id);
			$selectQuery->execute();
			$exec=$selectQuery->get_results();
			if($exec->num_rows == 1){
				$row = mysqli_fetch_array($exec, MYSQLI_ASSOC);
				$title = $row["title"];
				$body = $row["body"];
				
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <title>Admin - Jakub Kramár</title>
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>
<body>
<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Administrácia</h3>
        </div>

        <ul class="list-unstyled components">

            <li >
                <a href="admin.php">Dashboard</a>
            </li>
            <li class="active">
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">Blog</a>
				<ul class="expand list-unstyled" id="pageSubmenu">
                    <li >
                        <a href="admin_blog.php">Pridať článok</a>
                    </li>
                    <li class="active">
                        <a href="#">Zoznam článkov</a>
                    </li>
                </ul>
            </li>
            <li >
                <a href="admin_gallery.php">Galéria</a>
            </li>
        </ul>
		<button onclick="location.href='https://uni.kramar.im/admin/logout.php'" type="button">Logout</button>
    </nav>
	
	
</div>
    <!-- OBSAH STRÁNKY  -->
    <div id="content">
		<h2> Blog Admin</h2>
		<div class="line"></div>
		<h4>Upraviť článok</h4>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		  <div class="form-group">
			<label for="title">Nadpis</label> 
			<input id="title" name="title" placeholder="Nadpis článku" type="text" required="required" class="form-control">
		  </div>
		  <div class="form-group">
			<label for="body">Text</label> 
			<textarea id="body" name="body" cols="40" rows="5" required="required" class="form-control"></textarea>
		  </div> 
		  <div class="form-group">
			<input type="hidden" name="id" value="<?php echo $id; ?>"/>
			<button name="submit" type="submit" class="btn btn-primary">Postnúť</button>
		  </div>
		</form>
		<div class="line"></div>
		<div class="line"></div>
    </div>


<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>


</body>
</html>