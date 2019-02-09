<?php require_once APPROOT.'/views/backend/layouts/header.php'; ?>  
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Schedule 
        <small>Edit</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= ROOTURL.'/schedule/dashboard' ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= ROOTURL.'/schedule/index' ?>">Schedule</a></li>   
        <li class="active">Edit</li>  
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
                        <h3 class="box-title">Edit Schedule</h3> 
                      </div>
                      <div class="box-body">
                       <form action="<?= ROOTURL.'/schedule/edit/'.$data['schedule']->id ?>" method="post">        
                          <!-- intime -->
                          <div class="form-group">
                            <label>In Time:</label>

                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                              </div> 
                              <input type="text" name="in_time" value="<?= $data['schedule']->in_time ?>" class="timepicker form-control pull-right">
                            </div>  
                            <!-- /.input group -->
                            <p class="text-danger"><?= $data['in_time_error'] ?></p> 
                          </div>
                          <!-- /.form group -->

                          <!-- outtime -->
                          <div class="form-group">
                            <label>Out Time:</label>  

                            <div class="input-group"> 
                              <div class="input-group-addon"> 
                                <i class="fa fa-clock-o"></i> 
                              </div> 
                              <input type="text" name="out_time" value="<?= $data['schedule']->out_time ?>" class="timepicker form-control pull-right">
                            </div>  
                            <!-- /.input group -->
                            <p class="text-danger"><?= $data['out_time_error'] ?></p> 
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


  