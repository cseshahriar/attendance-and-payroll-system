<?php require_once APPROOT.'/views/backend/layouts/header.php'; ?>  
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Payroll
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= ROOTURL.'/dashboard/index' ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Payroll</li>     
      </ol>
      
      <?php flash('success'); ?>    
   
    </section>  

    <!-- Main content -->
    <section class="content container-fluid">    
        <div class="box">
          <div class="box-header" style="border-bottom: 1px solid #f4f4f4;padding: 15px">  

        	<div class="box-tools pull-right">    
	            <form method="POST" class="form-inline" id="payForm" _lpchecked="1"> 
                  
                  <div class="input-group">
                    <div class="input-group-addon"> 
                      <i class="fa fa-calendar"></i> 
                    </div>
                    <input type="text" class="form-control pull-right col-sm-8" id="reservation" name="date_range" value="01/12/2019 - 02/11/2019">   
                  </div> 

                  <button type="button" class="btn btn-success btn-sm btn-flat" id="payroll"><span class="glyphicon glyphicon-print"></span> Payroll</button>

                  <button type="button" class="btn btn-primary btn-sm btn-flat" id="payslip"><span class="glyphicon glyphicon-print"></span> Payslip</button> 
                </form>
		    </div>

            <h3 class="box-title"></h3> 

          </div>  

          <!-- /.box-header -->
          <div class="box-body">
            <table id="payroll" class="table table-bordered table-striped">   
              <thead>
              <tr>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Schedule</th> 
                <th>Tools</th>
              </tr>
              </thead>
              <tbody>
              <!-- loop -->
              
              <tr>
                <td>data</td> 
                <td>data</td> 
                <td>data</td>   
                <td>data</td> 
              </tr> 
           
              <!-- loop -->
              </tbody>
              <tfoot>
              <tr>
                <th>Employee ID</th>
                <th>Name</th>
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

<?php require_once APPROOT.'/views/backend/layouts/footer.php'; ?>             


  