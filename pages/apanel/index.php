<?php 

if(!(isset($_SESSION['logged_user']))){
  header("Location: https://greenmap.tk/pages/signin/");
}

// if(!(isset($_SESSION['admin_passed']))){
//   header("Location: https://greenmap.tk/pages/profile/");
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="keywords" content="greenmap, зеленая карта, grenmap, map, green" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Find nearby recycling places/stations in GreenMap" />
  <title>GreenMap - Map</title>

  <link rel="preload" href="../../templates/fonts/ColorTube.otf" as="font" crossorigin="anonymous">
  <link rel="preload" href="../../templates/fonts/ubi.ttf" as="font" crossorigin="anonymous">

  <link async rel="stylesheet" href="../../templates/css/navbar_style.css">
  <link async rel="stylesheet" href="../../templates/css/admin_style.css">

  <link rel="shortcut icon" href="../../templates/img/sites/favicon.ico" type="image/x-icon">

</head>

<body>
   <div style="height: 0px;"></div>
    <div class="header" id="myHeader">

        <div class="yep"><img src="../../templates/img/sites/Logo.png" class="logopic" alt="Logotype">
            <p class="name">GREEN<span class="white">MAP</span></p>
        </div>

        <?php 
            if( isset($_SESSION['logged_user'])){
                echo "
                <div class='profile'>
                    <img src='../../templates/img/users/".$_SESSION['logged_user']->id.".png?".time()."' class='logopic avauser' alt='profile'>
                    <a href='../profile/' class='nav'>".$_SESSION['logged_user']->login."</a>
                </div>";
            }
            else{
                echo "
                 <div class='profile'>
                    <img src='../../templates/img/sites/uknown.png' class='logopic' alt='profile'>
                    <a href='../signin/' class='nav'>Sign In</a>
                 </div>";
            }

         ?>

        <div class="nav_menu">
            <div class="btns">
                <a href="../../" class="nav">Map</a>
                <a href="#" class="nav act">About us</a>
                <a href="../recycle/" class="nav">Recycle</a>
               <!--  <a href="#" class="nav">Game</a> -->
            </div>
        </div>
    </div>
  </div>  


  <div class="fbtns">
    <button class="abtns">Report tokens</button>
    <button class="abtns">New pins</button>
    <button class="abtns">Sector for dev</button>
    <button class="abtns">Accounts</button>
    <button class="abtns">Punishments</button>
    <button class="abtns badges">Badges</button>
  </div>
  <div class="fbtns exit">
    <button class="abtns exitb">Exit</button>
  </div>
  <div class="bigbtns">
    <button class="bbtns"></button>
    <button class="bbtns"></button>
    <button class="bbtns"></button>
    <button class="bbtns"></button>
  </div>
  <script async src="../../templates/js/navbar.js"></script>
</body>

</html>