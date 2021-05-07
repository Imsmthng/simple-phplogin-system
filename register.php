<?php
include('includes/header.php');
include('styles/register_style.php')
?>

<div class="py-5">

  <div class="signup-form">
      <form action="" method="POST">
  		<h2>Register</h2>
        <div class="form-group">
  			<div class="row">
  				<div class="col"><input type="text" class="form-control" name="first_name" placeholder="First Name" required="required"></div>
  				<div class="col"><input type="text" class="form-control" name="last_name" placeholder="Last Name" required="required"></div>
  			</div>
        </div>
          <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Username" required="required">
           </div>
          <div class="form-group">
          	<input type="text" class="form-control" name="email" placeholder="Email" required="required">
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col">
                <input type="text" class="form-control" name="phone_number" placeholder="Mobile Number" required="required">
              </div>
              <div class="col-md-4">
                <select class="form-control" name="gender">
                  <option value="" disabled selected>Gender</option>
                  <option value="">Male</option>
                  <option value="">Female</option>
                  <option value="">Custom</option>
                </select>
              </div>
            </div>
          </div>
  		    <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password" required="required">
          </div>
  		    <div class="form-group">
              <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required="required">
          </div>
  		    <div class="form-group">
              <button type="submit" class="btn btn-success btn-lg btn-block">Register Now</button>
          </div>
      </form>
  	<div class="text-center">Already have an account? <a href="index.php">Sign in</a></div>
  </div>

</div>

<?php
include('includes/footer.php');
?>
