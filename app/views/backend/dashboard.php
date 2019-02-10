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
	          <div class="small-box bg-aqua">
	            <div class="inner">
	              <h3><?= $data['numbersOfEmployees']->numberOfEmployees ?></h3>   
	              <p>Total Employees</p> 
	            </div>
	            <div class="icon">
	              <i class="ion ion-bag"></i>
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

	              <p>On Time Percentage</p>
	            </div>
	            <div class="icon">
	              <i class="ion ion-stats-bars"></i>
	            </div>
	            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        <!-- ./col -->
	        <div class="col-lg-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-yellow">
	            <div class="inner">
	              <h3><?= $data['earlyPresent'] ?></h3>

	              <p>On Time Today</p>
	            </div>
	            <div class="icon">
	              <i class="ion ion-person-add"></i>
	            </div>
	            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
	        <!-- ./col -->
	        <div class="col-lg-3 col-xs-6">
	          <!-- small box -->
	          <div class="small-box bg-red">
	            <div class="inner">
	              <h3><?= $data['latePresent'] ?></h3> 

	              <p>Late Today</p>   
	            </div>
	            <div class="icon">
	              <i class="ion ion-pie-graph"></i>
	            </div>
	            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	          </div>
	        </div>
        	<!-- ./col -->
     	</div> 
	</section>   
  </div>
  <!-- /.content-wrapper -->

<?php require_once 'layouts/footer.php'; ?>   


  