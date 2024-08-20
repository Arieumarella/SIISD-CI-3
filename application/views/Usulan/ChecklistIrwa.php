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



    .modal-dialog-custom {
        max-width: 90%;
        width: auto;
        height: 0 auto;

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
                        <div class="card-body text-center table-responsive p-0 tableFixHead" style="position: relative; overflow-y: scroll; height: 90vh; padding: 4px; margin: 0px;">
                            <!-- <div class="card-body table-responsive p-0 tableFixHead" style="position: relative; overflow-y: scroll; height: 83vh; padding:2px;"> -->
                            <h4 class="mt-4"> CHECKLIST PEMENUHAN KELENGKAPAN PERENCANAAN TEKNIS IRIGASI Dan RAWA</h4>
                            <h4>PENILAIAN USULAN RENCANA KEGIATAN DAK BIDANG IRIGASI TA. <?= $this->session->userdata('thang'); ?></h4>
                            <h4 class="mb-2">PROVINSI <?= $nm_prov; ?></h4>
                            <h4 class="mb-2"><?= $nm_kotakab; ?></h4>
                            <?= $this->session->flashdata('psn'); ?>
                            <br><br>
                            <br><br>

                            <input type="hidden" name="idkabkota" value="<?= $kotakabid; ?>">
                            <table class=" table-bordered tableX " id="myTabelUsulan" style="width:100%;">
                                <thead class="theadX" style="background-color:#18978F; color:#fff; border: 1px solid #000000 !important">
                                    <!-- header utama -->
                                    <tr id="boxThField">
                                        <th class="text-center" style="border: 1px solid #000000 !important; width:7%;" rowspan="2">Nama D.I</th>
                                        <th class="text-center" style="border: 1px solid #000000 !important;" rowspan="2">No.</th>
                                        <th class="text-center" style="border: 1px solid #000000 !important; width:15%" colspan="2" rowspan="2">DATA</th>
                                        <th class="text-center" style="border: 1px solid #000000 !important; width:15%" rowspan="2">DESKRIPSI DATA</th>
                                        <th class="text-center" style="border: 1px solid #000000 !important; width:auto" colspan="4">SIFAT DATA/ITEM</th>
                                        <th class="text-center" style="border: 1px solid #000000 !important; width:7%;" rowspan="2" style="width:17%;">Kesesuaian</th>
                                        <th class="text-center" style="border: 1px solid #000000 !important; width:25%;" rowspan="2">CATATAN</th>
                                    </tr>
                                    <tr id="boxThField">

                                        <th class="text-center" style="border: thin solid; width:6%;">PEMBANGUNAN</th>
                                        <th class="text-center" style="border: thin solid; width:6%;">PENINGKATAN LUASAN</th>
                                        <th class="text-center" style="border: thin solid; width:6%;">PENINGKATAN FUNGSI</th>
                                        <th class="text-center" style="border: thin solid; width:6%;">REHABILITAS</th>
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
                                                <tr>
                                                    <td rowspan="83">
                                                        <a href="#" onclick="editnData('<?= $val->id; ?>'); return false;">
                                                            <?php
                                                            if ($val->kd_menu === '9') {
                                                                echo '<b>WS : </b>' . $val->nm_ws;
                                                                echo '<br>';
                                                                echo '<b>DAS : </b>' . $val->nm_das;
                                                            } else {
                                                                echo '<b>' . $val->nm_di . '</b>';
                                                            } ?>
                                                        </a>
                                                    </td>

                                                    <td class="text-left" rowspan="36">1</td>
                                                    <td class="text-left" rowspan="2">Laporan Perencanaan SID/DED</td>
                                                    <td class="text-left" colspan="2">SID (Survei Investigasi dan Desain)</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian1; ?></td>
                                                    <td class="text-left" rowspan="2"><?= $val->catat1; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left" colspan="2">DED (Detail Engineering Design )</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian2; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left" rowspan="23">Data Pendukung</td>
                                                    <td class="text-left" rowspan="4">Data Hidrologi (Panjang Data Historis Minimal 10 Tahun)</td>
                                                    <td class="text-left">Data Curah Hujan</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian3; ?></td>
                                                    <td class="text-left" rowspan="4"><?= $val->catat2; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Data Muka Air</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian4; ?></td>


                                                </tr>
                                                <tr>
                                                    <td class="text-left">Data Debit</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian5; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">Data Klimatologi</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian6; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left" rowspan="2">Data Pasang Surut (untuk Irigasi Rawa/Tambak)</td>
                                                    <td class="text-left">Data Pasang Surut (30 menitan minimal 15 hari)</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian7; ?></td>
                                                    <td class="text-left" rowspan="2"><?= $val->catat3; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">Elevasi Penting (HHWL, HWL, MSL, LWL, LLWL)</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian8; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left" rowspan="3">Data Geologi</td>
                                                    <td class="text-left">Peta Geologi Regional</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian9; ?></td>
                                                    <td class="text-left" rowspan="3"><?= $val->catat4; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">Data Bor Log dan Analisisnya</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian10; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">Peta CAT (Cekungan Air Tanah) (untuk usulan D.I.A.T)</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian11; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left" rowspan="13">Data Mekanika Tanah</td>
                                                    <td class="text-left">- Kuat Dukung</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian12; ?></td>
                                                    <td class="text-left" rowspan="14"><?= $val->catat5; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">Profil Lapisan Tanah (Jenis Tanah)</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian13; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">Sifat-sifat fisik:</td>
                                                    <td class="text-left"></td>
                                                    <td class="text-left"></td>
                                                    <td class="text-left"></td>
                                                    <td class="text-left"></td>
                                                    <td class="text-left"></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">- Berat isi</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian14; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">- Berat Jenis</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian15; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">- Kadar Air</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian16; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">- Batas-batas Atterberg</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian17; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">- Analisa Ayak</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian18; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">- Analisa Hidrometer</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian19; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">Sifat-sifat teknik:</td>
                                                    <td class="text-left"></td>
                                                    <td class="text-left"></td>
                                                    <td class="text-left"></td>
                                                    <td class="text-left"></td>
                                                    <td class="text-left"></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">- Kohesi</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian20; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">- Sudut geser dalam</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian21; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">- Koefisien konsolidasi</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian22; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left" colspan="2">Data Kesesuaian Tanah untuk Pertanian</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian23; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left" rowspan="11">Nota Perhitungan Desain</td>
                                                    <td class="text-left" rowspan="4">Perhitungan Hidrologi</td>
                                                    <td class="text-left">Debit Banjir Rancangan</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian24; ?></td>
                                                    <td class="text-left" rowspan="4"><?= $val->catat6; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Debit Andalan</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian25; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">Kebutuhan Air</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian26; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">Neraca Air</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian27; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left" rowspan="3">Perhitungan Hidraulik</td>
                                                    <td class="text-left">Perencanaan Dimensi Bangunan Utama<br></td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian28; ?></td>
                                                    <td class="text-left" rowspan="3"><?= $val->catat7; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Perencanaan Dimensi Saluran</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian29; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">Perencanaan Dimensi Bangunan Air lainnya (talang, sipon, terjunan, bagi,<br>sadap…dll)</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian30; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left" rowspan="4">Perhitungan Stabilitas Struktur</td>
                                                    <td class="text-left">Kestabilan Guling</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian31; ?></td>
                                                    <td class="text-left" rowspan="4"><?= $val->catat8; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Kestabilan Geser</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian32; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">Penurunan (Settlement)</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian33; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">Rembesan (Piping)</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian34; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left" rowspan="33">2</td>
                                                    <td class="text-left" rowspan="33">Gambar</td>
                                                    <td class="text-left">Bench Mark</td>
                                                    <td class="text-left" rowspan="5">Deskripsi/Lokasi Bench Mark (BM) dan (CP)</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian35; ?></td>
                                                    <td class="text-left" rowspan="5"><?= $val->catat9; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Elevasi Sungai</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian36; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">Elevasi Sawah Tertinggi</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian37; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">Peta 1:5000 (Layout )</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian38; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">Peta Petak (Petak Sawah Overlay Kontur)</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian39; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left" rowspan="2">Peta Situasi</td>
                                                    <td class="text-left">Peta 1:2000 (sungai, trase saluran)</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian40; ?></td>
                                                    <td class="text-left" rowspan="2"><?= $val->catat10; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Peta 1:500 (situasi lokasi bangunan)</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian41; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">Profil Memanjang</td>
                                                    <td class="text-left">Kesesuaian Patok, Jarak, dan Elevasi terhadap Peta Situasi</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian42; ?></td>
                                                    <td class="text-left"><?= $val->catat11; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left" rowspan="3">Profil Melintang</td>
                                                    <td class="text-left">Kesesuaian dengan Profil Memanjang</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian43; ?></td>
                                                    <td class="text-left" rowspan="3"><?= $val->catat12; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Garis/Elevasi Kondisi Eksisting-Rencana, Galian, dan Timbunan</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian44; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">Elevasi Muka Air Rencana</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian45; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left" rowspan="2">Peta IGT Daerah Irigasi</td>
                                                    <td class="text-left">Verifikasi oleh Tim Peta Direktorat Irigasi dan Rawa</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian46; ?></td>
                                                    <td class="text-left" rowspan="2"><?= $val->catat13; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Kesesuaian Luas Informasi Geospasial Tematik (IGT) dengan Usulan</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian47; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left" rowspan="3">Skema Jaringan</td>
                                                    <td class="text-left">Kesesuaian Penggambaran dengan KP-07 (Standar Penggambaran)</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian48; ?></td>
                                                    <td class="text-left" rowspan="3"><?= $val->catat14; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Riwayat Pekerjaan</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian49; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">Rencana Pekerjaan yang Diusulkan</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian50; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left" rowspan="3">Skema Bangunan</td>
                                                    <td class="text-left">Kesesuaian Penggambaran dengan KP-07 (Standar Penggambaran)</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian51; ?></td>
                                                    <td class="text-left" rowspan="3"><?= $val->catat15; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Riwayat Pekerjaan</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian52; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">Rencana Pekerjaan yang Diusulkan</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian53; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left" rowspan="3">Gambar Desain Bangunan Utama</td>
                                                    <td class="text-left">Kesesuaian Dimensi dengan Nota Desain Perhitungan Bangunan</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian54; ?></td>
                                                    <td class="text-left" rowspan="3"><?= $val->catat16; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Kesesuaian Elevasi dengan Profil Memanjang dan Melintang</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian55; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">Elevasi Muka Air Rencana</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian56; ?></td>


                                                </tr>
                                                <tr>
                                                    <td class="text-left" rowspan="3">Gambar Desain Saluran</td>
                                                    <td class="text-left">Kesesuaian Dimensi dengan Nota Desain Perhitungan Dimensi Saluran</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian57; ?></td>
                                                    <td class="text-left" rowspan="3"><?= $val->catat17; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Kesesuaian Elevasi dengan Profil Memanjang dan Melintang</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian58; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">Elevasi Muka Air Rencana</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian59; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left" rowspan="3">Gambar Desain Bangunan Air lainnya</td>
                                                    <td class="text-left">Kesesuaian Dimensi dengan Nota Desain Perhitungan Bangunan</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian60; ?></td>
                                                    <td class="text-left" rowspan="3"><?= $val->catat18; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Kesesuaian Elevasi dengan Profil Memanjang dan Melintang</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian61; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">Elevasi Muka Air Rencana</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian62; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left" rowspan="5">Data Tambahan Khusus Usulan D.I.R</td>
                                                    <td class="text-left">Layout Jaringan Rawa</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian63; ?></td>
                                                    <td class="text-left" rowspan="5"><?= $val->catat19; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Peta Hidrotopografi</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak Wajib</td>
                                                    <td class="text-left">Tidak Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian64; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">Peta Kedalaman Pirit</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak Wajib</td>
                                                    <td class="text-left">Tidak Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian65; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">Peta Kedalaman Gambut</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak Wajib</td>
                                                    <td class="text-left">Tidak Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian66; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">Peta Kesesuaian Lahan (RTRW)</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak Wajib</td>
                                                    <td class="text-left">Tidak Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian67; ?></td>

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
                                                    <td class="text-left"><?= $val->Kesesuaian68; ?></td>
                                                    <td class="text-left"><?= $val->catat20; ?></td>
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
                                                    <td class="text-left"><?= $val->Kesesuaian69; ?></td>
                                                    <td class="text-left"><?= $val->catat21; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Kesesuaian Peta Bidang Tanah dengan Sertifikat atau Berita Acara Pembayaran Ganti Rugi atas Tanah</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak Wajib</td>
                                                    <td class="text-left">Tidak Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian70; ?></td>
                                                    <td class="text-left"><?= $val->catat22; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left" rowspan="2">Hibah dari Masyarakat</td>
                                                    <td class="text-left">Surat Hibah dari Masyarakat (Bermaterai)</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak Wajib</td>
                                                    <td class="text-left">Tidak Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian71; ?></td>
                                                    <td class="text-left" rowspan="2"><?= $val->catat23; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Kesesuaian Peta Bidang Tanah dengan Surat Hibah dari Masyarakat</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak Wajib</td>
                                                    <td class="text-left">Tidak Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian72; ?></td>

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
                                                    <td class="text-left"><?= $val->Kesesuaian73; ?></td>
                                                    <td class="text-left"><?= $val->catat24; ?></td>
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
                                                    <td class="text-left"><?= $val->Kesesuaian74; ?></td>
                                                    <td class="text-left"><?= $val->catat25; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left" rowspan="2">Analisis Harga Satuan Pekerjaan (AHSP)</td>
                                                    <td class="text-left">Kesesuaian Koefisien sesuai Permen PUPR No. 8 Tahun 2023 dan SE Dirjen BiKon No. 73 Tahun 2023</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian75; ?></td>
                                                    <td class="text-left" rowspan="2"><?= $val->catat26; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Standar Satuan Harga Barang dan Jasa Daerah terkait, yang Ditandatangani oleh Masing-masing Kepala Daerah</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian76; ?></td>

                                                </tr>
                                                <tr>
                                                    <td class="text-left">Sistem Manajemen Keselamatan Konstruksi (SMKK)</td>
                                                    <td class="text-left">Kesesuaian Perhitungan dan Penggunaan Permen PUPR Nomor 10 tahun 2021</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian77; ?></td>
                                                    <td class="text-left"><?= $val->catat27; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Penyusunan Rencana Anggaran Biaya (RAB)</td>
                                                    <td class="text-left">Kesesuaian Data Rekapitulasi RAB terhadap Detail Pekerjaan serta Rincian Masing-masing Perhitungan Volume dan AHSP</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian78; ?></td>
                                                    <td class="text-left"><?= $val->catat28; ?></td>
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
                                                    <td class="text-left"><?= $val->Kesesuaian79; ?></td>
                                                    <td class="text-left"><?= $val->catat29; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">8</td>
                                                    <td class="text-left">Cetak Sawah</td>
                                                    <td class="text-left">Surat Pernyataan Kesanggupan Cetak Sawah dari Dinas Pertanian Setempat</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Tidak Wajib</td>
                                                    <td class="text-left">Tidak Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian80; ?></td>
                                                    <td class="text-left"><?= $val->catat30; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">9</td>
                                                    <td class="text-left">Petani Penerima Manfaat</td>
                                                    <td class="text-left">Surat Pernyataan dari Perwakilan Petani Penerima Manfaat pada DI tersebut</td>
                                                    <td class="text-left">Mencantumkan jumlah petani pada ruas DI yang dikerjakan</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left">Wajib</td>
                                                    <td class="text-left"><?= $val->Kesesuaian81; ?></td>
                                                    <td class="text-left"><?= $val->catat31; ?></td>
                                                </tr>

                                            <?php } ?>
                                        <?php } ?>
                                </tbody>
                            </table>
                            <div class="card-body row col-sm-15  col-lg-4 p-0 mt-2 ml-1">
                                <a href="<?= base_url(); ?>ExportPdf/exportchecklistirwa_pdf/<?= $kotakabid ?>" target="_blank" class="btn btn-primary btn-icon" style="float:left; margin-top: 8px; height:100%">
                                    <i class="fa fa-download" aria-hidden="true"></i>&nbsp; Checklist IRWA
                                </a>
                                <button id="parafButton" type="button" class="btn btn-success m-2" style="float:right; margin-bottom: 9px;" onclick="downloadIRWA();"><i class="fa fa-upload" aria-hidden="true"></i>&nbsp; TTD</button>
                                <?php if ($this->session->userdata('kdKewenangan') == 'PU009') { ?>
                                    <button id="parafButton" type="button" class="btn btn-success m-2" style="float:right; margin-bottom: 9px;" onclick="downloadIRWA();"><i class="fa fa-upload" aria-hidden="true"></i>&nbsp; TTD</button>
                                <?php } ?>
                            </div>

                        <?php }
                                    if (!$hasData) { ?>
                            <tr>
                                <td class="text-center" colspan="11" style="height: 20px;"><b>DATA KOSOSNG.!</b></td>
                            </tr>
                        <?php } ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- start Modal Checklist PFID -->
<div class="modal fade" id="modalParaf2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Pengesahan Lembar Checklist IRWA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url(); ?>Usulan/simpanDeskIrwa" enctype="multipart/form-data">
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
<!-- End Modal Pengesahan Balai -->


<!-- start Modal Pengesahan Balai -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-custom">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">INPUT CHECKLIST IRWA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url(); ?>Usulan/simpaneditIrwa" enctype="multipart/form-data">
                    <input type="hidden" name="idEditSimoni" id="idEditSimoni">

                    <div class="card-body text-center table-responsive p-0 tableFixHead" style="position: relative; overflow-y: scroll; height: 83vh; padding: 2px; ">
                        <table class=" table-bordered tableX " id="myTabelUsulan" style="width:100%;">
                            <thead class="theadX" style="background-color:#18978F; color:#fff; border: 1px solid #000000 !important">
                                <!-- header utama -->
                                <tr id="boxThField">
                                    <th class="text-center" style="border: 1px solid #000000 !important" rowspan="2">No.</th>
                                    <th class="text-center" style="border: 1px solid #000000 !important" colspan="2" rowspan="2">DATA</th>
                                    <th class="text-center" style="border: 1px solid #000000 !important" rowspan="2">DESKRIPSI DATA</th>
                                    <th class="text-center" style="border: 1px solid #000000 !important" colspan="4">SIFAT DATA/ITEM</th>
                                    <th class="text-center" style="border: 1px solid #000000 !important" rowspan="2" style="width:30%;">Kesesuaian</th>
                                    <th class="text-center" style="border: 1px solid #000000 !important" rowspan="2">CATATAN</th>
                                </tr>
                                <tr id="boxThField">
                                    <th class="text-center" style="border: thin solid;">PEMBANGUNAN</th>
                                    <th class="text-center" style="border: thin solid;">PENINGKATAN LUASAN</th>
                                    <th class="text-center" style="border: thin solid;">PENINGKATAN FUNGSI</th>
                                    <th class="text-center" style="border: thin solid;">REHABILITAS</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_data">
                                <tr>

                                    <td class="text-left" rowspan="36">1</td>
                                    <td class="text-left" rowspan="2">Laporan Perencanaan SID/DED</td>
                                    <td class="text-left" colspan="2">SID (Survei Investigasi dan Desain)</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian1" id="Kesesuaian1_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left" rowspan="2"><textarea name="catat1" id="catat1_edit" rows="3"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="text-left" colspan="2">DED (Detail Engineering Design )</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian2" id="Kesesuaian2_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>

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
                                        <select class="form-control" name="Kesesuaian3" id="Kesesuaian3_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left" rowspan="4"><textarea name="catat2" id="catat2_edit" rows="3"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Data Muka Air</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian4" id="Kesesuaian4_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="text-left">Data Debit</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian5" id="Kesesuaian5_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="text-left">Data Klimatologi</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian6" id="Kesesuaian6_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="text-left" rowspan="2">Data Pasang Surut (untuk Irigasi Rawa/Tambak)</td>
                                    <td class="text-left">Data Pasang Surut (30 menitan minimal 15 hari)</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian7" id="Kesesuaian7_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left" rowspan="2"><textarea name="catat3" id="catat3_edit" rows="3"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Elevasi Penting (HHWL, HWL, MSL, LWL, LLWL)</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian8" id="Kesesuaian8_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="text-left" rowspan="3">Data Geologi</td>
                                    <td class="text-left">Peta Geologi Regional</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian9" id="Kesesuaian9_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left" rowspan="3"><textarea name="catat4" id="catat4_edit" rows="3"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Data Bor Log dan Analisisnya</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian10" id="Kesesuaian10_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="text-left">Peta CAT (Cekungan Air Tanah) (untuk usulan D.I.A.T)</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian11" id="Kesesuaian11_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="text-left" rowspan="13">Data Mekanika Tanah</td>
                                    <td class="text-left">- Kuat Dukung</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian12" id="Kesesuaian12_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left" rowspan="14"><textarea name="catat5" id="catat5_edit" rows="3"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="text-left">- Profil Lapisan Tanah (Jenis Tanah)</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian13" id="Kesesuaian13_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>

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

                                </tr>
                                <tr>
                                    <td class="text-left">- Berat isi</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian14" id="Kesesuaian14_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="text-left">- Berat Jenis</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian15" id="Kesesuaian15_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="text-left">- Kadar Air</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian16" id="Kesesuaian16_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="text-left">- Batas-batas Atterberg</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian17" id="Kesesuaian17_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="text-left">- Analisa Ayak</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian18" id="Kesesuaian18_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="text-left">- Analisa Hidrometer</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian19" id="Kesesuaian19_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>

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

                                </tr>
                                <tr>
                                    <td class="text-left">- Kohesi</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian20" id="Kesesuaian20_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="text-left">- Sudut geser dalam</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian21" id="Kesesuaian21_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="text-left">- Koefisien konsolidasi</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian22" id="Kesesuaian22_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="text-left" colspan="2">Data Kesesuaian Tanah untuk Pertanian</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian23" id="Kesesuaian23_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>

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
                                        <select class="form-control" name="Kesesuaian24" id="Kesesuaian24_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left" rowspan="4"><textarea name="catat6" id="catat6_edit" rows="3"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Debit Andalan</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian25" id="Kesesuaian25_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="text-left">Kebutuhan Air</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian26" id="Kesesuaian26_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="text-left">Neraca Air</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian27" id="Kesesuaian27_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="text-left" rowspan="3">Perhitungan Hidraulik</td>
                                    <td class="text-left">Perencanaan Dimensi Bangunan Utama<br></td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian28" id="Kesesuaian28_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left" rowspan="3"><textarea name="catat7" id="catat7_edit" rows="3"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Perencanaan Dimensi Saluran</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian29" id="Kesesuaian29_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="text-left">Perencanaan Dimensi Bangunan Air lainnya (talang, sipon, terjunan, bagi,<br>sadap…dll)</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian30" id="Kesesuaian30_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="text-left" rowspan="4">Perhitungan Stabilitas Struktur</td>
                                    <td class="text-left">Kestabilan Guling</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian31" id="Kesesuaian31_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left" rowspan="4"><textarea name="catat8" id="catat8_edit" rows="3"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Kestabilan Geser</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian32" id="Kesesuaian32_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="text-left">Penurunan (Settlement)</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian33" id="Kesesuaian33_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="text-left">Rembesan (Piping)</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian34" id="Kesesuaian34_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
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
                                        <select class="form-control" name="Kesesuaian35" id="Kesesuaian35_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left" rowspan="5"><textarea name="catat9" id="catat9_edit" rows="3"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="text-left" colspan="2">Elevasi Sungai</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian36" id="Kesesuaian36_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left" colspan="2">Elevasi Sawah Tertinggi</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian37" id="Kesesuaian37_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left" colspan="2">Peta 1:5000 (Layout )</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian38" id="Kesesuaian38_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left" colspan="2">Peta Petak (Petak Sawah Overlay Kontur)</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian39" id="Kesesuaian39_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left" rowspan="2">Peta Situasi</td>
                                    <td class="text-left">Peta 1:2000 (sungai, trase saluran)</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian40" id="Kesesuaian40_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left" rowspan="2"><textarea name="catat10" id="catat10_edit" rows="3"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Peta 1:500 (situasi lokasi bangunan)</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian41" id="Kesesuaian41_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Profil Memanjang</td>
                                    <td class="text-left">Kesesuaian Patok, Jarak, dan Elevasi terhadap Peta Situasi</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian42" id="Kesesuaian42_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left"><textarea name="catat11" id="catat11_edit" rows="3"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="text-left" rowspan="3">Profil Melintang</td>
                                    <td class="text-left">Kesesuaian dengan Profil Memanjang</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian43" id="Kesesuaian43_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left" rowspan="3"><textarea name="catat12" id="catat12_edit" rows="3"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Garis/Elevasi Kondisi Eksisting-Rencana, Galian, dan Timbunan</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian44" id="Kesesuaian44_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Elevasi Muka Air Rencana</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian45" id="Kesesuaian45_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left" rowspan="2">Peta IGT Daerah Irigasi</td>
                                    <td class="text-left">Verifikasi oleh Tim Peta Direktorat Irigasi dan Rawa</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian46" id="Kesesuaian46_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left" rowspan="2"><textarea name="catat13" id="catat13_edit" rows="3"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Kesesuaian Luas Informasi Geospasial Tematik (IGT) dengan Usulan</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian47" id="Kesesuaian47_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left" rowspan="3">Skema Jaringan</td>
                                    <td class="text-left">Kesesuaian Penggambaran dengan KP-07 (Standar Penggambaran)</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian48" id="Kesesuaian48_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left" rowspan="3">
                                        <textarea name="catat14" id="catat14_edit" rows="3"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Riwayat Pekerjaan</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian49" id="Kesesuaian49_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Rencana Pekerjaan yang Diusulkan</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian50" id="Kesesuaian50_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left" rowspan="3">Skema Bangunan</td>
                                    <td class="text-left">Kesesuaian Penggambaran dengan KP-07 (Standar Penggambaran)</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian51" id="Kesesuaian51_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left" rowspan="3"><textarea name="catat15" id="catat15_edit" rows="3"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Riwayat Pekerjaan</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian52" id="Kesesuaian52_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Rencana Pekerjaan yang Diusulkan</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian53" id="Kesesuaian53_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left" rowspan="3">Gambar Desain Bangunan Utama</td>
                                    <td class="text-left">Kesesuaian Dimensi dengan Nota Desain Perhitungan Bangunan</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian54" id="Kesesuaian54_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left" rowspan="3"><textarea name="catat16" id="catat16_edit" rows="3"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Kesesuaian Elevasi dengan Profil Memanjang dan Melintang</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian55" id="Kesesuaian55_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Elevasi Muka Air Rencana</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian56" id="Kesesuaian56_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left" rowspan="3">Gambar Desain Saluran</td>
                                    <td class="text-left">Kesesuaian Dimensi dengan Nota Desain Perhitungan Dimensi Saluran</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian57" id="Kesesuaian57_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left" rowspan="3"><textarea name="catat17" id="catat17_edit" rows="3"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Kesesuaian Elevasi dengan Profil Memanjang dan Melintang</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian58" id="Kesesuaian58_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Elevasi Muka Air Rencana</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian59" id="Kesesuaian59_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left" rowspan="3">Gambar Desain Bangunan Air lainnya</td>
                                    <td class="text-left">Kesesuaian Dimensi dengan Nota Desain Perhitungan Bangunan</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian60" id="Kesesuaian60_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left" rowspan="3"><textarea name="catat18" id="catat18_edit" rows="3"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Kesesuaian Elevasi dengan Profil Memanjang dan Melintang</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian61" id="Kesesuaian61_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="text-left">Elevasi Muka Air Rencana</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian62" id="Kesesuaian62_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left" rowspan="5">Data Tambahan Khusus Usulan D.I.R</td>
                                    <td class="text-left">Layout Jaringan Rawa</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian63" id="Kesesuaian63_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left" rowspan="5"><textarea name="catat19" id="catat19_edit" rows="3"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Peta Hidrotopografi</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak Wajib</td>
                                    <td class="text-left">Tidak Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian64" id="Kesesuaian64_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Peta Kedalaman Pirit</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak Wajib</td>
                                    <td class="text-left">Tidak Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian65" id="Kesesuaian65_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Peta Kedalaman Gambut</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak Wajib</td>
                                    <td class="text-left">Tidak Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian66" id="Kesesuaian66_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Peta Kesesuaian Lahan (RTRW)</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak Wajib</td>
                                    <td class="text-left">Tidak Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian67" id="Kesesuaian67_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
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
                                        <select class="form-control" name="Kesesuaian68" id="Kesesuaian68_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left"><textarea name="catat20" id="catat20_edit" rows="3"></textarea></td>
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
                                        <select class="form-control" name="Kesesuaian69" id="Kesesuaian69_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left"><textarea name="catat21" id="catat21_edit" rows="3"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Kesesuaian Peta Bidang Tanah dengan Sertifikat atau Berita Acara Pembayaran Ganti Rugi atas Tanah</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak Wajib</td>
                                    <td class="text-left">Tidak Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian70" id="Kesesuaian70_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left"><textarea name="catat22" id="catat22_edit" rows="3"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="text-left" rowspan="2">Hibah dari Masyarakat</td>
                                    <td class="text-left">Surat Hibah dari Masyarakat (Bermaterai)</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak Wajib</td>
                                    <td class="text-left">Tidak Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian71" id="Kesesuaian71_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left" rowspan="2"><textarea name="catat23" id="catat23_edit" rows="3"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Kesesuaian Peta Bidang Tanah dengan Surat Hibah dari Masyarakat</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Tidak Wajib</td>
                                    <td class="text-left">Tidak Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian72" id="Kesesuaian72_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
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
                                        <select class="form-control" name="Kesesuaian73" id="Kesesuaian73_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left">
                                        <textarea name="catat24" id="catat24_edit" rows="3"></textarea>
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
                                        <select class="form-control" name="Kesesuaian74" id="Kesesuaian74_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left"><textarea name="catat25" id="catat25_edit" rows="3"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="text-left" rowspan="2">Analisis Harga Satuan Pekerjaan (AHSP)</td>
                                    <td class="text-left">Kesesuaian Koefisien sesuai Permen PUPR No. 8 Tahun 2023 dan SE Dirjen BiKon No. 73 Tahun 2023</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian75" id="Kesesuaian75_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left" rowspan="2"><textarea name="catat26" id="catat26_edit" rows="3"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Standar Satuan Harga Barang dan Jasa Daerah terkait, yang Ditandatangani oleh Masing-masing Kepala Daerah</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian76" id="Kesesuaian76_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Sistem Manajemen Keselamatan Konstruksi (SMKK)</td>
                                    <td class="text-left">Kesesuaian Perhitungan dan Penggunaan Permen PUPR Nomor 10 tahun 2021</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian77" id="Kesesuaian77_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left"><textarea name="catat27" id="catat27_edit" rows="3"></textarea></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Penyusunan Rencana Anggaran Biaya (RAB)</td>
                                    <td class="text-left">Kesesuaian Data Rekapitulasi RAB terhadap Detail Pekerjaan serta Rincian Masing-masing Perhitungan Volume dan AHSP</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian78" id="Kesesuaian78_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left"><textarea name="catat28" id="catat28_edit" rows="3"></textarea></td>
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
                                        <select class="form-control" name="Kesesuaian79" id="Kesesuaian79_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left"><textarea name="catat29" id="catat29_edit" rows="3"></textarea></td>
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
                                        <select class="form-control" name="Kesesuaian80" id="Kesesuaian80_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left"><textarea name="catat30" id="catat30_edit" rows="3"></textarea></td>
                                </tr>

                                <tr>
                                    <td class="text-left">9</td>
                                    <td class="text-left">Petani Penerima Manfaat</td>
                                    <td class="text-left">Surat Pernyataan dari Perwakilan Petani Penerima Manfaat pada DI tersebut</td>
                                    <td class="text-left">Mencantumkan jumlah petani pada ruas DI yang dikerjakan</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">Wajib</td>
                                    <td class="text-left">
                                        <select class="form-control" name="Kesesuaian81" id="Kesesuaian81_edit">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </td>
                                    <td class="text-left"><textarea name="catat31" id="catat31_edit" rows="3"></textarea></td>
                                </tr>

                            </tbody>
                        </table>
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

        downloadIRWA = function() {
            $('#modalParaf2').modal('show');
        }

        $('#kategoriDi').on('change', function() {

            let val = this.value;

            if (val == 'BARU') {

                $('#daerahIrigasi').prop('required', false);
                $('#daerahIrigasiBaru').prop('required', true);
                $('#irigasi-input').hide();
                $('#irigasi-baru-input').show();

            } else {

                $('#daerahIrigasi').prop('required', true);
                $('#daerahIrigasiBaru').prop('required', false);

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
                    $('#idEditSimoni').val(data.dataSimoni.id);

                    $('#Kesesuaian1_edit').val(data.dataSimoni.Kesesuaian1);
                    $('#Kesesuaian2_edit').val(data.dataSimoni.Kesesuaian2);
                    $('#Kesesuaian3_edit').val(data.dataSimoni.Kesesuaian3);
                    $('#Kesesuaian4_edit').val(data.dataSimoni.Kesesuaian4);
                    $('#Kesesuaian5_edit').val(data.dataSimoni.Kesesuaian5);
                    $('#Kesesuaian6_edit').val(data.dataSimoni.Kesesuaian6);
                    $('#Kesesuaian7_edit').val(data.dataSimoni.Kesesuaian7);
                    $('#Kesesuaian8_edit').val(data.dataSimoni.Kesesuaian8);
                    $('#Kesesuaian9_edit').val(data.dataSimoni.Kesesuaian9);
                    $('#Kesesuaian10_edit').val(data.dataSimoni.Kesesuaian10);
                    $('#Kesesuaian11_edit').val(data.dataSimoni.Kesesuaian11);
                    $('#Kesesuaian12_edit').val(data.dataSimoni.Kesesuaian12);
                    $('#Kesesuaian13_edit').val(data.dataSimoni.Kesesuaian13);
                    $('#Kesesuaian14_edit').val(data.dataSimoni.Kesesuaian14);
                    $('#Kesesuaian15_edit').val(data.dataSimoni.Kesesuaian15);
                    $('#Kesesuaian16_edit').val(data.dataSimoni.Kesesuaian16);
                    $('#Kesesuaian17_edit').val(data.dataSimoni.Kesesuaian17);
                    $('#Kesesuaian18_edit').val(data.dataSimoni.Kesesuaian18);
                    $('#Kesesuaian19_edit').val(data.dataSimoni.Kesesuaian19);
                    $('#Kesesuaian20_edit').val(data.dataSimoni.Kesesuaian20);
                    $('#Kesesuaian21_edit').val(data.dataSimoni.Kesesuaian21);
                    $('#Kesesuaian22_edit').val(data.dataSimoni.Kesesuaian22);
                    $('#Kesesuaian23_edit').val(data.dataSimoni.Kesesuaian23);
                    $('#Kesesuaian24_edit').val(data.dataSimoni.Kesesuaian24);
                    $('#Kesesuaian25_edit').val(data.dataSimoni.Kesesuaian25);
                    $('#Kesesuaian26_edit').val(data.dataSimoni.Kesesuaian26);
                    $('#Kesesuaian27_edit').val(data.dataSimoni.Kesesuaian27);
                    $('#Kesesuaian28_edit').val(data.dataSimoni.Kesesuaian28);
                    $('#Kesesuaian29_edit').val(data.dataSimoni.Kesesuaian29);
                    $('#Kesesuaian30_edit').val(data.dataSimoni.Kesesuaian30);
                    $('#Kesesuaian31_edit').val(data.dataSimoni.Kesesuaian31);
                    $('#Kesesuaian32_edit').val(data.dataSimoni.Kesesuaian32);
                    $('#Kesesuaian33_edit').val(data.dataSimoni.Kesesuaian33);
                    $('#Kesesuaian34_edit').val(data.dataSimoni.Kesesuaian34);
                    $('#Kesesuaian35_edit').val(data.dataSimoni.Kesesuaian35);
                    $('#Kesesuaian36_edit').val(data.dataSimoni.Kesesuaian36);
                    $('#Kesesuaian37_edit').val(data.dataSimoni.Kesesuaian37);
                    $('#Kesesuaian38_edit').val(data.dataSimoni.Kesesuaian38);
                    $('#Kesesuaian39_edit').val(data.dataSimoni.Kesesuaian39);
                    $('#Kesesuaian40_edit').val(data.dataSimoni.Kesesuaian40);
                    $('#Kesesuaian41_edit').val(data.dataSimoni.Kesesuaian41);
                    $('#Kesesuaian42_edit').val(data.dataSimoni.Kesesuaian42);
                    $('#Kesesuaian43_edit').val(data.dataSimoni.Kesesuaian43);
                    $('#Kesesuaian44_edit').val(data.dataSimoni.Kesesuaian44);
                    $('#Kesesuaian45_edit').val(data.dataSimoni.Kesesuaian45);
                    $('#Kesesuaian46_edit').val(data.dataSimoni.Kesesuaian46);
                    $('#Kesesuaian47_edit').val(data.dataSimoni.Kesesuaian47);
                    $('#Kesesuaian48_edit').val(data.dataSimoni.Kesesuaian48);
                    $('#Kesesuaian49_edit').val(data.dataSimoni.Kesesuaian49);
                    $('#Kesesuaian50_edit').val(data.dataSimoni.Kesesuaian50);
                    $('#Kesesuaian51_edit').val(data.dataSimoni.Kesesuaian51);
                    $('#Kesesuaian52_edit').val(data.dataSimoni.Kesesuaian52);
                    $('#Kesesuaian53_edit').val(data.dataSimoni.Kesesuaian53);
                    $('#Kesesuaian54_edit').val(data.dataSimoni.Kesesuaian54);
                    $('#Kesesuaian55_edit').val(data.dataSimoni.Kesesuaian55);
                    $('#Kesesuaian56_edit').val(data.dataSimoni.Kesesuaian56);
                    $('#Kesesuaian57_edit').val(data.dataSimoni.Kesesuaian57);
                    $('#Kesesuaian58_edit').val(data.dataSimoni.Kesesuaian58);
                    $('#Kesesuaian59_edit').val(data.dataSimoni.Kesesuaian59);
                    $('#Kesesuaian60_edit').val(data.dataSimoni.Kesesuaian60);
                    $('#Kesesuaian61_edit').val(data.dataSimoni.Kesesuaian61);
                    $('#Kesesuaian62_edit').val(data.dataSimoni.Kesesuaian62);
                    $('#Kesesuaian63_edit').val(data.dataSimoni.Kesesuaian63);
                    $('#Kesesuaian64_edit').val(data.dataSimoni.Kesesuaian64);
                    $('#Kesesuaian65_edit').val(data.dataSimoni.Kesesuaian65);
                    $('#Kesesuaian66_edit').val(data.dataSimoni.Kesesuaian66);
                    $('#Kesesuaian67_edit').val(data.dataSimoni.Kesesuaian67);
                    $('#Kesesuaian68_edit').val(data.dataSimoni.Kesesuaian68);
                    $('#Kesesuaian69_edit').val(data.dataSimoni.Kesesuaian69);
                    $('#Kesesuaian70_edit').val(data.dataSimoni.Kesesuaian70);
                    $('#Kesesuaian71_edit').val(data.dataSimoni.Kesesuaian71);
                    $('#Kesesuaian72_edit').val(data.dataSimoni.Kesesuaian72);
                    $('#Kesesuaian73_edit').val(data.dataSimoni.Kesesuaian73);
                    $('#Kesesuaian74_edit').val(data.dataSimoni.Kesesuaian74);
                    $('#Kesesuaian75_edit').val(data.dataSimoni.Kesesuaian75);
                    $('#Kesesuaian76_edit').val(data.dataSimoni.Kesesuaian76);
                    $('#Kesesuaian77_edit').val(data.dataSimoni.Kesesuaian77);
                    $('#Kesesuaian78_edit').val(data.dataSimoni.Kesesuaian78);
                    $('#Kesesuaian79_edit').val(data.dataSimoni.Kesesuaian79);
                    $('#Kesesuaian80_edit').val(data.dataSimoni.Kesesuaian80);
                    $('#Kesesuaian81_edit').val(data.dataSimoni.Kesesuaian81);
                    $('#catat1_edit').val(data.dataSimoni.catat1);
                    $('#catat2_edit').val(data.dataSimoni.catat2);
                    $('#catat3_edit').val(data.dataSimoni.catat3);
                    $('#catat4_edit').val(data.dataSimoni.catat4);
                    $('#catat5_edit').val(data.dataSimoni.catat5);
                    $('#catat6_edit').val(data.dataSimoni.catat6);
                    $('#catat7_edit').val(data.dataSimoni.catat7);
                    $('#catat8_edit').val(data.dataSimoni.catat8);
                    $('#catat9_edit').val(data.dataSimoni.catat9);
                    $('#catat10_edit').val(data.dataSimoni.catat10);
                    $('#catat11_edit').val(data.dataSimoni.catat11);
                    $('#catat12_edit').val(data.dataSimoni.catat12);
                    $('#catat13_edit').val(data.dataSimoni.catat13);
                    $('#catat14_edit').val(data.dataSimoni.catat14);
                    $('#catat15_edit').val(data.dataSimoni.catat15);
                    $('#catat16_edit').val(data.dataSimoni.catat16);
                    $('#catat17_edit').val(data.dataSimoni.catat17);
                    $('#catat18_edit').val(data.dataSimoni.catat18);
                    $('#catat19_edit').val(data.dataSimoni.catat19);
                    $('#catat20_edit').val(data.dataSimoni.catat20);
                    $('#catat21_edit').val(data.dataSimoni.catat21);
                    $('#catat22_edit').val(data.dataSimoni.catat22);
                    $('#catat23_edit').val(data.dataSimoni.catat23);
                    $('#catat24_edit').val(data.dataSimoni.catat24);
                    $('#catat25_edit').val(data.dataSimoni.catat25);
                    $('#catat26_edit').val(data.dataSimoni.catat26);
                    $('#catat27_edit').val(data.dataSimoni.catat27);
                    $('#catat28_edit').val(data.dataSimoni.catat28);
                    $('#catat29_edit').val(data.dataSimoni.catat29);
                    $('#catat30_edit').val(data.dataSimoni.catat30);
                    $('#catat31_edit').val(data.dataSimoni.catat31);



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

                $('#wsPilihEdit').prop('required', true);
                $('#dasEdit').prop('required', true);
                $('#kategoriDi_edit').prop('required', false);
                $('#daerahIrigasi_edit').prop('required', false);
                $('#daerahIrigasiBaru_edit').prop('required', false);

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

            // 	$('#wsPilihEdit').prop('required', false);
            // 	$('#dasEdit').prop('required', false);
            // 	$('#kategoriDi_edit').prop('required', true);

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

                $('#wsPilihEdit').prop('required', false);
                $('#dasEdit').prop('required', false);
                $('#kategoriDi_edit').prop('required', true);

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

                $('#daerahIrigasi_edit').prop('required', false);
                $('#daerahIrigasiBaru_edit').prop('required', true);
                $('#irigasi-input-edit').hide();
                $('#irigasi-baru-input-edit').show();

            } else {

                $('#daerahIrigasi_edit').prop('required', true);
                $('#daerahIrigasiBaru_edit').prop('required', false);
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
                    $('#jenisOutcome').prop('required', false);
                    $('#wsPilih').prop('required', true);
                    $('#das').prop('required', true);
                    $('#kategoriDi').prop('required', false);
                    $('#daerahIrigasi').prop('required', false);
                    $('#daerahIrigasiBaru').prop('required', false);
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
                    $('#jenisOutcome').prop('required', false);
                    $('#wsPilih').prop('required', false);
                    $('#das').prop('required', false);
                    $('#kategoriDi').prop('required', true);
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
                    $('#jenisOutcome').prop('required', true);
                    $('#wsPilih').prop('required', false);
                    $('#das').prop('required', false);
                    $('#kategoriDi').prop('required', true);
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
                    $('#jenisOutcome').prop('required', false);
                    $('#wsPilih').prop('required', false);
                    $('#das').prop('required', false);
                    $('#kategoriDi').prop('required', true);
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