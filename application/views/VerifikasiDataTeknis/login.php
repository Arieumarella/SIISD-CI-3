 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>DAK SDA - Masuk</title>

 	<link rel="icon" href="<?= base_url(); ?>assets/admin/favicon.ico" type="image/x-icon">

 	<!-- Tell the browser to be responsive to screen width -->
 	<meta name="viewport" content="width=device-width, initial-scale=1">

 	<!-- Font Awesome -->
 	<link rel="stylesheet" href="<?= base_url(); ?>assets/admin/Ite/plugins/fontawesome-free/css/all.min.css">

 	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
 	<!-- icheck bootstrap -->
 	<link rel="stylesheet" href="<?= base_url(); ?>assets/admin/Ite/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
 	<!-- Theme style -->
 	<link rel="stylesheet" href="<?= base_url(); ?>assets/admin/Ite/dist/css/adminlte.min.css">
 	<!-- Google Font: Source Sans Pro -->
 	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

 	<style>
 		.boxLog {
            display: block;
            z-index: 1040;
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            overflow: auto;
            padding-left: 2px;
            background-color: #000;
            background-image: url('./assets/admin/Ite/dist/img/photo1.png');
            background-size: cover;  /* Menyesuaikan gambar agar mencakup seluruh area */
            background-position: center;  /* Pusatkan gambar */
        }
        
        .b-radius{
            border-radius: 25px;
        }
        .bg-login{
            background-color:rgb(255, 255, 255, 0.5);
        }
    </style>

</head>
<body class="hold-transition login-page">

  <div class="boxLog">
     <div class="login-box bg-login b-radius">
        <div class="login-logo">
           <div class="image" style="padding:10px;">
              <img src="<?= base_url(); ?>assets/admin/images/pu-icon.png" alt="User Image" class="elevation-4" style="width:110px;">
          </div>
          <a href="/"><b>DAK SDA</b></a>
      </div>
      <!-- /.login-logo -->
      <div class="card b-radius">
       <div class="card-body login-card-body b-radius">

          <?= $this->session->flashdata('psn'); ?>

          <p class="login-box-msg">Masuk untuk memulai sesi Anda</p>

          <form class="kt-form" action="<?= base_url(); ?>Login/prs_login" method="POST">
             <div class="input-group mb-3">
                <input class="form-control text-center" type="text" placeholder="ID Pengguna" name="idpengguna" autocomplete="off" value="";>

                <div class="input-group-append">
                   <div class="input-group-text">
                      <span class="fas fa-key"></span>
                  </div>
              </div>

          </div>
          <div class="input-group mb-3">
            <input class="form-control form-control-last  text-center" type="password" placeholder="Kata Sandi" name="sandi" value="">
            <div class="input-group-append">
               <div class="input-group-text">
                  <span class="fas fa-lock"></span>
              </div>
          </div>
      </div>

      <!-- /.col -->
      <div class="col-12">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
    </div>
    <div class="col-12">
        <a href="<?= base_url(); ?>Login/downloadUserManual" class="btn btn-success btn-block btn-flat">DOWNLOAD USER MANUAL SIISD</a>
    </div>
    <!-- /.col -->
</div>
</form>

</div>
<!-- /.login-card-body -->
</div>
</div>
</div>

<!-- jQuery -->
<script type="text/javascript" src="<?= base_url(); ?>assets/admin/Ite/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script type="text/javascript" src="<?= base_url(); ?>assets/admin/Ite/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
