
<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="css/home.css">
    <link rel="icon" href="images/abashon_logo.png">
    <title>Abashon</title>
</head>

<body>
    <?php
include "config.php";

// Check user login or not
if(!isset($_SESSION['uname'])){
    header('Location: index.php');
}

// logout
if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location: index.php');
}

$uname=$_SESSION['uname'];

$sql_query="select name as $name from users where user_email='".$uname."'";
$result = mysqli_query($con,$sql_query);
$row = mysqli_fetch_array($result);

?>
    <nav class="nav" id="nav">
        <a href="index.php"><img class="nav-logo" id="nav-logo" src="images/abashon_logo.png" alt="logo"></a>
        <div class="nav-right"><a href="home.html"><button class="loginbutton" name="but_logout">Log Out</button></a>
            <div class="hamburger">
                <div class="line1" id="line1"></div>
                <div class="line2" id="line2"></div>
                <div class="line3" id="line3"></div>
            </div>
            <div class="menu-overlay">
                <div class="nav-links">
                    <a href="">About Us</a><br>
                    <a href="">Our Homes</a><br>
                    <a href="">Become a Host</a><br>
                    <a href="">Contact Us</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="maindiv">
        <div class="upperdiv">
            <div class="round1">
                <h1 class="maintext">
                    <t style="color: orange;">Hey</t> <u><?php echo '$name';?></u><br> this is your
                    <t style="color: orange;">user panel</t>
                </h1>
            </div>
            <div class="round2">

            </div>
        </div>
    </div>
    <div class="searchbox" id="ownerbox">
        <h1><a href="houseadd.php" style="color: black;text-align: center;"><u>Add House</u></a></h1>
    </div>
    <div class="ourhomes" id="ourhomes">
        <div class="homestitle">
            <div class="homestitletop">
            </div>
            <div class="homestitlebottom">
                <h1 style="font-weight: 150;">Our Homes in</h1>
                <h1><u>Bashundhara</u></h1>
            </div>
        </div>
        <div class="homesdes">
            <table>
                <?php

                $host = "localhost"; /* Host name */
                $user = "root"; /* User */
                $password = ""; /* Password */
                $dbname = "abashon"; /* Database name */

                $con = mysqli_connect($host, $user, $password, $dbname);

                // Check connection
                if (!$con) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                $sql = "Select block, road, number, floor, room_count, availability from house";
                $result = $con->query($sql);

                if($result-> num_rows>0){

                    for($i=0; $i<4; $i++){
                        $row= $result->fetch_assoc();
                        if($row["availability"]=="Yes"){
                        echo "<tr>&nbsp;<td>&nbsp;<t style='font-weight:900;'>Block </t>".$row["block"]."&nbsp;</td>&nbsp;<td>&nbsp;<t style='font-weight:900;'>Road </t>".$row["road"]."&nbsp;</td>&nbsp;<td>&nbsp;<t style='font-weight:900;'>House </t>".$row["number"]."&nbsp;</td>&nbsp;<td>&nbsp;<t style='font-weight:900;'>Floor </t>".$row["floor"]."&nbsp;</td>&nbsp;<td>&nbsp;<t style='font-weight:900;'>Bed rooms </t>".$row["room_count"]."&nbsp;</td></tr>";
                    }}
                }
                else{
                    echo"<h1 style='font-family: Montserrat;'>No Result</h1>";
                }
                ?>

            </table>
        </div>

    </div>

    <script src="js/home.js"></script>
</body>

</html>