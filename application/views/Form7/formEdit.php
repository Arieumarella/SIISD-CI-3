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
            <form role="form" action="<?= base_url(); ?>Form7/SimpanDataEdit" method="POST" data-select2-id="25">

                <input type="hidden" name="idEdit" value="<?= $id; ?>">

                <div class="content-header bg-warning">
                    <div class="container-fluid">
                      <div class="row m-0 p-0 text-left">
                        <div class="col-sm-7">
                          <h4 class="m-0">Form 7 : P3A,GP3A,IP3A</h4>
                      </div>

                      <div class="col-sm-5 text-right">
                        <a href="<?= base_url(); ?>Form7" class="btn btn-default btn-sm" title="Batal"><i class="fa fa-undo"></i> Kembali</a>
                        <button type="submit" class="btn btn-primary btn-sm btn-simpan"><i class="fas fa-archive"></i> Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <section class="content" data-select2-id="24">

            <div class="container-fluid" data-select2-id="23">

                <!-- box data teknis -->
                <div class="row" data-select2-id="22">

                    <div class="card-body p-0 " data-select2-id="21">



                        <!-- form start -->
                        <div class="modal-body" data-select2-id="20">

                            <?= $this->session->flashdata('psn'); ?>

                            <div style="background-color:red; color:#fff;">
                            </div>

                            <div class="row">
                                <div class="col-sm-6" data-select2-id="33">
                                    <div class="form-group" data-select2-id="32">
                                        <label for="in_irigasiid">Nomeklatur/ Nama D.I.  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                        <select id="in_irigasiid" name="irigasiid" class="form-control select3" required>
                                           <option value="<?= $id; ?>"><?= $dataDi->nama; ?></option>
                                       </select>
                                       <div class="invalid-feedback" id="pesan_irigasiid"></div>
                                   </div>


                               </div> 

                               <div class="col-sm-4"> 
                                <div class="form-group">
                                    <label for="in_laPermen">Luas Daerah Irigasi Berdasarkan Permen 14/2015 (Ha)  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                    <input id="in_laPermen" name="laPermen" value="<?= str_replace('.', ',', $dataDi->lper); ?>" type="text" class="form-control  text-right number" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" placeholder="Luas Daerah Irigasi Berdasarkan Permen 14/2015 (Ha)" readonly>
                                    <div class="invalid-feedback" id="pesan_laPermen"></div>
                                </div>
                            </div>
                        </div>


                        <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Jumlah P3A/GP3A/IP3A</div></div>

                        <div class="row">
                         <div class="col-sm-8"></div><div class="col-sm-4" style="border:thin solid #e6e6e6;"><div class="row">

                            <div class="col-sm-4">



                                <div class="form-group">
                                    <label for="totAllP3A">P3A</label>
                                    <input id="totAllP3A" value="<?= str_replace('.', ',', $dataDi->P3Ajml); ?>" type="text" class="form-control kududisabled" placeholder="P3A" readonly>
                                    <div class="invalid-feedback" id="pesan_P3Ajml"></div>
                                </div>

                            </div>     
                            <div class="col-sm-4">



                                <div class="form-group">
                                    <label for="totAllGP3A">GP3A</label>
                                    <input id="totAllGP3A" value="<?= str_replace('.', ',', $dataDi->GP3Ajml); ?>" type="text" class="form-control kududisabled" placeholder="GP3A" readonly>
                                    <div class="invalid-feedback" id="pesan_GP3Ajml"></div>
                                </div>

                            </div>     
                            <div class="col-sm-4">



                                <div class="form-group">
                                    <label for="totAllIP3A">IP3A</label>
                                    <input id="totAllIP3A" value="<?= str_replace('.', ',', $dataDi->IP3Ajml); ?>" type="text" class="form-control kududisabled" placeholder="IP3A" readonly>
                                    <div class="invalid-feedback" id="pesan_IP3Ajml"></div>
                                </div>

                            </div> 

                        </div></div>
                    </div>

                    <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Berbadan Hukum</div></div>

                    <div class="row">
                       <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Aktif</h5><div class="row">

                        <div class="col-sm-4">

                            <div class="form-group">
                                <label for="P3A1">P3A</label>
                                <input id="P3A1" name="P3ABhAktif" value="<?= str_replace('.', ',', $dataDi->P3ABhAktif); ?>" type="text" class="form-control number text-right" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); tambahKan('P3A')"  placeholder="P3A">
                                <div class="invalid-feedback" id="pesan_P3ABhAktif"></div>
                            </div>



                        </div> 
                        <div class="col-sm-4">

                            <div class="form-group">
                                <label for="GP3A1">GP3A</label>
                                <input id="GP3A1" name="GP3ABhAktif" value="<?= str_replace('.', ',', $dataDi->GP3ABhAktif); ?>" type="text" class="form-control text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); tambahKan('GP3A')" placeholder="GP3A">
                                <div class="invalid-feedback" id="pesan_GP3ABhAktif"></div>
                            </div>



                        </div> 
                        <div class="col-sm-4">

                            <div class="form-group">
                                <label for="IP3A1">IP3A</label>
                                <input id="IP3A1" name="IP3ABhAktif" value="<?= str_replace('.', ',', $dataDi->IP3ABhAktif); ?>" type="text" class="form-control text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); tambahKan('IP3A')" placeholder="IP3A">
                                <div class="invalid-feedback" id="pesan_IP3ABhAktif"></div>
                            </div>



                        </div> 

                    </div></div>


                    <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Tidak Aktif</h5><div class="row">

                        <div class="col-sm-4">

                            <div class="form-group">
                                <label for="P3A2">P3A</label>
                                <input id="P3A2" name="P3ABhTidakAktif" value="<?= str_replace('.', ',', $dataDi->P3ABhTidakAktif); ?>" type="text" class="form-control number text-right" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); tambahKan('P3A')" placeholder="P3A">
                                <div class="invalid-feedback" id="pesan_P3ABhTidakAktif"></div>
                            </div>



                        </div> 
                        <div class="col-sm-4">

                            <div class="form-group">
                                <label for="GP3A2">GP3A</label>
                                <input id="GP3A2" name="GP3ABhTidakAktif" value="<?= str_replace('.', ',', $dataDi->GP3ABhTidakAktif); ?>" type="text" class="form-control text-right number" placeholder="GP3A" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); tambahKan('GP3A')">
                                <div class="invalid-feedback" id="pesan_GP3ABhTidakAktif"></div>
                            </div>



                        </div> 
                        <div class="col-sm-4">

                            <div class="form-group">
                                <label for="IP3A2">IP3A</label>
                                <input id="IP3A2" name="IP3ABhTidakAktif" value="<?= str_replace('.', ',', $dataDi->IP3ABhTidakAktif); ?>" type="text" class="form-control text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); tambahKan('IP3A')" placeholder="IP3A">
                                <div class="invalid-feedback" id="pesan_IP3ABhTidakAktif"></div>
                            </div>



                        </div> 

                    </div></div>




                    <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Jumlah</h5><div class="row">

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="P3ATotal">P3A</label>
                                <input id="P3ATotal" value="<?= str_replace('.', ',', $dataDi->P3ABhJumlah); ?>"  name="P3ABhJumlah" type="text" class="form-control kududisabled" placeholder="P3A" readonly>
                                <div class="invalid-feedback" id="pesan_P3ABhJumlah"></div>
                            </div>

                        </div> 
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="GP3ATotal">GP3A</label>
                                <input id="GP3ATotal" value="<?= str_replace('.', ',', $dataDi->GP3ABhJumlah); ?>" name="GP3ABhJumlah" type="text" class="form-control kududisabled" placeholder="GP3A" readonly>
                                <div class="invalid-feedback" id="pesan_GP3ABhJumlah"></div>
                            </div>

                        </div> 
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="IP3ATotal">IP3A</label>
                                <input id="IP3ATotal" value="<?= str_replace('.', ',', $dataDi->IP3ABhJumlah); ?>" type="text" name="IP3ABhJumlah" class="form-control kududisabled" placeholder="IP3A" readonly>
                                <div class="invalid-feedback" id="pesan_IP3ABhJumlah"></div>
                            </div>

                        </div> 

                    </div></div>
                </div>

                <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Belum Berbadan Hukum</div></div>

                <div class="row">
                   <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Aktif</h5><div class="row">

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="P3Ax1">P3A</label>
                            <input id="P3Ax1" name="P3ABelumBhAktif" value="<?= str_replace('.', ',', $dataDi->P3ABelumBhAktif); ?>" type="text" class="form-control number text-right" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBelumBerbadan('P3A')" placeholder="P3A">
                            <div class="invalid-feedback" id="pesan_P3ABelumBhAktif"></div>
                        </div>



                    </div> 
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="GP3Ax1">GP3A</label>
                            <input id="GP3Ax1" name="GP3ABelumBhAktif" value="<?= str_replace('.', ',', $dataDi->GP3ABelumBhAktif); ?>" type="text" class="form-control text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBelumBerbadan('GP3A')" placeholder="GP3A">
                            <div class="invalid-feedback" id="pesan_GP3ABelumBhAktif"></div>
                        </div>



                    </div> 
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="IP3Ax1">IP3A</label>
                            <input id="IP3Ax1" name="IP3ABelumBhAktif" value="<?= str_replace('.', ',', $dataDi->IP3ABelumBhAktif); ?>" type="text" class="form-control text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBelumBerbadan('IP3A')" placeholder="IP3A">
                            <div class="invalid-feedback" id="pesan_IP3ABelumBhAktif"></div>
                        </div>



                    </div> 

                </div></div>




                <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Tidak Aktif</h5><div class="row">

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="P3Ax2">P3A</label>
                            <input id="P3Ax2" name="P3ABelumBhTidakAktif" value="<?= str_replace('.', ',', $dataDi->P3ABelumBhTidakAktif); ?>" type="text" class="form-control number text-right" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBelumBerbadan('P3A')" placeholder="P3A">
                            <div class="invalid-feedback" id="pesan_P3ABelumBhTidakAktif"></div>
                        </div>



                    </div> 
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="GP3Ax2">GP3A</label>
                            <input id="GP3Ax2" name="GP3ABelumBhTidakAktif" value="<?= str_replace('.', ',', $dataDi->GP3ABelumBhTidakAktif); ?>" type="text" class="form-control text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBelumBerbadan('GP3A')" placeholder="GP3A">
                            <div class="invalid-feedback" id="pesan_GP3ABelumBhTidakAktif"></div>
                        </div>



                    </div> 
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="IP3Ax2">IP3A</label>
                            <input id="IP3Ax2" name="IP3ABelumBhTidakAktif" value="<?= str_replace('.', ',', $dataDi->IP3ABelumBhTidakAktif); ?>" type="text" class="form-control text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBelumBerbadan('IP3A')" placeholder="IP3A">
                            <div class="invalid-feedback" id="pesan_IP3ABelumBhTidakAktif"></div>
                        </div>



                    </div> 

                </div></div>




                <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Jumlah</h5><div class="row">

                    <div class="col-sm-4"> 
                        <div class="form-group">
                            <label for="P3AxTotal">P3A</label>
                            <input id="P3AxTotal" value="<?= str_replace('.', ',', $dataDi->P3ABelumBhJumlah); ?>" type="text" name="P3ABelumBhJumlah" class="form-control kududisabled" placeholder="P3A" readonly>
                            <div class="invalid-feedback" id="pesan_P3ABelumBhJumlah"></div>
                        </div>



                    </div> 
                    <div class="col-sm-4"> 
                        <div class="form-group">
                            <label for="GP3AxTotal">GP3A</label>
                            <input id="GP3AxTotal" value="<?= str_replace('.', ',', $dataDi->GP3ABelumBhJumlah); ?>" type="text" class="form-control kududisabled" placeholder="GP3A" readonly>
                            <div class="invalid-feedback" id="pesan_GP3ABelumBhJumlah"></div>
                        </div>



                    </div> 
                    <div class="col-sm-4"> 
                        <div class="form-group">
                            <label for="IP3AxTotal">IP3A</label>
                            <input id="IP3AxTotal" value="<?= str_replace('.', ',', $dataDi->IP3ABelumBhJumlah); ?>" name="IP3ABelumBhJumlah" type="text" class="form-control kududisabled" placeholder="IP3A" readonly>
                            <div class="invalid-feedback" id="pesan_IP3ABelumBhJumlah"></div>
                        </div>



                    </div> 

                </div></div>
            </div>



        </div>

        <div class="modal-footer justify-content-between">
            <div class="row">
              <a href="<?= base_url(); ?>Form7" class="btn btn-default btn-sm" title="Batal"><i class="fa fa-undo"></i> Kembali</a>
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

<script>
  $(document).ready(function(){

    $('.select2').select2({
      theme: 'default'

  })

    hitungBelumBerbadan = function(Jns) {

        let aktif  = ($(`#${Jns}x1`).val() == '') ? 0 : parseFloat($(`#${Jns}x1`).val().replace(",", ".")),
        tidakAktif = ($(`#${Jns}x2`).val() == '') ? 0 : parseFloat($(`#${Jns}x2`).val().replace(",", ".")),
        total = aktif+tidakAktif;

        console.log($(`#${Jns}x1`).val(), Jns, aktif,tidakAktif)

        $(`#${Jns}xTotal`).val(total);
        hitungAll()

    }
    
    tambahKan = function(Jns) {

        let aktif  = ($(`#${Jns}1`).val() == '') ? 0 : parseFloat($(`#${Jns}1`).val().replace(",", ".")),
        tidakAktif = ($(`#${Jns}2`).val() == '') ? 0 : parseFloat($(`#${Jns}2`).val().replace(",", ".")),
        total = aktif+tidakAktif;

        $(`#${Jns}Total`).val(total);
        hitungAll()

    }


    function hitungAll() {

        let satu  = ($(`#P3ATotal`).val() == '') ? 0 : parseFloat($(`#P3ATotal`).val().replace(",", ".")),
        dua = ($(`#P3AxTotal`).val() == '') ? 0 : parseFloat($(`#P3AxTotal`).val().replace(",", ".")),
        total = satu+dua;

        $(`#totAllP3A`).val(total);


        satu  = ($(`#GP3ATotal`).val() == '') ? 0 : parseFloat($(`#GP3ATotal`).val().replace(",", "."));
        dua = ($(`#GP3AxTotal`).val() == '') ? 0 : parseFloat($(`#GP3AxTotal`).val().replace(",", "."));
        total = satu+dua;

        $(`#totAllGP3A`).val(total);

        satu  = ($(`#IP3ATotal`).val() == '') ? 0 : parseFloat($(`#IP3ATotal`).val().replace(",", "."));
        dua = ($(`#IP3AxTotal`).val() == '') ? 0 : parseFloat($(`#IP3AxTotal`).val().replace(",", "."));
        total = satu+dua;

        $(`#totAllIP3A`).val(total);

    }


    <?php if ($this->session->userdata('prive') == 'admin') { ?> 

        $('.select3').select2({
          placeholder: '-Tentukan Daerah Irigasi-',
          theme: 'default',
          ajax: {
            url: base_url() + "Form7/getDiTambahData",
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