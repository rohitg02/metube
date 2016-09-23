<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/buttons.css" rel="stylesheet">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media</title>
<link rel="stylesheet" type="text/css" href="css/default.css" />
<script src="Scripts/AC_ActiveX.js" type="text/javascript"></script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
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
 <img src="http://i.imgur.com/3Qyvyb7.png" alt="MeTube Icon" style="width:160;height:96"><span style="float:right;">
    </div>   
  </div><!-- /.container-fluid -->
</nav>

  <body class="bg-info">
    <?php
      session_start();
      include_once "function.php";

      if(isset($_POST['registersubmit'])) {
		  
		  
    	if( $_POST['password1'] != $_POST['password2']) {
	  $register_error = " Passwords do not match. Try again.";
	  echo "error";
	}
	
	
	else {
		if(!empty($_POST['gender']))
		{
	  $check = user_exist_check($_POST['username'], $_POST['password1'],$_POST['name'],$_POST['pnumber'],$_POST['gender'],$_POST['birthdate']);	
	  if($check == 1){
	  
            $_SESSION['username']=$_POST['username'];
            //  echo "Register succeeds";
		header('Location: browse.php');
	  }
	  else if($check == 2){
	    $register_error = " Username already exists. Please choose a different username.";
	  }
  }
  else
  echo"Select Gender";
	}
      }
    ?>

<form action="register.php" method="post">
  <fieldset style="border-color: red;">
	  
    <H1 align="center">Register</H1>
    
    
    <div class="form-group">   
      <div class="col-lg-10">
		   <label style="color:red" ><em>(All the fields in this form are compulsory)</em></label><br/>
        <input type="text"  id="username" placeholder="Username" name="username" required/>
         <label for="username" class="col-lg-2 control-label">Username</label>
      </div>
    </div>
    
    
    
    <div class="form-group">
      
      <div class="col-lg-10">
        <input type="text"  id="name" placeholder="Name" name="name" required/>
        <label for="name" class="col-lg-2 control-label">Name</label>
      </div>
    </div>
    
    
	<!--Phone No: <input type="text" name="pnumber" style> <br>-->
    <div class="form-group">
      
      <div class="col-lg-10">
        <input type="tel"  id="pnumber" placeholder="Phone Number" name="pnumber" required/>
        <label for="pnumber" class="col-lg-2 control-label">Phone Number</label>
      </div>
    </div>
    
    
    
	<!--Gender: <input type="text" name="gender" style> <br>-->
    <div class="form-group">
		
      <div class="col-lg-10">
		    <label class="col-lg-2 control-label">Gender</label>
		    
			<div class="radio">
				<label>
					<input type="radio" name="gender" id="optionsRadios1" value="Female">
					Female             
				</label>
			</div>
        
			<div class="radio">
				<label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="gender" id="optionsRadios2" value="Male">
					Male
				</label>
             </div>        
      </div>
      
    </div>
       
	<!--------------------------------------------------------------Email address input------------------------------------------------------>
	<!--------------------------------------------------------------Email address input----------------------------------------------------
    <div class="form-group">
	  <div class="col-lg-10">
		     <label style="color:red" ><em>(Email address you will use to send/recieve the messages)</em></label><br/>
	    <input type="email" placeholder="Enter a valid email address" id="email" name="email"  required/>
        <label for="email" class="col-lg-2 control-label">Email*:</label>
      </div>
    </div><br><br>
    
    -->
    
	<!--Birthdate: <input type="text" name="birthdate" style> <br>-->
    <div class="form-group">     
      <div class="col-lg-10">
	    <input type="date" placeholder="mm/dd/yyyy" data-date-format="mm/dd/yy" id="inputBirthdate" name="birthdate" required/>
	    <label for="birthdate" class="col-lg-2 control-label">Birthdate</label>
        <!--<input type="text" class="form-control" id="inputBirthdate" placeholder="Birth Date" name="birthdate">-->
      </div>
    </div>
    
    
    <!--Create Password: <input  type="password" name="passowrd1"> <br>-->
	<!--Create Password: <input  type="password" name="passowrd1"> <br>-->
    <div class="form-group">     
      <div class="col-lg-10">
        <input type="password"  id="password1" placeholder="Password" name="password1"required/>
         <label for="password1" class="col-lg-2 control-label">Password</label>
      </div>
    </div>
    
    
	<!--Repeat Password: <input type="password" name="passowrd2"> <br>-->
    <div class="form-group">    
      <div class="col-lg-10">
        <input type="password"  id="password2" placeholder="Repeat Password" name="password2" required/>
        <label for="password2" class="col-lg-2 control-label">Repeat Password</label>
      </div>
    </div>
    
    
	<!--<input name="submit" type="submit" value="Submit">-->
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-primary" onclick="window.location='index.php'" name="cencel">Cancel</button>
        <button type="submit" class="btn btn-primary" name="registersubmit">Submit</button>
      </div>
    </div>
  </fieldset>
</form>

    <?php
      if(isset($register_error)){
        echo "<div id='passwd_result'> register_error:".$register_error."</div>";}
    ?>
  </body>
</html>
