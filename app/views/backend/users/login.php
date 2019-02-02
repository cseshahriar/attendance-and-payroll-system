<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <title><?php if(isset($data['title'])) { echo $data['title']; } ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= ROOTURL.'/public/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css' ?>">
  <!-- Font Awesome -->  
  <link rel="stylesheet" href="<?= ROOTURL.'/public/adminlte/bower_components/font-awesome/css/font-awesome.min.css' ?>"> 
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= ROOTURL.'/public/adminlte/bower_components/Ionicons/css/ionicons.min.css' ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= ROOTURL.'/public/adminlte/dist/css/AdminLTE.min.css'?>">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="<?= ROOTURL.'/public/adminlte/dist/css/skins/skin-blue.min.css' ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]--> 

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head> 

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="" onclick="event.preventDefault()"><b>Admin</b>Login</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p> 
		<div class="card" style="width: 30rem;">
		 <div class="card-body">
		    <h5 class="card-title">User Login</h5>      
			<!-- flash message -->
		    <?php flash('register_success'); ?>  
		    <?php flash('logout_success'); ?>   

			<form action="<?= ROOTURL ?>/admin/login" method="post">     

				  <div class="form-group <?php echo (!empty($data['email_error'])) ? 'has-error' : ''; ?>"> 
				    <label for="email">Email address <span class="text-danger">*</span></label>
				    <input type="text" name="email" class="form-control" placeholder="Email" value="<?= $data['email'] ?>"> 
				    <small class="text-danger"><?= $data['email_error'] ?></small>     
				  </div>

				  <div class="form-group <?php echo (!empty($data['password_error'])) ? 'has-error' : ''; ?>">
				    <label for="password">Password <span class="text-danger">*</span></label>
				     <input type="password" name="password" class="form-control" placeholder="Email" value="<?= $data['password'] ?>"> 
				    <small class="text-danger"><?= $data['password_error'] ?></small>  
				  </div>

				  <div class="form-group">
						<button type="submit" class="btn btn-success btn-block">Login</button>  
				  </div>  

			</form>
		</div>
	</div> 

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="<?= ROOTURL.'/public/adminlte/' ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= ROOTURL.'/public/adminlte/' ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= ROOTURL.'/public/adminlte/' ?>dist/js/adminlte.min.js"></script>
</body>
</html> 