<html>
	<body>
		<?php
		session_start();

		include_once "function.php";

		if(isset($_POST['submit'])) {
			if( $_POST['passowrd1'] != $_POST['passowrd2']) {
				$register_error = " Passwords do not match. Try again.";
			}
			else {
				$check = user_exist_check($_POST['username'], $_POST['passowrd1']);	
				if($check == 1){
					//echo "Register succeeds";
					$_SESSION['username']=$_POST['username'];
					header('Location: browse.php');
				}
				else if($check == 2){
					$register_error = " Username already exists. Please choose a different username.";
				}
			}
		}
		?>
		<form action="register.php" method="post">
			<div style="width:400px;">
				Username: <input type="text" name="username" style> <br>
				Create Password: <input  type="password" name="passowrd1"> <br>
				Repeat Password: <input type="password" name="passowrd2"> <br>
				<input name="submit" type="submit" value="Submit">
			</div
		</form>

		<?php
		  if(isset($register_error))
		   {  echo "<div id='passwd_result'> register_error:".$register_error."</div>";}
		?>
	</body>
</html>
