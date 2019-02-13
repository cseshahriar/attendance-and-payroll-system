<?php require_once 'layouts/header.php'; ?> 
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
  	 <section class="content-header"> 
      <h1>
       Overviews
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= ROOTURL.'/dashboard/index'?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Overviews</li>  
      </ol>
    </section> 

    <section class="content container-fluid">
  		<div class="row">
	        <div class="col-lg-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-primary"> 
	            <div class="inner">
	              <h3><?= $data['numbersOfEmployees']->numberOfEmployees ?></h3>   
	              <p>Total Employees</p> 
	            </div>
	            <div class="icon">
	              <i class="ion ion-person"></i>
	            </div>
	            <a href="<?= ROOTURL.'/employee/index' ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>  
	          </div>
	        </div>
	        <!-- ./col -->
	        
	        <div class="col-lg-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-green">
	            <div class="inner">
	              <h3><?= number_format($data['attendancesPercentage'], 2) ?><sup style="font-size: 20px">%</sup></h3> 

	              <p>Attendance Percentage</p> 
	            </div>
	            <div class="icon">
	              <i class="ion ion-stats-bars"></i>
	            </div>
	            <a href="#" class="small-box-footer" onclick="event.preventDefault();">More info <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        <!-- ./col -->
	        <div class="col-lg-2 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-yellow">
	            <div class="inner">
	              <h3><?= $data['earlyPresent'] ?></h3>

	              <p>On Time Today</p>
	            </div>
	            <div class="icon">
	              <i class="ion ion-person"></i>
	            </div>
	            <a href="#" class="small-box-footer" onclick="event.preventDefault();">More info <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        <!-- ./col -->

	        <div class="col-lg-2 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-red">
	            <div class="inner">
	              <h3><?= $data['numbersOfEmployees']->numberOfEmployees - $data['earlyPresent'] ?></h3> 

	              <p>Late Today</p>    
	            </div>
	            <div class="icon">
	              <i class="ion ion-person"></i>
	            </div>
	            <a href="#" class="small-box-footer" onclick="event.preventDefault();">More info <i class="fa fa-arrow-circle-right"></i></a>
	          </div> 
	        </div>
        	<!-- ./col -->

	        <div class="col-lg-2 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-red">
	            <div class="inner">
	              <h3><?= $data['numbersOfEmployees']->numberOfEmployees - $data['totalPresent'] ?></h3> 

	              <p>Absence</p>       
	            </div>
	            <div class="icon">
	              <i class="ion ion-person"></i>  
	            </div>
	            <a href="#" class="small-box-footer" onclick="event.preventDefault();">More info 
	            	<i class="fa fa-arrow-circle-right"></i> 
	            </a>
	          </div> 
	        </div>
        	<!-- ./col -->

     	</div> 

     	<div class="row">
     		<div class="col-md-12">

		     	<!-- BAR CHART -->
		        <div class="box box-success">
		            <div class="box-header with-border">
		                <h3 class="box-title">Bar Chart</h3>

					    <div class="box-tools pull-right"> 
			                <form class="form-inline">
			                  <div class="form-group">
			                    <label>Select Year: </label>
			                    <select class="form-control input-sm" id="select_year"> 
			                            <option value="" selected>-- Select Year --</option>    
			                    </select>
			                  </div>
			                </form>
			            </div>
						
		            </div>
		            <div class="box-body">
		              <div class="chart">

		              	<div id="legend" class="text-center">
		              		<ul class="bar-legend" style="list-style: none"> 
		              			<li><span style="background-color:rgba(210, 214, 222, 1)"></span>Late</li>
		              			<li><span style="background-color:#00a65a"></span>Ontime</li>
		              		</ul>
		              	</div>

		                <canvas id="barChart" style="height:230px"></canvas>     
		              </div>
		            </div>
		            <!-- /.box-body -->
		        </div> 
		        <!-- /.box -->
     			
     		</div>
     	</div>
	</section>   
  </div>
  <!-- /.content-wrapper -->

<?php require_once 'layouts/footer.php'; ?>   


  