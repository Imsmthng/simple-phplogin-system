<?php
if(!isset($_SESSION)){
  session_start();
}
include('dbconnect.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

//Register new user
function sendmail_verification($first_name, $last_name, $email, $verify_token){

  $mail = new PHPMailer;
  $mail->isSMTP();
  $mail->SMTPAuth = true;

  $mail->Host = 'smtp.gmail.com';
  $mail->Username   = 'alumnitracer.plmun@gmail.com';
  $mail->Password   = 'PLMUN@osa';

  $mail->SMTPSecure = "ssl";
  $mail->Port = 465;

  $mail->setFrom("alumnitracer.plmun@gmail.com", $first_name);
  $mail->addAddress($email);

  $mail->isHTML(true);
  $mail->Subject = "Email Verification from DEVSLibrary.io";

  $email_template = "
  <h2>You have Registered with DevsLibrary.io</h2>
  <h4>Verify your email address to login with the below given link</h4>
  <br/><br/>
  <a href = 'http://localhost/simple-phplogin-system/verify-email.php?token=$verify_token'> Click Here </a>
  ";

  $mail->Body = $email_template;
  $mail->send();
}

if(isset($_POST['register_btn'])){
  $username = $_POST['username'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $sex = $_POST['sexID'];
  $password = $_POST['password'];
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  $verify_token = md5(rand());

  //check password in registration
  $matchpassword = $_POST['confirm_password'];
  if($matchpassword != $password){
    $_SESSION['status'] = "Password did not match!";
    header("Location:register.php");
  }else{
    //check username if existing in users table
    $check_username_query = "SELECT username FROM users WHERE username='$username' LIMIT 1";
    $check_username_query_run = mysqli_query($con, $check_username_query);
    $username_rows = mysqli_num_rows($check_username_query_run);

    if($username_rows > 0){
        $_SESSION['status'] = "Username Exist";
        header("Location: register.php");
    }else{
      //check email if existing in user table
        $check_email_query = "SELECT email FROM users WHERE email='$email' LIMIT 1;";
        $check_email_query_run = mysqli_query($con, $check_email_query);
        $email_rows = mysqli_num_rows($check_email_query_run);

        if($email_rows == 1){
          $_SESSION['status'] = "Email is Already Registered!";
          header("Location: register.php");
        }else{
          $query = "INSERT INTO users (username, first_name, last_name, email, sex, password, verify_token) VALUES ('$username', '$first_name', '$last_name', '$email', '$sex', '$hashed_password', '$verify_token')";
          $query_run = mysqli_query($con, $query);

          if($query_run){
              sendmail_verification("$first_name", "$last_name", "$email", "$verify_token");
              $_SESSION['status'] = "Registration Successfull! Please Verify your email address";
              header("Location: register.php");

          }else{
              $_SESSION['status'] = "Registration Failed";
              header("Location: register.php");
        }
      }
    }
  }
}//end of User Registration
?>
