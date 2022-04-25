<?php
    session_start();
    if($_SESSION['loggedin']!=true){
      header("location: login.php");
      exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <link rel='stylesheet' href='style.css'>
</head>
<body>
    <?php
        echo 'hello '.$_SESSION['username'].' !!!';
    ?>
    <a href="logout.php">Log Out</a>
</body>
</html>