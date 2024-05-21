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
            <form role="form" action="<?= base_url(); ?>FormTeknis1D/SimpanData" method="POST" data-select2-id="25">

              <div class="content-header bg-warning">
                <div class="container-fluid">
                  <div class="row m-0 p-0 text-left">
                    <div class="col-sm-7">
                      <h4 class="m-0">Form 1D : ASET D.I.T</h4>
                  </div>

                  <div class="col-sm-5 text-right">
                    <a href="<?= base_url(); ?>FormTeknis1D" class="btn btn-default btn-sm" title="Kembali"><i class="fa fa-undo"></i> Kembali</a>
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
                        <!-- menampilkan kolom dengan normal ---------------------------------------------------------------------------------------------------------------------- -->
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



                        <!-- Row Luas Areal (Ha) -->
                        <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Luas&nbsp;Areal&nbsp;(Ha)</div></div>

                        <div class="row">
                            <div class="col-sm-3"> <!-- start box per input -->
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="in_laPermen">Berdasarkan Permen 14/2015  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                    <input id="in_laPermen" name="laPermen" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" placeholder="Berdasarkan Permen 14/2015" required readonly>
                                    <div class="invalid-feedback" id="pesan_laPermen"></div>
                                </div>
                            </div> 

                            <div class="col-sm-3"> 

                                <div class="form-group">
                                    <label for="in_laBaku">Baku (Pemetaan&nbsp;IGT)</label>
                                    <input id="in_laBaku" name="laBaku" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" placeholder="Baku (Pemetaan&nbsp;IGT)" required>
                                    <div class="invalid-feedback" id="pesan_laBaku"></div>
                                </div>

                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="in_laPotensial">Potensial (Pemetaan&nbsp;IGT)</label>
                                    <input id="in_laPotensial" name="laPotensial" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" placeholder="Potensial (Pemetaan&nbsp;IGT)" required >
                                    <div class="invalid-feedback" id="pesan_laPotensial"></div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="in_laFungsional">Fungsional (Pemetaan&nbsp;IGT)</label>
                                    <input id="in_laFungsional" name="laFungsional" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" placeholder="Fungsional (Pemetaan&nbsp;IGT)" required>
                                    <div class="invalid-feedback" id="pesan_laFungsional"></div>
                                </div>
                            </div>
                        </div>
                        <!-- End Row Luas Areal (Ha) -->


                        <!-- End Row Bangunan Utama -->
                        <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Bangunan Utama</div></div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="buPengambilanAirTawar">Pengambilan Air Tawar (bh)</label>
                                    <input id="buPengambilanAirTawar" name="buPengambilanAirTawar" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Pengambilan Air Tawar (bh)">
                                    <div class="invalid-feedback" id="pesan_buPengambilanAirTawar"></div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="buPengambilanAirAsin">Pengambilan Air Asin (bh)</label>
                                    <input id="buPengambilanAirAsin" name="buPengambilanAirAsin" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Pengambilan Air Asin (bh)">
                                    <div class="invalid-feedback" id="pesan_buPengambilanAirAsin"></div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="buStasiunPompa">Stasiun Pompa (bh)</label>
                                    <input id="buStasiunPompa" name="buStasiunPompa" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Stasiun Pompa (bh)">
                                    <div class="invalid-feedback" id="pesan_buStasiunPompa"></div>
                                </div>
                            </div>
                        </div>
                        <!-- End Row Bangunan Utama -->


                        <!-- Row Saluran -->
                        <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Saluran</div></div>

                        <div class="row">

                            <div class="col-sm-3" data-select2-id="9"> 
                                <div class="form-group" data-select2-id="8">
                                    <label for="sTipeSaluran">Tipe Saluran</label>
                                    <select id="sTipeSaluran" name="sTipeSaluran" class="form-control form-control-sm select2 " required>
                                        <option selected="" value="">-pilih-</option>
                                        <option value="Terbuka">Terbuka</option>
                                        <option value="Tertutup">Tertutup</option>
                                        <option value="Campuran">Campuran</option>
                                    </select>
                                    <div class="invalid-feedback" id="pesan_sTipeSaluran"></div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="sPrimer">Primer (m)</label>
                                    <input id="sPrimer" name="sPrimer" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Primer (m)">
                                    <div class="invalid-feedback" id="pesan_sPrimer"></div>
                                </div>
                            </div>

                            <div class="col-sm-3"> 
                                <div class="form-group">
                                    <label for="sSekunder">Sekunder (m)</label>
                                    <input id="sSekunder" name="sSekunder" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Sekunder (m)">
                                    <div class="invalid-feedback" id="pesan_sSekunder"></div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="sTersier">Tersier (m)</label>
                                    <input id="sTersier" name="sTersier" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Tersier (m)">
                                    <div class="invalid-feedback" id="pesan_sTersier"></div>
                                </div>
                            </div>

                            <div class="col-sm-3"> 
                                <div class="form-group">
                                    <label for="sPembuang">Pembuang (m)</label>
                                    <input id="sPembuang" name="sPembuang" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Pembuang (m)">
                                    <div class="invalid-feedback" id="pesan_sPembuang"></div>
                                </div>
                            </div>
                        </div>
                        <!-- End Row Saluran -->


                        <!-- Row Bangunan Pengatur dan Pengukur -->
                        <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Bangunan Pengatur</div></div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="bpPrimer">Bangunan Pintu Primer (bh)</label>
                                    <input id="bpPrimer" name="bpPrimer" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Bangunan Pintu Primer (bh)">
                                    <div class="invalid-feedback" id="pesan_bpPrimer"></div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="bpSekunder">Bangunan Pintu Sekunder (bh)</label>
                                    <input id="bpSekunder" name="bpSekunder" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Bangunan Pintu Sekunder (bh)">
                                    <div class="invalid-feedback" id="pesan_bpSekunder"></div>
                                </div>
                            </div>



                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="bpTersier">Bangunan Pintu Tersier (bh)</label>
                                    <input id="bpTersier" name="bpTersier" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Bangunan Pintu Tersier (bh)">
                                    <div class="invalid-feedback" id="pesan_bpTersier"></div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="bpPembuang">Bangunan Pintu Pembuang (bh)</label>
                                    <input id="bpPembuang" name="bpPembuang" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Bangunan Pintu Pembuang (bh)">
                                    <div class="invalid-feedback" id="pesan_bpPembuang"></div>
                                </div>
                            </div>
                        </div>
                        <!-- End Row Bangunan Pengatur dan Pengukur -->


                        <!-- Row Bangunan Pembawa -->
                        <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Bangunan Pembawa</div></div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="bpGorong">Gorong-Gorong (bh)</label>
                                    <input id="bpGorong" name="bpGorong" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Gorong-Gorong (bh)">
                                    <div class="invalid-feedback" id="pesan_bpGorong"></div>
                                </div>
                            </div>


                            <div class="col-sm-3"> 
                                <div class="form-group">
                                    <label for="bpTalang">Talang (m)</label>
                                    <input id="bpTalang" name="bpTalang" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Talang (m)">
                                    <div class="invalid-feedback" id="pesan_bpTalang"></div>
                                </div>
                            </div>

                        </div>
                        <!-- End Row Bangunan Pembawa -->

                        <!-- Row Bangunan Lindung -->
                        <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Bangunan Lindung</div></div>

                        <div class="row">
                            <div class="col-sm-3"> 
                                <div class="form-group">
                                    <label for="blinTanggul">Tanggul (bh)</label>
                                    <input id="blinTanggul" name="blinTanggul" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Tanggul (bh)">
                                    <div class="invalid-feedback" id="pesan_blinTanggul"></div>
                                </div>
                            </div> 

                            <div class="col-sm-3"> 
                                <div class="form-group">
                                    <label for="blinPerkuatanTebing">Perkuatan Tebing (m)</label>
                                    <input id="blinPerkuatanTebing" name="blinPerkuatanTebing" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Perkuatan Tebing (m)">
                                    <div class="invalid-feedback" id="pesan_blinPerkuatanTebing"></div>
                                </div>
                            </div>

                            <div class="col-sm-3"> 
                                <div class="form-group">
                                    <label for="blinPelimpah">Pelimpah (bh)</label>
                                    <input id="blinPelimpah" name="blinPelimpah" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Pelimpah (bh)">
                                    <div class="invalid-feedback" id="pesan_blinPelimpah"></div>
                                </div>
                            </div>
                        </div>
                        <!-- End Row Bangunan Lindung -->


                        <!-- Row Bangunan Pengatur dan Pengukur -->
                        <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Bangunan Pelengkap</div></div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="bkapJalanInspeksi">Jalan Inspeksi (m)</label>
                                    <input id="bkapJalanInspeksi" name="bkapJalanInspeksi" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Jalan Inspeksi (m)">
                                    <div class="invalid-feedback" id="pesan_bkapJalanInspeksi"></div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="bkapJembatan">Jembatan (bh)</label>
                                    <input id="bkapJembatan" name="bkapJembatan" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Jembatan (bh)">
                                    <div class="invalid-feedback" id="pesan_bkapJembatan"></div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="bkapKantorPengamat">Kantor Pengamat (bh)</label>
                                    <input id="bkapKantorPengamat" name="bkapKantorPengamat" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Kantor Pengamat (bh)">
                                    <div class="invalid-feedback" id="pesan_bkapKantorPengamat"></div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="bkapGudang">Gudang (bh)</label>
                                    <input id="bkapGudang" name="bkapGudang" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Gudang (bh)">
                                    <div class="invalid-feedback" id="pesan_bkapGudang"></div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="bkapRumahJaga">Rumah Jaga (bh)</label>
                                    <input id="bkapRumahJaga" name="bkapRumahJaga" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Rumah Jaga (bh)">
                                    <div class="invalid-feedback" id="pesan_bkapRumahJaga"></div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="bkapSanggarTani">Sanggar Tani (bh)</label>
                                    <input id="bkapSanggarTani" name="bkapSanggarTani" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Sanggar Tani (bh)">
                                    <div class="invalid-feedback" id="pesan_bkapSanggarTani"></div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="bkapElektrikal">Rumah Genset/Panel Elektrikal (bh)</label>
                                    <input id="bkapElektrikal" name="bkapElektrikal" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Rumah Genset/Panel Elektrikal (bh)">
                                    <div class="invalid-feedback" id="pesan_bkapElektrikal"></div>
                                </div>
                            </div>


                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="bkapKolamTandon">Kolam Tandon (bh)</label>
                                    <input id="bkapKolamTandon" name="bkapKolamTandon" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Kolam Tandon (bh)">
                                    <div class="invalid-feedback" id="pesan_bkapKolamTandon"></div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="bkapKolamPengendap">Kolam Pengendap (bh)</label>
                                    <input id="bkapKolamPengendap" name="bkapKolamPengendap" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Kolam Pengendap (bh)">
                                    <div class="invalid-feedback" id="pesan_bkapKolamPengendap"></div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="bkapKolamPencampur">Kolam Pencampur (bh)</label>
                                    <input id="bkapKolamPencampur" name="bkapKolamPencampur" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Kolam Pencampur (bh)">
                                    <div class="invalid-feedback" id="pesan_bkapKolamPencampur"></div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="bkapJetti">Jetti (m)</label>
                                    <input id="bkapJetti" name="bkapJetti" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Jetti (m)">
                                    <div class="invalid-feedback" id="pesan_bkapJetti"></div>
                                </div>
                            </div>
                        </div>
                        <!-- End Row Bangunan Pengatur dan Pengukur -->

                        <!-- Row Bangunan Pengatur dan Pengukur -->
                        <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Sarana</div></div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="saranaPintuAir">Pintu Air (bh)</label>
                                    <input id="saranaPintuAir" name="saranaPintuAir" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Pintu Air (bh)">
                                    <div class="invalid-feedback" id="pesan_saranaPintuAir"></div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="saranaAlatUkur">Alat Ukur (bh)</label>
                                    <input id="saranaAlatUkur" name="saranaAlatUkur" value="" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Alat Ukur (bh)">
                                    <div class="invalid-feedback" id="pesan_saranaAlatUkur"></div>
                                </div>
                            </div>
                        </div>
                        <!-- End Row Bangunan Pengatur dan Pengukur -->


                        <!-- Row Dokumentasi -->
                        <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Dokumentasi</div></div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="in_dokPeta">Peta</label>
                                    <select id="in_dokPeta" name="dokPeta" class="form-control" required>
                                        <option selected="" value="">-pilih-</option>
                                        <option class="in_dokPeta_option" value="Ada">Ada</option>
                                        <option class="in_dokPeta_option" value="Tidak Ada">Tidak Ada</option>
                                    </select>
                                    <div class="invalid-feedback" id="pesan_dokPeta"></div>
                                </div>
                            </div> 

                            <div class="col-sm-3"> 
                                <div class="form-group">
                                    <label for="in_dokSkemaJaringan">Skema Jaringan</label>
                                    <select id="in_dokSkemaJaringan" name="dokSkemaJaringan" class="form-control" required>
                                        <option selected="" value="">-pilih-</option>
                                        <option class="in_dokSkemaJaringan_option" value="Ada">Ada</option>
                                        <option class="in_dokSkemaJaringan_option" value="Tidak Ada">Tidak Ada</option>
                                    </select>
                                    <div class="invalid-feedback" id="pesan_dokSkemaJaringan"></div>
                                </div>
                            </div> 

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="in_dokGambarKonstruksi">Gambar Konstruksi</label>
                                    <select id="in_dokGambarKonstruksi" name="dokGambarKonstruksi" class="form-control" required>
                                        <option selected="" value="">-pilih-</option>
                                        <option class="in_dokGambarKonstruksi_option" value="Ada">Ada</option>
                                        <option class="in_dokGambarKonstruksi_option" value="Tidak Ada">Tidak Ada</option>
                                    </select>
                                    <div class="invalid-feedback" id="pesan_dokGambarKonstruksi"></div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="in_dokBukuDataDI">Buku&nbsp;Data Daerah&nbsp;Irigasi</label>
                                    <select id="in_dokBukuDataDI" name="dokBukuDataDI" class="form-control" required>
                                        <option selected="" value="" >-pilih-</option>
                                        <option class="in_dokBukuDataDI_option" value="Ada">Ada</option>
                                        <option class="in_dokBukuDataDI_option" value="Tidak Ada">Tidak Ada</option>
                                    </select>
                                    <div class="invalid-feedback" id="pesan_dokBukuDataDI"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Row Dokumentasi -->

                    </div>

                    <div class="modal-footer justify-content-between">
                        <div class="row">
                          <a href="<?= base_url(); ?>FormTeknis1D" class="btn btn-default btn-sm" title="Kembali"><i class="fa fa-undo"></i> Kembali</a>
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

  });

    $('#in_irigasiid').on('change', function() {
        let val = $(this).val();

        $.ajax({
            url: base_url()+'FormTeknis1D/getLapermen', 
            method: 'POST',
            data: {irigasiid:val},
            dataType: 'json',
            success: function(res) {

                $('#in_laPermen').val(res.lper);

            },
            error: function(xhr, status, error) {
                alert('Ada yang error.!');
            }
        });
    });
    

    <?php if ($this->session->userdata('prive') == 'admin') { ?> 

        $('.select3').select2({
          placeholder: '-Tentukan Daerah Irigasi-',
          theme: 'default',
          ajax: {
            url: base_url() + "FormTeknis1D/getDiTambahData",
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