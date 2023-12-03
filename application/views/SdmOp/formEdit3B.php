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
    <div class="" > <!-- content-wrapper -->

        <div class="row m-0" >
          <!-- panel panel-default -->
          <div class="col-lg-12 p-0" >
            <form role="form" action="<?= base_url(); ?>SdmOp3B/SimpanDataEdit" method="POST" >
                <input type="hidden" name="idEdit" value="<?= $id; ?>">
                <div class="content-header bg-warning">
                    <div class="container-fluid">
                      <div class="row m-0 p-0 text-left">
                        <div class="col-sm-7">
                            <h4 class="m-0">Form 3B : PENUNJ. OP</h4>
                        </div>

                        <div class="col-sm-5 text-right">
                            <a href="<?= base_url(); ?>SdmOp3B/getDetailData/<?= $id; ?>" class="btn btn-default btn-sm" title="Batal"><i class="fas fa-file"></i> Batal</a>
                            <button type="submit" class="btn btn-primary btn-sm btn-simpan"><i class="fas fa-archive"></i> Simpan Perubahan</button>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content" >

                <div class="container-fluid" >

                    <!-- box data teknis -->
                    <div class="row" >

                        <div class="card-body p-0 " >



                            <!-- form start -->
                            <div class="modal-body" >

                                <?= $this->session->flashdata('psn'); ?>

                                <div style="background-color:red; color:#fff;">
                                </div>

                                <div class="row">

                                    <div class="col-sm-12 col-lg-3" > 
                                        <div class="form-group" >
                                            <label for="provid">Provinsi  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                            <select id="provid" name="provid" class="form-control select2" required>
                                             <option value="<?= $dataHeader->provid; ?>"><?= $dataHeader->provinsi; ?></option>
                                         </select>
                                         <div class="invalid-feedback" id="pesan_irigasiid"></div>
                                     </div>
                                 </div>

                                 <div class="col-sm-12 col-lg-3" > 
                                    <div class="form-group" >
                                        <label for="kotakabid">Kota/Kab  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                        <select id="kotakabid" name="kotakabid" class="form-control select2" required>

                                           <option value="<?= $dataHeader->kotakabid; ?>"><?= $dataHeader->kemendagri; ?></option>

                                       </select>
                                       <div class="invalid-feedback" id="pesan_irigasiid"></div>
                                   </div>
                               </div> 

                               <div class="col-sm-12 col-lg-3" > 
                                <div class="form-group" >
                                    <label for="in_jmlDI">Jumlah DI (Buah)  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                    <input id="in_jmlDI" name="jmlDI" value="<?= str_replace('.', ',', $dataHeader->jmlDI); ?>" type="text" class="form-control text-right number" oninput="this.value = this.value.replace(/[^0-9]/g, '')"  required placeholder="Jumlah DI (Buah)" required>
                                </div>
                            </div>

                            <div class="col-sm-12 col-lg-3" > 
                                <div class="form-group" >
                                    <label for="luasDI">Luas DI (Ha)  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                    <input id="luasDI" name="luasDI" value="<?= str_replace('.', ',', $dataHeader->luasDI); ?>" type="text" class="form-control text-right number" oninput="this.value = this.value.replace(/[^0-9,]/g, '')"  required placeholder="Luas DI (Ha)" required>
                                </div>
                            </div> 

                            <div class="col-sm-12 col-lg-3" > 
                                <div class="form-group" >
                                    <label for="alokasiApbn">Alokasi APBD O&P Irigasi TA <?= $this->session->userdata('thang'); ?> (Rp)  <span class="text-danger" title="Wajib di Isi">*</span></label>
                                    <input id="alokasiApbn" name="alokasiApbn" value="<?= str_replace('.', ',', $dataHeader->alokasiApbn); ?>" type="text" class="form-control text-right number" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  required placeholder="Alokasi APBD O&P Irigasi TA <?= $this->session->userdata('thang'); ?> (Rp)" required>
                                </div>
                            </div> 

                        </div>


                        <!-- Tabel Awal -->
                        <div id="boxFormLain" style="border:thin solid #ccc;">
                            <!-- <div class="row col-sm-12 bg-info mb-2 text-center" style="padding:2px; margin:0px;"><b>DATA ORGANISASI PERSONALIA OPERASI DAN PEMELIHARAAN</b></div> -->

                            <div class="card-body table-responsive p-0  tableFixHead divTable" style="position: relative; overflow-y: scroll; height: 92vh; width:96.6vw; background-color:#efebe9; padding:2px; border:thin solid #ccc;" >
                                <table class="table">

                                    <tbody id="boxTempatList" >
                                        <thead>
                                            <tr id="boxThField0" style="background-color:#18978F; color:#fff;">
                                                <th style="border: thin solid #006666; " colspan="1" rowspan="1" class="text-center">NO</th>
                                                <th style="border: thin solid #006666; " colspan="1" rowspan="1" class="text-center">SARANA PENUNJANG O&amp;P</th>
                                                <th style="border: thin solid #006666; " colspan="1" rowspan="1" class="text-center">ADA/TIDAK ADA</th>
                                                <th style="border: thin solid #006666; " colspan="1" rowspan="1" class="text-center">JUMLAH (BUAH)</th>
                                                <th style="border: thin solid #006666; " colspan="1" rowspan="1" class="text-center"> KONDISI (LAYAK/TIDAK LAYAK)</th>
                                                <th style="border: thin solid #006666; " colspan="1" rowspan="1" class="text-center">KETERANGAN</th>
                                            </tr>
                                        </thead>

                                        <tbody id="bosTempatisiPerkakas-0">
                                            <?php 

                                            $noKuning = 1;
                                            $idTempat = '';

                                            $noKategori = 1;
                                            $nmKategori = '';

                                            ?>
                                            <?php foreach ($dataBody as $key => $val) { ?>

                                                <!-- Kuning -->
                                                <?php if ($idTempat != $val->idTempat) { ?>
                                                    <tr class="bg-warning trHapus<?= $noKuning; ?>">
                                                        <td><?= $noKuning; ?><br><?= ($noKuning > 1) ? '<buttom class="btn btn-danger btn-sm" onclick="hapusManual('.$noKuning.')">X</buttom>':''; ?></td>
                                                        <td colspan="15">
                                                            <div class="row col-sm-12" >
                                                                <div class="col-sm-3" >
                                                                    <div class="form-group" >
                                                                        <label for="in_idTempat-<?= $noKuning; ?>">Kantor UPTD/Pengamat</label>
                                                                        <select id="in_idTempat-<?= $noKuning; ?>" name="idTempat[]" class="form-control grupTempatF select2" required>
                                                                            <option selected="" value="">-pilih-</option>
                                                                            <?php foreach ($dataKantor as $key => $value) { ?>
                                                                                <option value="<?= $value->id; ?>" <?= ($val->idTempat == $value->id) ? 'selected' : ''; ?>><?= $value->nama; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                        <div class="invalid-feedback" id="pesan_idTempat"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div class="form-group">
                                                                        <label for="in_nama-<?= $noKuning; ?>">Nama Kantor</label>
                                                                        <input id="in_nama-<?= $noKuning; ?>" name="nama[]" value="" type="text" required class="form-control grupTempatF dampak_idTempat" noklaster="0" placeholder="Nama Kantor" disabled="">
                                                                        <div class="invalid-feedback" id="pesan_nama"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div class="form-group">
                                                                        <label for="in_alamat-<?= $noKuning; ?>">Alamat</label>
                                                                        <input id="in_alamat-<?= $noKuning; ?>" name="alamat[]" value="" type="text" required class="form-control grupTempatF dampak_idTempat" placeholder="Alamat" noklaster="" disabled="">
                                                                        <div class="invalid-feedback" id="pesan_alamat"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <?php 

                                                    $noKuning++;
                                                    $idTempat = $val->idTempat;
                                                    $noKategori=1;

                                                    ?>

                                                <?php } ?>
                                                <!-- End Kuning -->


                                                <!-- Judul -->
                                                <?php if ($nmKategori != $val->kategori) { ?>
                                                    <tr class="trHapus<?= $noKuning; ?>" style="background-color:#CCC;">
                                                        <td><?= $noKategori; ?></td>
                                                        <td colspan="5"><b><?= $val->kategori; ?></b></td>
                                                    </tr>

                                                    <?php 

                                                    $nmKategori = $val->kategori;
                                                    $noKategori++;
                                                    ?>

                                                <?php } ?>
                                                <!-- End Judul -->


                                                <tr id="tr_aLabel_19 trHapus<?= $noKuning; ?>">
                                                    <td style="width:2%;"></td>
                                                    <td class="col-sm-3" style="min-width:200px;">
                                                        - <?= $val->label; ?>                        
                                                        <input id="in_labelid" name="labelid[]" value="<?= $val->labelid; ?>" class="form-control grupTempat" type="hidden">
                                                        <div class="invalid-feedback" id="pesan_labelid"></div>
                                                    </td>

                                                    <td class="col-sm-3" style="min-width:100px; max-width:10%; ">

                                                        <select id="in_stPenunjang" name="stPenunjang[]" required class="form-control select2">
                                                            <option selected="" value="" >-pilih-</option>
                                                            <option value="Ada" <?= $val->stPenunjang == 'Ada' ? 'selected' : ''; ?>>Ada</option>
                                                            <option value="Tidak Ada" <?= $val->stPenunjang == 'Tidak Ada' ? 'selected' : ''; ?>>Tidak Ada</option>
                                                        </select>
                                                        <div class="invalid-feedback" id="pesan_stPenunjang"></div>

                                                    </td>
                                                    <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                        <input id="in_jmlOrg" name="jmlOrg[]" value="<?= $val->jmlOrg; ?>" type="text" required class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Jumlah (Orang)">
                                                        <div class="invalid-feedback" id="pesan_jmlOrg"></div>
                                                    </td>
                                                    <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
                                                        <select id="in_stKondisi" name="stKondisi[]" class="form-control grupTempat select2" required>
                                                            <option selected="" value="" >-pilih-</option>
                                                            <option class="in_stKondisi_option" value="Layak" <?= $val->stKondisi == 'Layak' ? 'selected' : ''; ?>>Layak</option>
                                                            <option class="in_stKondisi_option" value="Tidak Layak" <?= $val->stKondisi == 'Tidak Layak' ? 'selected' : ''; ?>>Tidak Layak</option>
                                                        </select>
                                                        <div class="invalid-feedback" id="pesan_stKondisi"></div>
                                                    </td>
                                                    <td class="col-sm-3" style="min-width:250px; max-width:30%; ">
                                                        <input id="in_keterangan" name="keterangan[]" value="<?= $val->keterangan; ?>" type="text" class="form-control grupTempat" placeholder="Keterangan">
                                                        <div class="invalid-feedback" id="pesan_keterangan"></div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>

                                    </tbody>


                                </table>
                                <div class="row col-sm-12 text-right" id="btnTambahLokasi"><buttom class="btn btn-danger btn-sm col-12 mt-3" onclick="tempatIsian()">Tambah kolom</buttom></div>
                            </div>
                        </div>
                        <!-- End Tabel Akhir -->


                    </div>

                    <div class="modal-footer justify-content-between">
                        <div class="row">
                            <a href="<?= base_url(); ?>SdmOp3B/<?= $id; ?>" class="btn btn-default btn-sm" title="Batal"><i class="fas fa-file"></i> Batal</a>
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
    indexKuning=<?= $noKuning-1; ?>;



    tempatIsianHapus = function(index){
        indexKuning--;
        indexData--;
        $(`#bosTempatisiPerkakas-${index}`).remove();
    }

    hapusManual = function(index){
        indexKuning--;
        indexData--;
        $(`.trHapus${index}`).remove();
    }


    tempatIsian = async function () {
        try {

           await indexData++;
           await indexKuning++;

           let html = `<tbody id="bosTempatisiPerkakas-${indexKuning}">
           <tr class="bg-warning">
           <td>${indexKuning}<br><buttom class="btn btn-danger btn-sm" onclick="tempatIsianHapus(${indexKuning})">X</buttom></td>
           <td colspan="15">
           <div class="row col-sm-12" >
           <div class="col-sm-3" >
           <div class="form-group" >
           <label for="in_idTempat-${indexKuning}">Kantor UPTD/Pengamat</label>
           <select id="in_idTempat-${indexKuning}" name="idTempat[]" class="form-control grupTempatF select2" required>
           <option selected="" value="">-pilih-</option>
           <?php foreach ($dataKantor as $key => $value) { ?>
               <option value="<?= $value->id; ?>"><?= $value->nama; ?></option>
           <?php } ?>
           </select>
           <div class="invalid-feedback" id="pesan_idTempat"></div>
           </div>
           </div>
           <div class="col-sm-3">
           <div class="form-group">
           <label for="in_nama-${indexKuning}">Nama Kantor</label>
           <input id="in_nama-${indexKuning}" name="nama[]" value="" type="text" required class="form-control grupTempatF dampak_idTempat" noklaster="0" placeholder="Nama Kantor" disabled="">
           <div class="invalid-feedback" id="pesan_nama"></div>
           </div>
           </div>
           <div class="col-sm-3">
           <div class="form-group">
           <label for="in_alamat-${indexKuning}">Alamat</label>
           <input id="in_alamat-${indexKuning}" name="alamat[]" value="" type="text" required class="form-control grupTempatF dampak_idTempat" placeholder="Alamat" noklaster="" disabled="">
           <div class="invalid-feedback" id="pesan_alamat"></div>
           </div>
           </div>
           </div>
           </td>
           </tr>
           <?php 

           $kategoriSaatIni = '';
           $nomorJudul = 1;

           ?>

           <?php foreach ($dataTable as $key => $val) { ?>
               <?php if ($kategoriSaatIni != $val->kategori) { ?>
                   <!-- Judul -->
                   <tr style="background-color:#CCC;">
                   <td><?= $nomorJudul; ?></td>
                   <td colspan="5"><b><?= $val->kategori; ?></b></td>
                   </tr>
                   <!-- End Judul -->
                   <?php 

                   $kategoriSaatIni = $val->kategori;
                   $nomorJudul++;

                   ?>
               <?php } ?>
               <tr id="tr_aLabel_19">
               <td style="width:2%;"></td>
               <td class="col-sm-3" style="min-width:200px;">
               - <?= $val->label; ?>                        
               <input id="in_labelid" name="labelid[]" value="<?= $val->id; ?>" class="form-control grupTempat" type="hidden">
               <div class="invalid-feedback" id="pesan_labelid"></div>
               </td>

               <td class="col-sm-3" style="min-width:100px; max-width:10%; ">

               <select id="in_stPenunjang" name="stPenunjang[]" required class="form-control select2">
               <option selected="" value="" >-pilih-</option>
               <option value="Ada">Ada</option>
               <option value="Tidak Ada">Tidak Ada</option>
               </select>
               <div class="invalid-feedback" id="pesan_stPenunjang"></div>

               </td>
               <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
               <input id="in_jmlOrg" name="jmlOrg[]" value="" type="text" required class="form-control grupTempat angka  text-right" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Jumlah (Orang)">
               <div class="invalid-feedback" id="pesan_jmlOrg"></div>
               </td>
               <td class="col-sm-3" style="min-width:100px; max-width:10%; ">
               <select id="in_stKondisi" name="stKondisi[]" class="form-control grupTempat select2" required>
               <option selected="" value="" >-pilih-</option>
               <option class="in_stKondisi_option" value="Layak" >Layak</option>
               <option class="in_stKondisi_option" value="Tidak Layak" >Tidak Layak</option>
               </select>
               <div class="invalid-feedback" id="pesan_stKondisi"></div>
               </td>
               <td class="col-sm-3" style="min-width:250px; max-width:30%; ">
               <input id="in_keterangan" name="keterangan[]" value="" type="text" class="form-control grupTempat" placeholder="Keterangan">
               <div class="invalid-feedback" id="pesan_keterangan"></div>
               </td>
               </tr>
           <?php } ?>
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


    ajaxUntukSemua(base_url()+'SdmOp3B/getAlamatKantor', {valueOption:selectedValue}, function(data) {

        $(`#in_nama-${selectedIndexKurang}`).val(data.data.nama);
        $(`#in_alamat-${selectedIndexKurang}`).val(data.data.alamat);

    }, function(error) {
        console.log('Kesalahan:', error);
    });


});


$('#provid').change(function() {
    var prov = $(this).val();

    ajaxUntukSemua(base_url()+'SdmOp3B/getDataKabKota', {prov}, function(data) {

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