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
if(isset($_POST['changePassword'])){
    if($_POST['password'] == $_POST['password2']){
        $conn = mysqli_connect("localhost", "root", "", "fejsbuk");
        $sql = "UPDATE `users` SET `password` = '".sha1($_POST['password'])."' WHERE `id` = ".$_SESSION['id'];
        $result = mysqli_query($conn, $sql);
        header("location: index.php");
    }
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
        <table>
            <tr>
                <td>
                    <?php
                    if($_SESSION["admin"]){
                        echo "<button id=\"adminButton\" class=\"form_button\">Admin</button>";
                    }
                    ?>
                    <!-- <button id="" class="form_button"></button> -->
                </td>
                <td>
                    <!-- <button id="friendsButton" class="form_button">Znajomi</button> -->
                </td>
                <td>
                <form method="post">
                    <button name="logout" class="form_button">Wyloguj</button>
                </form>
                </td>
            </tr>
            <tr>
                <td>
                    <!-- <button id="" class="form_button"></button> -->
                    <?php
                    // if($_SESSION["admin"]){
                    //     echo "<button id=\"adminButton\" class=\"form_button\">Admin</button>";
                    // }
                    ?>
                </td>
                <td>
                    <?php
                    // if($_SESSION["admin"]){
                    //     echo "<button id=\"adminButton\" class=\"form_button\">Admin</button>";
                    // }
                    ?>
                    <!-- <button id="profileButton" class="form_button">Profil</button> -->
                </td>
                <td>
                    <button id="profileButton" class="form_button">Profil</button>
                    <!-- <button id="optionsButton" class="form_button">Opcje</button> -->
                </td>
            </tr>
        </table>
        
        
    </div>
</div>

<div id="body">
</div>
<script src="script.js"></script>
<script src="createWindow.js"></script>
<script src="createContents.js"></script>
<script src="windows.js"></script>
</body>
</html>
