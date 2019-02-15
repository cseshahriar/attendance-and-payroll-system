<?php require_once APPROOT.'/views/backend/layouts/header.php'; ?>  
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Attendance
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= ROOTURL.'/dashboard/index' ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= ROOTURL.'/attendance/index' ?>"><i class="fa fa-calender"></i> Attendances</a></li> 
        <li class="active">Create</li> 
      </ol>
       <?php flash('success'); ?>    
    </section>  

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box">
          <div class="box-header" style="border-bottom: 1px solid #f4f4f4;"> 
            <h3 class="box-title">
              <a href="<?= ROOTURL.'/attendance/create' ?>" class="btn btn-primary">
                  <i class="fa fa-plus"></i> New   
              </a>
            </h3> 
          </div>

          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>#</th>
                <th>Date</th>
                <th>Employee ID</th>
                <th>Name</th>
                <th>In Time</th>
                <th>Out Time</th>
                <th title="Working hours per day">WHPD</th>  
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>
              <!-- loop -->
              <?php foreach($data['attendances'] as $attendance) : ?>
              <tr>
                <td><?= $attendance->id ?></td> 
                <td><?= $attendance->created_at ?></td> 
                <td><?= $attendance->employee_id ?></td> 
                <td><?= $attendance->firstname ?> <?= $attendance->lastname ?></td>
                <td>
                  <?php 
                    if (!empty($attendance->in_time)) {
                      echo date('h:i:s a', strtotime($attendance->in_time));   
                    }
                  ?>
                </td> 
                <td>
                  <?php if (!empty($attendance->out_time)) {
                    echo date('h:i:s a' ,strtotime($attendance->out_time));    
                  }
                  ?>
                </td>  
                <td><?= $attendance->num_hr ?></td>     
                <td>
                  <!-- edit -->
                  <a href="<?= ROOTURL.'/attendance/edit/'.$attendance->id ?>" class="btn btn-primary btn-xs btn-flate">   
                  <i class="fa fa-pencil-square"></i> Edit  
                  </a> 
                 <!-- / edit -->     
                  <form action="<?= ROOTURL.'/attendance/delete/'.$attendance->id ?>" method="post" style="display: inline;">   
                    <button type="submit" class="btn btn-danger btn-xs btn-flate" onclick="return confirm('Are you sure want to delete this ?');">
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
                <th>#</th> 
                <th>Date</th>
                <th>Employee ID</th> 
                <th>Name</th>
                <th>In Time</th>
                <th>Out Time</th>
                <th title="Working hours per day">WHPD</th>    
                <th>Actions</th>
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


  