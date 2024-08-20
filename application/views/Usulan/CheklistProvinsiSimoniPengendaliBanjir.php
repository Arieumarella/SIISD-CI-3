<style type="text/css">
    .fontLabel {
        font-size: 18px;
    }

    .keterangan {
        font-size: 18px;
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
                    <li class="breadcrumb-item active">Rekapitulasi Nasional</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Presentase Berdasarkan Status -->
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="mt-4 mb-2"> REKAPITULASI DOKUMEN URK SIMONI DAK FISIK INFRASTRUKTUR PUPR PENGENDALI BANJIR TA. <?= $this->session->userdata('thang'); ?>
                        </h4>
                        <br>
                        <div>
                            <select class="form-control form-control-sm col-3" id="selectRekap" style="margin-bottom:-15px;">
                                <option value="1">Data Teknis Irigasi</option>
                                <option value="2" selected>Data Teknis Pengendali banjir</option>
                            </select>
                        </div>
                        <br>
                        <table class="table-bordered tableX mt-3">
                            <thead id="thead_data">
                                <tr id="boxThField1" style="background-color:#18978F; color:#fff;">
                                    <th style="border: 1px solid #000000 !important; width: 5%" rowspan="2">No</th>
                                    <th style="border: 1px solid #000000 !important; width: 25%;" rowspan="2">PROVINSI</th>
                                    <!-- <th style="border: 1px solid #000000 !important; width: 20%;" rowspan="2">TOTAL <br> KEGIATAN</th> -->
                                    <th style="border: 1px solid #000000 !important;" colspan="15">DOKUMEN</th>
                                </tr>
                                <tr id="boxThField1" style="background-color:#18978F; color:#fff;">
                                    <th class="text-center" style="border: 1px solid #000000 !important;">LEMBAR CHECKLIST</th>
                                    <th style="border: 1px solid #000000 !important;">SID</th>
                                    <th style="border: 1px solid #000000 !important;">DED</th>
                                    <th style="border: 1px solid #000000 !important;">KAK</th>
                                    <th style="border: 1px solid #000000 !important;">SKEMA JARINGAN</th>
                                    <th style="border: 1px solid #000000 !important;">SKEMA BANGUNAN</th>
                                    <th style="border: 1px solid #000000 !important;">BC VOLUME</th>
                                    <th style="border: 1px solid #000000 !important;">RAB</th>
                                    <th style="border: 1px solid #000000 !important;">DOKUMENTASI</th>
                                    <th style="border: 1px solid #000000 !important;">AMDAL</th>
                                    <th style="border: 1px solid #000000 !important;">SURAT KESEDIAAN OP</th>
                                </tr>
                            </thead>

                            <tbody id="tbody_data">
                                <?php

                                $provinsi = 0;
                                $lembar_ck_irigasi = 0;
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
                                        <td class="text-center" style="border: 1px solid #000000 !important;"><?= $no++; ?></td>
                                        <td class="text-left" style="border: 1px solid #000000 !important;">
                                            <?php if ($this->session->userdata('prive') == 'pemda') { ?>
                                                <?php if ($val->provid == $this->session->userdata('provid')) { ?>
                                                    <a href="<?= base_url(); ?>Usulan/rekapKabKotaSimoniPengendaliBanjir/<?= $val->provid; ?>"><?= $val->provinsi; ?></a>
                                                <?php } else { ?>
                                                    <?= $val->provinsi; ?>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($this->session->userdata('prive') == 'balai') { ?>
                                                    <?php if (in_array($val->provid, $dataBalai)) { ?>
                                                        <a href="<?= base_url(); ?>Usulan/rekapKabKotaSimoniPengendaliBanjir/<?= $val->provid; ?>"><?= $val->provinsi; ?></a>
                                                    <?php } else {
                                                        echo $val->provinsi;
                                                    } ?>
                                                <?php } else { ?>
                                                    <a href="<?= base_url(); ?>Usulan/rekapKabKotaSimoniPengendaliBanjir/<?= $val->provid; ?>"><?= $val->provinsi; ?></a>
                                                <?php } ?>
                                            <?php } ?>

                                        </td>
                                        <td class="text-right" style="border: 1px solid #000000 !important;"><?= $val->lembar_ck_pb; ?></td>
                                        <td class="text-right" style="border: 1px solid #000000 !important; width: 8%;"><?= $val->sid_pb; ?></td>
                                        <td class="text-right" style="border: 1px solid #000000 !important; width: 8%;"><?= $val->ded_pb; ?></td>
                                        <td class="text-right" style="border: 1px solid #000000 !important; width: 8%;"><?= $val->kak_pb; ?></td>
                                        <td class="text-right" style="border: 1px solid #000000 !important; width: 8%;"><?= $val->skema_jaringan_pb; ?></td>
                                        <td class="text-right" style="border: 1px solid #000000 !important; width: 8%;"><?= $val->skema_bangunan_pb; ?></td>
                                        <td class="text-right" style="border: 1px solid #000000 !important; width: 8%;"><?= $val->bc_volume_pb; ?></td>
                                        <td class="text-right" style="border: 1px solid #000000 !important; width: 8%;"><?= $val->rab_pb; ?></td>
                                        <td class="text-right" style="border: 1px solid #000000 !important; width: 8%;"><?= $val->dokumentasi_pb; ?></td>
                                        <td class="text-right" style="border: 1px solid #000000 !important; width: 8%;"><?= $val->dok_amdal_pb; ?></td>
                                        <td class="text-right" style="border: 1px solid #000000 !important; width: 8%;"><?= $val->kesediaan_op_pb; ?></td>
                                    </tr>
                                    <?php

                                    $lembar_ck_irigasi += (int)$val->lembar_ck_pb;
                                    $sid += (int)$val->sid_pb;
                                    $ded += (int)$val->ded_pb;
                                    $kak += (int)$val->kak_pb;
                                    $skema_jaringan += (int)$val->skema_jaringan_pb;
                                    $skema_bangunan += (int)$val->skema_bangunan_pb;
                                    $bc_volume += (int)$val->bc_volume_pb;
                                    $rab += (int)$val->rab_pb;
                                    $smk3 += (int)$val->dokumentasi_pb;
                                    $dpa += (int)$val->dok_amdal_pb;
                                    $dokumentasi += (int)$val->kesediaan_op_pb;

                                    ?>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr style="background-color:#d9dee2;">
                                    <th class="text-center" colspan="2" style="border: 1px solid #000000 !important;"><b>TOTAL</b></th>
                                    <th class="text-right" style="border: 1px solid #000000 !important;"><b><?= $lembar_ck_irigasi; ?></b></th>
                                    <th class="text-right" style="border: 1px solid #000000 !important;"><b><?= $sid; ?></b></th>
                                    <th class="text-right" style="border: 1px solid #000000 !important;"><b><?= $ded; ?></b></th>
                                    <th class="text-right" style="border: 1px solid #000000 !important;"><b><?= $kak; ?></b></th>
                                    <th class="text-right" style="border: 1px solid #000000 !important;"><b><?= $skema_jaringan; ?></b></th>
                                    <th class="text-right" style="border: 1px solid #000000 !important;"><b><?= $skema_bangunan; ?></b></th>
                                    <th class="text-right" style="border: 1px solid #000000 !important;"><b><?= $bc_volume; ?></b></th>
                                    <th class="text-right" style="border: 1px solid #000000 !important;"><b><?= $rab; ?></b></th>
                                    <th class="text-right" style="border: 1px solid #000000 !important;"><b><?= $smk3; ?></b></th>
                                    <th class="text-right" style="border: 1px solid #000000 !important;"><b><?= $dpa; ?></b></th>
                                    <th class="text-right" style="border: 1px solid #000000 !important;"><b><?= $dokumentasi; ?></b></th>
                                </tr>
                            </tfoot>



                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {
        $('#selectRekap').on('change', function() {
            let val = this.value;

            if (val == 1) {
                window.location.href = base_url() + "Usulan/CheklistSimoni";
            }

        });
    });
</script>