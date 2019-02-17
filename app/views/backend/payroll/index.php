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
	            <form  action="<?= ROOTURL.'/payroll/index'?>" method="POST" class="form-inline" id="payForm" _lpchecked="1">  
                  
                  <div class="input-group date">
                    <div class="input-group-addon"> 
                      <i class="fa fa-calendar"></i> 
                    </div>
                    <input type="text" class="form-control pull-right col-sm-8 datepiker" id="from" name="from" value="" placeholder="From" required>           
                  </div>
                  
                  <div class="input-group date">
                    <div class="input-group-addon"> 
                      <i class="fa fa-calendar"></i>  
                    </div> 
                     
                    <input type="text" class="form-control pull-right col-sm-8 datepiker" id="to" name="to" value="" placeholder="To" required>          
                  </div>
               

                  <button type="submit" class="btn btn-success btn-sm btn-flat" name="payroll" id="payroll"><span class="glyphicon glyphicon-print"></span> Payroll</button>

                  <button type="submit" class="btn btn-primary btn-sm btn-flat" name="payslip" id="payslip"><span class="glyphicon glyphicon-print"></span> Payslip</button>    
                </form>
		    </div>

            <h3 class="box-title"></h3> 

          </div>  

          <!-- /.box-header -->
          <div class="box-body">
            <table id="payroll" class="table table-bordered table-striped">   
              <thead>
              <tr>
                 <th>Name</th>
                  <th>ID</th>
                  <th>Rate</th> 
                  <th>W.Hours</th>
                  <th>Overtimes & Rate</th>
                  <th>Gross</th>
                  <th>Deductions</th>
                  <th>Advance</th>
                  <th>Net Pay</th> 
              </tr>
              </thead>
              <tbody>
              <!-- loop -->
              <?php if ($data['payroll'] != false) : ?>   
              <?php foreach($data['payroll'] as $info) : ?> 
              <tr>
                <td><?= $info->firstname.' '.$info->lastname ?></td>   
                <td><?= $info->employee_id ?></td>    
                <td><?= $info->rate ?> TK</td>    
                <td><?= $info->total_hours ?></td>    
                  <?php foreach ($data['overtimes'] as $oinfo) : ?>
                  <?php if($oinfo->employee_id == $info->employee_id) : ?>   
                  <td>
                    <?php 
                        echo $oinfo->total_overtime.' - '.$oinfo->rate. ' = ';
                        $time = $oinfo->total_overtime;
                        $intTime = explode(':', $time);
                        $intTime = $intTime[0].'.'.$intTime[1]; 
                        echo $intTime * $oinfo->rate;  
                     ?> 
                     TK
                  </td>       
                  <?php endif; ?> 
                  <?php endforeach; ?>
                <td>Gross</td>    
                <td>Deduction</td> 
                <td>Advance</td> 
                <td>Net Pay</td>   
              </tr> 
            <?php endforeach; ?> 
            <?php else : ?>
               <tr>
                 <th>Name</th>
                  <th>ID</th> 
                  <th>Rate</th> 
                  <th>W.Hours</th>
                  <th>Overtimes & Rate</th>
                  <th>Gross</th>
                  <th>Deductions</th> 
                  <th>Advance</th> 
                  <th>Net Pay</th>    
              </tr>  
            <?php endif; ?> 
              <!-- loop -->
              </tbody>
              <tfoot>
              <tr>
                  <th>Name</th>
                  <th>ID</th> 
                  <th>Rate</th> 
                  <th>W.Hours</th>
                  <th>Overtimes & Rate</th>
                  <th>Gross</th>
                  <th>Deductions</th> 
                  <th>Advance</th> 
                  <th>Net Pay</th>  
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


  