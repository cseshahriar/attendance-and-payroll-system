<?php require_once APPROOT.'/views/backend/layouts/header.php'; ?>  
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Positions
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= ROOTURL.'/admin/dashboard' ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Positions</li>
      </ol>
      
      <?php flash('success'); ?>    
   
    </section>  

    <!-- Main content -->
    <section class="content container-fluid"> 
        <div class="box">
          <div class="box-header" style="border-bottom: 1px solid #f4f4f4;"> 
            <h3 class="box-title">
              <a href="<?= ROOTURL.'/position/create'?>" class="btn btn-primary"> 
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
                <th>Description</th>
                <th>Rete</th>
                <th>Tools</th>
              </tr>
              </thead>
              <tbody>
              <!-- loop -->
              <?php foreach ($data['positions'] as  $position) : ?> 
              <tr>
                <td><?= $position->id ?></td>
                <td><?= $position->description ?></td>
                <td><?= $position->rate ?></td>   
                <td> 
                  <!-- edit -->
                  <a href="<?= ROOTURL.'/position/edit/'.$position->id ?>" class="btn btn-primary btn-sm btn-flate" onclick="return confirm('Are you sure want to update it?');">  
                  <i class="fa fa-pencil-square"></i> Edit     
                  </a>    
                 <!-- / edit -->   

                  <form action="<?= ROOTURL.'/position/delete/'.$position->id ?>" method="post" style="display: inline;">    
                    <button type="submit" class="btn btn-danger btn-sm btn-flate" onclick="return confirm('Are you sure want to delete this ?');">
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
                <th>Description</th>  
                <th>Rate</th>
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


  