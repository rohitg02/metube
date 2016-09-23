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
  if(isset($_GET['id'])){
	$id= $_GET['id'];
	$query = "SELECT * FROM media WHERE mediaid='".$_GET['id']."'";
	$result = mysql_query( $query );
	$result_row = mysql_fetch_row($result);
	
	$filename=$result_row[0];   ////0, 4, 2
	$filepath=$result_row[4]; 
	$type=$result_row[2];
	$filedescription=$result_row[5];
	if(substr($type,0,5)=="image"){
		//view image
		echo "Viewing Picture:";
	//	echo $result_row[4];
		echo "<br>";
		echo '<img src="'.$filepath.'"/>';
		echo $filedescription;
	}
	else if(substr($type,0,5)=="audio"){
?>
<div style="text-align:center"> 
<audio controls>
  <source src="<?php echo $filepath; ?>" type="audio/ogg">
  <source src="<?php echo $filepath; ?>" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
</div> <?php 

      }//This closes the audio and the following else starts the video
  else{	 
?>

<?php
	echo "Viewing Video:";
	//echo $result_row[4];
?>
    <object id="MediaPlayer" width=320 height=286 classid="CLSID:22D6f312-B0F6-11D0-94AB-0080C74C7E95" standby="Loading Windows Media Player components…" type="application/x-oleobject" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,7,1112">

<param name="filename" value="<?php echo $result_row[4];?>">
<param name="Showcontrols" value="True">
<param name="autoStart" value="True">

<div style="text-align:center"> 
  <video id="video1" width="384" height="288" controls>
	<source src="<?php echo $filepath; ?>" type="video/mp4">
	<source src="<?php echo $filepath; ?>" type="video/webm">
	<source src="<?php echo $filepath; ?>" type="video/ogg">
  </video>

  <br><br><br>
  <button style="color:white" class="btn btn-primary raised round" onclick="makeBig()">Big</button>
  <button style="color:white" class="btn btn-primary raised round" onclick="makeNormal()">Normal</button>
  <button style="color:white" class="btn btn-primary raised round" onclick="makeSmall()">Small</button>
</div> 

  <script> 
    var myVideo = document.getElementById("video1"); 

    myVideo.onseeking = function(){};

    function makeBig() { 
      myVideo.width = 560; 
    } 

    function makeNormal() { 
      myVideo.width = 420; 
    }

    function makeSmall() { 
      myVideo.width = 320; 
    } 
  </script>
</object>

    <?php
	    }
      }
      else{
    ?>

    <meta http-equiv="refresh" content="0;url=browse.php">
    <?php
      }
    ?>
  <!-- echo $filedescription; -->
<!---*************************************Button to add media in the favorite list**************************************************************-->	
<!---**************************************Button to add media in the favorite list************************************************************-->	
<!---**************************************Button to add media in the favorite list***********************************************************-->		
			
	<form name="formg" method="post" action= <?php "media.php?id=".$id ; ?> >	
	<label> DESCRIPTION: <?php echo $filedescription ?></label><br>	
	<a href="<?php echo $filepath;?>"  download="<?php echo $result_row[4];?>">Download</a>	
	</form>


<!---*************************************Button to add media in the favorite list**************************************************************-->	
<!---**************************************Button to add media in the favorite list************************************************************-->	
<!---**************************************Button to add media in the favorite list***********************************************************-->		

        	<form name="form3" method="post" action= <?php "media.php?id=".$id ; ?> >
			<input type="submit"  name="addtofavorites" value="Add to favorites"/>
			</form>
	
		
	<!--Checking if the media already exist in the users favorite playlist or not-->	
			<?php 
				if(isset($_POST['addtofavorites'])){
					$queryfavorite = "SELECT * from favplaylist WHERE username='$_SESSION[username]' AND mediaid=$id";
					$resultfavorite = mysql_query( $queryfavorite );	
					if(mysql_num_rows($resultfavorite) !=0)
					{	
						echo "Media is already in your favorite Playlist";
					}	
					else{
						$queryfavorite = "insert into favplaylist values ('$_SESSION[username]','$id')";
						$insertfav = mysql_query($queryfavorite);
						if($insertfav)
						Echo "Media has been successfully been added to your Favorite List";
					}
				
			}
			
			?>
<!---*****************************************************************************************************************************************-->	
<!---*****************************************************************************************************************************************-->	
<!---*****************************************************************************************************************************************-->				


<!---*************************************Button to SUBSCRIBE FOR A CHANNEL**************************************************************-->	
<!---**************************************Button to SUBSCRIBE FOR A CHANNEL***********************************************************-->	
<!---**************************************Button to SUBSCRIBE FOR A CHANNEL**********************************************************-->		

        	<form name="channel_subscription" method="post" action= <?php "media.php?id=".$id ; ?> >
        	<select name= "selected_channel" required/> 
        	<?php 
				$query_playlistscroll = "SELECT DISTINCT channelname from channels WHERE mediaid='$id' AND username!='$_SESSION[username]'";
				$result_playlistscroll = mysql_query( $query_playlistscroll);
				if(mysql_num_rows($result_playlistscroll)!=0)
					{	
						while($pr=mysql_fetch_array($result_playlistscroll)){
						$playlist=$pr['channelname'];
						
					
        	?>
				<option name='selected_channel' value=<?php echo $playlist ?> ><?php echo $playlist ?></option>
				<?php } } ?>
			</select>	
			<input type="submit" name="subscribe" value="Subscribe to channel"/>
			</form>
			
	<!--Checking if the media already exist in the users playlist or not-->	
			<?php 
				
				if(isset($_POST['subscribe'])){
				//	echo $_POST['selected_playlist'];
					$queryfavorite = "SELECT channelname from subscription WHERE username='$_SESSION[username]' AND channelname= '$_POST[selected_channel]'";
					$resultfavorite = mysql_query( $queryfavorite );	
					if(mysql_num_rows($resultfavorite) !=0)
					{	
						echo "You have already subscribed for the Channel";
					}	
					else{
						$queryfavorite = "insert into subscription values ('$_SESSION[username]','$_POST[selected_channel]')";
						$insertfav = mysql_query($queryfavorite);
						if($insertfav)
						Echo "You have Subscribed for the channel";
					
					}
				
			}
			
			?>
<!---*****************************************************************************************************************************************-->	
<!---*****************************************************************************************************************************************-->	
<!---*****************************************************************************************************************************************-->	


<!---*************************************Button to add media in the playlist list**************************************************************-->	
<!---**************************************Button to add media in the playlist list************************************************************-->	
<!---**************************************Button to add media in the playlist list***********************************************************-->		

        	<form name="play_list" method="post" action= <?php "media.php?id=".$id ; ?> >
        	<select name= "selected_playlist" required/> 
        	<?php 
				$query_playlistscroll = "SELECT DISTINCT playlist from playlists WHERE username='$_SESSION[username]'";
				$result_playlistscroll = mysql_query( $query_playlistscroll);
				if(mysql_num_rows($result_playlistscroll)!=0)
					{	
						while($pr=mysql_fetch_array($result_playlistscroll)){
						$playlist=$pr['playlist'];
						
					
        	?>
				<option name='selected_playlist' valuephp=<?php echo $playlist ?> ><?php echo $playlist ?></option>
				<?php } } ?>
			</select>	
			<input type="submit" name="addto_playlist" value="Add to playlist"/>
			</form>
			
	<!--Checking if the media already exist in the users playlist or not-->	
			<?php 
				
				if(isset($_POST['addto_playlist'])){
				//	echo $_POST['selected_playlist'];
					$queryfavorite = "SELECT username from playlists WHERE username='$_SESSION[username]' AND mediaid='$id' AND playlist = '$_POST[selected_playlist]'";
					$resultfavorite = mysql_query( $queryfavorite );	
					if(mysql_num_rows($resultfavorite) !=0)
					{	
						echo "Media is already in your Playlist";
					}	
					else{
						$queryfavorite = "insert into playlists values ('$_SESSION[username]','$id','$_POST[selected_playlist]')";
						$insertfav = mysql_query($queryfavorite);
						if($insertfav)
						Echo "Media has been successfully been added to your Play List";
					
					}
				
			}
			
			?>
<!---*****************************************************************************************************************************************-->	
<!---*****************************************************************************************************************************************-->	
<!---*****************************************************************************************************************************************-->		



		
		
<!---**************************************Button and Text Box to add comment on a media file************************************************************-->	
<!---**************************************Button and Text Box to add comment on a media file*************************************************-->	
<!---**************************************Button and Text Box to add comment on a media file*************************************************-->	
	
		<p><strong>Add Comment</strong></p>
        	<form name="form2" method="post" action= <?php "media.php?id=".$id ; ?> >
                <input name="comment" type="textarea"  size="75" maxlength="200" required/>
		<input type="submit" name="submitcomment" value="Submit Query"/><br>
        </form>

	 <?php
				
				if(isset($_POST['submitcomment']))
				{
					$commentval = $_POST['comment'];
			
				$querycomment = "insert into comments values (NULL,'$_SESSION[username]','$id','$commentval')";
				$insertcomment = mysql_query($querycomment);
				}
       ?>
		
<!---*****************************************************************************************************************************************-->	
<!---*****************************************************************************************************************************************-->	
<!---*****************************************************************************************************************************************-->	



<!---*********************************************Printing comments ***************************************************************************-->	
<!---*********************************************Printing comments ***************************************************************************-->	
<!---*********************************************Printing comments *************************************************************************-->	

<?php

//Selecting comments table
	
        $querycomments = "SELECT * from comments WHERE mediaid=$id"; 
        $resultcomments = mysql_query( $querycomments );
        if (!$resultcomments){
           die ("Could not query the media table in the database: <br />". mysql_error());
        }
	
?>
<br>

                <?php
                echo "<h3>"," COMMENTS <br/>","</h3>"; 
            //commentId,username, mediaid, commentstext
                        while ($resultcomments_row = mysql_fetch_row($resultcomments)){ 
                                $commentId= $resultcomments_row[0];
                                $username= $resultcomments_row[1];
                                $mediaid= $resultcomments_row[2];
				$commentstext= $resultcomments_row[3];
	   // Printing Username and Comments
				echo "Username:"; 
				echo "<strong>";
				echo $username; 
				echo ":","   ","</strong>";
				echo $commentstext."<br/>"; 
                }
?>
<!---*****************************************************************************************************************************************-->	
<!---*****************************************************************************************************************************************-->	
<!---*****************************************************************************************************************************************-->	






  </body>
</html>
