<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/buttons.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="style.css" />

<?php
	session_start();
	include_once "function.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml"> 
  <head>
    <title>Change Password</title>    
  </head>

<body class="bg-info">
    <?php    
if(isset($_POST['submit'])) {
	
	if($_POST['password1'] == "") {
			$register_error = "<h1>!!One or more fields are missing!!</h1>";
	
	if( $_POST['password1'] != $_POST['password2']){
		$register_error = "<h2>Passwords don't match. Try again?</h2>";		
	}
}		
	else {
		if(!isset($username)){
			mysql_query("UPDATE account SET username='".$_POST['username']."' WHERE username='".$_SESSION['username']."'") or die(mysql_error());
			
		}			
		if(!isset($name)){
			mysql_query("UPDATE account SET name='".$_POST['name']."' WHERE username='".$_SESSION['username']."'") or die(mysql_error());
			
		}	
		if(!isset($password)){
				mysql_query("UPDATE account SET password='".$_POST['password1']."' WHERE username ='".$_SESSION['username']."'")or die(mysql_error());
			
		}
		if(!isset($gender)){
		mysql_query("UPDATE account SET gender='".$_POST['gender']."' WHERE username = '".$_SESSION['username']."'")or die(mysql_error());
			
		}
		if(!isset($birthdate)){
				mysql_query("UPDATE account SET birthdate='".$_POST['bitrhdate']."' WHERE username ='".$_SESSION['username']."'")or die(mysql_error());
			
		}
			//echo "Update succeeds";
			$_SESSION['username'] = $_POST['username'];
		header('Location: browse.php');
		}
		
		}			
    ?>
<form action="update.php" method="post">
 
	<table width="20%">
		<tr>
		<td width="20%">username:</td>
		<td width="80%"><input type="text" name="username"></td>
		</tr>
		<tr>
		<td width="20%">name:</td>
			<td width="80%"><input type="text" name="name"></td>
		</tr>
		<tr>
			<td width="20%">CreatePassword:</td>
			<td width="80%"><input type=password name="password1"></td>
		</tr>
		<tr>
			<td width="20%">ConfirmPassword:</td>
			<td width="80%"><input type=password name="password2"></td>
		</tr>
		
        <td></br><input type="radio" name="gender" value="Male">male</td>
        <td></br><input type="radio" name="gender" value="Female">female</td>
      </tr>
		<tr>
		<td>
		dateofbirth:<input type="text" name="birthdate"> 
		</td>		
		</tr>
		<tr>
		<td>
		<br><input name="submit" type="submit" value="Submit">
		</td>
		</tr>
		</table>
		</form>
<?php
  if(isset($register_error))
   {  echo "<id='passwd_result'>".$register_error."";}
?>

</body>
</html>	
