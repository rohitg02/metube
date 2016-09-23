<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/buttons.css" rel="stylesheet">

<?php
	session_start();
	include_once "function.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Browse</title>
<link rel="stylesheet" type="text/css" href="css/default.css" />
<script type="text/javascript" src="js/jquery-latest.pack.js"></script>
<script type="text/javascript">
function saveDownload(id){
	$.post("media_download_process.php",
	{
       id: id,
	},
	function(message){ }
 	);
} 
</script>

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
        <li class="dropdown">
	  <a href='media_upload.php' style="color:white" class="btn btn-primary raised round">Upload File</a>
        </li>
        <li class="dropdown">
	  <a href='update.php' style="color:white" class="btn btn-primary raised round">Update</a>
        </li>
      </ul>
      
   
	<form name="catsearch" method="post" action="searchresults.php">
		 &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
		  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
		   &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
		    &nbsp;&nbsp;&nbsp; &nbsp;
	<input name="search" type="text" size="40" maxlength="50" placeholder= "title/metadata keywords/filename" required/>
	<input type="submit" name="Submit" class="btn btn-primary" value="Search"/><br>
      </form>
     <!-----------------------------------------Category Search------------------------------------------------------------>
     <!------------------------------------------Category Search----------------------------------------------------------->
     <!------------------------------------------Category Search----------------------------------------------------------->
       
    <form name="catsearch" method="post" action="searchresults.php">
	    <select name="scroll_categories_search" id="see" >
				<option value="Music">Music</option>
				<option value="Sports">Sports</option>
				<option value="Gaming">Gaming</option>
				<option value="Movies">Movies</option>
				<option value="News">News</option>
				<option value="TV Shows">TV Shows</option>
        </select>
        &nbsp;<input name="search_category" type="text" size="40" maxlength="50" placeholder= "search in category" required/>
         <label for="see" class="col-lg-2 control-label">Category*:</label>
		<input type="submit" name="categorysearch" class="btn btn-primary" value="Search"/><br>
      </form>
       <!-----------------------------------------------------------------------------------------------------------------> 
     <!------------------------------------------------------------------------------------------------------------------->
     <!-------------------------------------------------------------------------------------------------------------------> 
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
<div align="right">
 
<!---*************************************(BUTTON)Display favorite list (using favplaylist.php)**************************************************************-->	
<!---**************************************(BUTTON)Display favorite list (using favplaylist.php)*********************************************************-->	
<!---*************************************(BUTTON)Display favorite list (using favplaylist.php)*******************************************************-->	
        	<form name="form4" method="post" action= "favplaylist.php" >
			<input type="submit" class="btn btn-small btn-block btn-primary"  name="myfavplaylist" value="Favorite Playlist"/>
			</form>
			
<!---*************************************(BUTTON) Display Playlist list (using playlists.php)**************************************************************-->	
<!---**************************************(BUTTON)Display Playlist list (using playlists.php)*********************************************************-->	
<!---*************************************(BUTTON)Display Playlist list (using playlists.php)*******************************************************-->	
        	<form name="form5" method="post" action= "playlists.php" >
			<input type="submit" class="btn btn-small btn-block btn-primary"  name="myplaylists" value="Playlist"/>
			</form>

<!---*************************************(BUTTON)Display Channels list (using channels.php)**************************************************************-->	
<!---**************************************(BUTTON)Display Channels list (using channels.php)*********************************************************-->	
<!---*************************************(BUTTON)Display Channels list (using channels.php)*******************************************************-->	
        	<form name="form6" method="post" action= "channels.php" >
			<input type="submit" class="btn btn-small btn-block btn-primary" name="mychannels" value="My Channels"/>
			</form>


<!---*************************************(BUTTON)Display Categories list (using categories.php)**************************************************************-->	
<!---**************************************(BUTTON)Display Categories list (using categories.php)*********************************************************-->	
<!---*************************************(BUTTON)Display Categories list (using categories.php)*******************************************************-->	
        	<form name="form7" method="post" action= "categories.php" >
			<input type="submit" class="btn btn-small btn-block btn-primary"  name="categories" value="Categories"/>
			</form>
</div>			
<body class="bg-info">
	
<div id='upload_result'>
<?php 
	if(isset($_REQUEST['result']) && $_REQUEST['result']!=0){		
		echo upload_error($_REQUEST['result']);
	}
?>
</div>




<?php

	$query = "SELECT * from media"; 
	$result = mysql_query( $query );
	if (!$result){
	   die ("Could not query the media table in the database: <br />". mysql_error());
	}
?>
    
	
    <h3 align="center"> Media</h3>
	<table width="50%" cellpadding="0" cellspacing="0">
		<?php
            //filename, username, type, mediaid, path
			while ($result_row = mysql_fetch_row($result)){ 
				$mediaid = $result_row[3];
				$filename = $result_row[0];
				$filenpath = $result_row[4];
		?>
        	 <tr valign="top">			
		
			<td>
			<?php $link="media.php?id="; ?>
            	        &nbsp; &nbsp; &nbsp;
            	         &nbsp; &nbsp; &nbsp;
            	         <a href="media.php?id=<?php echo $mediaid;?>"><?php echo $filename;?></a> 
                        </td>
                        <!--
                        <td>
            	            <a href="<?php echo $filenpath;?>"  download="<?php echo $result_row[4];?>">Download</a>
                        </td>
                        -->
		</tr>
        	<?php
			}
		?>
	</table>



<!---*************************************(BUTTON)Send Message (using mesendmessage.php)**************************************************************-->	
<!---**************************************(BUTTON)Display favorite list (using mesendmessage.php)*********************************************************-->	
<!---*************************************(BUTTON)Display favorite list (using mesendmessage.php)*******************************************************-->	
<div align="right">
<div align="top">	
        	<form name="mesendmessage" method="post" action= "mesendmessage.php" >
			<input type="submit" class="btn btn-small btn-block btn-primary"  name="mesendmessage" value="Send Message"/>
			</form>
			
<!---*************************************(BUTTON)Inbox (using inbox.php)**************************************************************-->	
<!---**************************************(BUTTON)Inbox (using inbox.php)*********************************************************-->	
<!---*************************************(BUTTON)Inbox (using inbox.php)*******************************************************-->	
        	<form name="inbox" method="post" action= "inbox.php" >
			<input type="submit" class="btn btn-small btn-block btn-primary"  name="inbox" value="Inbox"/>
			</form> 	

<!---*************************************(BUTTON)Display favorite list (using favplaylist.php)**************************************************************-->	
<!---**************************************(BUTTON)Display favorite list (using favplaylist.php)*********************************************************-->	
<!---*************************************(BUTTON)Display favorite list (using favplaylist.php)*******************************************************-->	
        	

	<!-- <form name="form4" method="post" action= "sendmessage.php" >
			<input type="submit" class="btn btn-small btn-block btn-primary"  name="sendmessage" value="Email"/>
			</form>-->

</div>
</div>
	
   </div>
</body>
</html>
