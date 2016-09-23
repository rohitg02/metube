
<?php 
include "dbconnect.php";
session_start();
///////////////////////////////////DELETE MEDIA////////////////////////////////////
if(isset($_GET['id']))

{
	
	$deletemedia=$_GET['id'];
	
	//Delete from media table
	
	$deletequery= "DELETE FROM media WHERE mediaid='$deletemedia'";
	$del=mysql_query($deletequery);
	
	//DELETE from categories
	
	$deletequery= "DELETE FROM categories WHERE mediaid='$deletemedia'";
	$del=mysql_query($deletequery);
	
	
	//DELETE from channels
	
	$deletequery= "DELETE FROM channels WHERE mediaid='$deletemedia'";
	$del=mysql_query($deletequery);
	
	////DELETE from comments
	
	$deletequery= "DELETE FROM comments WHERE mediaid='$deletemedia'";
	$del=mysql_query($deletequery);
	
	//Delete from favplaylist
	
	$deletequery= "DELETE FROM favplaylist WHERE mediaid='$deletemedia'";
	$del=mysql_query($deletequery);
	
	//Delete from playlists
	
	$deletequery= "DELETE FROM playlists WHERE mediaid='$deletemedia'";
	$del=mysql_query($deletequery);
	
	header('Location: browse.php');
}



////////////DELETE USER PROFILE
if(isset($_POST['delete']))

{
	
	$deleteuser=$_SESSION['username'];
	echo"hello";
	//DELETE from account table
	$deletequery= "DELETE FROM account WHERE username='$deleteuser'";
	$del=mysql_query($deletequery);
	
	//DELETE from categories
	
	$deletequery= "DELETE FROM categories WHERE username='$deleteuser'";
	$del=mysql_query($deletequery);
	
	
	//DELETE from channels
	
	$deletequery= "DELETE FROM channels WHERE username='$deleteuser'";
	$del=mysql_query($deletequery);
	
	////DELETE from comments
	
	$deletequery= "DELETE FROM comments WHERE username='$deleteuser'";
	$del=mysql_query($deletequery);
	
	//Delete from favplaylist
	
	$deletequery= "DELETE FROM favplaylist WHERE username='$deleteuser'";
	$del=mysql_query($deletequery);
	
	//Delete from media table
	
	$deletequery= "DELETE FROM media WHERE username='$deleteuser'";
	$del=mysql_query($deletequery);
	
	///DELETE from messages
	$deletequery= "DELETE FROM messages WHERE sender='$deleteuser' OR reciever='$deleteuser' ";
	$del=mysql_query($deletequery);
	
	
	
	//Delete from playlists
	
	$deletequery= "DELETE FROM playlists WHERE username='$deleteuser'";
	$del=mysql_query($deletequery);
	
	//Delete from subscription
	
	$deletequery= "DELETE FROM subscription WHERE username='$deleteuser'";
	$del=mysql_query($deletequery);
	
	
	
	header('Location: logout.php');
}


////////////DELETE PLAYLIST
if(isset($_GET['playlists']))

{
	
	$getplaylist= $_GET['playlists'];
	$deleteuser=$_SESSION['username'];
	
	
	//Delete from playlists
	
	$deletequery= "DELETE FROM playlists WHERE username='$deleteuser' AND playlist= '$getplaylist'";
	$del=mysql_query($deletequery);
	
	
	header('Location: browse.php');

}


////////////DELETE FILES FROM FAVLIST
if(isset($_GET['mid']))

{
	
	$id= $_GET['mid'];
	$deleteuser=$_SESSION['username'];
	
	//Delete from favplaylist
	
	$deletequery= "DELETE FROM favplaylist WHERE username='$deleteuser' AND mediaid= '$id'";
	$del=mysql_query($deletequery);
	header('Location: browse.php');

}


	

?>
