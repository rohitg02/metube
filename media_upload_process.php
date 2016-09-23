<?php
session_start();
include_once "function.php";

/******************************************************
*
* upload document from user
*
*******************************************************/

$username=$_SESSION['username'];


//Create Directory if doesn't exist
if(!file_exists('uploads/')){
	mkdir('uploads/');
	chmod('uploads', 0755);
}
$dirfile = 'uploads/'.$username.'/';
if(!file_exists($dirfile))
	mkdir($dirfile);
	chmod($dirfile, 0755);
	if($_FILES["file"]["error"] > 0 )
	{ 	$result=$_FILES["file"]["error"];} //error from 1-4
	else
	{
		$upfile = $dirfile.urlencode($_FILES["file"]["name"]);
	  
	  if(file_exists($upfile))
	  {
	  	$result="5"; //The file has been uploaded.
	  }
	  else{
			if(is_uploaded_file($_FILES["file"]["tmp_name"]))
			{
				if(!move_uploaded_file($_FILES["file"]["tmp_name"],$upfile))
				{
					$result="6"; //Failed to move file from temporary directory
				}
				else /*Successfully upload file*/
				{
					
					
					//insert into media table
					$insert = "insert into media(mediaid, filename,username,type, path,description,title,metadata)".
							  "values(NULL,'". urlencode($_FILES["file"]["name"])."','$username','".$_FILES["file"]["type"]."', '$upfile','$_POST[description]','$_POST[title]','$_POST[metadata]')";
					$queryresult = mysql_query($insert)
						  or die("Insert into Media error in media_upload_process.php " .mysql_error());
						  
					//finding media id
					//finding media id
					
					$maxid="SELECT MAX(mediaid) FROM media";
					$queryresult = mysql_query($maxid)
						  or die("Insert into Media error in media_upload_process.php " .mysql_error());	
						  $playtime=mysql_fetch_row($queryresult);
					
						  
					//inserting value in categories table
					//inserting value in categories table	   
					$insertintocategory= "INSERT INTO categories(username,mediaid,category) VALUES ('$username',$playtime[0],'$_POST[scroll_categories]')";
					$queryresult = mysql_query($insertintocategory)
						  or die("Insert into Media error in media_upload_process.php " .mysql_error());
						  
						  
					//inserting value in channels table
					//inserting value in channels table	
					$insertintochannel= "INSERT INTO channels(username,channelname,mediaid) VALUES ('$username','$_POST[selected_channel]',$playtime[0])";
					$queryresult = mysql_query($insertintochannel)
						  or die("Insert into Media error in media_upload_process.php " .mysql_error());	  
						  
						  
					$result="0";
					chmod($upfile, 0644);
				}
			}
			else  
			{
					$result="7"; //upload file failed
			}
		}
	}
	
	//You can process the error code of the $result here.
?>

<meta http-equiv="refresh" content="0;url=browse.php?result=<?php echo $result;?>">
