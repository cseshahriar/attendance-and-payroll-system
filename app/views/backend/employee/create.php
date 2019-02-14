<?php require_once APPROOT.'/views/backend/layouts/header.php'; ?>  
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Employee Create
      </h1>
      <ol class="breadcrumb"> 
        <li><a href="<?= ROOTURL.'/admin/dashboard' ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= ROOTURL.'/employee/index' ?>">Employee</a></li>
        <li><a class="active" href="<?= ROOTURL.'/employee/store' ?>">Register</a></li> 
      </ol>
    </section>  

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">
        <div class="col-md-12">
              <div class="box-body">    

            <form class="form-horizontal" action="<?= ROOTURL.'/employee/store' ?>" enctype="multipart/form-data" method="post">       
                <div class="row">

                  <div class="col-md-6">
                      <!-- employee_id uniqueid -->  
                    <div class="form-group <?php echo (!empty($data['firstname_error'])) ? 'has-error' : ''; ?>">
                      <label for="firstname" class="col-sm-3 control-label">First Name <span class="text-danger">*</span></label>
                      <div class="col-sm-9"> 
                          <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="<?php if(isset($_POST['firstname'])) { echo $_POST['firstname']; } ?>">      
                          <p class="text-danger"><?= $data['firstname_error'] ?></p>   
                      </div>  
                    </div>  

                    <div class="form-group <?php echo (!empty($data['lastname_error'])) ? 'has-error' : ''; ?>">
                      <label for="lastname" class="col-sm-3 control-label">Last Name <span class="text-danger">*</span></label>
                      <div class="col-sm-9"> 
                          <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="<?php if(isset($_POST['lastname'])) { echo $_POST['lastname']; } ?>">  
                         <p class="text-danger"><?= $data['lastname_error'] ?></p>    
                      </div>  
                    </div>   

                    <div class="form-group <?php echo (!empty($data['email_error'])) ? 'has-error' : ''; ?>"> 
                        <label for="email" class="col-sm-3 control-label">Email address <span class="text-danger">*</span></label>
                        <div class="col-sm-9"> 
                          <input type="text" name="email" class="form-control" placeholder="Email" value="<?= $data['email'] ?>"> 
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

                     <div class="form-group <?php echo (!empty($data['address_error'])) ? 'has-error' : ''; ?>">
                      <label for="address" class="col-sm-3 control-label">Address <span class="text-danger">*</span></label> 
                      <div class="col-sm-9"> 
                        <textarea name="address" id="address" cols="3" rows="3" class="form-control" placeholder="Address"><?php if(isset($_POST['address'])) { echo $_POST['address']; } ?></textarea>   
                        <p class="text-danger"><?= $data['address_error'] ?></p>       
                      </div>  
                    </div> 
                  </div>

                  <div class="col-md-6">
                    
                    <div class="form-group <?php echo (!empty($data['birthdate_error'])) ? 'has-error' : ''; ?>">
                      <label for="birthday" class="col-sm-3 control-label">Birthday <span class="text-danger">*</span></label>
                      <div class="col-sm-9"> 
                        <input type="text" class="form-control date" id="birthday" name="birthdate" placeholder="Birthday" value="<?php if(isset($_POST['birthdate'])) { echo $_POST['birthdate']; } ?>">         
                        <p class="text-danger"><?= $data['birthdate_error'] ?></p>     
                      </div>   
                      
                    </div>   

                    <div class="form-group <?php echo (!empty($data['contact_error'])) ? 'has-error' : ''; ?>">
                      <label for="contact_info" class="col-sm-3 control-label">Contact <span class="text-danger">*</span></label> 
                      <div class="col-sm-9"> 
                        <input type="text" name="contact_info" id="contact_info" class="form-control" placeholder="Contact Number" value="<?php if(isset($_POST['contact_info'])) { echo $_POST['contact_info']; } ?>">
                        <p class="text-danger"><?= $data['contact_error'] ?></p>       
                      </div>  
                    </div>

                    <div class="form-group <?php echo (!empty($data['gender_error'])) ? 'has-error' : ''; ?>">
                      <label for="gender" class="col-sm-3 control-label">Gender <span class="text-danger">*</span></label>  
                      <div class="col-sm-9"> 
                        <select name="gender" id="gender" class="form-control">
                          <option value="" selected>--Select Gender--</option>   
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>   
                        </select> 
                       <p class="text-danger"><?= $data['gender_error'] ?></p>    
                      </div>  
                    </div>

                    <div class="form-group <?php echo (!empty($data['position_error'])) ? 'has-error' : ''; ?>">
                      <label for="position_id" class="col-sm-3 control-label">Position <span class="text-danger">*</span></label> 
                      <div class="col-sm-9"> 
                        <select name="position_id" id="position_id" class="form-control">
                          <option value="" selected>--Select Position--</option>     
                          <?php foreach($data['positions'] as $position) : ?>
                          <option value="<?= $position->id ?>"> <?= $position->description ?> </option>  
                          <?php endforeach; ?>  
                        </select>
                       <p class="text-danger"><?= $data['position_error'] ?></p>         
                      </div>  
                    </div>

                    <div class="form-group <?php echo (!empty($data['schedule_error'])) ? 'has-error' : ''; ?>">
                      <label for="schedule" class="col-sm-3 control-label">Schedule <span class="text-danger">*</span></label>   
                      <div class="col-sm-9"> 
                        <select name="schedule_id" id="schedule_id" class="form-control">
                          <option value="" selected>--Select Schedule--</option>    
                           <?php foreach($data['schedules'] as $schedule) : ?>
                          <option value="<?= $schedule->id ?>"> <?= $schedule->in_time ?> - <?= $schedule->out_time ?> </option>
                          <?php endforeach; ?>    
                        </select>
                        <p class="text-danger"><?= $data['schedule_error'] ?></p>    
                      </div>  
                    </div>    

                    <div class="form-group <?php echo (!empty($data['photo_error'])) ? 'has-error' : ''; ?>">
                      <label for="photo" class="col-sm-3 control-label">Photo</label>   
                      <div class="col-sm-9"> 
                        <input type="file" class="form-control-file" name="photo">         
                      </div>  
                      <p class="text-danger"><?= $data['photo_error'] ?></p>       
                    </div> 
                  </div>

                  <div class="form-group">     
                    <div class="col-sm-12">  
                      <button type="submit" class="btn btn-success btn-block">Register</button>   
                    </div>  
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


  