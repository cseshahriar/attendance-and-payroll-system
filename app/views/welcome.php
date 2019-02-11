<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <title>Attendance & Payroll System</title>  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= ROOTURL.'/public/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css' ?>">  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= ROOTURL.'/public/adminlte/bower_components/font-awesome/css/font-awesome.min.css'?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= ROOTURL.'/public/adminlte/bower_components/Ionicons/css/ionicons.min.css' ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= ROOTURL.'/public/adminlte/dist/css/AdminLTE.min.css' ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= ROOTURL.'/public/adminlte/plugins/iCheck/square/blue.css' ?>"> 
  <script src="<?= ROOTURL.'/public/js/moment.min.js' ?>"></script>  

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

    <p>
      <?php
          date_default_timezone_set("Asia/Dhaka");  
          echo date('l').' - '.date('M').' - '.date('d').', '.date('Y', time());     
      ?>
    </p>   

    <p style="font-weight:700"><?= date('h:i:s a', time()); ?></p>   

  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form method="post" id="employeeLoginForm">          

      <div class="form-group has-feedback">
        <select name="status" id="status" class="form-control">  
          <option value="" selected>-- Choose Start or Stop --</option>  
          <option value="start">Time Start Now</option>   
          <option value="stop">Time End Now</option>    
        </select> 
        <span class="glyphicon glyphicon-time form-control-feedback"></span>  
      </div>

      <div class="form-group has-feedback"> 
        <input type="email" id="email" name="email" class="form-control" placeholder="Email"> 
        <span class="glyphicon glyphicon-email form-control-feedback"></span> 
      </div>

      <div class="form-group has-feedback">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password"> 
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>     
      </div>

      <div class="form-group has-feedback">
          <button type="submit" id="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
      </div>
    </form>

    <!-- messages  -->
    <div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">

      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

      <span class="result"><i class="icon fa fa-check"></i> 
        <span class="message"></span>   
      </span>
    </div> 

    <!-- errors --> 
    <div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">

      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      
      <span class="result"><i class="icon fa fa-warning"></i> 
        <span class="status-message"></span>
      </span> 

    </div> 

    <div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">

      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

      <span class="result"><i class="icon fa fa-warning"></i> 
        <span class="email-message"></span><br> 
      </span> 
    </div> 


    <div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">

      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

      <span class="result"><i class="icon fa fa-warning"></i> 
        <span class="password-message"></span>
      </span> 

    </div> 
    <!-- / messages  -->   

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?= ROOTURL.'/public/adminlte/bower_components/jquery/dist/jquery.min.js' ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= ROOTURL.'/public/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js' ?>"></script>
<!-- iCheck -->
<script src="<?= ROOTURL.'/public/adminlte/plugins/iCheck/icheck.min.js' ?>"></script>  
<script>

$(document).ready(function() {

    $('#employeeLoginForm').submit(function(e) { 
      e.preventDefault();
      
      var attendance = $(this).serialize();   

      $.ajax({
        type: 'POST',
        url: '<?= ROOTURL.'/front/login' ?>',     
        data: attendance, 
        dataType: 'json',
        success: function(response) { 
          
          if(response.errors) { // erro message 

            $('.alert').hide(); 
            
            $('.alert-danger').show();  
            $('.status-message').html(response.status_error);   
            $('.email-message').html(response.email_error);    
            $('.password-message').html(response.password_error);



          } else { // success message 

            $('.alert').hide(); 
            $('.alert-success').show();

            $('.message').html(response.message);   
            
            // empty  
            $('#email').val(''); 
            $('#password').val('');   
          } 

        } 
      });

    });

});
</script> 
</body>
</html>
