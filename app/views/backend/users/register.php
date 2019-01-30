<?php require_once APPROOT.'/views/backend/layouts/header.php'; ?> 	
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Page Header
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid"> 
    	<div class="row">
    		<div class="col-md-8 offset-md-2"> 
		    	<div class="card">
					<div class="card-body"> 
					    <h5 class="card-title">Create An Account</h5>   
					    <p>Please fill out this form to register with us.</p>
						<form action="<?= ROOTURL ?>/admins/register" method="post">    
							  <div class="form-group <?php echo (!empty($data['name_error'])) ? 'has-error' : ''; ?>">
								<label for="name">Name <span class="text-danger">*</span></label> 
								<input type="text" name="name" class="form-control" placeholder="Name" value="<?= $data['name'] ?>"> 
								 <small class="text-danger"><?= $data['name_error'] ?></small>  
							  </div> 

							  <div class="form-group <?php echo (!empty($data['email_error'])) ? 'has-error' : ''; ?>"> 
							    <label for="email">Email address <span class="text-danger">*</span></label>
							    <input type="text" name="email" class="form-control" placeholder="Email" value="<?= $data['email'] ?>"> 
							    <small class="text-danger"><?= $data['email_error'] ?></small>  
							  </div>

							  <div class="form-group <?php echo (!empty($data['password_error'])) ? 'has-error' : ''; ?>">
							    <label for="password">Password <span class="text-danger">*</span></label>
							     <input type="password" name="password" class="form-control" placeholder="Password" value="<?= $data['password'] ?>"> 
							    <small class="text-danger"><?= $data['password_error'] ?></small>  
							  </div> 

							  <div class="form-group <?php echo (!empty($data['confirm_password_error'])) ? 'has-error' : ''; ?>">
							    <label for="password">Confirm Password <span class="text-danger">*</span></label>
							    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Pasword" value="<?= $data['confirm_password'] ?>">  
							    <small class="text-danger"><?= $data['confirm_password_error'] ?></small> 
							  </div>  

							  <div class="form-group">
									<button type="submit" class="btn btn-success btn-block">Register</button>  
							  </div>   
						</form> 
					</div>
				</div> 
    		</div>
    	</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php require_once APPROOT.'/views/backend/layouts/footer.php'; ?>     