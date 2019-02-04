<?php require_once APPROOT.'/views/backend/layouts/header.php'; ?>  
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Employee List
      </h1>
      <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Employee</li>
      </ol>
    </section>  

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box">
          <div class="box-header" style="border-bottom: 1px solid #f4f4f4;"> 
            <h3 class="box-title">
              <a href="<?= ROOTURL.'/employee/store' ?>" class="btn btn-sm btn-primary">
                  <i class="fa fa-plus"></i> New  
              </a> 
              <?php flash('message'); ?>    
            </h3> 
          </div>

          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Photo</th> 
                <th>Address</th>
                <th>Position</th>
                <th>Schedule</th>
                <th>Member Since</th>
                <th>Tools</th>
              </tr>
              </thead>
              <tbody>
              <!-- loop -->
              <?php foreach($data['employees'] as $employee) : ?>
              <tr>
                <td><?= $employee->employee_id ?></td>
                <td><?= $employee->firstname ?> <?= $employee->lastname ?></td> 
                <td>
                  <img src="<?= ROOTURL.'/public/uploads/employee/'.$employee->photo ?>" alt="" height="30" style="margin-right: 10px">
                  
                  <a href="#employee-photo-<?= $employee->id ?>" type="button" data-toggle="modal" data-target="#employee-photo-<?= $employee->id ?>"> 
                      <i class="fa fa-pencil-square"></i>    
                  </a>   
                  <!-- employee photo edit  -->
                    <div class="modal fade" id="employee-photo-<?= $employee->id ?>">    
                      <div class="modal-dialog">
                        <div class="modal-content">
                          
                          <div class="modal-header">
                            <button type="button" class="close btn btn-primary" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">Change Photo</h4> 
                          </div>

                          <div class="modal-body">
                            <!-- form start -->
                            <form class="form-horizontal" action="<?= ROOTURL.'/employee/changePhoto' ?>" method="post">
                              <div class="box-body">    

                                <div class="form-group" style="margin-bottom: 15px">  
                                  <label for="oldphoto" class="col-sm-4 control-label">Photos</label>

                                  <div class="col-sm-8">  
                                    <input type="hidden" name="oldphoto" value="<?= $employee->photo ?>">  
                                     <img src="<?= ROOTURL.'/public/uploads/employee/'.$employee->photo ?>" alt="" height="80" style="margin-right: 10px">
                                  </div>  
                                </div>
              
                                <div class="form-group">
                                  <label for="employee_id" class="col-sm-4 control-label">Change Photos</label>
                                  <div class="col-sm-8">  
                                    <input type="file" class="form-control-file" name="image">   
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
                    <!-- / employee photo edit  -->
                </td> 
                <td><?= $employee->address ?></td>
                <td><?= $employee->description ?></td> 
                <td><?= date('h:i a',strtotime($employee->in_time)) ?> - <?= date('h:i a',strtotime($employee->out_time)) ?></td>
                <td><?= date('d-m-Y', strtotime($employee->created_at)) ?></td> 
                <td>
                  <!-- edit -->
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-employee">  
                  <i class="fa fa-pencil-square"></i> Edit
                  </button>  
                
                    <div class="modal fade" id="edit-employee-">      
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title">Update Employee</h4>
                            </div>
                          </div>
                          <!-- /.modal-content --> 
                        </div>
                        <!-- /.modal-dialog -->
                    </div>   
                 <!-- / edit -->   

                  <form action="<?= ROOTURL.'/employee/delete/'?>" method="post" style="display: inline;">   
                      <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this ?');"> 
                      <i class="fa fa-trash"></i> Delete 
                    </button>
                  </form>  
                </td>
              </tr> 
            <?php endforeach; ?>
              <!-- loop -->
              </tbody>
              <tfoot>
              <tr>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Photo</th>
                <th>Address</th>
                <th>Position</th>
                <th>Schedule</th>
                <th>Member Since</th>
                <th>Tools</th>  
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


  