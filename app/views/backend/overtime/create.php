<?php require_once APPROOT.'/views/backend/layouts/header.php'; ?>  
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Overtime 
        <small>Create</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= ROOTURL.'/overtime/dashboard' ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= ROOTURL.'/overtime/index' ?>">Overtime</a></li>
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
                        <h3 class="box-title">Add Overtime</h3> 
                      </div>
                      <div class="box-body">
                       <form action="<?= ROOTURL.'/overtime/create' ?>" method="post"> 

                          <div class="form-group">
                            <label>Employee ID:</label> 

                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-users"></i>  
                              </div>
                              <select name="employee_id" id="employee_id" class="form-control" required>  
                                <option value="" selected>-- Select Employee ID --</option>
                                <?php foreach($data['employees'] as $employee ) : ?>
                                <option value="<?= $employee->employee_id ?>">
                                  <?= $employee->employee_id.' - '.$employee->firstname.' '.$employee->lastname ?> 
                                  </option> 
                                <?php endforeach; ?>  
                              </select>
                            </div>
                            <!-- /.input group -->
                          </div>
                          <!-- /.form group -->

                          <!-- hours -->
                          <div class="form-group">
                            <label>No.of Hours:</label>

                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                              </div> 
                              <input type="text" name="hours" value="" class="timepicker form-control pull-right">
                            </div>  
                            <!-- /.input group -->
                            <p class="text-danger"><?= $data['hours_error'] ?></p>
                          </div>
                          <!-- /.form group -->

                          <!-- Date and time range -->
                          <div class="form-group">
                            <label>Rate: </label>   

                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-usd"></i> 
                              </div>
                              <input type="text" name="rate" class="form-control pull-right">  
                            </div>
                            <!-- /.input group -->
                            <p class="text-danger"><?= $data['rate_error'] ?></p>
                          </div>
                          <!-- /.form group -->

                           <!-- Date -->
                          <div class="form-group">
                            <label>Date:</label>

                            <div class="input-group date">
                              <div class="input-group-addon"> 
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" name="overtime_date" id="datepicker">     
                            </div>
                            <!-- /.input group -->
                            <p class="text-danger"><?= $data['overtime_date_error'] ?></p>
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


  