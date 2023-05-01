<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="form">
        <p>Hey, <?php echo $_SESSION['username']; ?>!</p>
        <p>Threat-Modeling-Assignment.</p>
        <?php
    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['submit'])) {
        // removes backslashes
        $comment = stripslashes($_REQUEST['comment']);
        //escapes special characters in a string
        $comment = mysqli_real_escape_string($con, $comment);
        $create_datetime = date("Y-m-d H:i:s");
        $username = $_SESSION['username'];
        
        $query    = "INSERT INTO `comments` (comment, create_datetime, username)
                     VALUES ('$comment',  '$create_datetime', $username)";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>Successfully.</h3><br/>
                  
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  
                  </div>";
        }
    } else {
?>
        <form class="form" method="post" name="login">
        <h1 class="login-title">Add a comment</h1>
        <textarea type="text" name="comment"></textarea>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link">Don't have an account? <a href="registration.php">Registration Now</a></p>
        </form>
   <?php
    }
   ?>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>
