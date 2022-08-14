<?php 

require "includes/database.php";


$subject_suc = "Your password has been successful changed."; 
$subject_fail = "Your password has not been changed."; 

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=ut8 \r\n"; 

$headers .= "From: no-reply@greenmap.tk\r\n"; 
$headers .= "Reply-To: no-reply@greenmap.tk\r\n";

$send = array();
$errors = array();

$send[] = 'Write your new password in fields below';
$checked = false;

$token_url = $_GET['token'];
$data = $_POST;

if (isset($token_url) && preg_match('/^[0-9A-F]{40}$/i', $token_url)) {
  $token_info = R::findOne( 'tokens', 'token = ?', array($token_url));
  //echo"<script>console.log('".$_GET['token']."');</script>";
  if(!(empty($token_info))){

    if(!($token_info->time > $token_info->time+3600) && $token_info->active==true){

      if(!(R::findOne( 'banip', 'ip = ?', array($_SERVER['REMOTE_ADDR'])))){
        $checked = true;
      }else{
        header("Location: https://greenmap.tk/error.php?code=243"); // User with this ip has been baned
      }

    }
    else{
      header("Location: https://greenmap.tk/error.php?code=242"); // Time expired or inactive
    }

  }
  else{
    header("Location: https://greenmap.tk/error.php?code=241"); // No such a token in database
  }

}
else{
  header("Location: https://greenmap.tk/error.php?code=240");// Invalid code of token
}

if(isset($data['do_change'])){
  if($checked == true){
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

    if(empty($errors)){
      $user = R::findOne( 'users', 'email = ?', array($token_info->email));

      $message_suc = "This is a MIME encoded message.";
      $message_suc .= "\r\n\r\n--" . $boundary . "\r\n";
      $message_suc .= "Content-type: text/plain;charset=utf-8\r\n\r\n";

      $message_suc .= "Dear '.$user->login.',\nYour Greenmap account password has been successfully changed..\nWe are sending this notice to ensure the privacy and security of your Greenmap account. If you authorized this change, no further action is necessary\nIf you did not authorize this change, then please change your Greenmap password, and consider changing your email password as well to ensure your account security..
      \n\nGreenmap Team";

      $message_suc .= "\r\n\r\n--" . $boundary . "\r\n";
      $message_suc .= "Content-type: text/html;charset=utf-8\r\n\r\n";

      $message_suc .= '<html>
                <div style="margin-left:10px;display:block;">

                  <h1 style = "color:#38c65b;">Dear '.$user->login.',</h1>

                  <p style = "margin-bottom:2px;font-size: 20px;">Your Greenmap account password has been successfully changed..</p>

                  <p style = "margin-bottom:2px;font-size: 20px;">We are sending this notice to ensure the privacy and security of your Greenmap account. If you authorized this change, no further action is necessary</p>

                  <p style = "margin-bottom:2px;font-size: 20px;">If you did not authorize this change, then please change your Greenmap password, and consider changing your email password as well to ensure your account security..</p>

                  <p style = "margin-top:5px;font-size: 20px;">Greenmap Team</p>

                </div>
              </html>  
                ';

      $message_suc .= "\r\n\r\n--" . $boundary . "--";    


      $message_fail = "This is a MIME encoded message.";
      $message_fail .= "\r\n\r\n--" . $boundary . "\r\n";
      $message_fail .= "Content-type: text/plain;charset=utf-8\r\n\r\n";

      $message_fail .= "Dear '.$user->login.',\nUnfortunately, your Greenmap account password has not been changed...\nWe are sending this notice to ensure the privacy and security of your Greenmap account. If you authorized this change, no further action is necessary\nIf you did not authorize this change, then please change your Greenmap password, and consider changing your email password as well to ensure your account security..
      \n\nGreenmap Team";

      $message_fail .= "\r\n\r\n--" . $boundary . "\r\n";
      $message_fail .= "Content-type: text/html;charset=utf-8\r\n\r\n";

      $message_fail .= '<html>
                <div style="margin-left:10px;display:block;">

                  <h1 style = "color:#38c65b;">Dear '.$user->login.',</h1>

                  <p style = "margin-bottom:2px;font-size: 20px;">Unfortunately, your Greenmap account password has not been changed..</p>

                  <p style = "margin-bottom:2px;font-size: 20px;">We are sending this notice to ensure the privacy and security of your Greenmap account. If you authorized this change, no further action is necessary</p>

                  <p style = "margin-bottom:2px;font-size: 20px;">If you did not authorize this change, then please change your Greenmap password, and consider changing your email password as well to ensure your account security..</p>

                  <p style = "margin-top:5px;font-size: 20px;">Greenmap Team</p>

                </div>
              </html>  
                ';

      $message_fail .= "\r\n\r\n--" . $boundary . "--";

      $user->password = password_hash($data['password_user'], PASSWORD_DEFAULT);
      R::store($user);

      if(R::findOne( 'users', 'email = ?', array($token_info->email))->password = password_hash($data['password_user'], PASSWORD_DEFAULT)){

        mail("<".$token_info->email.">", $subject_suc, $message_suc, $headers); 
        $token_info->active = false;
        R::store($token_info);

      }
      else{
        mail("<".$token_info->email.">", $subject_fail, $message_fail, $headers);
      }
      header("Location: https://greenmap.tk/pages/signin/");
    }
  }
  else{
    header("Location: https://greenmap.tk/error.php?code=239");// Failed to check
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GreenMap - Recover</title>
  <link rel="stylesheet" href="../../design/css/signin_style.css">
  <link rel="shortcut icon" href="../../design/img/sites/favicon.ico" type="image/x-icon">
</head>
<body>
  <h1>GREEN<span class="white">MAP</span></h1>
  <h2>MAKE YOUR DREAM COME TRUE</h2>
  <form action="<?php echo 'active.php?token='.$token_url?>" method = "POST">
  
    <p class="tip_res">
    <?php
      if(empty($errors)){
        echo end($send);
      } 
      else{
        echo array_shift($errors);
        echo "<script>console.log('".$errors."');</script>";
      }
     ?>
    </p>

    <div class="inputs">
      <input class="ps" placeholder="New password" type="password" name="password_user">
      <input class="ps" placeholder="Repeat Password" type="password" name="verpassword_user">
    </div>

    <button type = "submit" id = "button_change" name = "do_change">CHANGE</button>
  </form>

</body>
</html>