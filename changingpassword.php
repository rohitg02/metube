<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/buttons.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="style.css" />

<?php
	session_start();
	include_once "function.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml"> 
  <head>
    <title>Change Password</title>    
  </head>

<body class="bg-info">
    <?php    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $newpassword = $_POST['newpassword'];
    $newpassword = md5($newpassword);
    $confirmnewpassword = $_POST['confirmnewpassword'];
    $confirmnewpassword = md5($confirmnewpassword); 
    $result = mysql_query("SELECT count(*) FROM users WHERE username='$username'");
    if(mysql_result($result,0)==1) //there must be one combination of user/pass
    {
        if($newpassword==$confirmnewpassword) 
        {
            $sql=mysql_query("UPDATE users SET password='$newpassword' WHERE username='$username' AND password='$password'"); 
            if($sql) 
            { 
                echo "You have successuflly changed your password!"; 
            }
        }
        else
        { 
            echo "Your new password must match with the confirm password field"; 
        }   
    }
    else
    { 
        echo "You have entered a wrong username or password"; 
    } 
    ?>
    <form action="changepassword.php" method="post">
    <div id="border">
    <table cellpadding="2" cellspacing="0" border="0">
        <tr>
            <td align="center" colspan="2">Change your password by entering the necessary information below:</td>
        </tr>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="username" /></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="password" /></td>
        </tr>
        <tr>
            <td>New Password:</td>
            <td><input type="password" name="newpassword" /></td>
        </tr>
        <tr>
            <td>Confirm New Password:</td>
            <td><input type="password" name="confirmnewpassword" /></td>
        </tr>
        <tr>
            <td align="center" colspan="2"><input type="submit" name="submit" value="Submit" /></td>
        </tr>
    </table>
    </div>
    </form>
        </body>
    </html>
