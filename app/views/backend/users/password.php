<?php require_once APPROOT.'/views/backend/layouts/header.php'; ?>  
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit User Photo
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= ROOTURL.'/admin/index'?>"><i class="fa fa-dashboard"></i> Users</a></li>
        <li class="active">Edit</li>  
      </ol>
    </section>   

    <!-- Main content -->
    <section class="content container-fluid mt-5">   
      <div class="row">
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Change Photo</h3>   
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form role="form" action="<?= ROOTURL.'/admin/password/'.$_SESSION['user_id'] ?>" method="post">   

                <div class="box-body">  
    
                  <div class="form-group"> 
                    <label for="password" class="col-sm-3 control-label">Password</label>  

                    <div class="col-sm-9"> 
                      <input type="password" name="password" class="form-control" id="password" placeholder="Please type current Password for update it">
                      <p class="text-danger">
                        <?php if(isset($data['password_error'])) { echo $data['password_error']; } ?>   
                      </p>  
                    </div> 
                  </div>
                 
              
                  <div class="form-group"> 
                    <label for="password" class="col-sm-3 control-label">Confirm Password</label>

                    <div class="col-sm-9"> 
                      <input type="password" class="form-control" name="conf_password" id="conf_password" placeholder="Confirm Password">
                      <p class="text-danger">
                        <?php if(isset($data['confirm_password_error'])) { echo $data['confirm_password_error']; } ?> 
                      </p>
                    </div>
                  </div> 
                 
              
                  <div class="form-group">
                    <label for="curent_password" class="col-sm-3 control-label">Current password</label>

                    <div class="col-sm-9"> 
                      <input type="password" class="form-control" name="curent_password" id="curent_password" placeholder="Please type current Password for update it">  
                      <p class="text-danger">
                        <?php if(isset($data['curent_password_error'])) { echo $data['curent_password_error']; } ?>
                      </p> 
                    </div> 
                  </div>
                
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-success">Update</button> 
                </div>
              </form>
            </div>
            <!-- /.box -->
        </div>
      </div>
    </section>
</div>
<?php require_once APPROOT.'/views/backend/layouts/footer.php'; ?>     



  