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

    $query = "select name from users where user_email='" . $uname . "'";
    $query2 = "SELECT user_id from users WHERE user_type='Owner' AND user_email='" . $uname . "'";
    $result2 = mysqli_query($con, $query2);
    foreach ($result2 as $row2) {
        $u_id = $row2["user_id"];
    }
    $result = mysqli_query($con, $query);

    ?>


    <!DOCTYPE html>
    <html lang="en">

    <head>

        <link rel="stylesheet" href="css/ownerhome.css">
        <link rel="icon" href="images/abashon_logo.png">
        <title>Abashon</title>
    </head>

    <body>

        <nav class="nav" id="nav">
            <a href="ownerpage.php"><img class="nav-logo" id="nav-logo" src="images/abashon_logo.png" alt="logo"></a>
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
                        <a href="ownerpage.php">Home</a><br>
                        <a href="#map">Your Homes</a><br>
                        <a href="houseadd.php">Add House</a><br>
                        <!-- <a href="">Account info</a> -->
                    </div>
                </div>
            </div>
        </nav>
        <div class="topdiv">
            <div class="maindiv">
                <div class="upperdiv">
                    <div class="round1">
                        <h1 class="maintext">
                            <t style="color: orange;">Hey</t> <u><?php foreach ($result as $row) {
                                                                        printf("%s", $row["name"]);
                                                                    }; ?></u><br> this is your
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
        </div>

        <div class="yourhomes" id="yourhomes">
            <div class="homestitle">
                <div class="homestitletop" id="map">
                </div>
                <div class="homestitlebottom">
                    <h1 style="font-weight: 150;">Your Homes in</h1>
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
                    $sql = "Select block, road, number, floor, room_count, availability from house where owner_id='$u_id';";
                    $result = $con->query($sql);

                    if ($result->num_rows > 0) {

                        foreach ($result as $row) {
                            echo "<tr>&nbsp;<td>&nbsp;<t style='font-weight:900;'>Block </t>" . $row["block"] . "&nbsp;</td>&nbsp;<td>&nbsp;<t style='font-weight:900;'>Road </t>" . $row["road"] . "&nbsp;</td>&nbsp;<td>&nbsp;<t style='font-weight:900;'>House </t>" . $row["number"] . "&nbsp;</td>&nbsp;<td>&nbsp;<t style='font-weight:900;'>Floor </t>" . $row["floor"] . "&nbsp;</td>&nbsp;<td>&nbsp;<t style='font-weight:900;'>Bed rooms </t>" . $row["room_count"] . "&nbsp;</td></tr>";
                        }
                    } else {
                        echo "<tr><td><h1 style='font-family: Montserrat;'>You haven't added any houses</h1></td></tr>";
                    }
                    ?>

                </table>
            </div>

        </div>

        <script>
            function initMap() {
                // Map options
                var options = {
                    zoom: 15,
                    center: {
                        lat: 23.8195825,
                        lng: 90.4368458
                    }
                }

                // New map
                var map = new google.maps.Map(document.getElementById('map'), options);

                // Listen for click on map
                google.maps.event.addListener(map, 'click', function(event) {
                    // Add marker
                    addMarker({
                        coords: event.latLng
                    });
                });


                //Resize icon pulled from web
                var icon = {
                    url: "https://icons.iconarchive.com/icons/paomedia/small-n-flat/512/house-icon.png", // url
                    scaledSize: new google.maps.Size(30, 30), // scaled size
                    origin: new google.maps.Point(0, 0), // origin
                    anchor: new google.maps.Point(0, 0) // anchor
                };

                // Add marker
                var marker = new google.maps.Marker({
                    position: {
                        lat: 23.8195825,
                        lng: 90.4368458
                    },
                    map: map,
                    icon: icon
                });

                var infoWindow = new google.maps.InfoWindow({
                    content: '<h1>Abashon</h1>'
                });

                marker.addListener('click', function() {
                    infoWindow.open(map, marker);
                });


                // Array of markers
                /*var markers = [
                  {
                    coords:{lat:42.4668,lng:-70.9495},
                    iconImage:'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
                    content:'<h1>Abashon</h1>'
                  },
                  {
                    coords:{lat:42.8584,lng:-70.9300},
                    content:'<h1>Amesbury MA</h1>'
                  },
                  {
                    coords:{lat:42.7762,lng:-71.0773}
                  }
                ];*/

                // Loop through markers
                for (var i = 0; i < markers.length; i++) {
                    // Add marker
                    addMarker(markers[i]);
                }

                // Add Marker Function
                function addMarker(props) {
                    var marker = new google.maps.Marker({
                        position: props.coords,
                        map: map,
                        //icon:props.iconImage
                    });

                    // Check for customicon
                    if (props.iconImage) {
                        // Set icon image
                        marker.setIcon(props.iconImage);
                    }

                    // Check content
                    if (props.content) {
                        var infoWindow = new google.maps.InfoWindow({
                            content: props.content
                        });

                        marker.addListener('click', function() {
                            infoWindow.open(map, marker);
                        });
                    }
                }


                //Current location






            }
        </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBB05zfqieA-MHmYZ8L7gVVVvV_jmOwPCg&callback=initMap">
        </script>
        <script src="js/home.js"></script>
    </body>

    </html>