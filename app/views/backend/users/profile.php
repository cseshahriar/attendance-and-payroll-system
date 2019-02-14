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

              <div class="tab-pane active" id="settings">   
                <form class="form-horizontal" action="" method="post">

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
        
                  <div class="form-group"> 
                    <label for="password" class="col-sm-2 control-label">Current password</label>

                    <div class="col-sm-10"> 
                      <input type="password" class="form-control" id="password" placeholder="Please type current Password for update it">
                    </div>
                  </div>
                
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-success">Submit</button>  
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="activity">
                <form class="form-horizontal">
                 
                  <div class="form-group">
                    <label for="photo" class="col-sm-2 control-label">Photo</label>

                    <div class="col-sm-10">
                      <input type="file" class="form-control-file" id="photo" placeholder="Photo">
                    </div> 
                  </div>
        
                  <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Current password</label>

                    <div class="col-sm-10"> 
                      <input type="password" class="form-control" id="password" placeholder="Please type current Password for update it">
                    </div>
                  </div>
                
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button> 
                    </div>
                  </div>
                </form> 
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="timeline">
                <form class="form-horizontal">
                 
                  <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Password</label>

                    <div class="col-sm-10"> 
                      <input type="password" class="form-control" id="password" placeholder="Please type current Password for update it">
                    </div>
                  </div>
                 
              
                  <div class="form-group"> 
                    <label for="password" class="col-sm-2 control-label">Confirm Password</label>

                    <div class="col-sm-10"> 
                      <input type="password" class="form-control" id="conf_password" placeholder="Confirm Password">
                    </div>
                  </div> 
                 
              
                  <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Current password</label>

                    <div class="col-sm-10"> 
                      <input type="password" class="form-control" id="password" placeholder="Please type current Password for update it">
                    </div>
                  </div>
                
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button> 
                    </div>
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