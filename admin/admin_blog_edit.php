<?php
	session_start();
	$meno = $_SESSION['usrnm'];
	if(empty($meno)){
		header("Location: https://uni.kramar.im/admin/login.php");
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
		<h4>Zoznam</h4>
		<?php
			require_once "cfg.php";
			$query = "SELECT * FROM blog";
			if($result = mysqli_query($conn, $query)){
				if(mysqli_num_rows($result)>0){
					echo "<table class='table table-bordered'>";
						echo "<thead>";
							echo "<tr>";
								echo "<th>ID</th>";
								echo "<th>Nadpis</th>";
								echo "<th>Text</th>";
								echo "<th>Čo chceš robiť s tým, ha ?</th>";
							echo "</tr>";
						echo "</thead>";
						echo "<tbody>";
						while ($row = mysqli_fetch_array($result)){
							echo "<tr>";
								echo "<td>" . $row['id'] . "</td>";
								echo "<td>" . $row['title'] . "</td>";
								echo "<td>" . substr($row["body"],0,15) . "</td>";
								echo "<td>"
									echo "<a href='admin_blog_edit_edit.php?id=".$row['id'] ."'>Edit</a>";
									echo "<a href='admin_blog_edit_delete.php?id=".$row['id'] ."'>Delete</a>";
								echo"</td>";
							echo "</tr>";	
						}
						echo "</tbody>";
					echo "</table>";
					mysqli_free_result($result);
				}
				else {
					echo "<p> Nišť neni v db zatiaľ </p>";
				}
			}
			else {
				echo "Tož, voľáčo je naprd s DB, kukaj: " . mysqli_error($conn);
			}
			mysqli_close($conn);
		?>
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