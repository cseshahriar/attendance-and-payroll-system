<?php require_once APPROOT.'/views/backend/layouts/header.php'; ?>  
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Attendance
      </h1>
      <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Attendance</li>
      </ol>
    </section>  

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box">
          <div class="box-header" style="border-bottom: 1px solid #f4f4f4;"> 
            <h3 class="box-title">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                  <i class="fa fa-plus"></i> New 
              </button>
              
              <?php flash('success'); ?> 

                 <!-- new attendance -->
              <div class="modal fade" id="modal-default"> 
                <div class="modal-dialog">
                  <div class="modal-content">
                    
                    <div class="modal-header">
                      <button type="button" class="close btn btn-primary" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h4 class="modal-title">Add New</h4>
                    </div>

                    <div class="modal-body">
                      <!-- form start -->
                      <form class="form-horizontal" action="<?= ROOTURL.'/attendances/create' ?>" method="post">
                        <div class="box-body">   

                          <div class="form-group">
                            <label for="employee_id" class="col-sm-3 control-label">Employee ID</label>

                            <div class="col-sm-9"> 
                              <select name="employee_id" id="employee_id" class="form-control" required>
                                  <option value="" selected>-- Select Employee ID --</option> 
                                  <?php foreach($data['employees'] as $employees) : ?>
                                    <option value="<?= $employees->employee_id ?>"><?= $employees->employee_id ?></option> 
                                  <?php endforeach; ?> 
                              </select>
                            </div> 
                          </div>

                          <div class="form-group">
                            <label for="date" class="col-sm-3 control-label">Date</label>

                            <div class="col-sm-9"> 
                              <input type="text" class="form-control" id="date" value="<?= date('Y-m-d') ?>" name="date" placeholder="Date" required>  
                            </div>  
                          </div>  

                          <div class="form-group">
                            <label for="intime" class="col-sm-3 control-label">In Time</label>

                            <div class="col-sm-9"> 
                              <input type="text" class="form-control timepicker" name="in_time" id="intime" placeholder="Date" required> 
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="outtime" class="col-sm-3 control-label">Out Time</label>

                            <div class="col-sm-9"> 
                              <input type="text" class="form-control timepicker" name="out_time" id="outtime" placeholder="Date" required>  
                            </div>  
                          </div> 

                        </div>  
                        <!-- /.box-body -->
                        <div class="box-footer">
                          <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                          <button type="submit" class="btn btn-primary pull-right">Save</button>  
                        </div>
                        <!-- /.box-footer -->
                      </form>  
                    </div>

                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
        <!-- / new attendance -->
            </h3> 
          </div>

          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Date</th>
                <th>Employee ID</th>
                <th>Name</th>
                <th>In Time</th>
                <th>Out Time</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>
              <!-- loop -->
              <?php foreach($data['attendances'] as $attendance) : ?>
              <tr>
                <td><?= $attendance->date ?></td>
                <td><?= $attendance->employee_id ?></td> 
                <td><?= $attendance->firstname ?> <?= $attendance->lastname ?></td>
                <td><?= $attendance->in_time?></td>
                <td><?= $attendance->out_time ?></td>
                <td>
                  <a href="<?= ROOTURL.'/attendance/edit/'.$attendance->id ?>" class="btn btn-success">
                    <i class="fa fa-pencil-square"></i> Edit
                  </a>
                  <form action="<?= ROOTURL.'/attendance/delete/'.$attendance->id ?>" method="post" style="display: inline;"> 
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                  </form> 
                </td>
              </tr> 
            <?php endforeach; ?>
              <!-- loop -->
              </tbody>
              <tfoot>
              <tr>
                <th>Rendering engine</th>
                <th>Browser</th>
                <th>Platform(s)</th>
                <th>Engine version</th>
                <th>CSS grade</th>
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>  
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php require_once APPROOT.'/views/backend/layouts/footer.php'; ?>     


  