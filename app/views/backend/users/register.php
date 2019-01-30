<?php require_once APPROOT.'/views/inc/header.php'; ?> 	   
<div class="row">
<div class="col-lg-6 mx-auto">
	<div class="card" style="width: 30rem;">
		 <div class="card-body">
		    <h5 class="card-title">Create An Account</h5>   
		    <p>Please fill out this form to register with us.</p>
			<form action="<?= URLROOT ?>/users/register" method="post">  
				  <div class="form-group">
					<label for="name">Name <span class="text-danger">*</span></label> 
					<input type="text" name="name" class="form-control <?php echo (!empty($data['name_error'])) ? 'is-invalid' : ''; ?>" placeholder="Name" value="<?= $data['name'] ?>"> 
					 <small class="invalid-feedback"><?= $data['name_error'] ?></small>  
				  </div>

				  <div class="form-group"> 
				    <label for="email">Email address <span class="text-danger">*</span></label>
				    <input type="text" name="email" class="form-control <?php echo (!empty($data['email_error'])) ? 'is-invalid' : ''; ?>" placeholder="Email" value="<?= $data['email'] ?>"> 
				    <small class="invalid-feedback"><?= $data['email_error'] ?></small>  
				  </div>

				  <div class="form-group">
				    <label for="password">Password <span class="text-danger">*</span></label>
				     <input type="password" name="password" class="form-control <?php echo (!empty($data['password_error'])) ? 'is-invalid' : ''; ?>" placeholder="Password" value="<?= $data['password'] ?>"> 
				    <small class="invalid-feedback"><?= $data['password_error'] ?></small>  
				  </div>

				  <div class="form-group">
				    <label for="password">Confirm Password <span class="text-danger">*</span></label>
				    <input type="password" name="confirm_password" class="form-control <?php echo (!empty($data['confirm_password_error'])) ? 'is-invalid' : ''; ?>" placeholder="Confirm Pasword" value="<?= $data['confirm_password'] ?>">  
				    <small class="invalid-feedback"><?= $data['confirm_password_error'] ?></small> 
				  </div> 
				  <div class="row"> 
				  	<div class="col">
						<button type="submit" class="btn btn-success btn-block">Register</button>  
				  	</div>
				  	<div class="col">
				  		<a class="btn btn-light btn-block" href="<?= URLROOT ?>/users/login">Have an account? login</a>
				  	</div>
				  </div>
			</form>
		</div>
	</div> 
</div>
	</div>
</div>
<?php require_once APPROOT.'/views/inc/footer.php'; ?>   