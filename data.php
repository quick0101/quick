<?php
header('Content-Type: application/json');
$con = mysqli_connect("localhost", "root", "", "bd_quick");
if (mysqli_connect_errno($con)) {
    echo "Failed to connect to DataBase: " . mysqli_connect_error();
} else {
    $data_points = array();
    $result = mysqli_query($con, "SELECT * FROM plot_values"); 
    while ($row = mysqli_fetch_array($result)) {
        $point = array("valorx" => $row['x'], "valory" => $row['y']);
        array_push($data_points, $point);
    }
    echo json_encode($data_points);
}
mysqli_close($con);
?>