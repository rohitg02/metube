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

ini_set('session.cache_limiter','public');
session_cache_limiter(true);
include "dbconnect.php";	
	if(isset($_POST['myfavplaylist'])){
					$link="media.php?id="; 
					$output=NULL;
					$echotable=NULL;
					$download=NULL;
					$usern=$_SESSION['username'];
					$queryfavorite = "SELECT favplaylist.mediaid, media.path,media.username, media.filename FROM media INNER JOIN favplaylist ON favplaylist.mediaid=media.mediaid WHERE favplaylist.username='$usern'";
					$resultfavorite = mysql_query( $queryfavorite );
					if(mysql_num_rows($resultfavorite) ==0)
					{	
						
						$output = 'You do not have any media in Favorite playlist';
					}	
					else{
						while($pr=mysql_fetch_array($resultfavorite)){
						if($pr!=NULL)
						$media_id= $pr['mediaid'];
						$path_var=$pr['path'];
						$favfilename=$pr['filename'];
						
						
						$output ="<table><tr><td><a href=$link$media_id target=_blank> $favfilename</a><br></td>";
						$delete ="<td><a href= delete.php?mid=$media_id style= color:#cc0000> Delete Media</a><br></td></tr></table>";
					//	$download .="<a href= $path_var onclick=javascript:saveDownload($path_var)> Download</a><br>";
						$echotable .=$output.$delete;
					}
					
					
						
						
					

		}
	}
?>

<!-- Print search results-->
<?php 
	
	Echo($echotable);
	
?>
	

