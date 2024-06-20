<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>assets/admin/favicon.ico" />

  <title>SIISD || <?= $tittle; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/Ite/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Toastr  -->
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin/toastr/toastr.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/Ite/plugins/datatables/dataTables.bootstrap4.css">
  <!-- Theme style -->


  <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/Ite/dist/css/styles.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/Ite/plugins/sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/Ite/plugins/select2-4.0.8/dist/css/select2.min.css">

  <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/Ite/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/Ite/plugins/datepicker/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/Ite/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/Ite/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <style>
    .table {
      font-size: 12px;
    }

    .table thead {
      background-color: #18978F;
      color: #fff;
    }

    .table th {
      padding: 4px;
      margin: 0px;
      text-align: center;
      vertical-align: center;
    }

    .table td {
      padding: 4px;
      margin: 0px;
    }

    .number,
    .disabled_nilai {
      text-align: right;
    }

    .tr_0 {
      background-color: #FFF;
    }

    .tr_1 {
      background-color: #F7ECDE;
    }

    tbody tr:hover {
      background-color: #E9DAC1;
    }
  </style>


  <!-- jQuery -->
  <script type="text/javascript" src="<?= base_url(); ?>assets/admin/Ite/plugins/jquery/jquery.min.js"></script>
  <script type="text/javascript" src="<?= base_url(); ?>assets/admin/Ite/plugins/jquery/jquery.validate.min.js"></script>
  <!-- Jquery Overlay -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-loading-overlay/2.1.7/loadingoverlay.min.js" integrity="sha512-hktawXAt9BdIaDoaO9DlLp6LYhbHMi5A36LcXQeHgVKUH6kJMOQsAtIw2kmQ9RERDpnSTlafajo6USh9JUXckw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Data Table -->
  <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>

  <script type="text/javascript">
    function base_url() {
      return '<?= base_url(); ?>';
    }

    $.LoadingOverlaySetup({
      background: "rgba(0, 0, 0, 0.5)",
      textAutoResize: true,
      text: 'Loading . .',
      textAnimation: 'pulse'
    });

    function ajaxUntukSemua(url, requestData, onSuccess, onError) {
      $.ajax({
        url: url,
        type: 'POST',
        data: requestData,
        dataType: 'json',
        success: function(data) {
          onSuccess(data);
        },
        error: function(xhr, status, error) {
          onError(error);
        }
      });
    }
  </script>

  <style>
    .tableFixHead {
      overflow-y: auto;
      height: 250px;
    }

    .tableFixHead thead {
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .panel-fullscreen {
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
      background-color: #54BAB9;
      padding-left: 2px;
    }

    .panel-fullscreen2 {
      display: block;
      z-index: 104000;
      position: fixed;
      width: 100%;
      height: 100%;
      top: 0;
      right: 0;
      left: 0;
      bottom: 0;
      /*overflow: auto;*/
      background-color: #54BAB9;
      padding-left: 2px;

      overflow-y: hidden;
      overflow-x: hidden;
    }

    .overflowBody {
      overflow-y: hidden;
      overflow-x: hidden;
    }

    .is-invalid+.select2-container--default .select2-selection--single {
      border: 1px solid red;
    }
  </style>

</head>

<body id="bodyUtama" class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <?php $this->load->view('tamplate/' . $NavbarTop); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php $this->load->view('tamplate/' . $NavbarLeft); ?>
    <!-- /.Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?php $this->load->view($content); ?>
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <?php $this->load->view('tamplate/' . $footer_content); ?>
  </div>
  <!-- ./wrapper -->


  <!-- Bootstrap 4 -->
  <script type="text/javascript" src="<?= base_url(); ?>assets/admin/Ite/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script type="text/javascript" src="<?= base_url(); ?>assets/admin/Ite/plugins/chart.js/Chart.min.js"></script>
  <!-- DataTables -->
  <script type="text/javascript" src="<?= base_url(); ?>assets/admin/Ite/plugins/datatables/jquery.dataTables.js"></script>
  <script type="text/javascript" src="<?= base_url(); ?>assets/admin/Ite/plugins/datatables/dataTables.bootstrap4.js"></script>
  <!-- FastClick -->
  <script type="text/javascript" src="<?= base_url(); ?>assets/admin/Ite/plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script type="text/javascript" src="<?= base_url(); ?>assets/admin/Ite/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script type="text/javascript" src="<?= base_url(); ?>assets/admin/Ite/dist/js/demo.js"></script>
  <!-- Tooltip -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <!-- Toastr -->
  <script type="text/javascript" src="<?= base_url(); ?>assets/admin/toastr/toastr.min.js"></script>
  <!-- page script -->

  <script src="<?= base_url(); ?>assets/admin/Ite/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js" type="text/javascript"></script>

  <script src="<?= base_url(); ?>assets/admin/Ite/plugins/select2-4.0.8/dist/js/select2.full.min.js" type="text/javascript"></script>
  <script src="<?= base_url(); ?>assets/admin/Ite/plugins/sweetalert2/sweetalert2.min.js" type="text/javascript"></script>

  <script type="text/javascript">
    function cleanStr(str = null) {

      if (str == null) {
        return '';
      }

      strx = str.toString();

      if (!isNaN(strx)) {

        if (strx.indexOf('.') > -1) {

          let angka = parseFloat(str).toFixed(2);
          return angka;
        }

      }

      return str;

    }


    function bgTabelKolom(kondsisi = null) {

      if (kondsisi == 'epaksi') {
        return `background-color:#66e45d;`;
      } else {
        return '';
      }
    }


    function bgTabelKolomForm8(kondsisi = 0) {

      if (kondsisi != null) {
        return `background-color:#66e45d;`;
      } else {
        return '';
      }
    }
  </script>


  <script type="text/javascript">
    $(document).ready(function() {

      $('[data-toggle="tooltip"]').tooltip();

      toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }


      $('#in_kuTaAktifX').change(function() {
        let tahun = $(this).val();

        window.location.href = base_url() + 'Dashboard/setTahun/' + tahun;


      });


    });
  </script>


</body>

</html>