<?php 

require '../../../includes/database.php';

$data = $_POST;

if(isset($data['do_exit'])){
    session_destroy();
    header("Location: https://greenmap.tk/");
}

if(!(isset($_SESSION['logged_user']))){
    header("Location: https://greenmap.tk/pages/signup/");
}
else{
    $user = R::findOne( 'users', 'email = ?', array($_SESSION['logged_user']->email));
    $_SESSION['logged_user'] = $user;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GreenMap - <?php echo $_SESSION['logged_user']->login;?></title>
    <link rel="stylesheet" href="navbar_style.css">
    <link rel="stylesheet" href="profile_style.css">
    <link rel="shortcut icon" href="../../../templates/img/sites/favicon.ico" type="image/x-icon">
</head>

<body>


    <div style="height: 0px;"></div>
    <div class="header" id="myHeader">

        <div class="yep"><img src="../../../templates/img/sites/Logo.png" class="logopic">
            <p class="name">GREENMAP</p>
        </div>
        <div class="profile">
            <img src="../../../templates/img/sites/profile_avatar.png" class="logopic">
            <a href="" class="nav act"><?php echo $_SESSION['logged_user']->login;?></a>
        </div>
        <div class="nav_menu">
            <div class="btns">
                <a href="../../../" class="nav">Map</a>
                <a href="#" class="nav">About us</a>
                <a href="../../recycle/" class="nav">Recycle</a>
                <a href="#" class="nav">Game</a>
            </div>
        </div>

    </div>

    <section class="profile_box">
        <div class="profileInfo">
            <img src="../../../templates/img/sites/profile_avatar.png" class="ava">

            <div class="profileStats">
                <p class="profname"><?php echo $_SESSION['logged_user']->login;?></p>
               
               <p class="level_text">Level <span class="red-text"><?php echo $_SESSION['logged_user']->level;?></span></p>
               
               <progress max="100" value="<?php echo $_SESSION['logged_user']->exp;?>"></progress>
               <div class='box-badges'>
                <img class='badge'src="../../../templates/img/sites/badges/alpha_badge.png" alt="For participating in Alpha">
               </div>
            </div>
                
            </div>
        </div>
    </section>

    <section class="control">
        <button class="button_control">
            <img src="../../../templates/img/sites/icons/settings.png" class='img_control'>
            <p class="text_contorl">SETTINGS</p>
        </button>
        <button class="button_control">
            <img src="../../../templates/img/sites/icons/Pin_icon.png" class='img_control'>
            <p class="text_contorl">NEW PIN</p>
        </button>
        <button class="button_control">
            <img src="../../../templates/img/sites/icons/quest_icon.png" class='img_control'>
            <p class="text_contorl">QUESTS</p>
        </button>
        <button class="button_control">
            <img src="../../../templates/img/sites/icons/gamer.png" class='img_control'>
            <p class="text_contorl">GAME</p>
        </button>
        <button class="button_control">
            <img src="../../../templates/img/sites/icons/report_icon.png" class='img_control'>
            <p class="text_contorl">REPORT</p>
        </button>
    </section>

   <form action="index.php" method = "POST">
        <button class="bars" type = "submit" name="do_exit"></button>
   </form>

    <script src="../../../templates/js/navbar.js"></script>
</body>

</html>