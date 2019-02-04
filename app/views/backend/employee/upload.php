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
      <div class="row">
        <div class="col-md-8 offset-md-2">
              <div class="box-body">    

            <form class="form-horizontal" action="<?= ROOTURL.'/employee/upload' ?>" enctype="multipart/form-data" method="post">       
               
                <div class="form-group">
                  <label for="photo" class="col-sm-3 control-label">Photo</label>   
                  <div class="col-sm-9"> 
                    <input type="file" class="form-control-file" name="photo">         
                  </div>  
                  <p class="text-danger"><?= $data['photo_error'] ?></p>
                </div>

                <div class="form-group"> 
                  <label class="col-sm-3"></label>    
                  <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary">Register</button>   
                  </div>  
                </div>  

              </div>  
              <!-- /.box-body -->
            </form>   
        </div>
      </div>
    </section>
</div>
<?php require_once APPROOT.'/views/backend/layouts/footer.php'; ?>    


  