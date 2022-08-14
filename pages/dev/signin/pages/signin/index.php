<?php 

require "../../../../../includes/database.php";

if(isset($_SESSION['logged_user'])){
    header("Location: https://greenmap.tk/pages/profile/");
}

  $data = $_POST;

  if(isset($data['do_signup'])){

    $errors = array();
    if( trim($data['login_user']) == ''){
      $errors[] = 'You did not write a login!';
    }

    if( strlen($data['login_user']) < 4){
      $errors[] = 'You write too short login';
    }

    if( strlen($data['login_user']) > 9){
      $errors[] = 'You write too long login';
    }

    if( trim($data['email_user']) == ''){
      $errors[] = 'You did not write your E-mail';
    }

    if (!(filter_var($data['email_user'], FILTER_VALIDATE_EMAIL))) {
      $errors[] = "E-mail adress was written wrong";
      $data['email_user'] = '';
    }

    if( $data['password_user'] == ''){
      $errors[] = 'You did not write a password';
    }

    if( $data['verpassword_user'] == ''){
      $errors[] = 'You did not reapet your password';
    }
    
    if( strlen($data['password_user']) < 6){
      $errors[] = 'You write too short Password';
    }

    if( strlen($data['password_user']) > 13){
      $errors[] = 'You write too long Password';
    }

    if( $data['verpassword_user'] != $data['password_user']){
      $errors[] = 'Password in verify field isn’t 
      the same as field before';
    }

    if( R::count('users',"login = ?", array($data['login_user'])) > 0){
      $errors[] = 'You wrote a login, which already exists';
    }

    if( R::count('users',"email = ?", array($data['email_user'])) > 0){
      $errors[] = 'You wrote a E-mail, which already exists';
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

      copy('../../../../../templates/img/sites/profile_avatar.png','../../../../../templates/img/users/'.$user->id.'.png');

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
  <title>GreenMap - Sign In</title>
  <link rel="stylesheet" href="../../templates/css/signin_style.css">
  <link rel="shortcut icon" href="../../../../../templates/img/sites/favicon.ico" type="image/x-icon">
</head>
<body>
  <h1>GREENMAP</h1>
  <h2>MAKE YOUR DREAM COME TRUE</h2>
  <div class="but">
    <button class="ver left active" onclick='GoTo(0)'>1</button>
    <button class="ver center" onclick='GoTo(1)'>2</button>
    <button class="ver right" onclick='GoTo(2)'>3</button>
  </div>
  <div class="error">
    <?php if(!(empty($errors))) echo array_shift($errors);  ?>
  </div>
  <form action="index.php" method = "POST">

    <div class="inputs first_stage">
      <input class="ps" placeholder="Password" type="text" name="password_user">
      <input class="ps" placeholder="Verify Password" type="password" name="verpassword_user">
    </div>

    <div class="inputs second_stage hidden">
      <input class="ps" placeholder="E-mail" type="email" name="email_user">
      <input class="ps" placeholder="Login" type="text" name="login_user">
    </div>
      
    <div class="inputs third_stage hidden">
      <input class="ps" placeholder="Password" type="text" name="password_user">
      <input class="ps" placeholder="Verify Password" type="password" name="verpassword_user">
    </div>
      
    <button type = "submit" id = "button_signin" class="submit hidden" name = "do_signin">NEXT</button>
  </form>
  
  <div class="buttons">
        <button id = "button_signup" onclick="GoTo(0)">BACK</button>
        <button id = "button_signin" onclick="GoTo(1)">NEXT</button>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="../../templates/js/signin.js"></script>
</body>
</html>