<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php if($data['title']) { echo $data['title']; } else { echo 'Dashboard'; } ?></title>   
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= ROOTURL.'/public/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css' ?>">
  <!-- Font Awesome --> 
  <link rel="stylesheet" href="<?= ROOTURL.'/public/adminlte/bower_components/font-awesome/css/font-awesome.min.css' ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= ROOTURL.'/public/adminlte/bower_components/Ionicons/css/ionicons.min.css' ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= ROOTURL.'/public/adminlte/dist/css/AdminLTE.min.css'?>">
  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="<?= ROOTURL.'/public/adminlte/dist/css/skins/_all-skins.min.css'?> "> 
  <link rel="stylesheet" href="<?= ROOTURL.'/public/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css' ?>">  
  <link rel="stylesheet" href="<?= ROOTURL.'/public/css/jquery.dataTables.min.css' ?> ">   
  <link rel="stylesheet" href="<?= ROOTURL.'/public/css/buttons.dataTables.min.css' ?> ">      

  <!-- daterange picker -->
    <link rel="stylesheet" href="<?= ROOTURL.'/public/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css' ?>">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="<?= ROOTURL.'/public/adminlte/plugins/timepicker/bootstrap-timepicker.min.css'?> "> 
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?= ROOTURL.'/public/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'?> ">
    <link rel="stylesheet" href="<?= ROOTURL.'/public/css/style.css' ?> ">    


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]--> 

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-green sidebar-mini">  
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="<?= ROOTURL.'/dashboard/index' ?>" class="logo"> 
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>P</b>Sys</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Payroll</b>System</span> 
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span> 
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
      
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <?php if (isset($_SESSION['user_id'] )): ?> 
                <img src="<?= ROOTURL.'/public/uploads/admin/'.$_SESSION['user_photo'] ?>" class="user-image" alt="Image"> 
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?=  $_SESSION['user_name'] ?></span>   
              <?php endif ?>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <?php if (isset($_SESSION['user_id'] )): ?>
              <li class="user-header">
                <img src="<?= ROOTURL.'/public/uploads/admin/'.$_SESSION['user_photo'] ?>" class="img-circle" alt="Image">  

                <p>
                  <?=  $_SESSION['user_name'] ?>
                  <small>Member since Nov. <?= date('d-m-Y', strtotime($_SESSION['user_created_at'])) ?></small>
                </p> 
              </li>

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?= ROOTURL.'/admin/profile'?>" class="btn btn-default btn-flat">Profile</a>  
                </div> 
                <div class="pull-right">
                  <a href="<?= ROOTURL ?>/admin/logout" class="btn btn-default btn-flat">Sign out</a> 
                </div> 
              </li>
            <?php endif; ?>  
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
    <?php if(isset($_SESSION['user_id'])): ?>
      <div class="user-panel" style="margin-bottom: 15px"> 
        <div class="pull-left image">
          <img src="<?= ROOTURL.'/public/uploads/admin/'.$_SESSION['user_photo'] ?>" class="img-circle" alt="User Image">  
        </div>
        <div class="pull-left info">
          <p><?= $_SESSION['user_name'] ?></p> 
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>  
        </div>
      </div>
      <?php else: ?>
      <div class="user-panel">
        <div class="pull-left image">
          <img src="" class="img-circle" alt="User Image"> 
        </div>
        <div class="pull-left info">
          <p></p>  
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Offline</a>
        </div>
      </div>

      <?php endif; ?>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">REPORTS</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active">
          <a href="<?= ROOTURL.'/dashboard/index' ?>">  
            <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
          </a> 
        </li> 

        <li class="active">
          <a href="<?= ROOTURL ?>/admin/index">  
            <i class="fa fa-users"></i> <span>Users</span> 
          </a> 
        </li>

        <li class="active">
          <a href="<?= ROOTURL ?>/attendance/index">  
            <i class="fa fa-calendar"></i> <span>Attendances</span> 
          </a> 
        </li>

       
        <li class="treeview">   
          <a href="#">
            <i class="fa fa-users"></i>  
            <span>Employee</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i> 
              </span>
          </a> 
          <ul class="treeview-menu">   
            <li>
              <a href="<?= ROOTURL.'/employee/index' ?>"><i class="fa fa-circle-o"></i> Employee List</a>
            </li>
            <li>
              <a href="<?= ROOTURL.'/overtime/index' ?>"><i class="fa fa-circle-o"></i> Overtime</a>
            </li>
            <li>
              <a href="<?= ROOTURL.'/cashadvance/index'?>"><i class="fa fa-circle-o"></i> Cash Advance</a>
            </li>
          </ul>   
        </li> 

         <li>
          <a href="<?= ROOTURL.'/deduction/index' ?>"><i class="fa fa-file"></i> <span>Deductions</span></a> 
         </li> 

         <li>   
          <a href="<?= ROOTURL.'/position/index' ?>"><i class="fa fa-suitcase"></i> <span>Positions</span></a> 
         </li> 

        <li>
          <a href="<?= ROOTURL.'/schedule/index' ?>"><i class="fa fa-clock-o"></i> <span>Schedule</span></a> 
        </li>

        <li class="header">PRINTTABLES</li> 
        <li>
            <a href="<?= ROOTURL.'/employeeschedule/index'?>"><i class="fa fa-clock-o"></i> <span>Employee Schedules</span></a>          
        </li>  
        <li>
          <a href="<?= ROOTURL.'/payroll/index' ?>"><i class="fa fa-files-o"></i> <span>Payroll</span></a>   
        </li> 
       
      </ul> 
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- profile modal --> 
<div class="modal fade" id="profile">      
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close btn btn-primary" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Admin Profile</h4> 
      </div>

      <div class="modal-body">
        <!-- form start -->
        <form class="form-horizontal" action="<?= ROOTURL.'/attendances/create' ?>" method="post">
          <div class="box-body">   
              <div class="form-group">
                  <label class="col-sm-3 control-label">Name</label>
                  <div class="col-sm-9"> 
                    <input type="text" class="form-control" name="name" id="name" required value="<?= $_SESSION['user_name'] ?>">  
                  </div>
              </div>    
              <div class="form-group">
                  <label class="col-sm-3 control-label">Email</label>
                  <div class="col-sm-9"> 
                    <input type="text" class="form-control" name="email" id="email" required value="<?= $_SESSION['user_email'] ?>">  
                  </div>
              </div>   
              <div class="form-group">
                 <label class="col-sm-3 control-label">Current Photo</label>
                  <div class="col-sm-9"> 
                  <img src="<?= ROOTURL.'/public/uploads/admin/'.$_SESSION['user_photo'] ?>" alt="" height="40" class="d-inline"> 
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 control-label">Photo</label>
                  <div class="col-sm-9"> 
                    <input type="file" class="form-control-file" name="photo" id="photo" required>  
                  </div>
              </div>   
              <hr>
               <div class="form-group">
                  <label class="col-sm-3 control-label">Current Password</label>
                  <div class="col-sm-9"> 
                    <input type="password" class="form-control" name="password" id="password" required placeholder="Input current password to save change">  
                  </div>
              </div> 

          </div>  
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            <button type="submit" class="btn btn-primary pull-right">Save</button>  
          </div>
          <!-- /.box-footer -->
        </form>  
      </div> 

      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- / profile --> 