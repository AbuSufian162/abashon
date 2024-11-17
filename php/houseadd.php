<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$db_name = "abashon";
// Create connection 
$conn = mysqli_connect($servername, $username, $password, $db_name); 

$block = $_POST['block'];
$road = $_POST['road'];
$house = $_POST['house'];
$floor = $_POST['floor'];
$nbedroom = $_POST['nbedroom'];
$nbeds = $_POST['nbeds'];
$nwash = $_POST['nwash'];
$gen = $_POST['yesg'];
$elevator= $_POST['yese'];
$date= date('d/m/Y');
$img= $_POST['img'];

$sql = "INSERT INTO house (block, road, number, floor, room_count, availability, owner_id, date_posted, date_booked, washroom_count, bed_count, rent_type, generator, lift, image_link) 
VALUES('$block', '$road', '$house', '$floor', '$nbedroom', '', '', '$date', '', '$nwash', '$nbeds', '', '$gen', '$elevator', '$img' )"; 

if (mysqli_query($conn, $sql)) { 
    echo "<script>alert('House Enlisted')</script>"; 
    header("Location: ../houseadd.html");
    exit();
} else { 
    echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
} 




?>