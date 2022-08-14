<?php 

require '../../includes/database.php';

$data = $_POST;

if(isset($data['do_exit'])){
    session_destroy();
    header("Location: https://greenmap.tk/");
}

if(isset($data['redict_apanel'])){
    header("Location: https://greenmap.tk/pages/apanel/login.php");
}

if(!(isset($_SESSION['logged_user']))){
    header("Location: https://greenmap.tk/pages/signin/");
}
else{
    $user = R::findOne( 'users', 'email = ?', array($_SESSION['logged_user']->email));
    $_SESSION['logged_user'] = $user;
}

function can_upload($file){
  // если имя пустое, значит файл не выбран
    if($file['name'] == '')
    return "You did not choose a photo";
  
  /* если размер файла 0, значит его не пропустили настройки 
  сервера из-за того, что он слишком большой */
  if($file['size'] == 0)
    return 'Photo is too big!';
  
  // разбиваем имя файла по точке и получаем массив
  $getMime = explode('.', $file['name']);
  // нас интересует последний элемент массива - расширение
  $mime = strtolower(end($getMime));
  // объявим массив допустимых расширений
  $types = array('jpg', 'png', 'jpeg');
  
  // если расширение не входит в список допустимых - return
  if(!in_array($mime, $types))
    return 'Invalid type of photo.';
  
  return true;
}
  
function make_upload($file){  
      // формируем уникальное имя картинки: случайное число и name
      $name = $_SESSION['logged_user']->id.".png";
      copy($file['tmp_name'], '../../design/img/users/' . $name);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GreenMap - <?php echo $_SESSION['logged_user']->login;?></title>
    <link rel="stylesheet" href="../../design/css/navbar_style.css">
    <link rel="stylesheet" href="../../design/css/profile_style.css">
    <link rel="shortcut icon" href="../../design/img/sites/favicon.ico" type="image/x-icon">
</head>

<body>


    <div style="height: 0px;"></div>
    <div class="header" id="myHeader">

        <div class="yep"><img src="../../design/img/sites/Logo.png" class="logopic">
            <p class="name">GREEN<span class="white">MAP</span></p>
        </div>
        <div class="profile">
            <img src="../../design/img/users/<?php echo "".$_SESSION['logged_user']->id.".png?".time()."";?>" class="logopic avauser">
            <a href="" class="nav act"><?php echo $_SESSION['logged_user']->login;?></a>
        </div>
        <div class="nav_menu">
            <div class="btns">
                <a href="../../" class="nav">Map</a>
                <a href="../aboutus/" class="nav">About us</a>
                <a href="../recycle/" class="nav">Recycle</a>
                <!-- <a href="#" class="nav">Game</a> -->
            </div>
        </div>

    </div>

    <section class="profile_box">
        <div class="profileInfo">
            <dev class="imgbox">
                <img src="../../design/img/users/<?php echo "".$_SESSION['logged_user']->id.".png?".time()."";?>" class="ava">
                <button class="ava_change hidden" onclick="showWinChange(1)">CHANGE</button>
            </dev>
            
            <div class="modal changeAva">

              <div class="modal-content">
                <button class="close" onclick="showWinChange(0)">&times;</button>
                <form method="post" enctype="multipart/form-data" action="index.php">
                  <input type="file" name="file">
                  <input type="submit" value="Upload!">
                </form>
                <?php
                // если была произведена отправка формы
                if(isset($_FILES['file'])) {
                  // проверяем, можно ли загружать изображение
                  $check = can_upload($_FILES['file']);
                
                  if($check === true){
                    // загружаем изображение на сервер
                    make_upload($_FILES['file']);
                    echo "<strong>Your avatar is successful loaded!</strong>";
                  }
                  else{
                    // выводим сообщение об ошибке
                    echo "<strong>$check</strong>";  
                  }
                }
                ?>
              </div>

            </div>

            <div class="profileStats">
                <p class="profname"><?php echo $_SESSION['logged_user']->login;?></p>
               
               <p class="level_text">Level <span class="red-text"><?php echo $_SESSION['logged_user']->level;?></span></p>
               
               <progress max="100" value="<?php echo $_SESSION['logged_user']->exp;?>"></progress>
               <div class='box-badges'>
                <?php 
                    $own_badges = R::find( 'badges', ' owners LIKE ? ', [ '%'.$_SESSION['logged_user']->login.'%' ] );  
                    $badgeSh = 0;
                    for($i = 0; $i <= count($own_badges); $i++){
                        if($badgeSh == 4){
                          break;
                        }
                        if($own_badges[$i]->name == ""){
                           continue;
                        }
                        echo '
                        <img class="badge '.$i.'" src="../../design/img/sites/badges/'.$own_badges[$i]->name.'_badge.png" title="'.$own_badges[$i]->title.'">
                        <button class = "switch_badge_button '.$i.' hidden" onclick="showWinSwitch(1)">
                          <img class = "switch_badge_icon" src="../../design/img/sites/switch_icon.png" alt="delete badge">
                        </button>
                        ';
                        $badgeSh++;
                    }

                 ?>
               </div>

            <div class="modal switch">

              <div class="modal-content">
                <button class="close" onclick="showWinSwitch(0)">&times;</button>
                  <div class="list_badge">
                    <?php
                    echo '<form action="index.php" method = "POST">'; 
                     for($i = 0; $i <= count($own_badges); $i++){
                        if($own_badges[$i]->name == ""){
                           continue;
                        }
                        echo '
                        <button type = "submit" name="badge_choosen">
                        <img class="badge '.$i.'" src="../../design/img/sites/badges/'.$own_badges[$i]->name.'_badge.png" title="'.$own_badges[$i]->title.'">
                        </button>
                        ';
                    }
                    echo '</form>'; 
                   ?>
                  </div>
              </div>

          </div>
        </div>
        <button id="up_editbutton" onclick="editprofile()">
            <img class = "edit_icon" src="../../design/img/sites/icons/edit_icon.png">
        </button>
    </section>

    <section class="control">
        <button class="bars" onclick="show(0)">
            <img src="../../design/img/sites/icons/settings.png" class="settings_icon">
            <p class="settings_text">SETTINGS</p>
        </button>
        <button class="bars" onclick="show(1)">
            <img src="../../design/img/sites/icons/Pin_icon.png" class="newpin_icon">
            <p class="newpin_text">NEW PIN</p>
        </button>
        <button class="bars" onclick="show(2)">
            <img src="../../design/img/sites/icons/quest_icon.png" class="quest_icon">
            <p class="quest_text">QUESTS</p>
        </button>
        <button class="bars" onclick="show(3)">
            <img src="../../design/img/sites/icons/report_icon.png" class="rep_icon">
            <p class="rep_text">SUPPORT</p>
        </button>
        <?php 
        if($_SESSION['logged_user']->admin > 0){
            echo '<form class = "apanel_form" action="index.php" method = "POST">
                    <button class="bars" type = "submit" name="redict_apanel">
                        <p class="admin_text">APANEL</p>
                    </button>
        ';
        }
        else{
          echo '
                <form action="index.php" method = "POST">
          ';
        }
         ?>
            <button class="bars exit" type = "submit" name="do_exit">
                <img src="../../design/img/sites/icons/exit_icon.png" class="exit_icon">
                <p class="exit_text">EXIT</p>
            </button>
        </form>
    </section>
    <section id = "temp-box">
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../../design/js/navbar.js"></script>
    <script src="../../design/js/profile.js"></script>
</body>

</html>