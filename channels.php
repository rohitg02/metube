<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/buttons.css" rel="stylesheet">

<?php
session_cache_limiter('private,must-revalidate');
$cache_limiter =session_cache_limiter();
session_cache_expire(60);
	session_start();
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
	
<strong><h1 align="center">Channels </strong></h1>
	
<strong><h3 >Your Chanel </strong></h3>

<?php

include "dbconnect.php";	
	if(isset($_POST['mychannels'])){
					$link="channels.php?channels="; 
					$output=NULL;
					$download=NULL;
					$usern=$_SESSION['username'];
					$queryplaylists = "SELECT DISTINCT channelname FROM channels WHERE username='$usern'";
					$resultplaylists= mysql_query( $queryplaylists );
					
					
					if(mysql_num_rows($resultplaylists) ==0)
					{	
						$output = "You do not have any Channels";
					}	
					else{
						while($pr=mysql_fetch_array($resultplaylists)){
						$playlist=$pr['channelname'];
						//$output= $playlist_name;
						//$media_id= $pr['mediaid'];
						//$path_var=$pr['path'];
						//$favfilename=$pr['filename'];
						$output .="<a href=$link$playlist> $playlist</a><br>";
						//$download .="<a href= $path_var onclick=javascript:saveDownload($path_var)> Download</a><br>";
					}

		}
	}
?>
	
	
<!------------------------------------------------------ Print Channels----------------------------------------------------------------------------->
<!------------------------------------------------------ Print Channels----------------------------------------------------------------------------->
<!------------------------------------------------------ Print Channels----------------------------------------------------------------------------->
<?php
	if(isset($output))
	{
		Echo $output;
	}
?>	

<!---------------------------------------------Print media files in Channels when clicked------------------------------------------------------------->
<!---------------------------------------------Print media files in Channels when clicked------------------------------------------------------------->
<!---------------------------------------------Print media files in Channels when clicked------------------------------------------------------------->

<?php

if(isset($_GET['channels']))
	{
	$playlist= $_GET['channels'];
	$output_playlist=NULL; 
	$link="media.php?id=";
	$usern=$_SESSION['username'];
	$delete=NULL;
	$echotable=NULL;
	//echo $usern;
	$query_display_playlist = "SELECT channels.mediaid, media.path,channels.username, channels.channelname, media.filename FROM media INNER JOIN channels ON channels.mediaid=media.mediaid WHERE channels.username='$usern' AND channels.channelname = '$playlist'";
	$result_display_playlist = mysql_query( $query_display_playlist );		
		if(mysql_num_rows($result_display_playlist) ==0)
					{	
						$echotable = "You do not have any Media in your Channel";
					}	
					else{
						while($pr_playlist=mysql_fetch_array($result_display_playlist)){
						$playlist_display=$pr_playlist['channelname'];
						//$output= $playlist_name;
						$media_id= $pr_playlist['mediaid'];
						//$path_var=$pr['path'];
						$playlistfile_name=$pr_playlist['filename'];
						$output_playlist ="<table><tr><td><a href=$link$media_id> $playlistfile_name</a><br></td>";
						$delete ="<td><a href= delete.php?id=$media_id style= color:#cc0000> Delete Media</a><br></td></tr></table>";
						$echotable .=$output_playlist.$delete;
					}
	}
}
	?>
<?php
	if(isset($output_playlist))
	{
		ECho "FILES UPLOADED BY YOU<br>";
		echo $echotable;
}
?>	

<!---*************************************(BUTTON)ADD new CHANNEL (using channels.php)**************************************************************-->	
<!---**************************************(BUTTON)ADD new CHANNEL (using channels.php)*********************************************************-->	
<!---*************************************(BUTTON)ADD new CHANNEL (using channels.php)*******************************************************-->	
        	<form name="channel" method="post" action= "channels.php" >
			<input name="channelname" type="textarea" maxlength="25" required/>
			<input type="submit" name="addnewchannel" value="Create new Channel"/><br><hr>
			</form>

<?php 
				if(isset($_POST['addnewchannel'] ))
				{
					$playlistp= $_POST['channelname'];
				}
				if(isset($_POST['addnewchannel'])){
					$queryfavorite = "SELECT * from channels WHERE channelname='$playlistp' OR username='$_SESSION[username]'";
					$resultfavorite = mysql_query( $queryfavorite );	
					if(mysql_num_rows($resultfavorite) !=0)
					{	
						echo "Channel name has already been taken OR you already have a channel";
					}	
					else{
						$queryfavorite = "insert into channels(username,channelname,mediaid) VALUES ('$_SESSION[username]','$playlistp',NULL)";
						$insertfav = mysql_query($queryfavorite);
						if($insertfav)
						Echo "Channel has been successfully created";
						

					}
				
			}
			
			?>
<!--CHANNELS FOR WHICH USER HAS SUBSCRIBED FOR-->

	
<form name="form4" method="post" action= "subscribe.php" >
<input type="submit" class="btn btn-small btn-block btn-primary"  name="subscribed_channels" value="Subscribed Channels"/>
</form>
			





	
</body>	
</html>
