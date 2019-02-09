<?php require_once APPROOT.'/views/backend/layouts/header.php'; ?>   
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Position
        <small>Edit</small> 
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= ROOTURL.'/position/dashboard' ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= ROOTURL.'/position/index' ?>">Positions</a></li>    
        <li class="active">Edit</li>     
      </ol>
    </section> 

    <!-- Main content -->
    <section class="content"> 
          <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">  
                    <!-- box -->
                    <div class="box box-primary">
                      <div class="box-header"> 
                        <h3 class="box-title">Edit Position</h3> 
                      </div>
                      <div class="box-body">
                       <form action="<?= ROOTURL.'/position/edit/'.$data['position']->id ?>" method="post">           
                          <!-- intime -->
                          <div class="form-group"> 
                            <label>Description:</label>    

                            <div class="input-group">
                              <div class="input-group-addon"> 
                                <i class="fa fa-info"></i>
                              </div> 
                              <input type="text" name="description" value="<?= $data['position']->description ?>" class="form-control pull-right">  
                            </div>  
                            <!-- /.input group -->
                            <p class="text-danger"><?= $data['description_error'] ?></p>    
                          </div>
                          <!-- /.form group -->

                          <!-- outtime -->
                          <div class="form-group">
                            <label>Rate:</label>  

                            <div class="input-group"> 
                              <div class="input-group-addon"> 
                                <i class="fa fa-usd"></i> 
                              </div> 
                              <input type="text" name="rate" value="<?= $data['position']->rate ?>" class="form-control pull-right">    
                            </div>   
                            <!-- /.input group -->
                            <p class="text-danger"><?= $data['rate_error'] ?></p>   
                          </div>
                          <!-- /.form group -->

                          <div class="form-group"> 
                            <button type="submit" class="btn btn-success">Save</button> 
                          </div>
                       </form>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
          </div>

    </section> 
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php require_once APPROOT.'/views/backend/layouts/footer.php'; ?>    


  