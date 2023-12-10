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
                        <h4 class="m-0" id="titleBox">Form 3B : PENUNJ. OP</h4>
                    </div>

                    <div class="col-5 text-right">
                        <a href="<?= base_url(); ?>SdmOp3B" class="btn btn-default btn-sm" aksi="table" title="Kembali"><i class="fas fa-home"></i> Kembali</a>

                        <?php if ($this->session->userdata('prive') == 'pemda' or $this->session->userdata('prive') == 'admin' or $this->session->userdata('prive') == 'provinsi') { ?>

                            <a href="<?= base_url(); ?>SdmOp3B/editData/<?= $dataHeader->id; ?>" class="btn btn-primary btn-sm" aksi="ubah" title="Ubah data"><i class="far fa-edit"></i> Ubah</a>

                        <?php } ?>

                        <button onclick="cetakPdf();" class="btn btn-info btn-sm"><i class="fas fa-print"></i> Cetak</button>

                        <?php if ($this->session->userdata('prive') == 'pemda' or $this->session->userdata('prive') == 'admin' or $this->session->userdata('prive') == 'provinsi') { ?>
                            <button onclick="deleteData('<?= $dataHeader->id; ?>')" class="btn btn-danger btn-sm" aksi="delete" title="Hapus data"><i class="far fa-trash-alt"></i> Hapus</button>
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
                    <div class="row">
                        <div class="col-sm-6"> 
                            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                                <div class="row p-0 m-0">
                                    <label id="label_irigasiid" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_irigasiid" style="background-color:#e6e6e6;">Provinsi</label>
                                    <div class="col-sm-6 pr-2 m-0 row">
                                        <div class="" id="isi_irigasiid"><?= $dataHeader->provinsi; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6"> 
                            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                                <div class="row p-0 m-0">
                                    <label id="label_irigasiid" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_irigasiid" style="background-color:#e6e6e6;">Kota/Kabupaten</label>
                                    <div class="col-sm-6 pr-2 m-0 row">
                                        <div class="" id="isi_irigasiid"><?= $dataHeader->kemendagri; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6"> 
                            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                                <div class="row p-0 m-0">
                                    <label id="label_irigasiid" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_irigasiid" style="background-color:#e6e6e6;">Jumlah DI (Buah)</label>
                                    <div class="col-sm-6 pr-2 m-0 row">
                                        <div class="" id="isi_irigasiid"><?= $dataHeader->jmlDI; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6"> 
                            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                                <div class="row p-0 m-0">
                                    <label id="label_irigasiid" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_irigasiid" style="background-color:#e6e6e6;">Luas DI (Ha)</label>
                                    <div class="col-sm-6 pr-2 m-0 row">
                                        <div class="" id="isi_irigasiid"><?= $dataHeader->luasDI; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6"> 
                            <div class="form-group p-0" style="border-bottom:1px solid #ccc;">
                                <div class="row p-0 m-0">
                                    <label id="label_irigasiid" class="ml-2 col-sm-5 p-0 m-0 labelTh" idinput="isi_irigasiid" style="background-color:#e6e6e6;">Alokasi APBD O&P Irigasi TA <?= $this->session->userdata('thang'); ?> (Rp)</label>
                                    <div class="col-sm-6 pr-2 m-0 row">
                                        <div class="" id="isi_irigasiid"><?= $dataHeader->luasDI; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 p-1" style="background-color:#ccc; border:0px;">
                        <div class="p-0 m-0" style="border:0px;">
                            <h5 class="card-title">DATA ORGANISASI PERSONALIA OPERASI DAN PEMELIHARAAN</h5>
                        </div>
                    </div>

                    <!-- Tabel -->
                    <table class="table" border="1" style="font-size:12px;">
                        <thead>
                            <tr>
                                <th colspan="1" rowspan="1" class="text-center">NO</th>
                                <th colspan="1" rowspan="1" class="text-center">SARANA PENUNJANG O&amp;P</th>
                                <th colspan="1" rowspan="1" class="text-center">ADA/TIDAK ADA</th>
                                <th colspan="1" rowspan="1" class="text-center">JUMLAH (BUAH)</th>
                                <th colspan="1" rowspan="1" class="text-center">KONDISI (LAYAK/TIDAK LAYAK)</th>
                                <th colspan="1" rowspan="1" class="text-center">KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody id="boxTable">

                            <?php 

                            $noKuning = 1;
                            $noKategori = 1;

                            $kantor = '';
                            $kategori = '';

                            ?>

                            <?php foreach ($dataBody as $key => $val) { ?>
                                <!-- Kuning -->
                                <?php if ($kantor != $val->nama) { ?>
                                    <tr>
                                        <td><?= $noKuning; ?></td>
                                        <td style="min-width:260px;">
                                            <?= $val->nama; ?><br>
                                            <small><?= $val->alamat; ?></small>
                                        </td>
                                        <td style="background-color:#000;"></td>
                                        <td style="background-color:#000;"></td>
                                        <td style="background-color:#000;"></td>
                                        <td style="min-width:150px; background-color:#000;"></td>
                                    </tr>

                                    <?php 

                                    $noKuning++;
                                    $kantor = $val->nama;

                                    ?>
                                <?php } ?>
                                <!-- End Kuning -->

                                <!-- Kategori -->
                                <?php if ($val->kategori != $kategori) { ?>
                                    <tr>
                                        <td><?= $noKategori; ?></td>
                                        <td><?= $val->kategori; ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>   

                                    <?php 

                                    $kategori = $val->kategori;
                                    $noKategori++;

                                    ?>

                                <?php } ?>
                                <!-- End Kategori -->


                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="">- <?= $val->label; ?></td>
                                    <td class=""><?= $val->stPenunjang; ?></td>
                                    <td class=""><?= $val->jmlOrg; ?></td>
                                    <td class=""><?= $val->stKondisi; ?></td>
                                    <td class=""><?= $val->keterangan; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <!-- End Table -->

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
                url: base_url()+'SdmOp3B/delete',
                type: "post",
                dataType: 'json',
                data: {id},
                success: function (res) {
                  if (res.code != 200 ){
                    alert('Error')
                    return;
                }
                window.location = base_url()+'SdmOp3B';

            }
        });
        }


    });

  }

});
</script>
</body>