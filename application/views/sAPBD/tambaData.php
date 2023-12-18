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
  <?php //echo link_tag('Ite/plugins/select2/css/select2.min.css'); ?>

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
    .tableFixHead          { overflow-y: auto; height: 250px;}
    .tableFixHead thead { position: sticky; top: 0; z-index:10;}
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
      background-color:#54BAB9;
      padding-left:2px;
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
      background-color:#54BAB9;
      padding-left:2px;

      overflow-y: hidden;
      overflow-x: hidden;
  }
  .overflowBody{
      overflow-y: hidden;
      overflow-x: hidden;
  }

  .is-invalid + .select2-container--default .select2-selection--single {
    border: 1px solid red;
}
</style>




</head>

<body class="m-0 p-0" id="bodyUtama">
   <!-- width:99%; height:100vh; -->
   <!-- hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed -->

   <!-- <div class="wrapper"> -->

      <!-- Content Wrapper. Contains page content -->
      <div class=""> <!-- content-wrapper -->
        <div class="" data-select2-id="28"> <!-- content-wrapper -->

            <div class="row m-0" data-select2-id="27">
              <!-- panel panel-default -->
              <div class="col-lg-12 p-0" data-select2-id="26">
                <form role="form" action="<?= base_url(); ?>SharingAPBD/SimpanData" method="POST" data-select2-id="25">

                  <div class="content-header bg-warning">
                    <div class="container-fluid">
                      <div class="row m-0 p-0 text-left">
                        <div class="col-sm-7">
                          <h4 class="m-0">Form 5 : SHARING APBD</h4>
                      </div>

                      <div class="col-sm-5 text-right">
                        <a href="<?= base_url(); ?>SharingAPBD" class="btn btn-default btn-sm" title="fa fa-undo"><i class="fa fa-undo"></i> Kembali</a>
                        <button type="submit" class="btn btn-primary btn-sm btn-simpan"><i class="fas fa-archive"></i> Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

              <!-- box data teknis -->
              <div class="row">
                <div class="card-body p-0 ">

                  <!-- form start -->

                  <div class="modal-body">

                    <?= $this->session->flashdata('psn'); ?>

                    <div class="row">
                        <form method="POST" action="<?= base_url(); ?>SharingAPBD/SimpanData">

                            <div class="col-sm-3" data-select2-id="7">

                                <div class="form-group" data-select2-id="6">
                                    <label for="prov">Provinsi  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                    <select id="prov" name="provid" class="form-control select2" required>

                                        <?php if ($this->session->userdata('prive') == 'admin') { ?>

                                            <option selected="" value="" selected disabled>-Pilih Provinsi-</option>
                                            <?php foreach ($dataProvinsi as $key => $value) { ?>
                                                <option  value="<?= $value->provid; ?>"><?= $value->provinsi; ?></option>
                                            <?php } ?>

                                        <?php }else{ ?>

                                            <option  value="<?= $dataProvinsi->provid; ?>"><?= $dataProvinsi->provinsi; ?></option>

                                        <?php } ?>


                                    </select>
                                    <div class="invalid-feedback" id="pesan_provid"></div>
                                </div>


                            </div> 

                            <div class="col-sm-3" data-select2-id="45">

                                <div class="form-group" data-select2-id="44">
                                    <label for="kabkota">Kab/Kota  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                    <select id="kabkota" name="kotakabid" class="form-control select2">

                                        <?php if ($this->session->userdata('prive') == 'admin') { ?>

                                            <option selected="" value="" selected disabled>-Pilih Kab/Kota-</option>


                                        <?php }else{ ?>

                                            <option  value="<?= $dataKabKota->kotakabid; ?>"><?= $dataKabKota->kemendagri; ?></option>

                                        <?php } ?>


                                    </select>
                                    <div class="invalid-feedback" id="pesan_kotakabid"></div>
                                </div>


                            </div> 

                            <div class="col-sm-3">


                                <div class="form-group">
                                    <label for="in_noDpa">No. DPA  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                    <input id="in_noDpa" name="noDpa" value="" type="text" class="form-control" placeholder="No. DPA">
                                    <div class="invalid-feedback" id="pesan_noDpa"></div>
                                </div>


                            </div> 

                            <div class="col-sm-3">


                                <div class="form-group">
                                    <label for="in_tanggal">Tanggal  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                    <input id="in_tanggal" name="tanggal" value="" type="text" class="form-control datepicker" placeholder="Tanggal" readonly="readonly" style="cursor: pointer; background: white;">
                                    <div class="invalid-feedback" id="pesan_tanggal"></div>
                                </div>


                            </div> 


                        </div>

                        <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;"><center><b>Alokasi APBD (Rp)</b></center></div></div>

                        <div class="card-body table-responsive p-0  tableFixHead divTable" style="position: relative; overflow-y: scroll; height: 100vh; width:95vw; background-color:#efebe9; padding:2px;">
                            <table class="table">
                                <thead id="thead_data">
                                    <tr id="boxThField0" style="background-color:#18978F; color:#fff;">
                                        <th style="border: thin solid #006666; " colspan="1" rowspan="2" class="text-center">No</th>
                                        <th style="border: thin solid #006666; " colspan="1" rowspan="2" class="text-center">Kegiatan</th>
                                        <th style="border: thin solid #006666; " colspan="2" rowspan="1" class="text-center">Alokasi APBD (Rp)</th>
                                    </tr>
                                    <tr id="boxThField1" style="background-color:#18978F; color:#fff;">
                                        <th style="border: thin solid #006666; " colspan="1" rowspan="1" class="text-center">APBD Non DAK</th>
                                        <th style="border: thin solid #006666; " colspan="1" rowspan="1" class="text-center">DAK</th>
                                    </tr>
                                </thead>

                                <tbody id="tbody_label">
                                    <?php $no=1; ?>
                                    <?php foreach ($dataLabel as $key => $value) { ?>
                                        <tr id="tr_aLabel_1">
                                            <td style="width:2%;"><?= $no; ?></td>

                                            <td class="col-sm-3" style="min-width:200px;">
                                                <?= $value->label; ?>                        
                                                <input id="in_labelid" name="idLabel[]" value="<?= $value->id; ?>" type="hidden">
                                                <div class="invalid-feedback" id="pesan_labelid"></div>
                                            </td>
                                            <td class="col-sm-3" style="min-width:100px; max-width:10%; ">


                                                <input id="in_apbdNonDak" name="apbdNonDak[]" value="" type="text" class="form-control form-control-sm text-right number" placeholder="APBD Non DAK" oninput="this.value = this.value.replace(/[^0-9,]/g, '');">
                                                <div class="invalid-feedback" id="pesan_apbdNonDak"></div>
                                            </td> 
                                            <td class="col-sm-3" style="min-width:100px; max-width:10%; ">


                                                <input id="in_dak" name="dak[]" value="" type="text" class="form-control form-control-sm text-right number" placeholder="DAK" oninput="this.value = this.value.replace(/[^0-9,]/g, '');">
                                                <div class="invalid-feedback" id="pesan_dak"></div>
                                            </td>
                                        </tr>
                                        <?php $no++; ?>
                                    <?php } ?>

                                </tbody>

                            </table>
                        </div>                    
                    </div>

                    <div class="modal-footer justify-content-between">
                        <div class="row">
                          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">fa fa-undo</button> -->
                          <!-- <a href="https://emondak.pu.go.id/sistemisd/form5" class="btn btn-default" title="fa fa-undo"><i class="fa fa-undo"></i> fa fa-undo</a> -->
                          <a href="https://emondak.pu.go.id/sistemisd/formteknis/index/5" class="btn btn-default btn-sm" title="fa fa-undo"><i class="fa fa-undo"></i> Kembali</a>
                          <button type="submit" class="btn btn-primary btn-sm btn-simpan">Simpan</button>
                      </div>
                  </div>

              </form>
              <!-- form end -->

          </div>
      </div>

  </div>
</section>



</div>
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
<script src="<?= base_url(); ?>assets/admin/Ite/plugins/datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>

<script src="<?= base_url(); ?>assets/admin/Ite/plugins/select2-4.0.8/dist/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/admin/Ite/plugins/sweetalert2/sweetalert2.min.js" type="text/javascript"></script>

<script>
  $(document).ready(function(){

    setDatePicker = $(".datepicker").datepicker({
      format: "yyyy-mm-dd",
      todayHighlight: true,
      autoclose: true
  }).attr("readonly", "readonly").css({"cursor":"pointer", "background":"white"});


    $('.select2').select2({
      theme: 'default'

  })


    <?php if ($this->session->userdata('prive') == 'admin') { ?>

        $('#prov').change(function() {
            var prov = $(this).val();

            ajaxUntukSemua(base_url()+'SharingAPBD/getDataKabKota', {prov}, function(data) {

                let opt = `<option value="" selected disabled>- Plih Kab/Kota -</option>`;

                $.each(data, function(key, value) {
                    opt += `<option value="${value.kotakabid}" >${value.kemendagri}</option>`;
                })

                $('#kabkota').html(opt);

            }, function(error) {
                console.log('Kesalahan:', error);
            });

        });

    <?php } ?>

});

</script>