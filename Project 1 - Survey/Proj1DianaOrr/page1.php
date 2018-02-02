<!-- page1.php page of Project 1 requires the user to complete 3 fields, full name, which must validate as letters and not be empty, age, which also cannot be empty and must validate as numbers and finally a dropdown indicating whether they are a student, cannot be empty, and they must select from options no, or yes fulltime or yes part time. Once all fields have validated successfully clicking on the next page will bring them to page 2 of the survey -->


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
	<title>Diana's Project 1 - Survey - Page 1</title>
	<!--link to external cascading style sheet (CSS)-->
	<link href="./main.css" type="text/css" rel="stylesheet"/>
	<!--link to applicable Google fonts-->
	<link href="https://fonts.googleapis.com/css?family=Rubik|Trirong" rel="stylesheet">
	
</head>
<body>
	<div id="wrap">
	<header>
	<h1>Survey - Page 1</h1>
	</header>

	<!--this statement will be complete if the server request method is == to post (which is true as the method for the form is "POST"). This evaluation to true will occur when the user clicks the "next page" button. Validate_fields is invoked and if any errors occur then display_error is invoked, if not then display_success in invoked, else form 1 is invoked with the 3 variables from the form-->
	<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		
	
		
		$error_msg = validate_fields();
		if (count($error_msg) > 0){
			display_error($error_msg);
			form_1($_POST['fullName'] , $_POST['age'],$_POST['student']);
		} else {
			display_success();
		}
			} else {
			form_1("", "", "");
			} ?>
	</div>
</body>
</html>

	
		<!--php function form_1 is here, beneath it is the form created for user input and in turn validation. At the bottom of the form (the last element) is a "next page" button, which upon clicking causing the above to run.-->
		<?php function form_1($fullName, $age, $student){ ?>
			<form method="POST" >
				<label for="user name">First Name</label>
				<input type="text" size="20"maxlength="50" id="fullname" name="fullName" value="<?php echo $fullName; ?>" >
				<br>
				<label for="user age">Your Age</label>
				<input type="text" size="20"  id="userAge" name="age" value="<?php echo $age; ?>">
				<br>
				<label for="isStudent">Are you a student?</label>
				<select name="student" id="student">
				<!--below select option has selected attribute set to true
				and disabled set to disabled. This allows the default selection to be blank (space instead of text in text field) and the disabled value makes it so the user is not able to select this option-->
				<option selected="true" disabled="disabled"> </option>  
				<option value="fullTime">Yes, Full Time</option>
				<option value="partTime">Yes, Part TIme</option>
				<option value="no">No</option>
				</select>

				<br>
				
					<input type="submit" value="Next Page"/>
				

			</form>
		<?php } ?>

	<!--validate_field function: verifies fields are accurately completed through various if else if statements, ensuring fields are set, not empty and not excessively long. Also verifies that age field is numeric and selection has been made from student dropdown-->
	<?php function validate_fields(){
		$error_msg = array();
		
		if (!isset($_POST['fullName'])){
			$error_msg[] = "Full name field not defined";
		} else if (isset($_POST['fullName'])){
			$fullName = trim($_POST['fullName']);
			if (empty($fullName)){
				$error_msg[] = "The full name field is empty";
			} else {
				if (strlen($fullName) > 40){
					$error_msg[] = "The full name field contains too many characters";
				
				}
			}
		}
		if(!isset($_POST['age'])){
			$error_msg[] = "Age field not defined";
		}
		else if (isset($_POST['age'])) {
			$age = trim($_POST['age']);
			if(empty($age)){
				$error_msg[] = "The age field is empty";
			}
			else if (!is_numeric($_POST['age'])){
				$error_msg[]= "The age field containts non-numeric values";
			}
			else if (strlen($age) > 3){
				$error_msg[]= "The age field contains too many characters";
			}
		
		}
		
		if (!isset($_POST['student'])){
			$error_msg[] = "Student field not defined";
			$_POST['student'] = "";
		} 
			
			
		else if (count($error_msg) == 0){
			$_POST['fullName'] = $fullName;
			$_POST['age'] = $age;
			
		}
		return $error_msg;
} ?>


<!--the display_error function passes through argument of $error_msg, as defined (returned) by function validate_fields. If there are error messages generated for any or all fields, there is a foreach loop within this function which will allow all errors to be displayed.-->
<?php function display_error($error_msg){
	echo "<p>\n";
	foreach($error_msg as $v){
		echo $v."<br>\n";
	}
	echo "<p>\n";
} ?>


<!--if this method is invoked validate_fields has run successfully and error free. At this point the session page will be set to 2, the input variables will be saved to new variables in the session data to be retrieved later in the survey on a different page, and a javascript script tag will send the user to page2.php via the location.assign method-->
<?php function display_success(){ 
		
	$_SESSION['page']= 2;
	$_SESSION['userFullName'] = $_POST['fullName'];
	$_SESSION['userAge'] = $_POST['age'];
	$_SESSION['isStudent'] = $_POST['student'];
	?>
		<script>location.assign('./page2.php');</script>
<?php
} ?>


