<?php  
require "../../includes/database.php";

$boundary = uniqid('np');
$subject = "Restoring password"; 

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-Type: multipart/alternative;boundary=" . $boundary . "\r\n";

$headers .= "From: no-reply@greenmap.tk\r\n"; 
$headers .= "Reply-To: no-reply@greenmap.tk\r\n";

$data = $_POST;
$send = 'To reset your password,<br> write your E-mail in field below.</p>';

  if(isset($data['do_send'])){

    $errors = array();
    if($data['email_user'] == ''){
      $errors[] = 'Write E-mail';
    }

    if (!(filter_var($data['email_user'], FILTER_VALIDATE_EMAIL))) {
      $errors[] = "E-mail adress was written wrong";
      $data['email_user'] = '';
    }
    else{
      $user = R::findOne( 'users', 'email = ?', array(trim($data['email_user'])));

      if(empty($user)){
          $errors[] = 'User with this E-mail do not exsist';
      }

      if( empty($errors) ){

        $token = sha1(uniqid(random_bytes(30), true));
        $url = "https://greenmap.tk/active.php?token=.$token";
        $old = R::findOne( 'tokens', 'email = ?', array($data['email_user']));

        if (!(empty($old))) {
          $message = "This is a MIME encoded message.";
          $message .= "\r\n\r\n--" . $boundary . "\r\n";
          $message .= "Content-type: text/plain;charset=utf-8\r\n\r\n";

          $message .= "Dear '.$user->login.',\nWe have received a request to reset your Greenmap password.\nhttps://greenmap.tk/active.php?token='.$token.'\nWe are sending this notice to ensure the privacy and security of your Greenmap account. If you authorized this change, no further action is necessary\nIf you did not request a new password, or you have received this notification in error, you may ignore this e-mail and your password will remain unchanged
          \n\nGreenmap Team";
          $message .= "\r\n\r\n--" . $boundary . "\r\n";
          $message .= "Content-type: text/html;charset=utf-8\r\n\r\n";

          $message .= '<html>
                    <div style="margin-left:10px;display:block;">

                      <h1 style = "color:#38c65b;">Dear '.$user->login.',</h1>

                      <p style = "margin-bottom:2px;font-size: 20px;">We have received a request to reset your Greenmap password.</p>
                      <p style = "padding-bottom:5px;font-size: 20px;">https://greenmap.tk/active.php?token='.$token.'</p>

                      <p style = "margin-bottom:2px;font-size: 20px;">We are sending this notice to ensure the privacy and security of your Greenmap account. If you authorized this change, no further action is necessary</p>

                      <p style = "margin-bottom:2px;font-size: 20px;">If you did not request a new password, or you have received this notification in error, you may ignore this e-mail and your password will remain unchanged</p>

                      <p style = "margin-top:5px;font-size: 20px;">Greenmap Team</p>

                    </div>
                  </html>  
                    ';

          $message .= "\r\n\r\n--" . $boundary . "--";

          if($old->time > $_SERVER["REQUEST_TIME"] + 86400){
             $old->tolimit = 5;
             $old->active = true;
             $old->token = $token;
             R::store($old);
             mail("<".$data['email_user'].">", $subject, $message, $headers); 
             $send = 'An e-mail has been sent to your mail.<br> If you did not recieve e-mail after 3 minutes,<br> check "Spam" or try to send it again.</p>';
          }
          else{
            if($old->tolimit > 0){
              $old->tolimit--;
              $old->active = true;
              $old->token = $token;
              R::store($old);
              mail("<".$data['email_user'].">", $subject, $message, $headers); 
              $send = 'An e-mail has been sent to your mail.<br> If you did not recieve e-mail after 3 minutes,<br> check "Spam" or try to send it again.</p>';
            }
            else{
              $send = 'User with this E-mail has used<br> too many times recovering.';
            }
          }

        }
        else{
          $tok = R::dispense('tokens');
          $tok->email = $data['email_user'];
          $tok->token = $token;
          $tok->tolimit = 5;
          $tok->time = $_SERVER["REQUEST_TIME"];
          $tok->ip = $_SERVER['REMOTE_ADDR'];
          $tok->active = true;
          R::store($tok);

          $message = "This is a MIME encoded message.";
          $message .= "\r\n\r\n--" . $boundary . "\r\n";
          $message .= "Content-type: text/plain;charset=utf-8\r\n\r\n";

          $message .= "Dear '.$user->login.',\nWe have received a request to reset your Greenmap password.\nhttps://greenmap.tk/active.php?token='.$tok->token.'\nWe are sending this notice to ensure the privacy and security of your Greenmap account. If you authorized this change, no further action is necessary\nIf you did not request a new password, or you have received this notification in error, you may ignore this e-mail and your password will remain unchanged
            \n\nGreenmap Team";
          $message .= "\r\n\r\n--" . $boundary . "\r\n";
          $message .= "Content-type: text/html;charset=utf-8\r\n\r\n";

          $message .= '<html>
                    <div style="margin-left:10px;display:block;">

                      <h1 style = "color:#38c65b;">Dear '.$user->login.',</h1>

                      <p style = "margin-bottom:2px;font-size: 20px;">We have received a request to reset your Greenmap password.</p>
                      <p style = "padding-bottom:5px;font-size: 20px;">https://greenmap.tk/active.php?token='.$tok->token.'</p>

                      <p style = "margin-bottom:2px;font-size: 20px;">We are sending this notice to ensure the privacy and security of your Greenmap account. If you authorized this change, no further action is necessary</p>

                      <p style = "margin-bottom:2px;font-size: 20px;">If you did not request a new password, or you have received this notification in error, you may ignore this e-mail and your password will remain unchanged</p>

                      <p style = "margin-top:5px;font-size: 20px;">Greenmap Team</p>

                    </div>
                  </html>  
                    ';

          $message .= "\r\n\r\n--" . $boundary . "--"; 
          mail("<".$data['email_user'].">", $subject, $message, $headers); 
          $send = 'An e-mail has been sent to your mail.<br> If you did not recieve e-mail after 3 minutes,<br> check "Spam" or try to send it again.</p>';  
        }
      }
    }
  }







if( isset($data['do_redict'])){
    header("Location: https://greenmap.tk/pages/signin/");
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
  <p class="errors"><?php if(!(empty($errors))) echo array_shift($errors); ?></p>
  <form action="index.php" method = "POST">
  
  <p class="tip_res">
  <?php 
    echo $send;
   ?>
  </p>
    <div class="inputs">
      <input class="ps" placeholder="E-mail" type="text" name="email_user">
    </div>

    <div id="buttons">
      <button type = "submit" class = "button_resback" name = "do_redict">BACK</button>
      <button type = "submit" id = "button_sent" name = "do_send">SEND</button>
    </div>

  </form>
</body>
</html>