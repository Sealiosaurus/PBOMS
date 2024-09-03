<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<?php require_once('inc/header.php') ?>

<body>
  <script>
    start_loader()
  </script>
  <style>
    body {
      background-image: url("<?php echo validate_image($_settings->info('cover')) ?>");
      background-size: cover;
      background-repeat: no-repeat;
      background-color: #4287f5;
      background-position: center;
    }

    .login-title {
      text-shadow: 2px 2px black
    }

    .center {
      display: block;
      margin-left: auto;
      margin-right: auto;
    }

    #ip1 {
      border-radius: 18px;
      background: #ff5757;
      padding: 20px;
      width: 240px;
      height: 60px;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }

    #ip2 {
      border-radius: 25px;
      border: 2px solid #609;
      padding: 20px;
      width: 240px;
      height: 60px;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }
  </style>
<br>
<img src="../uploads/logo.png" alt="pblogo" class="center"><br>

<div class="signup-form">
        <form id="login-frm" action="" method="post">
            <div class="form-group">
                <input type="username" id="ip2" class="form-control" name="username" id="username" placeholder="Username" required="required">
            </div>
            <div class="form-group">
                <input type="password" id="ip2" class="form-control" name="password" id="password" placeholder="Password" required="required">
            </div>
            <div class="form-group">
                <input type="submit" name="btnsignin" class="btn btn-primary" value="GET STARTED" id="ip1"/>
            </div>
        </form>
    </div>




  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>

  <script>
    $(document).ready(function() {
      end_loader();
    })
  </script>
</body>

</html>