<?php
session_start();
header('Content-Type: application/json');

$inputData = json_decode(file_get_contents('php://input'), true);

if (isset($inputData['getProfileData'])) {
    $conn = mysqli_connect("localhost", "root", "", "fejsbuk");
    $sql = "SELECT `name`, `admin` FROM `users` WHERE `id` = '".$_SESSION['id']."'";
    $result = mysqli_fetch_array(mysqli_query($conn, $sql));
    mysqli_close($conn);
    $output = ["name" => $result['name']];
    echo json_encode($output);
} else if (isset($inputData['deleteAccount'])) {
    $conn = mysqli_connect("localhost", "root", "", "fejsbuk");
    $sql = "DELETE FROM `users` WHERE `id` = ".$_SESSION['id'];
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $output = ["output" => "User deleted successfully"];
    } else {
        $output = ["output" => "Error deleting user: " . mysqli_error($conn)];
    }
    mysqli_close($conn);
    echo json_encode($output);
} else if (isset($inputData['get_data'])) {
    $output = ["output" => "1"];
    echo json_encode($output);
} else if (isset($inputData['send_data'])) {
    $output = ["output" => "0"];
    echo json_encode($output);
} else {
    $output = ["output" => "No input provided."];
    echo json_encode($output);
}
?> 