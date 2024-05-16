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
            <form role="form" action="<?= base_url(); ?>InfrastrukturPBanjir/SimpanDataEdit" method="POST" data-select2-id="25">

                <input type="hidden" name="idEdit" value="<?= $id; ?>">

                <div class="content-header bg-warning">
                    <div class="container-fluid">
                      <div class="row m-0 p-0 text-left">
                        <div class="col-sm-7">
                          <h4 class="m-0">Form Tambah - Bangunan Pengendali Banjir</h4>
                      </div>

                      <div class="col-sm-5 text-right">
                        <a href="<?= base_url(); ?>InfrastrukturPBanjir" class="btn btn-default btn-sm" title="Batal"><i class="fa fa-undo"></i> Kembali</a>
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
                    <div style="background-color:red; color:#fff;">
                    </div>



                    <div class="row">


                        <div class="col-sm-3"> 
                            <div class="form-group" data-select2-id="32">
                                <label for="ws">Wilayah Sungai  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                <select id="ws" name="ws" class="form-control select2" required>
                                    <option value="<?= $dataDi->wsid; ?>"><?= $dataDi->nm_ws; ?></option>

                                </select>
                                <div class="invalid-feedback" id="pesan_irigasiid"></div>
                            </div>
                        </div>

                        <div class="col-sm-3"> 
                            <div class="form-group" data-select2-id="32">
                                <label for="das">Daerah Aliran Sungai  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                <select id="das" name="das" class="form-control select2" required>
                                    <option value="<?= $dataDi->dasid; ?>" selected disabled><?= $dataDi->nm_das; ?></option>

                                </select>
                                <div class="invalid-feedback" id="pesan_irigasiid"></div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="laDas">Luas DAS (Ha) <span class="text-danger" title="Wajib di Isi">*</span></label>
                                <input id="laDas" name="laDas" value="<?= $dataDi->dasluas; ?>" type="text" class="form-control  text-right number" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" required placeholder="Luas DAS (Ha)">
                                <div class="invalid-feedback" id="pesan_laPermen"></div>
                            </div>                      
                        </div> 

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="administartif">Wilayah Administratif <span class="text-danger" title="Wajib di Isi">*</span></label>
                                <input id="administartif" name="administartif" value="<?= $dataDi->wilayahAdministratif; ?>" type="text" class="form-control  text-right number" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" required placeholder="Wilayah Administratif">
                                <div class="invalid-feedback" id="pesan_laPermen"></div>
                            </div>                      
                        </div> 


                    </div>

                    <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Bangunan Sungai</div></div>

                    <div class="row">


                        <div class="col-sm-3">
                            <div class="form-group">
                             <label for="bendungan">Bendungan (Bh)  <span class="text-danger" title="Wajib di Isi">*</span></label>
                             <input id="bendungan" name="bendungan"  value="<?= $dataDi->bendungan; ?>" type="text" class="form-control text-right number areaTerdampakJarIrigasiT" required placeholder="Bendungan (Bh)" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); arealTerdampak()">
                             <div class="invalid-feedback" id="pesan_areaTerdampakJarIrigasiB"></div>
                         </div>                      
                     </div> 
                     <div class="col-sm-3">
                        <div class="form-group">
                           <label for="bendung">Bendung (Bh)  <span class="text-danger" title="Wajib di Isi">*</span></label>
                           <input id="bendung" name="bendung"  value="<?= $dataDi->bendung; ?>" type="text" class="form-control text-right number areaTerdampakJarIrigasiT" required placeholder="Bendung (Bh)" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); arealTerdampak()">
                           <div class="invalid-feedback" id="pesan_areaTerdampakJarIrigasiRR"></div>
                       </div>                      
                   </div> 
                   <div class="col-sm-3">
                    <div class="form-group">
                       <label for="tanggulSungai">Tanggul Sungai (m)  <span class="text-danger" title="Wajib di Isi">*</span></label>
                       <input id="tanggulSungai" name="tanggulSungai"  value="<?= $dataDi->tanggulSungai; ?>" type="text" class="form-control text-right number areaTerdampakJarIrigasiT" required placeholder="Tanggul Sungai (m)" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); arealTerdampak()">
                       <div class="invalid-feedback" id="pesan_areaTerdampakJarIrigasiRS"></div>
                   </div>                      
               </div> 
               <div class="col-sm-3">
                <div class="form-group">
                 <label for="kolamRetensi">Kolom Retensi (Bh)    <span class="text-danger" title="Wajib di Isi">*</span></label>
                 <input id="kolamRetensi" name="kolamRetensi"  value="<?= $dataDi->kolamRetensi; ?>" type="text" class="form-control text-right number areaTerdampakJarIrigasiT" required placeholder="Kolom Retensi (Bh)" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); arealTerdampak()">
                 <div class="invalid-feedback" id="pesan_areaTerdampakJarIrigasiRB"></div>
             </div>                      
         </div> 
         <div class="col-sm-3"> 
            <div class="form-group">
                <label for="perkuatanTebingSungai">Perkuatan Tebing Sungai (m) <span class="text-danger" title="Wajib di Isi">*</span></label>
                <input id="perkuatanTebingSungai" value="<?= $dataDi->perkuatanTebingSungai; ?>" name="perkuatanTebingSungai"  type="text" class="form-control kududisabled" required placeholder="Perkuatan Tebing Sungai (m)">
                <div class="invalid-feedback" id="pesan_areaTerdampakJarIrigasiT"></div>
            </div>
        </div>
        <div class="col-sm-3"> 
            <div class="form-group">
                <label for="sudetanKanalBanjir">Sudetan / Kanal Banjir (m) <span class="text-danger" title="Wajib di Isi">*</span></label>
                <input id="sudetanKanalBanjir" value="<?= $dataDi->sudetanKanalBanjir; ?>" name="sudetanKanalBanjir"  type="text" class="form-control kududisabled" required placeholder="Sudetan / Kanal Banjir (m)">
                <div class="invalid-feedback" id="pesan_areaTerdampakJarIrigasiT"></div>
            </div>
        </div>

        <div class="col-sm-3"> 
            <div class="form-group">
                <label for="checkDam">Check DAM (Bh) <span class="text-danger" title="Wajib di Isi">*</span></label>
                <input id="checkDam" value="<?= $dataDi->checkDam; ?>" name="checkDam"  type="text" class="form-control kududisabled" required placeholder="Check DAM (Bh) ">
                <div class="invalid-feedback" id="pesan_areaTerdampakJarIrigasiT"></div>
            </div>
        </div>

        <div class="col-sm-3"> 
            <div class="form-group">
                <label for="Groundsill">Grounsill (Bh)  <span class="text-danger" title="Wajib di Isi">*</span></label>
                <input id="Groundsill" value="<?= $dataDi->Groundsill; ?>" name="Groundsill"  type="text" class="form-control kududisabled" required placeholder="Grounsill (Bh) ">
                <div class="invalid-feedback" id="pesan_areaTerdampakJarIrigasiT"></div>
            </div>
        </div>




    </div>

    <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Dokumentasi</div></div>

    <div class="row">


        <div class="col-sm-3">
            <div class="form-group">
                <label for="bukuRencana">Buku Rencana <span class="text-danger" title="Wajib di Isi">*</span></label>
                <select id="bukuRencana" name="bukuRencana" class="form-control select2" required>
                    <option value="" selected disabled>- Pilih -</option>
                    <option value="Ada" <?= $dataDi->bukuRencana == 'Ada' ? 'selected':''; ?>>Ada</option>
                    <option value="Tidak Ada" <?= $dataDi->bukuRencana == 'Tidak Ada' ? 'selected':''; ?>>Tidak Ada</option>
                </select>
            </div>
        </div>  


        <div class="col-sm-3">
            <div class="form-group">
                <label for="skemaSistem">Skema Sistem <span class="text-danger" title="Wajib di Isi">*</span></label>
                <select id="skemaSistem" name="skemaSistem" class="form-control select2" required>
                    <option value="" selected disabled>- Pilih -</option>
                    <option value="Ada" <?= $dataDi->skemaSistem == 'Ada' ? 'selected':''; ?>>Ada</option>
                    <option value="Tidak Ada" <?= $dataDi->skemaSistem == 'Tidak Ada' ? 'selected':''; ?>>Tidak Ada</option>
                </select>
            </div>
        </div> 

        <div class="col-sm-3">
            <div class="form-group">
                <label for="petaGambar">Peta dan Gambar <span class="text-danger" title="Wajib di Isi">*</span></label>
                <select id="petaGambar" name="petaGambar" class="form-control select2" required>
                    <option value="" selected disabled>- Pilih -</option>
                    <option value="Ada" <?= $dataDi->petaGambar == 'Ada' ? 'selected':''; ?>>Ada</option>
                    <option value="Tidak Ada" <?= $dataDi->petaGambar == 'Tidak Ada' ? 'selected':''; ?>>Tidak Ada</option>
                </select>
            </div>
        </div> 

        <div class="col-sm-3">
            <div class="form-group">
                <label for="bukuDataAset">Buku Data Aset <span class="text-danger" title="Wajib di Isi">*</span></label>
                <select id="bukuDataAset" name="bukuDataAset" class="form-control select2" required>
                    <option value="" selected disabled>- Pilih -</option>
                    <option value="Ada" <?= $dataDi->bukuDataAset == 'Ada' ? 'selected':''; ?>>Ada</option>
                    <option value="Tidak Ada" <?= $dataDi->bukuDataAset == 'Tidak Ada' ? 'selected':''; ?>>Tidak Ada</option>
                </select>
            </div>
        </div>  

    </div> 



</div>


</div>

<div class="modal-footer justify-content-between">
    <div class="row">
      <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button> -->
      <!-- <a href="https://emondak.pu.go.id/sistemisd/InfrastrukturPBanjir" class="btn btn-default" title="Batal"><i class="fas fa-file"></i> Batal</a> -->
      <a href="<?= base_url(); ?>/InfrastrukturPBanjir" class="btn btn-default btn-sm" title="Batal"><i class="fas fa-file"></i> Batal</a>
      <button type="submit" class="btn btn-primary btn-sm btn-simpan">Simpan</button>
  </div>
</div>


<!-- form end -->

</div>
</div>

</div>
</section>

</form>

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

<script src="<?= base_url(); ?>assets/admin/Ite/plugins/select2-4.0.8/dist/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/admin/Ite/plugins/sweetalert2/sweetalert2.min.js" type="text/javascript"></script>

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

<script>
  $(document).ready(function(){

    $('#ws').on('change', function() {

        let ws = $('#ws').val();

        ajaxUntukSemua(base_url()+'InfrastrukturPBanjir/getDataDasById', {ws}, function(data) {

            let opt = `<option value="" selected disabled>- Pilih Wilayah Sungai -</option>`;

            $.each(data, function(key, value) {
                opt += `<option value="${value.id_das}" >${value.nm_das}</option>`;
            })

            $('#das').html(opt);


        }, function(error) {
            console.log('Kesalahan:', error);
        });


    });


    $('.select2').select2({
      theme: 'default'

  })



});

</script>


