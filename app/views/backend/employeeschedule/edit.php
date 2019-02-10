<?php require_once APPROOT.'/views/backend/layouts/header.php'; ?>  
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Employee Schedule 
        <small>Edit</small> 
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= ROOTURL.'/dashboard/index' ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= ROOTURL.'/employeeschedule/index' ?>">Employee Schedule</a></li>   
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
                        <h3 class="box-title">Edit Employee Schedule</h3>  
                      </div>
                      <div class="box-body">
                       <form action="<?= ROOTURL.'/employeeschedule/edit/'.$data['empScheduleById']->id ?>" method="post">           
                          
                          <!-- intime -->
                          <div class="form-group"> 
                            <label>Employee:</label>

                            <div class="input-group">
                              <div class="input-group-addon">    
                                <i class="fa fa-user"></i>
                              </div> 
                              <input type="text" disabled="" value="<?= $data['empScheduleById']->employee_id.' - '.$data['empScheduleById']->firstname.' '.$data['empScheduleById']->lastname ?>" class="form-control">
                            </div>  
                      
                          </div>
                          <!-- /.form group -->

                          <!-- intime -->
                          <div class="form-group"> 
                            <label>Schedule Id:</label>

                            <div class="input-group">
                              <div class="input-group-addon">    
                                <i class="fa fa-clock-o"></i>
                              </div> 
                              <select name="schedule_id" id="schedule_id" class="form-control">   
                                <option value="">-- Select Schedules --</option>
                                <?php foreach($data['schedules'] as $schedule): ?> 
                                <option value="<?= $schedule->id ?>" <?php if($data['empScheduleById']->schedule_id == $schedule->id ) { echo 'selected'; } ?> > 
                                  <?= date('h:i:s a', strtotime($schedule->in_time)).' - '.date('h:i:s a', strtotime($schedule->out_time)) ?> 
                                  </option> 
                              <?php endforeach; ?>
                              </select>
                            </div>  
                            <!-- /.input group -->
                            <p class="text-danger"><?= $data['schedule_id_error'] ?></p> 
                          </div>
                          <!-- /.form group -->

    
                          <div class="form-group"> 
                            <button type="submit" class="btn btn-success">Save</button>  
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


  