<?php 
require "../../includes/database.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="keywords" content="greenmap, зеленая карта, grenmap, map, green"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GreenMap - About us</title>

  <link rel="preload" href="../../design/fonts/ColorTube.otf" as="font" crossorigin = "anonymous">
  <link rel="preload" href="../../design/fonts/ubi.ttf" as="font" crossorigin = "anonymous">

  <link async rel="stylesheet" href="../../design/css/navbar_style.css">
  <link async rel="stylesheet" href="../../design/css/about_style.css">

  <link rel="shortcut icon" href="../../design/img/sites/favicon.ico" type="image/x-icon">
</head>
<body>
  <div style="height: 0px;"></div>
    <div class="header" id="myHeader">

        <div class="yep"><img src="../../design/img/sites/Logo.png" class="logopic" alt="Logotype">
            <p class="name">GREEN<span class="white">MAP</span></p>
        </div>

        <?php 
            if( isset($_SESSION['logged_user'])){
                echo "
                <div class='profile'>
                    <img src='../../design/img/users/".$_SESSION['logged_user']->id.".png?".time()."' class='logopic avauser' alt='profile'>
                    <a href='../profile/' class='nav'>".$_SESSION['logged_user']->login."</a>
                </div>";
            }
            else{
                echo "
                 <div class='profile'>
                    <img src='../../design/img/sites/uknown.png' class='logopic' alt='profile'>
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


  <section class="main">
    <div class="photos">
      <button class="guys"><img src="../../design/img/sites/about/Egor.jpg" alt="">
        <h2>Egor Anokhin</h2>
        <h3>Supervisor/Backender</h3>
      </button>
      <button class="guys"><img src="../../design/img/sites/about/Andrey.jpg" alt="">
        <h2>Andrey Hromanchuk</h2>
        <h3>Designer/Backender</h3>
      </button>
      <button class="guys"><img src="../../design/img/sites/about/Regina.jpg" alt="">
        <h2>Regina Berdiyarova</h2>
        <h3>Frontender</h3>
      </button>
      <button class="guys"><img src="../../design/img/sites/about/Alla.jpg" alt="">
        <h2>Alla Evtushenko</h2>
        <h3>Sponsor</h3>
      </button>
      <button class="guys"><img src="../../design/img/sites/about/Alexey.jpg" alt="">
        <h2>Alex Volkov</h2>
        <h3>Editor</h3>
      </button>
    </div>
  </section>
  <script src="../../design/js/navbar.js"></script>
</body>

</html>