<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Victory Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?=base_url()?>assets/node_modules/mdi/css/materialdesignicons.min.css" />
  <link rel="stylesheet" href="<?=base_url()?>assets/node_modules/simple-line-icons/css/simple-line-icons.css" />
  <link rel="stylesheet" href="<?=base_url()?>assets/node_modules/flag-icon-css/css/flag-icon.min.css" />
  <link rel="stylesheet" href="<?=base_url()?>assets/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css" />
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css" />
  <!-- endinject -->
  <link rel="shortcut icon" href="<?=base_url()?>assets/images/favicon.png" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
      <div class="row">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-full-bg">
          <div class="row w-100">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-dark text-left p-5">
                <h2>Login</h2>
                <h4 class="font-weight-light">Hello! let's get started</h4>
                <form class="pt-5" id="login" />
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="admin_email" />
                    <i class="mdi mdi-account"></i>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"  name="admin_password"/>
                    <i class="mdi mdi-eye"></i>
                  </div>
                  <div class="mt-5">
                    <a class="btn btn-block btn-warning btn-lg font-weight-medium" onclick='login()'>Login</a>
                  </div>
                  <div class="mt-3 text-center">
                    <a href="#" class="auth-link text-white">Forgot password?</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->


  <script src="<?=base_url()?>assets/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="<?=base_url()?>assets/node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="<?=base_url()?>assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?=base_url()?>assets/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="<?=base_url()?>assets/js/off-canvas.js"></script>
  <script src="<?=base_url()?>assets/js/hoverable-collapse.js"></script>
  <script src="<?=base_url()?>assets/js/misc.js"></script>
  <script src="<?=base_url()?>assets/js/settings.js"></script>
  <script src="<?=base_url()?>assets/js/todolist.js"></script>
  <!-- endinject -->


  <script type='text/javascript'>

    function login()
    {
        $.ajax({
            url : "<?php echo site_url('login/login_admin');?>",
            type: "POST",
            data: $('#login').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               console.log(data);
               alert('Login Succuess!');
               location.href = "<?php echo base_url() ?>dashboard";
                
            },
            error: function (error)
            {
                
                alert('Login Failed');
                // console.log(error);
            }
        });
    }

</script>
</body>

</html>
