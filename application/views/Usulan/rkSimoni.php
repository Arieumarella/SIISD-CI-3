<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Template</title>
    <style>
        .title {
            text-align: center;
            margin-bottom: 20px;
            font-size: 20px;
            font-weight: bold;
            font-family: "Arial", sans-serif;
            margin-bottom: 6px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head><body><!-- Judul -->
    <div class="text-center">
        <h4 class="font-weight-bolder">USULAN RENCANA KEGIATAN KONREG</h4>
        <h4 class="font-weight-bolder" id="nm_daerah"></h4>
        <h4 class="font-weight-bolder">TA. <?= $this->session->userdata('thang'); ?></h4>
    </div><!-- Tabel -->
    <table class=" table-bordered tableX " id="myTabelUsulan" style="width:100%;">
        <thead class="theadX">
            <tr id="boxThField">
                <th class="text-center" rowspan="2">No.</th>
                <th class="text-center" rowspan="2">DETAIL KEGIATAN</th>
                <th class="text-center" rowspan="2">JENIS DI</th>
                <th class="text-center" rowspan="2">PENGADAAN</th>
                <th class="text-center" rowspan="2" style="width:17%;">KOMPONEN</th>
                <th class="text-center" colspan="2">OUTPUT KEGIATAN</th>
                <th class="text-center" rowspan="2">KEBUTUHAN <br> DANA</th>
            </tr>
            <tr id="boxThField">
                <th class="text-center">VOLUME</th>
                <th class="text-center">SATUAN</th>
            </tr>
        </thead>
        <tbody id="tbody_data">
            <?php if ($dataKegiatan != null) { ?>
                <?php $no = 1;
                foreach ($dataKegiatan as $key => $val) { ?>
                    <tr>
                        <td class="text-center">
                            <?= $no++; ?>
                        </td>
                        <td>
                            <b><?= $val->nm_menu; ?></b>
                            <br><br>
                            <?php
                            if ($val->kd_menu === '9') {
                                echo '<b>WS : </b>' . $val->nm_ws;
                                echo '<br>';
                                echo '<b>DAS : </b>' . $val->nm_das;
                            } else {
                                echo '<b>' . $val->nm_di . '</b>';
                            } ?>
                            <br><br>
                            <b>-Kecamatan :</b> <?= $val->keca; ?>
                            <br>
                            <b>-Desa :</b> <?= $val->desa; ?>
                        </td>
                        <td><?= ($val->kategori_di == 'BARU') ? 'DI PEMBANGUNAN BARU' : $val->kategori_di; ?></td>
                        <td><?= ($val->pengadaan == '1') ? 'Kontraktual' : 'Swakelola'; ?></td>
                        <td class="text-right" style="vertical-align: top;">
                            <?php if ($val->verif_provinsi === '0' and $val->verif_balai === '0' and $val->verif_sda === '0' and $val->verif_pusat === '0') { ?>
                                <button class="btn btn-primary btn-sm mb-2" onclick="showModalKomponen('<?= $val->id; ?>')"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                <br>
                                <?php } ?><!-- Cek Apakah Komponen ada -->
                                <?php if ($val->komponen_json != null) { ?>
                                    <?php
                                    $dataKomponenArray = json_decode($val->komponen_json, true);
                                    ?>
                                    <table class="tableKomponen">
                                        <?php foreach ($dataKomponenArray as $datakomponen) { ?>
                                            <tr>
                                                <td class="text-left" style="width:60%;"><?= $datakomponen['nm_komponen'] ?></td>
                                                <td class="text-left" style="width:48%;"><?= $datakomponen['volume'] ?> <?= $datakomponen['satuan'] ?></td>
                                                <?php if ($val->verif_provinsi === '0' and $val->verif_balai === '0' and $val->verif_sda === '0' and $val->verif_pusat === '0') { ?>
                                                    <td class="text-center" style="width:1%;"><button class="btn btn-danger btn-sm" onclick="hapuskomponen('<?= $datakomponen['id']; ?>', '<?= $datakomponen['id_usulan_simoni']; ?>')"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                <?php } ?>
                            </td>
                            <td class="text-right"><?= ($val->jns_luasan != null) ? '<b>' . $val->jns_luasan . ' : </b>' : ''; ?> <?= $val->output; ?></td>
                            <td><?= $val->satuan_output; ?></td>
                            <td class="text-right">Rp. <?= number_format($val->pagu_kegiatan, 0, ',', '.'); ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td class="text-center" colspan="10" style="height: 20px;"><b>DATA KOSOSNG.!</b></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body></html>