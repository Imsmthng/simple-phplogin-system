<?php
if(!isset($_SESSION)){
  session_start();
}
include('dbconnect.php');

if(isset($_GET['token'])){
  $token = $_GET['token'];
  $verify_query = "SELECT verify_token FROM users WHERE verify_token='$token' LIMIT 1;";
  $verify_query_run = mysqli_query($con, $verify_query);
  $verify_query_rows = mysqli_num_rows($verify_query_run);

  if($verify_query_rows > 0){
    $row = mysqli_fetch_array($verify_query_run);
    if($row['verify_status'] == 0){
      $clicked_token = $row['verify_token'];
      $update_query = "UPDATE users SET verify_status=1 WHERE verify_token='$clicked_token' LIMIT 1;";
      $update_query_run = mysqli_query($con, $update_query);

      if($update_query_run){
        $_SESSION['status'] = "Verification Completed, You can now Login!";
        header("Location:index.php");
        exit(0);
      }else{
          $_SESSION['status'] = "Verification Failed!";
          header("Location:index.php");
          exit(0);
      }
    }else{
      $_SESSION['status'] = "Email is Verified. You can now Login";
      header("Location:index.php");
    }
  }else{
    $_SESSION['status'] = "Token doesn't exist";
    header("Location:index.php");
  }

}else{
  $_SESSION['status'] = "Not Allowed";
  header("Location:login.php");
}
?>
