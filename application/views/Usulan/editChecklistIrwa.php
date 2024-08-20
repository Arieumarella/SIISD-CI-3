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

    .option-input:check {
        background: #28a745;
    }

    .option-input:checked::before {
        width: 28px;
        height: 28px;
        display: flex;
        content: '\f00c';
        /* content: '\2716'; */
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


    .option-input2 {
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

    .option-input2:hover {
        background: #9faab7;
    }

    .option-input2:checked {
        background: #DC143C;
    }

    .option-input2:check {
        background: #DC143C;
    }

    .option-input2:checked::before {
        width: 28px;
        height: 28px;
        display: flex;
        /* content: '\f00c'; */
        content: '\2716';
        font-size: 15px;
        font-weight: bold;
        position: absolute;
        align-items: center;
        justify-content: center;
        font-family: 'Font Awesome 5 Free';
    }

    .option-input2:checked::after {
        -webkit-animation: click-wave 0.65s;
        -moz-animation: click-wave 0.65s;
        animation: click-wave 0.65s;
        background: #DC143C;
        content: '';
        display: block;
        position: relative;
        z-index: 100;
    }

    .option-input2.radio {
        border-radius: 50%;
    }

    .option-input2.radio::after {
        border-radius: 50%;
    }

    .warna1 {
        background-color: #F7ECDE;
        color: black;
    }

    .warna2 {
        background-color: #fff;
        color: black;
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
        <div class="row ">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left" style="background-color:rgba(0, 255, 0, 0);">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>Usulan/CheklistSimoni">Rekapitulasi Nasional</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>Usulan/rekapKabKotaSimoni/<?= $idProv; ?>"><?= $nm_prov; ?></a></li>
                    <li class="breadcrumb-item active"><?= $nm_kotakab; ?></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- Presentase Berdasarkan Status -->
                <div class="card">
                    <div class="card-body">

                        <!-- <div class="card-body table-responsive p-0 tableFixHead" style="position: relative; overflow-y: scroll; height: 83vh; padding:2px;"> -->
                        <h4 class="mt-4 text-center"> CHECKLIST PEMENUHAN KELENGKAPAN PERENCANAAN TEKNIS TA. <?= $this->session->userdata('thang'); ?></h4>
                        <h4 class="text-center">PENILAIAN DANA ALOKASI KHUSUS BIDANG IRIGASI</h4>

                        <h4 class="mb-2 text-center"><?= $nm_kotakab; ?></h4>
                        <?= $this->session->flashdata('psn'); ?>
                        <br><br>
                        <br><br>
                        <form method="POST" action="<?= base_url(); ?>Usulan/simpaneditIrwa">
                            <input type="hidden" name="idEditSimoni" id="idEditSimoni">
                            <div class="card-body text-center table-responsive p-0 tableFixHead" style="position: relative; overflow-y: scroll; height: 83vh; padding: 2px; ">
                                <table class=" table-bordered tableX " id="myTabelUsulan" style="width:100%;">
                                    <thead class="theadX" style="background-color:#18978F; color:#fff; border: 1px solid #000000 !important">
                                        <!-- header utama -->
                                        <tr id="boxThField">
                                            <th class="text-center" style="border: 1px solid #000000 !important" rowspan="2">Nama D.I</th>
                                            <th class="text-center" style="border: 1px solid #000000 !important" rowspan="2">No.</th>
                                            <th class="text-center" style="border: 1px solid #000000 !important" colspan="2" rowspan="2">DATA</th>
                                            <th class="text-center" style="border: 1px solid #000000 !important" rowspan="2">DESKRIPSI DATA</th>
                                            <th class="text-center" style="border: 1px solid #000000 !important" colspan="4">SIFAT DATA/ITEM</th>
                                            <th class="text-center" style="border: 1px solid #000000 !important" rowspan="2" style="width:25%;">KESESUAIAN</th>
                                            <th class="text-center" style="border: 1px solid #000000 !important" rowspan="2">CATATAN</th>
                                        </tr>
                                        <tr id="boxThField">

                                            <th class="text-center" style="border: thin solid;">PEMBANGUNAN</th>
                                            <th class="text-center" style="border: thin solid;">PENINGKATAN LUASAN</th>
                                            <th class="text-center" style="border: thin solid;">PENINGKATAN FUNGSI</th>
                                            <th class="text-center" style="border: thin solid;">REHABILITAS</th>
                                        </tr>
                                    </thead>

                                    <?php
                                    $prive = $this->session->userdata('prive');
                                    $is_prive = $this->session->userdata('provinsi');
                                    ?>

                                    <tbody id="tbody_data">
                                        <?php $hasData = false;
                                        if ($dataKegiatan != null) {
                                            usort($dataKegiatan, function ($a, $b) {
                                                $order = ['1', '2', '3', '9'];
                                                $pos_a = array_search($a->kd_menu, $order);
                                                $pos_b = array_search($b->kd_menu, $order);
                                                return $pos_a - $pos_b;
                                            }); ?>
                                            <?php $no = 1;
                                            foreach ($dataKegiatan as $key => $val) { ?>
                                                <?php if ($val->kd_menu === '1' or $val->kd_menu === '2' or $val->kd_menu === '3') {
                                                    $hasData = true; ?>
                                                    <?php if ($val->kd_menu === '1' or $val->kd_menu === '2' or $val->kd_menu === '3' or $val->kd_menu === '9') {
                                                        $hasData = true; ?>
                                                        <tr>
                                                            <td rowspan="82"><?= $val->nm_di; ?></td>
                                                            <td class="text-left" rowspan="36">1</td>
                                                            <td class="text-left" rowspan="2">Laporan Perencanaan SID/DED</td>
                                                            <td class="text-left" colspan="2">SID (Survei Investigasi dan Desain)</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="catat1" id="catat1" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" colspan="2">DED (Detail Engineering Design )</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian2" id="Kesesuaian2">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="catat2" id="catat2" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" rowspan="23">Data Pendukung</td>
                                                            <td class="text-left" rowspan="4">Data Hidrologi (Panjang Data Historis Minimal 10 Tahun)</td>
                                                            <td class="text-left">Data Curah Hujan</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian3" id="Kesesuaian3">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="catat3" id="catat3" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Data Muka Air</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian4" id="Kesesuaian4">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="catat4" id="catat4" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Data Debit</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian5" id="Kesesuaian5">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="catat5" id="catat5" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Data Klimatologi</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian6" id="Kesesuaian6">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="catat3" id="catat3" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" rowspan="2">Data Pasang Surut (untuk Irigasi Rawa/Tambak)</td>
                                                            <td class="text-left">Data Pasang Surut (30 menitan minimal 15 hari)</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian7" id="Kesesuaian7">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="catat7" id="catat7" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Elevasi Penting (HHWL, HWL, MSL, LWL, LLWL)</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian8" id="Kesesuaian8">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="catat8" id="catat8" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" rowspan="3">Data Geologi</td>
                                                            <td class="text-left">Peta Geologi Regional</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian9" id="Kesesuaian9">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="catat9" id="catat9" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Data Bor Log dan Analisisnya</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian10" id="Kesesuaian10">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="catat10" id="catat10" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Peta CAT (Cekungan Air Tanah) (untuk usulan D.I.A.T)</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian11" id="Kesesuaian11">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="catat11" id="catat11" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" rowspan="13">Data Mekanika Tanah</td>
                                                            <td class="text-left">- Kuat Dukung</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian12" id="Kesesuaian12">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="catat12" id="catat12" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">- Profil Lapisan Tanah (Jenis Tanah)</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian13" id="Kesesuaian13">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="catat13" id="catat13" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Sifat-sifat fisik:</td>
                                                            <td class="text-left">

                                                            </td>
                                                            <td class="text-left">

                                                            </td>
                                                            <td class="text-left">

                                                            </td>
                                                            <td class="text-left">

                                                            </td>
                                                            <td class="text-left">

                                                            </td>
                                                            <td class="text-left"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">- Berat isi</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">- Berat Jenis</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">- Kadar Air</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">- Batas-batas Atterberg</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">- Analisa Ayak</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">- Analisa Hidrometer</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Sifat-sifat teknik:</td>
                                                            <td class="text-left">
                                                            </td>
                                                            <td class="text-left">
                                                            </td>
                                                            <td class="text-left">
                                                            </td>
                                                            <td class="text-left">
                                                            </td>
                                                            <td class="text-left">
                                                            </td>
                                                            <td class="text-left">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">- Kohesi</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">- Sudut geser dalam</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">- Koefisien konsolidasi</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" colspan="2">Data Kesesuaian Tanah untuk Pertanian</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" rows="3" id=""></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" rowspan="11">Nota Perhitungan Desain</td>
                                                            <td class="text-left" rowspan="4">Perhitungan Hidrologi</td>
                                                            <td class="text-left">Debit Banjir Rancangan</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Debit Andalan</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Kebutuhan Air</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Neraca Air</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" rowspan="3">Perhitungan Hidraulik</td>
                                                            <td class="text-left">Perencanaan Dimensi Bangunan Utama<br></td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Perencanaan Dimensi Saluran</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Perencanaan Dimensi Bangunan Air lainnya (talang, sipon, terjunan, bagi,<br>sadap…dll)</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" rowspan="4">Perhitungan Stabilitas Struktur</td>
                                                            <td class="text-left">Kestabilan Guling</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Kestabilan Geser</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Penurunan (Settlement)</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Rembesan (Piping)</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" rowspan="33">2</td>
                                                            <td class="text-left" rowspan="33">Gambar</td>
                                                            <td class="text-left">Bench Mark</td>
                                                            <td class="text-left">Deskripsi/Lokasi Bench Mark (BM) dan (CP)</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" colspan="2">Elevasi Sungai</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" colspan="2">Elevasi Sawah Tertinggi</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" colspan="2">Peta 1:5000 (Layout )</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" colspan="2">Peta Petak (Petak Sawah Overlay Kontur)</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" rowspan="2">Peta Situasi</td>
                                                            <td class="text-left">Peta 1:2000 (sungai, trase saluran)</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Peta 1:500 (situasi lokasi bangunan)</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Profil Memanjang</td>
                                                            <td class="text-left">Kesesuaian Patok, Jarak, dan Elevasi terhadap Peta Situasi</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" rowspan="3">Profil Melintang</td>
                                                            <td class="text-left">Kesesuaian dengan Profil Memanjang</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Garis/Elevasi Kondisi Eksisting-Rencana, Galian, dan Timbunan</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Elevasi Muka Air Rencana</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" rowspan="2">Peta IGT Daerah Irigasi</td>
                                                            <td class="text-left">Verifikasi oleh Tim Peta Direktorat Irigasi dan Rawa</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Kesesuaian Luas Informasi Geospasial Tematik (IGT) dengan Usulan</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" rowspan="3">Skema Jaringan</td>
                                                            <td class="text-left">Kesesuaian Penggambaran dengan KP-07 (Standar Penggambaran)</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left">
                                                                <textarea name="" id="" rows="3"></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Riwayat Pekerjaan</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Rencana Pekerjaan yang Diusulkan</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" rowspan="3">Skema Bangunan</td>
                                                            <td class="text-left">Kesesuaian Penggambaran dengan KP-07 (Standar Penggambaran)</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Riwayat Pekerjaan</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Rencana Pekerjaan yang Diusulkan</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" rowspan="3">Gambar Desain Bangunan Utama</td>
                                                            <td class="text-left">Kesesuaian Dimensi dengan Nota Desain Perhitungan Bangunan</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Kesesuaian Elevasi dengan Profil Memanjang dan Melintang</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Elevasi Muka Air Rencana</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" rowspan="3">Gambar Desain Saluran</td>
                                                            <td class="text-left">Kesesuaian Dimensi dengan Nota Desain Perhitungan Dimensi Saluran</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Kesesuaian Elevasi dengan Profil Memanjang dan Melintang</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Elevasi Muka Air Rencana</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" rowspan="3">Gambar Desain Bangunan Air lainnya</td>
                                                            <td class="text-left">Kesesuaian Dimensi dengan Nota Desain Perhitungan Bangunan</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Kesesuaian Elevasi dengan Profil Memanjang dan Melintang</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Elevasi Muka Air Rencana</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" rowspan="5">Data Tambahan Khusus Usulan D.I.R</td>
                                                            <td class="text-left">Layout Jaringan Rawa</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Peta Hidrotopografi</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Peta Kedalaman Pirit</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Peta Kedalaman Gambut</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Peta Kesesuaian Lahan (RTRW)</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">3</td>
                                                            <td class="text-left">Dokumen Lingkungan</td>
                                                            <td class="text-left">Ketersediaan Dokumen Lingkungan (UKL-UPL / SPPL)</td>
                                                            <td class="text-left">Ketersediaan Dokumen Izin Lingkungan terutama untuk Ruas/lokasi Pekerjaan yang diusulkan</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" rowspan="4">4</td>
                                                            <td class="text-left" rowspan="4">Kesiapan Lahan</td>
                                                            <td class="text-left" rowspan="2">Ganti Rugi</td>
                                                            <td class="text-left">Sertifikat Tanah atau Berita Acara Pembayaran Ganti Rugi atas Tanah</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Kesesuaian Peta Bidang Tanah dengan Sertifikat atau Berita Acara Pembayaran Ganti Rugi atas Tanah</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" rowspan="2">Hibah dari Masyarakat</td>
                                                            <td class="text-left">Surat Hibah dari Masyarakat (Bermaterai)</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Kesesuaian Peta Bidang Tanah dengan Surat Hibah dari Masyarakat</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">5</td>
                                                            <td class="text-left">Kerangka Acuan Kerja (KAK)</td>
                                                            <td class="text-left">Kerangka Acuan Kerja (KAK)</td>
                                                            <td class="text-left">Kesesuaian Output , Outcome, dan Kebutuhan Alokasi Penganggaran</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left">
                                                                <textarea name="" id="" rows="3"></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" rowspan="5">6</td>
                                                            <td class="text-left" rowspan="5">Prakiraan dan Perhitungan Volume Pekerjaan hingga Penyusunan Rencana Anggaran Biaya (RAB)</td>
                                                            <td class="text-left">Back Up Volume</td>
                                                            <td class="text-left">Kesesuaian Perhitungan Volume dengan Gambar Desain Pekerjaan serta Profil Memanjang dan Melintang</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left" rowspan="2">Analisis Harga Satuan Pekerjaan (AHSP)</td>
                                                            <td class="text-left">Kesesuaian Koefisien sesuai Permen PUPR No. 8 Tahun 2023 dan SE Dirjen BiKon No. 73 Tahun 2023</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Standar Satuan Harga Barang dan Jasa Daerah terkait, yang Ditandatangani oleh Masing-masing Kepala Daerah</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Sistem Manajemen Keselamatan Konstruksi (SMKK)</td>
                                                            <td class="text-left">Kesesuaian Perhitungan dan Penggunaan Permen PUPR Nomor 10 tahun 2021</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">Penyusunan Rencana Anggaran Biaya (RAB)</td>
                                                            <td class="text-left">Kesesuaian Data Rekapitulasi RAB terhadap Detail Pekerjaan serta Rincian Masing-masing Perhitungan Volume dan AHSP</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">7</td>
                                                            <td class="text-left">Foto Dokumentasi Geotagging</td>
                                                            <td class="text-left">Dokumentasi Kondisi Eksisting Masing-masing Rencana Lokasi Pekerjaan</td>
                                                            <td class="text-left" rowspan="2">Kesesuaian penggambilan dokumentasi geotagging dengan informasi minimal: data koordinat dan waktu pengambilan.<br>Dokumentasi diambil untuk masing-masing rencana pekerjaan (bangunan dan saluran per-STA)</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left">8</td>
                                                            <td class="text-left">Cetak Sawah</td>
                                                            <td class="text-left">Surat Pernyataan Kesanggupan Cetak Sawah dari Dinas Pertanian Setempat</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">Tidak Wajib</td>
                                                            <td class="text-left">
                                                                <select class="form-control" name="Kesesuaian1" id="Kesesuaian1">
                                                                    <option value="" selected disabled>-- Pilih --</option>
                                                                    <option value="Sesuai">Sesuai</option>
                                                                    <option value="Tidak Sesuai">Tidak Sesuai</option>
                                                                    <option value="Tidak Ada">Tidak Ada</option>
                                                                </select>
                                                            </td>
                                                            <td class="text-left"><textarea name="" id="" rows="3"></textarea></td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <button class="btn btn-primary m-2" type="submit" style="float:right;"><i class="fa fa-save" aria-hidden="true"></i>&nbsp; SIMPAN</button>
                        <?php }
                                        if (!$hasData) { ?>
                            <tr>
                                <td class="text-center" colspan="9" style="height: 20px;"><b>DATA KOSOSNG.!</b></td>
                            </tr>
                        <?php } ?>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Modal Edit Data -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">EDIT DATA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url(); ?>Usulan/editURKAdmin">
                    <input type="hidden" name="idEditSimoni" id="idEditSimoni">
                    <div class="form-group">
                        <label for="menuKegiatan_edit" class="col-form-label">Pilih Menu :</label>
                        <select class="form-control" name="menuKegiatan_edit" id="menuKegiatan_edit">
                            <option value="" selected disabled>-- Pilih Menu --</option>
                            <?php foreach ($dataMenu as $key => $val) { ?>
                                <option value="<?= $val->id; ?>"><?= $val->nm_menu; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group" id="pilih-ws-edit" style="display: none;">
                        <label for="wsPilihEdit" class="col-form-label">Pilih WS :</label>
                        <select class="form-control" name="wsPilihEdit" id="wsPilihEdit">
                            <option value="" selected disabled>-- Pilih WS --</option>
                            <?php foreach ($dataWS as $key => $val) { ?>
                                <option value="<?= $val->id_ws; ?>"><?= $val->nm_ws; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group" id="pilih-das-edit" style="display: none;">
                        <label for="dasEdit" class="col-form-label">Pilih DAS :</label>
                        <select class="form-control" name="dasEdit" id="dasEdit">
                            <option value="" selected disabled>-- Pilih DAS --</option>

                        </select>
                    </div>
                    <div class="form-group" id="pilih-kategori-di-edit" style="display: none;">
                        <label for="kategoriDi_edit" class="col-form-label">Pilih Kategori D.I :</label>
                        <select class="form-control" name="kategoriDi_edit" id="kategoriDi_edit">
                            <option value="" selected disabled>-- Pilih Kategori D.I --</option>
                            <option value="DIT">DIT</option>
                            <option value="DI">DI</option>
                            <option value="DIR">DIR</option>
                            <option value="DIP">DIP</option>
                            <option value="DIAT">DIAT</option>
                            <option value="BARU">DI PEMBANGUNAN BARU</option>
                        </select>
                    </div>
                    <div class="form-group" id="irigasi-input-edit" style="display: none;">
                        <label for="daerahIrigasi_edit" class="col-form-label">Pilih Daerah irigasi :</label>
                        <select class="form-control select2" name="daerahIrigasi_edit" id="daerahIrigasi_edit">
                            <option value="" selected disabled>-- Pilih Daerah Irigasi --</option>
                        </select>
                        <input type="hidden" name="nm_di_edit" id="nm_di_edit">
                    </div>
                    <div class="form-group" id="irigasi-baru-input-edit" style="display: none;">
                        <label for="daerahIrigasiBaru_edit" class="col-form-label">Pilih/Input Daerah Irigasi Baru :</label>
                        <select class="form-control" name="daerahIrigasiBaru_edit" id="daerahIrigasiBaru_edit">
                            <?php foreach ($dataDiPembangunan as $key => $val) { ?>
                                <option value="<?= $val->nm_di; ?>"><?= $val->nm_di; ?></option>
                            <?php } ?>

                        </select>
                    </div>

                    <div class="form-group" id="pilih-outcome-edit" style="display: none;">
                        <label for="jenisOutcome-edit" class="col-form-label">Jenis Outcome :</label>
                        <select class="form-control" name="jenisOutcome-edit" id="jenisOutcome-edit">
                            <option value="" selected disabled>-- Pilih Jenis Outcome --</option>
                            <option value="IP">IP</option>
                            <option value="Luasan">Luasan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="output_edit" class="col-form-label">Output (Hektar) :</label>
                        <input type="text" class="form-control" id="output_edit" name="output_edit" oninput="this.value = this.value.replace(/\D/g, '')">
                    </div>
                    <div class="form-group">
                        <label for="kecamatan_edit" class="col-form-label">Pilih Kecamatan :</label>
                        <select class="form-control " name="kecamatan_edit" id="kecamatan_edit">
                            <option value="" selected disabled>-- Pilih Kecamatan --</option>
                            <?php foreach ($dataKecamatan as $key => $val) { ?>
                                <option value="<?= $val->kecaid; ?>"><?= $val->keca; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="desa_edit" class="col-form-label">Pilih Desa :</label>
                        <select class="form-control" name="desa_edit" id="desa_edit">
                            <option value="" selected disabled>-- Pilih Desa --</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pengadaan_edit" class="col-form-label">Pilih Pengadaan :</label>
                        <select class="form-control" name="pengadaan_edit" id="pengadaan_edit">
                            <option value="" selected disabled>-- Pilih Pengadaan --</option>
                            <option value="0">Swakelola</option>
                            <option value="1">Kontraktual</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pagu_kegiatan_edit" class="col-form-label">Kebutuhan Dana :</label>
                        <input type="text" class="form-control" id="pagu_kegiatan_edit" name="pagu_kegiatan_edit" oninput="this.value = this.value.replace(/\D/g, '')">
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
<!-- End Modal Edit Data -->

<!-- start Modal Pengesahan Balai -->
<div class="modal fade" id="modalParaf" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Pengesahan Balai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url(); ?>Usulan/simpanParafVerif" enctype="multipart/form-data">
                    <input type="hidden" name="kotakabid" value="<?= $kotakabid; ?>">
                    <div class="form-group">
                        <label for="output" class="col-form-label">Jabatan :</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '')">
                    </div>
                    <div class="form-group">
                        <label for="output" class="col-form-label">Nama :</label>
                        <input type="text" class="form-control" id="nm_verif" name="nm_verif" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '')">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Paraf Verifikator :</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="paraf_verif" name="paraf_verif" accept="image/*">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <script>
                            document.getElementById("paraf_verif").addEventListener("change", function() {
                                var fileName = this.files[0].name;
                                var label = document.querySelector(".custom-file-label");
                                label.textContent = fileName;
                            });
                        </script>
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
<!-- End Modal Pengesahan Balai -->



<script type="text/javascript">
    $(document).ready(function() {

        $('.select2').select2({
            placeholder: '-Pilih Daerah Irigasi-',
            theme: 'default',
            width: '100%'

        })

        $('.select3').select2({
            placeholder: '-Pilih Komponen-',
            theme: 'default',
            width: '100%'
        })

        $('.select4').select2({
            placeholder: '-Pilih Kecamatan-',
            theme: 'default',
            width: '100%'

        })

        $('.select5').select2({
            placeholder: '-Pilih Desa-',
            theme: 'default',
            width: '100%'

        })

        $('#kecamatan_edit').select2({
            placeholder: '-Pilih Kecamatan-',
            theme: 'default',
            width: '100%'

        })

        $('#desa_edit').select2({
            placeholder: '-Pilih Desa-',
            theme: 'default',
            width: '100%'

        })

        $('#daerahIrigasiBaru').select2({
            theme: 'default',
            width: '100%',
            tags: true

        })

        $('#daerahIrigasiBaru_edit').select2({
            theme: 'default',
            width: '100%',
            tags: true

        })


        downloadURK = function() {
            $('#modalParaf').modal('show');
        }

        tambahData = function() {
            $('#modalTambah').modal('show');
        }

        $('#kategoriDi').on('change', function() {

            let val = this.value;

            if (val == 'BARU') {

                $('#daerahIrigasi').prop('', false);
                $('#daerahIrigasiBaru').prop('', true);
                $('#irigasi-input').hide();
                $('#irigasi-baru-input').show();

            } else {

                $('#daerahIrigasi').prop('', true);
                $('#daerahIrigasiBaru').prop('', false);

                ajaxUntukSemua(base_url() + 'Usulan/getDataDiByKategori', {
                    kategori: val
                }, function(data) {

                    if (data != null) {

                        let html = ``;

                        $.map(data, function(val, key) {
                            html += `<option value="${val.irigasiid}">${val.nama}</option>`;
                        })

                        $('#daerahIrigasi').html(html);
                    }

                }, function(error) {
                    alert(`Error : ${error}`);
                    console.log('Kesalahan:', error);
                });

                $('#irigasi-input').show();
                $('#irigasi-baru-input').hide();

            }

        });




        $('#kecamatan').on('change', function() {

            let val = this.value;

            ajaxUntukSemua(base_url() + 'Usulan/getDesa', {
                kdkec: val
            }, function(data) {


                let html = ``;

                $.map(data, function(val, key) {
                    html += `<option value="${val.desaid}">${val.desa}</option>`;
                })

                $('#desa').html(html);


            }, function(error) {
                alert(`Error : ${error}`);
                console.log('Kesalahan:', error);
            });

        });


        $('#daerahIrigasi').on('change', function() {
            let val = $('#daerahIrigasi option:selected').text();
            $('#nm_di').val(val);
        });


        showModalKomponen = function(id) {
            $('#idData').val(id);
            $('#modalKomponen').modal('show');
        }


        hapuskomponen = function(id, idMasterData) {

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak akan bisa dikembalikan.!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {

                if (result.value == true) {

                    ajaxUntukSemua(base_url() + 'Usulan/deleteKomponen', {
                        id,
                        idMasterData
                    }, function(data) {

                        location.reload();

                    }, function(error) {
                        alert(`Error : ${error}`);
                        console.log('Kesalahan:', error);
                    });


                }
            });


        }


        hapusMainData = function(id) {

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak akan bisa dikembalikan.!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {

                if (result.value == true) {

                    ajaxUntukSemua(base_url() + 'Usulan/deleteBaseDaata', {
                        id
                    }, function(data) {

                        location.reload();

                    }, function(error) {
                        alert(`Error : ${error}`);
                        console.log('Kesalahan:', error);
                    });


                }
            });


        }

        editnData = function(id) {

            ajaxUntukSemua(base_url() + 'Usulan/getDataByIdSimoni', {
                idSimoni: id
            }, async function(data) {

                    if (data.dataSimoni.kd_menu == '9') {
                        $('#pilih-kategori-di-edit').hide();

                        $('#irigasi-input-edit').hide();
                        $('#irigasi-baru-input-edit').hide();

                        $('#pilih-outcome-edit').hide();
                        $('#jenisOutcome-edit').prop('', false);

                        $('#pilih-ws-edit').show();
                        $('#pilih-das-edit').show();

                        $('#wsPilihEdit').prop('', true);
                        $('#dasEdit').prop('', true);
                        $('#kategoriDi_edit').prop('', false);
                        $('#daerahIrigasi_edit').prop('', false);
                        $('#daerahIrigasiBaru_edit').prop('', false);


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

                        $('#wsPilihEdit').prop('', false);
                        $('#dasEdit').prop('', false);
                        $('#kategoriDi_edit').prop('', true);

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

                            $('#wsPilihEdit').prop('', false);
                            $('#dasEdit').prop('', false);
                            $('#kategoriDi_edit').prop('', true);
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

                            await $('#daerahIrigasi_edit').prop('', false);
                            await $('#daerahIrigasiBaru_edit').prop('', true);
                            await $('#irigasi-input-edit').hide();
                            await $('#irigasi-baru-input-edit').show();
                            await $('#daerahIrigasiBaru_edit').val(data.dataSimoni.nm_di).trigger('change');

                        } else {

                            await $('#nm_di_edit').val(data.dataSimoni.nm_di)
                            await $('#daerahIrigasi_edit').prop('', true);
                            await $('#daerahIrigasiBaru_edit').prop('', false);
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
                            $('#jenisOutcome-edit').prop('', true);
                            $('#jenisOutcome-edit').val(data.dataSimoni.jns_luasan);
                        } else {
                            $('#pilih-outcome-edit').hide();
                            $('#jenisOutcome-edit').prop('', false);
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
                    $('#idEditSimoni').val(data.dataSimoni.id);
                    $('#modalEdit').modal('show');

                },
                function(error) {
                    alert(`Error : ${error}`);
                    console.log('Kesalahan:', error);
                });
        }

        $('#menuKegiatan_edit').on('change', function() {
            let val = this.value;
            if (val == '9') {
                $('#pilih-kategori-di-edit').hide();
                $('#irigasi-input-edit').hide();
                $('#irigasi-baru-input-edit').hide();
                $('#pilih-ws-edit').show();
                $('#pilih-das-edit').show();

                $('#wsPilihEdit').prop('', true);
                $('#dasEdit').prop('', true);
                $('#kategoriDi_edit').prop('', false);
                $('#daerahIrigasi_edit').prop('', false);
                $('#daerahIrigasiBaru_edit').prop('', false);

            }
            // if (val == '1') {
            // 	$('#kategoriDi_edit').html(`
            //             <option value="DIT">DIT</option>
            // 		    <option value="BARU">DI</option>
            //             <option value="DIAT">DIAT</option>
            // 		    <option value="DIP">DIP</option>
            // 		    <option value="DIAT">DIAT</option>
            //             `);

            // 	$('#pilih-kategori-di-edit').show();
            // 	$('#pilih-ws-edit').hide();
            // 	$('#pilih-das-edit').hide();

            // 	$('#wsPilihEdit').prop('', false);
            // 	$('#dasEdit').prop('', false);
            // 	$('#kategoriDi_edit').prop('', true);

            // } 
            else {
                // $('#kategoriDi_edit').html(`
                //         <option value="DIT">DIT</option>
                // 	    <option value="DI">DI</option>
                //         <option value="DIAT">DIAT</option>
                // 	    <option value="DIP">DIP</option>
                // 	    <option value="DIAT">DIAT</option>
                //         `);

                $('#pilih-kategori-di-edit').show();
                $('#pilih-ws-edit').hide();
                $('#pilih-das-edit').hide();

                $('#wsPilihEdit').prop('', false);
                $('#dasEdit').prop('', false);
                $('#kategoriDi_edit').prop('', true);

            }

        });


        $('#kecamatan_edit').on('change', function() {

            let val = this.value;

            ajaxUntukSemua(base_url() + 'Usulan/getDesa', {
                kdkec: val
            }, function(data) {


                let html = ``;

                $.map(data, function(val, key) {
                    html += `<option value="${val.desaid}">${val.desa}</option>`;
                })

                $('#desa_edit').html(html);


            }, function(error) {
                alert(`Error : ${error}`);
                console.log('Kesalahan:', error);
            });

        });


        $('#kategoriDi_edit').on('change', function() {

            let val = this.value;

            if (val == 'BARU') {

                $('#daerahIrigasi_edit').prop('', false);
                $('#daerahIrigasiBaru_edit').prop('', true);
                $('#irigasi-input-edit').hide();
                $('#irigasi-baru-input-edit').show();

            } else {

                $('#daerahIrigasi_edit').prop('', true);
                $('#daerahIrigasiBaru_edit').prop('', false);
                $('#irigasi-input-edit').show();
                $('#irigasi-baru-input-edit').hide();

                ajaxUntukSemua(base_url() + 'Usulan/getDataDiByKategori', {
                    kategori: val
                }, function(data) {

                    if (data != null) {

                        let html = ``;

                        $.map(data, function(val, key) {
                            html += `<option value="${val.irigasiid}">${val.nama}</option>`;
                        })

                        $('#daerahIrigasi_edit').html(html);
                    }

                }, function(error) {
                    alert(`Error : ${error}`);
                    console.log('Kesalahan:', error);
                });


            }

        });

        $('#daerahIrigasi_edit').on('change', function() {
            let val = $('#daerahIrigasi_edit option:selected').text();
            $('#nm_di_edit').val(val);
        });


        $('#menuKegiatan').on('change', function() {
            let val = this.value;

            switch (val) {
                case "9":


                    $('#pilih-kategori-di').hide();
                    $('#irigasi-input').hide();
                    $('#irigasi-baru-input').hide();
                    $('#pilih-ws').show();
                    $('#pilih-das').show();
                    $('#pilih-outcome').hide();
                    $('#jenisOutcome').prop('', false);
                    $('#wsPilih').prop('', true);
                    $('#das').prop('', true);
                    $('#kategoriDi').prop('', false);
                    $('#daerahIrigasi').prop('', false);
                    $('#daerahIrigasiBaru').prop('', false);
                    break;
                case "1":


                    $('#kategoriDi').html(`
                    <option value="DIT">DIT</option>
					<option value="BARU">DI</option>
                    <option value="DIAT">DIAT</option>
					<option value="DIP">DIP</option>
					
                `);
                    $('#pilih-kategori-di').show(); // Menampilkan dropdown
                    $('#pilih-ws').hide();
                    $('#pilih-das').hide();
                    $('#pilih-outcome').hide();
                    $('#jenisOutcome').prop('', false);
                    $('#wsPilih').prop('', false);
                    $('#das').prop('', false);
                    $('#kategoriDi').prop('', true);
                    break;
                case "2":
                    $('#kategoriDi').html(`
                    <option value="DIT">DIT</option>
					<option value="DI">DI</option>
                    <option value="DIAT">DIAT</option>
					<option value="DIP">DIP</option>
					
                `);

                    $('#pilih-kategori-di').show();
                    $('#pilih-ws').hide();
                    $('#pilih-das').hide();
                    $('#pilih-outcome').show();
                    $('#jenisOutcome').prop('', true);
                    $('#wsPilih').prop('', false);
                    $('#das').prop('', false);
                    $('#kategoriDi').prop('', true);
                    break;
                case "3":

                    $('#kategoriDi').html(`
                    <option value="DIT">DIT</option>
					<option value="DI">DI</option>
                    <option value="DIAT">DIAT</option>
					<option value="DIP">DIP</option>
					
                `);
                    $('#pilih-kategori-di').show();
                    $('#pilih-ws').hide();
                    $('#pilih-das').hide();
                    $('#pilih-outcome').hide();
                    $('#jenisOutcome').prop('', false);
                    $('#wsPilih').prop('', false);
                    $('#das').prop('', false);
                    $('#kategoriDi').prop('', true);
                    break;
                default:
                    alert('Invalid Parameter .!');
            }

        });

        $('#wsPilih').on('change', function() {

            let val = this.value;

            ajaxUntukSemua(base_url() + 'Usulan/getDas', {
                kdws: val
            }, function(data) {


                let html = ``;

                $.map(data, function(val, key) {
                    html += `<option value="${val.id_das}">${val.nm_das}</option>`;
                })

                $('#das').html(html);


            }, function(error) {
                alert(`Error : ${error}`);
                console.log('Kesalahan:', error);
            });

        });
        $('#selectRekap').on('change', function() {
            let val = this.value;

            if (val == 1) {
                window.open('<?= base_url(); ?>Usulan/ChecklistPfid', '_blank');
            } else if (val == 2) {
                window.open('<?= base_url(); ?>Usulan/ChecklistIrwa', '_blank');
            }
        });
    });
</script>