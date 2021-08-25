<?php
include('includes/header.php');
$page_title = "Password Reset";

if(!isset($_SESSION)){
  session_start();
}

if(isset($_SESSION['authenticated'])){
  $_SESSION['status'] = "You're currently Logged In";
  header("Location: dashboard.php");
  exit(0);
}
?>

<div class="py">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">

        <div class="alert">
          <?php
            if(isset($_SESSION['status'])){
              ?>
              <div class="alert alert-success">
                <h5><?= $_SESSION['status']; ?></h5>
              </div>
              <?php
              unset($_SESSION['status']);
            }
          ?>
        </div>

        <div class="card shadow">
          <div class="card-header text-center" style="background: #133337; color: #fff;">
            <h5>Password Reset</h5>
          </div>

          <div class="card-body">

            <form action="reset-password_process.php" method="post">
              <input type="text" hidden="hidden" name="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];} ?>" class="form-control">
              <input type="text" hidden="hidden" name="email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>" class="form-control">

              <div class="form-group mb-3">
                <label for="">New Password:</label>
                <input class="form-control" type="password" name="new_password" required='required'>
              </div>

              <div class="form-group mb-3">
                <label for="">Confirm Password:</label>
                <input class="form-control" type="password" name="confirm_password" required='required'>
              </div>

              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <button type="submit" name="update_password" class="btn btn-success">Reset Password</button>
                  </div>
                </div>

                <div class="col">
                  <div class="form-group" style="text-align:right;">
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                  </div>
                </div>

              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
