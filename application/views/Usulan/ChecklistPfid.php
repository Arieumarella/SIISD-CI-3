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
    .disabled_nilai {
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
</style>

<section class="content">
    <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="font-size:18px;">
                            <i class="fa fa-globe" aria-hidden="true" style="color:#36b947;"></i>
                            PILIH WILAYAH
                        </h3>
                    </div>
                    <div class="card-body">

                        <div class="col-lg-4 col-sm-12" style="margin-left:60px;">
                            <div class="form-group">
                                <label class="reqired">Pilih Provinsi :</label>
                                <select class="form-control select2" id="provinsiSelect">
                                    <option selected disabled>-- Pilih Provinsi --</option>
                                    <?php foreach ($dataProv as $key => $val) { ?>
                                        <option value="<?= $val->provid; ?>"><?= $val->provinsi; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12" style="margin-left:60px;">
                            <div class="form-group">
                                <label class="reqired">Pilih Kabupaten/kota :</label>
                                <select class="form-control select2" id="kabkotaSelect">
                                    <option selected disabled>-- Pilih Kabupaten/Kota --</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12" style="margin-left:60px;">
                            <div class="form-group">
                                <label class="reqired">Pilih Jenis kegiatan :</label>
                                <select class="form-control select2" id="jns_kegiatan">
                                    <option selected disabled>-- Pilih Jenis/Kegiatan --</option>
                                    <option value="1">SIMONI</option>
                                    <option value="2">KONREG</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12" style="margin-left:60px;">
                            <button class="btn btn-success btn-flat" onclick="tampilkanURK();" style="float:right;"><i class="fa fa-check mr-1" aria-hidden="true"></i> TAMPILKAN</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="text-center">
                        <h4 class="font-weight-bolder">CHECKLIST VERIFIKATOR PFID</h4>
                        <h4 class="font-weight-bolder" id="nm_daerah"></h4>
                        <h4 class="font-weight-bolder">TA. <?= $this->session->userdata('thang'); ?></h4>
                    </div>
                    <br>

                    <table class=" table-bordered tableX " id="myTabelUsulan" style="width:100%;">
                        <thead class="theadX">
                            <tr id="boxThField">
                                <th class="text-center" style="display: none;" rowspan="3">No.</th>


                            </tr>
                        </thead>

                        <tbody id="tbody_data">
                        </tbody>
                    </table>
                    <br><br>
                    <!-- <form action="">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Nama Daerah irigasi</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <label for="exampleInputEmail1">Tahun Laporan SID</label>
                                        <input type="text" class="form-control" placeholder="Laporan SID">
                                        <br>
                                        <label for="exampleInputEmail1">Tahun Laporan DED</label>
                                        <input type="text" class="form-control" placeholder="Laporan DED">
                                        <br>
                                        <label for="exampleInputEmail1">Tahun Gambar Rencana</label>
                                        <input type="text" class="form-control" placeholder="Gambar Rencana">
                                    </div>
                                    <div class="col-2">
                                        <label for="exampleInputEmail1">Pengamatan Aset</label>
                                        <br><br>
                                        <label">Bendung (bh)</label>
                                            <br><br>
                                            <label">Saluran Primer (m)</label>
                                                <br><br>
                                                <label">Saluran Sekunder (m)</label>
                                                    <br><br>
                                                    <label">Bangunan Pengatur (BH) <br> (Bagi, Bagi Sadap, Sadap)</label>
                                    </div>
                                    <div class="col-2">
                                        <label for="exampleInputEmail1">Aset</label>
                                        <input type="text" class="form-control" placeholder="Aset">
                                        <br>

                                        <input type="text" class="form-control" placeholder="Aset">
                                        <br>

                                        <input type="text" class="form-control" placeholder="Aset">
                                        <br>

                                        <input type="text" class="form-control" placeholder="Aset">
                                    </div>
                                    <div class="col-2">
                                        <label for="exampleInputEmail1">Kondisi > 60%</label>
                                        <input type="text" class="form-control" placeholder="Kondisi">
                                        <br>
                                        <input type="text" class="form-control" placeholder="Kondisi">
                                        <br>
                                        <input type="text" class="form-control" placeholder="Kondisi">
                                        <br>
                                        <input type="text" class="form-control" placeholder="Kondisi">
                                    </div>
                                    <div class="col-2">
                                        <label for="exampleInputEmail1">Kondisi > 60%</label>
                                        <input type="text" class="form-control" placeholder="Kondisi">
                                        <br>
                                        <input type="text" class="form-control" placeholder="Kondisi">
                                        <br>
                                        <input type="text" class="form-control" placeholder="Kondisi">
                                        <br>
                                        <input type="text" class="form-control" placeholder="Kondisi">
                                    </div>
                                    <div class="col-2">
                                        <label for="exampleInputEmail1">Kesesuaian</label>
                                        <select class="form-control">
                                            <option>-- Pilih --</option>
                                            <option>Sesuai</option>
                                            <option>Tidak Sesuai</option>
                                        </select>
                                        <br>
                                        <select class="form-control">
                                            <option>-- Pilih --</option>
                                            <option>Sesuai</option>
                                            <option>Tidak Sesuai</option>
                                        </select>
                                        <br>
                                        <select class="form-control">
                                            <option>-- Pilih --</option>
                                            <option>Sesuai</option>
                                            <option>Tidak Sesuai</option>
                                        </select>
                                        <br>
                                        <select class="form-control">
                                            <option>-- Pilih --</option>
                                            <option>Sesuai</option>
                                            <option>Tidak Sesuai</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                             /.card-body -->
                    <!-- </div>
                <button type="submit" class="btn btn-success">Submit</button>
                </form> -->
                </div>
            </div>
        </div>
    </div>
    </div>




</section>


<script type="text/javascript">
    $(document).ready(function() {

        $('.select2').select2({
            theme: 'default',
            width: '100%'
        });

        function checkFormVisibility() {
            let provinsiSelect = $('#provinsiSelect').val(),
                kabkotaSelect = $('#kabkotaSelect').val(),
                jns_kegiatan = $('#jns_kegiatan').val();

            if (provinsiSelect && kabkotaSelect && jns_kegiatan) {
                $('#formContainer').show();
            } else {
                $('#formContainer').hide();
            }
        }

        tampilkanURK = function() {
            let provinsiSelect = $('#provinsiSelect').val(),
                kabkotaSelect = $('#kabkotaSelect').val(),
                jns_kegiatan = $('#jns_kegiatan').val(),
                nmKabKota = $('#kabkotaSelect option:selected').text();
            $('#nm_daerah').text(nmKabKota)

            if (provinsiSelect == null) {
                toastr.error('Silakan Pilih Provinsi.!')
                return;
            }

            if (kabkotaSelect == null) {
                toastr.error('Silakan Pilih Kabupaten/Kota.!')
                return;
            }

            if (jns_kegiatan == null) {
                toastr.error(':Silakan Pilih Jenis Kegiatan.!')
                return;
            }

            $.LoadingOverlay("show");

            ajaxUntukSemua(base_url() + 'Usulan/getURKByDownload', {
                provinsiSelect,
                kabkotaSelect,
                jns_kegiatan
            }, function(data) {

                console.log(data);
                let no = 1,
                    tabelKomponen = '',
                    html = ``;
                html += ` <form method="POST" action="<?= base_url(); ?>Usulan/simpanChecklistPfid">`;
                $.map(data.dataRK, function(val, key) {

                    let nm_di = ``;

                    if (val.kd_menu === '9') {
                        nm_di = `<b>WS</b>: ${val.nm_ws}
						<br>
						<b>DAS</b> : ${val.nm_das}	
						<br><br>`;
                    } else {
                        nm_di = `<b>${(val.kategori_di == 'BARU') ? 'DI PEMBANGUNAN BARU' : val.kategori_di+'-'+ val.nm_di}</b><br><br>`;
                    }

                    console.log(tabelKomponen)
                    html += ` <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">${no}. ${nm_di}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <label for="exampleInputEmail1">Tahun Laporan SID</label>
                                        <input type="text" class="form-control" placeholder="Laporan SID" required>
                                        <br>
                                        <label for="exampleInputEmail1">Tahun Laporan DED</label>
                                        <input type="text" class="form-control" placeholder="Laporan DED" required>
                                        <br>
                                        <label for="exampleInputEmail1">Tahun Gambar Rencana</label>
                                        <input type="text" class="form-control" placeholder="Gambar Rencana" required>
                                    </div>
                                    <div class="col-2">
                                        <label for="exampleInputEmail1">Pengamatan Aset</label>
                                        <br><br>
                                        <label">Bangunan Utama (bh)</label>
                                            <br><br>
                                            <label">Saluran Primer (m)</label>
                                                <br><br>
                                                <label">Saluran Sekunder (m)</label>
                                                    <br><br>
                                                    <label">Bangunan Pengatur (BH) <br> (Bagi, Bagi Sadap, Sadap)</label>
                                    </div>
                                    <div class="col-2">
                                        <label for="exampleInputEmail1">Aset</label>
                                        <input type="text" class="form-control" placeholder="Aset" required>
                                        <br>

                                        <input type="text" class="form-control" placeholder="Aset" required>
                                        <br>

                                        <input type="text" class="form-control" placeholder="Aset" required>
                                        <br>

                                        <input type="text" class="form-control" placeholder="Aset" required>
                                    </div>
                                    <div class="col-2">
                                        <label for="exampleInputEmail1">Kondisi < 60%</label>
                                        <input type="text" class="form-control" placeholder="Kondisi" required>
                                        <br>
                                        <input type="text" class="form-control" placeholder="Kondisi" required>
                                        <br>
                                        <input type="text" class="form-control" placeholder="Kondisi" required>
                                        <br>
                                        <input type="text" class="form-control" placeholder="Kondisi" required>
                                    </div>
                                    <div class="col-2">
                                        <label for="exampleInputEmail1">Kondisi > 60%</label>
                                        <input type="text" class="form-control" placeholder="Kondisi" required>
                                        <br>
                                        <input type="text" class="form-control" placeholder="Kondisi" required>
                                        <br>
                                        <input type="text" class="form-control" placeholder="Kondisi" required>
                                        <br>
                                        <input type="text" class="form-control" placeholder="Kondisi" required>
                                    </div>
                                    <div class="col-2">
                                        <label for="exampleInputEmail1">Kesesuaian</label>
                                        <select class="form-control" required>
                                            <option>-- Pilih --</option>
                                            <option>Sesuai</option>
                                            <option>Tidak Sesuai</option>
                                        </select>
                                        <br>
                                        <select class="form-control" required>
                                            <option>-- Pilih --</option>
                                            <option>Sesuai</option>
                                            <option>Tidak Sesuai</option>
                                        </select>
                                        <br>
                                        <select class="form-control" required> 
                                            <option>-- Pilih --</option>
                                            <option>Sesuai</option>
                                            <option>Tidak Sesuai</option>
                                        </select>
                                        <br>
                                        <select class="form-control" required>
                                            <option>-- Pilih --</option>
                                            <option>Sesuai</option>
                                            <option>Tidak Sesuai</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>   
                             
                   `;
                    no++;
                });
                html += `
                    

                    <button class="btn btn-primary m-2" type="submit" style="float:right;"><i class="fa fa-save" aria-hidden="true"></i> SIMPAN</button>
                    `;
                html += `</form>`;
                $('#tbody_data').html(html);
                $.LoadingOverlay("hide");
            }, function(error) {
                alert(`Error : ${error}`);
                console.log('Kesalahan:', error);
            });
        }
        $('#provinsiSelect, #kabkotaSelect, #jns_kegiatan').on('change', function() {
            checkFormVisibility();
        });

        $('#provinsiSelect').on('change', function() {
            let val = this.value,
                html = `<option selected disabled>-- Pilih Kab/Kota --</option>`;
            ajaxUntukSemua(base_url() + 'Usulan/getDataKabupatenByIdProv', {
                idProv: val
            }, function(data) {
                $.map(data, function(val, key) {
                    html += `<option value="${val.kotakabid}">${val.kemendagri}</option>`;
                })
                $('#kabkotaSelect').html(html);
            }, function(error) {
                alert(`Error : ${error}`);
                console.log('Kesalahan:', error);
            });
        });

        // Initialize form visibility
        $('#formContainer').hide();
    });
</script>