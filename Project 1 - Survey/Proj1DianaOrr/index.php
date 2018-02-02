<!-- index.php page of Project 1 simply displays the basis of the survey to the user. Upon completing reading the user will click begin which is the only way the user will be given the ability to proceed to "page 1" of the survey -->


<?php
//session_start() is called at the beginning of each page to create a session or resume the current one. If the session page is not set it will be set to 0 (the index(start) page). Then through a series of if else if statements, it is determined what the $_SESSION @ page is == to then through the use of JavaScript location.assign, the user is sent to the page they should be on based on their session data.
	session_start();
	if(!isset($_SESSION['page'])){
		$_SESSION['page']= 0;
	}
	if ($_SESSION['page']== 1){
	?>
	<script>location.assign('./page1.php');</script>
	<?php
	}
	else if ($_SESSION['page']== 2){
	?>
	<script>location.assign('./page2.php');</script>
	<?php
	}
	else if ($_SESSION['page']== 3){
	?>
	<script>location.assign('./page3.php');</script>
	<?php
	}

?>
<html>
<head>
	<title>Diana's Project 1 - Survey </title>
	<!--link to external cascading style sheet (CSS)-->
	<link href="./main.css" type="text/css" rel="stylesheet"/>
	<!--link to applicable Google fonts-->
	<link href="https://fonts.googleapis.com/css?family=Rubik|Trirong" rel="stylesheet">
	
</head>
<body>
	
	<header>
	<h1>Satisfaction Survey</h1>
	</header>
	<div id="wrap">
		<!--this statement will be complete if the server request method is == to post (which is true as the method for the form is "POST"). Once this evaluates to true (upon click of the begin button) the session page will be set to 1 and a javascript script tag will send the user to page1.php via the location.assign method-->

	<?php if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$_SESSION['page']= 1;?>
		<script>location.assign('./page1.php');</script>
		<?php
		} 
	 ?>
		
				<p>Welcome to the Satisfaction Survey and thank you for taking the time to complete this. In the following couple of pages you will be asked to complete some simple details about yourself, and answer a few questions about your purchase(s). Once you have read this information you can click the "BEGIN" button. On page one you will complete information about yourself, page 2 will pertain to the details of your purchase and page 3 will be regarding the satisfaction in relation to the items you identified as purchased in the previous page. Each page must completed properly to proceed to the next page.</p>
				
				<br>
				<form method="POST">
					<input type="submit" value="Begin"/>
				</form>
	
</div>
</body>
</html>
