<?php
include('dbconnect.php');
require 'vendor/autoload.php';

if(!isset($_SESSION)){
  session_start();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function send_password_reset($get_name, $get_email,$token){
  $mail = new PHPMailer;
  $mail->isSMTP();
  $mail->SMTPAuth = true;

  $mail->Host = 'smtp.gmail.com';
  $mail->Username   = 'alumnitracer.plmun@gmail.com';
  $mail->Password   = 'PLMUN@osa';

  $mail->SMTPSecure = "ssl";
  $mail->Port = 465;

  $mail->setFrom("devslibrary.io@gmail.com", "Password Reset");
  $mail->addAddress($get_email);

  $mail->isHTML(true);
  $mail->Subject = "Reset Password Notification";

  $email_template = "
  <h3>Account Reset Password</h3>
  <h4>You are receiving this email because we received a password reset request from your account.</h4>
  <br/><br/>
  <a href = 'http://localhost/simple-phplogin-system/password_reset.php?token=$token&email=$get_email'> Click Here </a>
  ";

  $mail->Body = $email_template;
  $mail->send();
}

if(isset($_POST['reset_btn'])){
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $token = md5(rand());

  $check_email_user = "SELECT * FROM users WHERE email = '$email' LIMIT 1;";
  $check_email_run = mysqli_query($con, $check_email_user);
  $user_email_rows = mysqli_num_rows($check_email_run);

  if($user_email_rows > 0){
    $row = mysqli_fetch_array($check_email_run);
    $get_name = $row['first_name'];
    $get_email = $row['email'];

    $update_user_token = "UPDATE users SET verify_token = '$token' WHERE email='$email' LIMIT 1;";
    $update_user_token_run = mysqli_query($con, $update_user_token);

    if($update_user_token_run){
      send_password_reset($get_name, $get_email, $token);
      $_SESSION['status'] = "Password Reset Link has been sent to your email!";
      header("Location: index.php");
      exit(0);
    }else{
      $_SESSION['status'] = "Something went Wrong.";
      header("Location: reset-password.php");
      exit(0);
    }

  }else{
      $_SESSION['status'] = "No Email Found!";
      header("Location: reset-password.php");
      exit(0);
    }
}


if(isset($_POST['update_password'])){
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
  $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);
  $token = mysqli_real_escape_string($con, $_POST['password_token']);

  $match_password = $confirm_password;
  if($match_password == $new_password){
    if(!empty($token)){
      if(!empty($email) && !empty($new_password) && !empty($confirm_password)){
        $check_token = "SELECT verify_token FROM users WHERE verify_token='$token' LIMIT 1;";
        $check_token_run = mysqli_query($con, $check_token);
        $token_row = mysqli_num_rows($check_token_run);

        if($token_row > 0){
          $user_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
          $update_user_password = "UPDATE users SET password='$user_hashed_password' WHERE verify_token='$token' LIMIT 1;";
          $update_password_run = mysqli_query($con, $update_user_password);

          if($update_password_run){
            $_SESSION['status'] = "Password Successfully Updated!";
            header("Location: index.php");
            exit(0);
          }else{
            $_SESSION['status'] = "Error Updating your Password";
            header("Location: password_reset.php");
            exit(0);
          }
        }else{
            $_SESSION['status'] = "Error!";
            header("Location: password_reset.php");
          }
      }else{
        $_SESSION['status'] = "Please Fill all the fields";
        header("Location: password_reset.php");
        exit(0);
      }
    }else{
      $_SESSION['status'] = "No token Available";
      header("Location: password_reset.php");
      exit(0);
    }
  }else{
    $_SESSION['status'] = "Password Did Not match!";
    header("Location: password_reset.php");
    exit(0);
  }
}

?>
