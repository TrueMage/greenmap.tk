<?php
require '../../includes/database.php';

$data = $_POST;

if(isset($data['do_exit'])){
    header("Location: https://greenmap.tk/pages/profile/");
}

if(!(isset($_SESSION['logged_user']))){
    header("Location: https://greenmap.tk/pages/signin/");
}

if(isset($data['do_login'])){

  $errors = array();

  if( trim($data['admid_user']) == ''){
      $errors[] = 'Write an adminID';
  }

  if( $data['password_user'] == ''){
    $errors[] = 'Write a password!';
  }

  if( empty($errors) ){


    $admin = R::findOne( 'admin', 'id = ?', array(trim($data['admid_user'])));

    if(!($admin)){
       $errors[] = 'Invalid password or ID';
    }

    if( password_verify($data['password_user'], $admin->password)){
      $_SESSION['admin_passed'] = $admin;
      header("Location: https://greenmap.tk/pages/apanel/index.php");
    }
    else{
      $errors[] = 'Invalid password or AdminID';
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>APANEL - Auth</title>
   <link rel="stylesheet" href="../../templates/css/signin_style.css">
   <link rel="shortcut icon" href="../../templates/img/sites/favicon.ico" type="image/x-icon">
</head>
<body>
  <h1>GREENMAP</h1>
  <p class="errors"><?php if(!(empty($errors))) echo array_shift($errors); ?></p>
  <form action="login.php" method = "POST">

    <div class="inputs">
      <input class="ps" placeholder="Admin ID" type="text" name="admid_user"
      >
      <input class="ps" placeholder="Password" type="password" name="password_user">
    </div>

    <div class="buttons">
      <button type = "submit" id = "button_signup" name = "do_exit">Back</button>
      <button type = "submit" id = "button_signin" name = "do_login" autofocus>Sing In</button>
    </div>

  </form>
</body>
</html>