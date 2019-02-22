<?php require_once APPROOT.'/views/backend/layouts/header.php'; ?>  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= ROOTURL.'dashboard/index' ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">User profile</li>   
      </ol> 

      <br>
      <?= flash('message') ?>   

    <div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <span class="result"><i class="icon fa fa-check"></i> 
        <span class="message"></span>    
      </span>
    </div> 

    <div class="alert alert-danger alert-danger alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <span class="result"><i class="icon fa fa-warning"></i>    
        <span class="error-message"><?= $data['photo_error'] ?></span>           
      </span>   
    </div>  

    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?= ROOTURL.'/public/uploads/admin/'.$_SESSION['user_photo'] ?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?=  $_SESSION['user_name'] ?></h3> 

              <p class="text-muted text-center">Member since Nov. <?= date('d-m-Y', strtotime($_SESSION['user_created_at'])) ?></p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <!--  <strong><i class="fa fa-book margin-r-5"></i></strong> -->   
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom"> 
           
            <ul class="nav nav-tabs">
              <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li> 
              <li><a href="#activity" data-toggle="tab">Change Photo</a></li>
              <li><a href="#timeline" data-toggle="tab">Change Password</a></li> 
            </ul>

            <div class="tab-content">  

              <div class="tab-pane <?php if( isset($_POST['name_email']) && !isset($_POST['change_photo']) || !isset($_POST['change_password']) ) { echo 'active'; }  ?>" id="settings">      
                <form class="form-horizontal" action="<?= ROOTURL.'/admin/profile/' ?>" method="post">   

                  <div class="form-group"> 
                    <label for="name" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?= $data['user']->name ?>">   
                     <p class="text-danger"><?= $data['name_error'] ?></p> 
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?= $data['user']->email ?>" >
                      <p class="text-danger"><?= $data['email_error'] ?></p>
                    </div>
                  </div>
        
                  <div class="form-group"> 
                    <label for="password" class="col-sm-2 control-label">Current password</label>

                    <div class="col-sm-10">    
                      <input type="password" name="password" class="form-control" id="password" placeholder="Please type current Password for update it">
                     <p class="text-danger"><?= $data['password_error'] ?></p>  
                    </div>
                  </div> 
                
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" name="name_email" class="btn btn-success">Save</button>  
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane <?php if(isset($_POST['change_photo'])) { echo 'active'; } ?>" id="activity">
                  <a class="btn btn-primary" href="<?= ROOTURL.'/admin/photo/'.$_SESSION['user_id'] ?>">Click Here</a>   
              </div>  
              <!-- /.tab-pane -->

              <div class="tab-pane <?php if(isset($_POST['change_password'])) { echo 'active'; } ?>" id="timeline">

                <a class="btn btn-primary" href="<?= ROOTURL.'/admin/password/'.$_SESSION['user_id'] ?>">Click Here</a>   

              </div>
              <!-- /.tab-pane -->

            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php require_once APPROOT.'/views/backend/layouts/footer.php'; ?>   