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

  <!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/Ite/plugins/sweetalert2/sweetalert2.min.css"> -->

  <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/Ite/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/Ite/plugins/datepicker/css/bootstrap-datepicker.min.css">

  <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/Ite/dist/css/styles.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.1/sweetalert2.css" integrity="sha512-pxzljms2XK/DmQU3S58LhGyvttZBPNSw1/zoVZiYmYBvjDQW+0K7/DVzWHNz/LeiDs+uiPMtfQpgDeETwqL+1Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                <form role="form" action="<?= base_url(); ?>IndexKinerja4B/SimpanData" method="POST" data-select2-id="25">

                  <div class="content-header bg-warning">
                    <div class="container-fluid">
                      <div class="row m-0 p-0 text-left">
                        <div class="col-sm-7">
                          <h4 class="m-0">Form 4B : DATA KONDISI D.I.R</h4>
                      </div>

                      <div class="col-sm-5 text-right">
                        <a href="<?= base_url(); ?>IndexKinerja4B" class="btn btn-default btn-sm" title="Kembali"><i class="fa fa-undo"></i> Kembali</a>
                        <button type="submit" class="btn btn-primary btn-sm btn-simpan"><i class="fas fa-archive"></i> Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <section class="content" data-select2-id="24">

            <div class="container-fluid" data-select2-id="23">

                <!-- box data teknis -->
                <div class="row" data-select2-id="22">

                    <div class="card-body p-0 " data-select2-id="21">                        <!-- form start -->
                        <div class="modal-body" data-select2-id="20">

                            <?= $this->session->flashdata('psn'); ?>

                            <div style="background-color:red; color:#fff;">
                            </div>

                            <div class="row">
                                <div class="col-sm-6" data-select2-id="33"> <!-- start box per input -->

                                    <?php if ($this->session->userdata('prive') == 'admin') { ?> 
                                        <div class="form-group" data-select2-id="32">
                                            <label for="irigasiid">Nomeklatur/ Nama D.I.  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                            <select id="irigasiid" name="irigasiid" class="form-control select3" required>

                                            </select>
                                            <div class="invalid-feedback" id="pesan_irigasiid"></div>
                                        </div>
                                    <?php }else{ ?>
                                        <div class="form-group" data-select2-id="32">
                                            <label for="irigasiid">Nomeklatur/ Nama D.I.  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                            <select id="irigasiid" name="irigasiid" class="form-control select2" required>
                                                <option value="" selected disabled>- Pilih D.I -</option>
                                                <?php foreach ($dataDi as $key => $value) { ?>
                                                    <option value="<?= $value->irigasiid; ?>"><?= $value->nama; ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="invalid-feedback" id="pesan_irigasiid"></div>
                                        </div>
                                    <?php } ?>

                                </div>
                                <div class="col-sm-3"> 
                                    <div class="form-group">
                                        <label for="laPermen">Luas D.I. Sesuai Permen 14/2015 (Ha)  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                        <input id="laPermen" name="laPermen" value="" type="text" class="form-control text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '');" placeholder="Luas D.I. Sesuai Permen 14/2015 (Ha)" readonly >
                                        <div class="invalid-feedback" id="pesan_laPermen"></div>
                                    </div>
                                </div>

                                <div class="col-sm-3"> 
                                    <div class="form-group">
                                        <label for="sawahFungsional">Sawah/Fungsional (Pemetaan IGT) (Ha)  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                        <input id="sawahFungsional" name="sawahFungsional" value="" oninput="this.value = this.value.replace(/[^0-9,]/g, '');" type="text" class="form-control text-right number" placeholder="Sawah/Fungsional (Pemetaan IGT) (Ha)" required>
                                        <div class="invalid-feedback" id="pesan_sawahFungsional"></div>
                                    </div>
                                </div>

                            </div>




                            <div class="bg-info mb-2" style="padding:2px; margin:0px;">
                                <div class="" style="padding:0px 0px 0px 4px; margin:0px;">Saluran*</div>
                            </div>

                            <div class="row">
                             <div class="col-sm-12" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Saluran Primer</h5><div class="row">

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="saluranB1">B (%)</label>
                                        <input id="saluranB1" name="saluranPrimerB" value="" type="text" class="form-control text-right number saluranPrimer" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(1);" required placeholder="B (%)">
                                        <div class="invalid-feedback" id="pesan_saluranPrimerB"></div>
                                    </div>

                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="saluranRR1">RR (%)</label>
                                        <input id="saluranRR1" name="saluranPrimerBR" value="" type="text" class="form-control text-right number saluranPrimer" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(1);" required placeholder="RR (%)">
                                        <div class="invalid-feedback" id="pesan_saluranPrimerBR"></div>
                                    </div>

                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="saluranRS1">RS (%)</label>
                                        <input id="saluranRS1" name="saluranPrimerRS" value="" type="text" class="form-control text-right number saluranPrimer" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(1);" required placeholder="RS (%)">
                                        <div class="invalid-feedback" id="pesan_saluranPrimerRS"></div>
                                    </div>

                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="saluranRB1">RB (%)</label>
                                        <input id="saluranRB1" name="saluranPrimerRB" value="" type="text" class="form-control text-right number saluranPrimer" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(1);" required placeholder="RB (%)">
                                        <div class="invalid-feedback" id="pesan_saluranPrimerRB"></div>
                                    </div>

                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="saluranRerata1">Rerata (B/RR/RS/RB)</label>
                                        <input id="saluranRerata1" name="saluranPrimerRerata" value="" type="text" class="form-control text-right" placeholder="Rerata (B/RR/RS/RB)" readonly>
                                        <div class="invalid-feedback" id="pesan_saluranPrimerRerata"></div>
                                    </div>

                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="kondisiKerusakan1">Nilai Kondisi Kerusakan (%)</label>
                                        <input id="kondisiKerusakan1" name="saluranPrimerNilai" value="" type="text" class="form-control text-right number rataJaringan" placeholder="Nilai Kondisi Kerusakan (%)" readonly>

                                        <div class="invalid-feedback" id="pesan_saluranPrimerNilai"></div>
                                    </div>

                                </div> 

                            </div>
                        </div>
                        <div class="col-sm-12" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Saluran Sekunder</h5><div class="row">

                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="saluranB2">B (%)</label>
                                    <input id="saluranB2" name="saluranSekunderB" value="" type="text" class="form-control text-right number saluranSekunder" bobot="1" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(2);" required placeholder="B (%)">
                                    <div class="invalid-feedback" id="pesan_saluranSekunderB"></div>
                                </div>

                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="saluranRR2">RR (%)</label>
                                    <input id="saluranRR2" name="saluranSekunderBR" value="" type="text" class="form-control text-right number saluranSekunder" bobot="20" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(2);" required placeholder="RR (%)">
                                    <div class="invalid-feedback" id="pesan_saluranSekunderBR"></div>
                                </div>

                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="saluranRS2">RS (%)</label>
                                    <input id="saluranRS2" name="saluranSekunderRS" value="" type="text" class="form-control text-right number saluranSekunder" bobot="40" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(2);" required placeholder="RS (%)">
                                    <div class="invalid-feedback" id="pesan_saluranSekunderRS"></div>
                                </div>

                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="saluranRB2">RB (%)</label>
                                    <input id="saluranRB2" name="saluranSekunderRB" value="" type="text" class="form-control text-right number saluranSekunder" bobot="50" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(2);" required placeholder="RB (%)">
                                    <div class="invalid-feedback" id="pesan_saluranSekunderRB"></div>
                                </div>

                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="saluranRerata2">Rerata (B/RR/RS/RB)</label>
                                    <input id="saluranRerata2" name="saluranSekunderRerata" value="" type="text" class="form-control text-right" readonly placeholder="Rerata (B/RR/RS/RB)">
                                    <div class="invalid-feedback" id="pesan_saluranSekunderRerata"></div>
                                </div>

                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="kondisiKerusakan2">Nilai Kondisi Kerusakan (%)</label>
                                    <input id="kondisiKerusakan2" name="saluranSekunderNilai" value="" type="text" class="form-control text-right number rataJaringan" readonly placeholder="Nilai Kondisi Kerusakan (%)">
                                    <div class="invalid-feedback" id="pesan_saluranSekunderNilai"></div>
                                </div>

                            </div> 

                        </div>
                    </div>
                    <div class="col-sm-12" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Saluran Tersier</h5><div class="row">

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="saluranB3">B (%)</label>
                                <input id="saluranB3" name="saluranTersierB" value="" type="text" class="form-control text-right number saluranTersier" bobot="1" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(3);" required placeholder="B (%)">
                                <div class="invalid-feedback" id="pesan_saluranTersierB"></div>
                            </div>

                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="saluranRR3">RR (%)</label>
                                <input id="saluranRR3" name="saluranTersierBR" value="" type="text" class="form-control text-right number saluranTersier" bobot="20" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(3);" required placeholder="RR (%)">
                                <div class="invalid-feedback" id="pesan_saluranTersierBR"></div>
                            </div>

                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="saluranRS3">RS (%)</label>
                                <input id="saluranRS3" name="saluranTersierRS" value="" type="text" class="form-control text-right number saluranTersier" bobot="40" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(3);" required placeholder="RS (%)">
                                <div class="invalid-feedback" id="pesan_saluranTersierRS"></div>
                            </div>

                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="saluranRB3">RB (%)</label>
                                <input id="saluranRB3" name="saluranTersierRB" value="" type="text" class="form-control text-right number saluranTersier" bobot="50" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(3);" required placeholder="RB (%)">
                                <div class="invalid-feedback" id="pesan_saluranTersierRB"></div>
                            </div>

                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="saluranRerata3">Rerata (B/RR/RS/RB)</label>
                                <input id="saluranRerata3" name="saluranTersierRerata" value="" type="text" class="form-control text-right" placeholder="Rerata (B/RR/RS/RB)" readonly>
                                <div class="invalid-feedback" id="pesan_saluranTersierRerata"></div>
                            </div>

                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="kondisiKerusakan3">Nilai Kondisi Kerusakan (%)</label>
                                <input id="kondisiKerusakan3" name="saluranTersierNilai" value="" type="text" class="form-control text-right number rataJaringan" placeholder="Nilai Kondisi Kerusakan (%)" readonly>
                                <div class="invalid-feedback" id="pesan_saluranTersierNilai"></div>
                            </div>

                        </div> 

                    </div>
                </div>
                <div class="col-sm-12" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Saluran Pembuang</h5><div class="row">

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="saluranB4">B (%)</label>
                            <input id="saluranB4" name="saluranPembuangB" value="" type="text" class="form-control text-right number saluranPembuang" bobot="50" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(4);" required placeholder="B (%)">
                            <div class="invalid-feedback" id="pesan_saluranPembuangB"></div>
                        </div>

                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="saluranRR4">RR (%)</label>
                            <input id="saluranRR4" name="saluranPembuangBR" value="" type="text" class="form-control text-right number saluranPembuang" bobot="50" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(4);" required placeholder="RR (%)">
                            <div class="invalid-feedback" id="pesan_saluranPembuangBR"></div>
                        </div>

                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="saluranRS4">RS (%)</label>
                            <input id="saluranRS4" name="saluranPembuangRS" value="" type="text" class="form-control text-right number saluranPembuang" bobot="50" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(4);" required placeholder="RS (%)">
                            <div class="invalid-feedback" id="pesan_saluranPembuangRS"></div>
                        </div>

                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="saluranRB4">RB (%)</label>
                            <input id="saluranRB4" name="saluranPembuangRB" value="" type="text" class="form-control text-right number saluranPembuang" bobot="50" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(4);" required placeholder="RB (%)">
                            <div class="invalid-feedback" id="pesan_saluranPembuangRB"></div>
                        </div>

                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="saluranRerata4">Rerata (B/RR/RS/RB)</label>
                            <input id="saluranRerata4" name="saluranPembuangRerata" value="" type="text" class="form-control text-right" placeholder="Rerata (B/RR/RS/RB)" readonly>
                            <div class="invalid-feedback" id="pesan_saluranPembuangRerata"></div>
                        </div>

                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="kondisiKerusakan4">Nilai Kondisi Kerusakan (%)</label>
                            <input id="kondisiKerusakan4" name="saluranPembuangNilai" value="" type="text" class="form-control text-right number rataJaringan" placeholder="Nilai Kondisi Kerusakan (%)" readonly>
                            <div class="invalid-feedback" id="pesan_saluranPembuangNilai"></div>
                        </div>

                    </div> 

                </div>
            </div>
        </div>

        <div class="bg-info mb-2" style="padding:2px; margin:0px;">
            <div class="" style="padding:0px 0px 0px 4px; margin:0px;">Bangunan Pengatur*</div>
        </div>

        <div class="row">
           <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Bangunan Pintu Primer</h5><div class="row">

            <div class="col-sm-6"> 

                <div class="form-group">
                    <label for="bangutarPengukur1">B/RR/RS/RB</label>
                    <input id="bangutarPengukur1" name="bppPrimerA" value="" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
                    <div class="invalid-feedback" id="pesan_bppBagiA"></div>
                </div>


            </div> 
            <div class="col-sm-6"> 
                <div class="form-group">
                    <label for="bangunanPengukurValue1">Nilai Kondisi (%)</label>
                    <input id="bangunanPengukurValue1" name="bppPrimerB" value="" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(1);" required placeholder="Nilai Kondisi (%)">
                    <div class="invalid-feedback" id="pesan_bppBagiB"></div>
                </div>

            </div> 

        </div>
    </div>
    <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Bangunan Pintu Sekunder</h5><div class="row">

        <div class="col-sm-6"> 

            <div class="form-group">
                <label for="bangutarPengukur2">B/RR/RS/RB</label>
                <input id="bangutarPengukur2" value="" type="text" name="bppSekunderA" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
                <div class="invalid-feedback" id="pesan_bppBagiSadapA"></div>
            </div>


        </div> 
        <div class="col-sm-6"> 
            <div class="form-group">
                <label for="bangunanPengukurValue2">Nilai Kondisi (%)</label>
                <input id="bangunanPengukurValue2" name="bppSekunderB" value="" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(2);" required placeholder="Nilai Kondisi (%)">
                <div class="invalid-feedback" id="pesan_bppBagiSadapB"></div>
            </div>

        </div> 

    </div>
</div>
<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Bangunan Pintu Tersier</h5><div class="row">

    <div class="col-sm-6"> 

        <div class="form-group">
            <label for="bangutarPengukur3">B/RR/RS/RB</label>
            <input id="bangutarPengukur3" name="bppTersierA" value="" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_bppSadapA"></div>
        </div>

        
    </div> 
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangunanPengukurValue3">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue3" name="bppTersierB" value="" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(3);" required placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_bppSadapB"></div>
        </div>
        
    </div> 

</div>
</div>
<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Bangunan Pintu Pembuang</h5><div class="row">

    <div class="col-sm-6"> 

        <div class="form-group">
            <label for="bangutarPengukur4">B/RR/RS/RB</label>
            <input id="bangutarPengukur4" name="bppPembuangA" value="" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_bppBangunanPengukurA"></div>
        </div>

        
    </div> 
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangunanPengukurValue4">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue4" name="bppPembuangB" value="" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(4);" required placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_bppBangunanPengukurB"></div>
        </div>
        
    </div> 

</div>
</div>

<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Bendung</h5><div class="row">

    <div class="col-sm-6"> 

        <div class="form-group">
            <label for="bangutarPengukur5">B/RR/RS/RB</label>
            <input id="bangutarPengukur5" name="bppBendungA" value="" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_bppBangunanPengukurA"></div>
        </div>

        
    </div> 
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangunanPengukurValue5">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue5" name="bppBendungB" value="" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(5);" required placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_bppBangunanPengukurB"></div>
        </div>
        
    </div> 

</div>
</div>

</div>


<div class="bg-info mb-2" style="padding:2px; margin:0px;">
    <div class="" style="padding:0px 0px 0px 4px; margin:0px;">Bangunan Lindung*</div>
</div>

<div class="row">
 <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Tanggul</h5><div class="row">

    <div class="col-sm-6">


        <div class="form-group">
            <label for="bangutarPengukur6">B/RR/RS/RB</label>
            <input id="bangutarPengukur6" name="blinTanggulA" value="" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_bPembawaGorongA"></div>
        </div>
        
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="bangunanPengukurValue6">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue6" name="blinTanggulB" value="" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(6);" required placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_bPembawaGorongB"></div>
        </div>
        
    </div> 

</div>
</div>




<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Polder</h5><div class="row">

    <div class="col-sm-6">


        <div class="form-group">
            <label for="bangutarPengukur7">B/RR/RS/RB</label>
            <input id="bangutarPengukur7" value="" type="text" name="blinPolderA" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_bPembawaSiponA"></div>
        </div>
        
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="bangunanPengukurValue7">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue7" name="blinPolderB" value="" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(7);" required placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_bPembawaSiponB"></div>
        </div>
        
    </div> 

</div>
</div>

</div>


<div class="bg-info mb-2" style="padding:2px; margin:0px;">
    <div class="" style="padding:0px 0px 0px 4px; margin:0px;">Bangunan Pelengkap*</div>
</div>


<div class="row">
 <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Jalan Inspeksi</h5><div class="row">

    <div class="col-sm-6"> 


        <div class="form-group">
            <label for="bangutarPengukur8">B/RR/RS/RB</label>
            <input id="bangutarPengukur8" value="" name="balengJalanInspeksiA" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_blinKantongA"></div>
        </div>
        
        
    </div> 
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangunanPengukurValue8">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue8" name="balengJalanInspeksiB" value="" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(8);" required placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_blinKantongB"></div>
        </div>
        
    </div> 
</div>
</div>




<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Jembatan</h5><div class="row">

    <div class="col-sm-6"> 


        <div class="form-group">
            <label for="bangutarPengukur9">B/RR/RS/RB</label>
            <input id="bangutarPengukur9" value="" name="balengJembatanA" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_blinPelimpahA"></div>
        </div>
        
        
    </div> 
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangunanPengukurValue9">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue9" name="balengJembatanB" value="" type="text" class="form-control text-right  number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(9);" required placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_blinPelimpahB"></div>
        </div>
        
    </div> 
</div>
</div>




<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Gorong-Gorong</h5><div class="row">

    <div class="col-sm-6"> 


        <div class="form-group">
            <label for="bangutarPengukur10">B/RR/RS/RB</label>
            <input id="bangutarPengukur10" value="" name="balengGorongA" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_blinPengurasA"></div>
        </div>
        
        
    </div> 
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangunanPengukurValue10">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue10" name="balengGorongB" value="" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(10);" required placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_blinPengurasB"></div>
        </div>
        
    </div> 
</div>
</div>




<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Dermaga</h5><div class="row">

    <div class="col-sm-6"> 


        <div class="form-group">
            <label for="bangutarPengukur11">B/RR/RS/RB</label>
            <input id="bangutarPengukur11" value="" type="text" name="balengDermagaA" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_blinSaluranGendongA"></div>
        </div>
        
        
    </div> 
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangunanPengukurValue11">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue11" name="balengDermagaB" value="" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(11);" required placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_blinSaluranGendongB"></div>
        </div>
        
    </div> 
</div>
</div>




<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Kantor Pengamat</h5><div class="row">

    <div class="col-sm-6"> 


        <div class="form-group">
            <label for="bangutarPengukur12">B/RR/RS/RB</label>
            <input id="bangutarPengukur12" name="balengKantorPengamatA" value="" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_blinKribA"></div>
        </div>
        
        
    </div> 
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangunanPengukurValue12">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue12" name="balengKantorPengamatB" value="" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(12);" required placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_blinKribB"></div>
        </div>
        
    </div> 
</div>
</div>




<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Gudang</h5><div class="row">

    <div class="col-sm-6"> 


        <div class="form-group">
            <label for="bangutarPengukur13">B/RR/RS/RB</label>
            <input id="bangutarPengukur13" value="" name="balengGudangA" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_blinPerkuatanTebingA"></div>
        </div>
        
        
    </div> 
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangunanPengukurValue13">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue13" name="balengGudangB" value="" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(13);" required placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_blinPerkuatanTebingB"></div>
        </div>
        
    </div> 
</div>
</div>




<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Rumah Jaga</h5><div class="row">

    <div class="col-sm-6"> 


        <div class="form-group">
            <label for="bangutarPengukur14">B/RR/RS/RB</label>
            <input id="bangutarPengukur14" value="" name="balengRumahJagaA" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_blinTanggungA"></div>
        </div>
        
        
    </div> 
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangunanPengukurValue14">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue14" name="balengRumahJagaB" value="" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(14);" required placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_blinTanggungB"></div>
        </div>
        
    </div> 
</div>
</div>


<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Sanggar Tani</h5><div class="row">

    <div class="col-sm-6"> 


        <div class="form-group">
            <label for="bangutarPengukur15">B/RR/RS/RB</label>
            <input id="bangutarPengukur15" value="" name="balengSanggarTaniA" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_blinTanggungA"></div>
        </div>
        
        
    </div> 
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangunanPengukurValue15">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue15" name="balengSanggarTaniB" value="" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(15);" required placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_blinTanggungB"></div>
        </div>
        
    </div> 
</div>
</div>

</div>


<div class="bg-info mb-2" style="padding:2px; margin:0px;">
    <div class="" style="padding:0px 0px 0px 4px; margin:0px;">Sarana*</div>
</div>

<div class="row">
   <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Pintu Air</h5><div class="row">

    <div class="col-sm-6"> 

        <div class="form-group">
            <label for="bangutarPengukur16">B/RR/RS/RB</label>
            <input id="bangutarPengukur16" value="" name="saranaPintuAirA" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_saranaPintuAirA"></div>
        </div>
        

    </div> 
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangunanPengukurValue16">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue16" name="saranaPintuAirB" value="" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(16);" required placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_saranaPintuAirB"></div>
        </div>
        

    </div> 

</div>
</div>


<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Alat Ukur</h5><div class="row">

    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangutarPengukur17">B/RR/RS/RB</label>
            <input id="bangutarPengukur17" value="" name="saranaAlatUkurA" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_saranaAlatUkurA"></div>
        </div>            
    </div> 
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangunanPengukurValue17">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue17" name="saranaAlatUkurB" value="" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(17);" placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_saranaAlatUkurB"></div>
        </div>        
    </div> 

</div>
</div>
</div>

<div class="bg-info mb-2" style="padding:2px; margin:0px;">
    <div class="" style="padding:0px 0px 0px 4px; margin:0px;">Rata-Rata Jaringan</div>
</div>


<div class="row">
 <div class="col-sm-4" style="border:thin solid #e6e6e6;"><div class="row">

    <div class="col-sm-6">
        <div class="form-group">
            <label for="rataJaringanA">B/RR/RS/RB</label>
            <input id="rataJaringanA" name="rataJaringanA" value="" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_rataJaringanA"></div>
        </div>
        

        
    </div> 
    <div class="col-sm-6">
        <div class="form-group">
            <label for="rataJaringanB">Nilai Kondisi (%)</label>
            <input id="rataJaringanB" name="rataJaringanB" value="" type="text" class="form-control kududisabled" placeholder="Nilai Kondisi (%)" readonly>
            <div class="invalid-feedback" id="pesan_rataJaringanB"></div>
        </div>
        

        
    </div> 

</div></div>
</div>

<div class="bg-info mb-2" style="padding:2px; margin:0px;">
    <div class="" style="padding:0px 0px 0px 4px; margin:0px;">Keterangan</div>
</div>

<div class="col-sm-12">
    <div class="form-group">
        <label for="in_keterangan">Keterangan</label>
        <textarea id="in_keterangan" name="keterangan" class="form-control" rows="3" placeholder="Keterangan"></textarea>
        <div class="invalid-feedback" id="pesan_keterangan"></div>
    </div>
</div>

</div>


<div class="modal-footer justify-content-between">
    <div class="row">
      <a href="<?= base_url(); ?>IndexKinerja4B" class="btn btn-default btn-sm" title="Kembali"><i class="fa fa-undo"></i> Kembali</a>
      <button type="submit" class="btn btn-primary btn-sm btn-simpan">Simpan</button>
  </div>
</div>
</form>

<!-- form end -->

</div>
</div>

</div>
</section></div>
</div>


</div>
</div>
<!-- /.content-wrapper --><!-- Bootstrap 4 -->
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.1/sweetalert2.js" integrity="sha512-DoPZ83VLspnR3EABDBYYsyg3vX19Rea49+he95BksesSoB5zaGHDDY/fNJMDMu8173wq11UU/jXTcGsRGWi2JA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="<?= base_url(); ?>assets/admin/Ite/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js" type="text/javascript"></script>

<script src="<?= base_url(); ?>assets/admin/Ite/plugins/select2-4.0.8/dist/js/select2.full.min.js" type="text/javascript"></script>
<!-- <script src="<?= base_url(); ?>assets/admin/Ite/plugins/sweetalert2/sweetalert2.min.js" type="text/javascript"></script> -->

<script>
  $(document).ready(function(){

    $('#irigasiid').on('change', function() {
        let val = $(this).val();

        $.ajax({
            url: base_url()+'IndexKinerja4B/getLapermen', 
            method: 'POST',
            data: {irigasiid:val},
            dataType: 'json',
            success: function(res) {

                $('#laPermen').val(res.lper);

            },
            error: function(xhr, status, error) {
                alert('Ada yang error.!');
            }
        });
    });

    // Hitungan bangunan Utama
    hitungBangunanUtama = function (urutan) {

        let nilai = ($(`#bangnanUtama${urutan}`).val() == null || $(`#bangnanUtama${urutan}`).val() == '') ? 0 : $(`#bangnanUtama${urutan}`).val().toString().replace(/,/g, '.');

        if (parseFloat(nilai) > 100) {
            Swal.fire("Nilai Tidak Boleh Lebih Dari 100%");
            $(`#bangnanUtama${urutan}`).val('100')
        }

        if (nilai !== 0) {
            if (nilai > 90) {
                $(`#isi${urutan}`).val('B');
            } else if (nilai >= 80) {
                $(`#isi${urutan}`).val('RR');
            } else if (nilai >= 60) {
                $(`#isi${urutan}`).val('RS');
            } else if (nilai > 0) {
                $(`#isi${urutan}`).val('RB');
            } else {
                $(`#isi${urutan}`).val('Null');
            }
        } else {
           $(`#isi${urutan}`).val('Null');
       }

       hitungRataRataSemua();

   }
    // End Hitungan bangunan Utama


   // Hitung Saluran
   hitungSaluran = function (index) {
    let saluranB1 = ($(`#saluranB${index}`).val() == null || $(`#saluranB${index}`).val() == '') ? 0 : $(`#saluranB${index}`).val().toString().replace(/,/g, '.'),
    saluranRR1 =  ($(`#saluranRR${index}`).val() == null || $(`#saluranRR${index}`).val() == '') ? 0 : $(`#saluranRR${index}`).val().toString().replace(/,/g, '.'),
    saluranRS1 =  ($(`#saluranRS${index}`).val() == null || $(`#saluranRS${index}`).val() == '') ? 0 : $(`#saluranRS${index}`).val().toString().replace(/,/g, '.'),
    saluranRB1 =  ($(`#saluranRB${index}`).val() == null || $(`#saluranRB${index}`).val() == '') ? 0 : $(`#saluranRB${index}`).val().toString().replace(/,/g, '.');

    if (parseFloat(saluranB1) > 100) {
        Swal.fire("Nilai Tidak Boleh Lebih Dari 100%");
        $(`#saluranB${index}`).val('100')
    }

    if (parseFloat(saluranRR1) > 100) {
        Swal.fire("Nilai Tidak Boleh Lebih Dari 100%");
        $(`#saluranRR${index}`).val('100')
    }

    if (parseFloat(saluranRS1) > 100) {
        Swal.fire("Nilai Tidak Boleh Lebih Dari 100%");
        $(`#saluranRS${index}`).val('100')
    }

    if (parseFloat(saluranRB1) > 100) {
        Swal.fire("Nilai Tidak Boleh Lebih Dari 100%");
        $(`#saluranRB${index}`).val('100')
    }

    let nilaiKondisiKerusakan = ((parseFloat(saluranB1) * 1) + (parseFloat(saluranRR1) * 20) + (parseFloat(saluranRS1) * 40) + (parseFloat(saluranRB1) * 50)) / (parseFloat(saluranB1) + parseFloat(saluranRR1) + parseFloat(saluranRS1) + parseFloat(saluranRB1)),
    nilaiKondisiKerusakanFix  = isNaN(nilaiKondisiKerusakan) ? 0 : nilaiKondisiKerusakan;

    $(`#kondisiKerusakan${index}`).val(nilaiKondisiKerusakanFix);


    if (nilaiKondisiKerusakanFix !== 0) {
        if (nilaiKondisiKerusakanFix > 40) {
            $(`#saluranRerata${index}`).val('RB')
        } else if (nilaiKondisiKerusakanFix >= 21) {
            $(`#saluranRerata${index}`).val('RS')
        } else if (nilaiKondisiKerusakanFix >= 10) {
         $(`#saluranRerata${index}`).val('RR')
     } else if (nilaiKondisiKerusakanFix > 0) {
        $(`#saluranRerata${index}`).val('B')
    } else {
        $(`#saluranRerata${index}`).val('Null')
    }
} else {
   $(`#saluranRerata${index}`).val('Null')
}

hitungRataRataSemua();

}
   // End Hitung Saluran

// Bangunan Pengatur dan Pengukur
hitungBangunanPengukur = function (index) {

    let nilai = ($(`#bangunanPengukurValue${index}`).val() == null || $(`#bangunanPengukurValue${index}`).val() == '') ? 0 : $(`#bangunanPengukurValue${index}`).val().toString().replace(/,/g, '.');

    if (parseFloat(nilai) > 100) {
        Swal.fire("Nilai Tidak Boleh Lebih Dari 100%");
        $(`#bangunanPengukurValue${index}`).val('100')
    }


    if (nilai !== 0) {
        if (nilai > 90) {
            $(`#bangutarPengukur${index}`).val('B')
        } else if (nilai >= 80) {
         $(`#bangutarPengukur${index}`).val('RR')
     } else if (nilai >= 60) {
        $(`#bangutarPengukur${index}`).val('RS')
    } else if (nilai > 0) {;
    $(`#bangutarPengukur${index}`).val('RB')
} else {
    $(`#bangutarPengukur${index}`).val('null')
}
} else {
    $(`#bangutarPengukur${index}`).val('null')
}

hitungRataRataSemua();

}
// End Bangunan Pengatur dan Pengukur


// hitung bangunan pembawa
hitungBangunanPembawa = function (index) {

    let nilai = ($(`#valBangunanPembawa${index}`).val() == null || $(`#valBangunanPembawa${index}`).val() == '') ? 0 : $(`#valBangunanPembawa${index}`).val().toString().replace(/,/g, '.');

    if (parseFloat(nilai) > 100) {
        Swal.fire("Nilai Tidak Boleh Lebih Dari 100%");
        $(`#valBangunanPembawa${index}`).val('100')
    }


    if (nilai !== 0) {
        if (nilai > 90) {
            $(`#kondisiBangunanPembawa${index}`).val('B')
        } else if (nilai >= 80) {
            $(`#kondisiBangunanPembawa${index}`).val('RR')
        } else if (nilai >= 60) {
            $(`#kondisiBangunanPembawa${index}`).val('RS')
        } else if (nilai > 0) {
            $(`#kondisiBangunanPembawa${index}`).val('RB')
        } else {
            $(`#kondisiBangunanPembawa${index}`).val('null')
        }
    } else {
        $(`#kondisiBangunanPembawa${index}`).val('null')
    }

    hitungRataRataSemua();

}
// End hitung bangunan pembawa

// Hitung Bangunan Lindung
hitungbangunanLindung = function (index) {

    let nilai = ($(`#valBangunanLindung${index}`).val() == null || $(`#valBangunanLindung${index}`).val() == '') ? 0 : $(`#valBangunanLindung${index}`).val().toString().replace(/,/g, '.');

    if (parseFloat(nilai) > 100) {
        Swal.fire("Nilai Tidak Boleh Lebih Dari 100%");
        $(`#valBangunanLindung${index}`).val('100')
    }


    if (nilai !== 0) {
        if (nilai > 90) {
            $(`#kondisiBangunanLindung${index}`).val('B')
        } else if (nilai >= 80) {
            $(`#kondisiBangunanLindung${index}`).val('RR')
        } else if (nilai >= 60) {
            $(`#kondisiBangunanLindung${index}`).val('RS')
        } else if (nilai > 0) {
            $(`#kondisiBangunanLindung${index}`).val('RB')
        } else {
            $(`#kondisiBangunanLindung${index}`).val('null')
        }
    } else {
        $(`#kondisiBangunanLindung${index}`).val('null')
    }

    hitungRataRataSemua();
}
// End Hitung Bangunan Lindung

// Hitung Bangunan Pelengkap
hitungBangunanPelengkap = function (index) {

    let nilai = ($(`#valBangunanPelengkap${index}`).val() == null || $(`#valBangunanPelengkap${index}`).val() == '') ? 0 : $(`#valBangunanPelengkap${index}`).val().toString().replace(/,/g, '.');

    if (parseFloat(nilai) > 100) {
        Swal.fire("Nilai Tidak Boleh Lebih Dari 100%");
        $(`#valBangunanPelengkap${index}`).val('100')
    }


    if (nilai !== 0) {
        if (nilai > 90) {
            $(`#kondisiBangunanPelengkap${index}`).val('B')
        } else if (nilai >= 80) {
            $(`#kondisiBangunanPelengkap${index}`).val('RR')
        } else if (nilai >= 60) {
            $(`#kondisiBangunanPelengkap${index}`).val('RS')
        } else if (nilai > 0) {
            $(`#kondisiBangunanPelengkap${index}`).val('RB')
        } else {
            $(`#kondisiBangunanPelengkap${index}`).val('null')
        }
    } else {
        $(`#kondisiBangunanPelengkap${index}`).val('null')
    }

    hitungRataRataSemua();
}
// Hitung Bangunan Pelengkap

// Hitung Sara
hitungSarana = function (index) {

    let nilai = ($(`#valAlatUkur${index}`).val() == null || $(`#valAlatUkur${index}`).val() == '') ? 0 : $(`#valAlatUkur${index}`).val().toString().replace(/,/g, '.');

    if (parseFloat(nilai) > 100) {
        Swal.fire("Nilai Tidak Boleh Lebih Dari 100%");
        $(`#valAlatUkur${index}`).val('100')
    }


    if (nilai !== 0) {
        if (nilai > 90) {
            $(`#kondisiAlatUkur${index}`).val('B')
        } else if (nilai >= 80) {
            $(`#kondisiAlatUkur${index}`).val('RR')
        } else if (nilai >= 60) {
            $(`#kondisiAlatUkur${index}`).val('RS')
        } else if (nilai > 0) {
            $(`#kondisiAlatUkur${index}`).val('RB')
        } else {
            $(`#kondisiAlatUkur${index}`).val('null')
        }
    } else {
        $(`#kondisiAlatUkur${index}`).val('null')
    }

    hitungRataRataSemua();
}
// End Hitung Sara

// Rata - Rata Jaringan
async function hitungRataRataSemua() {

    try{
        let totData = 0,
        jmlhData = 0;

        let arrayName = ['saluranPrimerNilai', 'saluranSekunderNilai', 'saluranTersierNilai', 'saluranPembuangNilai', 'bppPrimerB', 'bppSekunderB', 'bppTersierB', 'bppPembuangB', 'bppBendungB', 'blinTanggulB', 'blinPolderB', 'balengJalanInspeksiB', 'balengJembatanB', 'balengGorongB', 'balengDermagaB', 'balengKantorPengamatB', 'balengGudangB', 'balengRumahJagaB', 'balengSanggarTaniB', 'saranaPintuAirB', 'saranaAlatUkurB'];

        for (let i = 0; i < arrayName.length; i++) {

            nilai = await ($(`input[name='${arrayName[i]}']`).val() == '') ? 0 : parseFloat($(`input[name='${arrayName[i]}']`).val().toString().replace(/,/g, '.'));



            if (nilai != 0) {
              jmlhData = await jmlhData+nilai;
              await totData++;
          }
      }

      nilaiFix = await jmlhData/totData;

      $('#rataJaringanB').val(nilaiFix);

      if (nilaiFix !== 0) {
        if (nilaiFix > 90) {
            $('#rataJaringanA').val('B');
        } else if (nilaiFix >= 80) {
            $('#rataJaringanA').val('RR');
        } else if (nilaiFix >= 60) {
            $('#rataJaringanA').val('RS');
        } else if (nilaiFix > 0) {
            $('#rataJaringanA').val('RB');
        } else {
            $('#rataJaringanA').val('');
        }
    } else {
        $('#rataJaringanA').val('');
    }

    totData = await 0;
    jmlhData = await 0;

}catch(err){
    alert(err)
}

}
// End Rata - Rata Jaringan


$('.select2').select2({
  theme: 'default'

})


<?php if ($this->session->userdata('prive') == 'admin') { ?> 

    $('.select3').select2({
      placeholder: '-Tentukan Daerah Irigasi-',
      theme: 'default',
      ajax: {
        url: base_url() + "IndexKinerja4B/getDiTambahData",
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