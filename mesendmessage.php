<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/buttons.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="style.css" />


<html xmlns="http://www.w3.org/1999/xhtml"> 
  <head>
    <title>Change Password</title>    
  </head>
<?php
session_cache_limiter('private,must-revalidate');
$cache_limiter =session_cache_limiter();
session_cache_expire(60);
include 'dbconnect.php';
session_start();

?>
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

	if(isset($_POST['submit']))
	{
	
		
		$insertmessage= "INSERT INTO messages(messageid,subject,message,sender,reciever,timestamp) VALUES (NULL,'$_POST[subject]','$_POST[message]','$_SESSION[username]','$_POST[selected_user]',NULL)";
		$insertquery=mysql_query($insertmessage);
		if($insertmessage)
		{
			echo "Message send successfully to ";
			echo $_POST['selected_user'];
	}
	}


?>


<form class="form-horizontal" role="form" method="post" action="mesendmessage.php">
<!--	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">Name</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name" value="">
		</div>
	</div> -->
	
	
	 <!-----------------------------------------------------------  Select users--------------------------------------------------------------->   
    <!------------------------------------------------------------SELECT users----------------------------------------------------------------> 
     <!------------------------------------------------------------SELECT users----------------------------------------------------------------> 
	
    <div class="form-group">
		<label for="selected_user" class="col-sm-2 control-label">Username</label>
	 <div class="col-sm-10">
        	<select name= "selected_user"  required/> 
        	<?php 
				$query_playlistscroll = "SELECT DISTINCT username from account WHERE username!='$_SESSION[username]'";
				$result_playlistscroll = mysql_query( $query_playlistscroll);
				if(mysql_num_rows($result_playlistscroll)!=0)
					{	
						while($pr=mysql_fetch_array($result_playlistscroll)){
						$playlist=$pr['username'];
						
					
        	?>
			<option name='selected_user' class="form-control" value=<?php echo $playlist ?> ><?php echo $playlist ?></option>
				<?php } } ?>
			</select>	
			
			
	</div>
       </div>
			
   <!------------------------------------------------------------------------------------------------------------------------------------------------->  
    <!------------------------------------------------------------------------------------------------------------------------------------------------->
     <!-------------------------------------------------------------------------------------------------------------------------------------------------> 
	
	
	<div class="form-group">
		<label for="subject" class="col-sm-2 control-label">Subject</label>
		<div class="col-sm-10">
			<input type="subject" class="form-control" id="email" name="subject" placeholder="Subject" value="">
		</div>
	</div>
	
	<div class="form-group">
		<label for="message" class="col-sm-2 control-label">Message</label>
		<div class="col-sm-10">
			<textarea class="form-control" rows="4" name="message" placeholder="Type Messsage..." required/></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<! Will be used to display an alert to the user>
		</div>
	</div>
</form>



