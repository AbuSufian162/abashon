<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="css/searchres.css">
    <link rel="icon" href="images/abashon_logo.png">
    <title>Abashon</title>
</head>

<body>
    <nav class="nav" id="nav">
        <a href="index.php"><img class="nav-logo" id="nav-logo" src="images/abashon_logo.png" alt="logo"></a>
        <div class="nav-right"><a href="signup.php"><button class="loginbutton">Sign in</button></a>
            <div class="hamburger">
                <div class="line1" id="line1"></div>
                <div class="line2" id="line2"></div>
                <div class="line3" id="line3"></div>
            </div>
            <div class="menu-overlay">
                <div class="nav-links">
                    <!-- <a href="">About Us</a><br> -->
                    <a href="index.php">Home</a><br>
                    <a href="signup.php">Become a Host</a><br>
                    <a href="">Contact Us</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="addfilter" id="addfilter">
        <div class="addfunc">
            <div class="addfunctop">
                <svg id="closebutn" viewPort="0 0 12 12" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <line x1="1" y1="11" x2="11" y2="1" stroke="black" stroke-width="2" />
                    <line x1="1" y1="1" x2="11" y2="11" stroke="black" stroke-width="2" />
                </svg>
            </div>
            <table>
                <tr>
                    <td style="font-family:'Montserrat';">
                        <h1>Generator:&nbsp;&nbsp;</h1>
                    </td>
                    <td style="font-family:'Montserrat';">
                        <h1><input type="radio" name="gen" value="Yes">&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="gen" value="No">&nbsp;No</h1>
                    </td>
                </tr>

                <tr>
                    <td style="font-family:'Montserrat';">
                        <h1>Lift:&nbsp;&nbsp;</h1>
                    </td>
                    <td style="font-family:'Montserrat';">
                        <h1><input type="radio" name="lift" value="Yes">&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="lift" value="No">&nbsp;No</h1>
                    </td>
                </tr>
                <tr>
                    <td style="font-family:'Montserrat';">
                        <h1>Rent:&nbsp;&nbsp;</h1>
                    </td>
                    <td style="font-family:'Montserrat';">
                        <h5>5000<input type="range" list="tickmarks"><datalist id="tickmarks">
                                <option value="5000"></option>
                                <option value="10000"></option>
                                <option value="20000"></option>
                                <option value="30000"></option>
                                <option value="40000"></option>
                                <option value="50000"></option>
                            </datalist>50000</h5>
                    </td>
                </tr>
                <tr>
                    <td>

                    </td>
                    <td><button type="button" value="done">Done</button></td>

                </tr>
            </table>
            <!-- <h1 style="font-family:'Montserrat';">Lift: &nbsp;&nbsp;&nbsp;<input type="radio" name="lift" value="Yes">&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="lift" value="No">&nbsp;No</h1> -->
        </div>
    </div>
    <div class="topdiv">
        <div class="maindiv">
            <div class="upperdiv">
                <div class="round1">
                    <h1 class="maintext">
                        <t style="color: orange;">Find</t> a suitable <br><u>home</u> for a<br>
                        <t style="color: orange;">comfortable stay</t>
                    </h1>
                </div>
                <div class="round2">

                </div>
            </div>
        </div>
        <div class="searchbox">
            <div class="textsearchbox">
                <h1>Look for a listing in your desired area</h1>
            </div>
            <!-- <div id="ownerpage" action="searchresult.php" method="post"> -->
            <div class="inputsearch">
                <h1 style="color: #2B2B4D;">Which Block?</h1>
                <input type="text" placeholder="eg. J " name="block">
                <h2 style="color: #003366; cursor: pointer;" id="filteradd"><u>+Add filter</u></h2>

            </div>
            <div class="searchbutton" type="submit" method="post" action="searchresult.php">
                <h1>Search</h1>
            </div>

        </div>
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