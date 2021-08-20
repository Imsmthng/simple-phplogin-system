<?php
if(!isset($_SESSION)){
  session_start();
}
if(isset($_SESSION['authenticated'])){
  $_SESSION['status'] = "You are currently Logged In";
  header("Location:dashboard.php");
  exit(0);
}
$page_title = "Registration Form";
include('includes/header.php');
?>

<div class="py">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

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
                <h5>Registration Form</h5>
            </div>
            <div class="card-body">
                <form action="register_process.php" method="POST">
                  <div class="form-group mb-3">
                      <label for="">Username</label>
                      <input type="text" name="username" class="form-control" required='required'>
                  </div>

                  <div class="row">
            				<div class="col">
                      <div class="form-group mb-3">
                        <label for="">First Name</label>
                        <input type="text" class="form-control" name="first_name" required="required">
                      </div>
                    </div>
            				<div class="col">
                      <div class="form-group mb-3">
                        <label for="">Last Name</label>
                        <input type="text" class="form-control" name="last_name" required="required">
                      </div>
                    </div>
            			</div>

                <div class="row">
                  <div class="col">
                    <div class="form-group mb-3">
                        <label for="">Email Address</label>
                        <input type="text" name="email" class="form-control" required='required'>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group mb-3">
                      <label for="">Sex</label>
                      <select class="form-control" name="sexID" required="required">
                        <option value="" disabled selected>Sex</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-group mb-3">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" required='required'>
                </div>

                <div class="form-group mb-3">
                    <label for="">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" required='required'>
                </div>

                <div class="form-group">
                    <button type="submit" name="register_btn" class="btn btn-success">Submit</button>
                </div>
                </form>
                <div class="text-center">Already have an account? <a href="index.php">Sign in</a></div>
            </div>
            </div>
            </div>

        </div>
    </div>
</div>


<?php
include('includes/footer.php');
?>
