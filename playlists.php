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
<?php

include "dbconnect.php";	
	if(isset($_POST['myplaylists'])){
					$link="playlists.php?playlists="; 
					$output=NULL;
					$download=NULL;
					$usern=$_SESSION['username'];
					$queryplaylists = "SELECT DISTINCT playlist FROM playlists WHERE username='$usern'";
					$resultplaylists= mysql_query( $queryplaylists );
					
					
					if(mysql_num_rows($resultplaylists) ==0)
					{	
						$output = "You do not have any Playlist";
					}	
					else{
						while($pr=mysql_fetch_array($resultplaylists)){
						$playlist=$pr['playlist'];
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

<!------------------------------------------------------ Print Playlists----------------------------------------------------------------------------->
<!------------------------------------------------------ Print Playlists----------------------------------------------------------------------------->
<!------------------------------------------------------ Print Playlists----------------------------------------------------------------------------->
<?php
	if(isset($output))
	{
		Echo $output;
	}
?>	

<!---------------------------------------------Print media files in playlist when clicked------------------------------------------------------------->
<!---------------------------------------------Print media files in playlist when clicked------------------------------------------------------------->
<!---------------------------------------------Print media files in playlist when clicked------------------------------------------------------------->

<?php

if(isset($_GET['playlists']))
	{
	$playlist= $_GET['playlists'];
	$output_playlist=NULL; 
	$link="media.php?id=";
	$usern=$_SESSION['username'];
	//echo $usern;
	$query_display_playlist = "SELECT playlists.mediaid, media.path,playlists.username, playlists.playlist, media.filename FROM media INNER JOIN playlists ON playlists.mediaid=media.mediaid WHERE playlists.username='$usern' AND playlists.playlist = '$playlist'";
	$result_display_playlist = mysql_query( $query_display_playlist );		
		if(mysql_num_rows($result_display_playlist) ==0)
					{	
						$output_playlist = "You do not have any Media in your Playlist";
					}	
					else{
						
						while($pr_playlist=mysql_fetch_array($result_display_playlist)){
						$playlist_display=$pr_playlist['playlist'];
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

		Echo $output_playlist;
	//	Header("Refresh:0");
	}
?>	


<!---*************************************(BUTTON)ADD new play list (using playlist.php)**************************************************************-->	
<!---**************************************(BUTTON)ADD new play list (using playlist.php)*********************************************************-->	
<!---*************************************(BUTTON)ADD new play list (using playlist.php)*******************************************************-->	
        	<form name="form8" method="post" action= "playlists.php" >
			<input name="playlistname" type="textarea" maxlength="25" required/>
			<input type="submit" name="addplaylist" value="Create new playlist"/><br><hr>
			</form>

<?php 
				if(isset($_POST['addplaylist'] ))
				{
					$playlistp= $_POST['playlistname'];
				}
				if(isset($_POST['addplaylist'])){
					$queryfavorite = "SELECT * from playlists WHERE username='$_SESSION[username]' AND playlist='$playlistp'";
					$resultfavorite = mysql_query( $queryfavorite );	
					if(mysql_num_rows($resultfavorite) !=0)
					{	
						echo "You have a playlist with same name: USE A DIFFERENT NAME";
					}	
					else{
						$queryfavorite = "insert into playlists(username,mediaid,playlist) VALUES ('$_SESSION[username]',NULL,'$playlistp')";
						$insertfav = mysql_query($queryfavorite);
						if($insertfav)
						Echo "Playlist has been successfully been added";
						

					}
				
			}
			if($insertfav)
			
			?>

						<form name="form5" method="post" action= "playlists.php" >
						<input type="submit" name="myplaylists" value="Refresh your playlist list"/><br><hr>
						</form>

	
</body>	
</html>
