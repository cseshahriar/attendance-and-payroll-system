<?php require_once APPROOT.'/views/backend/layouts/header.php'; ?>  
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Users List
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= ROOTURL.'/dashboard/indexx' ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Users</li>
      </ol>
       <?php flash('message'); ?>     
    </section>  

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box">
          <div class="box-header" style="border-bottom: 1px solid #f4f4f4;"> 
            <h3 class="box-title">
              <!-- only superadmin -->
              <?php if($_SESSION['user_type'] == 'superadmin') : ?> 
              <a href="<?= ROOTURL.'/admin/register' ?>" class="btn btn-sm btn-primary">
                  <i class="fa fa-plus"></i> New  
              </a>     
             <?php endif; ?>

            </h3> 
          </div>

          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Photo</th> 
                <th>Type</th> 
                <th>Member Since</th>
                <th>Tools</th> 
              </tr>
              </thead>
              <tbody>
              <!-- loop -->
              <?php foreach($data['users'] as $user) : ?>
              <tr>
                <td><?php $sr = 1; echo $sr++; ?></td>
                <td><?= $user->name ?></td> 
                <td><?= $user->email ?></td> 
                <td>
                  <img src="<?= ROOTURL.'/public/uploads/admin/'.$user->photo ?>" alt="" height="30">
                </td>    
                <td><?= ucwords($user->type) ?></td> 
                <td><?= date('d-m-Y h:i:s a', strtotime($user->created_at)) ?></td> 
                <?php if($_SESSION['user_type'] == 'superadmin') : ?> 
                <td>
                  <!-- edit -->
                  <a href="<?= ROOTURL.'/employee/update/'.$employee->id ?>" class="btn btn-primary btn-xs btn-flate" onclick="return confirm('Are you sure want to update it?');">  
                  <i class="fa fa-pencil-square"></i> Edit     
                  </a>    
                 <!-- / edit -->   
                  <form action="<?= ROOTURL.'/employee/delete/'.$employee->id  ?>" method="post" style="display: inline;">    
                    <button type="submit" class="btn btn-danger delete btn-xs btn-flate" onclick="return confirm('Are you sure want to delete this ?');">  
                      <i class="fa fa-trash"></i> Delete          
                    </button> 
                  </form>     
                </td>
                <?php else: ?>
                  <td><span class="label label-danger">You can't access it.</span></td>  
                <?php endif; ?>  

              </tr> 
            <?php endforeach; ?>
              <!-- loop -->
              </tbody>
              <tfoot>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Photo</th> 
                <th>Member Since</th> 
                <th>Type</th>
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


  