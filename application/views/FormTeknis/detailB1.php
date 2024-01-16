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
                        <h4 class="m-0" id="titleBox">Form 1B : ASET D.I.R</h4>
                    </div>

                    <div class="col-5 text-right">
                        <a href="<?= base_url(); ?>FormTeknis1B" class="btn btn-default btn-sm" aksi="table" title="Kembali"><i class="fas fa-home"></i> Kembali</a>

                        <?php if ($this->session->userdata('prive') == 'pemda' or $this->session->userdata('prive') == 'admin' or $this->session->userdata('prive') == 'provinsi') { ?>

                            <a href="<?= base_url(); ?>FormTeknis1B/editData/<?= $dataDi->irigasiidX; ?>" class="btn btn-primary btn-sm" aksi="ubah" title="Ubah data"><i class="far fa-edit"></i> Ubah</a>

                        <?php } ?>

                        <!-- <button onclick="cetakPdf();" class="btn btn-info btn-sm"><i class="fas fa-print"></i> Cetak</button> -->

                        <?php if ($this->session->userdata('prive') == 'pemda' or $this->session->userdata('prive') == 'admin' or $this->session->userdata('prive') == 'provinsi') { ?>
                            <button onclick="deleteData('<?= $dataDi->irigasiidX; ?>')" class="btn btn-danger btn-sm" aksi="delete" title="Hapus data"><i class="far fa-trash-alt"></i> Hapus</button>
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
                    </div>

                    <div class="col-sm-6"> 
                        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                            <div class="row p-0 m-0">
                                <label id="label_irigasiid" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_irigasiid" style="background-color:#e6e6e6;">Nomeklatur/ Nama D.I.</label>
                                <div class="col-sm-6 pr-2 m-0 row">
                                    <div class="" id="isi_irigasiid"><?= $dataDi->nama; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-2 p-1" style="background-color:#ccc; border:0px;">
                        <div class="p-0 m-0" style="border:0px;">
                            <h5 class="card-title">Luas&nbsp;Areal&nbsp;(Ha)</h5>
                        </div>
                    </div>

                    <div class="row">         
                       <div class="col-sm-6">
                        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                            <div class="row p-0 m-0">
                                <label id="label_laPermen" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laPermen" style="background-color:#e6e6e6;">Berdasarkan Permen 14/2015</label>
                                <div class="col-sm-6 pr-2 m-0 row">
                                    <div class="" id="isi_laPermen"><?= str_replace('.', ',', $dataDi->laPermen); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                            <div class="row p-0 m-0">
                                <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">Baku (Pemetaan&nbsp;IGT)</label>
                                <div class="col-sm-6 pr-2 m-0 row">
                                    <div class="" id="isi_laBaku"><?= str_replace('.', ',', $dataDi->laBaku); ?></div>
                                </div>
                            </div>
                        </div>
                    </div> 

                    <div class="col-sm-6">
                        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                            <div class="row p-0 m-0">
                                <label id="label_laPotensial" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laPotensial" style="background-color:#e6e6e6;">Potensial (Pemetaan&nbsp;IGT)</label>
                                <div class="col-sm-6 pr-2 m-0 row">
                                    <div class="" id="isi_laPotensial"><?= str_replace('.', ',', $dataDi->laPotensial); ?></div>
                                </div>
                            </div>
                        </div>
                    </div> 

                    <div class="col-sm-6">
                        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                            <div class="row p-0 m-0">
                                <label id="label_laFungsional" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laFungsional" style="background-color:#e6e6e6;">Fungsional (Pemetaan&nbsp;IGT)</label>
                                <div class="col-sm-6 pr-2 m-0 row">
                                    <div class="" id="isi_laFungsional"><?= str_replace('.', ',', $dataDi->laFungsional); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6"> 
                    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                        <div class="row p-0 m-0">
                            <label id="label_sumberAir" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_sumberAir" style="background-color:#e6e6e6;">Jenis Rawa (Pasut/Lebak)</label>
                            <div class="col-sm-6 pr-2 m-0 row">
                                <div class="" id="isi_sumberAir"><?= $dataDi->jenisRawa; ?></div>
                            </div>
                        </div>
                    </div>
                </div> 



                <div class="mb-2 p-1" style="background-color:#ccc; border:0px;">
                    <div class="p-0 m-0" style="border:0px;">
                        <h5 class="card-title">Saluran</h5>
                    </div>
                </div>

                <div class="row">            
                    <div class="col-sm-6"> 
                        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                            <div class="row p-0 m-0">
                                <label id="label_buBendung" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_buBendung" style="background-color:#e6e6e6;">Primer (m)</label>
                                <div class="col-sm-6 pr-2 m-0 row">
                                    <div class="" id="isi_buBendung"><?= str_replace('.', ',', $dataDi->sPrimer); ?></div>
                                </div>
                            </div>
                        </div>
                    </div> 




                    <div class="col-sm-6"> 
                        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                            <div class="row p-0 m-0">
                                <label id="label_buPengambilanBebas" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_buPengambilanBebas" style="background-color:#e6e6e6;">Sekunder (m)</label>
                                <div class="col-sm-6 pr-2 m-0 row">
                                    <div class="" id="isi_buPengambilanBebas"><?= str_replace('.', ',', $dataDi->sSekunder); ?></div>
                                </div>
                            </div>
                        </div>
                    </div> 




                    <div class="col-sm-6"> 
                        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                            <div class="row p-0 m-0">
                                <label id="label_buStasiunPompa" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_buStasiunPompa" style="background-color:#e6e6e6;">Tersier (m)</label>
                                <div class="col-sm-6 pr-2 m-0 row">
                                    <div class="" id="isi_buStasiunPompa"><?= str_replace('.', ',', $dataDi->sTersier); ?></div>
                                </div>
                            </div>
                        </div>
                    </div> 




                    <div class="col-sm-6"> 
                        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                            <div class="row p-0 m-0">
                                <label id="label_buEmbung" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_buEmbung" style="background-color:#e6e6e6;">Pembuang (m)</label>
                                <div class="col-sm-6 pr-2 m-0 row">
                                    <div class="" id="isi_buEmbung"><?= str_replace('.', ',', $dataDi->sPembuang); ?></div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>


                <div class="mb-2 p-1" style="background-color:#ccc; border:0px;">
                    <div class="p-0 m-0" style="border:0px;">
                        <h5 class="card-title">Bangunan Pengatur</h5>
                    </div>
                </div>

                <div class="row">          
                  <div class="col-sm-6"> 
                    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                        <div class="row p-0 m-0">
                            <label id="label_sTipeSaluran" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_sTipeSaluran" style="background-color:#e6e6e6;">Bangunan Pintu Primer (bh)</label>
                            <div class="col-sm-6 pr-2 m-0 row">
                                <div class="" id="isi_sTipeSaluran"><?= str_replace('.', ',', $dataDi->bpPrimer); ?></div>
                            </div>
                        </div>
                    </div>
                </div> 




                <div class="col-sm-6"> 
                    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                        <div class="row p-0 m-0">
                            <label id="label_sPrimer" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_sPrimer" style="background-color:#e6e6e6;">Bangunan Pintu Sekunder (bh)</label>
                            <div class="col-sm-6 pr-2 m-0 row">
                                <div class="" id="isi_sPrimer"><?= str_replace('.', ',', $dataDi->bpSekunder); ?></div>
                            </div>
                        </div>
                    </div>
                </div> 




                <div class="col-sm-6"> 
                    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                        <div class="row p-0 m-0">
                            <label id="label_sSekunder" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_sSekunder" style="background-color:#e6e6e6;">Bangunan Pintu Tersier (bh)</label>
                            <div class="col-sm-6 pr-2 m-0 row">
                                <div class="" id="isi_sSekunder"><?= str_replace('.', ',', $dataDi->bpTersier); ?></div>
                            </div>
                        </div>
                    </div>
                </div> 




                <div class="col-sm-6"> 
                    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                        <div class="row p-0 m-0">
                            <label id="label_sTersier" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_sTersier" style="background-color:#e6e6e6;">Bangunan Pintu Pembuang (bh)</label>
                            <div class="col-sm-6 pr-2 m-0 row">
                                <div class="" id="isi_sTersier"><?= str_replace('.', ',', $dataDi->bpPembuang); ?></div>
                            </div>
                        </div>
                    </div>
                </div> 




                <div class="col-sm-6"> 
                    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                        <div class="row p-0 m-0">
                            <label id="label_sPembuang" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_sPembuang" style="background-color:#e6e6e6;">Bendung (bh)</label>
                            <div class="col-sm-6 pr-2 m-0 row">
                                <div class="" id="isi_sPembuang"><?= str_replace('.', ',', $dataDi->bpBendung); ?></div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>


            <div class="mb-2 p-1" style="background-color:#ccc; border:0px;">
                <div class="p-0 m-0" style="border:0px;">
                    <h5 class="card-title">Bangunan&nbsp;Pengatur&nbsp;dan&nbsp;Bangunan Lindung</h5>
                </div>
            </div>

            <div class="row">          
              <div class="col-sm-6"> 
                <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                    <div class="row p-0 m-0">
                        <label id="label_bppBagi" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bppBagi" style="background-color:#e6e6e6;">Tanggul (m)</label>
                        <div class="col-sm-6 pr-2 m-0 row">
                            <div class="" id="isi_bppBagi"><?= str_replace('.', ',', $dataDi->blTanggul); ?></div>
                        </div>
                    </div>
                </div>
            </div> 




            <div class="col-sm-6"> 
                <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                    <div class="row p-0 m-0">
                        <label id="label_bppBagiSadap" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bppBagiSadap" style="background-color:#e6e6e6;">Polder (m)</label>
                        <div class="col-sm-6 pr-2 m-0 row">
                            <div class="" id="isi_bppBagiSadap"><?= str_replace('.', ',', $dataDi->blPolder); ?></div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>


        <div class="mb-2 p-1" style="background-color:#ccc; border:0px;">
            <div class="p-0 m-0" style="border:0px;">
                <h5 class="card-title">Bangunan Pelengkap</h5>
            </div>
        </div>

        <div class="row">           
           <div class="col-sm-6"> 
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_bpGorong" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bpGorong" style="background-color:#e6e6e6;">Jalan Inspeksi (m)</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_bpGorong"><?= str_replace('.', ',', $dataDi->jInspeksi); ?></div>
                    </div>
                </div>
            </div>
        </div> 




        <div class="col-sm-6"> 
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_bpSipon" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bpSipon" style="background-color:#e6e6e6;">Jembatan (bh)</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_bpSipon"><?= str_replace('.', ',', $dataDi->jJembatan); ?></div>
                    </div>
                </div>
            </div>
        </div> 




        <div class="col-sm-6"> 
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_bpTalang" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bpTalang" style="background-color:#e6e6e6;">Gorong-Gorong (bh)</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_bpTalang"><?= str_replace('.', ',', $dataDi->jGorong); ?></div>
                    </div>
                </div>
            </div>
        </div> 




        <div class="col-sm-6"> 
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_bpTerjunan" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bpTerjunan" style="background-color:#e6e6e6;">Dermaga (bh)</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_bpTerjunan"><?= str_replace('.', ',', $dataDi->jDermaga); ?></div>
                    </div>
                </div>
            </div>
        </div> 




        <div class="col-sm-6"> 
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_bpGotMiring" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bpGotMiring" style="background-color:#e6e6e6;">Kantor Pengamat (Bh)</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_bpGotMiring"><?= str_replace('.', ',', $dataDi->jPengamat); ?></div>
                    </div>
                </div>
            </div>
        </div> 




        <div class="col-sm-6"> 
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_bpFlum" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bpFlum" style="background-color:#e6e6e6;">Gudang (bh)</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_bpFlum"><?= str_replace('.', ',', $dataDi->jGudang); ?></div>
                    </div>
                </div>
            </div>
        </div> 




        <div class="col-sm-6"> 
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_bpTerowongan" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bpTerowongan" style="background-color:#e6e6e6;">Rumah Jaga (bh)</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_bpTerowongan"><?= str_replace('.', ',', $dataDi->jRumahJaga); ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6"> 
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_bpTerowongan" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_bpTerowongan" style="background-color:#e6e6e6;">Sanggar Tani (bh)</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_bpTerowongan"><?= str_replace('.', ',', $dataDi->jSanggarTani); ?></div>
                    </div>
                </div>
            </div>
        </div> 
    </div>


    <div class="mb-2 p-1" style="background-color:#ccc; border:0px;">
        <div class="p-0 m-0" style="border:0px;">
            <h5 class="card-title">Sarana</h5>
        </div>
    </div>

    <div class="row">        
        <div class="col-sm-6"> 
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_blinKantong" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_blinKantong" style="background-color:#e6e6e6;">Pintu Air (bh)</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_blinKantong"><?= str_replace('.', ',', $dataDi->saranaPintuAir); ?></div>
                    </div>
                </div>
            </div>
        </div> 




        <div class="col-sm-6"> 
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_blinPelimpah" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_blinPelimpah" style="background-color:#e6e6e6;">Alat Ukur (bh)</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_blinPelimpah"><?= str_replace('.', ',', $dataDi->saranaAlatUkur); ?></div>
                    </div>
                </div>
            </div>
        </div>  
    </div>



    <div class="mb-2 p-1" style="background-color:#ccc; border:0px;">
        <div class="p-0 m-0" style="border:0px;">
            <h5 class="card-title">Dokumentasi</h5>
        </div>
    </div>

    <div class="row">           
     <div class="col-sm-6"> 
        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
            <div class="row p-0 m-0">
                <label id="label_dokPeta" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_dokPeta" style="background-color:#e6e6e6;">Peta</label>
                <div class="col-sm-6 pr-2 m-0 row">
                    <div class="" id="isi_dokPeta"><?= $dataDi->dokPeta; ?></div>
                </div>
            </div>
        </div>
    </div> 




    <div class="col-sm-6"> 
        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
            <div class="row p-0 m-0">
                <label id="label_dokSkemaJaringan" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_dokSkemaJaringan" style="background-color:#e6e6e6;">Skema Jaringan</label>
                <div class="col-sm-6 pr-2 m-0 row">
                    <div class="" id="isi_dokSkemaJaringan"><?= $dataDi->dokSkemaJaringan; ?></div>
                </div>
            </div>
        </div>
    </div> 




    <div class="col-sm-6"> 
        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
            <div class="row p-0 m-0">
                <label id="label_dokGambarKonstruksi" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_dokGambarKonstruksi" style="background-color:#e6e6e6;">Gambar Konstruksi</label>
                <div class="col-sm-6 pr-2 m-0 row">
                    <div class="" id="isi_dokGambarKonstruksi"><?= $dataDi->dokGambarKonstruksi; ?></div>
                </div>
            </div>
        </div>
    </div> 




    <div class="col-sm-6"> 
        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
            <div class="row p-0 m-0">
                <label id="label_dokBukuDataDI" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_dokBukuDataDI" style="background-color:#e6e6e6;">Buku&nbsp;Data Daerah&nbsp;Irigasi</label>
                <div class="col-sm-6 pr-2 m-0 row">
                    <div class="" id="isi_dokBukuDataDI"><?= $dataDi->dokBukuDataDI; ?></div>
                </div>
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
                url: base_url()+'FormTeknis1B/delete',
                type: "post",
                dataType: 'json',
                data: {id},
                success: function (res) {
                  if (res.code != 200 ){
                    alert('Error')
                    return;
                }
                window.location = base_url()+'FormTeknis1B';

            }
        });
        }


    });

  }

});
</script>
</body>