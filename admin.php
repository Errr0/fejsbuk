<?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header('location: index.php');
    }
    if(isset($_POST['wyloguj'])){
        session_destroy();
        header('location: index.php');
    }
    $conn = mysqli_connect("localhost", "root", "", "fejsbuk");
    if(isset($_POST['login'])){
        echo "login: ".$_POST['login'];
        // session_destroy();
        $conn = mysqli_connect("localhost", "root", "", "fejsbuk");
        $sql = "SELECT `id`, `name`, `admin` FROM `users` WHERE `id` = ".$_POST['login'];
        $result = mysqli_fetch_array(mysqli_query($conn, $sql));
        if($result){
            mysqli_close($conn);
            session_start();
            $_SESSION["id"] = $result[0];
            $_SESSION["name"] = $result[1];
            $_SESSION["admin"] = $result[2];
            header("location: zalogowany.php");
        } else {
            echo "Błąd logowania";
        }
    }
    $sql = "DELETE FROM `users` WHERE `id` = 0";
    if(isset($_POST['edit_name'])){
        $sql = "UPDATE `users` SET `name` = '".$_POST['value']."' WHERE `id` = ".$_POST['edit_account'];
    }
    if(isset($_POST['edit_password'])){
        $sql = "UPDATE `users` SET `password` = '".sha1($_POST['value'])."' WHERE `id` = ".$_POST['edit_account'];
    }
    if(isset($_POST['delete2'])){
        $sql = "DELETE FROM `users` WHERE `id` = ".$_POST['edit_account'];
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
            <form action="opcje.php" method="post">
                <button name="opcje">Opcje</button>
            </form>
            <form action="zalogowany.php" method="post">
                <button name="cofnij">Cofnij</button>
            </form>
        </div>
    </div>
    <div id="content">
        <div style="float: left; width: 50%;">
        <form method="post">
            <label>Search by:
            <select id="searchBy" name="searchBy">
                <option value="name">Login</option>
                <option value="id">ID</option>
            </select>
            </label>
            <input type="text", name="login", placeholder="szukaj">
            Admin:
            <label> tak <input type="checkbox" id="adminCheck" name="adminCheck" value="1"></label>
            <label> nie <input type="checkbox" id="adminCheck" name="adminCheck" value="0"></label>
            <button name="szukaj">Szukaj</button>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Login</th>
                    <th>Admin</th>
                    <th>Opcje</th>
                </tr>
            <?php
            // <th></th>
                //$conn = mysqli_connect("localhost", "root", "", "fejsbuk");
                $sql = "SELECT `id`, `name`, `admin` FROM `users`".(isset($_POST['szukaj']) && $_POST['login']!="" ? "WHERE ".(isset($_POST['adminCheck']) ? "`admin` = ".$_POST['adminCheck']." AND " : " " )."`".$_POST['searchBy']."` = '".$_POST['login']."'" : "");// WHERE `name` = '".$_POST['login']."'";// AND `password` = '".sha1($_POST['haslo'])."'";
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
                        echo $row[2] ? "tak" : "nie";
                    echo "</td>";
                    echo "<td>";
                        echo "<button name=\"edit_account\" value=\"".$row[0]."\">Edytuj</button>";
                        echo "<button name=\"login\" value=\"".$row[0]."\">Zaloguj</button>";
                        //echo "<button name=\"edit\" value=\"password\">Edytuj hasło</button>";
                        //echo "<button name=\"delete\">Usuń konto</button>";
                    echo "</td>";
                    echo "</tr>";
                }
                //mysqli_close($conn);
            ?>
            </table>
            </form>
        </div>
        <div style="float: left; width: 50%;">
            <h2>Opcje</h2><br/>
            <form method="post">
            <?php
                $sql = "SELECT `id`, `name`, `admin` FROM `users` WHERE `id` = ".$_SESSION['id'];// WHERE `name` = '".$_POST['login']."'";// AND `password` = '".sha1($_POST['haslo'])."'";
                if(isset($_POST['edit_account'])){
                    echo "<input type=\"hidden\" name=\"edit_account\" value=\"".$_POST['edit_account']."\">";
                    $sql = "SELECT `id`, `name`, `admin` FROM `users` WHERE `id` = ".$_POST['edit_account'];
                } else{
                    echo "<input type=\"hidden\" name=\"edit_account\" value=\"".$_SESSION['id']."\">";
                }
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
                    echo "<button name='edit_name' value=\"\">Potwierdź</button>";
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
            </form>
        </div>
    </div>
    <div id="footer">
        <p>by AN</p>
    </div>
</body>
</html>