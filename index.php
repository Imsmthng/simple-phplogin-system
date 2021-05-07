<?php
include('includes/header.php');
include('styles/index_style.php');

?>

<div class="py-5">
  <div class="login-form">
      <form action="" method="POST">
      <h2>Login</h2>
          <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email" required="required">
          </div>
          <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password" required="required">
          </div>
          <div class="form-group">
              <button type="submit" class="btn btn-success btn-lg btn-block">Register Now</button>
          </div>
      </form>
    <div class="text-center">Create an account? <a href="register.php">Register Here</a></div>
  </div>
</div>

<?php
include('includes/footer.php');
?>
