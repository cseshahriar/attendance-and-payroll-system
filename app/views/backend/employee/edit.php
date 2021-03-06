<?php require_once APPROOT.'/views/backend/layouts/header.php'; ?>  
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Employee Edit Informations
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

            <form class="form-horizontal" action="<?= ROOTURL.'/employee/update/'.$data['employeeData']->id ?>" enctype="multipart/form-data" method="post">              
                <!-- employee_id uniqueid -->

                <!-- employee id -->  
                <div class="form-group">  
                  <label for="firstname" class="col-sm-3 control-label">First Name</label>
                  <div class="col-sm-9"> 
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="<?= $data['employeeData']->firstname ?>">        
                    <p class="text-danger"><?= $data['firstname_error'] ?></p>  
                  </div>  
                </div>  

                <div class="form-group">
                  <label for="lastname" class="col-sm-3 control-label">Last Name</label>
                  <div class="col-sm-9"> 
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="<?= $data['employeeData']->lastname ?>">  
                   <p class="text-danger"><?= $data['lastname_error'] ?></p>   
                  </div>  
                </div>   

                <div class="form-group">   
                  <label for="address" class="col-sm-3 control-label">Address</label>
                  <div class="col-sm-9"> 
                    <textarea name="address" id="address" cols="3" rows="3" class="form-control"><?= $data['employeeData']->address ?></textarea>
                    <p class="text-danger"><?= $data['address_error'] ?></p>  
                  </div>  
                </div>  

                <div class="form-group">
                  <label for="birthday" class="col-sm-3 control-label">Birthday</label>
                  <div class="col-sm-9">  
                    <input type="text" class="form-control date" id="birthday" name="birthdate" placeholder="Birthday" value="<?= date('Y-m-d', strtotime($data['employeeData']->birthdate)) ?>">           
                    <p class="text-danger"><?= $data['birthdate_error'] ?></p>          
                  </div>   
                  
                </div>  

                <div class="form-group">
                  <label for="contact_info" class="col-sm-3 control-label">Contact</label> 
                  <div class="col-sm-9"> 
                    <input type="text" class="form-control" name="contact_info" id="contact_info" value="<?= $data['employeeData']->contact_info ?>" title="Contact number">   
                    <p class="text-danger"><?= $data['contact_error'] ?></p>       
                  </div>  
                </div>

                <div class="form-group">  
                  <label for="gender" class="col-sm-3 control-label">Gender</label> 
                  <div class="col-sm-9"> 
                    <select name="gender" id="gender" class="form-control">
                      <option value="">--Select Gender--</option>    
                      <option value="Male" <?php if( $data['employeeData']->gender == 'Male') { echo 'selected';  } ?> >Male</option> 
                      <option value="Female"  <?php if( $data['employeeData']->gender == 'Female') { echo 'selected'; } ?> >Female</option>     
                    </select>
                   <p class="text-danger"><?= $data['gender_error'] ?></p>       
                  </div>  
                </div>

                <div class="form-group">
                  <label for="position_id" class="col-sm-3 control-label">Position</label> 
                  <div class="col-sm-9"> 
                    <select name="position_id" id="position_id" class="form-control">
                      <option value="">--Select Position--</option>     
                          
                      <?php foreach($data['positions'] as $position) : ?>
                        <option value="<?= $position->id ?>"  <?php if($data['employeeData']->position_id == $position->id) { echo 'selected'; }?>>   
                            <?= $position->description ?>      
                         </option>   
                      <?php endforeach; ?>  
                    </select>
                   <p class="text-danger"><?= $data['position_error'] ?></p>         
                  </div>  
                </div>

                <div class="form-group">
                  <label for="schedule" class="col-sm-3 control-label">Schedule</label>   
                  <div class="col-sm-9"> 
                    <select name="schedule_id" id="schedule_id" class="form-control">
                      
                      <option value="">--Select Schedule--</option>       
                      
                      <?php foreach($data['schedules'] as $schedule) : ?>
                      <option value="<?= $schedule->id ?>"  <?php if($data['employeeData']->schedule_id == $schedule->id) { echo 'selected'; }?>>   
                        <?= $schedule->in_time ?> - <?= $schedule->out_time ?>  
                      </option> 
                      <?php endforeach; ?>     
                    </select>
                    <p class="text-danger"><?= $data['schedule_error'] ?></p>     
                  </div>  
                </div>    

                <div class="form-group">
                  <label for="photo" class="col-sm-3 control-label">Photo</label>    
                  <div class="col-sm-9"> 
                    <input type="file" class="form-control-file" name="photo">      
                    <input type="hidden" name="oldphoto" value="<?= $data['employeeData']->photo ?>">   
                  </div>  
                  <p class="text-danger"><?= $data['photo_error'] ?></p>   
                </div>

                <div class="form-group"> 
                  <label class="col-sm-3"></label>    
                  <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary">Save</button>     
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


  