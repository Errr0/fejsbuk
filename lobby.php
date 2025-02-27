<?php
    session_start();
    if(!isset($_SESSION['name'])){
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
    <script src="script.js"></script>
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
            <form action="zalogowany.php" method="post">
                <button name="cofnij">Cofnij</button>
            </form>
        </div>
    </div>
    <div id="content">
        <h2><?php echo $_SESSION['lobby_name'];?></h2>
        <?php
            
        
        
        ?>
        
        <input type="number" name="x" placeholder="x"><br/>
        <input type="number" name="y" placeholder="y"><br/>
        <input type="number" name="z" placeholder="z"><br/>
        <button onclick="get_data()">get</button>
        <button onclick="send_data()">send</button>
        <p id="result"></p>
    </div>
    <div id="footer">
        <p>by AN</p>
    </div>
</body>
</html>

