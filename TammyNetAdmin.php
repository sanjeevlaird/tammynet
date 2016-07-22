<?php 
	include "connect.php";?><!DOCTYPE html>
<html>
<head>
	<title>Tammy.Net Adminpage</title>
	<link rel="stylesheet" type="text/css" href="/tammycss/style_new.css"/>
</head>
<body>
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
			<li id="adminlink"><a style="background-color:#0072BC;href="#">Admin</a></li>
			<li><a href="/TammyNetTAScripts.php">TA Scripts</a></li>
			<li><a href="/TammyNetHome.php">Home</a></li>
		</ul>
	</div>
	
	<div id="adminbody">
		<a onClick= "updatescriptidinfo()" href="#">Click Me!</a>
	</div>
	
	<h3>Add a New User</h3>
	<?php 
		if($_SESSION["errors"]){
				?>
				Some Errors Occured.
				<ul>
					<?php 

						foreach ($_SESSION["errors"] as $value) {
							?>
								<li><?= $value ?></li>
							 <?php
						}
					?>
				</ul>

				<?php
				unset($_SESSION["errors"]);
		}
	?><form id="add-user-form" action="register.php" method="POST">
<fieldset>
	<!--<div id="basic-user-info">-->

			<label for="tbx-add-name">
				Name
			<input type="text" name="name" id="tbx-add-name"/></label>	
			<label for="tbx-add-email">
				Email
			<input type="text" name="email" id="tbx-add-email"/></label>	

			<label for="tbx-add-password">
				Password
			<input type="password" name = "password" id="tbx-add-password"/></label>	

			<label for="tbx-add-password">
				Repeat Password
			<input type="password" name="password_confirm" id="tbx-add-repeat-password"/></label>
	<br class="clear" />
	<input type="submit" value="Create User" id="btn-create-user" />
</fieldset>
</form>
	
</div>

<script src="jquery-1.12.1.js"></script>
</body>
</html>

