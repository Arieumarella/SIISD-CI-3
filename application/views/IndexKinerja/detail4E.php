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
                        <h4 class="m-0" id="titleBox">Form 4E : DATA KONDISI D.I.P</h4>
                    </div>

                    <div class="col-5 text-right">
                        <a href="<?= base_url(); ?>IndexKinerja4E" class="btn btn-default btn-sm" aksi="table" title="Kembali"><i class="fas fa-home"></i> Kembali</a>

                        <?php if ($this->session->userdata('prive') == 'pemda' or $this->session->userdata('prive') == 'admin' or $this->session->userdata('prive') == 'provinsi') { ?>

                        <a href="<?= base_url(); ?>IndexKinerja4E/editData/<?= $dataDi->id; ?>" class="btn btn-primary btn-sm" aksi="ubah" title="Ubah data"><i class="far fa-edit"></i> Ubah</a>

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
                                    <div class="" id="isi_irigasiid">D.I.P KEBONAGUNG</div>
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

                <div class="row">     <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Pompa</h5><div class="row">        <div class="col-sm-6"> 
                    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                        <div class="row p-0 m-0">
                            <label id="label_buPompaA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_buPompaA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
                            <div class="col-sm-6 pr-2 m-0 row">
                                <div class="" id="isi_buPompaA"><?= str_replace('.', ',', $dataDi->buPompaA); ?></div>
                            </div>
                        </div>
                    </div>
                </div> 




                <div class="col-sm-6"> 
                    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                        <div class="row p-0 m-0">
                            <label id="label_buPompaB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_buPompaB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
                            <div class="col-sm-6 pr-2 m-0 row">
                                <div class="" id="isi_buPompaB"><?= str_replace('.', ',', $dataDi->buPompaB); ?></div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div></div>    



            <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Rumah Pompa</h5><div class="row">        <div class="col-sm-6"> 
                <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                    <div class="row p-0 m-0">
                        <label id="label_buRumahPompaA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_buRumahPompaA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
                        <div class="col-sm-6 pr-2 m-0 row">
                            <div class="" id="isi_buRumahPompaA"><?= str_replace('.', ',', $dataDi->buRumahPompaA); ?></div>
                        </div>
                    </div>
                </div>
            </div> 
            



            <div class="col-sm-6"> 
                <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                    <div class="row p-0 m-0">
                        <label id="label_buRumahPompaB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_buRumahPompaB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
                        <div class="col-sm-6 pr-2 m-0 row">
                            <div class="" id="isi_buRumahPompaB"><?= str_replace('.', ',', $dataDi->buRumahPompaB); ?></div>
                        </div>
                    </div>
                </div>
            </div> 
        </div></div>    
        


        <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Jembatan Pengambilan</h5><div class="row">        <div class="col-sm-6"> 
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_buJembatanPengambilanA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_buJembatanPengambilanA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_buJembatanPengambilanA"><?= str_replace('.', ',', $dataDi->buJembatanPengambilanA); ?></div>
                    </div>
                </div>
            </div>
        </div> 

        


        <div class="col-sm-6"> 
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_buJembatanPengambilanB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_buJembatanPengambilanB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_buJembatanPengambilanB"><?= str_replace('.', ',', $dataDi->buJembatanPengambilanB); ?></div>
                    </div>
                </div>
            </div>
        </div> 
    </div></div>    

    
    
    <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Rumah Genset &amp; Panel Elektrikal</h5><div class="row">        <div class="col-sm-6"> 
        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
            <div class="row p-0 m-0">
                <label id="label_buRumahA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_buRumahA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
                <div class="col-sm-6 pr-2 m-0 row">
                    <div class="" id="isi_buRumahA"><?= str_replace('.', ',', $dataDi->buRumahA); ?></div>
                </div>
            </div>
        </div>
    </div> 


    
    
    <div class="col-sm-6"> 
        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
            <div class="row p-0 m-0">
                <label id="label_buRumahB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_buRumahB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
                <div class="col-sm-6 pr-2 m-0 row">
                    <div class="" id="isi_buRumahB"><?= str_replace('.', ',', $dataDi->buRumahB); ?></div>
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
        <h5 class="card-title">Bangunan Pengatur dan Pengukur*</h5>
    </div>
</div>

<div class="row">     <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Bagi**</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_bppBagiA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bppBagiA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_bppBagiA"><?= str_replace('.', ',', $dataDi->bppBagiA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_bppBagiB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bppBagiB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_bppBagiB"><?= str_replace('.', ',', $dataDi->bppBagiB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Bagi Sadap**</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_bppBagiSadapA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bppBagiSadapA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_bppBagiSadapA"><?= str_replace('.', ',', $dataDi->bppBagiSadapA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_bppBagiSadapB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bppBagiSadapB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_bppBagiSadapB"><?= str_replace('.', ',', $dataDi->bppBagiSadapB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Sadap**</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_bppSadapA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bppSadapA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_bppSadapA"><?= str_replace('.', ',', $dataDi->bppSadapA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_bppSadapB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bppSadapB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_bppSadapB"><?= str_replace('.', ',', $dataDi->bppSadapB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Bangun Pengukur</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_bppBangunanPengukurA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bppBangunanPengukurA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_bppBangunanPengukurA"><?= str_replace('.', ',', $dataDi->bppBangunanPengukurA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_bppBangunanPengukurB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bppBangunanPengukurB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_bppBangunanPengukurB"><?= str_replace('.', ',', $dataDi->bppBangunanPengukurB); ?></div>
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

<div class="row">     <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Gorong-Gorong</h5><div class="row">        <div class="col-sm-6"> 
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



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Sipon</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_bPembawaSiponA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bPembawaSiponA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_bPembawaSiponA"><?= str_replace('.', ',', $dataDi->bPembawaSiponA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_bPembawaSiponB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bPembawaSiponB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_bPembawaSiponB"><?= str_replace('.', ',', $dataDi->bPembawaSiponB); ?></div>
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
</div></div>    



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Terjunan</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_bPembawaTerjunanA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bPembawaTerjunanA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_bPembawaTerjunanA"><?= str_replace('.', ',', $dataDi->bPembawaTerjunanA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_bPembawaTerjunanB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bPembawaTerjunanB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_bPembawaTerjunanB"><?= str_replace('.', ',', $dataDi->bPembawaTerjunanB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Got Miring</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_bPembawaGotMiringA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bPembawaGotMiringA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_bPembawaGotMiringA"><?= str_replace('.', ',', $dataDi->bPembawaGotMiringA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_bPembawaGotMiringB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bPembawaGotMiringB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_bPembawaGotMiringB"><?= str_replace('.', ',', $dataDi->bPembawaGotMiringB); ?></div>
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

<div class="row">     <div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Krib</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_blinKribA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_blinKribA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_blinKribA"><?= str_replace('.', ',', $dataDi->blinKribA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_blinKribB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_blinKribB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_blinKribB"><?= str_replace('.', ',', $dataDi->blinKribB); ?></div>
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
</div></div>    



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Saluran Gendong</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_blinSaluranGendongA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_blinSaluranGendongA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_blinSaluranGendongA"><?= str_replace('.', ',', $dataDi->blinSaluranGendongA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_blinSaluranGendongB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_blinSaluranGendongB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_blinSaluranGendongB"><?= str_replace('.', ',', $dataDi->blinSaluranGendongB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Pelepas Tekan</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_blinPelepasTekanA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_blinPelepasTekanA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_blinPelepasTekanA"><?= str_replace('.', ',', $dataDi->blinPelepasTekanA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_blinPelepasTekanB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_blinPelepasTekanB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_blinPelepasTekanB"><?= str_replace('.', ',', $dataDi->blinPelepasTekanB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Bak Kontrol</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_blinBakKontrolA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_blinBakKontrolA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_blinBakKontrolA"><?= str_replace('.', ',', $dataDi->blinBakKontrolA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_blinBakKontrolB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_blinBakKontrolB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_blinBakKontrolB"><?= str_replace('.', ',', $dataDi->blinBakKontrolB); ?></div>
            </div>
        </div>
    </div>
</div> 
</div></div>    



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Tanggul</h5><div class="row">        <div class="col-sm-6"> 
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



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Tampungan Air/Reservoir  </h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_balengTampunganA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_balengTampunganA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_balengTampunganA"><?= str_replace('.', ',', $dataDi->balengTampunganA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_balengTampunganB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_balengTampunganB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_balengTampunganB"><?= str_replace('.', ',', $dataDi->balengTampunganB); ?></div>
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



<div class="col-sm-4" style="border:thin solid #e6e6e6; padding-top:2px;"><h5 style="border-bottom:1px solid #994d00; color:#994d00;">Control Valve</h5><div class="row">        <div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_saranaControlValveA" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saranaControlValveA" style="background-color:#e6e6e6;">B/RR/RS/RB</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_saranaControlValveA"><?= str_replace('.', ',', $dataDi->saranaControlValveA); ?></div>
            </div>
        </div>
    </div>
</div> 

<div class="col-sm-6"> 
    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
        <div class="row p-0 m-0">
            <label id="label_saranaControlValveB" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_saranaControlValveB" style="background-color:#e6e6e6;">Nilai Kondisi (%)</label>
            <div class="col-sm-6 pr-2 m-0 row">
                <div class="" id="isi_saranaControlValveB"><?= str_replace('.', ',', $dataDi->saranaControlValveB); ?></div>
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
                url: base_url()+'IndexKinerja4E/delete',
                type: "post",
                dataType: 'json',
                data: {id},
                success: function (res) {
                  if (res.code != 200 ){
                    alert('Error')
                    return;
                }
                window.location = base_url()+'IndexKinerja4E';

            }
        });
        }


    });

  }

});
</script>
</body>