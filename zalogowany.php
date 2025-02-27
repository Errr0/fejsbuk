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

    if(isset($_POST['delete'])){
        $sql = "DELETE FROM `servers` WHERE `servers`.`id` = ".$_POST['delete'];
        mysqli_query($conn, $sql);
    }
    if(isset($_POST['join'])){
        $sql = "SELECT `id`, `name`, `creator` FROM `servers` WHERE `id` = ".$_POST['join'];
        $result = mysqli_fetch_array(mysqli_query($conn, $sql));
        $_SESSION['lobby_id'] = $result['id'];
        $_SESSION['lobby_name'] = $result['name'];
        $_SESSION['creator'] = $result['creator']; 
        header('location: lobby.php');
    }
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
            <form action="opcje.php" method="post">
                <button name="opcje">Opcje</button>
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
        <h2>Stwórz</h2>
        <form method="post">
            <input type="text" name="nazwa" placeholder="nazwa"><br/>
            <input type="text" name="kod_dostepu" placeholder="kod_dostępu"><br/>
            <button>Stwórz</button>
        </form>
        <?php
        if(isset($_POST['nazwa']) && $_POST['nazwa']!= ""){
            $sql = "SELECT `name` FROM `servers` WHERE `name` = '".$_POST['nazwa']."'";
            $result = mysqli_fetch_array(mysqli_query($conn, $sql));
            if($result){
                echo "nazwa zajęta";
            } else {
                $sql = "INSERT INTO `servers` (`id`, `name`, `join_code`, `creator`) VALUES (NULL, '".$_POST['nazwa']."', '".$_POST['kod_dostepu']."', '".$_SESSION['name']."')";
                mysqli_query($conn, $sql);
                echo $sql;
            }
        } 
        ?>
        <h2>Dołącz</h2>
        <form method="post">
            <input type="text" name="name" placeholder="nazwa"><br/>
            <input type="text" name="dolacz" placeholder="kod_dostępu"><br/>
            <button>Dołącz</button>
        </form>
        <?php
        if(isset($_POST['dolacz'])){
            $sql = "SELECT `id`, `name`, `creator` FROM `servers` WHERE `join_code` = ".$_POST['dolacz'];
            $result = mysqli_fetch_array(mysqli_query($conn, $sql));
            $_SESSION['lobby_id'] = $result['id'];
            $_SESSION['lobby_name'] = $result['name'];
            $_SESSION['creator'] = $result['creator']; 
            header('location: lobby.php');
        }
        ?>

        <div style="width: 100%;">
            <form method="post">
            <table style="width: 100%;">
                <tr>
                <th>ID</th>
                <th>Nazwa</th>
                <th>Twórca</th>
                <th>Dołącz</th>
                </tr>
            <?php
                $sql = "SELECT `id`, `name`, `creator` FROM `servers` WHERE `join_code` = ''";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>";
                    echo $row['id'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['name'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['creator'];
                    echo "</td>";
                    echo "<td>";
                    echo "<button name=\"join\" value=\"".$row['id']."\">Dołącz</button>";
                    if($row['creator'] == $_SESSION['name'] || $_SESSION['admin']){
                        echo "<button name=\"delete\" value=\"".$row['id']."\">Usuń</button>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            ?>
            </table>
            </form>
        </div>
    </div>
    <div id="footer">
        <p>by AN</p>
    </div>
</body>
</html>

