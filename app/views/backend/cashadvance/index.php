<?php require_once APPROOT.'/views/backend/layouts/header.php'; ?>  
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Cash Advance
      </h1>
      <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Cash Advance</li>
      </ol>
    </section>  

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box">
          <div class="box-header" style="border-bottom: 1px solid #f4f4f4;"> 
            <h3 class="box-title">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cashadvance"> 
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
                <th>Date</th>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Tools</th>
              </tr>
              </thead>
              <tbody>
              <!-- loop -->
              <tr>
                <td></td>
                <td></td> 
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
                <th>Date</th>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Amount</th>
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
<div class="modal fade" id="cashadvance">   
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
              <label for="amount" class="col-sm-3 control-label">Amount</label>
              <div class="col-sm-9"> 
                <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount" required>  
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


  