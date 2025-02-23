<?php
    session_start();
    if(!isset($_SESSION['name'])){
        header('location: index.php');
    }
    if(isset($_POST['wyloguj'])){
        session_destroy();
        header('location: index.php');
    } 
    $conn = mysqli_connect("localhost", "root", "", "fejsbuk");
    $sql = "SELECT `id` FROM `users` WHERE `id` = 0";
    if(isset($_POST['edit_name'])){//add checking if login is used
        $sql = "UPDATE `users` SET `name` = '".$_POST['value']."' WHERE `id` = ".$_SESSION['id'];
    }
    if(isset($_POST['edit_password'])){
        $sql = "UPDATE `users` SET `password` = '".sha1($_POST['value'])."' WHERE `id` = ".$_SESSION['id'];
    }
    if(isset($_POST['delete2'])){
        $sql = "DELETE FROM `users` WHERE `id` = ".$_SESSION['id'];
        header('location: index.php');
    }
    mysqli_query($conn, $sql)
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>FejsBuk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="banner">
        <div style="float: left;">
            <h1>FejsBuk</h1>
        </div>
        <div style="float: right;">
            <form method="post">
                <button name="wyloguj">Wyloguj</button>
            </form>
            <form action="zalogowany.php" method="post">
                <button name="cofnij">Cofnij</button>
            </form>
            <?php
                if($_SESSION['admin']){
                    echo "<form action=\"admin.php\" method=\"post\">";
                    echo "<button name=\"admin\">Admin</button>";
                    echo "</form>";
                }
            ?>
        </div>
    </div>
    <div id="content">
        <form method="post">
        <h2>Opcje</h2><br/>
        <?php
            $sql = "SELECT `id`, `name`, `admin` FROM `users` WHERE `id` = '".$_SESSION['id']."'";
            $row = mysqli_fetch_array(mysqli_query($conn, $sql));
            echo "<b>ID </b>";
            echo $row[0];
            echo "<br/>";
            
            echo "<b>Login </b>";
            echo $row[1];
            echo "<br/>";
            
            echo "<b>Admin </b>";
            echo $row[2] ? "tak" : "nie";
            echo "<br/>";

            if(isset($_POST['edit']) && $_POST['edit'] == "name"){
                echo "<input type=\"text\" name=\"value\">";
                echo "<button name='edit_name'>Potwierdź</button>";
            } else{
                echo "<button name='edit' value='name'>Edytuj login</button> ";
            }
            echo "<br/>";

            if(isset($_POST['edit']) && $_POST['edit'] == "password"){
                echo "<input type=\"text\" name=\"value\">";
                echo "<button name='edit_password'>Potwierdź</button>";
            } else{
                echo "<button name='edit' value='password'>Edytuj hasło</button> ";
            }
            echo "<br/>";
            if(isset($_POST['delete'])){
                echo "<button name='delete2'>Potwierdź</button>";
            } else{
                echo "<button name='delete'>Usuń konto</button>";
            }
            mysqli_close($conn);
        ?>
        <!-- <input type="text" name=""> -->
        </form>
    </div>
    <div id="footer">
        <p>by AN</p>
    </div>
</body>
</html>