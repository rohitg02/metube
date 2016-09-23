		<link href="css/bootstrap.min.css" rel="stylesheet">
		<title>Login</title>
		<body class="bg-info">
<?php
session_start();

include_once "function.php";

if(isset($_POST['submit'])) {
		if($_POST['username'] == "" || $_POST['password'] == "") {
			$login_error = "One or more fields are missing.";
		}
		else {
			$check = user_pass_check($_POST['username'],$_POST['password']); // Call functions from function.php
			if($check == 1) {
				$login_error = "User ".$_POST['username']." not found.";
			}
			elseif($check==2) {
				$login_error = "Incorrect password.";
			}
			else if($check==0){
				$_SESSION['username']=$_POST['username']; //Set the $_SESSION['username']
				header('Location: browse.php');
			}		
		}
}
?>
	<form method="post" action="<?php echo "login.php"; ?>">
		<br><br><br><br><br><br><br><br><br><br><br><br>
		<center><form action="login.php" method="post">
			Username: <input class="text"  type="text" name="username"><br>
			Password : <input class="text"  type="password" name="password"><br>
			<input name="submit" type="submit" value="Login" class="btn btn-primary" tabindex="1000">
			<input name="reset" type="reset" value="Reset" class="btn btn-primary">
		</form></center>
	</form>

<?php
  if(isset($login_error))
   {  echo "<div id='passwd_result'>".$login_error."</div>";}
?>
