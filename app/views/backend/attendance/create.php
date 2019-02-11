<?php require_once APPROOT.'/views/backend/layouts/header.php'; ?>  
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Attendance
        <small>Create</small> 
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= ROOTURL.'/dashboard/index' ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= ROOTURL.'/attendance/index' ?>">Attendances</a></li>    
        <li class="active">Create</li>    
      </ol>
    </section>

    <!-- Main content -->
    <section class="content"> 
          <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">  
                    <!-- box -->
                    <div class="box box-primary">
                      <div class="box-header"> 
                        <h3 class="box-title">Add Attendance</h3>  
                      </div>
                      <div class="box-body">
                       <form action="<?= ROOTURL.'/attendance/create' ?>" method="post">        
                          
                          <div class="form-group"> 
                            
                            <label for="employee_id">Employee ID</label>
                            
                            <div class="input-group"> 
                                <div class="input-group-addon"> 
                                  <i class="fa fa-calendar"></i> 
                                </div> 
                                <select name="employee_id" id="employee_id" class="form-control"> 
                                    <option value="" selected>-- Select Employee ID --</option> 
                                    <?php foreach($data['employees'] as $employees) : ?>
                                      <option value="<?= $employees->employee_id ?>">
                                       <?= $employees->employee_id.' - ' .$employees->firstname.' '. $employees->lastname ?>
                                      </option>   
                                    <?php endforeach; ?>  
                                </select>  
                              </div>  

                              <p class="text-danger"><?= $data['employee_error'] ?></p>  
                            </div> 


                            <div class="form-group date">
                              <label for="date">Date</label> 

                              <div class="input-group"> 
                                 <div class="input-group-addon">  
                                  <i class="fa fa-calendar"></i> 
                                  </div> 
                                
                                <input type="text" class="form-control" name="created_at" id="created_at" value="<?= date('Y-m-d') ?>" placeholder="Date">      
                              </div>  

                              <p class="text-danger"><?= $data['date_error'] ?></p> 
                            </div>  

                            <div class="form-group"> 
                              <label for="intime">In Time</label> 

                              <div class="input-group">
                                  <div class="input-group-addon"> 
                                    <i class="fa fa-clock-o"></i> 
                                  </div>  
                                  <input type="text" class="form-control timepicker" name="in_time" id="intime" placeholder="In Time"> 
                              </div> 
                              <p class="text-danger"><?= $data['intime_error'] ?></p>
                            </div>

                            <div class="form-group">
                              <label for="status">Status</label> 

                              <div class="input-group">
                                  <div class="input-group-addon"> 
                                    <i class="fa fa-clock-o"></i>   
                                  </div>  
                                 <select name="status" id="status" class="form-control">
                                   <option value="" selected>-- Select Early or Late --</option>
                                   <option value="1">Early</option>
                                   <option value="0">Late</option>
                                 </select>
                              </div>  
                                <p class="text-danger"><?= $data['status_error'] ?></p> 
                            </div>  

                            <div class="form-group">  
                              <div class="input-group">  
                                <button type="submit" class="btn btn-success">Save</button> 
                              </div>  
                            </div>   
                       </form>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
          </div>

    </section> 
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php require_once APPROOT.'/views/backend/layouts/footer.php'; ?>    


  