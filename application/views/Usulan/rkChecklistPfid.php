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
        <h4 class="mt-4">CHECKLIST PFID</h4>
        <h4>PENILAIAN DANA ALOKASI KHUSUS BIDANG IRIGASI TA. <?= $this->session->userdata('thang'); ?></h4>
        <h4 class="font-weight-bolder"><?= $nmKabkota; ?></h4>
    </div>
    <br>

    <?php if ($dataParaf != null) { ?>
        <?php
        $lastVal = end($dataParaf); // Ambil elemen terakhir dari array $dataParaf
        ?>
        <h4>Nama : <?= $lastVal->nama; ?></h4>
        <h4>Desk : <?= $lastVal->desk; ?></h4>
    <?php } ?>

    <!-- Tabel -->
    <table class="tableX" id="myTabelUsulan">
        <thead class="theadX">

            <tr style="background-color: #DCDCDC ">
                <th class="text-center" rowspan="1" style="width:4%;">No.</th>
                <th class="text-center" rowspan="1" style="width:10%;">NAMA D.I</th>
                <th class="text-center" rowspan="1" style="width:16%;">TAHUN LAPORAN</th>
                <th class="text-center" rowspan="1" style="width:15%;">PENGAMATAN ASET</th>
                <th class="text-center" rowspan="1" style="width: 11%;">USULAN</th>
                <th class="text-center" rowspan="1" style="width: 11%;">ASET</th>
                <th class="text-center" rowspan="1" style="width: 11%;">KONDISI < 60%</th>
                <th class="text-center" rowspan="1" style="width: 11%;">KONDISI > 60%</th>
                <th class="text-center" rowspan="1" style="width: 11%;">KESUAIAIN</th>
            </tr>

        </thead>
        <tbody id="tbody_data">
            <?php if ($dataKegiatan != null) {
                usort($dataKegiatan, function ($a, $b) {
                    $order = ['1', '2', '3', '9'];
                    $pos_a = array_search($a->kd_menu, $order);
                    $pos_b = array_search($b->kd_menu, $order);
                    return $pos_a - $pos_b;
                }); ?>
                <?php $no = 1;
                foreach ($dataKegiatan as $key => $val) { ?>
                    <tr>
                        <td class="text-center" style="width:4%;">
                            <?= $no++; ?></td>
                        <td class="text-left" style="width:10%;">
                            <?= $val->nm_di; ?>
                        </td>
                        <td class="text-left" style="width:16%;">
                            <br><br>
                            Tahun Laporan SID : <br><br>
                            <table class="tableKomponen">
                                <tr>
                                    <td class="text-center" style="width:70%; height:20px">
                                        <?= !empty($val->laporan_sid) ? $val->laporan_sid : '0'; ?>
                                    </td>
                                </tr>
                            </table>
                            <br><br>
                            Tahun Laporan DED : <br><br>
                            <table class="tableKomponen">
                                <tr>
                                    <td class="text-center" style="width:70%; height:20px">
                                        <?= !empty($val->laporan_ded) ? $val->laporan_ded : '0'; ?>
                                    </td>
                                </tr>
                            </table>
                            <br><br>
                            Gambar Rencana : <br><br>
                            <table class="tableKomponen">
                                <tr>
                                    <td class="text-center" style="width:70%; height:20px">
                                        <?= !empty($val->gambar_rencana) ? $val->gambar_rencana : '0'; ?>
                                    </td>
                                </tr>
                            </table>
                            <br><br>
                        </td>
                        <td style="width:15%;" class="text-center"><br><br>Bangunan Utama (bh) <br><br><br>Saluran Primer (m)
                            <br><br><br>Saluran Sekunder (m) <br><br><br> Bangunan Pengatur (bh) <br>(Bagi, Bagi Sadap, Sadap)
                        </td>
                        <td class="text-center" style="width: 11%;">
                            <br><br>
                            <table class="tableKomponen">
                                <tr>
                                    <td class="text-center" style="width:70%; height:20px">
                                        <?php if ($val->komponen_json != null) { ?>
                                            <?php
                                            // Konvert data komponen JSON -> Array
                                            $dataKomponenArray = json_decode($val->komponen_json, true);
                                            $totalVolume = 0; // Variabel untuk menyimpan total volume
                                            ?>
                                            <?php foreach ($dataKomponenArray as $datakomponen) { ?>
                                                <?php if (in_array($datakomponen['nm_komponen'], ['Bendung', 'Embung', 'Pengambilan Bebas'])) { ?>
                                                    <?php
                                                    // Menambahkan volume ke total
                                                    $totalVolume += $datakomponen['volume'];
                                                    ?>
                                                <?php } ?>
                                            <?php } ?>
                                            <?= htmlspecialchars($totalVolume, ENT_QUOTES, 'UTF-8') ?>
                                        <?php } else { ?>
                                            0
                                        <?php } ?>
                                    </td>
                                </tr>
                            </table>
                            <br><br><br>
                            <table class="tableKomponen">
                                <tr>
                                    <td class="text-center" style="width:70%; height:20px">
                                        <?php if ($val->komponen_json != null) { ?>
                                            <?php
                                            // Konvert data komponen JSON -> Array
                                            $dataKomponenArray = json_decode($val->komponen_json, true);
                                            $totalVolume = 0; // Variabel untuk menyimpan total volume
                                            ?>
                                            <?php foreach ($dataKomponenArray as $datakomponen) { ?>
                                                <?php if (in_array($datakomponen['nm_komponen'], ['Saluran Primer'])) { ?>
                                                    <?php
                                                    // Menambahkan volume ke total
                                                    $totalVolume += $datakomponen['volume'];
                                                    ?>
                                                <?php } ?>
                                            <?php } ?>
                                            <?= htmlspecialchars($totalVolume, ENT_QUOTES, 'UTF-8') ?>

                                        <?php } else { ?>
                                            0
                                        <?php } ?>
                                    </td>
                                </tr>

                            </table>
                            <br><br><br>
                            <table class="tableKomponen">
                                <tr>
                                    <td class="text-center" style="width:70%; height:20px">
                                        <?php if ($val->komponen_json != null) { ?>
                                            <?php
                                            // Konvert data komponen JSON -> Array
                                            $dataKomponenArray = json_decode($val->komponen_json, true);
                                            $totalVolume = 0; // Variabel untuk menyimpan total volume
                                            ?>
                                            <?php foreach ($dataKomponenArray as $datakomponen) { ?>
                                                <?php if (in_array($datakomponen['nm_komponen'], ['Saluran Sekunder'])) { ?>
                                                    <?php
                                                    // Menambahkan volume ke total
                                                    $totalVolume += $datakomponen['volume'];
                                                    ?>
                                                <?php } ?>
                                            <?php } ?>
                                            <?= htmlspecialchars($totalVolume, ENT_QUOTES, 'UTF-8') ?>
                                        <?php } else { ?>
                                            0
                                        <?php } ?>
                                    </td>
                                </tr>

                            </table>
                            <br><br><br>
                            <table class="tableKomponen">
                                <tr>
                                    <td class="text-center" style="width:70%; height:20px">
                                        <?php if ($val->komponen_json != null) { ?>
                                            <?php
                                            // Konvert data komponen JSON -> Array
                                            $dataKomponenArray = json_decode($val->komponen_json, true);
                                            $totalVolume = 0; // Variabel untuk menyimpan total volume
                                            ?>
                                            <?php foreach ($dataKomponenArray as $datakomponen) { ?>
                                                <?php if (in_array($datakomponen['nm_komponen'], ['Bangunan Bagi', 'Bangunan Sadap', 'Bangunan Bagi Sadap'])) { ?>
                                                    <?php
                                                    // Menambahkan volume ke total
                                                    $totalVolume += $datakomponen['volume'];
                                                    ?>
                                                <?php } ?>
                                            <?php } ?>
                                            <?= htmlspecialchars($totalVolume, ENT_QUOTES, 'UTF-8') ?>

                                        <?php } else { ?>
                                            0
                                        <?php } ?>
                                    </td>
                                </tr>

                            </table>
                        </td>
                        <td class="text-center" style="width: 11%;">
                            <br><br>
                            <table class="tableKomponen">
                                <tr>
                                    <td class="text-center" style="width:70%; height:20px">
                                        <?= !empty($val->buBendung + $val->buEmbung + $val->buPengambilanBebas) ? $val->buBendung + $val->buEmbung + $val->buPengambilanBebas : '0'; ?>
                                    </td>
                                </tr>

                            </table>
                            <br><br><br>
                            <table class="tableKomponen">
                                <tr>
                                    <td class="text-center" style="width:70%; height:20px">
                                        <?= !empty($val->sPrimer) ? intval($val->sPrimer) : '0'; ?>
                                    </td>
                                </tr>

                            </table>
                            <br><br><br>
                            <table class="tableKomponen">
                                <tr>
                                    <td class="text-center" style="width:70%; height:20px">
                                        <?= !empty($val->sSekunder) ? intval($val->sSekunder) : '0'; ?>
                                    </td>
                                </tr>

                            </table>
                            <br><br><br>
                            <table class="tableKomponen">
                                <tr>
                                    <td class="text-center" style="width:70%; height:20px">
                                        <?= !empty($val->bppBagi + $val->bppBagiSadap + $val->bppSadap) ? $val->bppBagi + $val->bppBagiSadap + $val->bppSadap : '0'; ?>
                                    </td>
                                </tr>

                            </table>
                        </td>
                        <td class="text-center" style="width: 11%;">
                            <br><br>
                            <table class="tableKomponen">
                                <tr>
                                    <td class="text-center" style="width:70%; height:20px">
                                        <?= !empty($val->kondisi_kurang_bu) ? $val->kondisi_kurang_bu : '0'; ?>
                                    </td>
                                </tr>

                            </table>
                            <br><br><br>
                            <table class="tableKomponen">
                                <tr>
                                    <td class="text-center" style="width:70%; height:20px">
                                        <?= !empty($val->kondisi_kurang_sp) ? $val->kondisi_kurang_sp : '0'; ?>
                                    </td>
                                </tr>

                            </table>
                            <br><br><br>
                            <table class="tableKomponen">
                                <tr>
                                    <td class="text-center" style="width:70%; height:20px">
                                        <?= !empty($val->kondisi_kurang_ss) ? $val->kondisi_kurang_ss : '0'; ?>
                                    </td>
                                </tr>

                            </table>
                            <br><br><br>
                            <table class="tableKomponen">
                                <tr>
                                    <td class="text-center" style="width:70%; height:20px">
                                        <?= !empty($val->kondisi_kurang_bp) ? $val->kondisi_kurang_bp : '0'; ?>
                                    </td>
                                </tr>

                            </table>
                        </td>


                        <td class="text-center" style="width: 11%;">
                            <br><br>
                            <table class="tableKomponen">
                                <tr>
                                    <td class="text-center" style="width:70%; height:20px">
                                        <?= !empty($val->kondisi_lebih_bu) ? $val->kondisi_lebih_bu : '0'; ?>
                                    </td>
                                </tr>

                            </table>
                            <br><br><br>
                            <table class="tableKomponen">
                                <tr>
                                    <td class="text-center" style="width:70%; height:20px">
                                        <?= !empty($val->kondisi_lebih_sp) ? $val->kondisi_lebih_sp : '0'; ?>
                                    </td>
                                </tr>

                            </table>
                            <br><br><br>
                            <table class="tableKomponen">
                                <tr>
                                    <td class="text-center" style="width:70%; height:20px">
                                        <?= !empty($val->kondisi_lebih_ss) ? $val->kondisi_lebih_ss : '0'; ?>
                                    </td>
                                </tr>

                            </table>
                            <br><br><br>
                            <table class="tableKomponen">
                                <tr>
                                    <td class="text-center" style="width:70%; height:20px">
                                        <?= !empty($val->kondisi_lebih_bp) ? $val->kondisi_lebih_bp : '0'; ?>
                                    </td>
                                </tr>

                            </table>
                        </td>
                        <td class="text-center" style="width: 11%;">
                            <br><br>
                            <table class="tableKomponen">
                                <tr>
                                    <td class="text-center" style="width:70%; height:20px">
                                        <?= !empty($val->kesesuaian_bu) ? $val->kesesuaian_bu : '0'; ?>
                                    </td>
                                </tr>

                            </table>
                            <br><br><br>
                            <table class="tableKomponen">
                                <tr>
                                    <td class="text-center" style="width:70%; height:20px">
                                        <?= !empty($val->kesesuaian_sp) ? $val->kesesuaian_sp : '0'; ?>
                                    </td>
                                </tr>
                            </table>
                            <br><br><br>
                            <table class="tableKomponen">
                                <tr>
                                    <td class="text-center" style="width:70%; height:20px">
                                        <?= !empty($val->kesesuaian_ss) ? $val->kesesuaian_ss : '0'; ?>
                                    </td>
                                </tr>

                            </table>
                            <br><br><br>
                            <table class="tableKomponen">
                                <tr>
                                    <td class="text-center" style="width:70%; height:20px">
                                        <?= !empty($val->kesesuaian_bp) ? $val->kesesuaian_bp : '0'; ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <br>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td class="text-center" colspan="9" style="height: 20px;"><b>DATA KOSONG!</b></td>
                </tr>
            <?php } ?>

        </tbody>
    </table>
</body>

</html>