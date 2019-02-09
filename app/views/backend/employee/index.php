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
       <?php flash('message'); ?>     
    </section>  

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box">
          <div class="box-header" style="border-bottom: 1px solid #f4f4f4;"> 
            <h3 class="box-title">
              <a href="<?= ROOTURL.'/employee/store' ?>" class="btn btn-sm btn-primary">
                  <i class="fa fa-plus"></i> New  
              </a>     
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
                  <img src="<?= ROOTURL.'/public/uploads/employee/'.$employee->photo ?>" alt="" height="30">
                </td>  
                <td><?= $employee->description ?></td> 
                <td><?= date('h:i a',strtotime($employee->in_time)) ?> - <?= date('h:i a',strtotime($employee->out_time)) ?></td>
                <td><?= date('d-m-Y', strtotime($employee->created_at)) ?></td> 
                <td>
                  <!-- edit -->
                  <a href="<?= ROOTURL.'/employee/update/'.$employee->id ?>" class="btn btn-primary btn-sm btn-flate" onclick="return confirm('Are you sure want to update it?');">  
                  <i class="fa fa-pencil-square"></i> Edit     
                  </a>    
                 <!-- / edit -->   

                  <form action="<?= ROOTURL.'/employee/delete/'.$employee->id  ?>" method="post" style="display: inline;">    
                    <button type="submit" class="btn btn-danger delete btn-sm btn-flate" onclick="return confirm('Are you sure want to delete this ?');"> 
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


  