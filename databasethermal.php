<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: Content-Type');
header("Content-type: application/json");



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "skill";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$OUTPUT=["status"=>false, "value"=>"Unknown Error!"];


$sql = "SELECT * FROM jsondata 
        where device_type='thermal' 
        ORDER BY timestamp DESC 
        LIMIT 6";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

    $arr=["time" => $row['timestamp'], "data"=>$row['sensor_data']];

    $series_array[] = $arr;
  }
  $OUTPUT=["status"=>true, "value"=>$series_array];

} else {
  $OUTPUT=["status"=>false, "value"=>"0 Result Avalable!"];

}

print_r(json_encode($OUTPUT));

$conn->close();
?>