<?php
if(!isset($_SESSION)){
  session_start();
}

if(isset($_SESSION['authenticated'])){
  $_SESSION['status'] = "You're currently Logged in";
  header("Location:dashboard.php");
  exit(0);
}

$page_title = "Reset Password";
include('includes/header.php');
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
            <h5>Reset Password</h5>
          </div>

          <div class="card-body">
            <form action="reset-password_process.php" method="post">
              <div class="form-group mb-3">
                <label for="">Email:</label>
                <input type="text" name="email" class="form-control" required='required'>
              </div>

              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <button type="submit" name="reset_btn" class="btn btn-success">Send Link</button>
                  </div>
                </div>

                <div class="col">
                  <div class="form-group" style="text-align:right">
                    <a href="index.php" class="btn btn-primary">Go Back</a>
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
