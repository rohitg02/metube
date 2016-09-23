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
	
<strong><h1 align="center">SUBSCRIBED CHANNELS </strong></h1>


<?php

include "dbconnect.php";	
	if(isset($_POST['subscribed_channels'])){
					$link="subscribe.php?subscribe="; 
					$output=NULL;
					$download=NULL;
					$usern=$_SESSION['username'];
					$queryplaylists = "SELECT channelname FROM subscription WHERE username='$_SESSION[username]'";
					$resultplaylists= mysql_query( $queryplaylists );
					
					
					if(mysql_num_rows($resultplaylists) ==0)
					{	
						$output = "You haven't subscribed for any channel";
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

if(isset($_GET['subscribe']))
	{
	$playlist= $_GET['subscribe'];
	$output_playlist=NULL; 
	$link="media.php?id=";
	$usern=$_SESSION['username'];
	//echo $usern;
	$query_display_playlist = "SELECT channels.mediaid, media.path,channels.username, channels.channelname, media.filename FROM media INNER JOIN channels ON channels.mediaid=media.mediaid WHERE channels.channelname = '$playlist'";
	$result_display_playlist = mysql_query( $query_display_playlist );		
		if(mysql_num_rows($result_display_playlist) ==0)
					{	
						$output_playlist = "Are you ok";
					}	
					else{
						while($pr_playlist=mysql_fetch_array($result_display_playlist)){
						$playlist_display=$pr_playlist['channelname'];
						//$output= $playlist_name;
						$media_id= $pr_playlist['mediaid'];
						//$path_var=$pr['path'];
						$playlistfile_name=$pr_playlist['filename'];
						$output_playlist .="<a href=$link$media_id> $playlistfile_name</a><br>";
						//$download .="<a href= $path_var onclick=javascript:saveDownload($path_var)> Download</a><br>";
					}
	}
}
	?>
<?php

	if(isset($output_playlist))
	{
		ECho "SUBSCRIBED CHANNEL MEDIA<br>";
		Echo $output_playlist;
	}
	
?>	


