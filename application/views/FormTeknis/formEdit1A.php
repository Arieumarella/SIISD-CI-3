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
                <form role="form" action="<?= base_url(); ?>FormTeknis/SimpanData1AEdit" method="POST" data-select2-id="25">

                  <div class="content-header bg-warning">
                    <div class="container-fluid">
                      <div class="row m-0 p-0 text-left">
                        <div class="col-sm-7">
                          <h4 class="m-0">Form 1A : ASET D.I.</h4>
                      </div>

                      <div class="col-sm-5 text-right">
                        <a href="<?= base_url(); ?>FormTeknis/getDetailData1A/<?= $id; ?>" class="btn btn-default btn-sm" title="Kembali"><i class="fa fa-undo"></i> Kembali</a>
                        <button type="submit" class="btn btn-primary btn-sm btn-simpan"><i class="fas fa-archive"></i> Simpan Perubahan</button>
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


                                <div class="form-group" data-select2-id="32">
                                    <label for="in_irigasiid">Nomeklatur/ Nama D.I.  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                    <select id="in_irigasiid" name="irigasiid" class="form-control select3" required>
                                        <option value="<?= $dataDi->irigasiidX; ?>" selected><?= $dataDi->nama; ?></option>
                                    </select>
                                    <div class="invalid-feedback" id="pesan_irigasiid"></div>
                                </div>


                            </div> <!-- end box per input -->



                            <!-- Row Luas Areal (Ha) -->
                            <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Luas&nbsp;Areal&nbsp;(Ha)</div></div>

                            <div class="row">
                                <div class="col-sm-3"> <!-- start box per input -->
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label for="in_laPermen">Berdasarkan Permen 14/2015  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                        <input id="in_laPermen" name="laPermen" value="<?= str_replace('.', ',', $dataDi->laPermen); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" placeholder="Berdasarkan Permen 14/2015" required>
                                        <div class="invalid-feedback" id="pesan_laPermen"></div>
                                    </div>
                                </div> 

                                <div class="col-sm-3"> 

                                    <div class="form-group">
                                        <label for="in_laBaku">Baku (Pemetaan&nbsp;IGT)</label>
                                        <input id="in_laBaku" name="laBaku" value="<?= str_replace('.', ',', $dataDi->laBaku); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" placeholder="Baku (Pemetaan&nbsp;IGT)" required>
                                        <div class="invalid-feedback" id="pesan_laBaku"></div>
                                    </div>

                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_laPotensial">Potensial (Pemetaan&nbsp;IGT)</label>
                                        <input id="in_laPotensial" name="laPotensial" value="<?= str_replace('.', ',', $dataDi->laPotensial); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" placeholder="Potensial (Pemetaan&nbsp;IGT)" required>
                                        <div class="invalid-feedback" id="pesan_laPotensial"></div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_laFungsional">Fungsional (Pemetaan&nbsp;IGT)</label>
                                        <input id="in_laFungsional" name="laFungsional" value="<?= str_replace('.', ',', $dataDi->laFungsional); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" placeholder="Fungsional (Pemetaan&nbsp;IGT)" required>
                                        <div class="invalid-feedback" id="pesan_laFungsional"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3" data-select2-id="9"> 
                                <div class="form-group" data-select2-id="8">
                                    <label for="in_sumberAir">Sumber&nbsp;Air</label>
                                    <select id="in_sumberAir" name="sumberAir" class="form-control form-control-sm select2 " data-select2-id="in_sumberAir" tabindex="-1" aria-hidden="true" required>
                                        <option selected="" value="" data-select2-id="2">-pilih-</option>
                                        <option class="in_sumberAir_option" value="Waduk" <?= $dataDi->sumberAir == 'Waduk' ? 'selected' : ''; ?>>Waduk</option>
                                        <option class="in_sumberAir_option" value="Embung" <?= $dataDi->sumberAir == 'Embung' ? 'selected' : ''; ?>>Embung</option>
                                        <option class="in_sumberAir_option" value="Situ" <?= $dataDi->sumberAir == 'Situ' ? 'selected' : ''; ?>>Situ</option>
                                        <option class="in_sumberAir_option" value="Danau" <?= $dataDi->sumberAir == 'Danau' ? 'selected' : ''; ?>>Danau</option>
                                        <option class="in_sumberAir_option" value="Sungai" <?= $dataDi->sumberAir == 'Sungai' ? 'selected' : ''; ?>>Sungai</option>
                                        <option class="in_sumberAir_option" value="Mata Air" <?= $dataDi->sumberAir == 'Mata Air' ? 'selected' : ''; ?> >Mata Air</option>
                                        <option class="in_sumberAir_option" value="Air Tanah" <?= $dataDi->sumberAir == 'Air Tanah' ? 'selected' : ''; ?> >Air Tanah</option>
                                        <option class="in_sumberAir_option" value="Hujan" <?= $dataDi->sumberAir == 'Hujan' ? 'selected' : ''; ?> >Hujan</option>
                                    </select>
                                    <div class="invalid-feedback" id="pesan_sumberAir"></div>
                                </div>
                            </div>

                            <!-- End Row Luas Areal (Ha) -->


                            <!-- End Row Bangunan Utama -->
                            <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Bangunan&nbsp;Utama</div></div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_buBendung">Bendung (bh)</label>
                                        <input id="in_buBendung" name="buBendung" value="<?= str_replace('.', ',', $dataDi->buBendung); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Bendung (bh)">
                                        <div class="invalid-feedback" id="pesan_buBendung"></div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_buPengambilanBebas">Pengambilan Bebas&nbsp;(bh)</label>
                                        <input id="in_buPengambilanBebas" name="buPengambilanBebas" value="<?= str_replace('.', ',', $dataDi->buPengambilanBebas); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Pengambilan Bebas&nbsp;(bh)">
                                        <div class="invalid-feedback" id="pesan_buPengambilanBebas"></div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_buStasiunPompa">Stasiun Pompa (bh)</label>
                                        <input id="in_buStasiunPompa" name="buStasiunPompa" value="<?= str_replace('.', ',', $dataDi->buStasiunPompa); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Stasiun Pompa (bh)">
                                        <div class="invalid-feedback" id="pesan_buStasiunPompa"></div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_buEmbung">Embung (bh)</label>
                                        <input id="in_buEmbung" name="buEmbung" value="<?= str_replace('.', ',', $dataDi->buEmbung); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Embung (bh)">
                                        <div class="invalid-feedback" id="pesan_buEmbung"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Row Bangunan Utama -->


                            <!-- Row Saluran -->
                            <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Saluran</div></div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_sTipeSaluran">Tipe Saluran</label>
                                        <select id="in_sTipeSaluran" name="sTipeSaluran" class="form-control form-control-sm select2" required>
                                            <option selected="" value="">-pilih-</option>
                                            <option class="in_sTipeSaluran_option" value="Terbuka" <?= $dataDi->sTipeSaluran == 'Terbuka' ? 'selected' : ''; ?> >Terbuka</option>
                                            <option class="in_sTipeSaluran_option" value="Tertutup" <?= $dataDi->sTipeSaluran == 'Tertutup' ? 'selected' : ''; ?>>Tertutup</option>
                                            <option class="in_sTipeSaluran_option" value="Campuran" <?= $dataDi->sTipeSaluran == 'Campuran' ? 'selected' : ''; ?>>Campuran</option>
                                        </select>
                                        <div class="invalid-feedback" id="pesan_sTipeSaluran"></div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_sPrimer">Primer (m)</label>
                                        <input id="in_sPrimer" name="sPrimer" value="<?= str_replace('.', ',', $dataDi->sPrimer); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Primer (m)">
                                        <div class="invalid-feedback" id="pesan_sPrimer"></div>
                                    </div>
                                </div>

                                <div class="col-sm-3"> 
                                    <div class="form-group">
                                        <label for="in_sSekunder">Sekunder (m)</label>
                                        <input id="in_sSekunder" name="sSekunder" value="<?= str_replace('.', ',', $dataDi->sSekunder); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Sekunder (m)">
                                        <div class="invalid-feedback" id="pesan_sSekunder"></div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_sTersier">Tersier (m)</label>
                                        <input id="in_sTersier" name="sTersier" value="<?= str_replace('.', ',', $dataDi->sTersier); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Tersier (m)">
                                        <div class="invalid-feedback" id="pesan_sTersier"></div>
                                    </div>
                                </div>

                                <div class="col-sm-3"> 
                                    <div class="form-group">
                                        <label for="in_sPembuang">Pembuang (m)</label>
                                        <input id="in_sPembuang" name="sPembuang" value="<?= str_replace('.', ',', $dataDi->sPembuang); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Pembuang (m)">
                                        <div class="invalid-feedback" id="pesan_sPembuang"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Row Saluran -->


                            <!-- Row Bangunan Pengatur dan Pengukur -->
                            <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Bangunan&nbsp;Pengatur&nbsp;dan&nbsp;Pengukur</div></div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_bppBagi">Bagi (bh)</label>
                                        <input id="in_bppBagi" name="bppBagi" value="<?= str_replace('.', ',', $dataDi->bppBagi); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Bagi (bh)">
                                        <div class="invalid-feedback" id="pesan_bppBagi"></div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_bppBagiSadap">Bagi Sadap (bh)</label>
                                        <input id="in_bppBagiSadap" name="bppBagiSadap" value="<?= str_replace('.', ',', $dataDi->bppBagiSadap); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Bagi Sadap (bh)">
                                        <div class="invalid-feedback" id="pesan_bppBagiSadap"></div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_bppSadap">Sadap (bh)</label>
                                        <input id="in_bppSadap" name="bppSadap" value="<?= str_replace('.', ',', $dataDi->bppSadap); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Sadap (bh)">
                                        <div class="invalid-feedback" id="pesan_bppSadap"></div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_bppBangunanPengukur">Bangunan Pengukur (bh)</label>
                                        <input id="in_bppBangunanPengukur" name="bppBangunanPengukur" value="<?= str_replace('.', ',', $dataDi->bppBangunanPengukur); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Bangunan Pengukur (bh)">
                                        <div class="invalid-feedback" id="pesan_bppBangunanPengukur"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Row Bangunan Pengatur dan Pengukur -->


                            <!-- Row Bangunan Pembawa -->
                            <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Bangunan&nbsp;Pembawa</div></div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_bpGorong">Gorong-Gorong (bh)</label>
                                        <input id="in_bpGorong" name="bpGorong" value="<?= str_replace('.', ',', $dataDi->bpGorong); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Gorong-Gorong (bh)">
                                        <div class="invalid-feedback" id="pesan_bpGorong"></div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_bpSipon">Sipon (bh)</label>
                                        <input id="in_bpSipon" name="bpSipon" value="<?= str_replace('.', ',', $dataDi->bpSipon); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Sipon (bh)">
                                        <div class="invalid-feedback" id="pesan_bpSipon"></div>
                                    </div>
                                </div> 

                                <div class="col-sm-3"> 
                                    <div class="form-group">
                                        <label for="in_bpTalang">Talang (m)</label>
                                        <input id="in_bpTalang" name="bpTalang" value="<?= str_replace('.', ',', $dataDi->bpTalang); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Talang (m)">
                                        <div class="invalid-feedback" id="pesan_bpTalang"></div>
                                    </div>
                                </div>

                                <div class="col-sm-3"> 
                                    <div class="form-group">
                                        <label for="in_bpTerjunan">Terjunan (bh)</label>
                                        <input id="in_bpTerjunan" name="bpTerjunan" value="<?= str_replace('.', ',', $dataDi->bpTerjunan); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Terjunan (bh)">
                                        <div class="invalid-feedback" id="pesan_bpTerjunan"></div>
                                    </div>
                                </div>

                                <div class="col-sm-3"> 
                                    <div class="form-group">
                                        <label for="in_bpGotMiring">Got Miring (bh)</label>
                                        <input id="in_bpGotMiring" name="bpGotMiring" value="<?= str_replace('.', ',', $dataDi->bpGotMiring); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Got Miring (bh)">
                                        <div class="invalid-feedback" id="pesan_bpGotMiring"></div>
                                    </div>
                                </div> 

                                <div class="col-sm-3"> 
                                    <div class="form-group">
                                        <label for="in_bpFlum">Flum (bh)</label>
                                        <input id="in_bpFlum" name="bpFlum" value="<?= str_replace('.', ',', $dataDi->bpFlum); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Flum (bh)">
                                        <div class="invalid-feedback" id="pesan_bpFlum"></div>
                                    </div>
                                </div> 

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_bpTerowongan">Terowongan (bh)</label>
                                        <input id="in_bpTerowongan" name="bpTerowongan" value="<?= str_replace('.', ',', $dataDi->bpTerowongan); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Terowongan (bh)">
                                        <div class="invalid-feedback" id="pesan_bpTerowongan"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Row Bangunan Pembawa -->

                            <!-- Row Bangunan Lindung -->
                            <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Bangunan&nbsp;Lindung</div></div>

                            <div class="row">
                                <div class="col-sm-3"> 
                                    <div class="form-group">
                                        <label for="in_blinKantong">Kantong Lumpur/Sedimen (bh)</label>
                                        <input id="in_blinKantong" name="blinKantong" value="<?= str_replace('.', ',', $dataDi->blinKantong); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Kantong Lumpur/Sedimen (bh)">
                                        <div class="invalid-feedback" id="pesan_blinKantong"></div>
                                    </div>
                                </div> 

                                <div class="col-sm-3"> 
                                    <div class="form-group">
                                        <label for="in_blinPelimpah">Pelimpah (bh)</label>
                                        <input id="in_blinPelimpah" name="blinPelimpah" value="<?= str_replace('.', ',', $dataDi->blinPelimpah); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Pelimpah (bh)">
                                        <div class="invalid-feedback" id="pesan_blinPelimpah"></div>
                                    </div>
                                </div> 

                                <div class="col-sm-3"> 
                                    <div class="form-group">
                                        <label for="in_blinPenguras">Penguras (bh)</label>
                                        <input id="in_blinPenguras" name="blinPenguras" value="<?= str_replace('.', ',', $dataDi->blinPenguras); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Penguras (bh)">
                                        <div class="invalid-feedback" id="pesan_blinPenguras"></div>
                                    </div>
                                </div> 

                                <div class="col-sm-3"> 
                                    <div class="form-group">
                                        <label for="in_blinSaluranGendong">Saluran Gendong (m)</label>
                                        <input id="in_blinSaluranGendong" name="blinSaluranGendong" value="<?= str_replace('.', ',', $dataDi->blinSaluranGendong); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Saluran Gendong (m)">
                                        <div class="invalid-feedback" id="pesan_blinSaluranGendong"></div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_blinKrib">Krib (bh)</label>
                                        <input id="in_blinKrib" name="blinKrib" value="<?= str_replace('.', ',', $dataDi->blinKrib); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Krib (bh)">
                                        <div class="invalid-feedback" id="pesan_blinKrib"></div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_blinPerkuatanTebing">Perkuatan Tebing (m)</label>
                                        <input id="in_blinPerkuatanTebing" name="blinPerkuatanTebing" value="<?= str_replace('.', ',', $dataDi->blinPerkuatanTebing); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Perkuatan Tebing (m)">
                                        <div class="invalid-feedback" id="pesan_blinPerkuatanTebing"></div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_blinTanggul">Tanggul (m)</label>
                                        <input id="in_blinTanggul" name="blinTanggul" value="<?= str_replace('.', ',', $dataDi->blinTanggul); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Tanggul (m)">
                                        <div class="invalid-feedback" id="pesan_blinTanggul"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Row Bangunan Lindung -->

                            <!-- Row Bangunan Pelengkap -->
                            <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Bangunan&nbsp;Pelengkap</div></div>

                            <div class="row">
                                <div class="col-sm-3"> 
                                    <div class="form-group">
                                        <label for="in_bkapJalanInspeksi">Jalan Inspeksi (m)</label>
                                        <input id="in_bkapJalanInspeksi" name="bkapJalanInspeksi" value="<?= str_replace('.', ',', $dataDi->bkapJalanInspeksi); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Jalan Inspeksi (m)">
                                        <div class="invalid-feedback" id="pesan_bkapJalanInspeksi"></div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_bkapJembatan">Jembatan (bh)</label>
                                        <input id="in_bkapJembatan" name="bkapJembatan" value="<?= str_replace('.', ',', $dataDi->bkapJembatan); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Jembatan (bh)">
                                        <div class="invalid-feedback" id="pesan_bkapJembatan"></div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_bkapKantorPengamat">Kantor Pengamat (bh)</label>
                                        <input id="in_bkapKantorPengamat" name="bkapKantorPengamat" value="<?= str_replace('.', ',', $dataDi->bkapKantorPengamat); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Kantor Pengamat (bh)">
                                        <div class="invalid-feedback" id="pesan_bkapKantorPengamat"></div>
                                    </div>
                                </div>

                                <div class="col-sm-3"> 
                                    <div class="form-group">
                                        <label for="in_bkapGudang">Gudang (bh)</label>
                                        <input id="in_bkapGudang" name="bkapGudang" value="<?= str_replace('.', ',', $dataDi->bkapGudang); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Gudang (bh)">
                                        <div class="invalid-feedback" id="pesan_bkapGudang"></div>
                                    </div>
                                </div> 

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_bkapRumahJaga">Rumah Jaga (bh)</label>
                                        <input id="in_bkapRumahJaga" name="bkapRumahJaga" value="<?= str_replace('.', ',', $dataDi->bkapRumahJaga); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Rumah Jaga (bh)">
                                        <div class="invalid-feedback" id="pesan_bkapRumahJaga"></div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_bkapElektrikal">Rumah Genset/Panel Elektrikal (bh)</label>
                                        <input id="in_bkapElektrikal" name="bkapElektrikal" value="<?= str_replace('.', ',', $dataDi->bkapElektrikal); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Rumah Genset/Panel Elektrikal (bh)">
                                        <div class="invalid-feedback" id="pesan_bkapElektrikal"></div>
                                    </div>
                                </div> 

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_bkapSanggarTani">Sanggar Tani (bh)</label>
                                        <input id="in_bkapSanggarTani" name="bkapSanggarTani" value="<?= str_replace('.', ',', $dataDi->bkapSanggarTani); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Sanggar Tani (bh)">
                                        <div class="invalid-feedback" id="pesan_bkapSanggarTani"></div>
                                    </div>
                                </div> 
                            </div>
                            <!-- End Row Bangunan Pelengkap -->

                            <!-- Row Sarana -->
                            <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Sarana</div></div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_saranaPintuAir">Pintu Air (bh)</label>
                                        <input id="in_saranaPintuAir" name="saranaPintuAir" value="<?= str_replace('.', ',', $dataDi->saranaPintuAir); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Pintu Air (bh)">
                                        <div class="invalid-feedback" id="pesan_saranaPintuAir"></div>
                                    </div>
                                </div> 

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_saranaAlatUkur">Alat Ukur (bh)</label>
                                        <input id="in_saranaAlatUkur" name="saranaAlatUkur" value="<?= str_replace('.', ',', $dataDi->saranaAlatUkur); ?>" type="text" class="form-control form-control-sm text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required placeholder="Alat Ukur (bh)">
                                        <div class="invalid-feedback" id="pesan_saranaAlatUkur"></div>
                                    </div>
                                </div> 
                            </div>
                            <!-- End Row Sarana -->


                            <!-- Row Dokumentasi -->
                            <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Dokumentasi</div></div>

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_dokPeta">Peta</label>
                                        <select id="in_dokPeta" name="dokPeta" class="form-control" required>
                                            <option selected="" value="">-pilih-</option>
                                            <option class="in_dokPeta_option" value="Ada" <?= $dataDi->dokPeta == 'Ada' ? 'selected' : ''; ?>>Ada</option>
                                            <option class="in_dokPeta_option" value="Tidak Ada" <?= $dataDi->dokPeta == 'Tidak Ada' ? 'selected' : ''; ?>>Tidak Ada</option>
                                        </select>
                                        <div class="invalid-feedback" id="pesan_dokPeta"></div>
                                    </div>
                                </div> 

                                <div class="col-sm-3"> 
                                    <div class="form-group">
                                        <label for="in_dokSkemaJaringan">Skema Jaringan</label>
                                        <select id="in_dokSkemaJaringan" name="dokSkemaJaringan" class="form-control" required>
                                            <option selected="" value="">-pilih-</option>
                                            <option class="in_dokSkemaJaringan_option" value="Ada" <?= $dataDi->dokSkemaJaringan == 'Ada' ? 'selected' : ''; ?> >Ada</option>
                                            <option class="in_dokSkemaJaringan_option" value="Tidak Ada" <?= $dataDi->dokSkemaJaringan == 'Tidak Ada' ? 'selected' : ''; ?> >Tidak Ada</option>
                                        </select>
                                        <div class="invalid-feedback" id="pesan_dokSkemaJaringan"></div>
                                    </div>
                                </div> 

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_dokGambarKonstruksi">Gambar Konstruksi</label>
                                        <select id="in_dokGambarKonstruksi" name="dokGambarKonstruksi" class="form-control" required>
                                            <option selected="" value="">-pilih-</option>
                                            <option class="in_dokGambarKonstruksi_option" value="Ada" <?= $dataDi->dokGambarKonstruksi == 'Ada' ? 'selected' : ''; ?> >Ada</option>
                                            <option class="in_dokGambarKonstruksi_option" value="Tidak Ada" <?= $dataDi->dokGambarKonstruksi == 'Tidak Ada' ? 'selected' : ''; ?> >Tidak Ada</option>
                                        </select>
                                        <div class="invalid-feedback" id="pesan_dokGambarKonstruksi"></div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="in_dokBukuDataDI">Buku&nbsp;Data Daerah&nbsp;Irigasi</label>
                                        <select id="in_dokBukuDataDI" name="dokBukuDataDI" class="form-control" required>
                                            <option selected="" value="" >-pilih-</option>
                                            <option class="in_dokBukuDataDI_option" value="Ada" <?= $dataDi->dokBukuDataDI == 'Ada' ? 'selected' : ''; ?> >Ada</option>
                                            <option class="in_dokBukuDataDI_option" value="Tidak Ada" <?= $dataDi->dokBukuDataDI == 'Tidak Ada' ? 'selected' : ''; ?> >Tidak Ada</option>
                                        </select>
                                        <div class="invalid-feedback" id="pesan_dokBukuDataDI"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Row Dokumentasi -->

                        </div>

                        <div class="modal-footer justify-content-between">
                            <div class="row">
                                <a href="<?= base_url(); ?>FormTeknis/getDetailData1A/<?= $id; ?>" class="btn btn-default btn-sm" title="Kembali"><i class="fa fa-undo"></i> Kembali</a>
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

    $('.select2').select2({
      theme: 'default'
  })
    
});

</script>