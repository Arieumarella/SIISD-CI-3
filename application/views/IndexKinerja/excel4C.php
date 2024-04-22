<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>assets/admin/favicon.ico" />
    <title>SIISD || <?= $tittle; ?></title>

    <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/Ite/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/Ite/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/Ite/plugins/select2-4.0.8/dist/css/select2.min.css">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/Ite/plugins/sweetalert2/sweetalert2.min.css">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/Ite/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/Ite/plugins/datepicker/css/bootstrap-datepicker.min.css">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/Ite/dist/css/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <script type="text/javascript" src="<?= base_url(); ?>assets/admin/Ite/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/admin/Ite/plugins/jquery/jquery.validate.min.js"></script>
    <script type="text/javascript">
        function base_url() {
            return '<?= base_url(); ?>';
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
            z-index: 10;
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

<body class="m-0 p-0" id="bodyUtama">
    <div class="">
        <div class="row">
            <div class="col-lg-12">
                <div class="content-header bg-warning">
                    <div class="container-fluid">
                        <div class="row m-0 p-0 text-left">
                            <div class="col-sm-7">
                                <h4 class="m-0" id="titleBox">Format Excel 4C</h4>
                            </div>

                            <div class="col-5 text-right">
                                <a href="<?= base_url(); ?>IndexKinerja4C" class="btn btn-default btn-sm" aksi="table" title="Kembali"><i class="fas fa-home"></i> Kembali</a>

                            </div>
                        </div>
                    </div>
                </div>


                <section class="content">
                    <div class="container-fluid">

                        <!-- box data teknis -->
                        <div class="row">
                            <div class="card-body p-0 ">

                                <div class="modal-body html-content" id="DivIdToPrint">
                                    <div class="row">
                                        <div class="col-12">
                                            <?= $this->session->flashdata('psn'); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card card-dark">
                                                <div class="card-header">
                                                    <h3 class="card-title">Form Download Excel</h3>
                                                </div>


                                                <form class="form-horizontal" method="POST" action="<?= base_url(); ?>IndexKinerja4C/downloadExcel">
                                                    <div class="card-body">
                                                        <?php if ($this->session->userdata('prive') == 'admin') { ?>
                                                            <div class="form-group row">
                                                                <label for="prov" class="col-sm-3 col-form-label">Pilih Provinsi :</label>
                                                                <div class="col-sm-9">
                                                                    <select id="prov" name="prov" class="form-control form-control-sm select2" required>
                                                                        <option selected="" value="" selected disabled>- Pilih Provinsi -</option>
                                                                        <?php foreach ($dataProv as $key => $value) { ?>
                                                                            <option value="<?= $value->provid; ?>"><?= $value->provinsi; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="kab" class="col-sm-3 col-form-label">Pilih Kab/Kota :</label>
                                                                <div class="col-sm-9">
                                                                    <select id="kab" name="kab" class="form-control form-control-sm select2" required>
                                                                        <option selected="" value="" selected disabled>- Pilih Kab/Kota -</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <button type="submit" class="btn btn-success float-right">Download</button>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="card card-dark">
                                                <div class="card-header">
                                                    <h3 class="card-title">Form Upload Excel</h3>
                                                </div>

                                                <form class="form-horizontal" action="<?= base_url(); ?>IndexKinerja4C/prosesUploadExcel" method="POST" enctype="multipart/form-data">
                                                    <div class="card-body">
                                                        <?php if ($this->session->userdata('prive') == 'admin') { ?>
                                                            <div class="form-group row">
                                                                <label for="prov-upload" class="col-sm-3 col-form-label">Pilih Provinsi :</label>
                                                                <div class="col-sm-9">
                                                                    <select id="prov-upload" name="prov-upload" class="form-control form-control-sm select2" required>
                                                                        <option selected="" value="" selected disabled>- Pilih Provinsi -</option>
                                                                        <?php foreach ($dataProv as $key => $value) { ?>
                                                                            <option value="<?= $value->provid; ?>"><?= $value->provinsi; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="kab-upload" class="col-sm-3 col-form-label">Pilih Kab/Kota :</label>
                                                                <div class="col-sm-9">
                                                                    <select id="kab-upload" name="kab-upload" class="form-control form-control-sm select2" required>
                                                                        <option selected="" value="" selected disabled>- Pilih Kab/Kota -</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="form-group row">
                                                            <label for="fileExcel" class="col-sm-3 col-form-label">Input File Excel :</label>
                                                            <div class="col-sm-9">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="fileExcel" name="fileExcel" accept=".xlsx, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
                                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                                </div>
                                                                <script>
                                                                    document.getElementById("fileExcel").addEventListener("change", function() {
                                                                        var fileName = this.files[0].name;
                                                                        var label = document.querySelector(".custom-file-label");
                                                                        label.textContent = fileName;
                                                                    });
                                                                </script>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-success float-right">Upload</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

            </div>
            </section>
        </div>
    </div>


    </div>
    <!-- /.content-wrapper -->


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
    <!-- page script -->

    <script src="<?= base_url(); ?>assets/admin/Ite/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js" type="text/javascript"></script>

    <script src="<?= base_url(); ?>assets/admin/Ite/plugins/select2-4.0.8/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>assets/admin/Ite/plugins/sweetalert2/sweetalert2.min.js" type="text/javascript"></script>

    <script>
        $(document).ready(function() {

            $('.select2').select2({
                theme: 'default'
            })


            $('#prov').change(function() {
                let val = $(this).val();

                $.ajax({
                    url: base_url() + 'IndexKinerja4C/getDataKabKota',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        prov: val
                    },
                    success: function(data) {

                        let opt = `<option selected value="" disabled>- Pilih Kab/Kota -</option>`;

                        $.each(data, function(index, obj) {

                            opt += `<option value="${obj.kotakabid}" >${obj.kemendagri}</option>`;

                        });

                        $('#kab').html(opt);

                    },
                    error: function(xhr, status, error) {
                        console.error('Terjadi kesalahan:', status, error);
                    }
                });

            });


            $('#prov-upload').change(function() {
                let val = $(this).val();

                $.ajax({
                    url: base_url() + 'IndexKinerja4C/getDataKabKota',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        prov: val
                    },
                    success: function(data) {

                        let opt = `<option selected value="" disabled>- Pilih Kab/Kota -</option>`;

                        $.each(data, function(index, obj) {

                            opt += `<option value="${obj.kotakabid}" >${obj.kemendagri}</option>`;

                        });

                        $('#kab-upload').html(opt);

                    },
                    error: function(xhr, status, error) {
                        console.error('Terjadi kesalahan:', status, error);
                    }
                });

            });

        });
    </script>
</body>