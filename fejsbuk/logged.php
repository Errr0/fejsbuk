<?php
    session_start();
    if(isset($_SESSION["password"]) && isset($_SESSION["name"]) && isset($_SESSION["id"]) && isset($_SESSION["admin"])){
        $conn = mysqli_connect("localhost", "root", "", "fejsbuk");
        $sql = "SELECT `id`, `name`, `admin` FROM `users` WHERE `name` = '".$_SESSION["name"]."' AND `password` = '".sha1($_SESSION["password"])."'";//todo reverse password
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
<script>


function slideInProfile() {
  let id = null;
  const div = document.getElementById("profile");
  const button = document.getElementById("profile_button");
  //button.onclick = slideOut;
  //button.innerHTML = "Cofnij";
  button.disabled = true;
  //setTimeout(function(){document.getElementById("profile_button").disabled = false;},1000)
  let pos = -450;
  clearInterval(id);
  id = setInterval(frame, 1);
  function frame() {
    if (pos == 10) {
      clearInterval(id);
    } else {
      pos+=4;
      div.style.top = 0;
      div.style.right = pos + 'px';
    }
  }
}

function closeProfile(){
    const div = document.getElementById("profile");
    div.style.right = "-450px"
    const button = document.getElementById("profile_button");
    button.disabled = false;

}
</script>
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
                echo "<form action=\"admin.php\" method=\"post\">";
                echo "<button class=\"form_button\">Admin</button>";
                echo "</form>";
            }
            ?>
        </div>
    </div>
    <div id="body">
        <div id="content">
            <h2>Wiadomości</h2>
        </div>
        <div id ="profile">
            <h2>Profil</h2>
            <button class="fa-solid fa-gear top_right_button" style="float: right;"></button>
        </div>

        <div id ="friends">
            <h2>Znajomi</h2>
            
        </div>
    </div>
</body>
</html>