<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/buttons.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="style.css" />

<?php
	session_start();
	include_once "function.php";
	include_once "dbconnect.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml"> 
  <head>
    <title>Change Password</title>    
  </head>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    <a href="browse.php"><img src="http://i.imgur.com/3Qyvyb7.png" alt="MeTube Icon" style="width:160;height:96"></a><span style="float:right;">
		 <!--<input name="delete" type="submit" value="delete">-->
			
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li>
	      <a href='logout.php' style="color:white" class="btn btn-primary raised round">Log Out</a>

	     
	    </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<body class="bg-info">
    <?php    
if(isset($_POST['submit'])) {
		
	if( $_POST['password1'] != $_POST['password2']){
		$register_error = "<h2>Passwords don't match. Try again?</h2>";		
	}
		
	else {
			$update_account= "UPDATE account SET username='$_SESSION[username]', password='$_POST[password1]', name='$_POST[name]', phonenum='$_POST[pnumber]', gender='$_POST[gender]'	, birthdate='$_POST[birthdate]' WHERE username= '$_SESSION[username]'";
		
			$update_result=mysql_query($update_account);
		
			if($update_result) 
			{
				echo "Profile Updated";
			}
			if(!$update_result){
				
			 die('Could not connect: ' . mysql_error());
		 }
		}
		
}					
    ?>
    
    <!--------------------------------DELETE BUTTON--------------------->
<form action="delete.php" method="post">
  <div class="container" align="right">                  
	<button name='delete' type="submit" align= "left" class="btn btn-danger">Delete Profile</button>
  </div>
</form>   


<form action="update.php" method="post">
  <fieldset style="border-color: red;">
    <legend>Update</legend>
    <div class="form-group">
      <label for="username" class="col-lg-2 control-label">Username</label>
      <div class="col-lg-10">
        <label class="col-lg-2 control-label" id="username" ><?php echo $_SESSION['username']; ?></label>
      </div>
    </div>
    
    <!--Name-->
    <div class="form-group">
      <label for="name" class="col-lg-2 control-label">Name</label>
      <div class="col-lg-10">
		
         <input type="text" class="form-control" id="name" value=<?php  $name="SELECT name FROM account WHERE username='$_SESSION[username]'";
					$queryresult = mysql_query($name)
						  or die("Insert into Media error in media_upload_process.php " .mysql_error());	
						  $playtime=mysql_fetch_row($queryresult);
						  echo $playtime[0]; ?> name="name" required/>
      </div>
    </div>
    
    
	<!--Phone No: <input type="text" name="pnumber" style> <br>-->
    <div class="form-group">
      <label for="pnumber" class="col-lg-2 control-label">Phone Number</label>
      <div class="col-lg-10">
        <input type="text" size="10" class="form-control" id="pnumber" value=<?php  $name="SELECT phonenum FROM account WHERE username='$_SESSION[username]'";
						  $queryresult = mysql_query($name)
						  or die("Insert into Media error in media_upload_process.php " .mysql_error());	
						  $playtime=mysql_fetch_row($queryresult);
						  
						  echo $playtime[0]; ?> name="pnumber" required/>
      </div>
    </div>
	<!--Gender: <input type="text" name="gender" style> <br>-->
    <div class="form-group">
      <label class="col-lg-2 control-label">Gender</label>
      <div class="col-lg-10">
        <div class="radio">
          <label>
            <input type="radio" name="gender" id="optionsRadios1" value="Female" required/>
            Female
          </label>
        </div>
        <div class="radio">
          <label>
            <input type="radio" name="gender" id="optionsRadios2" value="Male" required/>
            Male
          </label>
        </div>
      </div>
    </div>
	<!--Birthdate: <input type="text" name="birthdate" style> <br>-->
    <div class="form-group">
      <label for="birthdate" class="col-lg-2 control-label">Birthdate</label>
      <div class="col-lg-10">
	    <input type="text" value=<?php  $name="SELECT birthdate FROM account WHERE username='$_SESSION[username]'";
						  $queryresult = mysql_query($name)
						  or die("Insert into Media error in media_upload_process.php " .mysql_error());	
						  $playtime=mysql_fetch_row($queryresult);						  
						  echo $playtime[0]; ?> data-date-format="mm/dd/yy" id="inputBirthdate" name="birthdate" />
        <!--<input type="text" class="form-control" id="inputBirthdate" placeholder="Birth Date" name="birthdate">-->
      </div>
    </div>
    
	<!--Create Password: <input  type="password" name="passowrd1"> <br>-->
    <div class="form-group">
      <label for="password1" class="col-lg-2 control-label">Password</label>
      <div class="col-lg-10">
        <input type="password" class="form-control" id="password1" placeholder="Password" name="password1" required/>
      </div>
    </div>
    
	<!--Repeat Password: <input type="password" name="passowrd2"> <br>-->
    <div class="form-group">
      <label for="password2" class="col-lg-2 control-label">Repeat Password</label>
      <div class="col-lg-10">
        <input type="password" class="form-control" id="password2" placeholder="Repeat Password" name="password2" required/>
      </div>
    </div>
    
	<!--<input name="submit" type="submit" value="Submit">-->
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-primary" onclick="window.location='browse.php'" name="cencel">Cancel</button>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </div>
    </div>
  </fieldset>
</form>




<?php
 // if(isset($register_error))
 //  {  echo "<id='passwd_result'>".$register_error."";}
?>

</body>
</html>	
