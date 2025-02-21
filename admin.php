<?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header('location: index.php');
    }
    if(isset($_POST['wyloguj'])){
        session_destroy();
        header('location: index.php');
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
            <form action="zalogowany.php" method="post">
                <button name="cofnij">Cofnij</button>
            </form>
        </div>
    </div>
    <div id="content">
        <div style="float: left;">
        <form method="post">
            <input type="text", name="login", placeholder="szukaj">
            <button name="szukaj">Szukaj</button>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Login</th>
                    <th>Haslo</th>
                    <th>Pokarz haslo</th>
                    <th>Admin</th>
                    <th>Opcje</th>
                </tr>
            <?php
            // <th></th>
                $conn = mysqli_connect("localhost", "root", "", "fejsbuk");
                $sql = "SELECT `id`, `name`, `password`, `admin` FROM `users`".(isset($_POST['szukaj']) && $_POST['login']!="" ? "WHERE `name` = '".$_POST['login']."'" : "");// WHERE `name` = '".$_POST['login']."'";// AND `password` = '".sha1($_POST['haslo'])."'";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    //echo "";
                    echo "<td>";
                        echo $row[0];
                    echo "</td>";
                    echo "<td>";
                        echo $row[1];
                    echo "</td>";
                    echo "<td>";
                    if(isset($_POST['show']) && $row[0] == $_POST['show']){
                        echo openssl_decrypt($row[2], "AES-128-ECB", $row[1]."maslohaslo");
                    } else{
                        echo "hasło ukryte";
                    }
                    echo "</td>";
                    echo "<td>";
                    if(isset($_POST['show']) && $row[0] == $_POST['show']){
                        echo "<button name=\"hide\" value=\"$row[0]\">ukryj hasło</button>";
                    } else{
                        echo "<button name=\"show\" value=\"$row[0]\">Pokarz hasło</button>";
                    }
                    echo "</td>";
                    echo "<td>";
                        echo $row[3] ? "tak" : "nie";//"<input type=\"checkbox\" checked disabled>";
                    echo "</td>";
                    echo "<td>";
                        echo "<button name=\"edit\" value=\"$row[0]\">Edytuj</button>";
                        echo "<button name=\"delete\" value=\"$row[0]\">Usuń</button>";
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