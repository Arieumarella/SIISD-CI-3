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
            <form role="form" action="<?= base_url(); ?>IndexKinerja4D/SimpanDataEdit" method="POST" data-select2-id="25">

              <div class="content-header bg-warning">
                <div class="container-fluid">
                  <div class="row m-0 p-0 text-left">
                    <div class="col-sm-7">
                        <h4 class="m-0">Form 4D : DATA KONDISI D.I.T</h4>
                    </div>

                    <div class="col-sm-5 text-right">
                        <a href="<?= base_url(); ?>IndexKinerja4D" class="btn btn-default btn-sm" title="Kembali"><i class="fa fa-undo"></i> Kembali</a>
                        <button type="submit" class="btn btn-primary btn-sm btn-simpan"><i class="fas fa-archive"></i> Simpan Perubahan</button>
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

                                    <div class="form-group" data-select2-id="32">
                                        <label for="irigasiid">Nomeklatur/ Nama D.I.  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                        <select id="irigasiid" name="irigasiid" class="form-control select2" required>
                                         <option value="<?= $id; ?>"><?= $dataDi->nama; ?></option>                                            
                                     </select>
                                     <div class="invalid-feedback" id="pesan_irigasiid"></div>
                                 </div>

                             </div>
                             <div class="col-sm-3"> 
                                <div class="form-group">
                                    <label for="laPermen">Luas D.I. Sesuai Permen 14/2015 (Ha)  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                    <input id="laPermen" name="laPermen" value="<?= str_replace('.', ',', $dataDi->lper);  ?>" type="text" class="form-control text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '');" placeholder="Luas D.I. Sesuai Permen 14/2015 (Ha)" readonly >
                                    <div class="invalid-feedback" id="pesan_laPermen"></div>
                                </div>
                            </div>

                            <div class="col-sm-3"> 
                                <div class="form-group">
                                    <label for="sawahFungsional">Sawah/Fungsional (Pemetaan IGT) (Ha)  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                    <input id="sawahFungsional" name="sawahFungsional" value="<?= str_replace('.', ',', $dataDi->sawahFungsional);  ?>" oninput="this.value = this.value.replace(/[^0-9,]/g, '');" type="text" class="form-control text-right number" placeholder="Sawah/Fungsional (Pemetaan IGT) (Ha)" required>
                                    <div class="invalid-feedback" id="pesan_sawahFungsional"></div>
                                </div>
                            </div>

                        </div>

                        <div class="bg-info mb-2" style="padding:2px; margin:0px;">
                            <div class="" style="padding:0px 0px 0px 4px; margin:0px;">Bangunan Utama*</div>
                        </div>

                        <div class="row">

                            <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Pengambilan Air Tawar</h5>
                                <div class="row">
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="bangutarPengukur1">B/RR/RS/RB</label>
                                            <input id="bangutarPengukur1" name="buPengambilanAirTawarA" value="<?= str_replace('.', ',', $dataDi->buPengambilanAirTawarA);  ?>" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
                                            <div class="invalid-feedback" id="pesan_bppBagiA"></div>
                                        </div>
                                    </div> 
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="bangunanPengukurValue1">Nilai Kondisi (%)</label>
                                            <input id="bangunanPengukurValue1" name="buPengambilanAirTawarB" value="<?= str_replace('.', ',', $dataDi->buPengambilanAirTawarB);  ?>" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(1);" required placeholder="Nilai Kondisi (%)">
                                            <div class="invalid-feedback" id="pesan_bppBagiB"></div>
                                        </div>
                                    </div> 
                                </div>
                            </div>


                            <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Pengambilan Air Asin</h5>
                                <div class="row">
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="bangutarPengukur2">B/RR/RS/RB</label>
                                            <input id="bangutarPengukur2" name="buPengambilanAirAsinA" value="<?= str_replace('.', ',', $dataDi->buPengambilanAirAsinA);  ?>" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
                                            <div class="invalid-feedback" id="pesan_bppBagiA"></div>
                                        </div>
                                    </div> 
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="bangunanPengukurValue2">Nilai Kondisi (%)</label>
                                            <input id="bangunanPengukurValue2" name="buPengambilanAirAsinB" value="<?= str_replace('.', ',', $dataDi->buPengambilanAirAsinB);  ?>" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(2);" required placeholder="Nilai Kondisi (%)">
                                            <div class="invalid-feedback" id="pesan_bppBagiB"></div>
                                        </div>
                                    </div> 
                                </div>
                            </div>

                            <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Stasiun Pompa</h5>
                                <div class="row">
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="bangutarPengukur3">B/RR/RS/RB</label>
                                            <input id="bangutarPengukur3" name="buStasiunPompaA" value="<?= str_replace('.', ',', $dataDi->buStasiunPompaA);  ?>" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
                                            <div class="invalid-feedback" id="pesan_bppBagiA"></div>
                                        </div>
                                    </div> 
                                    <div class="col-sm-6"> 
                                        <div class="form-group">
                                            <label for="bangunanPengukurValue3">Nilai Kondisi (%)</label>
                                            <input id="bangunanPengukurValue3" name="buStasiunPompaB" value="<?= str_replace('.', ',', $dataDi->buStasiunPompaB);  ?>" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(3);" required placeholder="Nilai Kondisi (%)">
                                            <div class="invalid-feedback" id="pesan_bppBagiB"></div>
                                        </div>
                                    </div> 
                                </div>
                            </div>

                        </div>

                        <div class="bg-info mb-2" style="padding:2px; margin:0px;">
                            <div class="" style="padding:0px 0px 0px 4px; margin:0px;">Saluran*</div>
                        </div>

                        <div class="row">
                           <div class="col-sm-12" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Saluran Primer</h5>

                            <div class="row">

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="saluranB1">B (%)</label>
                                        <input id="saluranB1" name="saluranPrimerB" value="<?= str_replace('.', ',', $dataDi->saluranPrimerB);  ?>" type="text" class="form-control text-right number saluranPrimer" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(1);" required placeholder="B (%)">
                                        <div class="invalid-feedback" id="pesan_saluranPrimerB"></div>
                                    </div>

                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="saluranRR1">RR (%)</label>
                                        <input id="saluranRR1" name="saluranPrimerBR" value="<?= str_replace('.', ',', $dataDi->saluranPrimerBR);  ?>" type="text" class="form-control text-right number saluranPrimer" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(1);" required placeholder="RR (%)">
                                        <div class="invalid-feedback" id="pesan_saluranPrimerBR"></div>
                                    </div>

                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="saluranRS1">RS (%)</label>
                                        <input id="saluranRS1" name="saluranPrimerRS" value="<?= str_replace('.', ',', $dataDi->saluranPrimerRS);  ?>" type="text" class="form-control text-right number saluranPrimer" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(1);" required placeholder="RS (%)">
                                        <div class="invalid-feedback" id="pesan_saluranPrimerRS"></div>
                                    </div>

                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="saluranRB1">RB (%)</label>
                                        <input id="saluranRB1" name="saluranPrimerRB" value="<?= str_replace('.', ',', $dataDi->saluranPrimerRB);  ?>" type="text" class="form-control text-right number saluranPrimer" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(1);" required placeholder="RB (%)">
                                        <div class="invalid-feedback" id="pesan_saluranPrimerRB"></div>
                                    </div>

                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="saluranRerata1">Rerata (B/RR/RS/RB)</label>
                                        <input id="saluranRerata1" name="saluranPrimerRerata" value="<?= str_replace('.', ',', $dataDi->saluranPrimerRerata);  ?>" type="text" class="form-control text-right" placeholder="Rerata (B/RR/RS/RB)" readonly>
                                        <div class="invalid-feedback" id="pesan_saluranPrimerRerata"></div>
                                    </div>

                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="kondisiKerusakan1">Nilai Kondisi Kerusakan (%)</label>
                                        <input id="kondisiKerusakan1" name="saluranPrimerNilai" value="<?= str_replace('.', ',', $dataDi->saluranPrimerNilai);  ?>" type="text" class="form-control text-right number rataJaringan" placeholder="Nilai Kondisi Kerusakan (%)" readonly>

                                        <div class="invalid-feedback" id="pesan_saluranPrimerNilai"></div>
                                    </div>

                                </div> 

                            </div>
                        </div>
                        <div class="col-sm-12" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Saluran Sekunder</h5>

                            <div class="row">

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="saluranB2">B (%)</label>
                                        <input id="saluranB2" name="saluranSekunderB" value="<?= str_replace('.', ',', $dataDi->saluranSekunderB);  ?>" type="text" class="form-control text-right number saluranSekunder" bobot="1" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(2);" required placeholder="B (%)">
                                        <div class="invalid-feedback" id="pesan_saluranSekunderB"></div>
                                    </div>

                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="saluranRR2">RR (%)</label>
                                        <input id="saluranRR2" name="saluranSekunderBR" value="<?= str_replace('.', ',', $dataDi->saluranSekunderBR);  ?>" type="text" class="form-control text-right number saluranSekunder" bobot="20" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(2);" required placeholder="RR (%)">
                                        <div class="invalid-feedback" id="pesan_saluranSekunderBR"></div>
                                    </div>

                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="saluranRS2">RS (%)</label>
                                        <input id="saluranRS2" name="saluranSekunderRS" value="<?= str_replace('.', ',', $dataDi->saluranSekunderRS);  ?>" type="text" class="form-control text-right number saluranSekunder" bobot="40" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(2);" required placeholder="RS (%)">
                                        <div class="invalid-feedback" id="pesan_saluranSekunderRS"></div>
                                    </div>

                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="saluranRB2">RB (%)</label>
                                        <input id="saluranRB2" name="saluranSekunderRB" value="<?= str_replace('.', ',', $dataDi->saluranSekunderRB);  ?>" type="text" class="form-control text-right number saluranSekunder" bobot="50" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(2);" required placeholder="RB (%)">
                                        <div class="invalid-feedback" id="pesan_saluranSekunderRB"></div>
                                    </div>

                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="saluranRerata2">Rerata (B/RR/RS/RB)</label>
                                        <input id="saluranRerata2" name="saluranSekunderRerata" value="<?= str_replace('.', ',', $dataDi->saluranSekunderRerata);  ?>" type="text" class="form-control text-right" readonly placeholder="Rerata (B/RR/RS/RB)">
                                        <div class="invalid-feedback" id="pesan_saluranSekunderRerata"></div>
                                    </div>

                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="kondisiKerusakan2">Nilai Kondisi Kerusakan (%)</label>
                                        <input id="kondisiKerusakan2" name="saluranSekunderNilai" value="<?= str_replace('.', ',', $dataDi->saluranSekunderNilai);  ?>" type="text" class="form-control text-right number rataJaringan" readonly placeholder="Nilai Kondisi Kerusakan (%)">
                                        <div class="invalid-feedback" id="pesan_saluranSekunderNilai"></div>
                                    </div>

                                </div> 

                            </div>
                        </div>
                        <div class="col-sm-12" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Saluran Tersier</h5><div class="row">

                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="saluranB3">B (%)</label>
                                    <input id="saluranB3" name="saluranTersierB" value="<?= str_replace('.', ',', $dataDi->saluranTersierB);  ?>" type="text" class="form-control text-right number saluranTersier" bobot="1" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(3);" required placeholder="B (%)">
                                    <div class="invalid-feedback" id="pesan_saluranTersierB"></div>
                                </div>

                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="saluranRR3">RR (%)</label>
                                    <input id="saluranRR3" name="saluranTersierBR" value="<?= str_replace('.', ',', $dataDi->saluranTersierBR);  ?>" type="text" class="form-control text-right number saluranTersier" bobot="20" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(3);" required placeholder="RR (%)">
                                    <div class="invalid-feedback" id="pesan_saluranTersierBR"></div>
                                </div>

                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="saluranRS3">RS (%)</label>
                                    <input id="saluranRS3" name="saluranTersierRS" value="<?= str_replace('.', ',', $dataDi->saluranTersierRS);  ?>" type="text" class="form-control text-right number saluranTersier" bobot="40" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(3);" required placeholder="RS (%)">
                                    <div class="invalid-feedback" id="pesan_saluranTersierRS"></div>
                                </div>

                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="saluranRB3">RB (%)</label>
                                    <input id="saluranRB3" name="saluranTersierRB" value="<?= str_replace('.', ',', $dataDi->saluranTersierRB);  ?>" type="text" class="form-control text-right number saluranTersier" bobot="50" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(3);" required placeholder="RB (%)">
                                    <div class="invalid-feedback" id="pesan_saluranTersierRB"></div>
                                </div>

                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="saluranRerata3">Rerata (B/RR/RS/RB)</label>
                                    <input id="saluranRerata3" name="saluranTersierRerata" value="<?= str_replace('.', ',', $dataDi->saluranTersierRerata);  ?>" type="text" class="form-control text-right" placeholder="Rerata (B/RR/RS/RB)" readonly>
                                    <div class="invalid-feedback" id="pesan_saluranTersierRerata"></div>
                                </div>

                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="kondisiKerusakan3">Nilai Kondisi Kerusakan (%)</label>
                                    <input id="kondisiKerusakan3" name="saluranTersierNilai" value="<?= str_replace('.', ',', $dataDi->saluranTersierNilai);  ?>" type="text" class="form-control text-right number rataJaringan" placeholder="Nilai Kondisi Kerusakan (%)" readonly>
                                    <div class="invalid-feedback" id="pesan_saluranTersierNilai"></div>
                                </div>

                            </div> 

                        </div>
                    </div>
                    <div class="col-sm-12" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Saluran Pembuang</h5><div class="row">

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="saluranB4">B (%)</label>
                                <input id="saluranB4" name="saluranPembuangB" value="<?= str_replace('.', ',', $dataDi->saluranPembuangB);  ?>" type="text" class="form-control text-right number saluranPembuang" bobot="50" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(4);" required placeholder="B (%)">
                                <div class="invalid-feedback" id="pesan_saluranPembuangB"></div>
                            </div>

                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="saluranRR4">RR (%)</label>
                                <input id="saluranRR4" name="saluranPembuangBR" value="<?= str_replace('.', ',', $dataDi->saluranPembuangBR);  ?>" type="text" class="form-control text-right number saluranPembuang" bobot="50" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(4);" required placeholder="RR (%)">
                                <div class="invalid-feedback" id="pesan_saluranPembuangBR"></div>
                            </div>

                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="saluranRS4">RS (%)</label>
                                <input id="saluranRS4" name="saluranPembuangRS" value="<?= str_replace('.', ',', $dataDi->saluranPembuangRS);  ?>" type="text" class="form-control text-right number saluranPembuang" bobot="50" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(4);" required placeholder="RS (%)">
                                <div class="invalid-feedback" id="pesan_saluranPembuangRS"></div>
                            </div>

                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="saluranRB4">RB (%)</label>
                                <input id="saluranRB4" name="saluranPembuangRB" value="<?= str_replace('.', ',', $dataDi->saluranPembuangRB);  ?>" type="text" class="form-control text-right number saluranPembuang" bobot="50" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungSaluran(4);" required placeholder="RB (%)">
                                <div class="invalid-feedback" id="pesan_saluranPembuangRB"></div>
                            </div>

                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="saluranRerata4">Rerata (B/RR/RS/RB)</label>
                                <input id="saluranRerata4" name="saluranPembuangRerata" value="<?= str_replace('.', ',', $dataDi->saluranPembuangRerata);  ?>" type="text" class="form-control text-right" placeholder="Rerata (B/RR/RS/RB)" readonly>
                                <div class="invalid-feedback" id="pesan_saluranPembuangRerata"></div>
                            </div>

                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="kondisiKerusakan4">Nilai Kondisi Kerusakan (%)</label>
                                <input id="kondisiKerusakan4" name="saluranPembuangNilai" value="<?= str_replace('.', ',', $dataDi->saluranPembuangNilai);  ?>" type="text" class="form-control text-right number rataJaringan" placeholder="Nilai Kondisi Kerusakan (%)" readonly>
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
             <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Bangunan Pintu Primer</h5>

                <div class="row">

                    <div class="col-sm-6"> 

                        <div class="form-group">
                            <label for="bangutarPengukur4">B/RR/RS/RB</label>
                            <input id="bangutarPengukur4" name="bPintuPrimerA" value="<?= str_replace('.', ',', $dataDi->bPintuPrimerA);  ?>" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
                            <div class="invalid-feedback" id="pesan_bppBagiA"></div>
                        </div>


                    </div> 
                    <div class="col-sm-6"> 
                        <div class="form-group">
                            <label for="bangunanPengukurValue4">Nilai Kondisi (%)</label>
                            <input id="bangunanPengukurValue4" name="bPintuPrimerB" value="<?= str_replace('.', ',', $dataDi->bPintuPrimerB);  ?>" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(4);" required placeholder="Nilai Kondisi (%)">
                            <div class="invalid-feedback" id="pesan_bppBagiB"></div>
                        </div>

                    </div> 

                </div>

            </div>
            <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Bangunan Pintu Sekunder</h5><div class="row">

                <div class="col-sm-6"> 

                    <div class="form-group">
                        <label for="bangutarPengukur5">B/RR/RS/RB</label>
                        <input id="bangutarPengukur5" value="<?= str_replace('.', ',', $dataDi->bPintuSekunderA);  ?>" type="text" name="bPintuSekunderA" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
                        <div class="invalid-feedback" id="pesan_bppBagiSadapA"></div>
                    </div>


                </div> 
                <div class="col-sm-6"> 
                    <div class="form-group">
                        <label for="bangunanPengukurValue5">Nilai Kondisi (%)</label>
                        <input id="bangunanPengukurValue5" name="bPintuSekunderB" value="<?= str_replace('.', ',', $dataDi->bPintuSekunderB);  ?>" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(5);" required placeholder="Nilai Kondisi (%)">
                        <div class="invalid-feedback" id="pesan_bppBagiSadapB"></div>
                    </div>

                </div> 

            </div>
        </div>
        <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Bangunan Pintu Tersier</h5><div class="row">

            <div class="col-sm-6"> 

                <div class="form-group">
                    <label for="bangutarPengukur6">B/RR/RS/RB</label>
                    <input id="bangutarPengukur6" name="bPintuTersierA" value="<?= str_replace('.', ',', $dataDi->bPintuTersierA);  ?>" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
                    <div class="invalid-feedback" id="pesan_bppSadapA"></div>
                </div>


            </div> 
            <div class="col-sm-6"> 
                <div class="form-group">
                    <label for="bangunanPengukurValue6">Nilai Kondisi (%)</label>
                    <input id="bangunanPengukurValue6" name="bPintuTersierB" value="<?= str_replace('.', ',', $dataDi->bPintuTersierB);  ?>" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(6);" required placeholder="Nilai Kondisi (%)">
                    <div class="invalid-feedback" id="pesan_bppSadapB"></div>
                </div>

            </div> 

        </div>
    </div>
    <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Bangunan Pintu Pembuang</h5><div class="row">

        <div class="col-sm-6"> 

            <div class="form-group">
                <label for="bangutarPengukur7">B/RR/RS/RB</label>
                <input id="bangutarPengukur7" name="bPintuPembuangA" value="<?= str_replace('.', ',', $dataDi->bPintuPembuangA);  ?>" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
                <div class="invalid-feedback" id="pesan_bppBangunanPengukurA"></div>
            </div>


        </div> 
        <div class="col-sm-6"> 
            <div class="form-group">
                <label for="bangunanPengukurValue7">Nilai Kondisi (%)</label>
                <input id="bangunanPengukurValue7" name="bPintuPembuangB" value="<?= str_replace('.', ',', $dataDi->bPintuPembuangB);  ?>" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(7);" required placeholder="Nilai Kondisi (%)">
                <div class="invalid-feedback" id="pesan_bppBangunanPengukurB"></div>
            </div>

        </div> 

    </div>
</div>
</div>


<div class="bg-info mb-2" style="padding:2px; margin:0px;">
    <div class="" style="padding:0px 0px 0px 4px; margin:0px;">Bangunan Pembawa*</div>
</div>

<div class="row">
   <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Gorong-gorong</h5><div class="row">

    <div class="col-sm-6">


        <div class="form-group">
            <label for="bangutarPengukur8">B/RR/RS/RB</label>
            <input id="bangutarPengukur8" name="bPembawaGorongA" value="<?= str_replace('.', ',', $dataDi->bPembawaGorongA);  ?>" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_bPembawaGorongA"></div>
        </div>

    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="bangunanPengukurValue8">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue8" name="bPembawaGorongB" value="<?= str_replace('.', ',', $dataDi->bPembawaGorongB);  ?>" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(8);" required placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_bPembawaGorongB"></div>
        </div>

    </div> 

</div>
</div>


<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Talang</h5><div class="row">

    <div class="col-sm-6">


        <div class="form-group">
            <label for="bangutarPengukur9">B/RR/RS/RB</label>
            <input id="bangutarPengukur9" value="<?= str_replace('.', ',', $dataDi->bPembawaTalangA);  ?>" type="text" name="bPembawaTalangA" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_bPembawaSiponA"></div>
        </div>
        
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="bangunanPengukurValue9">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue9" name="bPembawaTalangB" value="<?= str_replace('.', ',', $dataDi->bPembawaTalangB);  ?>" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(9);" required placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_bPembawaSiponB"></div>
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
                <label for="bangutarPengukur10">B/RR/RS/RB</label>
                <input id="bangutarPengukur10" value="<?= str_replace('.', ',', $dataDi->blinTanggungA);  ?>" name="blinTanggungA" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
                <div class="invalid-feedback" id="pesan_blinKantongA"></div>
            </div>
        </div> 
        <div class="col-sm-6"> 
            <div class="form-group">
                <label for="bangunanPengukurValue10">Nilai Kondisi (%)</label>
                <input id="bangunanPengukurValue10" name="blinTanggungB" value="<?= str_replace('.', ',', $dataDi->blinTanggungB);  ?>" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(10);" required placeholder="Nilai Kondisi (%)">
                <div class="invalid-feedback" id="pesan_blinKantongB"></div>
            </div>

        </div> 
    </div>
</div>




<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Perkuatan Tebing</h5><div class="row">

    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangutarPengukur11">B/RR/RS/RB</label>
            <input id="bangutarPengukur11" value="<?= str_replace('.', ',', $dataDi->blinPerkuatanTebingA);  ?>" name="blinPerkuatanTebingA" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_blinPelimpahA"></div>
        </div>        
    </div> 
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangunanPengukurValue11">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue11" name="blinPerkuatanTebingB" value="<?= str_replace('.', ',', $dataDi->blinPerkuatanTebingB);  ?>" type="text" class="form-control text-right  number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(11);" required placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_blinPelimpahB"></div>
        </div>
        
    </div> 
</div>
</div>




<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Pelimpah</h5><div class="row">
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangutarPengukur12">B/RR/RS/RB</label>
            <input id="bangutarPengukur12" value="<?= str_replace('.', ',', $dataDi->blinPelimpahA);  ?>" name="blinPelimpahA" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_blinPengurasA"></div>
        </div>
    </div> 
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangunanPengukurValue12">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue12" name="blinPelimpahB" value="<?= str_replace('.', ',', $dataDi->blinPelimpahB);  ?>" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(12);" required placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_blinPengurasB"></div>
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
                <label for="bangutarPengukur13">B/RR/RS/RB</label>
                <input id="bangutarPengukur13" value="<?= str_replace('.', ',', $dataDi->balengJalanInspeksiA);  ?>" name="balengJalanInspeksiA" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
                <div class="invalid-feedback" id="pesan_saranaAlatUkurA"></div>
            </div>            
        </div> 
        <div class="col-sm-6"> 
            <div class="form-group">
                <label for="bangunanPengukurValue13">Nilai Kondisi (%)</label>
                <input id="bangunanPengukurValue13" name="balengJalanInspeksiB" value="<?= str_replace('.', ',', $dataDi->balengJalanInspeksiB);  ?>" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(13);" placeholder="Nilai Kondisi (%)">
                <div class="invalid-feedback" id="pesan_saranaAlatUkurB"></div>
            </div>        
        </div> 
    </div>
</div>


<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Jembatan</h5><div class="row">
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangutarPengukur14">B/RR/RS/RB</label>
            <input id="bangutarPengukur14" value="<?= str_replace('.', ',', $dataDi->balengJembatanA);  ?>" name="balengJembatanA" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_saranaAlatUkurA"></div>
        </div>            
    </div> 
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangunanPengukurValue14">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue14" name="balengJembatanB" value="<?= str_replace('.', ',', $dataDi->balengJembatanB);  ?>" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(14);" placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_saranaAlatUkurB"></div>
        </div>        
    </div> 
</div>
</div>


<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Kantor Pengamat</h5><div class="row">
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangutarPengukur15">B/RR/RS/RB</label>
            <input id="bangutarPengukur15" value="<?= str_replace('.', ',', $dataDi->balengKantorPengamatA);  ?>" name="balengKantorPengamatA" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_saranaAlatUkurA"></div>
        </div>            
    </div> 
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangunanPengukurValue15">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue15" name="balengKantorPengamatB" value="<?= str_replace('.', ',', $dataDi->balengKantorPengamatB);  ?>" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(15);" placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_saranaAlatUkurB"></div>
        </div>        
    </div> 
</div>
</div>

<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Gudang</h5><div class="row">
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangutarPengukur16">B/RR/RS/RB</label>
            <input id="bangutarPengukur16" value="<?= str_replace('.', ',', $dataDi->balengGudangA);  ?>" name="balengGudangA" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_saranaAlatUkurA"></div>
        </div>            
    </div> 
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangunanPengukurValue16">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue16" name="balengGudangB" value="<?= str_replace('.', ',', $dataDi->balengGudangB);  ?>" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(16);" placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_saranaAlatUkurB"></div>
        </div>        
    </div> 
</div>
</div>

<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Rumah Jaga</h5><div class="row">
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangutarPengukur17">B/RR/RS/RB</label>
            <input id="bangutarPengukur17" value="<?= str_replace('.', ',', $dataDi->balengRumahJagaA);  ?>" name="balengRumahJagaA" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_saranaAlatUkurA"></div>
        </div>            
    </div> 
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangunanPengukurValue17">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue17" name="balengRumahJagaB" value="<?= str_replace('.', ',', $dataDi->balengRumahJagaB);  ?>" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(17);" placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_saranaAlatUkurB"></div>
        </div>        
    </div> 
</div>
</div>

<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Sanggar Tani</h5><div class="row">
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangutarPengukur18">B/RR/RS/RB</label>
            <input id="bangutarPengukur18" value="<?= str_replace('.', ',', $dataDi->balengSanggarTaniA);  ?>" name="balengSanggarTaniA" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_saranaAlatUkurA"></div>
        </div>            
    </div> 
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangunanPengukurValue18">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue18" name="balengSanggarTaniB" value="<?= str_replace('.', ',', $dataDi->balengSanggarTaniB);  ?>" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(18);" placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_saranaAlatUkurB"></div>
        </div>        
    </div> 
</div>
</div>


<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Rumah Genset/Panel Elektrikal</h5><div class="row">
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangutarPengukur19">B/RR/RS/RB</label>
            <input id="bangutarPengukur19" value="<?= str_replace('.', ',', $dataDi->balengRumahA);  ?>" name="balengRumahA" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_saranaAlatUkurA"></div>
        </div>            
    </div> 
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangunanPengukurValue19">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue19" name="balengRumahB" value="<?= str_replace('.', ',', $dataDi->balengRumahB);  ?>" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(19);" placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_saranaAlatUkurB"></div>
        </div>        
    </div> 
</div>
</div>


<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Kolam Tando</h5><div class="row">
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangutarPengukur20">B/RR/RS/RB</label>
            <input id="bangutarPengukur20" value="<?= str_replace('.', ',', $dataDi->balengKolamTandoA);  ?>" name="balengKolamTandoA" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_saranaAlatUkurA"></div>
        </div>            
    </div> 
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangunanPengukurValue20">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue20" name="balengKolamTandoB" value="<?= str_replace('.', ',', $dataDi->balengKolamTandoB);  ?>" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(20);" placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_saranaAlatUkurB"></div>
        </div>        
    </div> 
</div>
</div>



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Kolam Pengendap</h5><div class="row">
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangutarPengukur21">B/RR/RS/RB</label>
            <input id="bangutarPengukur21" value="<?= str_replace('.', ',', $dataDi->balengKolamPengendapA);  ?>" name="balengKolamPengendapA" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_saranaAlatUkurA"></div>
        </div>            
    </div> 
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangunanPengukurValue21">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue21" name="balengKolamPengendapB" value="<?= str_replace('.', ',', $dataDi->balengKolamPengendapB);  ?>" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(21);" placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_saranaAlatUkurB"></div>
        </div>        
    </div> 
</div>
</div>


<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Kolam Pencampur</h5><div class="row">
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangutarPengukur22">B/RR/RS/RB</label>
            <input id="bangutarPengukur22" value="<?= str_replace('.', ',', $dataDi->balengKolamPencampurA);  ?>" name="balengKolamPencampurA" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_saranaAlatUkurA"></div>
        </div>            
    </div> 
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangunanPengukurValue22">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue22" name="balengKolamPencampurB" value="<?= str_replace('.', ',', $dataDi->balengKolamPencampurB);  ?>" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(22);" placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_saranaAlatUkurB"></div>
        </div>        
    </div> 
</div>
</div>


<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Jetti</h5><div class="row">
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangutarPengukur23">B/RR/RS/RB</label>
            <input id="bangutarPengukur23" value="<?= str_replace('.', ',', $dataDi->balengJettiA);  ?>" name="balengJettiA" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_saranaAlatUkurA"></div>
        </div>            
    </div> 
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangunanPengukurValue23">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue23" name="balengJettiB" value="<?= str_replace('.', ',', $dataDi->balengJettiB);  ?>" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(23);" placeholder="Nilai Kondisi (%)">
            <div class="invalid-feedback" id="pesan_saranaAlatUkurB"></div>
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
                <label for="bangutarPengukur24">B/RR/RS/RB</label>
                <input id="bangutarPengukur24" value="<?= str_replace('.', ',', $dataDi->saranaPintuAirA);  ?>" name="saranaPintuAirA" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
                <div class="invalid-feedback" id="pesan_saranaAlatUkurA"></div>
            </div>            
        </div> 
        <div class="col-sm-6"> 
            <div class="form-group">
                <label for="bangunanPengukurValue24">Nilai Kondisi (%)</label>
                <input id="bangunanPengukurValue24" name="saranaPintuAirB" value="<?= str_replace('.', ',', $dataDi->saranaPintuAirB);  ?>" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(24);" placeholder="Nilai Kondisi (%)">
                <div class="invalid-feedback" id="pesan_saranaAlatUkurB"></div>
            </div>        
        </div> 
    </div>
</div>


<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Alat Ukur</h5><div class="row">
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangutarPengukur24">B/RR/RS/RB</label>
            <input id="bangutarPengukur24" value="<?= str_replace('.', ',', $dataDi->saranaAlatUkurA);  ?>" name="saranaAlatUkurA" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_saranaAlatUkurA"></div>
        </div>            
    </div> 
    <div class="col-sm-6"> 
        <div class="form-group">
            <label for="bangunanPengukurValue24">Nilai Kondisi (%)</label>
            <input id="bangunanPengukurValue24" name="saranaAlatUkurB" value="<?= str_replace('.', ',', $dataDi->saranaAlatUkurB);  ?>" type="text" class="form-control text-right number rataJaringan" oninput="this.value = this.value.replace(/[^0-9,]/g, ''); hitungBangunanPengukur(24);" placeholder="Nilai Kondisi (%)">
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
            <input id="rataJaringanA" name="rataJaringanA" value="<?= str_replace('.', ',', $dataDi->rataJaringanA);  ?>" type="text" class="form-control kududisabled" placeholder="B/RR/RS/RB" readonly>
            <div class="invalid-feedback" id="pesan_rataJaringanA"></div>
        </div>
        

        
    </div> 
    <div class="col-sm-6">
        <div class="form-group">
            <label for="rataJaringanB">Nilai Kondisi (%)</label>
            <input id="rataJaringanB" name="rataJaringanB" value="<?= str_replace('.', ',', $dataDi->rataJaringanB);  ?>" type="text" class="form-control kududisabled" placeholder="Nilai Kondisi (%)" readonly>
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
        <textarea id="in_keterangan" name="keterangan" class="form-control" rows="3" placeholder="Keterangan"><?= str_replace('.', ',', $dataDi->keterangan);  ?></textarea>
        <div class="invalid-feedback" id="pesan_keterangan"></div>
    </div>
</div>

</div>


<div class="modal-footer justify-content-between">
    <div class="row">
      <a href="<?= base_url(); ?>IndexKinerja4D" class="btn btn-default btn-sm" title="Kembali"><i class="fa fa-undo"></i> Kembali</a>
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

        let arrayName = [
            'buPengambilanAirTawarB',
            'buPengambilanAirAsinB',
            'buStasiunPompaB',
            'saluranPrimerNilai',
            'saluranSekunderNilai',
            'saluranTersierNilai',
            'saluranPembuangNilai',
            'bPintuPrimerB',
            'bPintuSekunderB',
            'bPintuTersierB',
            'bPintuPembuangB',
            'bPembawaGorongB',
            'bPembawaTalangB',
            'blinTanggungB',
            'blinPerkuatanTebingB',
            'blinPelimpahB',
            'balengJalanInspeksiB',
            'balengJembatanB',
            'balengKantorPengamatB',
            'balengGudangB',
            'balengRumahJagaB',
            'balengSanggarTaniB',
            'balengRumahB',
            'balengKolamTandoB',
            'balengKolamPengendapB',
            'balengKolamPencampurB',
            'balengJettiB',
            'saranaPintuAirB',
            'saranaAlatUkurB'
            ];

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
        url: base_url() + "IndexKinerja4D/getDiTambahData",
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