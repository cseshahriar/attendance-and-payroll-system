<?php require_once APPROOT.'/views/backend/layouts/header.php'; ?>  
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Positions
      </h1>
      <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Positions</li>
      </ol>
    </section>  

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box">
          <div class="box-header" style="border-bottom: 1px solid #f4f4f4;"> 
            <h3 class="box-title">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#position"> 
                  <i class="fa fa-plus"></i> New 
              </button>
              
              <?php flash('success'); ?>  
            </h3> 
          </div>

          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Position Title</th>
                <th>Rate per Hour</th>
                <th>Tools</th>
              </tr>
              </thead>
              <tbody>
              <!-- loop -->
              <tr>
                <td></td>
                <td></td> 
                <td> 
                  <!-- edit -->
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-overtime-">  
                  <i class="fa fa-pencil-square"></i> Edit 
                  </button>   
                 <!-- / edit -->   

                  <form action="<?= ROOTURL.'/attendances/delete/'?>" method="post" style="display: inline;">   
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this ?');">
                      <i class="fa fa-trash"></i> Delete
                    </button>
                  </form>  
                </td>
              </tr> 
              <!-- loop -->
              </tbody>
              <tfoot>
              <tr>
                <th>Position Title</th>
                <th>Rate per Hour</th>
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
<div class="modal fade" id="position">    
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
                  <label class="col-sm-3 control-label">Position Title</label>
                  <div class="col-sm-9"> 
                    <input type="text" class="form-control" name="position_title" id="descriptin" placeholder="Position Title" required>  
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-sm-3 control-label">Reate per Hour</label> 
                  <div class="col-sm-9"> 
                    <input type="text" class="form-control" name="hour" id="hour" placeholder="Rate per Hour" required value="">  
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


  