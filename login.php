<?php
    require_once 'connection.php';
    $passErr=$nameErr=$rErr=false;
    $name=$pass="";
    $_SESSION['loggedin'] = false;
    if($_SERVER['REQUEST_METHOD']=='POST'){
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if (empty($_POST['username'])) {
            $rErr = true;
        } else {
            $name = test_input($_POST["username"]);
        }
        if (empty($_POST['password'])) {
            $rErr = true;
        } else {
            $pass = test_input($_POST["password"]);
        }
        $sql = "SELECT * from users where name='$name'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if($num != 1){
            $nameErr=true;
        }
        else{
            if(!$rErr){
                $sql = "SELECT * from users where name='$name' AND password='$pass'";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result);
                if($num == 1){
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $name;
                    header('location:index.php');
                }else{
                    $passErr=true;
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Log In</title>
    <link rel='stylesheet' href='style.css'>
</head>
<body>
<div class="login-body">
    <?php
        if($nameErr){
            echo 'Invalid Username !!!!';
        }
        if($passErr){
            echo 'Invalid Password!!!';
        }
        if($rErr){
            echo '* All fields required!! *';
        }
    ?>
    <div>
        <div class="main-cont">
            <form method="POST">
                <input type="text" placeholder="Username" name="username" class="input-login">
                <input type="password" placeholder="Password" name="password" class="input-login">
                <button type="submit" class="login-btn">Log In</button>
            </form>
        </div>
        <h3>Not a user yet? <a href="registration.php">Register Here</a></h3>
    </div>    
</div>
</body>
</html>