<?php
if(!isset($_SESSION)){
  session_start();
}

if(!isset($_SESSION['authenticated'])){
  $_SESSION['status'] = "Please Login first";
  header("Location: index.php");
  exit(0);
}

$page_title = "User Dashboard";
include('includes/header.php');
include('login_process.php');
?>

<div class="py-5">
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

        <div class="card">
          <div class="card-header" style="background: #133337; color: #fff;">
            <h4>Dashboard</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col">
                <form action="login_process.php" method="post" enctype="multipart/form-data">

                  <div class="form-group mb-2">
                    <label for=""><b>Username: </b><?php echo $_SESSION['auth_user']['username']?> </label>
                  </div>
                  <div class="form-group mb-2">
                    <label for=""><b>First Name: </b><?= $_SESSION['auth_user']['first_name']?> </label>
                  </div>
                  <div class="form-group mb-2">
                    <label for=""><b>Last Name: </b><?= $_SESSION['auth_user']['last_name']?> </label>
                  </div>
                  <div class="form-group mb-2">
                    <label for=""><b>Email: </b><?= $_SESSION['auth_user']['email']?> </label>
                  </div>
                  <div class="form-group mb-2">
                    <label for=""><b>Gender: </b><?= $_SESSION['auth_user']['sex']?> </label>
                  </div>

                  <div class="form-group text-center">
                    <a class="btn btn-danger" href="logout.php">Logout</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include('includes/footer.php');
?>
