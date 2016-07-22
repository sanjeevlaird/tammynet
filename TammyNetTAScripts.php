<?php 
	include "connect.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tammy.Net TAScripts Page</title>
	<link rel="stylesheet" type="text/css" href="/tammycss/style_new.css"/>
	<link rel="stylesheet" href="tammycss/panel.css">
</head>
<body >
<div id="Username">
	<div>
	<p id="UsernameLabel"><?php if($_SESSION['user_id']) echo $_SESSION['user_name']?></p>
	</div>
</div>
<div id="maindiv">
	<div id="navdiv">
		
		<ul id="navdivul">
			<h1>Tammy.Net</h1>
			<li><a href="<?= $DEBUG__DIR?>TammyNetLogout.html">Logout</a></li>
			<li><a href="/TammyNetTools.html">Tools</a></li>
			<li><a href="/TammyNetHelp.html">Help</a></li>
			<li id="adminlink"><a href="TammyNetAdmin.php">Admin</a></li>
			<li><a style="background-color:#0072BC; href="TammyNetAdmin.php">TA Scripts</a></li>
			<li><a href="TammyNetHome.php">Home</a></li>
		</ul>
	</div>
	<div id="tascriptbody"><div class="search-wrap">
<input type="text" id="tasearch" placeholder="Search TA Scripts">
<div style="text-align:center">
	<label style="margin:0 8px;vertical-align:middle;padding:4px 0px 0px;display:inline-block;">By Script Name : <input class="search-opt-radio" type="radio" value="scriptname" name="search-opt" checked="checked"></label>
	<label style="margin:0 8px;vertical-align:middle;">By Script Id : <input class="search-opt-radio" type="radio" value="id" name="search-opt"></label>
	<label style="margin:0 8px;vertical-align:middle;">By Script Priority : <input class="search-opt-radio" type="radio" value="prioritylevel" name="search-opt"></label>
</div>
</div>
	<hr>
	<?php
		$sql = 'SELECT * FROM scriptidini WHERE 1';
		$stmt = $conn->prepare($sql);
		if(!$stmt->execute())
		{ die("Failed to grab user data");}
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$tests = $stmt->fetchAll();
		foreach ($tests as $key => $value) {
			?>
			<a class="script_display" href="#<?= $value["filename"]?>"
<?php 
$arr = [];
foreach ($value as $data => $val) {
	$arr[] = 'data-'.$data.'="'.$val.'"';
}
echo join(' ',$arr);
unset($arr);
?>><?= $value["id"]?>. <?= $value["scriptname"] ?></a>

			<?php
		}
	?>

	</div>

</div>

<script src="jquery-1.12.1.js"></script>
<script src="/tammyjs/ModalBox.class.js"></script>
<script src="/tammyjs/TAScripts.js"></script>

</body>
</html>

