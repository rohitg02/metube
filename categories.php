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
	if(isset($_POST['categories'])){
					$link="categories.php?categories="; 
					$output=NULL;
					$download=NULL;
					//$usern=$_SESSION['username'];
					$queryplaylists = "SELECT DISTINCT category FROM categories";
					$resultplaylists= mysql_query( $queryplaylists );
					
					
					if(mysql_num_rows($resultplaylists) ==0)
					{	
						$output = "No Categories";
					}	
					else{
						while($pr=mysql_fetch_array($resultplaylists)){
						$playlist=$pr['category'];
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

<!------------------------------------------------------ Print Categories----------------------------------------------------------------------------->
<!------------------------------------------------------ Print Categories----------------------------------------------------------------------------->
<!------------------------------------------------------ Print Categories----------------------------------------------------------------------------->
<?php
	if(isset($output))
	{
		Echo $output;
	}
?>	

<!---------------------------------------------Print media files in Categories when clicked------------------------------------------------------------->
<!---------------------------------------------Print media files in Categories when clicked------------------------------------------------------------->
<!---------------------------------------------Print media files in Categories when clicked------------------------------------------------------------->

<?php

if(isset($_GET['categories']))
	{
	$playlist= $_GET['categories'];
	//echo $playlist;
	$output_playlist=NULL; 
	$link="media.php?id=";
	//$usern=$_SESSION['username'];
	//echo $usern;
	$query_display_playlist = "SELECT categories.mediaid, media.path, categories.category, media.filename FROM media INNER JOIN categories ON categories.mediaid=media.mediaid WHERE categories.category = '$playlist' "; //WHERE playlists.username='$usern' AND ";
	$result_display_playlist = mysql_query( $query_display_playlist );		
		if(mysql_num_rows($result_display_playlist) ==0)
					{	
						$output_playlist = "You do not have any Media in your Playlist";
					}	
					else{
						while($pr_playlist=mysql_fetch_array($result_display_playlist)){
						$playlist_display=$pr_playlist['category'];
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
	}
	
?>	
	
</body>	
</html>
