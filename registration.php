<?php
    require_once 'connection.php';
    $passErr=$nameErr=$rErr=false;
    $name=$email=$pass=$cpass="";
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
        if (empty($_POST['email'])) {
            $rErr = true;
        } else {
            $email = test_input($_POST["email"]);
        }
        if (empty($_POST['password'])) {
            $rErr = true;
        } else {
            $pass = test_input($_POST["password"]);
        }
        if (empty($_POST['cpassword'])) {
            $rErr = true;
        } else {
            $cpass = test_input($_POST["cpassword"]);
        }
        $sql = "SELECT * from users where name ='$name'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if($num == 1){
            $nameErr=true;
        }
        else if($pass!=$cpass){
            $passErr=true;
        }
        else{
            if(!$rErr){
                $pass = md5($pass);
                $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$pass')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    session_start();
                    header('location:login.php');
                }else{
                    echo "the record was not submited due to..".mysqli_error($conn);
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign In</title>
    <link rel='stylesheet' href='style.css'>
</head>
<body>
    <div class="login-body">
        <?php
            if($passErr){
                echo 'Both password does not match !!!';
            }
            if($nameErr){
                echo 'Username not available !!!';
            }
            if($rErr){
                echo '* All details required !! *';
            }
        ?>
    <div>
        <div class="main-cont">
            <form method="POST">
                <input type="text" placeholder="Username" name="username" class="input-login">
                <input type="text" placeholder="Email" name="email" class="input-login">
                <input type="password" placeholder="Password" name="password" class="input-login">
                <input type="password" placeholder="Confirm Password" name="cpassword" class="input-login">
                <button type="submit" class="login-btn">Sign In</button>
            </form>
        </div>
        <h4>Already a User? <a href="login.php">LOG IN</a></h4>
    </div>
    </div>
</body>
</html>