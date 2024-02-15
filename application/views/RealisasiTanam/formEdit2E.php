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
            <form role="form" action="<?= base_url(); ?>RealisasiTanam2E/SimpanDataEdit" method="POST" data-select2-id="25">

              <div class="content-header bg-warning">
                <div class="container-fluid">
                  <div class="row m-0 p-0 text-left">
                    <div class="col-sm-7">
                      <h4 class="m-0">Form 2E : RTI D.I.P</h4>
                  </div>

                  <div class="col-sm-5 text-right">
                    <a href="<?= base_url(); ?>RealisasiTanam2E" class="btn btn-default btn-sm" title="Batal"><i class="fa fa-undo"></i> Kembali</a>
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

                        <div class="row">
                            <div class="col-sm-6" data-select2-id="33"> <!-- start box per input -->

                                <div class="form-group" data-select2-id="32">
                                    <label for="irigasiid">Nomeklatur/ Nama D.I.  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                    <select id="irigasiid" name="irigasiid" class="form-control select2" required>
                                        <option value="<?= $id; ?>"><?= $dataDi->nama; ?></option>
                                    </select>
                                    <div class="invalid-feedback" id="pesan_irigasiid"></div>
                                </div>


                            </div> <!-- end box per input -->

                            <div class="col-sm-3"> 
                                <div class="form-group">
                                    <label for="laPermen">Luas D.I. Sesuai Permen 14/2015 (Ha)  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                    <input id="laPermen" name="laPermen" value="<?= str_replace('.', ',', $dataDi->lper); ?>" type="text" class="form-control text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); TotalRTanamPadi(); RealisasiTanamPalawija(); RealisasiTanamTebu(); RealisasiTanamLainnya();" placeholder="Luas D.I. Sesuai Permen 14/2015 (Ha)" readonly >
                                    <div class="invalid-feedback" id="pesan_laPermen"></div>
                                </div>
                            </div>

                            <div class="col-sm-3"> <!-- start box per input -->

                                <!-- text input -->
                                <div class="form-group">
                                    <label for="sawahFungsional">Sawah/Fungsional (Pemetaan IGT) (Ha)  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                    <input id="sawahFungsional" name="sawahFungsional" value="<?= str_replace('.', ',', $dataDi->sawahFungsional); ?>" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); TotalRTanamPadi(); RealisasiTanamPalawija(); RealisasiTanamTebu(); RealisasiTanamLainnya();" type="text" class="form-control text-right number" placeholder="Sawah/Fungsional (Pemetaan IGT) (Ha)" required>
                                    <div class="invalid-feedback" id="pesan_sawahFungsional"></div>
                                </div>
                            </div>

                        </div>


                        <!-- Row Luas Areal (Ha) -->
                        <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">Pola Tanam</div></div>

                        <div class="row">

                            <div class="col-sm-2">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input id="polatanamPadi3" class="form-check-input" idasli="in_polatanamPadi3" type="checkbox" value="V" valueasli="V" name="polatanamPadi3" <?= $dataDi->polatanamPadi3 == 'V' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="polatanamPadi3">Padi→Padi→Padi</label>        
                                    </div>
                                    <div class="invalid-feedback" id="pesan_polatanamPadi3"></div>
                                </div>
                            </div>

                            <div class="col-sm-2"> 
                                <div class="form-group">
                                    <div class="form-check">
                                        <input id="polatanamPadi2Plw" class="form-check-input" name="polatanamPadi2Plw" idasli="in_polatanamPadi2Plw" type="checkbox" value="V" valueasli="V" <?= $dataDi->polatanamPadi2Plw == 'V' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="polatanamPadi2Plw">Padi→Padi→Palawija</label>  
                                    </div>
                                    <div class="invalid-feedback" id="pesan_polatanamPadi2Plw"></div>
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input id="polatanamPadiPlw2" class="form-check-input" idasli="in_polatanamPadiPlw2" name="polatanamPadiPlw2" type="checkbox" value="V" valueasli="V" <?= $dataDi->polatanamPadiPlw2 == 'V' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="polatanamPadiPlw2">Padi→Palawija→Palawija</label>
                                    </div>
                                    <div class="invalid-feedback" id="pesan_polatanamPadiPlw2"></div>
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input id="polatanamPadi2" class="form-check-input" name="polatanamPadi2" idasli="in_polatanamPadi2" type="checkbox" value="V" valueasli="V" <?= $dataDi->polatanamPadi2 == 'V' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="polatanamPadi2">Padi→Padi</label>        
                                    </div>
                                    <div class="invalid-feedback" id="pesan_polatanamPadi2">

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input id="polatanamPadiPlw" class="form-check-input" name="polatanamPadiPlw" idasli="in_polatanamPadiPlw" type="checkbox" value="V" valueasli="V" <?= $dataDi->polatanamPadiPlw == 'V' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="polatanamPadiPlw">Padi→Palawija</label>     
                                    </div>
                                    <div class="invalid-feedback" id="pesan_polatanamPadiPlw">

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-2"> 
                                <div class="form-group">
                                    <div class="form-check">
                                        <input id="polatanamPadi" class="form-check-input" idasli="in_polatanamPadi" name="polatanamPadi" type="checkbox" value="V" valueasli="V" <?= $dataDi->polatanamPadi == 'V' ? 'checked' : ''; ?> >
                                        <label class="form-check-label" for="polatanamPadi">Padi</label>        
                                    </div>
                                    <div class="invalid-feedback" id="pesan_polatanamPadi">

                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- End Row Luas Areal (Ha) -->


                        <!-- Row Luas Areal (Ha) -->
                        <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">REALISASI TANAM PADI</div></div>

                        <div class="row">

                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="reatamPadiMT1">MT.1 (Ha)</label>
                                    <input id="reatamPadiMT1" name="reatamPadiMT1" value="<?= str_replace('.', ',', $dataDi->reatamPadiMT1); ?>" type="text" class="form-control text-right number reatamPadiTotalHa jmlMT1 laPermen" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); TotalRTanamPadi();" placeholder="MT.1 (Ha)" required>
                                    <div class="invalid-feedback" id="pesan_reatamPadiMT1"></div>
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="reatamPadiMT2">MT.2 (Ha)</label>
                                    <input id="reatamPadiMT2" name="reatamPadiMT2" value="<?= str_replace('.', ',', $dataDi->reatamPadiMT2); ?>" type="text" class="form-control text-right number reatamPadiTotalHa jmlMT2" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); TotalRTanamPadi();" placeholder="MT.2 (Ha)" required>
                                    <div class="invalid-feedback" id="pesan_reatamPadiMT2"></div>
                                </div>
                            </div>


                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="reatamPadiMT3">MT.3 (Ha)</label>
                                    <input id="reatamPadiMT3" name="reatamPadiMT3" value="<?= str_replace('.', ',', $dataDi->reatamPadiMT3); ?>" type="text" class="form-control text-right number reatamPadiTotalHa jmlMT3" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); TotalRTanamPadi();" placeholder="MT.3 (Ha)" required>
                                    <div class="invalid-feedback" id="pesan_reatamPadiMT3"></div>
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="reatamPadiTotalHa">Total (Ha)</label>
                                    <input id="reatamPadiTotalHa" value="<?= str_replace('.', ',', $dataDi->reatamPadiTotalHa); ?>" name="reatamPadiTotalHa" type="text" class="form-control kududisabled" placeholder="Total (Ha)" readonly>
                                    <div class="invalid-feedback" id="pesan_reatamPadiTotalHa"></div>
                                </div>
                            </div>

                            <div class="col-sm-2"> 
                                <div class="form-group">
                                    <label for="reatamPadiTotalHaIp">Total IP (%)</label>
                                    <input id="reatamPadiTotalHaIp" value="<?= str_replace('.', ',', $dataDi->reatamPadiTotalHaIp); ?>" name="reatamPadiTotalHaIp" type="text" class="form-control kududisabled" placeholder="Total IP (%)" readonly>
                                    <div class="invalid-feedback" id="pesan_reatamPadiTotalHaIp"></div>
                                </div>
                            </div>

                        </div>
                        <!-- End Row Luas Areal (Ha) -->

                        <!-- Row Luas Areal (Ha) -->
                        <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">REALISASI TANAM PALAWIJA</div></div>

                        <div class="row">
                            <div class="col-sm-2">
                             <div class="form-group">
                                <label for="reatamPalawijaMT1">MT.1 (Ha)</label>
                                <input id="reatamPalawijaMT1" name="reatamPalawijaMT1" value="<?= str_replace('.', ',', $dataDi->reatamPalawijaMT1); ?>" type="text" class="form-control text-right number reatamPadiTotalHa jmlMT1 laPermen" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); RealisasiTanamPalawija();" placeholder="MT.1 (Ha)" required>
                                <div class="invalid-feedback" id="pesan_reatamPalawijaMT1">

                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="reatamPalawijaMT2">MT.2 (Ha)</label>
                                <input id="reatamPalawijaMT2" name="reatamPalawijaMT2" value="<?= str_replace('.', ',', $dataDi->reatamPalawijaMT2); ?>" type="text" class="form-control text-right number reatamPadiTotalHa jmlMT2" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); RealisasiTanamPalawija();" placeholder="MT.2 (Ha)" required>
                                <div class="invalid-feedback" id="pesan_reatamPalawijaMT2"></div>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="reatamPalawijaMT3">MT.3 (Ha)</label>
                                <input id="reatamPalawijaMT3" name="reatamPalawijaMT3" value="<?= str_replace('.', ',', $dataDi->reatamPalawijaMT3); ?>" type="text" class="form-control text-right number reatamPadiTotalHa jmlMT3" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); RealisasiTanamPalawija();" placeholder="MT.3 (Ha)" required>
                                <div class="invalid-feedback" id="pesan_reatamPalawijaMT3"></div>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="reatamPalawijaTotalHa">Total (Ha)</label>
                                <input id="reatamPalawijaTotalHa" value="<?= str_replace('.', ',', $dataDi->reatamPalawijaTotalHa); ?>" name="reatamPalawijaTotalHa" type="text" class="form-control kududisabled" placeholder="Total (Ha)" readonly>
                                <div class="invalid-feedback" id="pesan_reatamPalawijaTotalHa"></div>
                            </div>
                        </div>

                        <div class="col-sm-2"> 
                            <div class="form-group">
                                <label for="reatamPalawijaTotalHaIp">Total IP (%)</label>
                                <input id="reatamPalawijaTotalHaIp" value="<?= str_replace('.', ',', $dataDi->reatamPalawijaTotalHaIp); ?>" name="reatamPalawijaTotalHaIp" type="text" class="form-control kududisabled" placeholder="Total IP (%)" readonly>
                                <div class="invalid-feedback" id="pesan_reatamPalawijaTotalHaIp"></div>
                            </div>
                        </div>

                    </div>
                    <!-- End Row Luas Areal (Ha) -->

                    <!-- Row Luas Areal (Ha) -->
                    <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">REALISASI TANAM TEBU</div></div>

                    <div class="row">

                        <div class="col-sm-2">
                         <div class="form-group">
                            <label for="reatamTebuMT1">MT.1 (Ha)</label>
                            <input id="reatamTebuMT1" name="reatamTebuMT1" value="<?= str_replace('.', ',', $dataDi->reatamTebuMT1); ?>" type="text" class="form-control text-right number reatamPadiTotalHa jmlMT1 laPermen" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); RealisasiTanamTebu();" placeholder="MT.1 (Ha)" required>
                            <div class="invalid-feedback" id="pesan_reatamTebuMT1">

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="reatamTebuMT2">MT.2 (Ha)</label>
                            <input id="reatamTebuMT2" name="reatamTebuMT2" value="<?= str_replace('.', ',', $dataDi->reatamTebuMT2); ?>" type="text" class="form-control text-right number reatamPadiTotalHa jmlMT2" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); RealisasiTanamTebu();" placeholder="MT.2 (Ha)" required>
                            <div class="invalid-feedback" id="pesan_reatamTebuMT2"></div>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="reatamTebuMT3">MT.3 (Ha)</label>
                            <input id="reatamTebuMT3" name="reatamTebuMT3" value="<?= str_replace('.', ',', $dataDi->reatamTebuMT3); ?>" type="text" class="form-control text-right number reatamPadiTotalHa jmlMT3" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); RealisasiTanamTebu();" placeholder="MT.3 (Ha)" required>
                            <div class="invalid-feedback" id="pesan_reatamTebuMT3"></div>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="reatamTebuTotalHa">Total (Ha)</label>
                            <input id="reatamTebuTotalHa" value="<?= str_replace('.', ',', $dataDi->reatamTebuTotalHa); ?>" name="reatamTebuTotalHa" type="text" class="form-control kududisabled" placeholder="Total (Ha)" readonly>
                            <div class="invalid-feedback" id="pesan_reatamTebuTotalHa"></div>
                        </div>
                    </div>

                    <div class="col-sm-2"> 
                        <div class="form-group">
                            <label for="reatamTebuTotalHaIp">Total IP (%)</label>
                            <input id="reatamTebuTotalHaIp" value="<?= str_replace('.', ',', $dataDi->reatamTebuTotalHaIp); ?>" name="reatamTebuTotalHaIp" type="text" class="form-control kududisabled" placeholder="Total IP (%)" readonly>
                            <div class="invalid-feedback" id="pesan_reatamTebuTotalHaIp"></div>
                        </div>
                    </div>

                </div>
                <!-- End Row Luas Areal (Ha) -->

                <!-- Row Luas Areal (Ha) -->
                <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">REALISASI TANAM LAINNYA</div></div>

                <div class="row">

                    <div class="col-sm-2">
                     <div class="form-group">
                        <label for="reatamLainnyaMT1">MT.1 (Ha)</label>
                        <input id="reatamLainnyaMT1" name="reatamLainnyaMT1" value="<?= str_replace('.', ',', $dataDi->reatamLainnyaMT1); ?>" type="text" class="form-control text-right number reatamPadiTotalHa jmlMT1 laPermen" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); RealisasiTanamLainnya();" required placeholder="MT.1 (Ha)">
                        <div class="invalid-feedback" id="pesan_reatamLainnyaMT1">

                        </div>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="reatamLainnyaMT2">MT.2 (Ha)</label>
                        <input id="reatamLainnyaMT2" name="reatamLainnyaMT2" value="<?= str_replace('.', ',', $dataDi->reatamLainnyaMT2); ?>" type="text" class="form-control text-right number reatamPadiTotalHa jmlMT2" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); RealisasiTanamLainnya();" required placeholder="MT.2 (Ha)">
                        <div class="invalid-feedback" id="pesan_reatamLainnyaMT2"></div>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="reatamLainnyaMT3">MT.3 (Ha)</label>
                        <input id="reatamLainnyaMT3" name="reatamLainnyaMT3" value="<?= str_replace('.', ',', $dataDi->reatamLainnyaMT3); ?>" type="text" class="form-control text-right number reatamPadiTotalHa jmlMT3" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); RealisasiTanamLainnya();" required placeholder="MT.3 (Ha)">
                        <div class="invalid-feedback" id="pesan_reatamLainnyaMT3"></div>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="reatamLainnyaTotalHa">Total (Ha)</label>
                        <input id="reatamLainnyaTotalHa" value="<?= str_replace('.', ',', $dataDi->reatamLainnyaTotalHa); ?>" name="reatamLainnyaTotalHa" type="text" class="form-control kududisabled" placeholder="Total (Ha)" readonly>
                        <div class="invalid-feedback" id="pesan_reatamLainnyaTotalHa"></div>
                    </div>
                </div>

                <div class="col-sm-2"> 
                    <div class="form-group">
                        <label for="reatamLainnyaTotalHaIp">Total IP (%)</label>
                        <input id="reatamLainnyaTotalHaIp" value="<?= str_replace('.', ',', $dataDi->reatamLainnyaTotalHaIp); ?>" name="reatamLainnyaTotalHaIp" type="text" class="form-control kududisabled" placeholder="Total IP (%)" readonly>
                        <div class="invalid-feedback" id="pesan_reatamLainnyaTotalHaIp"></div>
                    </div>
                </div>

            </div>
            <!-- End Row Luas Areal (Ha) -->


            <!-- Row Luas Areal (Ha) -->
            <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">JUMLAH</div></div>

            <div class="row">

                <div class="col-sm-2">
                 <div class="form-group">
                    <label for="jmlMT1">MT.1 (Ha)</label>
                    <input id="jmlMT1" name="jmlMT1" value="<?= str_replace('.', ',', $dataDi->jmlMT1); ?>" type="text" class="form-control text-right number reatamPadiTotalHa jmlMT1 laPermen" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); " readonly placeholder="MT.1 (Ha)">
                    <div class="invalid-feedback" id="pesan_jmlMT1">

                    </div>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label for="jmlMT2">MT.2 (Ha)</label>
                    <input id="jmlMT2" name="jmlMT2" value="<?= str_replace('.', ',', $dataDi->jmlMT2); ?>" type="text" class="form-control text-right number reatamPadiTotalHa jmlMT2" oninput="this.value = this.value.replace(/[^0-9,]/g, '');" readonly placeholder="MT.2 (Ha)">
                    <div class="invalid-feedback" id="pesan_jmlMT2"></div>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label for="jmlMT3">MT.3 (Ha)</label>
                    <input id="jmlMT3" name="jmlMT3" value="<?= str_replace('.', ',', $dataDi->jmlMT3); ?>" type="text" class="form-control text-right number reatamPadiTotalHa jmlMT3" oninput="this.value = this.value.replace(/[^0-9,]/g, '');" readonly placeholder="MT.3 (Ha)">
                    <div class="invalid-feedback" id="pesan_jmlMT3"></div>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label for="jmlTotalHa">Total (Ha)</label>
                    <input id="jmlTotalHa" value="<?= str_replace('.', ',', $dataDi->jmlTotalHa); ?>" name="jmlTotalHa" type="text" class="form-control kududisabled" placeholder="Total (Ha)" readonly>
                    <div class="invalid-feedback" id="pesan_jmlTotalHa"></div>
                </div>
            </div>

            <div class="col-sm-2"> 
                <div class="form-group">
                    <label for="jmlTotalIp">Total IP (%)</label>
                    <input id="jmlTotalIp" value="<?= str_replace('.', ',', $dataDi->jmlTotalIp); ?>" name="jmlTotalIp" type="text" class="form-control kududisabled" placeholder="Total IP (%)" readonly>
                    <div class="invalid-feedback" id="pesan_jmlTotalIp"></div>
                </div>
            </div>

        </div>


        <div class="bg-info mb-2" style="padding:2px; margin:0px;"><div class="" style="padding:0px 0px 0px 4px; margin:0px;">PRODUKTIVITAS PADI
        </div></div>

        <div class="row">

            <div class="col-sm-2">
             <div class="form-group">
                <label for="produktivitasPadiMT1">MT.1 (Ton/Ha)</label>
                <input id="produktivitasPadiMT1" name="produktivitasPadiMT1" value="<?= str_replace('.', ',', $dataDi->produktivitasPadiMT1); ?>" type="text" class="form-control text-right number reatamPadiTotalHa jmlMT1 laPermen" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); produktivitasPadi();" placeholder="MT.1 (Ton/Ha)" required>
                <div class="invalid-feedback" id="pesan_produktivitasPadiMT1">

                </div>
            </div>
        </div>

        <div class="col-sm-2">
         <div class="form-group">
            <label for="produktivitasPadiMT2">MT.2 (Ton/Ha)</label>
            <input id="produktivitasPadiMT2" name="produktivitasPadiMT2" value="<?= str_replace('.', ',', $dataDi->produktivitasPadiMT2); ?>" type="text" class="form-control text-right number reatamPadiTotalHa jmlMT1 laPermen" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); produktivitasPadi();" placeholder="MT.2 (Ton/Ha)" required>
            <div class="invalid-feedback" id="pesan_produktivitasPadiMT2">

            </div>
        </div>
    </div>

    <div class="col-sm-2">
     <div class="form-group">
        <label for="produktivitasPadiMT3">MT.3 (Ton/Ha)</label>
        <input id="produktivitasPadiMT3" name="produktivitasPadiMT3" value="<?= str_replace('.', ',', $dataDi->produktivitasPadiMT3); ?>" type="text" class="form-control text-right number reatamPadiTotalHa jmlMT1 laPermen" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); produktivitasPadi();" placeholder="MT.3 (Ton/Ha)" required>
        <div class="invalid-feedback" id="pesan_produktivitasPadiMT3">

        </div>
    </div>
</div>

<div class="col-sm-2">
 <div class="form-group">
    <label for="produktivitasRata2">Rata2 (Ton/Ha)</label>
    <input id="produktivitasRata2" name="produktivitasRata2" value="<?= str_replace('.', ',', $dataDi->produktivitasRata2); ?>" type="text" class="form-control text-right number reatamPadiTotalHa jmlMT1 laPermen" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); " readonly placeholder="Rata2 (Ton/Ha)">
    <div class="invalid-feedback" id="pesan_produktivitasRata2">

    </div>
</div>
</div>
</div>
</div>


<div class="modal-footer justify-content-between">
    <div class="row">
      <a href="<?= base_url(); ?>RealisasiTanam2E" class="btn btn-default btn-sm" title="Batal"><i class="fa fa-undo"></i> Kembali</a>
      <button type="submit" class="btn btn-primary btn-sm btn-simpan">Simpan Perubahan</button>
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

<script src="<?= base_url(); ?>assets/admin/Ite/plugins/select2-4.0.8/dist/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/admin/Ite/plugins/sweetalert2/sweetalert2.min.js" type="text/javascript"></script>

<script>
  $(document).ready(function(){

    $('input[type="checkbox"]').on('change', function() {

        let jumlahDicentang = $('input[type="checkbox"]:checked').length;

        if (jumlahDicentang > 2) {
            Swal.fire("Cheklist Tidak Boleh Lebih Dari Dua");
            $('input[type="checkbox"]').prop('checked', false);
        }

    })

    // Row 1
    TotalRTanamPadi = function () {

        let reatamPadiMT1 = ($('#reatamPadiMT1').val() == '') ? 0 : parseFloat($('#reatamPadiMT1').val().replace(",", ".")),
        reatamPadiMT2 = ($('#reatamPadiMT2').val() == '') ? 0 : parseFloat($('#reatamPadiMT2').val().replace(",", ".")),
        reatamPadiMT3 = ($('#reatamPadiMT3').val() == '') ? 0 : parseFloat($('#reatamPadiMT3').val().replace(",", ".")),
        laPermen =  ($('#laPermen').val() == '') ? 0 : parseFloat($('#laPermen').val().replace(",", ".")),
        sawahFungsional =  ($('#sawahFungsional').val() == '') ? 0 : parseFloat($('#sawahFungsional').val().replace(",", "."));

        let jmlhData = reatamPadiMT1 + reatamPadiMT2 + reatamPadiMT3,
        jmlhDataString = jmlhData,
        laperSawah = 0;

        jmlhDataString = jmlhDataString;

        $('#reatamPadiTotalHa').val(jmlhDataString);

        if (laPermen != 0) {
            laperSawah = laPermen;
        }else{
            laperSawah = sawahFungsional;
        }

        let jmlhTotalIp = (jmlhData/laperSawah)*100,
        jmlhDataBagi = jmlhTotalIp;

        if (jmlhTotalIp != Infinity) {
            $('#reatamPadiTotalHaIp').val(jmlhDataBagi);
        }

        totalAllData();

    }
    // End Row 1

    // Row 2
    RealisasiTanamPalawija = function () {

        let reatamPalawijaMT1 = ($('#reatamPalawijaMT1').val() == '') ? 0 : parseFloat($('#reatamPalawijaMT1').val().replace(",", ".")),
        reatamPalawijaMT2 = ($('#reatamPalawijaMT2').val() == '') ? 0 : parseFloat($('#reatamPalawijaMT2').val().replace(",", ".")),
        reatamPalawijaMT3 = ($('#reatamPalawijaMT3').val() == '') ? 0 : parseFloat($('#reatamPalawijaMT3').val().replace(",", ".")),
        laPermen =  ($('#laPermen').val() == '') ? 0 : parseFloat($('#laPermen').val().replace(",", ".")),
        sawahFungsional =  ($('#sawahFungsional').val() == '') ? 0 : parseFloat($('#sawahFungsional').val().replace(",", "."));

        let jmlhData = reatamPalawijaMT1 + reatamPalawijaMT2 + reatamPalawijaMT3,
        jmlhDataString = jmlhData,
        laperSawah = 0;

        jmlhDataString = jmlhDataString;

        $('#reatamPalawijaTotalHa').val(jmlhDataString);

        if (laPermen != 0) {
            laperSawah = laPermen;
        }else{
            laperSawah = sawahFungsional;
        }

        let jmlhTotalIp = (jmlhData/laperSawah)*100,
        jmlhDataBagi = jmlhTotalIp;

        if (jmlhTotalIp != Infinity) {
            $('#reatamPalawijaTotalHaIp').val(jmlhDataBagi);
        }

        totalAllData();
    }
    // End Row 2

    // Row 3
    RealisasiTanamTebu = function () {

        let reatamTebuMT1 = ($('#reatamTebuMT1').val() == '') ? 0 : parseFloat($('#reatamTebuMT1').val().replace(",", ".")),
        reatamTebuMT2 = ($('#reatamTebuMT2').val() == '') ? 0 : parseFloat($('#reatamTebuMT2').val().replace(",", ".")),
        reatamTebuMT3 = ($('#reatamTebuMT3').val() == '') ? 0 : parseFloat($('#reatamTebuMT3').val().replace(",", ".")),
        laPermen =  ($('#laPermen').val() == '') ? 0 : parseFloat($('#laPermen').val().replace(",", ".")),
        sawahFungsional =  ($('#sawahFungsional').val() == '') ? 0 : parseFloat($('#sawahFungsional').val().replace(",", "."));

        let jmlhData = reatamTebuMT1 + reatamTebuMT2 + reatamTebuMT3,
        jmlhDataString = jmlhData,
        laperSawah = 0;

        jmlhDataString = jmlhDataString;

        $('#reatamTebuTotalHa').val(jmlhDataString);

        if (laPermen != 0) {
            laperSawah = laPermen;
        }else{
            laperSawah = sawahFungsional;
        }

        let jmlhTotalIp = (jmlhData/laperSawah)*100,
        jmlhDataBagi = jmlhTotalIp;

        if (jmlhTotalIp != Infinity) {
            $('#reatamTebuTotalHaIp').val(jmlhDataBagi);
        }

        totalAllData();
    }
    // End Row 3

    // Row 4
    RealisasiTanamLainnya = function () {

        let reatamLainnyaMT1 = ($('#reatamLainnyaMT1').val() == '') ? 0 : parseFloat($('#reatamLainnyaMT1').val().replace(",", ".")),
        reatamLainnyaMT2 = ($('#reatamLainnyaMT2').val() == '') ? 0 : parseFloat($('#reatamLainnyaMT2').val().replace(",", ".")),
        reatamLainnyaMT3 = ($('#reatamLainnyaMT3').val() == '') ? 0 : parseFloat($('#reatamLainnyaMT3').val().replace(",", ".")),
        laPermen =  ($('#laPermen').val() == '') ? 0 : parseFloat($('#laPermen').val().replace(",", ".")),
        sawahFungsional =  ($('#sawahFungsional').val() == '') ? 0 : parseFloat($('#sawahFungsional').val().replace(",", "."));

        let jmlhData = reatamLainnyaMT1 + reatamLainnyaMT2 + reatamLainnyaMT3,
        jmlhDataString = jmlhData,
        laperSawah = 0;

        jmlhDataString = jmlhDataString;

        $('#reatamLainnyaTotalHa').val(jmlhDataString);

        if (laPermen != 0) {
            laperSawah = laPermen;
        }else{
            laperSawah = sawahFungsional;
        }

        let jmlhTotalIp = (jmlhData/laperSawah)*100,
        jmlhDataBagi = jmlhTotalIp;

        if (jmlhTotalIp != Infinity) {
            $('#reatamLainnyaTotalHaIp').val(jmlhDataBagi);
        }

        totalAllData();
    }
    // End Row 4

    // Row Total
    totalAllData = function () {

        // MT1
        let reatamPadiMT1 = ($('#reatamPadiMT1').val() == '') ? 0 : parseFloat($('#reatamPadiMT1').val().replace(",", ".")),
        reatamPalawijaMT1 = ($('#reatamPalawijaMT1').val() == '') ? 0 : parseFloat($('#reatamPalawijaMT1').val().replace(",", ".")),
        reatamTebuMT1 = ($('#reatamTebuMT1').val() == '') ? 0 : parseFloat($('#reatamTebuMT1').val().replace(",", ".")),
        reatamLainnyaMT1 = ($('#reatamLainnyaMT1').val() == '') ? 0 : parseFloat($('#reatamLainnyaMT1').val().replace(",", ".")),
        totMt1 = reatamPadiMT1+reatamPalawijaMT1+reatamTebuMT1+reatamLainnyaMT1,
        totMt1Fix = totMt1;

        $('#jmlMT1').val(totMt1Fix);

        // MT2
        let reatamPadiMT2 = ($('#reatamPadiMT2').val() == '') ? 0 : parseFloat($('#reatamPadiMT2').val().replace(",", ".")),
        reatamPalawijaMT2 = ($('#reatamPalawijaMT2').val() == '') ? 0 : parseFloat($('#reatamPalawijaMT2').val().replace(",", ".")),
        reatamTebuMT2 = ($('#reatamTebuMT2').val() == '') ? 0 : parseFloat($('#reatamTebuMT2').val().replace(",", ".")),
        reatamLainnyaMT2 = ($('#reatamLainnyaMT2').val() == '') ? 0 : parseFloat($('#reatamLainnyaMT2').val().replace(",", ".")),
        totMt2 = reatamPadiMT2+reatamPalawijaMT2+reatamTebuMT2+reatamLainnyaMT2,
        totMt2Fix = totMt2;

        $('#jmlMT2').val(totMt2Fix);

        // MT3
        let reatamPadiMT3 = ($('#reatamPadiMT3').val() == '') ? 0 : parseFloat($('#reatamPadiMT3').val().replace(",", ".")),
        reatamPalawijaMT3 = ($('#reatamPalawijaMT3').val() == '') ? 0 : parseFloat($('#reatamPalawijaMT3').val().replace(",", ".")),
        reatamTebuMT3 = ($('#reatamTebuMT3').val() == '') ? 0 : parseFloat($('#reatamTebuMT3').val().replace(",", ".")),
        reatamLainnyaMT3 = ($('#reatamLainnyaMT3').val() == '') ? 0 : parseFloat($('#reatamLainnyaMT3').val().replace(",", ".")),
        totMt3 = reatamPadiMT3+reatamPalawijaMT3+reatamTebuMT3+reatamLainnyaMT3,
        totMt3Fix = totMt3;

        $('#jmlMT3').val(totMt3Fix);

        // Total Ha
        let laPermen =  ($('#laPermen').val() == '') ? 0 : parseFloat($('#laPermen').val().replace(",", ".")),
        sawahFungsional =  ($('#sawahFungsional').val() == '') ? 0 : parseFloat($('#sawahFungsional').val().replace(",", ".")),
        laperSawah = 0,
        jmlhData = totMt1+totMt2+totMt3;

        if (laPermen != 0) {
            laperSawah = laPermen;
        }else{
            laperSawah = sawahFungsional;
        }


        let jmlhTotalIp = (jmlhData/laperSawah)*100,
        jmlhDataBagi = jmlhTotalIp;

        if (jmlhTotalIp != Infinity) {
            $('#jmlTotalIp').val(jmlhDataBagi);
        }


        // Total Ip
        jmlhDataFix = jmlhData;
        $('#jmlTotalHa').val(jmlhDataFix);


    }
    // End Row Totaal

    // Produktivitas Padi
    produktivitasPadi = function () {

        let mt1 = ($('#produktivitasPadiMT1').val() == '') ? 0 : parseFloat($('#produktivitasPadiMT1').val().replace(",", ".")),
        mt2 = ($('#produktivitasPadiMT2').val() == '') ? 0 : parseFloat($('#produktivitasPadiMT2').val().replace(",", ".")),
        mt3 = ($('#produktivitasPadiMT3').val() == '') ? 0 : parseFloat($('#produktivitasPadiMT3').val().replace(",", ".")),
        hasilData = 0;

        let arrayData = [mt1, mt2, mt3];

        let sum = 0,
        count = 0;

        $.each(arrayData, function(index, value) {
          if (value > 0 && value !== null && value !== undefined) {
            sum += value;
            count++;
        }
    });


        if (count > 0) {
            hasilData = sum / count;
        }

        hasilData = hasilData;

        $('#produktivitasRata2').val(hasilData);

    }
    // End Produktivitas Padi

    $('.select2').select2({
      theme: 'default'

  })


    <?php if ($this->session->userdata('prive') == 'admin') { ?> 

        $('.select3').select2({
          placeholder: '-Tentukan Daerah Irigasi-',
          theme: 'default',
          ajax: {
            url: base_url() + "RealisasiTanam2E/getDiTambahData",
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