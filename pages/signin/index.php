<?php 

require "../../includes/database.php";


  $data = $_POST;

  if(isset($data['do_signin'])){

    $errors = array();
    if( trim($data['email_user']) == ''){
      $errors[] = 'Write E-mail';
    }

    if (!(filter_var($data['email_user'], FILTER_VALIDATE_EMAIL))) {
      $errors[] = "E-mail adress was written wrong";
      $data['email_user'] = '';
    }

    if( $data['password_user'] == ''){
      $errors[] = 'Write a password';
    }

    if( empty($errors) ){

      $user = R::findOne( 'users', 'email = ?', array(trim($data['email_user'])));

      if(!($user)){
        $errors[] = 'Invalid password or E-mail';
      }

      if( password_verify($data['password_user'], $user->password)){
        $_SESSION['logged_user'] = $user;
        header("Location: https://greenmap.tk/pages/profile/");
      }
      else{
        $errors[] = 'Invalid password or E-mail';
      }
    }
  }

  if( isset($data['do_redict'])){
     header("Location: https://greenmap.tk/pages/signup/");
  }

  if( isset($data['do_back'])){
     header("Location: https://greenmap.tk/");
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GreenMap - Sign In</title>
  <link rel="stylesheet" href="../../design/css/signin_style.css">
  <link rel="shortcut icon" href="../../design/img/sites/favicon.ico" type="image/x-icon">
</head>
<body>
  <h1>GREEN<span class="white">MAP</span></h1>
  <h2>MAKE YOUR DREAM COME TRUE</h2>
  <p class="errors"><?php if(!(empty($errors))) echo array_shift($errors); ?></p>
  <form action="index.php" method = "POST">

    <div class="inputs">
      <input class="ps" placeholder="E-mail" type="text" name="email_user" value="<?php echo @$data['email_user'];?>">
      <input class="ps" placeholder="Password" type="password" name="password_user">
    </div>

    <div class="buttons">
      <button type = "submit" id = "button_signup" name = "do_redict">SIGN UP</button>
      <button type = "submit" id = "button_signin" name = "do_signin" autofocus>SIGN IN</button>
    </div>

  </form>
  <a href="../recover/index.php" class="forgot_pass">Forgot password?</a>
  <form action="index.php" method = "POST">
    <button id="button_back" name = "do_back" type = "submit"><img src="../../design/img/sites/icons/whiteback_icon.png" alt=""><p>Back</p></button>
  </form>
</body>
</html>