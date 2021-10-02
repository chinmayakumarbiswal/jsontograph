<?php
 $page = $_SERVER['PHP_SELF'];
 $sec = "2";
 header("Refresh: $sec; url=$page");



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "skill";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$filename = "https://sandbox.ethnustech.com/sensordata/buffer.json";

$data = file_get_contents($filename);

$array = json_decode($data,true);

foreach($array as $value) 
{
    if($value['device_type'] == "gps")
    {
        $data1=$value['device_type'];
        $data2=$value['timestamp'];
        $data3=$value['device_id'];
        $data4=$value['data_size'];
        $data5=implode(" , ",$value['sensor_data']);//convert array to string and then import to database

        $query = "INSERT INTO `jsondata` (`device_type`, `timestamp`, `device_id`, `data_size`, `sensor_data`) VALUES ('$data1', '$data2', '$data3', '$data4', '$data5')";
        mysqli_query($conn,$query);
        
    }
    else
    {
        $data1=$value['device_type'];
        $data2=$value['timestamp'];
        $data3=$value['device_id'];
        $data4=$value['data_size'];
        $data5=$value['sensor_data'];

        
        $query = "INSERT INTO `jsondata` (`device_type`, `timestamp`, `device_id`, `data_size`, `sensor_data`) VALUES ('$data1', '$data2', '$data3', '$data4', '$data5')";
        mysqli_query($conn,$query);
        
    }
    
}
?>