    <?php
    include "config.php";


    // Check user login or not
    if (!isset($_SESSION['uname'])) {
        header('Location: index.php');
    }

    // logout
    if (isset($_POST['but_logout'])) {
        session_destroy();
        header('Location: index.php');
    }

    $uname = $_SESSION['uname'];



    // define variables and set to empty values
    $emptErr = $blockErr = $roadErr = $houseErr = $floorErr = $nbedsErr = $nwashErr = $genErr = $elevatorErr = $imgErr = $areaErr = "";
    $block = $road = $house = $floor = $room = $nbeds = $nwash = $gen = $elevator = $img = $area = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        $block = mysqli_real_escape_string($con, strtoupper($_POST['block']));
        $road = mysqli_real_escape_string($con, $_POST['road']);
        $house = mysqli_real_escape_string($con, $_POST['house']);
        $floor = mysqli_real_escape_string($con, $_POST['floor']);
        $room = mysqli_real_escape_string($con, $_POST['room_count']);
        $nbeds = mysqli_real_escape_string($con, $_POST['nbeds']);
        $nwash = mysqli_real_escape_string($con, $_POST['nwash']);
        $gen = mysqli_real_escape_string($con, $_POST['yesg']);
        $elevator = mysqli_real_escape_string($con, $_POST['yese']);
        $img = mysqli_real_escape_string($con, $_POST['img']);
        $area = mysqli_real_escape_string($con, $_POST['area']);


        //Getting id of the logged in user
        $query = "select user_id from users where user_email='" . $uname . "'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_row($result);
        $id = $row[0];


        if (empty($block) || empty($road) || empty($house) || empty($floor) || empty($room) || empty($nbeds) || empty($nwash) || empty($gen) || empty($elevator) || empty($img) || empty($area)) {
            $emptErr = "All the fields are required";
        } elseif (!preg_match('@^[A-N]{1}@', $block)) {
            $blockErr = "Enter correct block, between A-N";
        } elseif (!is_numeric($road)) {
            $roadErr = "Road number should be numeric";
        } elseif (!is_numeric($house)) {
            $houseErr = "House number should be numeric";
        } elseif (!is_numeric($floor)) {
            $floorErr = "Floor number should be numeric";
        } elseif (!is_numeric($room)) {
            $roomErr = "Room count should be numeric";
        } elseif (!is_numeric($nbeds)) {
            $nbedsErr = "House count should be numeric";
        } elseif (!is_numeric($nwash)) {
            $nwashErr = "Washroom count should be numeric";
        } elseif ($gen != "Yes" && $gen != "No") {
            $genErr = "Put a valid value";
        } elseif ($elevator != "Yes" && $elevator != "No") {
            $elevatorErr = "Put a valid value";
        } elseif (!preg_match('@(https?:\/\/.*\.(?:png|jpg))@', $img)) {
            $imgErr = "Enter 11 digit Bangladeshi mobile number!";
        } elseif (!is_numeric($area)) {
            $areaErr = "Enter a numeric value";
        } else {


            //This method prevents sql injection
            $stmt = $con->prepare("INSERT INTO house (owner_id, block, road, number, floor, room_count, washroom_count, bed_count, generator, lift, image_link, area) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssssssss", $id, $block, $road, $house, $floor, $room, $nwash, $nbeds, $gen, $elevator, $img, $area);

            if ($stmt->execute()) {
                header('Location: ownerpage.php');
            } else {
                echo "ERROR: Could not able to execute $sql_query. " . mysqli_error($con);
            }

            mysqli_close($con);
        }
    }

    ?>



    <!DOCTYPE html>
    <html>

    <head>
        <link rel="icon" href="images/abashon_logo.png">
        <title>Add House</title>
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;900&display=swap");
            @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;900&display=swap");
            /*---------------------------------------
     NAV              
  -----------------------------------------*/

            .nav {
                min-width: 100vw;
                height: 15vh;
                padding: 12px 4%;
                color: rgba(0, 0, 0, 0.575);
                position: fixed;
                top: 0;
                left: 0;
                right: 10px;
                z-index: 3;
                display: flex;
                align-items: center;
                justify-content: space-between;
                transition: all ease 0.5s;
                background-color: rgba(0, 0, 0, 0.596);
            }

            .nav-right {
                display: flex;
                gap: 80px;
                justify-content: center;
                align-items: center;
            }

            .nav-logo {
                height: 130px;
                position: relative;
                z-index: 5;
            }

            .loginbutton {
                width: 100px;
                height: 50px;
                background-color: white;
                border-radius: 5px;
                font-family: "Raleway";
                z-index: 5;
                font-size: 1.15em;
                font-weight: 600;
                color: black;
                box-shadow: 0%;
                border-color: transparent;
            }

            .loginbutton:hover {
                cursor: pointer;
                background-color: #f3115b;
                color: white;
            }

            .hamburger {
                cursor: pointer;
                position: relative;
                z-index: 5;
            }

            .line1,
            .line2,
            .line3 {
                width: 25px;
                height: 2px;
                background-color: white;
                margin: 5px 0;
                transition: all ease-in-out 0.7s;
            }

            .line1.morph {
                transform: rotate(45deg) translate(0, 10px);
                background-color: white;
            }

            .line2.morph {
                opacity: 0;
            }

            .line3.morph {
                transform: rotate(-45deg) translate(0, -10px);
                background-color: white;
            }

            .menu-overlay {
                height: 100vh;
                min-height: 500px;
                width: 100vw;
                visibility: hidden;
                position: fixed;
                top: 0;
                left: 100vw;
                z-index: 4;
                background-color: rgba(0, 0, 0, 0.95);
                transition: all ease-in-out 0.4s;
            }

            .menu-overlay.open {
                visibility: visible;
                transform: translateX(-100%);
            }

            .menu-overlay a:hover {
                color: #f3115b;
            }

            .nav-links {
                position: absolute;
                top: 50%;
                left: 95%;
                transform: translate(-95%, -50%);
                text-align: right;
                font-family: "Montserrat", sans-serif;
                width: fit-content;
            }

            .nav-links a {
                text-transform: uppercase;
                font-size: 2.4rem;
                font-weight: 800;
                line-height: 45px;
            }

            .upperdiv {
                background-image: url("../images/house2.jpg");
                height: 40vh;
                width: 100vw;
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;
                display: flex;
                justify-content: space-around;
                flex-direction: row;
                margin-bottom: 30px;
            }

            h1,
            h2,
            h3,
            h4 {
                font-family: 'Monsterrat', sans-serif;
            }

            table {
                width: 50vw;
                color: black;

            }

            td,
            tr {
                /* border-bottom: 1px solid #ddd; */
                width: 50vw;
                border-top: 2px solid grey;
                font-family: 'Montserrat';
                font-weight: 600;
            }



            .canvas {
                display: flex;
                /* height: 100vh; */
                padding: 0px 20px;
                justify-content: center;
                align-items: center;
                /* background-image: url('https://images.pexels.com/photos/7130560/pexels-photo-7130560.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260'); */
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                flex-direction: column;
            }

            .form {
                /* height: 50vh; */
                width: 60vw;
                padding: 15px 20px;
                /* border: 5px goldenrod solid; */
                background-color: rgba(250, 235, 215, 0.603);
                border-radius: 10px;
                color: #da0e29;
                box-shadow: #da0e29;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;

            }

            .ftop {
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                margin-bottom: 30px;
            }

            .form_boxes {
                display: flex;
                align-items: center;
                /* text-align:  */
                /* margin-left: 20px; */
                font-family: 'Montserrat';
                font-weight: 600;
            }

            .input_text {
                height: 30px;
                margin-left: 10px;
                font-family: 'Montserrat';
                font-weight: 600;
            }


            .submit_button {
                height: 40px;
                width: 100px;
            }
        </style>



    </head>

    <body>
        <nav class="nav" id="nav">
            <a href="home.php"><img class="nav-logo" id="nav-logo" src="images/abashon_logo.png" alt="logo"></a>
            <div class="nav-right">
                <form method='post' action="">
                    <input class="loginbutton" type="submit" value="Logout" name="but_logout">
                </form>
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
        <div class="canvas">

            <div class="upperdiv"></div>
            <!-- <img src="images/house.jpg" class="searchpic"alt=""> -->

            <form action="" class="form" method="post">
                <table>

                    <span style="font-size: 15px; color: red;"><?php echo $emptErr; ?></span>
                    <span style="font-size: 15px; color: red;"><?php echo $blockErr; ?></span>
                    <span style="font-size: 15px; color: red;"><?php echo $roadErr; ?></span>
                    <span style="font-size: 15px; color: red;"><?php echo $houseErr; ?></span>
                    <span style="font-size: 15px; color: red;"><?php echo $nbedsErr; ?></span> <span style="font-size: 15px; color: red;"><?php echo $nwashErr; ?></span>
                    <span style="font-size: 15px; color: red;"><?php echo $genErr; ?></span>
                    <span style="font-size: 15px; color: red;"><?php echo $elevatorErr; ?></span>
                    <span style="font-size: 15px; color: red;"><?php echo $imgErr; ?></span>
                    <span style="font-size: 15px; color: red;"><?php echo $areaErr; ?></span>



                    <tr class="tr">
                        <td>
                            <h2 class="form_boxes">Block (A-N)</h2>
                        </td>
                        <td>
                            <input type="text" class="input_text" placeholder="Block number" name="block">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2 class="form_boxes">Road</h2>
                        </td>
                        <td>
                            <input type="text" class="input_text" placeholder="Road number" name="road">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2 class="form_boxes">House Number</h2>
                        </td>
                        <td>
                            <input type="number" class="input_text" placeholder="House number" name="house">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2 class="form_boxes">Floor</h2>
                        </td>
                        <td>
                            <input type="number" class="input_text" placeholder="Floor number" name="floor">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2 class="form_boxes">Number of rooms</h2>
                        </td>
                        <td>
                            <input type="number" class="input_text" placeholder="Total room count" name="room_count">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2 class="form_boxes">Number of beds</h2>
                        </td>
                        <td>
                            <input type="number" class="input_text" placeholder="Number of bedrooms" name="nbeds">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2 class="form_boxes">Number of Washrooms</h2>
                        </td>
                        <td>
                            <input type="number" class="input_text" placeholder="Total washrooms" name="nwash">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2 class="form_boxes">Area in square feets</h2>
                        </td>
                        <td>
                            <input type="number" class="input_text" placeholder="Area of house in sft" name="area">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2 class="form_boxes">Generator Available</h2>
                        </td>
                        <td>
                            <h2 class="form_boxes">Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No</h2>

                            <h2 class="form_boxes"><input type="radio" class="input_text" name="yesg" id="gen" value="Yes" checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" class="input_text" placeholder="" name="yesg" id="gen" value="No"></h2>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2 class="form_boxes">Elevator Available</h2>
                        </td>
                        <td>
                            <h2 class="form_boxes">Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No</h2>

                            <h2 class="form_boxes"><input type="radio" class="input_text" name="yese" value="Yes" checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" class="input_text" placeholder="" name="yese" value="No"></h2>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2 class="form_boxes">Add image url: (<a href="https://postimages.org/" target="_blank">here</a>)</h2>
                        </td>
                        <td>
                            <input type="url" class="input_text" placeholder="Direct image url" name="img">
                        </td>
                    </tr>
                </table>

                <input type="submit" class="submit_button" name="but_submit" value="Enter">
            </form>
        </div>




    </body>

    </html>