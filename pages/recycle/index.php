<?php 
require "../../includes/database.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GreenMap - Recycle</title>
  <link async rel="stylesheet" href="../../design/css/recycle_style.css">
  <link async rel="stylesheet" href="../../design/css/navbar_style.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

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
              <a href="../aboutus/" class="nav">About us</a>
              <a href="#" class="nav act">Recycle</a>
              <!-- <a href="#" class="nav">Game</a> -->
          </div>
      </div>
    </div>

  <header>
  </header>
  
  <div data-aos="fade-right" class="tabcontent">
    <h1>Mechanical<br>Method</h1>
    <p>The essence of the method is the mechanical crushing of plastic waste materials for further re-thermal forming. This is the simplest and most commonly used method of recycling waste abroad. The process consists of several stages. Plastic waste is sorted by species, condition, contamination. The sorted material is pre-crushed, then re-sorted, washed and dried. Prepared raw material is processed in thermal plants till the moment of formation of melt of homogeneous consistency. The molten material is fed into an extruder to form a secondary product or intermediate pellets, which are then used as raw materials for new production. Mechanical recycling is widely used for the manufacture of polymer fibres, plastic containers and packaging products.</p>
  </div>
  
  <div data-aos="fade-left" class="tabcontent">
    <h1>Hydrolysis<br>Method</h1>
    <p>The method consists in splitting of polymer materials wastes with water-acid solutions under the influence of high temperature. The technology is not new and has many varieties . The main hydrolysis process is carried out in a special vacuum reactor, where the ground raw material purified from impurities is supplied. As a rule, the fragmentation of plastic waste is carried out in several stages, resulting in particles of several tens of microns. The hydrolysis method is considered to be quite energy intensive due to the significant water consumption and the long duration of the production process.  The advantage of the method is also the low requirements for cleaning and sorting plastic waste.</p>
  </div>
  
  <div data-aos="fade-right" class="tabcontent">
    <h1>Glycolysis<br>Method</h1>
    <p>Glycolysis  is a form of hydrolysis method, and its main features are the use of glycol in the depolymerization process and the presence of elevated operating temperatures. Various catalysts are used to reduce the time of chemical reactions, which also influence the performance of the product. The advantages of the method include low requirements for pre-treatment of waste and almost complete waste-free production. However, the technological features of this method do not allow it to be used for further production</p>
  </div>
  
  <div data-aos="fade-left" class="tabcontent">
    <h1>Methanol<br>Method</h1>
    <p>The method involves splitting waste plastic with methanol. The process takes place in a pressurized reactor under high temperature conditions. The methanolysis method relates to processes of increased explosive and chemical danger, whereby it is used mainly in highly specialized cycles of polyester production. Methanol requires careful preparation of raw materials.</p>
  </div>

  <script async src="../../design/js/recycle.js"></script>
  <script async src="../../design/js/navbar.js"></script>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>
</html>