<!-- profile--> 
<div class="modal fade" id="profile">    
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close btn btn-primary" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Admin Profile/h4> 
      </div>

      <div class="modal-body">
        <!-- form start -->
        <form class="form-horizontal" action="<?= ROOTURL.'/attendances/create' ?>" method="post">
          <div class="box-body">   
              <div class="form-group">
                  <label class="col-sm-3 control-label">Username</label>
                  <div class="col-sm-9"> 
                    <input type="text" class="form-control" name="username" id="username" required value="<?= $_SESSION['user_name'] ?>">  
                  </div>
              </div>   
              <div class="form-group">
                  <label class="col-sm-3 control-label">Username</label>
                  <div class="col-sm-9"> 
                    <input type="text" class="form-control" name="username" id="username" required value="<?= $_SESSION['user_name'] ?>">  
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
<!-- / profile --> 