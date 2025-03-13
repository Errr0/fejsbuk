<?php
header('Content-Type: application/json');

$inputData = json_decode(file_get_contents('php://input'), true);

if (isset($inputData['get_data'])) {
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