<?php require_once APPROOT.'/views/backend/layouts/header.php'; ?>   
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Deduction
        <small>Edit</small> 
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= ROOTURL.'/dashboard/index' ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= ROOTURL.'/deduction/index' ?>">Deductions</a></li>     
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
                        <h3 class="box-title">Edit Deductions</h3> 
                      </div>
                      <div class="box-body">
                       <form action="<?= ROOTURL.'/deduction/edit/'.$data['deduction']->id ?>" method="post">           
                          <!-- intime -->
                          <div class="form-group">  
                            <label>Employee Id</label>     

                            <div class="input-group">
                              <div class="input-group-addon">   
                                <i class="fa fa-user"></i>  
                              </div> 
                              <input type="text" value="<?= $data['deduction']->employee_id.' - '.$data['deduction']->firstname.' '.$data['deduction']->lastname ?>" class="form-control pull-right" disabled>    
                            </div>  
                            <!-- /.input group -->
                               
                          </div>
                          <!-- /.form group -->    

                          <!-- intime -->
                          <div class="form-group">  
                            <label>Description:</label>     

                            <div class="input-group">
                              <div class="input-group-addon"> 
                                <i class="fa fa-info"></i>
                              </div> 
                              <input type="text" name="description" value="<?= $data['deduction']->description ?>" class="form-control pull-right">  
                            </div>  
                            <!-- /.input group -->
                            <p class="text-danger"><?= $data['description_error'] ?></p>    
                          </div>
                          <!-- /.form group -->

                          <!-- outtime -->
                          <div class="form-group">
                            <label>Amount:</label>  

                            <div class="input-group"> 
                              <div class="input-group-addon"> 
                                <i class="fa fa-usd"></i> 
                              </div> 
                              <input type="text" name="amount" value="<?= $data['deduction']->amount ?>" class="form-control pull-right">    
                            </div>   
                            <!-- /.input group -->
                            <p class="text-danger"><?= $data['amount_error'] ?></p>    
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


  