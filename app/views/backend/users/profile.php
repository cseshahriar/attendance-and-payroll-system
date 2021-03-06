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

    <div class="alert alert-success alert-dismissible mt20" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <span class="result"><i class="icon fa fa-check"></i>  
        <span class="message"></span>     
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
                <h3 class="box-title">Contact</h3> 
              </div>
              <!-- /.box-header -->
              <div class="box-body">
               <!--  <strong><i class="fa fa-book margin-r-5"></i></strong> -->   
               <p><?= $_SESSION['user_email'] ?></p> 
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
              <li><a href="#timeline" data-toggle="tab">Change Password</a></li> 
            </ul>

            <div class="tab-content">  

              <div class="tab-pane <?php if( isset($_POST['name_email']) || !isset($_POST['change_password']) ) { echo 'active'; }  ?>" id="settings">      
                <form class="form-horizontal" action="<?= ROOTURL.'/admin/profile/' ?>" method="post" enctype="multipart/form-data">      

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
                    <label for="photo" class="col-sm-2 control-label">Photo</label>

                    <div class="col-sm-10">
                      <input type="file" name="photo" class="form-control" id="photo">  
                      <p class="text-danger"><?= $data['photo_error'] ?></p>  
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
                    <div class="col-sm-12">  
                      <button type="submit" name="name_email" class="btn btn-success float-left">Save Changes</button>  
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane <?php if(isset($_POST['change_password'])) { echo 'active'; } ?>" id="timeline">

                <form id="password-form">      

                <div class="box-body">   
    
                  <div class="form-group"> 
                    <label for="password" class="col-sm-3 control-label">Password</label>  

                    <div class="col-sm-9"> 
                      <input type="password" name="password" class="form-control" id="password" placeholder="Please type current Password for update it">
                      <p class="text-danger password_error"></p>   
                    </div> 
                  </div>
                 
              
                  <div class="form-group"> 
                    <label for="password" class="col-sm-3 control-label">Confirm Password</label>

                    <div class="col-sm-9"> 
                      <input type="password" class="form-control" name="conf_password" id="conf_password" placeholder="Confirm Password">
                      <p class="text-danger conf_password_error"></p> 
                    </div>
                  </div> 
                 
              
                  <div class="form-group">
                    <label for="curent_password" class="col-sm-3 control-label">Current password</label>

                    <div class="col-sm-9"> 
                      <input type="password" class="form-control" name="current_password" id="curent_password" placeholder="Please type current Password for update it">  
                      <p class="text-danger current_password_error"></p>        
                    </div> 
                  </div>
                
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-success">Change Password</button>  
                </div>
               </form>

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