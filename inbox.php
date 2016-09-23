<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/buttons.css" rel="stylesheet">

<?php
session_cache_limiter('private,must-revalidate');
$cache_limiter =session_cache_limiter();
session_cache_expire(60);
	session_start();
	include 'dbconnect.php';

?>	
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
    <a href="browse.php"><img src="http://i.imgur.com/3Qyvyb7.png" alt="MeTube Icon" style="width:160;height:96"></a><span style="float:right;">
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li>
	      <a href='logout.php' style="color:white" class="btn btn-primary raised round">Log Out</a>
	    </li>
      </ul>
	  <div>
	    <ul class="nav navbar-nav navbar-right">
	      <li>
		<span>Welcome <?php echo $_SESSION['username'];?></span>
	      </li>
	    </ul>
	  </div>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<body class="bg-info">
	


	
<form class="form-horizontal" role="form" method="post" action="inbox.php">

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
       
       
       <div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<input id="submit" name="submit" type="submit" value="See Conversation" class="btn btn-primary">
		</div>
	</div>
       
</form>
  </body>    
</html>	

	
	<?php
	
		
	if(isset($_POST['submit']))
	{
	
		$usernm=$_SESSION['username'];
		$rec=$_POST['selected_user'];
		$findmessage= "SELECT * FROM messages WHERE sender= '$usernm'  AND reciever='$rec' OR reciever='$usernm' AND sender='$rec'" or die(mysql_error());
		$findmessagequery=mysql_query($findmessage);
		
					if(mysql_num_rows($findmessagequery) ==0)
					{	
						echo "You do not have any Conversation with the selected user";
					}	
					else{
						while($conversationstored=mysql_fetch_array($findmessagequery)){
							
						$sender=$conversationstored['sender'];
						if($sender==$_SESSION['username'])
						{
							echo "You:";
							echo $conversationstored['timestamp'];
							echo '<br>';
							echo 'SUBJECT          ';
							echo $conversationstored['subject'];
							echo '<br>';
							echo 'MESSAGE          ';
							echo $conversationstored['message'];
							echo '<br>';							
						}
						if($sender==$_POST['selected_user'])
						{	
							echo $_POST['selected_user'];
							echo $conversationstored['timestamp'];
							echo '<br>';
							echo 'SUBJECT          ';							
							echo $conversationstored['subject'];
							echo '<br>';
							echo 'MESSAGE          ';
							echo $conversationstored['message'];
							echo '<br>';
						}				
						
					}				
			}	
		}
	
	?>
	
