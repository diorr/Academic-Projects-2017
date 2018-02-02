<!-- page2.php page of Project 1 requires the user to complete 2 fields, indicating how they made their purchases and which purchases they made. Upon completion of these fields, the user will click the next button to access page 3-->
<?php
//session_start() is called at the beginning of each page to create a session or resume the current one. If the session page is not set it will be set to 0 (the index(start) page). Then through a series of if else if statements, it is determined what the $_SESSION @ page is == to then through the use of JavaScript location.assign, the user is sent to the page they should be on based on their session data.
	session_start();
	if(!isset($_SESSION['page'])){
		$_SESSION['page']= 0;
	}
	if ($_SESSION['page']== 0){
	?>
	<script>location.assign('./index.php');</script>
	<?php
	}
	else if ($_SESSION['page']== 1){
	?>
	<script>location.assign('./page1.php');</script>
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
	<title>Diana's Project 1 - Survey - Page 2</title>
	<!--link to external cascading style sheet (CSS)-->
	<link href="./main.css" type="text/css" rel="stylesheet"/>
	<!--link to applicable Google fonts-->
	<link href="https://fonts.googleapis.com/css?family=Rubik|Trirong" rel="stylesheet">
	
</head>
<body>
	<div id="wrap">
	<header>
	<h1>Survey - Page 2</h1>
	</header>
	<!--this statement will be complete if the server request method is == to post (which is true as the method for the form is "POST"). This evaluation to true will occur when the user clicks the "next page" button. Validate_fields is invoked and if any errors occur then display_error is invoked, if not then display_success in invoked, else form 1 is invoked with the 3 variables from the form-->
	<?php if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		
		$error_msg = validate_fields();
		if (count($error_msg) > 0){
			display_error($error_msg);
			form_1($_POST['howPurchased'] , $_POST['purchases']);
		} else {
			display_success();
		}
	} else {
		form_1("", "");
	} ?>
	</div>
</body>
</html>

	
		<!--php function form_1 is here, beneath it is the form created for user input and in turn validation. At the bottom of the form (the last element) is a "next page" button, which upon clicking causing the above to run.-->
		<?php function form_1($howPurchased, $purchases){ ?>
			<form method="POST" action="./page2.php">
					
				<label for="purchase method" name="howPurchasedLbl">How did you complete your purchase?</label>	
				<br>	
				  <input type="radio" name="howPurchased" value="Online"> Online<br>
				  <input type="radio" name="howPurchased" value="By Phone"> By Phone<br>
				  <input type="radio" name="howPurchased" value="Mobile App"> Mobile App<br>
				  <input type="radio" name="howPurchased" value="In Store"> In Store<br>
				
				<br>
				
					<label for="purchase" name="purchasesLbl">Which of the following did you purchase?</label>	
					<br>	
				  <input type="checkbox" name="purchases[]" value="Phone"> Phone<br>
				  <input type="checkbox" name="purchases[]" value="SmartTV"> Smart TV<br>
				  <input type="checkbox" name="purchases[]" value="Laptop"> Laptop<br>
				  <input type="checkbox" name="purchases[]" value="Tablet"> Tablet<br>
				  <input type="checkbox" name="purchases[]" value="HomeTheater"> Theater<br>

				<br>
				
					<input type="submit" value="Next"/>
				

			</form>
		<?php } ?>

	<!--validate_field function: verifies both fields are set, thereby ensuring they have been selected by the user. -->
	<?php function validate_fields(){
		$error_msg = array();
		if (!isset($_POST['howPurchased'])) {
			$error_msg[]= "How you made your purchase field is not defined";
		}

		if (!isset($_POST['purchases'])) {
			$error_msg[]= "Purchases field is not defined";
		}
		return $error_msg;
} ?>

<!--the display_error function passes through argument of $error_msg, as defined (returned) by function validate_fields. If there are error messages generated for either of the fields, there is a foreach loop within this function which will allow one, or both errors to be displayed, depending on how many errors occurred-->
<?php function display_error($error_msg){
	echo "<p>\n";
	foreach($error_msg as $v){
		echo $v."<br>\n";
	}
	echo "<p>\n";
} ?>

<!--if this method is invoked validate_fields has run successfully and error free. At this point the session page will be set to 3, the input variables will be saved to new variables in the session data to be retrieved later in the survey on a different page, and a javascript script tag will send the user to page3.php via the location.assign method-->
<?php function display_success(){ 
		
	$_SESSION['page']= 3;
	$_SESSION['purchaseData'] = $_POST['purchases'];
	$_SESSION['purchaseMethod'] = $_POST['howPurchased'];
	?>
		<script>location.assign('./page3.php');</script>
	<?php
} ?>
