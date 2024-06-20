<style type="text/css">
    .fontLabel {
        font-size: 18px;
    }

    .keterangan {
        font-size: 18px;
        color: #bd4242;
        margin-top: -15px;
    }

    .table {
        font-size: 12px;
    }

    .table thead {
        background-color: #18978F;
        color: #fff;
    }

    .table th {
        padding: 4px;
        margin: 0px;
        text-align: center;
        vertical-align: center;
    }

    .table td {
        padding: 4px;
        margin: 0px;
    }

    .number,
    .disabled_nilai {
        text-align: right;
    }

    .tr_0 {
        background-color: #FFF;
    }

    .tr_1 {
        background-color: #F7ECDE;
    }

    tbody tr:hover {
        background-color: #E9DAC1;
    }
</style>
<section class="content">
    <div class="container-fluid">
        <br>
        <div class="row ">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left" style="background-color:rgba(0, 255, 0, 0);">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>Usulan/CheklistSimoniPengendaliBanjir">Rekapitulasi Nasional</a></li>
                    <li class="breadcrumb-item active"><?= $nm_Provinsi; ?></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- Presentase Berdasarkan Status -->
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="mt-4"> REKAPITULASI DOKUMEN URK DAK INFRASTRUKTUR PUPR PENGENDALI BANJIR TA. <?= $this->session->userdata('thang'); ?></h4>
                        <h4 class="mb-2">PROVINSI <?= $nm_Provinsi; ?></h4>
                        <table class="table-bordered tableX mt-3">

                            <thead id="thead_data">

                                <tr id="boxThField1" style="background-color:#18978F; color:#fff;">
                                    <th style="border: thin solid #006666; width: 5%" rowspan="2">No</th>
                                    <th style="border: thin solid #006666; width: 25%;" rowspan="2">Kab/Kota</th>
                                    <th style="border: thin solid #006666;" colspan="11">DOKUMEN</th>
                                </tr>
                                <tr id="boxThField1" style="background-color:#18978F; color:#fff;">
                                    <th class="text-center" style="border: thin solid #006666;">LEMBAR CHECKLIST</th>
                                    <th style="border: thin solid #006666;">SID</th>
                                    <th style="border: thin solid #006666;">DED</th>
                                    <th style="border: thin solid #006666;">KAK</th>
                                    <th style="border: thin solid #006666;">SKEMA JARINGAN</th>
                                    <th style="border: thin solid #006666;">SKEMA BANGUNAN</th>
                                    <th style="border: thin solid #006666;">BC VOLUME</th>
                                    <th style="border: thin solid #006666;">RAB</th>
                                    <th style="border: thin solid #006666;">DOKUMENTASI</th>
                                    <th style="border: thin solid #006666;">AMDAL</th>
                                    <th style="border: thin solid #006666;">SURAT KESEDIAAN OP</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_data">
                                <?php
                                $provinsi = 0;
                                $dataTeknis = 0;
                                $rk = 0;
                                $sid = 0;
                                $ded = 0;
                                $kak = 0;
                                $skema_jaringan = 0;
                                $skema_bangunan = 0;
                                $bc_volume = 0;
                                $rab = 0;
                                $smk3 = 0;
                                $dpa = 0;
                                $dokumentasi = 0;
                                $kebenaran_data = 0;
                                $pemenuhan_kriteria = 0;
                                $penyiapan_lahan = 0;
                                $kesanggupan_op = 0;
                                ?>
                                <?php $no = 1;
                                foreach ($dataRekap as $key => $val) { ?>
                                    <tr style="background-color: #F7ECDE;">
                                        <td class="text-center" style="border: thin solid #006666;"><?= $no++; ?></td>
                                        <td style="text-align: left; border: thin solid #006666;">

                                            <?php if ($this->session->userdata('prive') == 'pemda') { ?>
                                                <?php if ($val->kotakabid == $this->session->userdata('kotakabid')) { ?>
                                                    <a href="<?= base_url(); ?>Usulan/cheklistURKSimoniPengendaliBanjir/<?= $val->kotakabid; ?>"><?= $val->kemendagri; ?></a>
                                                <?php } else { ?>
                                                    <?= $val->kemendagri; ?>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($this->session->userdata('prive') == 'balai') { ?>
                                                    <?php if (in_array($val->kotakabid, $dataBalai)) { ?>
                                                        <a href="<?= base_url(); ?>Usulan/cheklistURKSimoniPengendaliBanjir/<?= $val->kotakabid; ?>"><?= $val->kemendagri; ?></a>
                                                    <?php } else {
                                                        echo $val->kemendagri;
                                                    } ?>
                                                <?php } else { ?>
                                                    <a href="<?= base_url(); ?>Usulan/cheklistURKSimoniPengendaliBanjir/<?= $val->kotakabid; ?>"><?= $val->kemendagri; ?></a>
                                                <?php } ?>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center" style="border: thin solid #006666; width: 8%;">
                                            <?php if ($val->id_lembar_ck_pb != null) { ?>
                                                <?php if ($val->ekstensi_lembar_ck_pb == 'pdf') { ?>
                                                    <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_lembar_ck_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
                                                <?php } else { ?>
                                                    <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_lembar_ck_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
                                                <?php } ?>
                                                <br>
                                                <?= $val->upload_time_lembar_ck_pb; ?>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center" style="border: thin solid #006666; width: 8%;">
                                            <?php if ($val->id_sid_pb != null) { ?>

                                                <?php if ($val->ekstensi_sid_pb == 'pdf') { ?>

                                                    <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_sid_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
                                                <?php } else { ?>
                                                    <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_sid_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
                                                <?php } ?>
                                                <br>
                                                <?= $val->upload_time_sid_pb; ?>

                                            <?php } ?>
                                        </td>

                                        <td class="text-center" style="border: thin solid #006666; width: 8%;">
                                            <?php if ($val->id_ded_pb != null) { ?>

                                                <?php if ($val->ekstensi_ded_pb == 'pdf') { ?>

                                                    <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_ded_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

                                                <?php } else { ?>

                                                    <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_ded_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

                                                <?php } ?>
                                                <br>
                                                <?= $val->upload_time_ded_pb; ?>

                                            <?php } ?>
                                        </td>

                                        <td class="text-center" style="border: thin solid #006666; width: 8%;">
                                            <?php if ($val->id_kak_pb != null) { ?>

                                                <?php if ($val->ekstensi_kak_pb == 'pdf') { ?>

                                                    <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_kak_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

                                                <?php } else { ?>

                                                    <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_kak_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

                                                <?php } ?>
                                                <br>
                                                <?= $val->upload_time_kak_pb; ?>

                                            <?php } ?>
                                        </td>
                                        <td class="text-center" style="border: thin solid #006666; width: 8%;">
                                            <?php if ($val->id_skema_jaringan_pb != null) { ?>

                                                <?php if ($val->ekstensi_skema_jaringan_pb == 'pdf') { ?>

                                                    <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_skema_jaringan_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

                                                <?php } else { ?>

                                                    <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_skema_jaringan_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

                                                <?php } ?>
                                                <br>
                                                <?= $val->upload_time_skema_jaringan_pb; ?>

                                            <?php } ?>
                                        </td>
                                        <td class="text-center" style="border: thin solid #006666; width: 8%;">
                                            <?php if ($val->id_skema_bangunan_pb != null) { ?>

                                                <?php if ($val->ekstensi_skema_bangunan_pb == 'pdf') { ?>

                                                    <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_skema_bangunan_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
                                                <?php } else { ?>

                                                    <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_skema_bangunan_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

                                                <?php } ?>
                                                <br>
                                                <?= $val->upload_time_skema_bangunan_pb; ?>

                                            <?php } ?>
                                        </td>


                                        <td class="text-center" style="border: thin solid #006666; width: 8%;">
                                            <?php if ($val->id_bc_volume_pb != null) { ?>

                                                <?php if ($val->ekstensi_bc_volume_pb == 'pdf') { ?>

                                                    <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_bc_volume_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

                                                <?php } else { ?>

                                                    <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_bc_volume_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

                                                <?php } ?>
                                                <br>
                                                <?= $val->upload_time_bc_volume_pb; ?>

                                            <?php } ?>
                                        </td>

                                        <td class="text-center" style="border: thin solid #006666; width: 8%;">
                                            <?php if ($val->id_rab_pb != null) { ?>

                                                <?php if ($val->ekstensi_rab_pb == 'pdf') { ?>

                                                    <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_rab_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

                                                <?php } else { ?>

                                                    <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_rab_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

                                                <?php } ?>
                                                <br>
                                                <?= $val->upload_time_rab_pb; ?>

                                            <?php } ?>
                                        </td>


                                        <td class="text-center" style="border: thin solid #006666; width: 8%;">
                                            <?php if ($val->id_dokumentasi_pb != null) { ?>

                                                <?php if ($val->ekstensi_dokumentasi_pb == 'pdf') { ?>

                                                    <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_dokumentasi_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

                                                <?php } else { ?>

                                                    <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_dokumentasi_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

                                                <?php } ?>
                                                <br>
                                                <?= $val->upload_time_dokumentasi_pb; ?>

                                            <?php } ?>
                                        </td>


                                        <td class="text-center" style="border: thin solid #006666; width: 8%;">
                                            <?php if ($val->id_dok_amdal_pb != null) { ?>

                                                <?php if ($val->ekstensi_dok_amdal_pb == 'pdf') { ?>

                                                    <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_dok_amdal_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

                                                <?php } else { ?>

                                                    <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_dok_amdal_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

                                                <?php } ?>
                                                <br>
                                                <?= $val->upload_time_dok_amdal_pb; ?>

                                            <?php } ?>
                                        </td>

                                        <td class="text-center" style="border: thin solid #006666; width: 8%;">
                                            <?php if ($val->id_kesediaan_op_pb != null) { ?>
                                                <?php if ($val->ekstensi_kesediaan_op_pb == 'pdf') { ?>
                                                    <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_kesediaan_op_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
                                                <?php } else { ?>

                                                    <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_kesediaan_op_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

                                                <?php } ?>
                                                <br>
                                                <?= $val->upload_time_kesediaan_op_pb; ?>

                                            <?php } ?>
                                        </td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modalURK" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal Download URK</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url(); ?>Usulan/downloadURK" method="POST">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama Pejabat :</label>
                        <input type="text" class="form-control" name="desk" id="desk" required>
                        <input type="hidden" class="form-control" name="kotakabidBa" id="kotakabidBa">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Jabatan :</label>
                        <input type="text" class="form-control" name="nm_verifikator" id="nm_verifikator" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">NIP :</label>
                        <input type="text" class="form-control" name="desk" id="desk" required>
                        <input type="hidden" class="form-control" name="kotakabidBa" id="kotakabidBa">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Paraf :</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fileExcel" name="fileExcel" accept="image/jpeg, image/jpg, image/png" required>
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <script>
                            document.getElementById("fileExcel").addEventListener("change", function() {
                                var fileName = this.files[0].name;
                                var label = document.querySelector(".custom-file-label");
                                label.textContent = fileName;
                            });
                        </script>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">Download</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        showModalURK = function(kotakabid) {
            $('#kotakabidBa').val(kotakabid);
            $('#modalURK').modal('show');
        }

        verifFunc = function(idData, idJnsData, kotakabid) {

            let kondisi = ($(`#${idData}`).prop('checked')) ? '1' : '0';

            ajaxUntukSemua(base_url() + 'VerifDataTeknis/prosesVerif', {
                kondisi,
                idJnsData,
                kotakabid
            }, function(data) {

                if (data.code == 200) {
                    toastr.success('Data berhasil disimpan.!');
                } else {
                    toastr.error('Data gagal disimpan.');
                }

            }, function(error) {
                toastr.error('Error :' + error);

            });


            if (idJnsData == '4') {

                if (kondisi == '1') {
                    $('#idButton' + kotakabid).attr('disabled', false);
                } else {
                    $('#idButton' + kotakabid).attr('disabled', true);
                }

            }



        }

    })
</script>