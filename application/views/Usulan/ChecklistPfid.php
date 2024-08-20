<style type="text/css">
    .fontLabel {
        font-size: 18px;
    }

    .keterangan {
        font-size: 12px;
        color: #bd4242;
        margin-top: -15px;
    }

    .tableX {
        font-size: 14px;
    }

    .tableX thead {
        background-color: #d6d6d6;
        color: solid gray;
    }

    .tableX th {
        padding: 10px;
        margin: 0px;
        text-align: center;
        vertical-align: center;
        font-size: 14px;
        border: 1px solid gray !important;
    }

    .tableX td {
        padding: 4px;
        margin: 0px;
        border: 1px solid gray !important;
    }

    .number,
    ._nilai {
        text-align: right;
    }

    .tabelVerifikasi {
        width: 100%;
        font-size: 14px;
    }

    .tabelVerifikasi td {
        padding: 4px;
        margin: 0px;
        border: 1px solid #9eb9cd !important;
    }


    .tableKomponen {
        width: 100%;
        font-size: 13px;
    }

    .tableKomponen td {
        padding: 4px;
        margin: 0px;
        border: 1px solid #9eb9cd !important;
    }

    tbody tr:hover {
        background-color: #E9DAC1;
    }


    .option-input {
        -webkit-appearance: none;
        -moz-appearance: none;
        -ms-appearance: none;
        -o-appearance: none;
        appearance: none;
        position: relative;
        top: 0px;
        right: 0;
        bottom: 0;
        left: 0;
        height: 28px;
        width: 28px;
        transition: all 0.15s ease-out 0s;
        background: #cbd1d8;
        border: none;
        color: #fff;
        cursor: pointer;
        display: inline-block;
        margin-right: 0.5rem;
        outline: none;
        position: relative;
        z-index: 1000;
    }

    .option-input:hover {
        background: #9faab7;
    }

    .option-input:checked {
        background: #28a745;
    }

    .option-input:checked::before {
        width: 28px;
        height: 28px;
        display: flex;
        content: '\f00c';
        font-size: 15px;
        font-weight: bold;
        position: absolute;
        align-items: center;
        justify-content: center;
        font-family: 'Font Awesome 5 Free';
    }

    .option-input:checked::after {
        -webkit-animation: click-wave 0.65s;
        -moz-animation: click-wave 0.65s;
        animation: click-wave 0.65s;
        background: #28a745;
        content: '';
        display: block;
        position: relative;
        z-index: 100;
    }

    .option-input.radio {
        border-radius: 50%;
    }

    .option-input.radio::after {
        border-radius: 50%;
    }

    @keyframes click-wave {
        0% {
            height: 30px;
            width: 30px;
            opacity: 0.35;
            position: relative;
        }

        100% {
            height: 200px;
            width: 200px;
            margin-left: -80px;
            margin-top: -80px;
            opacity: 0;
        }
    }
</style>
<section class="content">
    <div class="container-fluid">
        <br>


        <div class="row">
            <div class="col-md-12">
                <!-- Presentase Berdasarkan Status -->
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="mt-4"> CHECKLIST PFID</h4>
                        <h4>PENILAIAN DANA ALOKASI KHUSUS BIDANG IRIGASI TA. <?= $this->session->userdata('thang'); ?></h4>
                        <h4 class="mb-2">PROVINSI <?= $nm_prov; ?></h4>
                        <h4 class="mb-2"><?= $nm_kotakab; ?></h4>
                        <br><br>

                        <?= $this->session->flashdata('psn'); ?>
                        <br>

                        <form method="POST" action="<?= base_url(); ?>Usulan/editpfid">
                            <!-- Input tersembunyi untuk ID -->
                            <input type="hidden" name="idEditSimoni" id="idEditSimoni" value="<?= isset($dataKegiatan[0]->id) ? $dataKegiatan[0]->id : ''; ?>">

                            <?php if ($dataKegiatan != null) {
                                usort($dataKegiatan, function ($a, $b) {
                                    $order = ['1', '2', '3', '9'];
                                    $pos_a = array_search($a->kd_menu, $order);
                                    $pos_b = array_search($b->kd_menu, $order);
                                    return $pos_a - $pos_b;
                                }); ?>

                                <?php foreach ($dataKegiatan as $key => $val) { ?>
                                    <div class="card card-info">
                                        <div class="card-header text-left">
                                            <?php
                                            if ($val->kd_menu === '9') {
                                                echo '<b>WS : </b>' . $val->nm_ws;
                                                echo '<br>';
                                                echo '<b>DAS : </b>' . $val->nm_das;
                                            } else {
                                                echo '<b>' . $val->nm_di . '</b>';
                                            } ?>
                                        </div>
                                        <div class="card-body table-responsive">
                                            <div class="row">
                                                <div class="col-2 text-left">
                                                    <label for="laporan_sid">Tahun Laporan SID</label>
                                                    <input type="text" class="form-control" id="laporan_sid" name="laporan_sid" value="<?= cleanStr($val->laporan_sid); ?>" oninput="this.value = this.value.replace(/\D/g, '')">
                                                    <br>
                                                    <label for="laporan_ded">Tahun Laporan DED</label>
                                                    <input type="text" class="form-control" id="laporan_ded" name="laporan_ded" value="<?= $val->laporan_ded; ?>" oninput="this.value = this.value.replace(/\D/g, '')">
                                                    <br>
                                                    <label for="gambar_rencana">Tahun Gambar Rencana</label>
                                                    <input type="text" class="form-control" id="gambar_rencana" name="gambar_rencana" value="<?= $val->gambar_rencana; ?>" oninput="this.value = this.value.replace(/\D/g, '')">
                                                </div>
                                                <div class="col-2">
                                                    <label>Pengamatan Aset</label>
                                                    <br><br>
                                                    <label>Bangunan Utama (bh)</label>
                                                    <br><br>
                                                    <label>Saluran Primer (m)</label>
                                                    <br><br>
                                                    <label>Saluran Sekunder (m)</label>
                                                    <br><br>
                                                    <label>Bangunan Pengatur (bh) <br> (Bagi, Bagi Sadap, Sadap)</label>
                                                </div>
                                                <div class="col-1">
                                                    <label for="aset_bu">Aset</label>
                                                    <input type="text" class="form-control" name="aset_bu" value="<?= cleanStr($val->buBendung); ?>" placeholder="0" disabled>
                                                    <br>
                                                    <input type="text" class="form-control" name="aset_sp" value="<?= cleanStr($val->sPrimer); ?>" placeholder="0" disabled>
                                                    <br>
                                                    <input type="text" class="form-control" name="aset_ss" value="<?= cleanStr($val->sSekunder); ?>" placeholder="0" disabled>
                                                    <br>
                                                    <input type="text" class="form-control" name="aset_bp" value="<?= cleanStr($val->bppBagi + $val->bppBagiSadap + $val->bppSadap); ?>" placeholder="0" disabled>
                                                </div>
                                                <div class="col-2">
                                                    <label for="kondisi_kurang_bu">Kondisi < 60%</label>
                                                            <input type="text" class="form-control" name="kondisi_kurang_bu" id="kondisi_kurang_bu" value="<?= $val->kondisi_kurang_bu; ?>" placeholder="Tidak Ada Data">
                                                            <br>
                                                            <input type="text" class="form-control" name="kondisi_kurang_sp" id="kondisi_kurang_sp" value="<?= $val->kondisi_kurang_sp; ?>" placeholder="Tidak Ada Data">
                                                            <br>
                                                            <input type="text" class="form-control" name="kondisi_kurang_ss" id="kondisi_kurang_ss" value="<?= $val->kondisi_kurang_ss; ?>" placeholder="Tidak Ada Data">
                                                            <br>
                                                            <input type="text" class="form-control" name="kondisi_kurang_bp" id="kondisi_kurang_bp" value="<?= $val->kondisi_kurang_bp; ?>" placeholder="Tidak Ada Data">
                                                </div>
                                                <div class="col-2">
                                                    <label for="kondisi_lebih_bu">Kondisi > 60%</label>
                                                    <input type="text" class="form-control" name="kondisi_lebih_bu" id="kondisi_lebih_bu" value="<?= $val->kondisi_lebih_bu; ?>" placeholder="Tidak Ada Data">
                                                    <br>
                                                    <input type="text" class="form-control" name="kondisi_lebih_sp" id="kondisi_lebih_sp" value="<?= $val->kondisi_lebih_sp; ?>" placeholder="Tidak Ada Data">
                                                    <br>
                                                    <input type="text" class="form-control" name="kondisi_lebih_ss" id="kondisi_lebih_ss" value="<?= $val->kondisi_lebih_ss; ?>" placeholder="Tidak Ada Data">
                                                    <br>
                                                    <input type="text" class="form-control" name="kondisi_lebih_bp" id="kondisi_lebih_bp" value="<?= $val->kondisi_lebih_bp; ?>" placeholder="Tidak Ada Data">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <button class="btn btn-primary m-2" type="submit" style="float:right;"><i class="fa fa-save" aria-hidden="true"></i>&nbsp; SIMPAN</button>
                            <?php } else { ?>
                                <div class="card" style="background-color:brown; color:#fff; padding:2%">DATA KOSONG! <br> SILAHKAN INPUT USULAN RENCANA KEGIATAN TERLEBIH DAHULU!</div>
                            <?php } ?>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Edit Data -->



<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Lembar Checklist PFID</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url(); ?>Usulan/simpanParafPfid" enctype="multipart/form-data">
                <input type="hidden" name="kotakabid" value="<?= $kotakabid; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="output" class="col-form-label">Nama :</label>
                        <input type="text" class="form-control" id="nama" name="nama" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '')" required>
                    </div>
                    <div class="form-group">
                        <label for="output" class="col-form-label">Desk :</label>
                        <input type="text" class="form-control" id="desk" name="desk" oninput="this.value = this.value.replace(/\D/g, '')" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="Submit" class="btn btn-primary">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if ($dataKegiatan != null) {
?>
    <?php foreach ($dataKegiatan as $key => $val) { ?>
        <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Submit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form method="POST" action="<?= base_url(); ?>Usulan/editpfid">
                            <input type="hidden" name="idEditSimoni" id="idEditSimoni">

                            <div class="form-group">
                                <label for="pagu_kegiatan_edit" class="col-form-label">Tahun Laporan SID :</label>
                                <input type="text" class="form-control" id="laporan_sid_edit" name="laporan_sid" oninput="this.value = this.value.replace(/\D/g, '')">
                            </div>
                            <div class="form-group">
                                <label for="pagu_kegiatan_edit" class="col-form-label">Tahun Laporan DED :</label>
                                <input type="text" class="form-control" id="laporan_ded_edit" name="laporan_ded" oninput="this.value = this.value.replace(/\D/g, '')">
                            </div>
                            <div class="form-group">
                                <label for="pagu_kegiatan_edit" class="col-form-label">Tahun Gambar Rencana :</label>
                                <input type="text" class="form-control" id="gambar_rencana_edit" name="gambar_rencana" oninput="this.value = this.value.replace(/\D/g, '')">
                            </div>



                            <div class="form-group">
                                <label for="pagu_kegiatan_edit" class="col-form-label">Kondisi < 60% Bangunan Utama :</label>
                                        <input type="text" class="form-control" id="kondisi_kurang_bu_edit" name="kondisi_kurang_bu" oninput="this.value = this.value.replace(/\D/g, '')">
                            </div>
                            <div class="form-group">
                                <label for="pagu_kegiatan_edit" class="col-form-label">Kondisi < 60% Saluran Primer :</label>
                                        <input type="text" class="form-control" id="kondisi_kurang_sp_edit" name="kondisi_kurang_sp" oninput="this.value = this.value.replace(/\D/g, '')">
                            </div>
                            <div class="form-group">
                                <label for="pagu_kegiatan_edit" class="col-form-label">Kondisi < 60% Saluran Sekunder :</label>
                                        <input type="text" class="form-control" id="kondisi_kurang_ss_edit" name="kondisi_kurang_ss" oninput="this.value = this.value.replace(/\D/g, '')">
                            </div>
                            <div class="form-group">
                                <label for="pagu_kegiatan_edit" class="col-form-label">Kondisi < 60% Bangunan Pengatur :</label>
                                        <input type="text" class="form-control" id="kondisi_kurang_bp_edit" name="kondisi_kurang_bp" oninput="this.value = this.value.replace(/\D/g, '')">
                            </div>
                            <div class="form-group">
                                <label for="pagu_kegiatan_edit" class="col-form-label">Kondisi > 60% Bangunan Utama :</label>
                                <input type="text" class="form-control" id="kondisi_lebih_bu_edit" name="kondisi_lebih_bu" oninput="this.value = this.value.replace(/\D/g, '')">
                            </div>
                            <div class="form-group">
                                <label for="pagu_kegiatan_edit" class="col-form-label">Kondisi > 60% Saluran Primer :</label>
                                <input type="text" class="form-control" id="kondisi_lebih_sp_edit" name="kondisi_lebih_sp" oninput="this.value = this.value.replace(/\D/g, '')">
                            </div>
                            <div class="form-group">
                                <label for="pagu_kegiatan_edit" class="col-form-label">Kondisi > 60% Saluran Sekunder :</label>
                                <input type="text" class="form-control" id="kondisi_lebih_ss_edit" name="kondisi_lebih_ss" oninput="this.value = this.value.replace(/\D/g, '')">
                            </div>
                            <div class="form-group">
                                <label for="pagu_kegiatan_edit" class="col-form-label">Kondisi > 60% Bangunan Pengatur :</label>
                                <input type="text" class="form-control" id="kondisi_lebih_bp_edit" name="kondisi_lebih_bp" oninput="this.value = this.value.replace(/\D/g, '')">
                            </div>
                            <div class="form-group">
                                <label for="pengadaan_edit" class="col-form-label">Kesesuaian Bangunan Utama :</label>
                                <select class="form-control" name="kesesuaian_bu" id="kesesuaian_bu_edit">
                                    <option value="" selected>-- Pilih Kesesuian --</option>
                                    <option value="Sesuai">Sesuai</option>
                                    <option value="Tidak Sesuai">Tidak</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pengadaan_edit" class="col-form-label">Kesesuaian Saluran Primer :</label>
                                <select class="form-control" name="kesesuaian_sp" id="kesesuaian_sp_edit">
                                    <option value="" selected>-- Pilih Kesesuian --</option>
                                    <option value="Sesuai">Sesuai</option>
                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pengadaan_edit" class="col-form-label">Kesesuaian Saluran Sekunder :</label>
                                <select class="form-control" name="kesesuaian_ss" id="kesesuaian_ss_edit">
                                    <option value="" selected>-- Pilih Kesesuian --</option>
                                    <option value="Sesuai">Sesuai</option>
                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pengadaan_edit" class="col-form-label">Kesesuaian Bangunan Pengatur :</label>
                                <select class="form-control" name="kesesuaian_bp" id="kesesuaian_bp_edit">
                                    <option value="" selected>-- Pilih Kesesuian --</option>
                                    <option value="Sesuai">Sesuai</option>
                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="Submit" class="btn btn-primary">SIMPAN</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>

<!-- jQuery script to initialize modal -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#parafButton').click(function() {
            $('#modalTambah').modal('show');
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {




        editnData = function(id) {

            ajaxUntukSemua(base_url() + 'Usulan/getDataByIdSimoni', {
                idSimoni: id
            }, async function(data) {

                    if (data.dataSimoni.kd_menu == '9') {
                        $('#pilih-kategori-di-edit').hide();

                        $('#irigasi-input-edit').hide();
                        $('#irigasi-baru-input-edit').hide();

                        $('#pilih-outcome-edit').hide();
                        $('#jenisOutcome-edit').prop('required', false);

                        $('#pilih-ws-edit').show();
                        $('#pilih-das-edit').show();

                        $('#wsPilihEdit').prop('required', true);
                        $('#dasEdit').prop('required', true);
                        $('#kategoriDi_edit').prop('required', false);
                        $('#daerahIrigasi_edit').prop('required', false);
                        $('#daerahIrigasiBaru_edit').prop('required', false);


                    } else {

                        $('#kategoriDi_edit').html(`
						<option value="DIT">DIT</option>
						<option value="DI">DI</option>
						<option value="DIAT">DIAT</option>
						<option value="DIP">DIP</option>
						`);

                        $('#pilih-kategori-di-edit').show();
                        $('#pilih-ws-edit').hide();
                        $('#pilih-das-edit').hide();

                        $('#wsPilihEdit').prop('required', false);
                        $('#dasEdit').prop('required', false);
                        $('#kategoriDi_edit').prop('required', true);

                        if (data.dataSimoni.kd_menu == '1') {
                            $('#kategoriDi_edit').html(`
						<option value="DIT">DIT</option>
						<option value="BARU">DI</option>
						<option value="DIAT">DIAT</option>
						<option value="DIP">DIP</option>
						`);

                            $('#pilih-kategori-di-edit').show();
                            $('#pilih-ws-edit').hide();
                            $('#pilih-das-edit').hide();

                            $('#wsPilihEdit').prop('required', false);
                            $('#dasEdit').prop('required', false);
                            $('#kategoriDi_edit').prop('required', true);
                        }


                        await $('#kategoriDi_edit').val(data.dataSimoni.kategori_di);

                        if (data.dataSimoni.kategori_di == 'BARU') {

                            // Mengecek apakah di pembangunan ada
                            if ($('#daerahIrigasiBaru_edit').find(`option[value="${data.dataSimoni.nm_di}"]`).length) {
                                console.log("Opsi dengan nilai '1' ditemukan");
                            } else {
                                console.log("Opsi dengan nilai '1' tidak ditemukan");

                                await $('#daerahIrigasiBaru_edit').append($('<option>', {
                                    value: data.dataSimoni.nm_di,
                                    text: data.dataSimoni.nm_di
                                }));

                                await $('#daerahIrigasiBaru_edit').select2('destroy');

                                await $('#daerahIrigasiBaru_edit').select2({
                                    theme: 'default',
                                    width: '100%',
                                    tags: true
                                });

                            }
                            // End Mengecek apakah di pembangunan ada

                            await $('#daerahIrigasi_edit').prop('required', false);
                            await $('#daerahIrigasiBaru_edit').prop('required', true);
                            await $('#irigasi-input-edit').hide();
                            await $('#irigasi-baru-input-edit').show();
                            await $('#daerahIrigasiBaru_edit').val(data.dataSimoni.nm_di).trigger('change');

                        } else {

                            await $('#nm_di_edit').val(data.dataSimoni.nm_di)
                            await $('#daerahIrigasi_edit').prop('required', true);
                            await $('#daerahIrigasiBaru_edit').prop('required', false);
                            await $('#irigasi-input-edit').show();
                            await $('#irigasi-baru-input-edit').hide();
                            await $('#daerahIrigasiBaru_edit').val('');

                            if (data.dataDi != null) {

                                let html = await ``;

                                await $.map(data.dataDi, function(val, key) {
                                    html += `<option value="${val.irigasiid}">${val.nama}</option>`;
                                })

                                $('#daerahIrigasi_edit').html(html);
                            }

                            await $('#daerahIrigasi_edit').val(data.dataSimoni.kd_di);

                        }

                        if (data.dataSimoni.kd_menu == '2') {
                            $('#pilih-outcome-edit').show();
                            $('#jenisOutcome-edit').prop('required', true);
                            $('#jenisOutcome-edit').val(data.dataSimoni.jns_luasan);
                        } else {
                            $('#pilih-outcome-edit').hide();
                            $('#jenisOutcome-edit').prop('required', false);
                        }

                    }

                    let html = await ``;

                    await $.map(data.dataDesa, function(val, key) {
                        html += `<option value="${val.desaid}">${val.desa}</option>`;
                    })

                    await $('#desa_edit').html(html);

                    let html2 = await ``;

                    await $.map(data.dataDas, function(val, key) {
                        html2 += `<option value="${val.id_das}">${val.nm_das}</option>`;
                    })

                    await $('#dasEdit').html(html2);

                    $('#wsPilihEdit').val(data.dataSimoni.kd_ws);
                    $('#dasEdit').val(data.dataSimoni.kd_das);
                    $('#menuKegiatan_edit').val(data.dataSimoni.kd_menu);
                    $('#kecamatan_edit').val(data.dataSimoni.kdkec).trigger('change');
                    $('#desa_edit').val(data.dataSimoni.kddes).trigger('change');
                    $('#output_edit').val(data.dataSimoni.output);
                    $('#pengadaan_edit').val(data.dataSimoni.pengadaan);
                    $('#pagu_kegiatan_edit').val(data.dataSimoni.pagu_kegiatan);
                    $('#laporan_sid_edit').val(data.dataSimoni.laporan_sid);
                    $('#laporan_ded_edit').val(data.dataSimoni.laporan_ded);
                    $('#gambar_rencana_edit').val(data.dataSimoni.gambar_rencana);
                    $('#aset_bu_edit').val(data.dataSimoni.aset_bu);
                    $('#aset_sp_edit').val(data.dataSimoni.aset_sp);
                    $('#aset_ss_edit').val(data.dataSimoni.aset_ss);
                    $('#aset_bp_edit').val(data.dataSimoni.aset_bp);

                    $('#usulan_bu_edit').val(data.dataSimoni.usulan_bu);
                    $('#usulan_sp_edit').val(data.dataSimoni.sPrimer);
                    $('#usulan_ss_edit').val(data.dataSimoni.usulan_ss);
                    $('#usulan_bp_edit').val(data.dataSimoni.usulan_bp);

                    $('#kondisi_kurang_bu_edit').val(data.dataSimoni.kondisi_kurang_bu);
                    $('#kondisi_kurang_sp_edit').val(data.dataSimoni.kondisi_kurang_sp);
                    $('#kondisi_kurang_ss_edit').val(data.dataSimoni.kondisi_kurang_ss);
                    $('#kondisi_kurang_bp_edit').val(data.dataSimoni.kondisi_kurang_bp);

                    $('#kondisi_lebih_bu_edit').val(data.dataSimoni.kondisi_lebih_bu);
                    $('#kondisi_lebih_sp_edit').val(data.dataSimoni.kondisi_lebih_sp);
                    $('#kondisi_lebih_ss_edit').val(data.dataSimoni.kondisi_lebih_ss);
                    $('#kondisi_lebih_bp_edit').val(data.dataSimoni.kondisi_lebih_bp);

                    $('#kesesuaian_bu_edit').val(data.dataSimoni.kesesuaian_bu);
                    $('#kesesuaian_sp_edit').val(data.dataSimoni.kesesuaian_sp);
                    $('#kesesuaian_ss_edit').val(data.dataSimoni.kesesuaian_ss);
                    $('#kesesuaian_bp_edit').val(data.dataSimoni.kesesuaian_bp);

                    $('#idEditSimoni').val(data.dataSimoni.id);
                    $('#modalEdit').modal('show');

                },
                function(error) {
                    alert(`Error : ${error}`);
                    console.log('Kesalahan:', error);
                });
        }

        $('#daerahIrigasi_edit').on('change', function() {
            let val = $('#daerahIrigasi_edit option:selected').text();
            $('#nm_di_edit').val(val);
        });

        $('#selectRekap').on('change', function() {
            let val = this.value;

            if (val == 1) {
                window.open('<?= base_url(); ?>Usulan/ChecklistPfid', '_blank');
            } else if (val == 2) {
                window.open('<?= base_url(); ?>Usulan/ChecklistIrwa', '_blank');
            }
        });

        $('#provinsiSelect, #kabkotaSelect, #jns_kegiatan').on('change', function() {
            checkFormVisibility();
        });


    });
</script>