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
                        <h4 class="m-0" id="titleBox">Form 2B : RT1 D.I.R</h4>
                    </div>

                    <div class="col-5 text-right">
                        <a href="<?= base_url(); ?>RealisasiTanam2B" class="btn btn-default btn-sm" aksi="table" title="Kembali"><i class="fas fa-home"></i> Kembali</a>

                        <?php if ($this->session->userdata('prive') == 'pemda' or $this->session->userdata('prive') == 'admin' or $this->session->userdata('prive') == 'provinsi') { ?>

                            <a href="<?= base_url(); ?>RealisasiTanam2B/editData/<?= $dataDi->irigasiidX; ?>" class="btn btn-primary btn-sm" aksi="ubah" title="Ubah data"><i class="far fa-edit"></i> Ubah</a>

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

                    <div class="col-sm-6"> 
                        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                            <div class="row p-0 m-0">
                                <label id="label_irigasiid" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_irigasiid" style="background-color:#e6e6e6;">Luas D.I. Sesuai Permen 14/2015 (Ha)</label>
                                <div class="col-sm-6 pr-2 m-0 row">
                                    <div class="" id="isi_irigasiid"><?= $dataDi->laPermen; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6"> 
                        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                            <div class="row p-0 m-0">
                                <label id="label_irigasiid" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_irigasiid" style="background-color:#e6e6e6;">Sawah/Fungsional (Pemetaan IGT) (Ha)</label>
                                <div class="col-sm-6 pr-2 m-0 row">
                                    <div class="" id="isi_irigasiid"><?= $dataDi->sawahFungsional; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-2 p-1" style="background-color:#ccc; border:0px;">
                        <div class="p-0 m-0" style="border:0px;">
                            <h5 class="card-title">Pola Tanam</h5>
                        </div>
                    </div>

                    <div class="row">         
                       <div class="col-sm-6">
                        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                            <div class="row p-0 m-0">
                                <label id="label_laPermen" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laPermen" style="background-color:#e6e6e6;">P→P→P</label>
                                <div class="col-sm-6 pr-2 m-0 row">
                                    <div class="" id="isi_laPermen"><?= ($dataDi->polatanamPadi3 == 'V') ? '<i class="fas fa-check"></i>' : ''; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                            <div class="row p-0 m-0">
                                <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">P→P→Plw</label>
                                <div class="col-sm-6 pr-2 m-0 row">
                                    <div class="" id="isi_laBaku"><?= ($dataDi->polatanamPadi2Plw == 'V') ? '<i class="fas fa-check"></i>' : ''; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                            <div class="row p-0 m-0">
                                <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">P→Plw→Plw</label>
                                <div class="col-sm-6 pr-2 m-0 row">
                                    <div class="" id="isi_laBaku"><?= ($dataDi->polatanamPadiPlw2 == 'V') ? '<i class="fas fa-check"></i>' : ''; ?></div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="col-sm-6">
                        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                            <div class="row p-0 m-0">
                                <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">P→P</label>
                                <div class="col-sm-6 pr-2 m-0 row">
                                    <div class="" id="isi_laBaku"><?= ($dataDi->polatanamPadi2 == 'V') ? '<i class="fas fa-check"></i>' : ''; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                            <div class="row p-0 m-0">
                                <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">P→Plw</label>
                                <div class="col-sm-6 pr-2 m-0 row">
                                    <div class="" id="isi_laBaku"><?= ($dataDi->polatanamPadiPlw == 'V') ? '<i class="fas fa-check"></i>' : ''; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                            <div class="row p-0 m-0">
                                <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">P</label>
                                <div class="col-sm-6 pr-2 m-0 row">
                                    <div class="" id="isi_laBaku"><?= ($dataDi->polatanamPadi == 'V') ? '<i class="fas fa-check"></i>' : ''; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="mb-2 p-1" style="background-color:#ccc; border:0px;">
                    <div class="p-0 m-0" style="border:0px;">
                        <h5 class="card-title">REALISASI TANAM PADI</h5>
                    </div>
                </div>

                <div class="row">         
                   <div class="col-sm-6">
                    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                        <div class="row p-0 m-0">
                            <label id="label_laPermen" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laPermen" style="background-color:#e6e6e6;">MT.1 (Ha)</label>
                            <div class="col-sm-6 pr-2 m-0 row">
                                <div class="" id="isi_laPermen"><?= str_replace('.', ',', $dataDi->reatamPadiMT1); ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                        <div class="row p-0 m-0">
                            <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">MT.2 (Ha)</label>
                            <div class="col-sm-6 pr-2 m-0 row">
                                <div class="" id="isi_laBaku"><?= str_replace('.', ',', $dataDi->reatamPadiMT2); ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                        <div class="row p-0 m-0">
                            <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">MT.3 (Ha)</label>
                            <div class="col-sm-6 pr-2 m-0 row">
                                <div class="" id="isi_laBaku"><?= str_replace('.', ',', $dataDi->reatamPadiMT3); ?></div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-sm-6">
                    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                        <div class="row p-0 m-0">
                            <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">Total (Ha)</label>
                            <div class="col-sm-6 pr-2 m-0 row">
                                <div class="" id="isi_laBaku"><?= str_replace('.', ',', $dataDi->reatamPadiTotalHa); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                        <div class="row p-0 m-0">
                            <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">Total IP (%)</label>
                            <div class="col-sm-6 pr-2 m-0 row">
                                <div class="" id="isi_laBaku"><?= str_replace('.', ',', $dataDi->reatamPadiTotalHaIp); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="mb-2 p-1" style="background-color:#ccc; border:0px;">
                <div class="p-0 m-0" style="border:0px;">
                    <h5 class="card-title">REALISASI TANAM PALAWIJA</h5>
                </div>
            </div>

            <div class="row">         

               <div class="col-sm-6">
                <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                    <div class="row p-0 m-0">
                        <label id="label_laPermen" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laPermen" style="background-color:#e6e6e6;">MT.1 (Ha)</label>
                        <div class="col-sm-6 pr-2 m-0 row">
                            <div class="" id="isi_laPermen"><?= str_replace('.', ',', $dataDi->reatamPalawijaMT1); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                    <div class="row p-0 m-0">
                        <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">MT.2 (Ha)</label>
                        <div class="col-sm-6 pr-2 m-0 row">
                            <div class="" id="isi_laBaku"><?= str_replace('.', ',', $dataDi->reatamPalawijaMT2); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                    <div class="row p-0 m-0">
                        <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">MT.3 (Ha)</label>
                        <div class="col-sm-6 pr-2 m-0 row">
                            <div class="" id="isi_laBaku"><?= str_replace('.', ',', $dataDi->reatamPalawijaMT3); ?></div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-sm-6">
                <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                    <div class="row p-0 m-0">
                        <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">Total (Ha)</label>
                        <div class="col-sm-6 pr-2 m-0 row">
                            <div class="" id="isi_laBaku"><?= str_replace('.', ',', $dataDi->reatamPalawijaTotalHa); ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                    <div class="row p-0 m-0">
                        <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">Total IP (%)</label>
                        <div class="col-sm-6 pr-2 m-0 row">
                            <div class="" id="isi_laBaku"><?= str_replace('.', ',', $dataDi->reatamPalawijaTotalHaIp); ?></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="mb-2 p-1" style="background-color:#ccc; border:0px;">
            <div class="p-0 m-0" style="border:0px;">
                <h5 class="card-title">REALISASI TANAM TEBU</h5>
            </div>
        </div>

        <div class="row">         

            <div class="col-sm-6">
                <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                    <div class="row p-0 m-0">
                        <label id="label_laPermen" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laPermen" style="background-color:#e6e6e6;">MT.1 (Ha)</label>
                        <div class="col-sm-6 pr-2 m-0 row">
                            <div class="" id="isi_laPermen"><?= str_replace('.', ',', $dataDi->reatamTebuMT1); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                    <div class="row p-0 m-0">
                        <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">MT.2 (Ha)</label>
                        <div class="col-sm-6 pr-2 m-0 row">
                            <div class="" id="isi_laBaku"><?= str_replace('.', ',', $dataDi->reatamTebuMT2); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                    <div class="row p-0 m-0">
                        <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">MT.3 (Ha)</label>
                        <div class="col-sm-6 pr-2 m-0 row">
                            <div class="" id="isi_laBaku"><?= str_replace('.', ',', $dataDi->reatamTebuMT3); ?></div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-sm-6">
                <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                    <div class="row p-0 m-0">
                        <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">Total (Ha)</label>
                        <div class="col-sm-6 pr-2 m-0 row">
                            <div class="" id="isi_laBaku"><?= str_replace('.', ',', $dataDi->reatamTebuTotalHa); ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                    <div class="row p-0 m-0">
                        <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">Total IP (%)</label>
                        <div class="col-sm-6 pr-2 m-0 row">
                            <div class="" id="isi_laBaku"><?= str_replace('.', ',', $dataDi->reatamTebuTotalHaIp); ?></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="mb-2 p-1" style="background-color:#ccc; border:0px;">
            <div class="p-0 m-0" style="border:0px;">
                <h5 class="card-title">REALISASI TANAM LAINNYA</h5>
            </div>
        </div>

        <div class="row">         

           <div class="col-sm-6">
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_laPermen" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laPermen" style="background-color:#e6e6e6;">MT.1 (Ha)</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_laPermen"><?= str_replace('.', ',', $dataDi->reatamLainnyaMT1); ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">MT.2 (Ha)</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_laBaku"><?= str_replace('.', ',', $dataDi->reatamLainnyaMT2); ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">MT.3 (Ha)</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_laBaku"><?= str_replace('.', ',', $dataDi->reatamLainnyaMT3); ?></div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-sm-6">
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">Total (Ha)</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_laBaku"><?= str_replace('.', ',', $dataDi->reatamLainnyaTotalHa); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">Total IP (%)</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_laBaku"><?= str_replace('.', ',', $dataDi->reatamLainnyaTotalHaIp); ?></div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="mb-2 p-1" style="background-color:#ccc; border:0px;">
        <div class="p-0 m-0" style="border:0px;">
            <h5 class="card-title">JUMLAH</h5>
        </div>
    </div>

    <div class="row">         

        <div class="col-sm-6">
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_laPermen" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laPermen" style="background-color:#e6e6e6;">MT.1 (Ha)</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_laPermen"><?= str_replace('.', ',', $dataDi->jmlMT1); ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">MT.2 (Ha)</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_laBaku"><?= str_replace('.', ',', $dataDi->jmlMT2); ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">MT.3 (Ha)</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_laBaku"><?= str_replace('.', ',', $dataDi->jmlMT3); ?></div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-sm-6">
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">Total (Ha)</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_laBaku"><?= str_replace('.', ',', $dataDi->jmlTotalHa); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">Total IP (%)</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_laBaku"><?= str_replace('.', ',', $dataDi->jmlTotalIp); ?></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="mb-2 p-1" style="background-color:#ccc; border:0px;">
        <div class="p-0 m-0" style="border:0px;">
            <h5 class="card-title">PRODUKTIVITAS PADI</h5>
        </div>
    </div>

    <div class="row"> 

        <div class="col-sm-6">
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">MT.1 (Ton/Ha)</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_laBaku"><?= str_replace('.', ',', $dataDi->produktivitasPadiMT1); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">MT.2 (Ton/Ha)</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_laBaku"><?= str_replace('.', ',', $dataDi->produktivitasPadiMT2); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">MT.3 (Ton/Ha)</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_laBaku"><?= str_replace('.', ',', $dataDi->produktivitasPadiMT3); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                <div class="row p-0 m-0">
                    <label id="label_laBaku" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_laBaku" style="background-color:#e6e6e6;">Rata2 (Ton/Ha)</label>
                    <div class="col-sm-6 pr-2 m-0 row">
                        <div class="" id="isi_laBaku"><?= str_replace('.', ',', $dataDi->produktivitasRata2); ?></div>
                    </div>
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
                url: base_url()+'RealisasiTanam2B/delete',
                type: "post",
                dataType: 'json',
                data: {id},
                success: function (res) {
                  if (res.code != 200 ){
                    alert('Error')
                    return;
                }
                window.location = base_url()+'RealisasiTanam2B';

            }
        });
        }


    });

  }

});
</script>
</body>