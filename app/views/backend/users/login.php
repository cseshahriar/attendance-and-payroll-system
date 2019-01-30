<?php require_once APPROOT.'/views/inc/header.php'; ?> 	   
<div class="row">
<div class="col-lg-6 mx-auto">
	<div class="card" style="width: 30rem;">
		 <div class="card-body">
		    <h5 class="card-title">User Login</h5>     
			<!-- flash message -->
		    <?php flash('register_success'); ?>  
		    <?php flash('logout_success'); ?>   

			<form action="<?= URLROOT ?>/users/login" method="post">  

				  <div class="form-group"> 
				    <label for="email">Email address <span class="text-danger">*</span></label>
				    <input type="text" name="email" class="form-control <?php echo (!empty($data['email_error'])) ? 'is-invalid' : ''; ?>" placeholder="Email" value="<?= $data['email'] ?>"> 
				    <small class="invalid-feedback"><?= $data['email_error'] ?></small>    
				  </div>

				  <div class="form-group">
				    <label for="password">Password <span class="text-danger">*</span></label>
				     <input type="password" name="password" class="form-control <?php echo (!empty($data['password_error'])) ? 'is-invalid' : ''; ?>" placeholder="Email" value="<?= $data['password'] ?>"> 
				    <small class="invalid-feedback"><?= $data['password_error'] ?></small>  
				  </div>

				  <div class="row">
				  	<div class="col">
						<button type="submit" class="btn btn-success btn-block">Login</button>  
				  	</div>
				  	<div class="col"> 
				  		<a class="btn btn-light btn-block" href="<?= URLROOT ?>/users/register">No account? register</a> 
				  	</div>
				  </div>
			</form>
		</div>
	</div> 
</div>
	</div>
</div>
<?php require_once APPROOT.'/views/inc/footer.php'; ?>   