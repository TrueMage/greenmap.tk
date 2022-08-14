<?php 

require "../../includes/database.php";

if(isset($_SESSION['logged_user'])){
    header("Location: https://greenmap.tk/pages/profile/");
}

  $data = $_POST;

  if(isset($data['do_signup'])){

    $errors = array();
    if( trim($data['login_user']) == ''){
      $errors[] = 'Write your login';
    }

    if( strlen($data['login_user']) < 4){
      $errors[] = 'Login is too short';
    }

    if( strlen($data['login_user']) > 9){
      $errors[] = 'Login is too long';
    }

    if( trim($data['email_user']) == ''){
      $errors[] = 'Write your E-mail';
    }

    if (!(filter_var($data['email_user'], FILTER_VALIDATE_EMAIL))) {
      $errors[] = "E-mail adress was written wrong";
      $data['email_user'] = '';
    }

    if( $data['password_user'] == ''){
      $errors[] = 'Write a password';
    }

    if( $data['verpassword_user'] == ''){
      $errors[] = 'Reapet your password';
    }
    
    if( strlen($data['password_user']) < 6){
      $errors[] = 'Password is too short';
    }

    if( strlen($data['password_user']) > 13){
      $errors[] = 'Password is too long';
    }

    if( $data['verpassword_user'] != $data['password_user']){
      $errors[] = 'Passwords are different';
    }

    if( R::count('users',"login = ?", array($data['login_user'])) > 0){
      $errors[] = 'User with this login already exists';
    }

    if( R::count('users',"email = ?", array($data['email_user'])) > 0){
      $errors[] = 'User with this e-mail already exists';
    }

    if( empty($errors) ){
      $user = R::dispense('users');
      $user->login = $data['login_user'];
      $user->email = $data['email_user'];
      $user->password = password_hash($data['password_user'], PASSWORD_DEFAULT);
      $user->level = 1;
      $user->exp = 20;
      $user->money = 1;
      $user->admin = 0;
      $user->badges = 'none';
      R::store($user);

      copy('../../design/img/sites/profile_avatar.png','../../design/img/users/'.$user->id.'.png');

      $_SESSION['logged_user'] = $user;

      header("Location: https://greenmap.tk/pages/profile/");
    }
  }

  if( isset($data['do_back'])){
     header("Location: https://greenmap.tk/pages/signin/");
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GreenMap - Sign Up</title>
  <link rel="stylesheet" href="../../design/css/signup_style.css">
  <link rel="shortcut icon" href="../../design/img/sites/favicon.ico" type="image/x-icon">
</head>
<body>
  <h1>GREEN<span class="white">MAP</span></h1>
  <h2>MAKE YOUR DREAM COME TRUE</h2>

  <p class="errors"><?php if(!(empty($errors))) echo array_shift($errors); ?></p>
  <form action="index.php" method = "POST">
    
    <input class="ps" placeholder="Login" type="text" name="login_user" value="<?php echo @$data['login_user'];?>">
    <input class="ps" placeholder="E-mail" type="e-mail" name="email_user" value="<?php echo @$data['email_user'];?>">
    <input class="ps" placeholder="Password" type="password" name="password_user">
    <input class="ps" placeholder="Verify password" type="password" name="verpassword_user">

    <div class="buttons">
      <button id="button_back" name = "do_back" onclick=''>BACK</button>
      <button id="button_next" name = "do_signup" type = "submit" autofocus>NEXT</button>
    </div> 
  </form>
</body>
</html>