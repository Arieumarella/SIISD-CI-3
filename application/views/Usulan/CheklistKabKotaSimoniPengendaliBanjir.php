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
                                    <th style="border: 1px solid #000000 !important; width: 5%" rowspan="2">No</th>
                                    <th style="border: 1px solid #000000 !important; width: 20%;" rowspan="2">Kab/Kota</th>
                                    <th style="border: 1px solid #000000 !important;" colspan="12">DOKUMEN</th>
                                </tr>
                                <tr id="boxThField1" style="background-color:#18978F; color:#fff;">
                                    <th class="text-center" style="border: 1px solid #000000 !important;">URK</th>
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
                                        <td class="text-center" style="border: 1px solid #000000 !important;"><?= $no++; ?></td>
                                        <td style="text-align: left; border: 1px solid #000000 !important;">

                                            <?php if ($this->session->userdata('prive') == 'pemda') { ?>
                                                <?php if ($val->kotakabid == $this->session->userdata('kotakabid') or $this->session->userdata('is_provinsi') == 'provinsi') { ?>
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
                                        <td style="border: 1px solid #000000 !important; text-align: left;" class="text-center">
                                            <?php if ($this->session->userdata('prive') == 'pemda') { ?>
                                                <?php if ($val->kotakabid == $this->session->userdata('kotakabid')) { ?>
                                                    <a href="<?= base_url(); ?>ExportPdf/exportPB_pdf/<?= $val->kotakabid; ?>" class="btn btn-success btn-icon" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>

                                                <?php }  ?>
                                            <?php } else { ?>
                                                <?php if ($this->session->userdata('prive') == 'balai') { ?>
                                                    <?php if (in_array($val->kotakabid, $dataBalai)) { ?>
                                                        <a href="<?= base_url(); ?>ExportPdf/exportPB_pdf/<?= $val->kotakabid; ?>" class="btn btn-success btn-icon" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                    <?php }  ?>
                                                <?php } else { ?>
                                                    <a href="<?= base_url(); ?>ExportPdf/exportPB_pdf/<?= $val->kotakabid; ?>" class="btn btn-success btn-icon" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                <?php } ?>
                                            <?php } ?>
                                        </td>

                                        <td style="border: 1px solid #000000 !important; text-align: left;">
                                            <?php if ($this->session->userdata('prive') == 'pemda') { ?>
                                                <?php if ($val->kotakabid == $this->session->userdata('kotakabid') || $this->session->userdata('is_provinsi') == 'provinsi') { ?>
                                                    <?php if ($val->id_lembar_ck_pb != null) { ?>
                                                        <?php if ($val->ekstensi_lembar_ck_pb == 'zip') { ?>
                                                            <button class="btn btn-danger btn-icon"
                                                                onclick="<?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'return false;' : "showPdf('{$val->path_lembar_ck_pb}')" ?>"
                                                                <?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'disabled' : '' ?>>
                                                                <i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i>
                                                            </button>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_lembar_ck_pb; ?>"
                                                                class="btn btn-danger btn-icon"
                                                                <?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'onclick="return false;" style="pointer-events: none;"' : '' ?>>
                                                                <i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i>
                                                            </a>
                                                        <?php } ?>
                                                        <br>
                                                        <?= $val->upload_time_lembar_ck_pb; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($this->session->userdata('prive') == 'balai') { ?>
                                                    <?php if (in_array($val->kotakabid, $dataBalai)) { ?>
                                                        <?php if ($val->id_lembar_ck_pb != null) { ?>
                                                            <?php if ($val->ekstensi_lembar_ck_pb == 'zip') { ?>
                                                                <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_lembar_ck_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
                                                            <?php } else { ?>
                                                                <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_lembar_ck_pb; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
                                                            <?php } ?>
                                                            <br>
                                                            <?= $val->upload_time_lembar_ck_pb; ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <?php if ($val->id_lembar_ck_pb != null) { ?>
                                                        <?php if ($val->ekstensi_lembar_ck_pb == 'zip') { ?>
                                                            <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_lembar_ck_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_lembar_ck_pb; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                        <br>
                                                        <?= $val->upload_time_lembar_ck_pb; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </td>


                                        <td style="border: 1px solid #000000 !important; text-align: left;">
                                            <?php if ($this->session->userdata('prive') == 'pemda') { ?>
                                                <?php if ($val->kotakabid == $this->session->userdata('kotakabid') || $this->session->userdata('is_provinsi') == 'provinsi') { ?>
                                                    <?php if ($val->id_sid_pb != null) { ?>
                                                        <?php if ($val->ekstensi_sid_pb == 'zip') { ?>
                                                            <button class="btn btn-danger btn-icon"
                                                                onclick="<?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'return false;' : "showPdf('{$val->path_sid_pb}')" ?>"
                                                                <?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'disabled' : '' ?>>
                                                                <i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i>
                                                            </button>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_sid_pb; ?>"
                                                                class="btn btn-dark btn-icon"
                                                                <?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'onclick="return false;" style="pointer-events: none;"' : '' ?>>
                                                                <i class="fa fa-file-archive fa-lg" aria-hidden="true"></i>
                                                            </a>
                                                        <?php } ?>
                                                        <br>
                                                        <?= $val->upload_time_sid_pb; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($this->session->userdata('prive') == 'balai') { ?>
                                                    <?php if (in_array($val->kotakabid, $dataBalai)) { ?>
                                                        <?php if ($val->id_sid_pb != null) { ?>
                                                            <?php if ($val->ekstensi_sid_pb == 'zip') { ?>
                                                                <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_sid_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
                                                            <?php } else { ?>
                                                                <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_sid_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
                                                            <?php } ?>
                                                            <br>
                                                            <?= $val->upload_time_sid_pb; ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <?php if ($val->id_sid_pb != null) { ?>
                                                        <?php if ($val->ekstensi_sid_pb == 'zip') { ?>
                                                            <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_sid_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_sid_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                        <br>
                                                        <?= $val->upload_time_sid_pb; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </td>

                                        <td style="border: 1px solid #000000 !important; text-align: left;">
                                            <?php if ($this->session->userdata('prive') == 'pemda') { ?>
                                                <?php if ($val->kotakabid == $this->session->userdata('kotakabid') || $this->session->userdata('is_provinsi') == 'provinsi') { ?>
                                                    <?php if ($val->id_ded_pb != null) { ?>
                                                        <?php if ($val->ekstensi_ded_pb == 'zip') { ?>
                                                            <button class="btn btn-danger btn-icon"
                                                                onclick="<?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'return false;' : "showPdf('{$val->path_ded_pb}')" ?>"
                                                                <?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'disabled' : '' ?>>
                                                                <i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i>
                                                            </button>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_ded_pb; ?>"
                                                                class="btn btn-dark btn-icon"
                                                                <?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'onclick="return false;" style="pointer-events: none;"' : '' ?>>
                                                                <i class="fa fa-file-archive fa-lg" aria-hidden="true"></i>
                                                            </a>
                                                        <?php } ?>
                                                        <br>
                                                        <?= $val->upload_time_ded_pb; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($this->session->userdata('prive') == 'balai') { ?>
                                                    <?php if (in_array($val->kotakabid, $dataBalai)) { ?>
                                                        <?php if ($val->id_ded_pb != null) { ?>
                                                            <?php if ($val->ekstensi_ded_pb == 'zip') { ?>
                                                                <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_ded_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
                                                            <?php } else { ?>
                                                                <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_ded_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
                                                            <?php } ?>
                                                            <br>
                                                            <?= $val->upload_time_ded_pb; ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <?php if ($val->id_ded_pb != null) { ?>
                                                        <?php if ($val->ekstensi_ded_pb == 'zip') { ?>
                                                            <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_ded_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_ded_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                        <br>
                                                        <?= $val->upload_time_ded_pb; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </td>

                                        <td style="border: 1px solid #000000 !important; text-align: left;">
                                            <?php if ($this->session->userdata('prive') == 'pemda') { ?>
                                                <?php if ($val->kotakabid == $this->session->userdata('kotakabid') || $this->session->userdata('is_provinsi') == 'provinsi') { ?>
                                                    <?php if ($val->id_kak_pb != null) { ?>
                                                        <?php if ($val->ekstensi_kak_pb == 'zip') { ?>
                                                            <button class="btn btn-danger btn-icon"
                                                                onclick="<?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'return false;' : "showPdf('{$val->path_kak_pb}')" ?>"
                                                                <?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'disabled' : '' ?>>
                                                                <i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i>
                                                            </button>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_kak_pb; ?>"
                                                                class="btn btn-dark btn-icon"
                                                                <?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'onclick="return false;" style="pointer-events: none;"' : '' ?>>
                                                                <i class="fa fa-file-archive fa-lg" aria-hidden="true"></i>
                                                            </a>
                                                        <?php } ?>
                                                        <br>
                                                        <?= $val->upload_time_kak_pb; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($this->session->userdata('prive') == 'balai') { ?>
                                                    <?php if (in_array($val->kotakabid, $dataBalai)) { ?>
                                                        <?php if ($val->id_kak_pb != null) { ?>
                                                            <?php if ($val->ekstensi_kak_pb == 'zip') { ?>
                                                                <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_kak_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
                                                            <?php } else { ?>
                                                                <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_kak_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
                                                            <?php } ?>
                                                            <br>
                                                            <?= $val->upload_time_kak_pb; ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <?php if ($val->id_kak_pb != null) { ?>
                                                        <?php if ($val->ekstensi_kak_pb == 'zip') { ?>
                                                            <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_kak_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_kak_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                        <br>
                                                        <?= $val->upload_time_kak_pb; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </td>

                                        <td style="border: 1px solid #000000 !important; text-align: left;">
                                            <?php if ($this->session->userdata('prive') == 'pemda') { ?>
                                                <?php if ($val->kotakabid == $this->session->userdata('kotakabid') || $this->session->userdata('is_provinsi') == 'provinsi') { ?>
                                                    <?php if ($val->id_skema_jaringan_pb != null) { ?>
                                                        <?php if ($val->ekstensi_skema_jaringan_pb == 'zip') { ?>
                                                            <button class="btn btn-danger btn-icon"
                                                                onclick="<?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'return false;' : "showPdf('{$val->path_skema_jaringan_pb}')" ?>"
                                                                <?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'disabled' : '' ?>>
                                                                <i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i>
                                                            </button>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_skema_jaringan_pb; ?>"
                                                                class="btn btn-danger btn-icon"
                                                                <?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'onclick="return false;" style="pointer-events: none;"' : '' ?>>
                                                                <i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i>
                                                            </a>
                                                        <?php } ?>
                                                        <br>
                                                        <?= $val->upload_time_skema_jaringan_pb; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($this->session->userdata('prive') == 'balai') { ?>
                                                    <?php if (in_array($val->kotakabid, $dataBalai)) { ?>
                                                        <?php if ($val->id_skema_jaringan_pb != null) { ?>
                                                            <?php if ($val->ekstensi_skema_jaringan_pb == 'zip') { ?>
                                                                <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_skema_jaringan_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
                                                            <?php } else { ?>
                                                                <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_skema_jaringan_pb; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
                                                            <?php } ?>
                                                            <br>
                                                            <?= $val->upload_time_skema_jaringan_pb; ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <?php if ($val->id_skema_jaringan_pb != null) { ?>
                                                        <?php if ($val->ekstensi_skema_jaringan_pb == 'zip') { ?>
                                                            <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_skema_jaringan_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_skema_jaringan_pb; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                        <br>
                                                        <?= $val->upload_time_skema_jaringan_pb; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </td>

                                        <td style="border: 1px solid #000000 !important; text-align: left;">
                                            <?php if ($this->session->userdata('prive') == 'pemda') { ?>
                                                <?php if ($val->kotakabid == $this->session->userdata('kotakabid') || $this->session->userdata('is_provinsi') == 'provinsi') { ?>
                                                    <?php if ($val->id_skema_bangunan_pb != null) { ?>
                                                        <?php if ($val->ekstensi_skema_bangunan_pb == 'zip') { ?>
                                                            <button class="btn btn-danger btn-icon"
                                                                onclick="<?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'return false;' : "showPdf('{$val->path_skema_bangunan_pb}')" ?>"
                                                                <?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'disabled' : '' ?>>
                                                                <i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i>
                                                            </button>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_skema_bangunan_pb; ?>"
                                                                class="btn btn-danger btn-icon"
                                                                <?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'onclick="return false;" style="pointer-events: none;"' : '' ?>>
                                                                <i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i>
                                                            </a>
                                                        <?php } ?>
                                                        <br>
                                                        <?= $val->upload_time_skema_bangunan_pb; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($this->session->userdata('prive') == 'balai') { ?>
                                                    <?php if (in_array($val->kotakabid, $dataBalai)) { ?>
                                                        <?php if ($val->id_skema_bangunan_pb != null) { ?>
                                                            <?php if ($val->ekstensi_skema_bangunan_pb == 'zip') { ?>
                                                                <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_skema_bangunan_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
                                                            <?php } else { ?>
                                                                <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_skema_bangunan_pb; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
                                                            <?php } ?>
                                                            <br>
                                                            <?= $val->upload_time_skema_bangunan_pb; ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <?php if ($val->id_skema_bangunan_pb != null) { ?>
                                                        <?php if ($val->ekstensi_skema_bangunan_pb == 'zip') { ?>
                                                            <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_skema_bangunan_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_skema_bangunan_pb; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                        <br>
                                                        <?= $val->upload_time_skema_bangunan_pb; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </td>

                                        <td style="border: 1px solid #000000 !important; text-align: left;">
                                            <?php if ($this->session->userdata('prive') == 'pemda') { ?>
                                                <?php if ($val->kotakabid == $this->session->userdata('kotakabid') || $this->session->userdata('is_provinsi') == 'provinsi') { ?>
                                                    <?php if ($val->id_bc_volume_pb != null) { ?>
                                                        <?php if ($val->ekstensi_bc_volume_pb == 'zip') { ?>
                                                            <button class="btn btn-danger btn-icon"
                                                                onclick="<?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'return false;' : "showPdf('{$val->path_bc_volume_pb}')" ?>"
                                                                <?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'disabled' : '' ?>>
                                                                <i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i>
                                                            </button>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_bc_volume_pb; ?>"
                                                                class="btn btn-dark btn-icon"
                                                                <?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'onclick="return false;" style="pointer-events: none;"' : '' ?>>
                                                                <i class="fa fa-file-archive fa-lg" aria-hidden="true"></i>
                                                            </a>
                                                        <?php } ?>
                                                        <br>
                                                        <?= $val->upload_time_bc_volume_pb; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($this->session->userdata('prive') == 'balai') { ?>
                                                    <?php if (in_array($val->kotakabid, $dataBalai)) { ?>
                                                        <?php if ($val->id_bc_volume_pb != null) { ?>
                                                            <?php if ($val->ekstensi_bc_volume_pb == 'zip') { ?>
                                                                <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_bc_volume_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
                                                            <?php } else { ?>
                                                                <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_bc_volume_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
                                                            <?php } ?>
                                                            <br>
                                                            <?= $val->upload_time_bc_volume_pb; ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <?php if ($val->id_bc_volume_pb != null) { ?>
                                                        <?php if ($val->ekstensi_bc_volume_pb == 'zip') { ?>
                                                            <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_bc_volume_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_bc_volume_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                        <br>
                                                        <?= $val->upload_time_bc_volume_pb; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </td>

                                        <td style="border: 1px solid #000000 !important; text-align: left;">
                                            <?php if ($this->session->userdata('prive') == 'pemda') { ?>
                                                <?php if ($val->kotakabid == $this->session->userdata('kotakabid') || $this->session->userdata('is_provinsi') == 'provinsi') { ?>
                                                    <?php if ($val->id_rab_pb != null) { ?>
                                                        <?php if ($val->ekstensi_rab_pb == 'zip') { ?>
                                                            <button class="btn btn-danger btn-icon"
                                                                onclick="<?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'return false;' : "showPdf('{$val->path_rab_pb}')" ?>"
                                                                <?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'disabled' : '' ?>>
                                                                <i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i>
                                                            </button>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_rab_pb; ?>"
                                                                class="btn btn-dark btn-icon"
                                                                <?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'onclick="return false;" style="pointer-events: none;"' : '' ?>>
                                                                <i class="fa fa-file-archive fa-lg" aria-hidden="true"></i>
                                                            </a>
                                                        <?php } ?>
                                                        <br>
                                                        <?= $val->upload_time_rab_pb; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($this->session->userdata('prive') == 'balai') { ?>
                                                    <?php if (in_array($val->kotakabid, $dataBalai)) { ?>
                                                        <?php if ($val->id_rab_pb != null) { ?>
                                                            <?php if ($val->ekstensi_rab_pb == 'zip') { ?>
                                                                <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_rab_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
                                                            <?php } else { ?>
                                                                <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_rab_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
                                                            <?php } ?>
                                                            <br>
                                                            <?= $val->upload_time_rab_pb; ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <?php if ($val->id_rab_pb != null) { ?>
                                                        <?php if ($val->ekstensi_rab_pb == 'zip') { ?>
                                                            <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_rab_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_rab_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                        <br>
                                                        <?= $val->upload_time_rab_pb; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </td>

                                        <td style="border: 1px solid #000000 !important; text-align: left;">
                                            <?php if ($this->session->userdata('prive') == 'pemda') { ?>
                                                <?php if ($val->kotakabid == $this->session->userdata('kotakabid') || $this->session->userdata('is_provinsi') == 'provinsi') { ?>
                                                    <?php if ($val->id_dokumentasi_pb != null) { ?>
                                                        <?php if ($val->ekstensi_dokumentasi_pb == 'zip') { ?>
                                                            <button class="btn btn-danger btn-icon"
                                                                onclick="<?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'return false;' : "showPdf('{$val->path_dokumentasi_pb}')" ?>"
                                                                <?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'disabled' : '' ?>>
                                                                <i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i>
                                                            </button>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_dokumentasi_pb; ?>"
                                                                class="btn btn-dark btn-icon"
                                                                <?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'onclick="return false;" style="pointer-events: none;"' : '' ?>>
                                                                <i class="fa fa-file-archive fa-lg" aria-hidden="true"></i>
                                                            </a>
                                                        <?php } ?>
                                                        <br>
                                                        <?= $val->upload_time_dokumentasi_pb; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($this->session->userdata('prive') == 'balai') { ?>
                                                    <?php if (in_array($val->kotakabid, $dataBalai)) { ?>
                                                        <?php if ($val->id_dokumentasi_pb != null) { ?>
                                                            <?php if ($val->ekstensi_dokumentasi_pb == 'zip') { ?>
                                                                <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_dokumentasi_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
                                                            <?php } else { ?>
                                                                <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_dokumentasi_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
                                                            <?php } ?>
                                                            <br>
                                                            <?= $val->upload_time_dokumentasi_pb; ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <?php if ($val->id_dokumentasi_pb != null) { ?>
                                                        <?php if ($val->ekstensi_dokumentasi_pb == 'zip') { ?>
                                                            <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_dokumentasi_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_dokumentasi_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                        <br>
                                                        <?= $val->upload_time_dokumentasi_pb; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </td>

                                        <td style="border: 1px solid #000000 !important; text-align: left;">
                                            <?php if ($this->session->userdata('prive') == 'pemda') { ?>
                                                <?php if ($val->kotakabid == $this->session->userdata('kotakabid') || $this->session->userdata('is_provinsi') == 'provinsi') { ?>
                                                    <?php if ($val->id_dok_amdal_pb != null) { ?>
                                                        <?php if ($val->ekstensi_dok_amdal_pb == 'zip') { ?>
                                                            <button class="btn btn-danger btn-icon"
                                                                onclick="<?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'return false;' : "showPdf('{$val->path_dok_amdal_pb}')" ?>"
                                                                <?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'disabled' : '' ?>>
                                                                <i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i>
                                                            </button>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_dok_amdal_pb; ?>"
                                                                class="btn btn-danger btn-icon"
                                                                <?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'onclick="return false;" style="pointer-events: none;"' : '' ?>>
                                                                <i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i>
                                                            </a>
                                                        <?php } ?>
                                                        <br>
                                                        <?= $val->upload_time_dok_amdal_pb; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($this->session->userdata('prive') == 'balai') { ?>
                                                    <?php if (in_array($val->kotakabid, $dataBalai)) { ?>
                                                        <?php if ($val->id_dok_amdal_pb != null) { ?>
                                                            <?php if ($val->ekstensi_dok_amdal_pb == 'zip') { ?>
                                                                <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_dok_amdal_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
                                                            <?php } else { ?>
                                                                <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_dok_amdal_pb; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
                                                            <?php } ?>
                                                            <br>
                                                            <?= $val->upload_time_dok_amdal_pb; ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <?php if ($val->id_dok_amdal_pb != null) { ?>
                                                        <?php if ($val->ekstensi_dok_amdal_pb == 'zip') { ?>
                                                            <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_dok_amdal_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_dok_amdal_pb; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                        <br>
                                                        <?= $val->upload_time_dok_amdal_pb; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </td>

                                        <td style="border: 1px solid #000000 !important; text-align: left;">
                                            <?php if ($this->session->userdata('prive') == 'pemda') { ?>
                                                <?php if ($val->kotakabid == $this->session->userdata('kotakabid') || $this->session->userdata('is_provinsi') == 'provinsi') { ?>
                                                    <?php if ($val->id_kesediaan_op_pb != null) { ?>
                                                        <?php if ($val->ekstensi_kesediaan_op_pb == 'zip') { ?>
                                                            <button class="btn btn-danger btn-icon"
                                                                onclick="<?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'return false;' : "showPdf('{$val->path_kesediaan_op_pb}')" ?>"
                                                                <?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'disabled' : '' ?>>
                                                                <i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i>
                                                            </button>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_kesediaan_op_pb; ?>"
                                                                class="btn btn-danger btn-icon"
                                                                <?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'onclick="return false;" style="pointer-events: none;"' : '' ?>>
                                                                <i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i>
                                                            </a>
                                                        <?php } ?>
                                                        <br>
                                                        <?= $val->upload_time_kesediaan_op_pb; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($this->session->userdata('prive') == 'balai') { ?>
                                                    <?php if (in_array($val->kotakabid, $dataBalai)) { ?>
                                                        <?php if ($val->id_kesediaan_op_pb != null) { ?>
                                                            <?php if ($val->ekstensi_kesediaan_op_pb == 'zip') { ?>
                                                                <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_kesediaan_op_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
                                                            <?php } else { ?>
                                                                <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_kesediaan_op_pb; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
                                                            <?php } ?>
                                                            <br>
                                                            <?= $val->upload_time_kesediaan_op_pb; ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <?php if ($val->id_kesediaan_op_pb != null) { ?>
                                                        <?php if ($val->ekstensi_kesediaan_op_pb == 'zip') { ?>
                                                            <button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_kesediaan_op_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
                                                        <?php } else { ?>
                                                            <a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_kesediaan_op_pb; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                        <br>
                                                        <?= $val->upload_time_kesediaan_op_pb; ?>
                                                    <?php } ?>
                                                <?php } ?>
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

        showPdf = async function(path) {

            let cekString = path.indexOf("/var/www/html/");

            if (cekString == -1) {
                var sliceString = path.substring(11);
                var spasiJadiPersen = sliceString.replace(' ', '%20');
                var parent = await $('embed#idEmbed').parent();
                var newElement = await "<embed src='" + base_url() + 'assets/2022/' + spasiJadiPersen + "' id='idEmbed' frameborder='0' width='100%' height='100%'>";

                await $('embed#idEmbed').remove();
                await parent.append(newElement);
                await $('#modalPdf').modal('show');
            } else {
                var sliceString = path.substring(24);
                var spasiJadiPersen = sliceString.replace(' ', '%20');
                var parent = await $('embed#idEmbed').parent();
                var newElement = await "<embed src='" + base_url() + spasiJadiPersen + "' id='idEmbed' frameborder='0' width='100%' height='100%'>";
                await $('embed#idEmbed').remove();
                await parent.append(newElement);
                await $('#modalPdf').modal('show');

            }


        }

    });
</script>