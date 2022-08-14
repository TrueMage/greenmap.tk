<?php 
require "includes/database.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="keywords" content="greenmap, зеленая карта, grenmap, map, green" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Find nearby recycling places/stations in GreenMap"/>
  <title>GreenMap - Map</title>

  <link rel="preload" href="design/fonts/ColorTube.otf" as="font" crossorigin="anonymous">
  <link rel="preload" href="design/fonts/ubi.ttf" as="font" crossorigin="anonymous">

  <link async rel="stylesheet" href="design/css/navbar_style.css">
  <link async rel="stylesheet" href="design/css/map_style.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>

  <link rel="shortcut icon" href="design/img/sites/favicon.ico" type="image/x-icon">

</head>

<body>
  <div style="height: 0px;"></div>
  <div class="header" id="myHeader">

    <div class="yep"><img src="design/img/sites/Logo.png" class="logopic" alt="Logotype">
      <p class="name">GREEN<span class="white">MAP</span></p>
    </div>

    <?php 
    if( isset($_SESSION['logged_user'])){
      echo "
      <div class='profile'>
        <img src='../../design/img/users/".$_SESSION['logged_user']->id.".png?".time()."' class='logopic avauser' alt='profile'>
        <a href='pages/profile/' class='nav'>".$_SESSION['logged_user']->login."</a>
      </div>";
    }
    else{
      echo "
                 <div class='profile'>
                   <img src='design/img/sites/uknown.png' class='singin_pic' alt='profile'>
                   <a href='pages/signin/' class='nav'>Sign In</a>
                  </div>";
                }
                
                ?>

    <div class="nav_menu">
      <div class="btns">
        <a href="#" class="nav act">Map</a>
        <a href="pages/aboutus/" class="nav">About us</a>
        <a href="pages/recycle/" class="nav">Recycle</a>
        <!-- <a href="#" class="nav">Game</a> -->
      </div>
    </div>
  </div>

  <div id="map"></div>

  <div class="filters">
    <div class="paper">
      <p class="filterText">Paper</p>
      <button id="paper" class="filterButton" onclick="Paper()"></button>
    </div>

    <div class="plastic">
      <p class="filterText">Plastic</p>
      <button id="plastic" class="filterButton" onclick="Plastic()"></button>
    </div>

    <div class="glass">
      <p class="filterText">Glass</p>
      <button id="glass" class="filterButton" onclick="Glass()"></button>
    </div>

    <div class="metal">
      <p class="filterText">Metal</p>
      <button id="metal" class="filterButton" onclick="Metal()"></button>
    </div>

    <div class="batteries">
      <p class="filterText">Batteries</p>
      <button id="batteries" class="filterButton" onclick="Batteries()"></button>
    </div>

    <div class="caps">
      <p class="filterText">Caps</p>
      <button id="caps" class="filterButton" onclick="Caps()"></button>
    </div>
  </div>

  <script async src="design/js/navbar.js"></script>
  <script async src="design/js/map.js"></script>
  
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDD66Qb627SlOgKZybqsDOhhQKMEIKyMXk&callback=initMap"></script>

  </body>

</html>