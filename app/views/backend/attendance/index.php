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
              <a href="" class="btn btn-primary"><i class="fa fa-plus"></i> New</a>
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
                <td><?= $attendance->name ?></td>
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


  