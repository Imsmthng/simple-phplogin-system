<?php
if(!isset($_SESSION)){
  session_start();
}
include('dbconnect.php');

if(isset($_POST['login_btn'])){
  if(!empty(trim($_POST['username'])) && !empty(trim($_POST['password']))){
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    //check user table
    $login_sql = "SELECT * FROM users WHERE username = '$username';";
    $login_sql_run = mysqli_query($con, $login_sql);
    $login_rows = mysqli_num_rows($login_sql_run);

    if($login_rows > 0){
      $row = mysqli_fetch_array($login_sql_run);
      if($row['verify_status'] == 1){
        $hashed_password = $row['password'];
        $verify = password_verify($password, $hashed_password);
        if($verify){
          $_SESSION['authenticated'] = TRUE;
          $user_data_sql = "SELECT * FROM users WHERE username='$username';";
          $check_user = mysqli_query($con, $user_data_sql);
          $check_user_row = mysqli_num_rows($check_user);

          if($check_user_row){
            while($row = mysqli_fetch_array($check_user)){
              $_SESSION['auth_user'] = [
                'userID' => $row['userID'],
                'username' => $row['username'],
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'email' => $row['email'],
                'sex' => $row['sex'],
                'image' => $row['user_image']
              ];
            }
          }
          $_SESSION['status'] = "Successfully Login!";
          header("Location:dashboard.php");
        }else{
          $_SESSION['status'] = "Invalid Email or Password";
          header("Location: index.php");
          exit(0);
        }
      }else{
        $_SESSION['status'] = "Please Verify your Email to Login";
        header("Location: index.php");
        exit(0);
      }
    }else{
      $_SESSION['status'] = "Invalid Email or Password";
      header("Location: index.php");
      exit(0);
    }
  }
}

?>
