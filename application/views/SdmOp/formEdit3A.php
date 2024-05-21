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

   function ajaxUntukSemua(url, requestData, onSuccess, onError) {
    $.ajax({
      url: url,
      type: 'POST',
      data: requestData,
      dataType: 'json',
      success: function(data) {
        onSuccess(data);
    },
    error: function(xhr, status, error) {
        onError(error);
    }
});
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
                <form role="form" action="<?= base_url(); ?>SdmOp3A/SimpanData" method="POST" data-select2-id="25">
                    <input type="hidden" name="idEdit" value="<?= $id; ?>">
                    <div class="content-header bg-warning">
                        <div class="container-fluid">
                          <div class="row m-0 p-0 text-left">
                            <div class="col-sm-7">
                                <h4 class="m-0">Form 3A : SDM OP</h4>
                            </div>

                            <div class="col-sm-5 text-right">
                                <a href="<?= base_url(); ?>SdmOp3A/getDetailData/<?= $id; ?>" class="btn btn-default btn-sm" title="Kembali"><i class="fa fa-undo"></i> Kembali</a>
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

                                        <div class="col-sm-12 col-lg-3" data-select2-id="33"> 
                                            <div class="form-group" data-select2-id="32">
                                                <label for="provid">Provinsi  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                                <select id="provid" name="provid" class="form-control select2" required>

                                                    <option value="<?= $dataHeader->provid; ?>"><?= $dataHeader->provinsi; ?></option>

                                                </select>
                                                <div class="invalid-feedback" id="pesan_irigasiid"></div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-lg-3" data-select2-id="33"> 
                                            <div class="form-group" data-select2-id="32">
                                                <label for="kotakabid">Kota/Kab  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                                <select id="kotakabid" name="kotakabid" class="form-control select2" required>

                                                    <option value="<?= $dataHeader->kotakabid; ?>"><?= $dataHeader->kemendagri; ?></option>

                                                </select>
                                                <div class="invalid-feedback" id="pesan_irigasiid"></div>
                                            </div>
                                        </div> 

                                        <div class="col-sm-12 col-lg-3" data-select2-id="33"> 
                                            <div class="form-group" data-select2-id="32">
                                                <label for="in_jmlDI">Jumlah DI (Buah)  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                                <input id="in_jmlDI" name="jmlDI" value="<?= str_replace('.', ',', $dataHeader->jmlDI); ?>" type="text" class="form-control text-right number" oninput="this.value = this.value.replace(/[^0-9]/g, '')"  required placeholder="Jumlah DI (Buah)" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-lg-3" data-select2-id="33"> 
                                            <div class="form-group" data-select2-id="32">
                                                <label for="luasDI">Luas DI (Ha)  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                                <input id="luasDI" name="luasDI" value="<?= str_replace('.', ',', $dataHeader->luasDI); ?>" type="text" class="form-control text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')"  required placeholder="Luas DI (Ha)" required>
                                            </div>
                                        </div> 

                                        <div class="col-sm-12 col-lg-3" data-select2-id="33"> 
                                            <div class="form-group" data-select2-id="32">
                                                <label for="alokasiApbn">Alokasi APBD O&P Irigasi TA <?= $this->session->userdata('thang'); ?> (Rp)  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                                <input id="alokasiApbn" name="alokasiApbn" value="<?= str_replace('.', ',', $dataHeader->dak); ?>" type="text" class="form-control text-right number" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  disabled placeholder="Alokasi APBD O&P Irigasi TA <?= $this->session->userdata('thang'); ?> (Rp)" required>
                                            </div>
                                        </div> 

                                    </div>


                                    <!-- Awal Tabel -->
                                    <div id="boxFormLain" style="border:thin solid #ccc;">
                                        <!-- <div class="row col-sm-12 bg-info mb-2 text-center" style="padding:2px; margin:0px;"><b>DATA ORGANISASI PERSONALIA OPERASI DAN PEMELIHARAAN</b></div> -->

                                        <div class="card-body table-responsive p-0  tableFixHead divTable" style="position: relative; overflow-y: scroll; height: 92vh; width:96.6vw; background-color:#efebe9; padding:2px; border:thin solid #ccc;">
                                            <table class="table">

                                                <tbody id="boxTempatList">
                                                    <thead>
                                                        <tr id="boxThField0" style="background-color:#18978F; color:#fff;">
                                                            <th style="border: thin solid #006666; " colspan="1" rowspan="3" class="text-center">NO</th>
                                                            <th style="border: thin solid #006666; " colspan="1" rowspan="3" class="text-center">ORGANISASI PERSONALIA O&amp;P</th>
                                                            <th style="border: thin solid #006666; " colspan="11" rowspan="1" class="text-center">KONDISI SAAT INI</th>
                                                            <th style="border: thin solid #006666; " colspan="1" rowspan="2" class="text-center">KEBUTUHAN*</th>
                                                            <th style="border: thin solid #006666; " colspan="1" rowspan="2" class="text-center">KEKURANGAN*</th>
                                                            <th style="border: thin solid #006666; " colspan="1" rowspan="3" class="text-center">KETERANGAN</th>
                                                        </tr>
                                                        <tr id="boxThField1" style="background-color:#18978F; color:#fff;">
                                                            <th style="border: thin solid #006666; " colspan="1" rowspan="1" class="text-center">JUMLAH</th>
                                                            <th style="border: thin solid #006666; " colspan="2" rowspan="1" class="text-center">STATUS (ORG)</th>
                                                            <th style="border: thin solid #006666; " colspan="5" rowspan="1" class="text-center">PENDIDIKAN (ORG)</th>
                                                            <th style="border: thin solid #006666; " colspan="3" rowspan="1" class="text-center">USIA (TAHUN) (ORG)</th>
                                                        </tr>
                                                        <tr id="boxThField2" style="background-color:#18978F; color:#fff;">
                                                            <th style="border: thin solid #006666; " colspan="1" rowspan="1" class="text-center">ORG</th>
                                                            <th style="border: thin solid #006666; " colspan="1" rowspan="1" class="text-center">PNS</th>
                                                            <th style="border: thin solid #006666; " colspan="1" rowspan="1" class="text-center">NON PNS/ HARIAN</th>
                                                            <th style="border: thin solid #006666; " colspan="1" rowspan="1" class="text-center">S1/D4</th>
                                                            <th style="border: thin solid #006666; " colspan="1" rowspan="1" class="text-center">D3</th>
                                                            <th style="border: thin solid #006666; " colspan="1" rowspan="1" class="text-center">SLTA</th>
                                                            <th style="border: thin solid #006666; " colspan="1" rowspan="1" class="text-center">SLTP</th>
                                                            <th style="border: thin solid #006666; " colspan="1" rowspan="1" class="text-center">SD</th>
                                                            <th style="border: thin solid #006666; " colspan="1" rowspan="1" class="text-center">&gt;50</th>
                                                            <th style="border: thin solid #006666; " colspan="1" rowspan="1" class="text-center">40-50</th>
                                                            <th style="border: thin solid #006666; " colspan="1" rowspan="1" class="text-center">&lt;40</th>
                                                            <th style="border: thin solid #006666; " colspan="1" rowspan="1" class="text-center">ORG</th>
                                                            <th style="border: thin solid #006666; " colspan="1" rowspan="1" class="text-center">ORG</th>
                                                        </tr>
                                                    </thead>
                                                    <!-- Sini gan kontennya -->
                                                    <tbody id="bosTempatisiPerkakas-0">

                                                        <?php 

                                                        $nomorKuning = 1;
                                                        $nomorPutih = 1;
                                                        $idTbl2 = '';

                                                        ?>

                                                        <?php foreach ($dataBody as $key => $val) { ?>

                                                           <?php if ($idTbl2 != $val->uptd) { ?> 

                                                            <?php $nomorPutih=1; ?>

                                                            <tr class="bg-warning indexKuningke-<?= $nomorKuning; ?>">
                                                                <td><?= $nomorKuning; ?>
                                                           <!--  <br>
                                                            <?= ($nomorKuning > 1) ? '<buttom class="btn btn-danger btn-sm" onclick="hapusKuning('.$nomorKuning.')">X</buttom>':'';  ?> -->
                                                        </td>
                                                        <td colspan="15"><div class="row col-sm-12">
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="in_idTempat-<?= $nomorKuning; ?>">Kantor UPTD/Pengamat</label>
                                                                    <input id="in_alamat-1" name="uptd[<?= $nomorKuning; ?>]" value="<?= $val->uptd; ?>" type="text" class="form-control grupTempatF dampak_idTempat"  placeholder="Kantor UPTD/Pengamat" noklaster="" required>
                                                                    <div class="invalid-feedback" id="pesan_idTempat"></div>
                                                                </div>
                                                            </div> 
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="in_nama-<?= $nomorKuning; ?>">Nama Kantor</label>
                                                                    <input id="in_nama-1" name="nama[<?= $nomorKuning; ?>]" value="<?= $val->nm_kantor; ?>" type="text" class="form-control grupTempatF dampak_idTempat" noklaster="0"  placeholder="Nama Kantor" required>
                                                                    <div class="invalid-feedback" id="pesan_nama"></div>
                                                                </div>
                                                            </div> 


                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="in_alamat-<?= $nomorKuning; ?>">Alamat</label>
                                                                    <input id="in_alamat-1" name="alamat[<?= $nomorKuning; ?>]" value="<?= $val->alamat; ?>" type="text" class="form-control grupTempatF dampak_idTempat"  placeholder="Alamat" noklaster="" required>
                                                                    <div class="invalid-feedback" id="pesan_alamat"></div>
                                                                </div>


                                                            </div> 

                                                        </div>
                                                    </td>
                                                </tr>

                                                <?php 

                                                $nomorKuning++;

                                                ?>


                                                <tr id="tr_aLabel_13">
                                                    <td style="width:2%;"><?= $nomorPutih; ?></td>

                                                    <td class="col-sm-3" style="min-width:200px;">                        
                                                        <input id="in_labelid" name="nm_label[]" value="<?= $val->nm_lable; ?>" class="form-control grupTempat">
                                                        <div class="invalid-feedback" id="pesan_labelid"></div>
                                                    </td>
                                                    <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                        <input id="in_jmlOrg" name="jmlOrg[]" value="<?= $val->jmlOrg; ?>" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Jumlah (Orang)">
                                                        <div class="invalid-feedback" id="pesan_jmlOrg"></div>
                                                    </td> 
                                                    <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                        <input id="in_stPnsOrg" name="stPnsOrg[]" value="<?= $val->stPnsOrg; ?>" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Status PNS (Orang)">
                                                        <div class="invalid-feedback" id="pesan_stPnsOrg"></div>
                                                    </td> 
                                                    <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                        <input id="in_stNonPnsOrg" name="stNonPnsOrg[]" value="<?= $val->stNonPnsOrg; ?>" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Status Non PNS?Harian (Orang)">
                                                        <div class="invalid-feedback" id="pesan_stNonPnsOrg"></div>
                                                    </td> 
                                                    <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                        <input id="in_pendS1Org" name="pendS1Org[]" value="<?= $val->pendS1Org; ?>" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan S1/D4 (Orang)">
                                                        <div class="invalid-feedback" id="pesan_pendS1Org"></div>
                                                    </td> 
                                                    <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                        <input id="in_pendD3Org" name="pendD3Org[]" value="<?= $val->pendD3Org; ?>" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan D3 (Orang)">
                                                        <div class="invalid-feedback" id="pesan_pendD3Org"></div>
                                                    </td> 
                                                    <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                        <input id="in_pendSltaOrg" name="pendSltaOrg[]" value="<?= $val->pendSltaOrg; ?>" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SLTA (Orang)">
                                                        <div class="invalid-feedback" id="pesan_pendSltaOrg"></div>
                                                    </td> 
                                                    <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                        <input id="in_pendSltpOrg" name="pendSltpOrg[]" value="<?= $val->pendSltpOrg; ?>" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SLTP (Orang)">
                                                        <div class="invalid-feedback" id="pesan_pendSltpOrg"></div>
                                                    </td> 
                                                    <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                        <input id="in_pendSdOrg" name="pendSdOrg[]" value="<?= $val->pendSdOrg; ?>" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SD (Orang)">
                                                        <div class="invalid-feedback" id="pesan_pendSdOrg"></div>
                                                    </td> 
                                                    <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                        <input id="in_usiaAtas59" name="usiaAtas59[]" value="<?= $val->usiaAtas59; ?>" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia>50 (Orang)">
                                                        <div class="invalid-feedback" id="pesan_usiaAtas59"></div>
                                                    </td> 
                                                    <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                        <input id="in_usiaAntara40d59" name="usiaAntara40d59[]" value="<?= $val->usiaAntara40d59; ?>" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia 40-50 (Orang)">
                                                        <div class="invalid-feedback" id="pesan_usiaAntara40d59"></div>
                                                    </td> 
                                                    <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                        <input id="in_usiaKurang40" name="usiaKurang40[]" value="<?= $val->usiaKurang40; ?>" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia<40 (Orang)">
                                                            <div class="invalid-feedback" id="pesan_usiaKurang40"></div>
                                                        </td> 
                                                        <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                            <input id="in_kebutuhan" name="kebutuhan[]" value="<?= $val->kebutuhan; ?>" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Kebutuhan (Orang)">
                                                            <div class="invalid-feedback" id="pesan_kebutuhan"></div>
                                                        </td> 
                                                        <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                            <input id="in_kekurangan" name="kekurangan[]" value="<?= $val->kekurangan; ?>" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Kekurangan (Orang)">
                                                            <div class="invalid-feedback" id="pesan_kekurangan"></div>
                                                        </td> 
                                                        <td class="col-sm-3" style="min-width:250px; max-width:30%; ">
                                                            <input id="in_keterangan" name="keterangan[]" value="<?= $val->keterangan; ?>" type="text" class="form-control grupTempat" placeholder="Keterangan">
                                                            <div class="invalid-feedback" id="pesan_keterangan"></div>
                                                        </td> 
                                                    </tr>




                                                <?php }else{ ?>

                                                    <?php $nomorPutih++; ?>

                                                    <tr id="tr_aLabel_13">
                                                        <td style="width:2%;"><?= $nomorPutih; ?></td>

                                                        <td class="col-sm-3" style="min-width:200px;">                        
                                                            <input id="in_labelid" name="nm_label[]" value="<?= $val->nm_lable; ?>" class="form-control grupTempat">
                                                            <div class="invalid-feedback" id="pesan_labelid"></div>
                                                        </td>
                                                        <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                            <input id="in_jmlOrg" name="jmlOrg[]" value="<?= $val->jmlOrg; ?>" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Jumlah (Orang)">
                                                            <div class="invalid-feedback" id="pesan_jmlOrg"></div>
                                                        </td> 
                                                        <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                            <input id="in_stPnsOrg" name="stPnsOrg[]" value="<?= $val->stPnsOrg; ?>" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Status PNS (Orang)">
                                                            <div class="invalid-feedback" id="pesan_stPnsOrg"></div>
                                                        </td> 
                                                        <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                            <input id="in_stNonPnsOrg" name="stNonPnsOrg[]" value="<?= $val->stNonPnsOrg; ?>" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Status Non PNS?Harian (Orang)">
                                                            <div class="invalid-feedback" id="pesan_stNonPnsOrg"></div>
                                                        </td> 
                                                        <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                            <input id="in_pendS1Org" name="pendS1Org[]" value="<?= $val->pendS1Org; ?>" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan S1/D4 (Orang)">
                                                            <div class="invalid-feedback" id="pesan_pendS1Org"></div>
                                                        </td> 
                                                        <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                            <input id="in_pendD3Org" name="pendD3Org[]" value="<?= $val->pendD3Org; ?>" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan D3 (Orang)">
                                                            <div class="invalid-feedback" id="pesan_pendD3Org"></div>
                                                        </td> 
                                                        <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                            <input id="in_pendSltaOrg" name="pendSltaOrg[]" value="<?= $val->pendSltaOrg; ?>" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SLTA (Orang)">
                                                            <div class="invalid-feedback" id="pesan_pendSltaOrg"></div>
                                                        </td> 
                                                        <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                            <input id="in_pendSltpOrg" name="pendSltpOrg[]" value="<?= $val->pendSltpOrg; ?>" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SLTP (Orang)">
                                                            <div class="invalid-feedback" id="pesan_pendSltpOrg"></div>
                                                        </td> 
                                                        <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                            <input id="in_pendSdOrg" name="pendSdOrg[]" value="<?= $val->pendSdOrg; ?>" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SD (Orang)">
                                                            <div class="invalid-feedback" id="pesan_pendSdOrg"></div>
                                                        </td> 
                                                        <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                            <input id="in_usiaAtas59" name="usiaAtas59[]" value="<?= $val->usiaAtas59; ?>" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia>50 (Orang)">
                                                            <div class="invalid-feedback" id="pesan_usiaAtas59"></div>
                                                        </td> 
                                                        <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                            <input id="in_usiaAntara40d59" name="usiaAntara40d59[]" value="<?= $val->usiaAntara40d59; ?>" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia 40-50 (Orang)">
                                                            <div class="invalid-feedback" id="pesan_usiaAntara40d59"></div>
                                                        </td> 
                                                        <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                            <input id="in_usiaKurang40" name="usiaKurang40[]" value="<?= $val->usiaKurang40; ?>" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia<40 (Orang)">
                                                                <div class="invalid-feedback" id="pesan_usiaKurang40"></div>
                                                            </td> 
                                                            <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                                <input id="in_kebutuhan" name="kebutuhan[]" value="<?= $val->kebutuhan; ?>" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Kebutuhan (Orang)">
                                                                <div class="invalid-feedback" id="pesan_kebutuhan"></div>
                                                            </td> 
                                                            <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                                <input id="in_kekurangan" name="kekurangan[]" value="<?= $val->kekurangan; ?>" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Kekurangan (Orang)">
                                                                <div class="invalid-feedback" id="pesan_kekurangan"></div>
                                                            </td> 
                                                            <td class="col-sm-3" style="min-width:250px; max-width:30%; ">
                                                                <input id="in_keterangan" name="keterangan[]" value="<?= $val->keterangan; ?>" type="text" class="form-control grupTempat" placeholder="Keterangan">
                                                                <div class="invalid-feedback" id="pesan_keterangan"></div>
                                                            </td> 
                                                        </tr>

                                                    <?php } ?>




                                                    <?php 
                                                    $idTbl2=$val->uptd;

                                                    ?>

                                                <?php } ?>

                                            </tbody>
                                            <!-- End Sini Gan -->


                                        </tbody>


                                    </table>
                                    <div class="row col-sm-12 text-right" id="btnTambahLokasi"><buttom class="btn btn-danger btn-sm col-12 mt-3" onclick="tempatIsian()">Tambah kolom</buttom></div>
                                </div>
                            </div>
                            <!-- Akhir Table -->


                        </div>

                        <div class="modal-footer justify-content-between">
                            <div class="row">
                              <a href="<?= base_url(); ?>SdmOp3A/getDetailData/<?= $id; ?>" class="btn btn-default btn-sm" title="Kembali"><i class="fa fa-undo"></i> Kembali</a>
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

    var indexData=0,
    indexKuning= <?= $nomorKuning; ?>+1;



    tempatIsianHapus = function(index){

        $(`#bosTempatisiPerkakas-${index}`).remove();

    }

    hapusKuning = function (id) {
        $(`.indexKuningke-${id}`).remove();
        $(`.indexPutihke-${id}`).remove();

    }


    tempatIsian = async function () {
        try {

         await indexData++;
         await indexKuning++;

         let html = `<tbody id="bosTempatisiPerkakas-${indexKuning}">
         <tr class="bg-warning">
         <td>${indexKuning}<br><buttom class="btn btn-danger btn-sm" onclick="tempatIsianHapus(${indexKuning})">X</buttom></td>
         <td colspan="15"><div class="row col-sm-12">
         <div class="col-sm-3">
         <div class="form-group">
         <label for="in_idTempat-1">Kantor UPTD/Pengamat</label>
         <input id="in_alamat-1" name="uptd[${indexKuning}]" value="" type="text" class="form-control grupTempatF dampak_idTempat"  placeholder="Kantor UPTD/Pengamat" noklaster="" required>
         <div class="invalid-feedback" id="pesan_idTempat"></div>
         </div>
         </div> 
         <div class="col-sm-3">
         <div class="form-group">
         <label for="in_nama-1">Nama Kantor</label>
         <input id="in_nama-1" name="nama[${indexKuning}]" value="" type="text" class="form-control grupTempatF dampak_idTempat" noklaster="0"  placeholder="Nama Kantor" required>
         <div class="invalid-feedback" id="pesan_nama"></div>
         </div>
         </div> 
         <div class="col-sm-3">
         <div class="form-group">
         <label for="in_alamat-1">Alamat</label>
         <input id="in_alamat-1" name="alamat[${indexKuning}]" value="" type="text" class="form-control grupTempatF dampak_idTempat"  placeholder="Alamat" noklaster="" required>
         <div class="invalid-feedback" id="pesan_alamat"></div>
         </div>
         </div> 
         </div>
         </td>
         </tr>
         <tr id="tr_aLabel_13">
         <td style="width:2%;">1</td>

         <td class="col-sm-3" style="min-width:200px;">                        
         <input id="in_labelid" name="nm_label[]" value="UPTD/Pengamat" class="form-control grupTempat">
         <div class="invalid-feedback" id="pesan_labelid"></div>
         </td>
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_jmlOrg" name="jmlOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Jumlah (Orang)">
         <div class="invalid-feedback" id="pesan_jmlOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_stPnsOrg" name="stPnsOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Status PNS (Orang)">
         <div class="invalid-feedback" id="pesan_stPnsOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_stNonPnsOrg" name="stNonPnsOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Status Non PNS?Harian (Orang)">
         <div class="invalid-feedback" id="pesan_stNonPnsOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendS1Org" name="pendS1Org[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan S1/D4 (Orang)">
         <div class="invalid-feedback" id="pesan_pendS1Org"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendD3Org" name="pendD3Org[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan D3 (Orang)">
         <div class="invalid-feedback" id="pesan_pendD3Org"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendSltaOrg" name="pendSltaOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SLTA (Orang)">
         <div class="invalid-feedback" id="pesan_pendSltaOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendSltpOrg" name="pendSltpOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SLTP (Orang)">
         <div class="invalid-feedback" id="pesan_pendSltpOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendSdOrg" name="pendSdOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SD (Orang)">
         <div class="invalid-feedback" id="pesan_pendSdOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_usiaAtas59" name="usiaAtas59[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia>50 (Orang)">
         <div class="invalid-feedback" id="pesan_usiaAtas59"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_usiaAntara40d59" name="usiaAntara40d59[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia 40-50 (Orang)">
         <div class="invalid-feedback" id="pesan_usiaAntara40d59"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_usiaKurang40" name="usiaKurang40[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia<40 (Orang)">
         <div class="invalid-feedback" id="pesan_usiaKurang40"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_kebutuhan" name="kebutuhan[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Kebutuhan (Orang)">
         <div class="invalid-feedback" id="pesan_kebutuhan"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_kekurangan" name="kekurangan[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Kekurangan (Orang)">
         <div class="invalid-feedback" id="pesan_kekurangan"></div>
         </td> 
         <td class="col-sm-3" style="min-width:250px; max-width:30%; ">
         <input id="in_keterangan" name="keterangan[]" value="" type="text" class="form-control grupTempat" placeholder="Keterangan">
         <div class="invalid-feedback" id="pesan_keterangan"></div>
         </td> 
         </tr>


         <tr id="tr_aLabel_14">
         <td style="width:2%;">2</td>
         <td class="col-sm-3" style="min-width:200px;">           
         <input id="in_labelid" name="nm_label[]" value="Staf UPTD/Pengamat" class="form-control grupTempat">
         <div class="invalid-feedback" id="pesan_labelid"></div>
         </td>
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_jmlOrg" name="jmlOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Jumlah (Orang)">
         <div class="invalid-feedback" id="pesan_jmlOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_stPnsOrg" name="stPnsOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Status PNS (Orang)">
         <div class="invalid-feedback" id="pesan_stPnsOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_stNonPnsOrg" name="stNonPnsOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Status Non PNS?Harian (Orang)">
         <div class="invalid-feedback" id="pesan_stNonPnsOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendS1Org" name="pendS1Org[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan S1/D4 (Orang)">
         <div class="invalid-feedback" id="pesan_pendS1Org"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendD3Org" name="pendD3Org[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan D3 (Orang)">
         <div class="invalid-feedback" id="pesan_pendD3Org"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendSltaOrg" name="pendSltaOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SLTA (Orang)">
         <div class="invalid-feedback" id="pesan_pendSltaOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendSltpOrg" name="pendSltpOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SLTP (Orang)">
         <div class="invalid-feedback" id="pesan_pendSltpOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendSdOrg" name="pendSdOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SD (Orang)">
         <div class="invalid-feedback" id="pesan_pendSdOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_usiaAtas59" name="usiaAtas59[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia>50 (Orang)">
         <div class="invalid-feedback" id="pesan_usiaAtas59"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_usiaAntara40d59" name="usiaAntara40d59[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia 40-50 (Orang)">
         <div class="invalid-feedback" id="pesan_usiaAntara40d59"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_usiaKurang40" name="usiaKurang40[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia<40 (Orang)">
         <div class="invalid-feedback" id="pesan_usiaKurang40"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_kebutuhan" name="kebutuhan[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Kebutuhan (Orang)">
         <div class="invalid-feedback" id="pesan_kebutuhan"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_kekurangan" name="kekurangan[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Kekurangan (Orang)">
         <div class="invalid-feedback" id="pesan_kekurangan"></div>
         </td> 
         <td class="col-sm-3" style="min-width:250px; max-width:30%; ">
         <input id="in_keterangan" name="keterangan[]" value="" type="text" class="form-control grupTempat" placeholder="Keterangan">
         <div class="invalid-feedback" id="pesan_keterangan"></div>
         </td>
         </tr>


         <tr id="tr_aLabel_14">
         <td style="width:2%;">3</td>
         <td class="col-sm-3" style="min-width:200px;">           
         <input id="in_labelid" name="nm_label[]" value="Juru / Mantri Pengairan" class="form-control grupTempat">
         <div class="invalid-feedback" id="pesan_labelid"></div>
         </td>
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_jmlOrg" name="jmlOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Jumlah (Orang)">
         <div class="invalid-feedback" id="pesan_jmlOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_stPnsOrg" name="stPnsOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Status PNS (Orang)">
         <div class="invalid-feedback" id="pesan_stPnsOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_stNonPnsOrg" name="stNonPnsOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Status Non PNS?Harian (Orang)">
         <div class="invalid-feedback" id="pesan_stNonPnsOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendS1Org" name="pendS1Org[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan S1/D4 (Orang)">
         <div class="invalid-feedback" id="pesan_pendS1Org"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendD3Org" name="pendD3Org[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan D3 (Orang)">
         <div class="invalid-feedback" id="pesan_pendD3Org"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendSltaOrg" name="pendSltaOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SLTA (Orang)">
         <div class="invalid-feedback" id="pesan_pendSltaOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendSltpOrg" name="pendSltpOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SLTP (Orang)">
         <div class="invalid-feedback" id="pesan_pendSltpOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendSdOrg" name="pendSdOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SD (Orang)">
         <div class="invalid-feedback" id="pesan_pendSdOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_usiaAtas59" name="usiaAtas59[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia>50 (Orang)">
         <div class="invalid-feedback" id="pesan_usiaAtas59"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_usiaAntara40d59" name="usiaAntara40d59[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia 40-50 (Orang)">
         <div class="invalid-feedback" id="pesan_usiaAntara40d59"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_usiaKurang40" name="usiaKurang40[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia<40 (Orang)">
         <div class="invalid-feedback" id="pesan_usiaKurang40"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_kebutuhan" name="kebutuhan[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Kebutuhan (Orang)">
         <div class="invalid-feedback" id="pesan_kebutuhan"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_kekurangan" name="kekurangan[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Kekurangan (Orang)">
         <div class="invalid-feedback" id="pesan_kekurangan"></div>
         </td> 
         <td class="col-sm-3" style="min-width:250px; max-width:30%; ">
         <input id="in_keterangan" name="keterangan[]" value="" type="text" class="form-control grupTempat" placeholder="Keterangan">
         <div class="invalid-feedback" id="pesan_keterangan"></div>
         </td>
         </tr>

         <tr id="tr_aLabel_14">
         <td style="width:2%;">4</td>
         <td class="col-sm-3" style="min-width:200px;">           
         <input id="in_labelid" name="nm_label[]" value="Petugas Operasi Bendung/Pompa" class="form-control grupTempat">
         <div class="invalid-feedback" id="pesan_labelid"></div>
         </td>
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_jmlOrg" name="jmlOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Jumlah (Orang)">
         <div class="invalid-feedback" id="pesan_jmlOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_stPnsOrg" name="stPnsOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Status PNS (Orang)">
         <div class="invalid-feedback" id="pesan_stPnsOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_stNonPnsOrg" name="stNonPnsOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Status Non PNS?Harian (Orang)">
         <div class="invalid-feedback" id="pesan_stNonPnsOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendS1Org" name="pendS1Org[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan S1/D4 (Orang)">
         <div class="invalid-feedback" id="pesan_pendS1Org"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendD3Org" name="pendD3Org[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan D3 (Orang)">
         <div class="invalid-feedback" id="pesan_pendD3Org"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendSltaOrg" name="pendSltaOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SLTA (Orang)">
         <div class="invalid-feedback" id="pesan_pendSltaOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendSltpOrg" name="pendSltpOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SLTP (Orang)">
         <div class="invalid-feedback" id="pesan_pendSltpOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendSdOrg" name="pendSdOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SD (Orang)">
         <div class="invalid-feedback" id="pesan_pendSdOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_usiaAtas59" name="usiaAtas59[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia>50 (Orang)">
         <div class="invalid-feedback" id="pesan_usiaAtas59"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_usiaAntara40d59" name="usiaAntara40d59[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia 40-50 (Orang)">
         <div class="invalid-feedback" id="pesan_usiaAntara40d59"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_usiaKurang40" name="usiaKurang40[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia<40 (Orang)">
         <div class="invalid-feedback" id="pesan_usiaKurang40"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_kebutuhan" name="kebutuhan[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Kebutuhan (Orang)">
         <div class="invalid-feedback" id="pesan_kebutuhan"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_kekurangan" name="kekurangan[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Kekurangan (Orang)">
         <div class="invalid-feedback" id="pesan_kekurangan"></div>
         </td> 
         <td class="col-sm-3" style="min-width:250px; max-width:30%; ">
         <input id="in_keterangan" name="keterangan[]" value="" type="text" class="form-control grupTempat" placeholder="Keterangan">
         <div class="invalid-feedback" id="pesan_keterangan"></div>
         </td>
         </tr>

         <tr id="tr_aLabel_14">
         <td style="width:2%;">5</td>
         <td class="col-sm-3" style="min-width:200px;">           
         <input id="in_labelid" name="nm_label[]" value="Pekerja / Pekarya Saluran" class="form-control grupTempat">
         <div class="invalid-feedback" id="pesan_labelid"></div>
         </td>
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_jmlOrg" name="jmlOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Jumlah (Orang)">
         <div class="invalid-feedback" id="pesan_jmlOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_stPnsOrg" name="stPnsOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Status PNS (Orang)">
         <div class="invalid-feedback" id="pesan_stPnsOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_stNonPnsOrg" name="stNonPnsOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Status Non PNS?Harian (Orang)">
         <div class="invalid-feedback" id="pesan_stNonPnsOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendS1Org" name="pendS1Org[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan S1/D4 (Orang)">
         <div class="invalid-feedback" id="pesan_pendS1Org"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendD3Org" name="pendD3Org[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan D3 (Orang)">
         <div class="invalid-feedback" id="pesan_pendD3Org"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendSltaOrg" name="pendSltaOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SLTA (Orang)">
         <div class="invalid-feedback" id="pesan_pendSltaOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendSltpOrg" name="pendSltpOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SLTP (Orang)">
         <div class="invalid-feedback" id="pesan_pendSltpOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendSdOrg" name="pendSdOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SD (Orang)">
         <div class="invalid-feedback" id="pesan_pendSdOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_usiaAtas59" name="usiaAtas59[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia>50 (Orang)">
         <div class="invalid-feedback" id="pesan_usiaAtas59"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_usiaAntara40d59" name="usiaAntara40d59[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia 40-50 (Orang)">
         <div class="invalid-feedback" id="pesan_usiaAntara40d59"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_usiaKurang40" name="usiaKurang40[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia<40 (Orang)">
         <div class="invalid-feedback" id="pesan_usiaKurang40"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_kebutuhan" name="kebutuhan[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Kebutuhan (Orang)">
         <div class="invalid-feedback" id="pesan_kebutuhan"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_kekurangan" name="kekurangan[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Kekurangan (Orang)">
         <div class="invalid-feedback" id="pesan_kekurangan"></div>
         </td> 
         <td class="col-sm-3" style="min-width:250px; max-width:30%; ">
         <input id="in_keterangan" name="keterangan[]" value="" type="text" class="form-control grupTempat" placeholder="Keterangan">
         <div class="invalid-feedback" id="pesan_keterangan"></div>
         </td>
         </tr>

         <tr id="tr_aLabel_14">
         <td style="width:2%;">6</td>
         <td class="col-sm-3" style="min-width:200px;">           
         <input id="in_labelid" name="nm_label[]" value="Petugas Pintu Air" class="form-control grupTempat">
         <div class="invalid-feedback" id="pesan_labelid"></div>
         </td>
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_jmlOrg" name="jmlOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Jumlah (Orang)">
         <div class="invalid-feedback" id="pesan_jmlOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_stPnsOrg" name="stPnsOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Status PNS (Orang)">
         <div class="invalid-feedback" id="pesan_stPnsOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_stNonPnsOrg" name="stNonPnsOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Status Non PNS?Harian (Orang)">
         <div class="invalid-feedback" id="pesan_stNonPnsOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendS1Org" name="pendS1Org[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan S1/D4 (Orang)">
         <div class="invalid-feedback" id="pesan_pendS1Org"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendD3Org" name="pendD3Org[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan D3 (Orang)">
         <div class="invalid-feedback" id="pesan_pendD3Org"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendSltaOrg" name="pendSltaOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SLTA (Orang)">
         <div class="invalid-feedback" id="pesan_pendSltaOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendSltpOrg" name="pendSltpOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SLTP (Orang)">
         <div class="invalid-feedback" id="pesan_pendSltpOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendSdOrg" name="pendSdOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SD (Orang)">
         <div class="invalid-feedback" id="pesan_pendSdOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_usiaAtas59" name="usiaAtas59[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia>50 (Orang)">
         <div class="invalid-feedback" id="pesan_usiaAtas59"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_usiaAntara40d59" name="usiaAntara40d59[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia 40-50 (Orang)">
         <div class="invalid-feedback" id="pesan_usiaAntara40d59"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_usiaKurang40" name="usiaKurang40[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia<40 (Orang)">
         <div class="invalid-feedback" id="pesan_usiaKurang40"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_kebutuhan" name="kebutuhan[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Kebutuhan (Orang)">
         <div class="invalid-feedback" id="pesan_kebutuhan"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_kekurangan" name="kekurangan[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Kekurangan (Orang)">
         <div class="invalid-feedback" id="pesan_kekurangan"></div>
         </td> 
         <td class="col-sm-3" style="min-width:250px; max-width:30%; ">
         <input id="in_keterangan" name="keterangan[]" value="" type="text" class="form-control grupTempat" placeholder="Keterangan">
         <div class="invalid-feedback" id="pesan_keterangan"></div>
         </td>
         </tr>


         <tr id="tr_aLabel_14">
         <td style="width:2%;">7</td>
         <td class="col-sm-3" style="min-width:200px;">           
         <input id="in_labelid" name="nm_label[]" value="Pekerja / Pekarya Saluran" class="form-control grupTempat">
         <div class="invalid-feedback" id="pesan_labelid"></div>
         </td>
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_jmlOrg" name="jmlOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Jumlah (Orang)">
         <div class="invalid-feedback" id="pesan_jmlOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_stPnsOrg" name="stPnsOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Status PNS (Orang)">
         <div class="invalid-feedback" id="pesan_stPnsOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_stNonPnsOrg" name="stNonPnsOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Status Non PNS?Harian (Orang)">
         <div class="invalid-feedback" id="pesan_stNonPnsOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendS1Org" name="pendS1Org[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan S1/D4 (Orang)">
         <div class="invalid-feedback" id="pesan_pendS1Org"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendD3Org" name="pendD3Org[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan D3 (Orang)">
         <div class="invalid-feedback" id="pesan_pendD3Org"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendSltaOrg" name="pendSltaOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SLTA (Orang)">
         <div class="invalid-feedback" id="pesan_pendSltaOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendSltpOrg" name="pendSltpOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SLTP (Orang)">
         <div class="invalid-feedback" id="pesan_pendSltpOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendSdOrg" name="pendSdOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SD (Orang)">
         <div class="invalid-feedback" id="pesan_pendSdOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_usiaAtas59" name="usiaAtas59[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia>50 (Orang)">
         <div class="invalid-feedback" id="pesan_usiaAtas59"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_usiaAntara40d59" name="usiaAntara40d59[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia 40-50 (Orang)">
         <div class="invalid-feedback" id="pesan_usiaAntara40d59"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_usiaKurang40" name="usiaKurang40[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia<40 (Orang)">
         <div class="invalid-feedback" id="pesan_usiaKurang40"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_kebutuhan" name="kebutuhan[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Kebutuhan (Orang)">
         <div class="invalid-feedback" id="pesan_kebutuhan"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_kekurangan" name="kekurangan[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Kekurangan (Orang)">
         <div class="invalid-feedback" id="pesan_kekurangan"></div>
         </td> 
         <td class="col-sm-3" style="min-width:250px; max-width:30%; ">
         <input id="in_keterangan" name="keterangan[]" value="" type="text" class="form-control grupTempat" placeholder="Keterangan">
         <div class="invalid-feedback" id="pesan_keterangan"></div>
         </td>
         </tr>

         <tr id="tr_aLabel_14">
         <td style="width:2%;">8</td>
         <td class="col-sm-3" style="min-width:200px;">           
         <input id="in_labelid" name="nm_label[]" value="Lainnya." class="form-control grupTempat">
         <div class="invalid-feedback" id="pesan_labelid"></div>
         </td>
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_jmlOrg" name="jmlOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Jumlah (Orang)">
         <div class="invalid-feedback" id="pesan_jmlOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_stPnsOrg" name="stPnsOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Status PNS (Orang)">
         <div class="invalid-feedback" id="pesan_stPnsOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_stNonPnsOrg" name="stNonPnsOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Status Non PNS?Harian (Orang)">
         <div class="invalid-feedback" id="pesan_stNonPnsOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendS1Org" name="pendS1Org[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan S1/D4 (Orang)">
         <div class="invalid-feedback" id="pesan_pendS1Org"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendD3Org" name="pendD3Org[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan D3 (Orang)">
         <div class="invalid-feedback" id="pesan_pendD3Org"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendSltaOrg" name="pendSltaOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SLTA (Orang)">
         <div class="invalid-feedback" id="pesan_pendSltaOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendSltpOrg" name="pendSltpOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SLTP (Orang)">
         <div class="invalid-feedback" id="pesan_pendSltpOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_pendSdOrg" name="pendSdOrg[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Pendidikan SD (Orang)">
         <div class="invalid-feedback" id="pesan_pendSdOrg"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_usiaAtas59" name="usiaAtas59[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia>50 (Orang)">
         <div class="invalid-feedback" id="pesan_usiaAtas59"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_usiaAntara40d59" name="usiaAntara40d59[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia 40-50 (Orang)">
         <div class="invalid-feedback" id="pesan_usiaAntara40d59"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_usiaKurang40" name="usiaKurang40[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Usia<40 (Orang)">
         <div class="invalid-feedback" id="pesan_usiaKurang40"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_kebutuhan" name="kebutuhan[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Kebutuhan (Orang)">
         <div class="invalid-feedback" id="pesan_kebutuhan"></div>
         </td> 
         <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
         <input id="in_kekurangan" name="kekurangan[]" value="" type="text" class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  placeholder="Kekurangan (Orang)">
         <div class="invalid-feedback" id="pesan_kekurangan"></div>
         </td> 
         <td class="col-sm-3" style="min-width:250px; max-width:30%; ">
         <input id="in_keterangan" name="keterangan[]" value="" type="text" class="form-control grupTempat" placeholder="Keterangan">
         <div class="invalid-feedback" id="pesan_keterangan"></div>
         </td>
         </tr>
         </tbody>`;

         $(".table").append(html);


         $(`#in_idTempat-${indexKuning}`).select2({
            theme: 'default'
        });



     }catch(err){
        alert(err)
    }                        

}

$(document).on('change', '.select2[name="idTempat[]"]', function() {
    let selectedIndex = $('.select2[name="idTempat[]"]').index(this),
    selectedValue = $(this).val(),
    selectedIndexKurang = selectedIndex+1; 


    ajaxUntukSemua(base_url()+'SdmOp3A/getAlamatKantor', {valueOption:selectedValue}, function(data) {

        $(`#in_nama-${selectedIndexKurang}`).val(data.data.nama);
        $(`#in_alamat-${selectedIndexKurang}`).val(data.data.alamat);

    }, function(error) {
        console.log('Kesalahan:', error);
    });


});


$('#provid').change(function() {
    var prov = $(this).val();

    ajaxUntukSemua(base_url()+'SdmOp3A/getDataKabKota', {prov}, function(data) {

        let opt = `<option value="" selected disabled>- Plih Kab/Kota -</option>`;

        $.each(data, function(key, value) {
            opt += `<option value="${value.kotakabid}" >${value.kemendagri}</option>`;
        })

        $('#kotakabid').html(opt);

    }, function(error) {
        console.log('Kesalahan:', error);
    });


});

});

</script>