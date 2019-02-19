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
                  <th>W.Hours & Rate</th> 
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
                <td> <?= $info->total_hours.' & '. $info->rate.' TK/H'; ?>  </td>   
                
                <td>
                <?php foreach ($data['overtimes'] as $oinfo) : ?>
                  <?php if($oinfo->employee_id == $info->employee_id) : ?>    
                  <?= $oinfo->total_overtime.' & '.$oinfo->rate.' TK/H' ?>      
                  <?php endif; ?> 
                <?php endforeach; ?>      
                </td>

                <td>
                <?php foreach ($data['overtimes'] as $oinfo) : ?>
                  <?php if($oinfo->employee_id == $info->employee_id) : ?>    
                    <?php
                      $hours = number_format(decimal($info->total_hours), 2); 
                      $ot = number_format(decimal($oinfo->total_overtime), 2);   
                      $rate = (float) $info->rate;
                      $orate = (float) $oinfo->rate;   
                      $gross = grossSalary($hours, $ot, $rate, $orate); 
                      echo $gross;
                    ?>  TK
                  <?php endif; ?> 
                <?php endforeach; ?>  
                </td>        

                <td>
                <?php foreach ($data['deductions'] as $deduction) : ?>
                  <?php if($info->employee_id == $deduction->employee_id) : ?>    
                    <?= number_format($deduction->total_deduction, 2) ?> TK    
                  <?php endif; ?> 
                <?php endforeach; ?>   
                </td> 
                
                <td>
                <?php foreach ($data['cashes'] as $cash) : ?>
                  <?php if($info->employee_id == $cash->employee_id) : ?>    
                    <?= number_format($cash->cashamount, 2) ?>   TK
                  <?php endif; ?> 
                <?php endforeach; ?> 
                </td>     

                

                
                <!-- net  -->
                   <td>
                  <?php foreach ($data['overtimes'] as $oinfo) : ?>
                    <?php if($oinfo->employee_id == $info->employee_id) : ?>    
                      <?php
                        $hours = number_format(decimal($info->total_hours), 2); 
                        $ot = number_format(decimal($oinfo->total_overtime), 2);   
                        $rate = (float) $info->rate;
                        $orate = (float) $oinfo->rate;   
                        $gross = grossSalary($hours, $ot, $rate, $orate); 
                        
                        $net = NULL; 
                        // $gross - deduction; 
                        foreach ($data['empDeduction'] as $value) {

                          if ($oinfo->employee_id == $value->employee_id) {
                            $deduction = $value->totalDeduction;
                            $deduction = floatval($deduction);  
                            $net = floatval($gross - $deduction);  
                            // cash advance   
                              foreach ($data['empCashes'] as $cvalue) { 
                                if ($info->employee_id == $cvalue->employee_id) {  
                                  $advance = $cvalue->totalAdvance; 
                                  $advance = floatval($advance);  
                                  $net = floatval($net - $advance); 
                                  $net = number_format($net, 2);     
                                  // cash advance   
                                  echo $net;   
                                }
                              }
                          }
                        }
                      ?>  TK
                    <?php endif; ?> 
                  <?php endforeach; ?>  
                </td>
  
              </tr> 
            <?php endforeach; ?>  
            <?php else : ?>
               <tr>
                  <th>Name</th>
                  <th>ID</th>
                  <th>W.Hours</th> 
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
                  <th>W.Hours</th> 
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


  