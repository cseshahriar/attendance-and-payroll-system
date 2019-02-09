<?php require_once APPROOT.'/views/backend/layouts/header.php'; ?>  
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Cash Advance
        <small>Create</small> 
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= ROOTURL.'/cashadvance/dashboard' ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= ROOTURL.'/cashadvance/index' ?>">Cash Advance</a></li>    
        <li class="active">Change</li>    
      </ol>
    </section>

    <!-- Main content -->
    <section class="content"> 
          <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3" style="margin-top: 30px">  
                    <!-- box -->
                    <div class="box box-primary">
                      <div class="box-header"> 
                        <h3 class="box-title">Edit Cash Advance</h3> 
                      </div>
                      <div class="box-body">
                       <form action="<?= ROOTURL.'/cashadvance/edit/'.$data['cashadvance']->id ?>" method="post">       
                          <!-- employee id -->
                          <div class="form-group"> 
                            <label>Employee ID:</label>    

                            <div class="input-group">
                              <div class="input-group-addon"> 
                                <i class="fa fa-user"></i>
                              </div>  
                              <input class="form-control" type="text" value="<?= $data['cashadvance']->employee_id.' - '.$data['cashadvance']->firstname. ' '.$data['cashadvance']->lastname ?>" disabled> 
                            </div>    
                            <!-- /.input group --> 
                          </div>
                          <!-- /.form group -->

                          <!-- date -->
                          <div class="form-group date">
                            <label>Date of Advance:</label>  

                            <div class="input-group">
                              <div class="input-group-addon"> 
                                <i class="fa fa-calendar"></i> 
                              </div> 
                              <input type="text" name="date_advance" value="<?= $data['cashadvance']->date_advance ?>" class="form-control datepicker pull-right">  
                            </div>  
                            <!-- /.input group -->
                            <p class="text-danger"><?= $data['date_advance_error'] ?></p>    
                          </div>
                          <!-- /.form group -->     
                          
                            
                          <!-- outtime -->
                          <div class="form-group">
                            <label>Amount:</label>  

                            <div class="input-group"> 
                              <div class="input-group-addon">  
                                <i class="fa fa-usd"></i>   
                              </div> 
                              <input type="text" name="amount" value="<?= money_format('%n', $data['cashadvance']->amount) ?>" class="form-control pull-right">      
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


  