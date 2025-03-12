<?php
session_start();
if(isset($_SESSION["password"]) && isset($_SESSION["name"]) && isset($_SESSION["id"]) && isset($_SESSION["admin"])){
    $conn = mysqli_connect("localhost", "root", "", "fejsbuk");
    $sql = "SELECT `id`, `name`, `admin` FROM `users` WHERE `name` = '".$_SESSION["name"]."' AND `password` = '".sha1($_SESSION["password"])."'";
    $result = mysqli_fetch_array(mysqli_query($conn, $sql));
    mysqli_close($conn);
    if(!$result){
        header("location: index.php");
    }
}else{
    header("location: index.php");
}      

if(isset($_POST['logout'])){
    session_destroy();
    header('location: index.php');
} 
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Fejsbuk</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div id="head">
    <div style="float: left;">
        <h1>FaceBuk</h1>
    </div>
    <div style="float: right; margin-top: 10px;">
        <form method="post">
            <button name="logout" class="form_button">Wyloguj</button>
        </form>
        <?php
        if($_SESSION["admin"]){
            //echo "<form method=\"post\">";
            echo "<button id=\"adminButton\" class=\"form_button\">Admin</button>";
            //echo "</form>";
        }
        ?>
    </div>
</div>

<div id="body">
    <button class="add-window-btn" id="addWindowBtn">Dodaj Okno</button>
</div>

<script src="windowScript.js"></script>
</body>
</html>
