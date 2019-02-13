<?php require_once APPROOT.'/views/backend/layouts/header.php'; ?>  
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Attendance
        <small>Edit</small> 
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= ROOTURL.'/dashboard/index' ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= ROOTURL.'/attendance/index' ?>">Attendances</a></li>    
        <li class="active">Change</li>    
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
                       <form action="<?= ROOTURL.'/attendance/edit/'.$data['attendance']->id ?>" method="post">         
                          <div class="form-group"> 
                            
                            <label for="employee_id">Employee ID</label> 
                            
                            <div class="input-group"> 
                                <div class="input-group-addon">  
                                  <i class="fa fa-user"></i> 
                                </div> 
                                <input type="text" value="<?= $data['attendance']->employee_id.' '.$data['attendance']->firstname.' '.$data['attendance']->lastname ?>" disabled class="form-control">  
                              </div>  
 
                            </div> 


                            <div class="form-group date">
                              <label for="date">Date</label> 

                              <div class="input-group"> 
                                 <div class="input-group-addon">  
                                  <i class="fa fa-calendar"></i> 
                                  </div> 
                                
                                <input type="text" class="form-control" name="created_at" id="created_at" value="<?= $data['attendance']->created_at ?>" placeholder="Date">      
                              </div>  

                              <p class="text-danger"><?= $data['date_error'] ?></p> 
                            </div>  

                            <div class="form-group"> 
                              <label for="intime">In Time</label> 

                              <div class="input-group">
                                  <div class="input-group-addon"> 
                                    <i class="fa fa-clock-o"></i> 
                                  </div>  
                                  <input type="text" class="form-control timepicker" name="in_time" id="intime" placeholder="In Time" value="<?= $data['attendance']->in_time ?>"> 
                              </div> 
                              <p class="text-danger"><?= $data['intime_error'] ?></p>
                            </div>

                            <div class="form-group">
                              <label for="outtime">Out Time</label> 

                              <div class="input-group">
                                  <div class="input-group-addon"> 
                                    <i class="fa fa-clock-o"></i>   
                                  </div>  
                                  <input type="text" class="form-control timepicker" name="out_time" id="outtime" placeholder="Out Time" value="<?= $data['attendance']->out_time ?>">  
                              </div>  
                                <p class="text-danger"><?= $data['outtime_error'] ?></p>
                            </div>  

                              <div class="form-group">
                              <label for="status">Status</label> 

                              <div class="input-group">
                                  <div class="input-group-addon"> 
                                    <i class="fa fa-clock-o"></i>    
                                  </div>  
                                 <select name="status" id="status" class="form-control">
                                   <option value="">-- Select Early or Late --</option>  
                                   <option value="1" <?php if($data['attendance']->status == 1) { echo 'selected'; } ?> >Early</option>
                                   <option value="0" <?php if($data['attendance']->status == 0) { echo 'selected'; } ?>>Late</option>  
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


  