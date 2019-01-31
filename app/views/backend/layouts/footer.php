<!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="<?= ROOTURL.'/public/adminlte/' ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= ROOTURL.'/public/adminlte/' ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?= ROOTURL.'/public/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js' ?>"></script>
<script src="<?= ROOTURL.'/public/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'?>"></script> 
<!-- AdminLTE App -->
<script src="<?= ROOTURL.'/public/adminlte/' ?>dist/js/adminlte.min.js"></script> 
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= ROOTURL.'/public/adminlte/' ?>dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= ROOTURL.'/public/adminlte/' ?>dist/js/demo.js"></script>  
<!-- daterangepicker -->
<script src="<?= ROOTURL.'/public/adminlte/' ?>bower_components/moment/min/moment.min.js"></script>
<script src="<?= ROOTURL.'/public/adminlte/' ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?= ROOTURL.'/public/adminlte/' ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?= ROOTURL.'/public/adminlte/' ?>plugins/timepicker/bootstrap-timepicker.min.js"></script>

<!-- page script -->  
<script>
  $(document).ready(function() {

    $('#example1').DataTable(); 
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false 
    });  

    //Date picker
    $('#date').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    });

    $('#birthday').datepicker({ 
      autoclose: true,
      format: 'yyyy-mm-dd'
    });

     //Date picker
    $('.date').datepicker({    
      autoclose: true, 
      format: 'yyyy-mm-dd' 
    });

    //Timepicker
    $('.timepicker').timepicker({
      timeFormat: 'H:mm:ss' 
      // showInputs: false 
    }) 

  }); 
</script>  
</body>
</html> 