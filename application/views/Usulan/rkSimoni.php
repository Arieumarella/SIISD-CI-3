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
        <h3 class="font-weight-bolder">USULAN RENCANA KEGIATAN</h3>
        <h3 class="font-weight-bolder">PENILAIAN SINKRONISASI DAN</h3>
        <h3 class="font-weight-bolder"><?= $nmKabkota; ?></h3>
        <h3 class="font-weight-bolder">TA. <?= $this->session->userdata('thang'); ?></h3>
    </div>
    <!-- Tabel -->
    <table class="tableX" id="myTabelUsulan">
        <thead class="theadX">
            <tr style="background-color: #DCDCDC ">
                <th class="text-center" rowspan="2" style="width:5%;">No.</th>
                <th class="text-center" rowspan="2" style="width:23%;">DETAIL KEGIATAN</th>
                <th class="text-center" rowspan="2" style="width:7%;">JENIS DI</th>
                <th class="text-center" rowspan="2" style="width: 11%;">PENGADAAN</th>
                <th class="text-center" rowspan="2" style="width:20%;">KOMPONEN</th>
                <th class="text-center" colspan="2" style="width: 18%;">OUTCOME KEGIATAN</th>
                <th class="text-center" rowspan="2" style="width: auto;">KEBUTUHAN DANA</th>
            </tr>
            <tr style="background-color: #DCDCDC ">
                <th class="text-center" style="width: 10%;">VOLUME</th>
                <th class="text-center" style="width: 8%;">SATUAN</th>
            </tr>
        </thead>
        <tbody id="tbody_data">
            <?php if ($dataKegiatan != null) { ?>
                <?php $no = 1;
                foreach ($dataKegiatan as $key => $val) { ?>
                    <tr>

                        <td class="text-center" style="width:5%;" rowspan="5">
                            <?= $no++; ?></td>
                        <td style="width:23%;">
                            <b><?= $val->nm_menu; ?></b><br><br>
                            <?php
                            if ($val->kd_menu === '9') {
                                echo '<b>WS : </b>' . $val->nm_ws . '<br>';
                                echo '<b>DAS : </b>' . $val->nm_das;
                            } else {
                                echo '<b>' . $val->nm_di . '</b>';
                            }
                            ?><br><br>
                            <b>-Kecamatan :</b> <?= $val->keca; ?><br>
                            <b>-Desa :</b> <?= $val->desa; ?>
                        </td>
                        <td style="width:7%;" class="text-center"><?= ($val->kategori_di == 'BARU') ? 'DI PEMBANGUNAN BARU' : $val->kategori_di; ?></td>
                        <td style="width: 11%;"><?= ($val->pengadaan == '1') ? 'Kontraktual' : 'Swakelola'; ?></td>
                        <td class="text-right" style="vertical-align: top;" style="width:20%;">

                            <?php if ($val->komponen_json != null) { ?>
                                <?php $dataKomponenArray = json_decode($val->komponen_json, true); ?>
                                <table class="tableKomponen">
                                    <?php foreach ($dataKomponenArray as $datakomponen) { ?>
                                        <tr>
                                            <td class="text-left" style="width:60%;"><?= $datakomponen['nm_komponen'] ?></td>
                                            <td class="text-left" style="width:48%;"><?= $datakomponen['volume'] ?> <?= $datakomponen['satuan'] ?></td>

                                        </tr>
                                    <?php } ?>
                                </table>
                            <?php } ?>
                        </td>
                        <td class="text-right" style="width: 10%;"><?= ($val->jns_luasan != null) ? '<b>' . $val->jns_luasan . ' : </b>' : ''; ?> <?= $val->output; ?></td>
                        <td style="width: 8%;"><?= $val->satuan_output; ?></td>

                        <td class="text-left" style="width: auto;" rowspan="5"><b>- Dana :</b> <br>Rp <?= number_format($val->pagu_kegiatan, 0, ',', '.'); ?> <br><br> <b>- Harga Satuan :</b><br>
                            Rp <?= number_format($val->pagu_kegiatan / $val->output, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">CHECKLIST</td>
                        <td colspan="5" class="text-center">CATATAN</td>
                    </tr>
                    <tr>
                        <td>PUSAT FASILITASI INFRASTRUKTUR DAERAH</td>
                        <td>
                            <?php if ($val->verif_pusat == '0' or $val->verif_pusat == null) { ?>
                                <i class="fa fa-times-circle text-danger">Belum dinilai</i>
                            <?php } else { ?>
                                <i class="fa fa-check-circle text-success">Sudah dinilai</i>
                            <?php } ?>
                        </td>
                        <td colspan="5">
                            <?= isset($val->catat_pusat) ? $val->catat_pusat : ''; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>DIREKTORAT IRIGASI DAN RAWA</td>
                        <td>
                            <?php if ($val->verif_sda == '0' or $val->verif_sda == null) { ?>
                                <i class="fa fa-times-circle text-danger" aria-hidden="true">Belum dinilai</i>
                            <?php } else { ?>
                                <i class="fa fa-check-circle text-success" aria-hidden="true">Sudah dinilai</i>
                            <?php } ?>
                        </td>
                        <td colspan="5">
                            <?= isset($val->catat_sda) ? $val->catat_sda : ''; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>BBWS/BWS</td>
                        <td>
                            <?php if ($val->verif_balai == '0' or $val->verif_balai == null) { ?>
                                <i class="fa fa-times-circle text-danger" aria-hidden="true">Belum dinilai</i>
                            <?php } else { ?>
                                <i class="fa fa-check-circle text-success" aria-hidden="true">Sudah dinilai</i>
                            <?php } ?>
                        </td>
                        <td colspan="5">
                            <?= isset($val->catat_balai) ? $val->catat_balai : ''; ?>
                        </td>
                    </tr>
                <?php } ?>
                <?php if ($dataParaf != null) { ?>
                    <?php
                    $lastVal = end($dataParaf); // Ambil elemen terakhir dari array $dataParaf
                    ?>
                    <div class="signature">
                        <p><strong><?= $lastVal->jabatan; ?></strong></p>
                        <p><strong><?= $lastVal->nm_dinas; ?></strong></p>
                        <img class="profile-user-img img-fluid img-circle" src="<?= base_url(); ?>assets/paraf/<?= $lastVal->paraf == null ? 'Data Kosong' : $lastVal->paraf; ?>" alt="User profile picture" style="width: 70px;">

                        <p><strong><?= $lastVal->nm_kpl_dinas; ?></strong></p>
                        <p>NIP: <?= $lastVal->nip; ?></p>
                    </div>
                <?php } ?>
                <div class="card-body">
                    <table class=" table-bordered tableX " id="myTabelUsulan2" style="width:40%;">
                        <thead class="theadX">
                            <tr id="boxThField">
                                <th class="text-center"></th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Paraf</th>

                            </tr>
                        </thead>
                        <tbody id="tbody_data">
                            <tr>
                                <td class="text-center">
                                    Kepala Bidang DAK SDA, PFID
                                </td>
                                <td class="text-center">
                                </td>
                                <td class="text-center">
                                </td>
                                <td class="text-center">
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    Kasubdit Irigasi dan Rawa
                                </td>
                                <td class="text-center">
                                </td>
                                <td class="text-center">
                                </td>
                                <td class="text-center">
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <!-- <div class="card-body">
                    <table class=" table-bordered tableX " id="myTabelUsulan2" style="width:40%;">
                        <thead class="theadX">
                            <tr id="boxThField">
                                <th class="text-center"></th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Desk</th>
                                <th class="text-center">Paraf</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_data">
                            <tr>
                                <td class="text-center">
                                    Verifikator PFID
                                </td>
                                <td class="text-center">

                                </td>
                                <td class="text-center">

                                </td>
                                <td class="text-center">

                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    Verifikator IRWA
                                </td>
                                <td class="text-center">
                                </td>
                                <td class="text-center">
                                </td>
                                <td class="text-center">

                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    Balai
                                </td>
                                <td class="text-center">
                                </td>
                                <td class="text-center">
                                </td>
                                <td class="text-center">

                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div> -->

            <?php } else { ?>
                <tr>
                    <td class="text-center" colspan="8" style="height: 20px;"><b>DATA KOSONG!</b></td>
                </tr>
            <?php } ?>

        </tbody>
    </table>
</body>

</html>