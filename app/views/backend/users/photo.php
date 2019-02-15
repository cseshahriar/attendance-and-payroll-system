<?php require_once APPROOT.'/views/backend/layouts/header.php'; ?>  
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit User Photo
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= ROOTURL.'/admin/index'?>"><i class="fa fa-dashboard"></i> Users</a></li>
        <li class="active">Edit</li>  
      </ol>
    </section>   

    <!-- Main content -->
    <section class="content container-fluid mt-5"> 
      <div class="row">
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Change Photo</h3> 
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form role="form" action="<?= ROOTURL.'/admin/photo/'.$data['user']->id ?>" method="post" enctype="multipart/form-data"> 

                <div class="box-body">  
                  
                  <div class="form-group">
                    <label for="photo">Change User Photo</label>
                    <input type="file" name="photo" id="photo" class="form-control-file">      

                    <p class="text-danger"><?= $data['photo_error'] ?></p>    
                  </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-success">Submit</button> 
                </div>
              </form>
            </div>
            <!-- /.box -->
        </div>
      </div>
    </section>
</div>
<?php require_once APPROOT.'/views/backend/layouts/footer.php'; ?>    


  