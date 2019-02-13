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
  <script> 
        let date = moment().format('MMMM Do YYYY');  
        let time = moment().format('h:mm:ss a');      
  </script>   

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
    
    <a onclick="event.preventDefault();">
      <script type="text/javascript"> document.write(date); </script>
    </a>     
    <a onclick="event.preventDefault();"> 
      <b>
        <script type="text/javascript"> document.write(time); </script> 
      </b>  
    </a>   

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
        <input type="email" id="email" name="email" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>" class="form-control" placeholder="Email"> 
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
    <div class="alert alert-danger alert-danger1 alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <span class="result"><i class="icon fa fa-warning"></i>    
        <span class="error-message1"></span>          
      </span>   
    </div>  
   
    <div class="alert alert-danger alert-danger2 alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> 
      <span class="result"><i class="icon fa fa-warning"></i>      
        <span class="error-message2"></span>        
      </span>   
    </div>   
   
    <div class="alert alert-danger alert-danger3 alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> 
      <span class="result"><i class="icon fa fa-warning"></i>     
        <span class="error-message3"></span>       
      </span>   
    </div> 
   
    <div class="alert alert-danger alert-danger4 alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> 
      <span class="result"><i class="icon fa fa-warning"></i>    
        <span class="error-message4"></span>                
      </span>   
    </div> 
   
    <div class="alert alert-danger alert-danger5 alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> 
      <span class="result"><i class="icon fa fa-warning"></i>    
        <span class="leave-message"></span>                 
      </span>   
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

            if (response.status_error) {     
              $('.alert-danger1').hide();  

              $('.alert-danger1').show();     
              $('.error-message1').html(response.status_error); 
            }

            if (response.email_error) {
              $('.error-message2').html('');  
              $('.alert-danger2').hide(); 

              $('.alert-danger2').show();
              $('.error-message2').html(response.email_error);    
            }
           
            if (response.password_error) {
              $('.error-message3').html('');  
              $('.alert-danger3').hide(); 

              $('.alert-danger3').show();
              $('.error-message3').html(response.password_error);  
            }  
            
            if (response.didNotMatch) {            
              $('.alert-danger4').hide();      

              $('.alert-danger4').show();
              $('.error-message4').html(response.didNotMatch);          
            }     

          } else { // success message 

            $('.alert').hide(); 
            
            if (response.message) {  
              $('.alert-success').hide(); 

              $('.alert-success').show(); 
              $('.message').html(response.message);   
            }  

            if (response.leave_message) {   
              $('.alert-danger5').hide();   

              $('.alert-danger5').show();  
              $('.leave-message').html(response.leave_message);                    
            }


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
