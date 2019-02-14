<?php require_once APPROOT.'/views/backend/layouts/header.php'; ?>  
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Edit Employee Access Informations
      </h1>
      <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Employee</li>
      </ol>
    </section>   

    <!-- Main content -->
    <section class="content container-fluid"> 
      <div class="row">
        <div class="col-md-8 offset-md-2">  
              <div class="box-body">     

            <form class="form-horizontal" action="<?= ROOTURL.'/employee/access/'.$data['empEmail']->id ?>" enctype="multipart/form-data" method="post">                
                <div class="form-group <?php echo (!empty($data['email_error'])) ? 'has-error' : ''; ?>"> 
                        <label for="email" class="col-sm-3 control-label">Email address <span class="text-danger">*</span></label>  
                        <div class="col-sm-9"> 
                          <input type="text" name="email" class="form-control" placeholder="Email" value="<?= $data['empEmail']->email ?>">   
                          <small class="text-danger"><?= $data['email_error'] ?></small>    
                        </div> 
                    </div> 

                    <div class="form-group <?php echo (!empty($data['password_error'])) ? 'has-error' : ''; ?>">
                      <label for="password" class="col-sm-3 control-label">Password <span class="text-danger">*</span></label>
                      <div class="col-sm-9"> 
                         <input type="password" name="password" class="form-control" placeholder="Password" value="<?= $data['password'] ?>"> 
                        <small class="text-danger"><?= $data['password_error'] ?></small>  
                      </div>
                    </div> 

                    <div class="form-group <?php echo (!empty($data['confirm_password_error'])) ? 'has-error' : ''; ?>">
                      <label for="password" class="col-sm-3 control-label">Confirm Password <span class="text-danger">*</span></label>
                      <div class="col-sm-9"> 
                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Pasword" value="">   
                        <small class="text-danger"><?= $data['confirm_password_error'] ?></small>  
                      </div>
                    </div>  

                <div class="form-group"> 
                  <label class="col-sm-3"></label>    
                  <div class="col-sm-9">
                    <button type="submit" class="btn btn-success">Save</button>      
                  </div>  
                </div>   

              </div>  
              <!-- /.box-body -->
            </form>   
        </div>
      </div>
    </section>
</div>
<?php require_once APPROOT.'/views/backend/layouts/footer.php'; ?>    


  