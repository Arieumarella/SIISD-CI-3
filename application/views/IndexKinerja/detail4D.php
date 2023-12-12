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
    <div class="">
        <div class="row">
          <div class="col-lg-12">
              <div class="content-header bg-warning">
                  <div class="container-fluid">
                    <div class="row m-0 p-0 text-left">
                      <div class="col-sm-7">
                        <h4 class="m-0" id="titleBox">Form 4D : DATA KONDISI D.I.T</h4>
                    </div>

                    <div class="col-5 text-right">
                        <a href="<?= base_url(); ?>IndexKinerja4D" class="btn btn-default btn-sm" aksi="table" title="Kembali"><i class="fas fa-home"></i> Kembali</a>

                        <?php if ($this->session->userdata('prive') == 'pemda' or $this->session->userdata('prive') == 'admin' or $this->session->userdata('prive') == 'provinsi') { ?>

                        <a href="<?= base_url(); ?>IndexKinerja4D/editData/<?= $dataDi->id; ?>" class="btn btn-primary btn-sm" aksi="ubah" title="Ubah data"><i class="far fa-edit"></i> Ubah</a>

                        <?php } ?>

                        <button onclick="cetakPdf();" class="btn btn-info btn-sm"><i class="fas fa-print"></i> Cetak</button>

                        <?php if ($this->session->userdata('prive') == 'pemda' or $this->session->userdata('prive') == 'admin' or $this->session->userdata('prive') == 'provinsi') { ?>
                        <button onclick="deleteData('<?= $dataDi->id; ?>')" class="btn btn-danger btn-sm" aksi="delete" title="Hapus data"><i class="far fa-trash-alt"></i> Hapus</button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

              <!-- box data teknis -->
              <div class="row">
                <div class="card-body p-0 ">

                  <div class="modal-body html-content" id="DivIdToPrint">
                    <!-- -------------- -->
                    <div id="kopPage" class="user-block mb-4 p-2" style="border-bottom: 1px solid rgb(51, 51, 51); display: none;">
                        <img class="img-bordered-sm mr-2" style="width:50px; height:50px;" src="/images/pu-icon.png" alt="user image">
                        <span class="username" style="font-size:21px;">DIREKTORAT JENDERAL SUMBER DAYA AIR</span>
                        <span class="username">Kementerian Pekerjaan Umum dan Perumahan Rakyat</span>
                        <!-- <span class="description">Shared publicly - 7:30 PM today</span> -->
                    </div>
                    <!-- ---------------- -->



                    <div class="row">            <div class="col-sm-6"> 
                        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                            <div class="row p-0 m-0">
                                <label id="label_irigasiid" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_irigasiid" style="background-color:#e6e6e6;">Nomeklatur/ Nama D.I.</label>
                                <div class="col-sm-6 pr-2 m-0 row">
                                    <div class="" id="isi_irigasiid"><?= $dataDi->nama; ?></div>
                                </div>
                            </div>
                        </div>
                    </div> 




                    <div class="col-sm-6"> 
                        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                            <div class="row p-0 m-0">
                                <label id="label_laPermen" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laPermen" style="background-color:#e6e6e6;">Luas D.I. Sesuai Permen 14/2015 (Ha)</label>
                                <div class="col-sm-6 pr-2 m-0 row">
                                    <div class="" id="isi_laPermen"><?= str_replace('.', ',', $dataDi->laPermen); ?></div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>



                <div class="col-sm-6"> 
                    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                        <div class="row p-0 m-0">
                            <label id="label_sawahFungsional" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_sawahFungsional" style="background-color:#e6e6e6;">Sawah/Fungsional (Pemetaan IGT) (Ha)</label>
                            <div class="col-sm-6 pr-2 m-0 row">
                                <div class="" id="isi_sawahFungsional"><?= str_replace('.', ',', $dataDi->sawahFungsional); ?></div>
                            </div>
                        </div>
                    </div>
                </div> 



                <div class="mb-2 p-1" style="background-color:#ccc; border:0px;">
                    <div class="p-0 m-0" style="border:0px;">
                        <h5 class="card-title">Bangunan Utama*</h5>
                    </div>
                </div>

                <div class="row">     <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Pengambilan Air Tawar</h5><div class="row">        <div class="col-sm-6"> 
                    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                        <div class="row p-0 m-0">
                            <label id="label_buPengambilanAirTawarA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_buPengambilanAirTawarA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
                            <div class="col-sm-6 pr-2 m-0 row">
                                <div class="" id="isi_buPengambilanAirTawarA"><?= str_replace('.', ',', $dataDi->buPengambilanAirTawarA); ?></div>
                            </div>
                        </div>
                    </div>
                </div> 




                <div class="col-sm-6"> 
                    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                        <div class="row p-0 m-0">
                            <label id="label_buPengambilanAirTawarB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_buPengambilanAirTawarB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
                            <div class="col-sm-6 pr-2 m-0 row">
                                <div class="" id="isi_buPengambilanAirTawarB"><?= str_replace('.', ',', $dataDi->buPengambilanAirTawarB); ?></div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div></div>    



            <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Pengambilan Air Asin</h5><div class="row">        <div class="col-sm-6"> 
                <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                    <div class="row p-0 m-0">
                        <label id="label_buPengambilanAirAsinA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_buPengambilanAirAsinA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
                        <div class="col-sm-6 pr-2 m-0 row">
                            <div class="" id="isi_buPengambilanAirAsinA"><?= str_replace('.', ',', $dataDi->buPengambilanAirAsinA); ?></div>
                        </div>
                    </div>
                </div>
            </div> 
            



            <div class="col-sm-6"> 
                <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                    <div class="row p-0 m-0">
                        <label id="label_buPengambilanAirAsinB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_buPengambilanAirAsinB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
                        <div class="col-sm-6 pr-2 m-0 row">
                            <div class="" id="isi_buPengambilanAirAsinB"><?= str_replace('.', ',', $dataDi->buPengambilanAirAsinB); ?></div>
                        </div>
                    </div>
                </div>
            </div> 
        </div></div>    
        


        <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Stasiun Pompa</h5><div class="row">        <div class="col-sm-6"> 
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_buStasiunPompaA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_buStasiunPompaA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_buStasiunPompaA"><?= str_replace('.', ',', $dataDi->buStasiunPompaA); ?></div>
                    </div>
                </div>
            </div>
        </div> 

        


        <div class="col-sm-6"> 
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_buStasiunPompaB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_buStasiunPompaB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_buStasiunPompaB"><?= str_replace('.', ',', $dataDi->buStasiunPompaB); ?></div>
                    </div>
                </div>
            </div>
        </div> 
    </div></div>    </div>

    
    <div class="mb-2 p-1" style="background-color:#ccc; border:0px;">
        <div class="p-0 m-0" style="border:0px;">
            <h5 class="card-title">Saluran*</h5>
        </div>
    </div>
    
    <div class="row">     <div class="col-sm-12" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Saluran Primer</h5><div class="row">        <div class="col-sm-6"> 
        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
            <div class="row p-0 m-0">
                <label id="label_saluranPrimerB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saluranPrimerB" style="background-color:#e6e6e6;">B (%)</label>
                <div class="col-sm-6 pr-2 m-0 row">
                    <div class="" id="isi_saluranPrimerB"><?= str_replace('.', ',', $dataDi->saluranPrimerB); ?></div>
                </div>
            </div>
        </div>
    </div> 


    
    
    <div class="col-sm-6"> 
        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
            <div class="row p-0 m-0">
                <label id="label_saluranPrimerBR" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saluranPrimerBR" style="background-color:#e6e6e6;">RR (%)</label>
                <div class="col-sm-6 pr-2 m-0 row">
                    <div class="" id="isi_saluranPrimerBR"><?= str_replace('.', ',', $dataDi->saluranPrimerBR); ?></div>
                </div>
            </div>
        </div>
    </div> 


    
    
    <div class="col-sm-6"> 
        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
            <div class="row p-0 m-0">
                <label id="label_saluranPrimerRS" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saluranPrimerRS" style="background-color:#e6e6e6;">RS (%)</label>
                <div class="col-sm-6 pr-2 m-0 row">
                    <div class="" id="isi_saluranPrimerRS"><?= str_replace('.', ',', $dataDi->saluranPrimerRS); ?></div>
                </div>
            </div>
        </div>
    </div> 


    
    
    <div class="col-sm-6"> 
        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
            <div class="row p-0 m-0">
                <label id="label_saluranPrimerRB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saluranPrimerRB" style="background-color:#e6e6e6;">RB (%)</label>
                <div class="col-sm-6 pr-2 m-0 row">
                    <div class="" id="isi_saluranPrimerRB"><?= str_replace('.', ',', $dataDi->saluranPrimerRB); ?></div>
                </div>
            </div>
        </div>
    </div> 


    
    
    <div class="col-sm-6"> 
        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
            <div class="row p-0 m-0">
                <label id="label_saluranPrimerRerata" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saluranPrimerRerata" style="background-color:#e6e6e6;">Rerata (B/RR/RS/RB)</label>
                <div class="col-sm-6 pr-2 m-0 row">
                    <div class="" id="isi_saluranPrimerRerata"><?= str_replace('.', ',', $dataDi->saluranPrimerRerata); ?></div>
                </div>
            </div>
        </div>
    </div> 


    
    
    <div class="col-sm-6"> 
        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
            <div class="row p-0 m-0">
                <label id="label_saluranPrimerNilai" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saluranPrimerNilai" style="background-color:#e6e6e6;">Nilai Kondisi Kerusakan (%)</label>
                <div class="col-sm-6 pr-2 m-0 row">
                    <div class="" id="isi_saluranPrimerNilai"><?= str_replace('.', ',', $dataDi->saluranPrimerNilai); ?></div>
                </div>
            </div>
        </div>
    </div> 
</div></div>    



<div class="col-sm-12" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Saluran Sekunder</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_saluranSekunderB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saluranSekunderB" style="background-color:#e6e6e6;">B (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_saluranSekunderB"><?= str_replace('.', ',', $dataDi->saluranSekunderB); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_saluranSekunderBR" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saluranSekunderBR" style="background-color:#e6e6e6;">RR (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_saluranSekunderBR"><?= str_replace('.', ',', $dataDi->saluranSekunderBR); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_saluranSekunderRS" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saluranSekunderRS" style="background-color:#e6e6e6;">RS (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_saluranSekunderRS"><?= str_replace('.', ',', $dataDi->saluranSekunderRS); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_saluranSekunderRB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saluranSekunderRB" style="background-color:#e6e6e6;">RB (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_saluranSekunderRB"><?= str_replace('.', ',', $dataDi->saluranSekunderRB); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_saluranSekunderRerata" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saluranSekunderRerata" style="background-color:#e6e6e6;">Rerata (B/RR/RS/RB)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_saluranSekunderRerata"><?= str_replace('.', ',', $dataDi->saluranSekunderRerata); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_saluranSekunderNilai" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saluranSekunderNilai" style="background-color:#e6e6e6;">Nilai Kondisi Kerusakan (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_saluranSekunderNilai"><?= str_replace('.', ',', $dataDi->saluranSekunderNilai); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    



<div class="col-sm-12" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Saluran Tersier</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_saluranTersierB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saluranTersierB" style="background-color:#e6e6e6;">B (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_saluranTersierB"><?= str_replace('.', ',', $dataDi->saluranTersierB); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_saluranTersierBR" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saluranTersierBR" style="background-color:#e6e6e6;">RR (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_saluranTersierBR"><?= str_replace('.', ',', $dataDi->saluranTersierBR); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_saluranTersierRS" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saluranTersierRS" style="background-color:#e6e6e6;">RS (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_saluranTersierRS"><?= str_replace('.', ',', $dataDi->saluranTersierRS); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_saluranTersierRB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saluranTersierRB" style="background-color:#e6e6e6;">RB (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_saluranTersierRB"><?= str_replace('.', ',', $dataDi->saluranTersierRB); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_saluranTersierRerata" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saluranTersierRerata" style="background-color:#e6e6e6;">Rerata (B/RR/RS/RB)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_saluranTersierRerata"><?= str_replace('.', ',', $dataDi->saluranTersierRerata); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_saluranTersierNilai" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saluranTersierNilai" style="background-color:#e6e6e6;">Nilai Kondisi Kerusakan (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_saluranTersierNilai"><?= str_replace('.', ',', $dataDi->saluranTersierNilai); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    



<div class="col-sm-12" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Saluran Pembuang</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_saluranPembuangB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saluranPembuangB" style="background-color:#e6e6e6;">B (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_saluranPembuangB"><?= str_replace('.', ',', $dataDi->saluranPembuangB); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_saluranPembuangBR" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saluranPembuangBR" style="background-color:#e6e6e6;">RR (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_saluranPembuangBR"><?= str_replace('.', ',', $dataDi->saluranPembuangBR); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_saluranPembuangRS" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saluranPembuangRS" style="background-color:#e6e6e6;">RS (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_saluranPembuangRS"><?= str_replace('.', ',', $dataDi->saluranPembuangRS); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_saluranPembuangRB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saluranPembuangRB" style="background-color:#e6e6e6;">RB (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_saluranPembuangRB"><?= str_replace('.', ',', $dataDi->saluranPembuangRB); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_saluranPembuangRerata" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saluranPembuangRerata" style="background-color:#e6e6e6;">Rerata (B/RR/RS/RB)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_saluranPembuangRerata"><?= str_replace('.', ',', $dataDi->saluranPembuangRerata); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_saluranPembuangNilai" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saluranPembuangNilai" style="background-color:#e6e6e6;">Nilai Kondisi Kerusakan (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_saluranPembuangNilai"><?= str_replace('.', ',', $dataDi->saluranPembuangNilai); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    </div>


<div class="mb-2 p-1" style="background-color:#ccc; border:0px;">
    <div class="p-0 m-0" style="border:0px;">
        <h5 class="card-title">Bangunan Pengatur*</h5>
    </div>
</div>

<div class="row">     <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Bangunan Pintu Primer</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_bPintuPrimerA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bPintuPrimerA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_bPintuPrimerA"><?= str_replace('.', ',', $dataDi->bPintuPrimerA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_bPintuPrimerB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bPintuPrimerB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_bPintuPrimerB"><?= str_replace('.', ',', $dataDi->bPintuPrimerB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Bangunan Pintu Sekunder </h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_bPintuSekunderA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bPintuSekunderA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_bPintuSekunderA"><?= str_replace('.', ',', $dataDi->bPintuSekunderA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_bPintuSekunderB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bPintuSekunderB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_bPintuSekunderB"><?= str_replace('.', ',', $dataDi->bPintuSekunderB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Bangunan Pintu Tersier</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_bPintuTersierA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bPintuTersierA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_bPintuTersierA"><?= str_replace('.', ',', $dataDi->bPintuTersierA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_bPintuTersierB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bPintuTersierB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_bPintuTersierB"><?= str_replace('.', ',', $dataDi->bPintuTersierB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Bangunan Pintu Pembuang</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_bPintuPembuangA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bPintuPembuangA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_bPintuPembuangA"><?= str_replace('.', ',', $dataDi->bPintuPembuangA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_bPintuPembuangB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bPintuPembuangB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_bPintuPembuangB"><?= str_replace('.', ',', $dataDi->bPintuPembuangB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    </div>


<div class="mb-2 p-1" style="background-color:#ccc; border:0px;">
    <div class="p-0 m-0" style="border:0px;">
        <h5 class="card-title">Bangunan Pembawa*</h5>
    </div>
</div>

<div class="row">     <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Gorong-gorong</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_bPembawaGorongA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bPembawaGorongA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_bPembawaGorongA"><?= str_replace('.', ',', $dataDi->bPembawaGorongA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_bPembawaGorongB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bPembawaGorongB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_bPembawaGorongB"><?= str_replace('.', ',', $dataDi->bPembawaGorongB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Talang</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_bPembawaTalangA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bPembawaTalangA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_bPembawaTalangA"><?= str_replace('.', ',', $dataDi->bPembawaTalangA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_bPembawaTalangB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bPembawaTalangB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_bPembawaTalangB"><?= str_replace('.', ',', $dataDi->bPembawaTalangB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    </div>


<div class="mb-2 p-1" style="background-color:#ccc; border:0px;">
    <div class="p-0 m-0" style="border:0px;">
        <h5 class="card-title">Bangunan Lindung*</h5>
    </div>
</div>

<div class="row">     <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Tanggul</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_blinTanggungA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_blinTanggungA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_blinTanggungA"><?= str_replace('.', ',', $dataDi->blinTanggungA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_blinTanggungB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_blinTanggungB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_blinTanggungB"><?= str_replace('.', ',', $dataDi->blinTanggungB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Perkuatan Tebing</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_blinPerkuatanTebingA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_blinPerkuatanTebingA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_blinPerkuatanTebingA"><?= str_replace('.', ',', $dataDi->blinPerkuatanTebingA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_blinPerkuatanTebingB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_blinPerkuatanTebingB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_blinPerkuatanTebingB"><?= str_replace('.', ',', $dataDi->blinPerkuatanTebingB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Pelimpah</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_blinPelimpahA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_blinPelimpahA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_blinPelimpahA"><?= str_replace('.', ',', $dataDi->blinPelimpahA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_blinPelimpahB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_blinPelimpahB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_blinPelimpahB"><?= str_replace('.', ',', $dataDi->blinPelimpahB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    </div>


<div class="mb-2 p-1" style="background-color:#ccc; border:0px;">
    <div class="p-0 m-0" style="border:0px;">
        <h5 class="card-title">Bangunan Pelengkap*</h5>
    </div>
</div>

<div class="row">     <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Jalan Inspeksi</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_balengJalanInspeksiA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_balengJalanInspeksiA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_balengJalanInspeksiA"><?= str_replace('.', ',', $dataDi->balengJalanInspeksiA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_balengJalanInspeksiB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_balengJalanInspeksiB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_balengJalanInspeksiB"><?= str_replace('.', ',', $dataDi->balengJalanInspeksiB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Jembatan</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_balengJembatanA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_balengJembatanA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_balengJembatanA"><?= str_replace('.', ',', $dataDi->balengJembatanA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_balengJembatanB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_balengJembatanB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_balengJembatanB"><?= str_replace('.', ',', $dataDi->balengJembatanB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Kantor Pengamat</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_balengKantorPengamatA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_balengKantorPengamatA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_balengKantorPengamatA"><?= str_replace('.', ',', $dataDi->balengKantorPengamatA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_balengKantorPengamatB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_balengKantorPengamatB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_balengKantorPengamatB"><?= str_replace('.', ',', $dataDi->balengKantorPengamatB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Gudang</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_balengGudangA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_balengGudangA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_balengGudangA"><?= str_replace('.', ',', $dataDi->balengGudangA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_balengGudangB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_balengGudangB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_balengGudangB"><?= str_replace('.', ',', $dataDi->balengGudangB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Rumah Jaga</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_balengRumahJagaA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_balengRumahJagaA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_balengRumahJagaA"><?= str_replace('.', ',', $dataDi->balengRumahJagaA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_balengRumahJagaB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_balengRumahJagaB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_balengRumahJagaB"><?= str_replace('.', ',', $dataDi->balengRumahJagaB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Sanggar Tani</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_balengSanggarTaniA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_balengSanggarTaniA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_balengSanggarTaniA"><?= str_replace('.', ',', $dataDi->balengSanggarTaniA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_balengSanggarTaniB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_balengSanggarTaniB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_balengSanggarTaniB"><?= str_replace('.', ',', $dataDi->balengSanggarTaniB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Rumah Genset/Panel Elektrikal</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_balengRumahA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_balengRumahA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_balengRumahA"><?= str_replace('.', ',', $dataDi->balengRumahA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_balengRumahB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_balengRumahB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_balengRumahB"><?= str_replace('.', ',', $dataDi->balengRumahB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Kolam Tando</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_balengKolamTandoA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_balengKolamTandoA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_balengKolamTandoA"><?= str_replace('.', ',', $dataDi->balengKolamTandoA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_balengKolamTandoB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_balengKolamTandoB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_balengKolamTandoB"><?= str_replace('.', ',', $dataDi->balengKolamTandoB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Kolam Pengendap</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_balengKolamPengendapA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_balengKolamPengendapA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_balengKolamPengendapA"><?= str_replace('.', ',', $dataDi->balengKolamPengendapA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_balengKolamPengendapB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_balengKolamPengendapB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_balengKolamPengendapB"><?= str_replace('.', ',', $dataDi->balengKolamPengendapB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Kolam Pencampur</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_balengKolamPencampurA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_balengKolamPencampurA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_balengKolamPencampurA"><?= str_replace('.', ',', $dataDi->balengKolamPencampurA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_balengKolamPencampurB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_balengKolamPencampurB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_balengKolamPencampurB"><?= str_replace('.', ',', $dataDi->balengKolamPencampurB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Jetti</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_balengJettiA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_balengJettiA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_balengJettiA"><?= str_replace('.', ',', $dataDi->balengJettiA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_balengJettiB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_balengJettiB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_balengJettiB"><?= str_replace('.', ',', $dataDi->balengJettiB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    </div>


<div class="mb-2 p-1" style="background-color:#ccc; border:0px;">
    <div class="p-0 m-0" style="border:0px;">
        <h5 class="card-title">Sarana*</h5>
    </div>
</div>

<div class="row">     <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Pintu Air</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_saranaPintuAirA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saranaPintuAirA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_saranaPintuAirA"><?= str_replace('.', ',', $dataDi->saranaPintuAirA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_saranaPintuAirB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saranaPintuAirB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_saranaPintuAirB"><?= str_replace('.', ',', $dataDi->saranaPintuAirB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Alat Ukur</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_saranaAlatUkurA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saranaAlatUkurA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_saranaAlatUkurA"><?= str_replace('.', ',', $dataDi->saranaAlatUkurA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_saranaAlatUkurB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saranaAlatUkurB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_saranaAlatUkurB"><?= str_replace('.', ',', $dataDi->saranaAlatUkurB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    </div>


<div class="mb-2 p-1" style="background-color:#ccc; border:0px;">
    <div class="p-0 m-0" style="border:0px;">
        <h5 class="card-title">Rata-Rata Jaringan</h5>
    </div>
</div>

<div class="row">     <div class="col-sm-4" style="border:thin solid #e6e6e6;"><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_rataJaringanA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_rataJaringanA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_rataJaringanA"><?= str_replace('.', ',', $dataDi->rataJaringanA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_rataJaringanB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_rataJaringanB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_rataJaringanB"><?= str_replace('.', ',', $dataDi->rataJaringanB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    </div>


<div class="mb-2 p-1" style="background-color:#ccc; border:0px;">
    <div class="p-0 m-0" style="border:0px;">
        <h5 class="card-title">Keterangan</h5>
    </div>
</div>

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_keterangan" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_keterangan" style="background-color:#e6e6e6;">Keterangan</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_keterangan"><?= $dataDi->keterangan; ?></div>
            </div>
        </div>
    </div>
</div> 

</div>

</div>
</div>

</div>
</section>

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

    deleteData = function (id) {

        Swal.fire({
          title: "Apakah Anda Yakin ?",
          text: "Data yang dihapus tidak akan bisa dikembalikan!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, Hapus!"
      }).then((result) => {
        if (result.value) {

            $.ajax({
                url: base_url()+'IndexKinerja4D/delete',
                type: "post",
                dataType: 'json',
                data: {id},
                success: function (res) {
                  if (res.code != 200 ){
                    alert('Error')
                    return;
                }
                window.location = base_url()+'IndexKinerja4D';

            }
        });
        }


    });

  }

});
</script>
</body>