<?php
if(!isset($_SESSION)){
  session_start();
}

if(isset($_SESSION['authenticated'])){
  $_SESSION['status'] = "You are currently Logged In";
  header("Location:dashboard.php");
  exit(0);
}

$page_title = "Login Form";
include('includes/header.php');
?>

<div class="py-5">
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
                <h5>Login Form</h5>
            </div>
            <div class="card-body">
                <form action="login_process.php" method="POST">
                  <div class="form-group mb-3">
                      <label for="">Username</label>
                      <input type="text" name="username" class="form-control" required='required'>
                  </div>

                <div class="form-group mb-3">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" required='required'>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                        <button type="submit" name="login_btn" class="btn btn-success">Sign in</button>
                    </div>
                  </div>
                    <div class="col">
                      <div class="form-group">
                          <div class="text-center" style="margin-top: 8px;"><a href="reset-password.php">Forgot Password</a></div>
                      </div>
                    </div>
                </div>

                </form>
                <div class="text-center">Create an Account? <a href="register.php">Register Here</a></div>
            </div>
            </div>
            </div>

        </div>
    </div>
</div>


<?php
include('includes/footer.php');
?>
