<?php
    include "config.php";
    
    //if session on
    if(isset($_SESSION['uname'])){
    header('Location: ownerpage.php');
}
    
    $passErr = "";


    if(isset($_POST['but_submit'])){
    
        $uname = mysqli_real_escape_string($con,$_POST['txt_uname']);
        $password = mysqli_real_escape_string($con,$_POST['txt_pwd']);
    
        if ($uname != "" && $password != ""){
    
            $sql_query = "select count(*) as cntUser from users where user_email='".$uname."' and password='".md5($password)."'";
            $result = mysqli_query($con,$sql_query);
            $row = mysqli_fetch_array($result);
    
            $count = $row['cntUser'];
    
            if($count > 0){
                $_SESSION['uname'] = $uname;
                header('Location: ownerpage.php');
            }else{
                $passErr = "Email/password invalid!";
            }
        }
    }
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign In</title>
    <link rel="stylesheet" href="css/signup.css">
    <link rel="icon" href="images/abashon_logo.png">
</head>

<body>

    <div class="main">
        <nav class="nav" id="nav">
            <a href="index.php"><img class="nav-logo" id="nav-logo" src="images/abashon_logo.png" alt="logo"></a>
            <div class="nav-right">
                <!-- <button class="loginbutton">Sign in</button> -->
                <div class="hamburger">
                    <div class="line1" id="line1"></div>
                    <div class="line2" id="line2"></div>
                    <div class="line3" id="line3"></div>
                </div>
                <div class="menu-overlay">
                    <div class="nav-links">
                        <a href="index.php">Home</a><br>
                        <!-- <a href="">About Us</a><br> -->
                        <!-- <a href="">Our Homes</a><br> -->
                        <!-- <a href="">Become a Host</a><br> -->
                        <a href="">Contact Us</a>
                    </div>
                </div>
            </div>
        </nav>



        <div class="content">
            <div class="content_left">
                <h1 style="font-family: 'Montserrat'; color: #ffbf5f;">Abashon <br><span> is your virtual</span>
                    <br>helping hand</h1>

                <br>
                <br>
                <button class="cn"><a href="signup1.php">Sign Up</a>
                  </form></button>
            </div>
            <div class="form">
                <h2>Login</h2>
                <form action="" method="post">
                  <input type="email" name="txt_uname" placeholder="Enter Email Here">
                <input type="password" name="txt_pwd" placeholder="Enter Password Here">
                <span style="font-size: 15px; color: yellow;"><?php echo $passErr;?></span>
                <input type="submit" value="Login" name="but_submit" class="btnn">
            </form> 

                <p class="link">Don't have an account<br>
                    <a href="signup1.php">Sign up </a> here</a>
                </p>
                <p class="liw">Log in with</p>

                <div class="icons">
                    <a href="">
                        <ion-icon name="logo-facebook"></ion-icon>
                    </a>
                    <a href="">
                        <ion-icon name="logo-instagram"></ion-icon>
                    </a>
                    <a href="">
                        <ion-icon name="logo-twitter"></ion-icon>
                    </a>
                    <a href="">
                        <ion-icon name="logo-google"></ion-icon>
                    </a>
                    <a href="">
                        <ion-icon name="logo-skype"></ion-icon>
                    </a>
                </div>

            </div>
        </div>
    </div>
    </div>
    </div>
    <script src="js/home.js"></script>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js">
    </script>

</body>

</html>