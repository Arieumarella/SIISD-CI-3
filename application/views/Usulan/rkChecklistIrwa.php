<!DOCTYPE html>
<html>

<head>

    <style>
        .text-center {
            text-align: center;
        }

        .font-weight-bolder {
            font-weight: bolder;
        }

        .table-bordered {
            border-collapse: collapse;
            width: 100%;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid black;
            padding: 8px;
        }

        .table-bordered th {
            background-color: #f2f2f2;
        }

        .theadX th {
            background-color: #d9edf7;
        }

        .text-right {
            text-align: top;
        }

        .tableKomponen {
            width: 90%;

        }

        .tableKomponen td {
            padding: 1px;
            margin: 0px;
            border: 1px #9eb9cd !important;
        }

        .border-bottom {
            border-bottom: 1px solid #000000;
        }

        .signature {
            margin-top: 50px;
            text-align: right;

        }

        .signature img {
            width: 70px;
            height: auto;
        }

        .tableX {
            width: 100%;
            border-collapse: collapse;
        }

        .tableX,
        .tableX th,
        .tableX td {
            border: 1px solid black;
        }

        thead {
            display: table-header-group;
            /* Ensure header is repeated */
        }

        tbody tr {
            page-break-inside: avoid;
            /* Prevent row breaks inside */
        }

        @media print {
            .tableX tr {
                page-break-inside: avoid;
            }

            .tableX {
                page-break-before: auto;
            }
        }
    </style>
</head>

<body>
    <!-- Judul -->
    <div class="text-center">
        <h4 class="mt-4">CHECKLIST IRIGASI dan RAWA</h4>
        <h4>PENILAIAN DANA ALOKASI KHUSUS DAK BIDANG IRIGASI TA. <?= $this->session->userdata('thang'); ?></h4>
        <h4 class="font-weight-bolder"><?= $nmKabkota; ?></h4>
    </div>
    <br>

    <?php if ($dataParafIrwa != null) { ?>
        <?php
        $lastVal = end($dataParafIrwa); // Ambil elemen terakhir dari array $dataParaf
        ?>
        <h4>Nama : <?= $lastVal->nama; ?></h4>
        <h4>Desk : <?= $lastVal->desk; ?></h4>
    <?php } ?>

    <!-- Tabel -->
    <table class="tableX" id="myTabelUsulan">
        <thead class="theadX">

            <tr id="boxThField">
                <th class="text-center" rowspan="2">Nama D.I</th>
                <th class="text-center" rowspan="2" style="width: 4%;">No.</th>
                <th class="text-center" colspan="2" rowspan="2">DATA</th>
                <th class="text-center" rowspan="2">DESKRIPSI DATA</th>
                <th class="text-center" colspan="4">SIFAT DATA/ITEM</th>
                <th class="text-center" rowspan="2" style="width: 11%;">KESESUAIAN</th>
                <th class="text-center" rowspan="2" style="width: 12%;">CATATAN</th>
            </tr>
            <tr id="boxThField">

                <th class="text-center">PEMBANGUNAN</th>
                <th class="text-center">PENINGKATAN LUASAN</th>
                <th class="text-center">PENINGKATAN FUNGSI</th>
                <th class="text-center">REHABILITAS</th>
            </tr>

        </thead>
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
                            <?php
                            $kotakabid = !empty($kotakabid) ? $kotakabid : 'default_value'; // Pastikan $kotakabid memiliki nilai
                            $provid = !empty($provid) ? $provid : 'default_value';
                            ?>
                            <td rowspan="82">
                                <?php
                                if ($val->kd_menu === '9') {
                                    echo '<b>WS : </b>' . $val->nm_ws;
                                    echo '<br>';
                                    echo '<b>DAS : </b>' . $val->nm_das;
                                } else {
                                    echo '<b>' . $val->nm_di . '</b>';
                                } ?>
                            </td>
                            <td class="text-left" rowspan="36" style="width: 4%;">1</td>
                            <td class="text-left" rowspan="2">Laporan Perencanaan SID/DED</td>
                            <td class="text-left" colspan="2">SID (Survei Investigasi dan Desain)</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left" style="width: 11%;"></td>
                            <td class="text-left" style="width: 12%;" rowspan="2"></td>
                        </tr>
                        <tr>
                            <td class="text-left" colspan="2">DED (Detail Engineering Design )</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left" rowspan="23">Data Pendukung</td>
                            <td class="text-left" rowspan="4">Data Hidrologi (Panjang Data Historis Minimal 10 Tahun)</td>
                            <td class="text-left">Data Curah Hujan</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left" rowspan="23"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Data Muka Air</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left">Data Debit</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left">Data Klimatologi</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left" rowspan="2">Data Pasang Surut (untuk Irigasi Rawa/Tambak)</td>
                            <td class="text-left">Data Pasang Surut (30 menitan minimal 15 hari)</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left">Elevasi Penting (HHWL, HWL, MSL, LWL, LLWL)</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left" rowspan="3">Data Geologi</td>
                            <td class="text-left">Peta Geologi Regional</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left">Data Bor Log dan Analisisnya</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left">Peta CAT (Cekungan Air Tanah) (untuk usulan D.I.A.T)</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left" rowspan="13">Data Mekanika Tanah</td>
                            <td class="text-left">- Kuat Dukung</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left">- Profil Lapisan Tanah (Jenis Tanah)</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>

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
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left">- Berat Jenis</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left">- Kadar Air</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left">- Batas-batas Atterberg</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left">- Analisa Ayak</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left">- Analisa Hidrometer</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>

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
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left">- Sudut geser dalam</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left">- Koefisien konsolidasi</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left" colspan="2">Data Kesesuaian Tanah untuk Pertanian</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left" rowspan="11">Nota Perhitungan Desain</td>
                            <td class="text-left" rowspan="4">Perhitungan Hidrologi</td>
                            <td class="text-left">Debit Banjir Rancangan</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left" rowspan="11"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Debit Andalan</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left">Kebutuhan Air</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left">Neraca Air</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left" rowspan="3">Perhitungan Hidraulik</td>
                            <td class="text-left">Perencanaan Dimensi Bangunan Utama<br></td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left">Perencanaan Dimensi Saluran</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left">Perencanaan Dimensi Bangunan Air lainnya (talang, sipon, terjunan, bagi,<br>sadap…dll)</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left" rowspan="4">Perhitungan Stabilitas Struktur</td>
                            <td class="text-left">Kestabilan Guling</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left">Kestabilan Geser</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left">Penurunan (Settlement)</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left">Rembesan (Piping)</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>

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
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Elevasi Sungai</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Elevasi Sawah Tertinggi</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Peta 1:5000 (Layout )</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Peta Petak (Petak Sawah Overlay Kontur)</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left" rowspan="2">Peta Situasi</td>
                            <td class="text-left">Peta 1:2000 (sungai, trase saluran)</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Peta 1:500 (situasi lokasi bangunan)</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Profil Memanjang</td>
                            <td class="text-left">Kesesuaian Patok, Jarak, dan Elevasi terhadap Peta Situasi</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left" rowspan="3">Profil Melintang</td>
                            <td class="text-left">Kesesuaian dengan Profil Memanjang</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Garis/Elevasi Kondisi Eksisting-Rencana, Galian, dan Timbunan</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Elevasi Muka Air Rencana</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left" rowspan="2">Peta IGT Daerah Irigasi</td>
                            <td class="text-left">Verifikasi oleh Tim Peta Direktorat Irigasi dan Rawa</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Kesesuaian Luas Informasi Geospasial Tematik (IGT) dengan Usulan</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left" rowspan="3">Skema Jaringan</td>
                            <td class="text-left">Kesesuaian Penggambaran dengan KP-07 (Standar Penggambaran)</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Riwayat Pekerjaan</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Rencana Pekerjaan yang Diusulkan</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left" rowspan="3">Skema Bangunan</td>
                            <td class="text-left">Kesesuaian Penggambaran dengan KP-07 (Standar Penggambaran)</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Riwayat Pekerjaan</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Rencana Pekerjaan yang Diusulkan</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left" rowspan="3">Gambar Desain Bangunan Utama</td>
                            <td class="text-left">Kesesuaian Dimensi dengan Nota Desain Perhitungan Bangunan</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Kesesuaian Elevasi dengan Profil Memanjang dan Melintang</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Elevasi Muka Air Rencana</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left" rowspan="2">Gambar Desain Saluran</td>
                            <td class="text-left">Kesesuaian Dimensi dengan Nota Desain Perhitungan Dimensi Saluran</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Kesesuaian Elevasi dengan Profil Memanjang dan Melintang</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Elevasi Muka Air Rencana</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left" rowspan="3">Gambar Desain Bangunan Air lainnya</td>
                            <td class="text-left">Kesesuaian Dimensi dengan Nota Desain Perhitungan Bangunan</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Kesesuaian Elevasi dengan Profil Memanjang dan Melintang</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Elevasi Muka Air Rencana</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left" rowspan="5">Data Tambahan Khusus Usulan D.I.R</td>
                            <td class="text-left">Layout Jaringan Rawa</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Peta Hidrotopografi</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak Wajib</td>
                            <td class="text-left">Tidak Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Peta Kedalaman Pirit</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak Wajib</td>
                            <td class="text-left">Tidak Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Peta Kedalaman Gambut</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak Wajib</td>
                            <td class="text-left">Tidak Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Peta Kesesuaian Lahan (RTRW)</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak Wajib</td>
                            <td class="text-left">Tidak Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
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
                            <td class="text-left"></td>
                            <td class="text-left"></td>
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
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Kesesuaian Peta Bidang Tanah dengan Sertifikat atau Berita Acara Pembayaran Ganti Rugi atas Tanah</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak Wajib</td>
                            <td class="text-left">Tidak Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left" rowspan="2">Hibah dari Masyarakat</td>
                            <td class="text-left">Surat Hibah dari Masyarakat (Bermaterai)</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak Wajib</td>
                            <td class="text-left">Tidak Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Kesesuaian Peta Bidang Tanah dengan Surat Hibah dari Masyarakat</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak Wajib</td>
                            <td class="text-left">Tidak Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
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
                            <td class="text-left"></td>
                            <td class="text-left"></td>
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
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left" rowspan="2">Analisis Harga Satuan Pekerjaan (AHSP)</td>
                            <td class="text-left">Kesesuaian Koefisien sesuai Permen PUPR No. 8 Tahun 2023 dan SE Dirjen BiKon No. 73 Tahun 2023</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Standar Satuan Harga Barang dan Jasa Daerah terkait, yang Ditandatangani oleh Masing-masing Kepala Daerah</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Sistem Manajemen Keselamatan Konstruksi (SMKK)</td>
                            <td class="text-left">Kesesuaian Perhitungan dan Penggunaan Permen PUPR Nomor 10 tahun 2021</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">Penyusunan Rencana Anggaran Biaya (RAB)</td>
                            <td class="text-left">Kesesuaian Data Rekapitulasi RAB terhadap Detail Pekerjaan serta Rincian Masing-masing Perhitungan Volume dan AHSP</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
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
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-left">8</td>
                            <td class="text-left">Cetak Sawah</td>
                            <td class="text-left">Surat Pernyataan Kesanggupan Cetak Sawah dari Dinas Pertanian Setempat</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Wajib</td>
                            <td class="text-left">Tidak Wajib</td>
                            <td class="text-left">Tidak Wajib</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                        </tr>

                    <?php } ?>
                <?php } ?>
            <?php }
            if (!$hasData) { ?>
                <tr>
                    <td class="text-center" colspan="11" style="height: 20px;"><b>DATA KOSOSNG.!</b></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>