<?php require_once APPROOT.'/views/backend/layouts/header.php'; ?> 	
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User information
        <small>Update</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= ROOTURL.'/admin/index'?>"><i class="fa fa-dashboard"></i> Users</a></li>
        <li class="active">Change</li>  
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid"> 
    	<div class="row">
    		<div class="col-md-8 offset-md-2"> 
		    	<div class="card">
					<div class="card-body"> 
						<?php if($_SESSION['user_type'] == 'superadmin') : ?>   
					    <h5 class="card-title">Update this account</h5>       
				
						<form action="<?= ROOTURL.'/admin/update/'.$data['user']->id ?>" method="post">        
							 <div class="form-group <?php echo (!empty($data['name_error'])) ? 'has-error' : ''; ?>"> 
								<label for="name">Name <span class="text-danger">*</span></label> 
								<input type="text" name="name" class="form-control" placeholder="Name" value="<?= $data['user']->name ?>">    
								 <small class="text-danger"><?= $data['name_error'] ?></small>  
							 </div>  

							<div class="form-group <?php echo (!empty($data['email_error'])) ? 'has-error' : ''; ?>"> 
							    <label for="email">Email address <span class="text-danger">*</span></label>
							    <input type="text" name="email" class="form-control" placeholder="Email" value="<?= $data['user']->email ?>">  
							    <small class="text-danger"><?= $data['email_error'] ?></small>  
							</div> 

							<div class="form-group <?php echo (!empty($data['type_error'])) ? 'has-error' : ''; ?>">
							    <label for="type">User Type <span class="text-danger">*</span></label> 
							    <select name="type" id="type" class="form-control">
							    	
							    	<option value="">-- Select User Type --</option>     
							    	<option value="admin" <?php if($data['user']->type == 'admin') { echo 'selected'; } ?> >Admin</option>

							    	<option value="superadmin" <?php if($data['user']->type == 'superadmin') { echo 'selected'; } ?> >Super Admin</option>        
							    
							    </select>
							    <small class="text-danger"><?= $data['type_error'] ?></small>  

							    <small class="text-success">
							    	<?php if($data['user']->type == 'superadmin'){ echo 'Welcome Superadmin, Please keep it.'; } ?>
							    </small>   
							</div>    

							<div class="form-group">
									<button type="submit" class="btn btn-success btn-block">Save</button>   
							</div>   
						</form> 
						<?php else: ?>
							<h3 class="card-title text-danger">Access denied!</h3>    
						<?php endif; ?>

					</div>
				</div> 
    		</div>
    	</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php require_once APPROOT.'/views/backend/layouts/footer.php'; ?>     