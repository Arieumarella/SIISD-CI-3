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
            <form role="form" action="<?= base_url(); ?>Form9/SimpanDataEdit" method="POST" data-select2-id="25">

                <input type="hidden" name="idEdit" value="<?= $id; ?>">

                <div class="content-header bg-warning">
                    <div class="container-fluid">
                      <div class="row m-0 p-0 text-left">
                        <div class="col-sm-7">
                          <h4 class="m-0">Form 9 : AREAL TERDAMPAK DAN IKSI</h4>
                      </div>

                      <div class="col-sm-5 text-right">
                        <a href="<?= base_url(); ?>Form9" class="btn btn-default btn-sm" title="Batal"><i class="fa fa-undo"></i> Kembali</a>
                        <button type="submit" class="btn btn-primary btn-sm btn-simpan"><i class="fas fa-archive"></i> Simpan Perubahan</button>
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


                        <div class="col-sm-6"> 
                            <div class="form-group" data-select2-id="32">
                                <label for="in_irigasiid">Nomeklatur/ Nama D.I.  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                <select id="in_irigasiid" name="irigasiid" class="form-control select2" required>
                                 <option value="<?= $id; ?>"><?= $dataDi->nama; ?></option>
                             </select>
                             <div class="invalid-feedback" id="pesan_irigasiid"></div>
                         </div>
                     </div>

                     <div class="col-sm-4">
                        <div class="form-group">
                            <label for="in_laPermen">Luas Daerah Irigasi Berdasarkan Permen 14/2015 (Ha)  <span class="text-danger" title="Wajib di Isi">*</span></label>
                            <input id="in_laPermen" name="laPermen" value="<?= str_replace('.', ',', $dataDi->laPermen); ?>" type="text" class="form-control  text-right number" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" placeholder="Luas Daerah Irigasi Berdasarkan Permen 14/2015 (Ha)">
                            <div class="invalid-feedback" id="pesan_laPermen"></div>
                        </div>                      
                    </div> 


                </div>

                <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Areal Terdampak Kondisi Jaringan Irigasi (Ha)</div></div>

                <div class="row">


                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="in_areaTerdampakJarIrigasiB">Baik (Ha)</label>
                            <input id="in_areaTerdampakJarIrigasiB" name="areaTerdampakJarIrigasiB"  value="<?= $dataDi->areaTerdampakJarIrigasiB; ?>" type="text" class="form-control text-right number areaTerdampakJarIrigasiT" placeholder="Baik (Ha)" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); arealTerdampak()">
                            <div class="invalid-feedback" id="pesan_areaTerdampakJarIrigasiB"></div>
                        </div>                      
                    </div> 
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="in_areaTerdampakJarIrigasiRR">Rusak Ringan (Ha)</label>
                            <input id="in_areaTerdampakJarIrigasiRR" name="areaTerdampakJarIrigasiRR"  value="<?= $dataDi->areaTerdampakJarIrigasiRR; ?>" type="text" class="form-control text-right number areaTerdampakJarIrigasiT" placeholder="Rusak Ringan (Ha)" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); arealTerdampak()">
                            <div class="invalid-feedback" id="pesan_areaTerdampakJarIrigasiRR"></div>
                        </div>                      
                    </div> 
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="in_areaTerdampakJarIrigasiRS">Rusak Sedang (Ha)</label>
                            <input id="in_areaTerdampakJarIrigasiRS" name="areaTerdampakJarIrigasiRS"  value="<?= $dataDi->areaTerdampakJarIrigasiRS; ?>" type="text" class="form-control text-right number areaTerdampakJarIrigasiT" placeholder="Rusak Sedang (Ha)" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); arealTerdampak()">
                            <div class="invalid-feedback" id="pesan_areaTerdampakJarIrigasiRS"></div>
                        </div>                      
                    </div> 
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="in_areaTerdampakJarIrigasiRB">Rusak Berat (Ha)</label>
                            <input id="in_areaTerdampakJarIrigasiRB" name="areaTerdampakJarIrigasiRB"  value="<?= $dataDi->areaTerdampakJarIrigasiRB; ?>" type="text" class="form-control text-right number areaTerdampakJarIrigasiT" placeholder="Rusak Berat (Ha)" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); arealTerdampak()">
                            <div class="invalid-feedback" id="pesan_areaTerdampakJarIrigasiRB"></div>
                        </div>                      
                    </div> 
                    <div class="col-sm-2"> 
                        <div class="form-group">
                            <label for="in_areaTerdampakJarIrigasiT">Total (Ha)</label>
                            <input id="in_areaTerdampakJarIrigasiT_disabled" value="<?= $dataDi->areaTerdampakJarIrigasiT; ?>" name="areaTerdampakJarIrigasiT"  type="text" class="form-control kududisabled" placeholder="Total (Ha)" disabled="disabled">
                            <div class="invalid-feedback" id="pesan_areaTerdampakJarIrigasiT"></div>
                        </div>

                    </div> 


                </div>

                <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Indeks Kondisi Sistem Irigasi (%)</div></div>

                <div class="row">


                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="persentase1">Prasarana Fisik (Maks 45%)</label>
                            <input id="persentase1" name="iKSIPrasaranaFisik"  value="<?= $dataDi->iKSIPrasaranaFisik; ?>" type="text" class="form-control text-right number iKSIJumlah" nilaimaks="45" placeholder="Prasarana Fisik (Maks 45%)" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); indeksKondisi(45, 'persentase1');">
                            <div class="invalid-feedback" id="pesan_iKSIPrasaranaFisik"></div>
                        </div>                      
                    </div> 
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="persentase2">Produktivitas (Maks 15%)</label>
                            <input id="persentase2" name="iKSIProduktivitas"  value="<?= $dataDi->iKSIProduktivitas; ?>" type="text" class="form-control text-right number iKSIJumlah" nilaimaks="15" placeholder="Produktivitas (Maks 15%)" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); indeksKondisi(15, 'persentase2');">
                            <div class="invalid-feedback" id="pesan_iKSIProduktivitas"></div>
                        </div>                      
                    </div> 
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="persentase3">Sarana Penujang (Maks 10%)</label>
                            <input id="persentase3" name="iKSISaranaPenujang"  value="<?= $dataDi->iKSISaranaPenujang; ?>" type="text" class="form-control text-right number iKSIJumlah" nilaimaks="10" placeholder="Sarana Penujang (Maks 10%)" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); indeksKondisi(10, 'persentase3');">
                            <div class="invalid-feedback" id="pesan_iKSISaranaPenujang"></div>
                        </div>                      
                    </div> 
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="persentase4">Organisasi Personalia (Maks 15%)</label>
                            <input id="persentase4" name="iKSIOrgPersonalia"  value="<?= $dataDi->iKSIOrgPersonalia; ?>" type="text" class="form-control text-right number iKSIJumlah" nilaimaks="15" placeholder="Organisasi Personalia (Maks 15%)" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); indeksKondisi(15, 'persentase4');">
                            <div class="invalid-feedback" id="pesan_iKSIOrgPersonalia"></div>
                        </div>                      
                    </div> 
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="persentase5">Dokumentasi (Maks 5%)</label>
                            <input id="persentase5" name="iKSIDokumentasi"  value="<?= $dataDi->iKSIDokumentasi; ?>" type="text" class="form-control text-right number iKSIJumlah" nilaimaks="5" placeholder="Dokumentasi (Maks 5%)" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); indeksKondisi(5, 'persentase5');">
                            <div class="invalid-feedback" id="pesan_iKSIDokumentasi"></div>
                        </div>                      
                    </div> 
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="persentase6">P3A/GP3A/IP3A (Maks 10%)</label>
                            <input id="persentase6" name="iKSIPGI"  value="<?= $dataDi->iKSIPGI; ?>" type="text" class="form-control text-right number iKSIJumlah" nilaimaks="10" placeholder="P3A/GP3A/IP3A (Maks 10%)" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); indeksKondisi(10, 'persentase6');">
                            <div class="invalid-feedback" id="pesan_iKSIPGI"></div>
                        </div>                      
                    </div> 
                    <div class="col-sm-2"> 
                        <div class="form-group">
                            <label for="totalAll2">Jumlah (Maks 100%)</label>
                            <input id="totalAll2" name="iKSIJumlah"  value="<?= $dataDi->iKSIJumlah; ?>" type="text" class="form-control kududisabled" placeholder="Jumlah (Maks 100%)" disabled="disabled">
                            <div class="invalid-feedback" id="pesan_iKSIJumlah"></div>
                        </div>

                    </div> 


                </div>


            </div>

            <div class="modal-footer justify-content-between">
                <div class="row">
                  <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button> -->
                  <!-- <a href="https://emondak.pu.go.id/sistemisd/form9" class="btn btn-default" title="Batal"><i class="fas fa-file"></i> Batal</a> -->
                  <a href="<?= base_url(); ?>/Form9" class="btn btn-default btn-sm" title="Batal"><i class="fas fa-file"></i> Batal</a>
                  <button type="submit" class="btn btn-primary btn-sm btn-simpan">Simpan Perubahan</button>
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

<script>
  $(document).ready(function(){

    indeksKondisi = function (maxPersen,id){

        let val = $(`#${id}`).val();

        if (parseFloat(val) > parseFloat(maxPersen)) {
            Swal.fire(`Nilai Tidak Boleh Lebih Dari ${maxPersen}%`);
            $(`#${id}`).val(maxPersen);
        }

        let persentase1 = ($('#persentase1').val() == '') ? 0 : parseFloat($('#persentase1').val()),
        persentase2 = ($('#persentase2').val() == '') ? 0 : parseFloat($('#persentase2').val()),
        persentase3 = ($('#persentase3').val() == '') ? 0 : parseFloat($('#persentase3').val()),
        persentase4 = ($('#persentase4').val() == '') ? 0 : parseFloat($('#persentase4').val()),
        persentase5 = ($('#persentase5').val() == '') ? 0 : parseFloat($('#persentase5').val()),
        persentase6 = ($('#persentase6').val() == '') ? 0 : parseFloat($('#persentase6').val());


        $('#totalAll2').val(persentase1+persentase2+persentase3+persentase4+persentase5+persentase6);
    }

    arealTerdampak = function () {
        let in_areaTerdampakJarIrigasiB = ($('#in_areaTerdampakJarIrigasiB').val() == '') ? 0 : parseFloat($('#in_areaTerdampakJarIrigasiB').val().replace(",", ".")),
        in_areaTerdampakJarIrigasiRR = ($('#in_areaTerdampakJarIrigasiRR').val() == '') ? 0 : parseFloat($('#in_areaTerdampakJarIrigasiRR').val().replace(",", ".")),
        in_areaTerdampakJarIrigasiRS = ($('#in_areaTerdampakJarIrigasiRS').val() == '') ? 0 : parseFloat($('#in_areaTerdampakJarIrigasiRS').val().replace(",", ".")),
        in_areaTerdampakJarIrigasiRB = ($('#in_areaTerdampakJarIrigasiRB').val() == '') ? 0 : parseFloat($('#in_areaTerdampakJarIrigasiRB').val().replace(",", ".")),
        totAll = in_areaTerdampakJarIrigasiB+in_areaTerdampakJarIrigasiRR+in_areaTerdampakJarIrigasiRS+in_areaTerdampakJarIrigasiRB;

        $('#in_areaTerdampakJarIrigasiT_disabled').val(totAll);
    }


    $('.select2').select2({
      theme: 'default'

  })

    <?php if ($this->session->userdata('prive') == 'admin') { ?> 

        $('.select3').select2({
          placeholder: '-Tentukan Daerah Irigasi-',
          theme: 'default',
          ajax: {
            url: base_url() + "Form9/getDiTambahData",
            dataType: 'json',
            type: 'post',
            delay: 250,
            data: function (params) {
              var query = {
                searchDi: params.term
            };
            return query;
        },
        processResults: function (response) {

           response.data.unshift({ id: '', text: 'Tampilkan semua' });

           return {
              results: response.data 
          };
      },
      cache: true
  }
});
    <?php } ?>

});

</script>