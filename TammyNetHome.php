<?php 
	include "connect.php";
	$sql = 'SELECT * FROM users LEFT JOIN tests ON tests.user_id = users.id WHERE users.id = :uid AND tests.removed_at IS NULL';
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':uid',$_SESSION['user_id']);
	if(!$stmt->execute())
	{ die("Failed to grab user data");}
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$tests = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tammy.Net Homepage</title>
	<link rel="stylesheet" type="text/css" href="/tammycss/style_new.css"/>
	<link rel="stylesheet" type="text/css" href="/tammycss/style_newconfig.css"/>
	<link rel="stylesheet" type="text/css" href="/tammycss/panel.css"/>
</head>
<body onload=>
<div id="Username">
	<div>
	<p id="UsernameLabel"><?php if($_SESSION['user_id']) echo $_SESSION["user_name"] ?></p>
	</div>
</div>
<div id="maindiv">
	<div id="navdiv">
	
		<ul id="navdivul">
			<h1>Tammy.Net</h1>
			<li><a href="/TammyNetLogout.php">Logout</a></li>
			<li><a href="/TammyNetTools.html">Tools</a></li>
			<li><a href="/TammyNetHelp.html">Help</a></li>
			<li id="adminlink"><a href="/TammyNetAdmin.php">Admin</a></li>
			<li><a href="/TammyNetTAScripts.php">TA Scripts</a></li>
			<li><a style="background-color:#0072BC" href="/TammyNetHome.php">Home</a></li>
		</ul>
	</div>
	
<!-- New Configuration Pop Up
-------------------------------------------------------------------->

 <?php if(isset($_SESSION['user_id'])){
echo '<div id=NewConfiguration>';
    echo '<a id="createconfig_btn" href="#new-config">New Configuration</a>';

echo '</div>';
 }
              ?>
<!---------------------------------------------------------------------->	

<div id="SetupStatus">
<a href="javascript:void(0)" onclick="displaySetupPopUp()">Setup Status</a>
	<div id="popupbox">
	<div class="popupboxWrap">
	</div>
</div>
</div>

<div id="Panel">

	<div id="MyTestsPanel">
		<h1>My Tests</h1>
		<hr class="myhr">
		<div>
			<?php
			$i =1;
			foreach ($tests as $test) {
			if($test['id'] && is_numeric($test['id']) ){
			?>
			<div class="testRow" data-id="<?= $test['id'] ?>" >
			<a class="testRow-link" data-id="<?= $test['id'] ?>" onclick="myTestsPopup(this)" ><?= $i++?>. <?= $test['name'];?></a></div>
			<?php
			}
			}?>
			
		</div>
	</div>
	
	<div id="MyResultsPanel">
		<h1>My Results</h1>
		<hr class="myhr">
	</div>
</div>


<div class="_template-page-1" style="display:none">
	<input type="text" placeholder="Configuration Name" id="NewConfigNameInputBox" style="width: 100%; padding: 6px; margin-top: 5px; margin-bottom: 5px;">
	<hr style="margin-bottom: 5px;">
	<div align="center" id="SelectSetupDiv0" style="width: 410px;">
		<h3 style="color: rgb(0, 114, 188); font-weight: bolder;">Select Setup</h3>
	</div>
	<ul class="selectionlist">

	</ul>
	<div class="modal-btn-wrap">
	<a href="#" class="modal-btn modal-btn-next">Next</a></div>
</div>

<div class="_template-page-2" style="display:none">
<input type="text" placeholder="Configuration Name" id="NewConfigNameInputBox" style="width: 100%; padding: 6px; margin-top: 5px; margin-bottom: 5px;">
	<div align="center" class="SelectSetupDiv0" style="width: 410px;">
		<h3 style="color: rgb(0, 114, 188); font-weight: bolder;">Select Product</h3>
	</div>
	<ul class="selectionlist">
		
	</ul>
		<div class="modal-btn-wrap"><a href="#" class="modal-btn modal-btn-back">Back</a>

	<a href="#" class="modal-btn modal-btn-next">Next</a></div>
</div>


<div class="_template-page-3" style="display:none">
<input type="text" placeholder="Configuration Name" id="NewConfigNameInputBox" style="width: 100%; padding: 6px; margin-top: 5px; margin-bottom: 5px;">
	<div style="padding-top:8px;">
		<h3 style="color: rgb(0, 114, 188); font-weight: bolder;">Select Scripts</h3>
	</div>
	<div class="search-wrap">
		<input type="text" id="tasearch" class="small">
		<div style="text-align:center">
			<label style="margin:0 8px;vertical-align:middle;padding:4px 0px 0px;display:inline-block;">By Script Name : <input class="search-opt-radio" type="radio" value="scriptname" name="search-opt" checked="checked"></label>
			<label style="margin:0 8px;vertical-align:middle;">By Script Id : <input class="search-opt-radio" type="radio" value="id" name="search-opt"></label>
			<label style="margin:0 8px;vertical-align:middle;">By Script Priority : <input class="search-opt-radio" type="radio" value="prioritylevel" name="search-opt"></label>
		</div>
		<button id="selectAll">Select all</button>
	</div>
	<hr>
	<ul class="selectionlist">
		
	</ul>
		<div class="modal-btn-wrap"><a href="#" class="modal-btn modal-btn-back">Back</a>

	<a href="#" class="modal-btn modal-btn-next">Next</a></div>
</div>

<div class="_template-page-4" style="display:none">
<input type="text" placeholder="Configuration Name" id="NewConfigNameInputBox" style="width: 100%; padding: 6px; margin-top: 5px; margin-bottom: 5px;">
<div>
		<h3 style="color: rgb(0, 114, 188); font-weight: bolder;">Select Mode</h3>
	</div>
	<ul class="selectionlist">
		<li class="modal-selection">UDP</li>
		<li class="modal-selection">TCP</li>
		<li class="modal-selection">CLI</li>
		<li class="modal-selection">SMS</li>
	</ul>
	<div class="modal-btn-wrap">
	<a href="#" class="modal-btn modal-btn-back">Back</a>

	<a href="#" class="modal-btn modal-btn-next">Review</a>
	</div>
</div>

<div class="_template-page-5" style="display:none">
	<h2>Name</h2>
	<ul class="selectionlist" data-config="name">
		<li></li>
	</ul>
	<h2>Model</h2>
	<ul class="selectionlist" data-config="setup">
		<li></li>
	</ul>
	<h2>Product</h2>
	<ul class="selectionlist" data-config="product">
		<li></li>
	</ul>
	<h2>Scripts</h2>
	<ul class="selectionlist" data-config="scripts">
		<li></li>
	</ul>
	<h2>Mode</h2>
	<ul class="selectionlist" data-config="mode">
		<li></li>
	</ul>
<div class="modal-btn-wrap">
	<a href="#" class="modal-btn modal-btn-back">Back</a>

	<a href="#" class="modal-btn modal-btn-next">Create</a>
	</div>
</div>

<script src="/jquery-1.12.1.js"></script>
<script type="text/javascript" src="/tammyjs/ModalBox.class.js"></script>
<script type="text/javascript" src="/tammyjs/ScriptConfig.class.js"></script>
<script type="text/javascript" src="/tammyjs/newConfigModal.js"></script>
<script type="text/javascript" src="/tammyjs/getProductsFromBitmask.js"></script>
<script type="text/javascript" src="/tammyjs/checkFileExists.js"></script>
<script type="text/javascript" src="/tammyjs/createNewTextFile.js"></script>
<script type="text/javascript" src="/tammyjs/readFromFile.js"></script>
<script type="text/javascript" src="/tammyjs/writeFile.js"></script>
<script type="text/javascript" src="/tammyjs/getTerminalOutput.js"></script>
<script type="text/javascript" src="/tammyjs/popup.js"></script>
<script type="text/javascript" src="/tammyjs/TestChecker.js"></script>
<script type="text/javascript" src="/tammyjs/script.js"></script>



</body>
</html>

