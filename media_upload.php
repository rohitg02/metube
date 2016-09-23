<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/buttons.css" rel="stylesheet">

<?php
session_start();
include_once"dbconnect.php";
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Media Upload</title>
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
    <form method="post" action="media_upload_process.php" enctype="multipart/form-data" >
      <p style="margin:0; padding:0">
  
   <!------------------------------------------------------------SELECT TITLE---------------------------------------------------------------->   
    <!------------------------------------------------------------SELECT TITLE----------------------------------------------------------------> 
     <!------------------------------------------------------------SELECT TITLE----------------------------------------------------------------> 		  
	<div class="form-group">
	  <div class="col-lg-10">
	    <input type="text" placeholder="Title" id="title" name="title" required/ >
        <label for="title" class="col-lg-2 control-label">Title*</label>
      </div>
    </div><br><br>	 
    
    <!-----------------------------------------------------------ADD MEDIA---------------------------------------------------------------------->  
    <!-----------------------------------------------------------ADD MEDIA----------------------------------------------------------------------->
     <!-----------------------------------------------------------ADD MEDIA------------------------------------------------------------------------> 
     
		
	<div class="form-group">
	  <div class="col-lg-10">	  
        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" class="col-lg-2 control-label" required/>
        <label style="color:black" class="col-lg-2 control-label"><em> Add a Media*: </em></label>
        <label style="color:red" ><em> (Each file limit 10M)</em></label><br/>
		<input name="file" type="file" size="50" class="btn btn-primary raised round"/><br>
      </div>
    </div><br><br>
    
   <!------------------------------------------------------------SELECT CATEGORY---------------------------------------------------------------->   
    <!------------------------------------------------------------SELECT CATEGORY----------------------------------------------------------------> 
     <!------------------------------------------------------------SELECT CATEGORY----------------------------------------------------------------> 
	<div class="form-group">
	  <div class="col-lg-10">
	    <select name="scroll_categories" id="see" >
				<option value="Music">Music</option>
				<option value="Sports">Sports</option>
				<option value="Gaming">Gaming</option>
				<option value="Movies">Movies</option>
				<option value="News">News</option>
				<option value="TV Shows">TV Shows</option>
        </select>
         <label for="see" class="col-lg-2 control-label">Category*:</label>
      </div>
    </div><br><br>
    
   <!------------------------------------------------------------------------------------------------------------------------------------------------->  
    <!------------------------------------------------------------------------------------------------------------------------------------------------->
     <!-------------------------------------------------------------------------------------------------------------------------------------------------> 
   
   
   <!------------------------------------------------------------SELECT CHANNEL---------------------------------------------------------------->   
    <!------------------------------------------------------------SELECT CHANNEL----------------------------------------------------------------> 
     <!------------------------------------------------------------SELECT CHANNEL----------------------------------------------------------------> 
	
    <div class="form-group">
	  <div class="col-lg-10">
        	<select name= "selected_channel"  required/> 
        	<?php 
				$query_playlistscroll = "SELECT DISTINCT channelname from channels WHERE username='$_SESSION[username]'";
				$result_playlistscroll = mysql_query( $query_playlistscroll);
				if(mysql_num_rows($result_playlistscroll)!=0)
					{	
						while($pr=mysql_fetch_array($result_playlistscroll)){
						$playlist=$pr['channelname'];
						
					
        	?>
				<option name='selected_channel' value=<?php echo $playlist ?> ><?php echo $playlist ?></option>
				<?php } } ?>
			</select>	
			<label for="selected_channel" class="col-lg-2 control-label">Channel*:</label>
	</div>
       </div><br><br>
			
   <!------------------------------------------------------------------------------------------------------------------------------------------------->  
    <!------------------------------------------------------------------------------------------------------------------------------------------------->
     <!-------------------------------------------------------------------------------------------------------------------------------------------------> 
     
     
   
      <!---------------------------------------------------------METADATA INPUT---------------------------------------------------------------------->
    <!-----------------------------------------------------------METADATA INPUT--------------------------------------------------------------------->
     <!----------------------------------------------------------METADATA INPUT---------------------------------------------------------------------->      
        
	<div class="form-group">
	  <div class="col-lg-10">
		     <label style="color:red" ><em>(User can search your file based on this keywords seperated by spaces)</em></label><br/>
	    <input type="text" placeholder="Metadata input" id="metadata" name="metadata" placeholder="enter key words seperated by space" required/>
        <label for="metadata" class="col-lg-2 control-label">Metadata*:</label>
      </div>
    </div><br><br>
    
     <!------------------------------------------------------------------------------------------------------------------------------------------------->  
      <!------------------------------------------------------------------------------------------------------------------------------------------------->
       <!-------------------------------------------------------------------------------------------------------------------------------------------------> 
   
   
   
   
   
   
     
        
   <!------------------------------------------------------------WRITE DESCRIPTION---------------------------------------------------------------------->
    <!-----------------------------------------------------------WRITE DESCRIPTION--------------------------------------------------------------------->
     <!----------------------------------------------------------WRITE DESCRIPTION---------------------------------------------------------------------->      
        
	<div class="form-group">
	  <div class="col-lg-10">
	    <input type="text" placeholder="Describe your file" id="description" name="description" required/>
        <label for="description" class="col-lg-2 control-label">Description:</label>
      </div>
    </div><br><br>
    
     <!------------------------------------------------------------------------------------------------------------------------------------------------->  
      <!------------------------------------------------------------------------------------------------------------------------------------------------->
       <!-------------------------------------------------------------------------------------------------------------------------------------------------> 
        
     
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input value="Upload" class="btn btn-primary raised round" name="submit" type="submit" />
      </p>    

 

 
     </form>
  </body>
</html>

