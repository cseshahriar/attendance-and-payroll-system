<?php require_once APPROOT.'/views/backend/layouts/header.php'; ?>  
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Schedules
      </h1>
      <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Schedules</li>
      </ol>
      
      <?php flash('success'); ?>    
   
    </section>  

    <!-- Main content -->
    <section class="content container-fluid">    
        <div class="box">
          <div class="box-header" style="border-bottom: 1px solid #f4f4f4;"> 
            <h3 class="box-title">  
              <a href="<?= ROOTURL.'/schedule/create' ?>" class="btn btn-primary btn-sm">Add New</a>
            </h3> 
          </div>  

          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>#</th>
                <th>Schedule</th>
                <th>Tools</th>
              </tr>
              </thead>
              <tbody>
              <!-- loop -->
              <?php foreach ($data['schedules'] as  $schedule) : ?>
              <tr>
                <td><?= $schedule->id ?></td>
                <td><?= date('h:i:s a', strtotime($schedule->in_time)).' - '.date('h:i:s a', strtotime($schedule->out_time)) ?></td>  
                <td> 
                  <!-- edit -->
                  <a href="<?= ROOTURL.'/schedule/edit/'.$schedule->id ?>" class="btn btn-primary btn-xs btn-flate" onclick="return confirm('Are you sure want to update it?');">      
                  <i class="fa fa-pencil-square"></i> Edit        
                  </a>    
                 <!-- / edit -->     
                   <form action="<?= ROOTURL.'/schedule/delete/'.$schedule->id ?>" method="post" style="display: inline;">   
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
                <th>Schedule</th>  
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


<!-- new attendance --> 
<div class="modal fade" id="schedules">   
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
                  <label class="col-sm-3 control-label">In Time</label>
                  <div class="col-sm-9"> 
                    <input type="text" class="form-control timepicker" name="in_time" id="intime" placeholder="Date" required value="">  
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-sm-3 control-label">Out Time</label> 
                  <div class="col-sm-9"> 
                    <input type="text" class="form-control timepicker" name="out_time" id="outtime" placeholder="Date" required value="">  
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

<?php require_once APPROOT.'/views/backend/layouts/footer.php'; ?>     


  