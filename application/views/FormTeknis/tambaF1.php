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
                <form role="form" action="<?= base_url(); ?>FormTeknis1F/SimpanData" method="POST" data-select2-id="25">

                  <div class="content-header bg-warning">
                    <div class="container-fluid">
                      <div class="row m-0 p-0 text-left">
                        <div class="col-sm-7">
                          <h4 class="m-0">Form 1F : PROGRES PAIP</h4>
                      </div>

                      <div class="col-sm-5 text-right">
                        <a href="<?= base_url(); ?>FormTeknis1F" class="btn btn-default btn-sm" title="Batal"><i class="fas fa-file"></i> Batal</a>
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
                                <div class="col-sm-6" data-select2-id="33"> <!-- start box per input -->

                                    <?php if ($this->session->userdata('prive') == 'admin') { ?> 
                                        <div class="form-group" data-select2-id="32">
                                            <label for="in_irigasiid">Nomeklatur/ Nama D.I.  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                            <select id="in_irigasiid" name="irigasiid" class="form-control select3" required>

                                            </select>
                                            <div class="invalid-feedback" id="pesan_irigasiid"></div>
                                        </div>
                                    <?php }else{ ?>
                                        <div class="form-group" data-select2-id="32">
                                            <label for="in_irigasiid">Nomeklatur/ Nama D.I.  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                            <select id="in_irigasiid" name="irigasiid" class="form-control select2" required>
                                                <option value="" selected disabled>- Pilih D.I -</option>
                                                <?php foreach ($dataDi as $key => $value) { ?>
                                                    <option value="<?= $value->irigasiid; ?>"><?= $value->nama; ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="invalid-feedback" id="pesan_irigasiid"></div>
                                        </div>
                                    <?php } ?>

                                </div> <!-- end box per input -->

                                <div class="col-sm-4"> 
                                    <div class="form-group">
                                        <label for="in_laPermen">Luas Daerah Irigasi Berdasarkan Permen 14/2015 (Ha)  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                        <input id="in_laPermen" name="laPermen" value="" type="text" class="form-control  text-right number" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" placeholder="Luas Daerah Irigasi Berdasarkan Permen 14/2015 (Ha)">
                                        <div class="invalid-feedback" id="pesan_laPermen"></div>
                                    </div>
                                </div>
                            </div>


                            <!-- Row Luas Areal (Ha) -->
                            <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Inventarisasi Aset Irigasi</div></div>

                            <div class="row">
                                <div class="col-sm-2"> <!-- start box per input -->
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label for="tkpaiInvAsetIrigasiThn">Tahun</label>
                                        <input id="tkpaiInvAsetIrigasiThn" name="tkpaiInvAsetIrigasiThn" value="" type="text" class="form-control  text-right number" oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 4) this.value = this.value.slice(0, 4);" placeholder="Tahun" required>
                                        <div class="invalid-feedback" id="pesan_tkpaiInvAsetIrigasiThn"></div>
                                    </div>
                                </div> 

                                <div class="col-sm-2"> 
                                    <div class="form-group">
                                        <label for="tkpaiInvAsetIrigasiPsen">%</label>
                                        <input id="tkpaiInvAsetIrigasiPsen" name="tkpaiInvAsetIrigasiPsen" value="" type="text" class="form-control  text-right number" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" placeholder="Baku (Pemetaan&nbsp;IGT)" required>
                                        <div class="invalid-feedback" id="pesan_tkpaiInvAsetIrigasiPsen"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Row Luas Areal (Ha) -->


                            <!-- Row Luas Areal (Ha) -->
                            <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Perencanaan PAI</div></div>

                            <div class="row">
                                <div class="col-sm-2"> <!-- start box per input -->
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label for="tkpaiPerencanaanPAIThn">Tahun</label>
                                        <input id="tkpaiPerencanaanPAIThn" name="tkpaiPerencanaanPAIThn" value="" type="text" class="form-control  text-right number" oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 4) this.value = this.value.slice(0, 4);" placeholder="Tahun" required>
                                        <div class="invalid-feedback" id="psn_tkpaiPerencanaanPAIThn"></div>
                                    </div>
                                </div> 

                                <div class="col-sm-2"> 
                                    <div class="form-group">
                                        <label for="tkpaiPerencanaanPAIPsen">%</label>
                                        <input id="tkpaiPerencanaanPAIPsen" name="tkpaiPerencanaanPAIPsen" value="" type="text" class="form-control  text-right number" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" placeholder="Baku (Pemetaan&nbsp;IGT)" required>
                                        <div class="invalid-feedback" id="pesan_tkpaiPerencanaanPAIPsen"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Row Luas Areal (Ha) -->

                            <!-- Row Luas Areal (Ha) -->
                            <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Pelaksanaan PAI</div></div>

                            <div class="row">
                                <div class="col-sm-2"> <!-- start box per input -->
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label for="tkpaiPelaksanaanPAIThn">Tahun</label>
                                        <input id="tkpaiPelaksanaanPAIThn" name="tkpaiPelaksanaanPAIThn" value="" type="text" class="form-control  text-right number" oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 4) this.value = this.value.slice(0, 4);" placeholder="Tahun" required>
                                        <div class="invalid-feedback" id="psn_tkpaiPelaksanaanPAIThn"></div>
                                    </div>
                                </div> 

                                <div class="col-sm-2"> 
                                    <div class="form-group">
                                        <label for="tkpaiPelaksanaanPAIPsen">%</label>
                                        <input id="tkpaiPelaksanaanPAIPsen" name="tkpaiPelaksanaanPAIPsen" value="" type="text" class="form-control  text-right number" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" placeholder="Baku (Pemetaan&nbsp;IGT)" required>
                                        <div class="invalid-feedback" id="pesan_tkpaiPelaksanaanPAIPsen"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Row Luas Areal (Ha) -->

                            <!-- Row Luas Areal (Ha) -->
                            <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Evaluasi PAI</div></div>

                            <div class="row">
                                <div class="col-sm-2"> <!-- start box per input -->
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label for="tkpaiEvaluasiPAIThn">Tahun</label>
                                        <input id="tkpaiEvaluasiPAIThn" name="tkpaiEvaluasiPAIThn" value="" type="text" class="form-control  text-right number" oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 4) this.value = this.value.slice(0, 4);" placeholder="Tahun" required>
                                        <div class="invalid-feedback" id="psn_tkpaiEvaluasiPAIThn"></div>
                                    </div>
                                </div> 

                                <div class="col-sm-2"> 
                                    <div class="form-group">
                                        <label for="tkpaiEvaluasiPAIPsen">%</label>
                                        <input id="tkpaiEvaluasiPAIPsen" name="tkpaiEvaluasiPAIPsen" value="" type="text" class="form-control  text-right number" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" placeholder="Baku (Pemetaan&nbsp;IGT)" required>
                                        <div class="invalid-feedback" id="pesan_tkpaiEvaluasiPAIPsen"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Row Luas Areal (Ha) -->

                            <!-- Row Luas Areal (Ha) -->
                            <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Pemutakhiran Hasil Invent. AI</div></div>

                            <div class="row">
                                <div class="col-sm-2"> <!-- start box per input -->
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label for="tkpaiPethirHasilInventAIThn">Tahun</label>
                                        <input id="tkpaiPethirHasilInventAIThn" name="tkpaiPethirHasilInventAIThn" value="" type="text" class="form-control  text-right number" oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 4) this.value = this.value.slice(0, 4);" placeholder="Tahun" required>
                                        <div class="invalid-feedback" id="psn_tkpaiPethirHasilInventAIThn"></div>
                                    </div>
                                </div> 

                                <div class="col-sm-2"> 
                                    <div class="form-group">
                                        <label for="tkpaiPethirHasilInventAIPsen">%</label>
                                        <input id="tkpaiPethirHasilInventAIPsen" name="tkpaiPethirHasilInventAIPsen" value="" type="text" class="form-control  text-right number" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" placeholder="Baku (Pemetaan&nbsp;IGT)" required>
                                        <div class="invalid-feedback" id="pesan_tkpaiPethirHasilInventAIPsen"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Row Luas Areal (Ha) -->


                            <!-- Row Luas Areal (Ha) -->
                            <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">TAHAPAN KEGIATAN PENGELOLAAN ASET IRIGASI</div></div>

                            <div class="row">
                                <div class="col-sm-12"> <!-- start box per input -->
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea id="keterangan" name="keterangan" class="form-control " rows="3" placeholder="Keterangan"></textarea>
                                        <div class="invalid-feedback" id="psn_keterangan"></div>
                                    </div>
                                </div> 
                            </div>
                            <!-- End Row Luas Areal (Ha) -->



                        </div>

                        <div class="modal-footer justify-content-between">
                            <div class="row">
                              <a href="<?= base_url(); ?>FormTeknis1F" class="btn btn-default btn-sm" title="Batal"><i class="fas fa-file"></i> Batal</a>
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
    

    <?php if ($this->session->userdata('prive') == 'admin') { ?> 

        $('.select3').select2({
          placeholder: '-Tentukan Daerah Irigasi-',
          theme: 'default',
          ajax: {
            url: base_url() + "FormTeknis1F/getDiTambahData",
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