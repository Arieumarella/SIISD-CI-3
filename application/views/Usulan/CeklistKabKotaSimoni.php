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
					<li class="breadcrumb-item"><a href="<?= base_url(); ?>Usulan/CheklistSimoni">Rekapitulasi Nasional</a></li>
					<li class="breadcrumb-item active"><?= $nm_Provinsi; ?></li>
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="card">
				<div class="card-body">
					<div class="text-center">
						<h4 class="mt-4"> REKAPITULASI DOKUMEN URK DAK FISIK INFRASTRUKTUR PUPR TA. <?= $this->session->userdata('thang'); ?></h4>
						<h4 class="mb-2">PROVINSI <?= $nm_Provinsi; ?></h4>
					</div>
					<br><br><br>
					<?php if ($this->session->userdata('prive') == 'admin') { ?>
						<div class="form-row ml-1 mt-3">
							<div class="form-group col-md-3">
								<label for="selectRekapPfid">Checklist PFID : </label>
								<select class="form-control form-control-sm " id="selectRekapPfid">
									<option value="">--Pilih Kab/Kota--</option>
									<?php foreach ($dataRekap as $key => $val) { ?>
										<option value="<?= base_url(); ?>Usulan/ChecklistPfid/<?= $val->kotakabid; ?>"><?= $val->kemendagri; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group col-md-3">
								<label for="selectRekapIrwa">Checklist IRWA : </label>
								<select class="form-control form-control-sm" id="selectRekapIrwa">
									<option value="">--Pilih Kab/Kota--</option>
									<?php foreach ($dataRekap as $key => $val) { ?>
										<option value="<?= base_url(); ?>Usulan/ChecklistIrwa/<?= $val->kotakabid; ?>"><?= $val->kemendagri; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					<?php } ?>
					<script>
						$(document).ready(function() {
							$('#selectRekapPfid, #selectRekapIrwa').select2({
								placeholder: '--Pilih Kab/Kota--',
								allowClear: true
							});

							$('#selectRekapPfid, #selectRekapIrwa').on('change', function() {
								var url = $(this).val();
								if (url) {
									window.open(url, '_blank');
								}
							});
						});
					</script>


					<?php if ($this->session->userdata('prive') == 'sda') { ?>
						<label for="" class="ml-2">Checklist IRWA : </label> <br>
						<select class="form-control form-control-sm col-3 ml-2" id="selectRekap" style="margin-bottom:-15px;">
							<option value="">--Pilih Kab/Kota--</option>
							<?php foreach ($dataRekap as $key => $val) { ?>
								<option value="<?= base_url(); ?>Usulan/ChecklistIrwa/<?= $val->kotakabid; ?>"><?= $val->kemendagri; ?></option>
							<?php } ?>
						</select>
					<?php } ?>

					<script>
						$(document).ready(function() {
							$('#selectRekap').select2({
								placeholder: '--Pilih Kab/Kota--',
								allowClear: true
							});

							$('#selectRekap').on('change', function() {
								var url = $(this).val();
								if (url) {
									window.open(url, '_blank');
								}
							});
						});
					</script>

					<br>
					<div class="card-body table-responsive p-0 tableFixHead" style="position: relative; overflow-y: scroll; height: 83vh; padding:2px;">
						<table class="table-bordered tableX mt-3">
							<thead class="theadX" style="background-color:#18978F; color:#fff; border: 1px solid #000000 !important">
								<tr id="boxThField" style="background-color:#18978F; color:#fff;">
									<th style="border: 1px solid #000000 !important; width: 7%;" rowspan="5">No</th>
									<th style="border: 1px solid #000000 !important; width: 25%;" class="text-center" rowspan="2">PROVINSI</th>
									<th style="border: 1px solid #000000 !important; text-align:center;" colspan="19">DOKUMEN</th>

								</tr>
								<tr id="boxThField" style="background-color:#18978F; color:#fff; text-align:center;">
									<th style="border: 1px solid #000000 !important;">URK</th>
									<th style="border: 1px solid #000000 !important;" style="text-align: center;">CHECKLIST PFID</th>
									<th style="border: 1px solid #000000 !important;" style="text-align: center;">CHECKLIST IRWA</th>
									<th style="border: 1px solid #000000 !important;">SID</th>
									<th style="border: 1px solid #000000 !important;">DED</th>
									<th style="border: 1px solid #000000 !important;">KAK</th>
									<th style="border: 1px solid #000000 !important;">SKEMA JARINGAN</th>
									<th style="border: 1px solid #000000 !important;">SKEMA BANGUNAN</th>
									<th style="border: 1px solid #000000 !important;">BC VOLUME</th>
									<th style="border: 1px solid #000000 !important;">RAB</th>
									<th style="border: 1px solid #000000 !important;">SMK3</th>
									<th style="border: 1px solid #000000 !important;">DPA</th>
									<th style="border: 1px solid #000000 !important;">DOKUMENTASI</th>
									<th style="border: 1px solid #000000 !important;">SURAT KEBENARAN DATA</th>
									<th style="border: 1px solid #000000 !important;">SURAT KRITERIA PEMBANGUNAN</th>
									<th style="border: 1px solid #000000 !important;">SURAT PENYIAPAN LAHAN</th>
									<th style="border: 1px solid #000000 !important; text-align: center">SURAT KESANGGUPAN OP</th>
									<th style="border: 1px solid #000000 !important;"> PENINGKATAN IP</th>
									<th style="border: 1px solid #000000 !important;">DOKUMEN LINGKUNGAN</th>
								</tr>
							</thead>


							<tbody id="tbody_data">
								<?php
								$provinsi = 0;

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
								$peningkatan_ip = 0;
								$dokumen_lingkungan = 0;
								?>

								<?php
								$no = 1;
								?>
								<?php foreach ($dataRekap as $key => $val) { ?>
									<tr style="background-color:#F7ECDE;">
										<td style="border: 1px solid #000000 !important; width:7%;"><?= $no++; ?></td>
										<td style="border: 1px solid #000000 !important; text-align: left;">
											<?php if ($this->session->userdata('prive') == 'pemda') { ?>
												<?php if ($val->kotakabid == $this->session->userdata('kotakabid') or $this->session->userdata('is_provinsi') == 'provinsi') { ?>
													<a href="<?= base_url(); ?>Usulan/cheklistURKSimoni/<?= $val->kotakabid; ?>"><?= $val->kemendagri; ?></a>
												<?php } else { ?>
													<?= $val->kemendagri; ?>
												<?php } ?>

											<?php } else { ?>
												<?php if ($this->session->userdata('prive') == 'balai') { ?>
													<?php if (in_array($val->kotakabid, $dataBalai)) { ?>
														<a href="<?= base_url(); ?>Usulan/cheklistURKSimoni/<?= $val->kotakabid; ?>"><?= $val->kemendagri; ?></a>
													<?php } else {
														echo $val->kemendagri;
													} ?>
												<?php } else { ?>
													<a href="<?= base_url(); ?>Usulan/cheklistURKSimoni/<?= $val->kotakabid; ?>"><?= $val->kemendagri; ?></a>
												<?php } ?>
											<?php } ?>
										</td>
										<td style="border: 1px solid #000000 !important; text-align: left;" class="text-center">
											<?php if ($this->session->userdata('prive') == 'pemda') { ?>
												<?php if ($val->kotakabid == $this->session->userdata('kotakabid')) { ?>
													<a href="<?= base_url(); ?>ExportPdf/export_pdf/<?= $val->kotakabid; ?>" class="btn btn-success btn-icon" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>

												<?php }  ?>
											<?php } else { ?>
												<?php if ($this->session->userdata('prive') == 'balai') { ?>
													<?php if (in_array($val->kotakabid, $dataBalai)) { ?>
														<a href="<?= base_url(); ?>ExportPdf/export_pdf/<?= $val->kotakabid; ?>" class="btn btn-success btn-icon" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
													<?php }  ?>
												<?php } else { ?>
													<a href="<?= base_url(); ?>ExportPdf/export_pdf/<?= $val->kotakabid; ?>" class="btn btn-success btn-icon" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
												<?php } ?>
											<?php } ?>
										</td>
										<?php if ($this->session->userdata('prive') == 'admin') { ?>
											<td style="border: 1px solid #000000 !important; text-align: left;" class="text-center">
												<a href="<?= base_url(); ?>ExportPdf/exportchecklistpfid_pdf/<?= $val->kotakabid; ?>" class="btn btn-info btn-icon" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
											</td>
										<?php }  ?>
										<?php if ($this->session->userdata('prive') == 'admin') { ?>
											<td style="border: 1px solid #000000 !important; text-align: left;" class="text-center">
												<a href="<?= base_url(); ?>ExportPdf/exportchecklistirwa_pdf/<?= $val->kotakabid; ?>" class="btn btn-info btn-icon" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
											</td>
										<?php }  ?>





										<td style="border: 1px solid #000000 !important; text-align: left;">
											<?php if ($this->session->userdata('prive') == 'pemda') { ?>
												<?php if ($val->kotakabid == $this->session->userdata('kotakabid') || $this->session->userdata('is_provinsi') == 'provinsi') { ?>
													<?php if ($val->id_sid != null) { ?>
														<?php if ($val->ekstensi_sid == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_sid; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_sid; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_sid; ?>
													<?php } ?>
												<?php } ?>
											<?php } else { ?>
												<?php if ($this->session->userdata('prive') == 'balai') { ?>
													<?php if (in_array($val->kotakabid, $dataBalai)) { ?>
														<?php if ($val->id_sid != null) { ?>
															<?php if ($val->ekstensi_sid == 'pdf') { ?>
																<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_sid; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
															<?php } else { ?>
																<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_sid; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
															<?php } ?>
															<br>
															<?= $val->upload_time_sid; ?>
														<?php } ?>
													<?php } ?>
												<?php } else { ?>
													<?php if ($val->id_sid != null) { ?>
														<?php if ($val->ekstensi_sid == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_sid; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_sid; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_sid; ?>
													<?php } ?>
												<?php } ?>
											<?php } ?>
										</td>

										<td style="border: 1px solid #000000 !important; text-align: left;">
											<?php if ($this->session->userdata('prive') == 'pemda') { ?>
												<?php if ($val->kotakabid == $this->session->userdata('kotakabid') || $this->session->userdata('is_provinsi') == 'provinsi') { ?>
													<?php if ($val->id_sid != null) { ?>
														<?php if ($val->ekstensi_sid == 'pdf') { ?>
															<button class="btn btn-danger btn-icon"
																onclick="<?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'return false;' : "showPdf('{$val->path_sid}')" ?>"
																<?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'disabled' : '' ?>>
																<i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i>
															</button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_sid; ?>"
																class="btn btn-dark btn-icon"
																<?= $this->session->userdata('is_provinsi') == 'provinsi' ? 'onclick="return false;" style="pointer-events: none;"' : '' ?>>
																<i class="fa fa-file-archive fa-lg" aria-hidden="true"></i>
															</a>
														<?php } ?>
														<br>
														<?= $val->upload_time_sid; ?>
													<?php } ?>
												<?php } ?>
											<?php } else { ?>
												<?php if ($this->session->userdata('prive') == 'balai') { ?>
													<?php if (in_array($val->kotakabid, $dataBalai)) { ?>
														<?php if ($val->id_ded != null) { ?>
															<?php if ($val->ekstensi_ded == 'pdf') { ?>
																<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_ded; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
															<?php } else { ?>
																<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_ded; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
															<?php } ?>
															<br>
															<?= $val->upload_time_ded; ?>

														<?php } ?>
													<?php } ?>
												<?php } else { ?>
													<?php if ($val->id_ded != null) { ?>
														<?php if ($val->ekstensi_ded == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_ded; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_ded; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_ded; ?>

													<?php } ?>
												<?php } ?>
											<?php } ?>
										</td>

										<td style="border: 1px solid #000000 !important; text-align: left;">
											<?php if ($this->session->userdata('prive') == 'pemda') { ?>
												<?php if ($val->kotakabid == $this->session->userdata('kotakabid')) { ?>
													<?php if ($val->id_kak != null) { ?>
														<?php if ($val->ekstensi_kak == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_kak; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_kak; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_kak; ?>
													<?php } ?>
												<?php } ?>
												<?php if ($this->session->userdata('is_provinsi') == 'provinsi') { ?>
													<?php if ($val->id_kak != null) { ?>
														<?php if ($val->ekstensi_kak == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_kak; ?>')" disabled><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_kak; ?>" class="btn btn-dark btn-icon" onclick="return false;" style="pointer-events: none;"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_kak; ?>
													<?php } ?>
												<?php } ?>
											<?php } else { ?>
												<?php if ($this->session->userdata('prive') == 'balai') { ?>
													<?php if (in_array($val->kotakabid, $dataBalai)) { ?>
														<?php if ($val->id_kak != null) { ?>
															<?php if ($val->ekstensi_kak == 'pdf') { ?>
																<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_kak; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
															<?php } else { ?>
																<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_kak; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
															<?php } ?>
															<br>
															<?= $val->upload_time_kak; ?>
														<?php } ?>
													<?php } ?>
												<?php } else { ?>
													<?php if ($val->id_kak != null) { ?>
														<?php if ($val->ekstensi_kak == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_kak; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_kak; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_kak; ?>
													<?php } ?>
												<?php } ?>
											<?php } ?>
										</td>

										<td style="border: 1px solid #000000 !important; text-align: left;">
											<?php if ($this->session->userdata('prive') == 'pemda') { ?>
												<?php if ($val->kotakabid == $this->session->userdata('kotakabid')) { ?>
													<?php if ($val->id_skema_jaringan != null) { ?>
														<?php if ($val->ekstensi_skema_jaringan == 'zip') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_skema_jaringan; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_skema_jaringan; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_skema_jaringan; ?>
													<?php } ?>
												<?php } ?>
												<?php if ($this->session->userdata('is_provinsi') == 'provinsi') { ?>
													<?php if ($val->id_skema_jaringan != null) { ?>
														<?php if ($val->ekstensi_skema_jaringan == 'zip') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_skema_jaringan; ?>')" disabled><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_skema_jaringan; ?>" class="btn btn-danger btn-icon" onclick="return false;" style="pointer-events: none;"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_skema_jaringan; ?>
													<?php } ?>
												<?php } ?>
											<?php } else { ?>
												<?php if ($this->session->userdata('prive') == 'balai') { ?>
													<?php if (in_array($val->kotakabid, $dataBalai)) { ?>
														<?php if ($val->id_skema_jaringan != null) { ?>
															<?php if ($val->ekstensi_skema_jaringan == 'zip') { ?>
																<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_skema_jaringan; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
															<?php } else { ?>
																<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_skema_jaringan; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
															<?php } ?>
															<br>
															<?= $val->upload_time_skema_jaringan; ?>
														<?php } ?>
													<?php } ?>
												<?php } else { ?>
													<?php if ($val->id_skema_jaringan != null) { ?>
														<?php if ($val->ekstensi_skema_jaringan == 'zip') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_skema_jaringan; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_skema_jaringan; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_skema_jaringan; ?>
													<?php } ?>
												<?php } ?>
											<?php } ?>
										</td>

										<td style="border: 1px solid #000000 !important; text-align: left;">
											<?php if ($this->session->userdata('prive') == 'pemda') { ?>
												<?php if ($val->kotakabid == $this->session->userdata('kotakabid')) { ?>
													<?php if ($val->id_skema_bangunan != null) { ?>
														<?php if ($val->ekstensi_skema_bangunan == 'zip') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_skema_bangunan; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_skema_bangunan; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_skema_bangunan; ?>
													<?php } ?>
												<?php } ?>
												<?php if ($this->session->userdata('is_provinsi') == 'provinsi') { ?>
													<?php if ($val->id_skema_bangunan != null) { ?>
														<?php if ($val->ekstensi_skema_bangunan == 'zip') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_skema_bangunan; ?>')" disabled><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_skema_bangunan; ?>" class="btn btn-danger btn-icon" onclick="return false;" style="pointer-events: none;"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_skema_bangunan; ?>
													<?php } ?>
												<?php } ?>
											<?php } else { ?>
												<?php if ($this->session->userdata('prive') == 'balai') { ?>
													<?php if (in_array($val->kotakabid, $dataBalai)) { ?>
														<?php if ($val->id_skema_bangunan != null) { ?>
															<?php if ($val->ekstensi_skema_bangunan == 'zip') { ?>
																<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_skema_bangunan; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
															<?php } else { ?>
																<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_skema_bangunan; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
															<?php } ?>
															<br>
															<?= $val->upload_time_skema_bangunan; ?>
														<?php } ?>
													<?php } ?>
												<?php } else { ?>
													<?php if ($val->id_skema_bangunan != null) { ?>
														<?php if ($val->ekstensi_skema_bangunan == 'zip') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_skema_bangunan; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_skema_bangunan; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_skema_bangunan; ?>
													<?php } ?>
												<?php } ?>
											<?php } ?>
										</td>

										<td style="border: 1px solid #000000 !important; text-align: left;">
											<?php if ($this->session->userdata('prive') == 'pemda') { ?>
												<?php if ($val->kotakabid == $this->session->userdata('kotakabid')) { ?>
													<?php if ($val->id_bc_volume != null) { ?>
														<?php if ($val->ekstensi_bc_volume == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_bc_volume; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_bc_volume; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_bc_volume; ?>
													<?php } ?>
												<?php } ?>
												<?php if ($this->session->userdata('is_provinsi') == 'provinsi') { ?>
													<?php if ($val->id_bc_volume != null) { ?>
														<?php if ($val->ekstensi_bc_volume == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_bc_volume; ?>')" disabled><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_bc_volume; ?>" class="btn btn-dark btn-icon" onclick="return false;" style="pointer-events: none;"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_bc_volume; ?>
													<?php } ?>
												<?php } ?>
											<?php } else { ?>
												<?php if ($this->session->userdata('prive') == 'balai') { ?>
													<?php if (in_array($val->kotakabid, $dataBalai)) { ?>
														<?php if ($val->id_bc_volume != null) { ?>
															<?php if ($val->ekstensi_bc_volume == 'pdf') { ?>
																<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_bc_volume; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
															<?php } else { ?>
																<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_bc_volume; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
															<?php } ?>
															<br>
															<?= $val->upload_time_bc_volume; ?>
														<?php } ?>
													<?php } ?>
												<?php } else { ?>
													<?php if ($val->id_bc_volume != null) { ?>
														<?php if ($val->ekstensi_bc_volume == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_bc_volume; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_bc_volume; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_bc_volume; ?>
													<?php } ?>
												<?php } ?>
											<?php } ?>
										</td>

										<td style="border: 1px solid #000000 !important; text-align: left;">
											<?php if ($this->session->userdata('prive') == 'pemda') { ?>
												<?php if ($val->kotakabid == $this->session->userdata('kotakabid')) { ?>
													<?php if ($val->id_rab != null) { ?>
														<?php if ($val->ekstensi_rab == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_rab; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_rab; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" ariahidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_rab; ?>
													<?php } ?>
												<?php } ?>
												<?php if ($this->session->userdata('is_provinsi') == 'provinsi') { ?>
													<?php if ($val->id_rab != null) { ?>
														<?php if ($val->ekstensi_rab == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_rab; ?>')" disabled><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_rab; ?>" class="btn btn-dark btn-icon" onclick="return false;" style="pointer-events: none;"><i class="fa fa-file-archive fa-lg" ariahidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_rab; ?>
													<?php } ?>
												<?php } ?>
											<?php } else { ?>
												<?php if ($this->session->userdata('prive') == 'balai') { ?>
													<?php if (in_array($val->kotakabid, $dataBalai)) { ?>
														<?php if ($val->id_rab != null) { ?>
															<?php if ($val->ekstensi_rab == 'pdf') { ?>
																<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_rab; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
															<?php } else { ?>
																<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_rab; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" ariahidden="true"></i></a>
															<?php } ?>
															<br>
															<?= $val->upload_time_rab; ?>
														<?php } ?>
													<?php } ?>
												<?php } else { ?>
													<?php if ($val->id_rab != null) { ?>
														<?php if ($val->ekstensi_rab == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_rab; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_rab; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" ariahidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_rab; ?>
													<?php } ?>
												<?php } ?>
											<?php } ?>
										</td>

										<td style="border: 1px solid #000000 !important; text-align: left;">
											<?php if ($this->session->userdata('prive') == 'pemda') { ?>
												<?php if ($val->kotakabid == $this->session->userdata('kotakabid')) { ?>
													<?php if ($val->id_smk3 != null) { ?>
														<?php if ($val->ekstensi_smk3 == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_smk3; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_smk3; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_smk3; ?>
													<?php } ?>
												<?php } ?>
												<?php if ($this->session->userdata('is_provinsi') == 'provinsi') { ?>
													<?php if ($val->id_smk3 != null) { ?>
														<?php if ($val->ekstensi_smk3 == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_smk3; ?>')" disabled><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_smk3; ?>" class="btn btn-dark btn-icon" onclick="return false;" style="pointer-events: none;"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_smk3; ?>
													<?php } ?>
												<?php } ?>
											<?php } else { ?>
												<?php if ($this->session->userdata('prive') == 'balai') { ?>
													<?php if (in_array($val->kotakabid, $dataBalai)) { ?>
														<?php if ($val->id_smk3 != null) { ?>
															<?php if ($val->ekstensi_smk3 == 'pdf') { ?>
																<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_smk3; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
															<?php } else { ?>
																<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_smk3; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
															<?php } ?>
															<br>
															<?= $val->upload_time_smk3; ?>
														<?php } ?>
													<?php } ?>
												<?php } else { ?>
													<?php if ($val->id_smk3 != null) { ?>
														<?php if ($val->ekstensi_smk3 == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_smk3; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_smk3; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_smk3; ?>
													<?php } ?>
												<?php } ?>
											<?php } ?>
										</td>

										<td style="border: 1px solid #000000 !important; text-align: left;">
											<?php if ($this->session->userdata('prive') == 'pemda') { ?>
												<?php if ($val->kotakabid == $this->session->userdata('kotakabid')) { ?>
													<?php if ($val->id_dpa != null) { ?>
														<?php if ($val->ekstensi_dpa == 'zip') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_dpa; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_dpa; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_dpa; ?>
													<?php } ?>
												<?php } ?>
												<?php if ($this->session->userdata('is_provinsi') == 'provinsi') { ?>
													<?php if ($val->id_dpa != null) { ?>
														<?php if ($val->ekstensi_dpa == 'zip') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_dpa; ?>')" disabled><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_dpa; ?>" class="btn btn-danger btn-icon" onclick="return false;" style="pointer-events: none;"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_dpa; ?>
													<?php } ?>
												<?php } ?>
											<?php } else { ?>
												<?php if ($this->session->userdata('prive') == 'balai') { ?>
													<?php if (in_array($val->kotakabid, $dataBalai)) { ?>
														<?php if ($val->id_dpa != null) { ?>
															<?php if ($val->ekstensi_dpa == 'zip') { ?>
																<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_dpa; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
															<?php } else { ?>
																<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_dpa; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
															<?php } ?>
															<br>
															<?= $val->upload_time_dpa; ?>
														<?php } ?>
													<?php } ?>
												<?php } else { ?>
													<?php if ($val->id_dpa != null) { ?>
														<?php if ($val->ekstensi_dpa == 'zip') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_dpa; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_dpa; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_dpa; ?>
													<?php } ?>
												<?php } ?>
											<?php } ?>
										</td>

										<td style="border: 1px solid #000000 !important; text-align: left;">
											<?php if ($this->session->userdata('prive') == 'pemda') { ?>
												<?php if ($val->kotakabid == $this->session->userdata('kotakabid')) { ?>
													<?php if ($val->id_dokumentasi != null) { ?>
														<?php if ($val->ekstensi_dokumentasi == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_dokumentasi; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_dokumentasi; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_dokumentasi; ?>
													<?php } ?>
												<?php } ?>
												<?php if ($this->session->userdata('is_provinsi') == 'provinsi') { ?>
													<?php if ($val->id_dokumentasi != null) { ?>
														<?php if ($val->ekstensi_dokumentasi == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_dokumentasi; ?>')" disabled><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_dokumentasi; ?>" class="btn btn-dark btn-icon" onclick="return false;" style="pointer-events: none;"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_dokumentasi; ?>
													<?php } ?>
												<?php } ?>
											<?php } else { ?>
												<?php if ($this->session->userdata('prive') == 'balai') { ?>
													<?php if (in_array($val->kotakabid, $dataBalai)) { ?>
														<?php if ($val->id_dokumentasi != null) { ?>
															<?php if ($val->ekstensi_dokumentasi == 'pdf') { ?>
																<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_dokumentasi; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
															<?php } else { ?>
																<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_dokumentasi; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
															<?php } ?>
															<br>
															<?= $val->upload_time_dokumentasi; ?>
														<?php } ?>
													<?php } ?>
												<?php } else { ?>
													<?php if ($val->id_dokumentasi != null) { ?>
														<?php if ($val->ekstensi_dokumentasi == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_dokumentasi; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_dokumentasi; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_dokumentasi; ?>
													<?php } ?>
												<?php } ?>
											<?php } ?>
										</td>

										<td style="border: 1px solid #000000 !important; text-align: left;">
											<?php if ($this->session->userdata('prive') == 'pemda') { ?>
												<?php if ($val->kotakabid == $this->session->userdata('kotakabid')) { ?>
													<?php if ($val->id_kebenaran_data != null) { ?>
														<?php if ($val->ekstensi_kebenaran_data == 'zip') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_kebenaran_data; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_kebenaran_data; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_kebenaran_data; ?>
													<?php } ?>
												<?php } ?>
												<?php if ($this->session->userdata('is_provinsi') == 'provinsi') { ?>
													<?php if ($val->id_kebenaran_data != null) { ?>
														<?php if ($val->ekstensi_kebenaran_data == 'zip') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_kebenaran_data; ?>')" disabled><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_kebenaran_data; ?>" class="btn btn-danger btn-icon" onclick="return false;" style="pointer-events: none;"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_kebenaran_data; ?>
													<?php } ?>
												<?php } ?>
											<?php } else { ?>
												<?php if ($this->session->userdata('prive') == 'balai') { ?>
													<?php if (in_array($val->kotakabid, $dataBalai)) { ?>
														<?php if ($val->id_kebenaran_data != null) { ?>
															<?php if ($val->ekstensi_kebenaran_data == 'zip') { ?>
																<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_kebenaran_data; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
															<?php } else { ?>
																<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_kebenaran_data; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
															<?php } ?>
															<br>
															<?= $val->upload_time_kebenaran_data; ?>
														<?php } ?>
													<?php } ?>
												<?php } else { ?>
													<?php if ($val->id_kebenaran_data != null) { ?>
														<?php if ($val->ekstensi_kebenaran_data == 'zip') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_kebenaran_data; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_kebenaran_data; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_kebenaran_data; ?>
													<?php } ?>
												<?php } ?>
											<?php } ?>
										</td>


										<td style="border: 1px solid #000000 !important; text-align: left;">
											<?php if ($this->session->userdata('prive') == 'pemda') { ?>
												<?php if ($val->kotakabid == $this->session->userdata('kotakabid')) { ?>
													<?php if ($val->id_pemenuhan_kriteria != null) { ?>
														<?php if ($val->ekstensi_pemenuhan_kriteria == 'zip') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_pemenuhan_kriteria; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_pemenuhan_kriteria; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_pemenuhan_kriteria; ?>
													<?php } ?>
												<?php } ?>
												<?php if ($this->session->userdata('is_provinsi') == 'provinsi') { ?>
													<?php if ($val->id_pemenuhan_kriteria != null) { ?>
														<?php if ($val->ekstensi_pemenuhan_kriteria == 'zip') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_pemenuhan_kriteria; ?>')" disabled><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_pemenuhan_kriteria; ?>" class="btn btn-danger btn-icon" onclick="return false;" style="pointer-events: none;"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_pemenuhan_kriteria; ?>
													<?php } ?>
												<?php } ?>
											<?php } else { ?>
												<?php if ($this->session->userdata('prive') == 'balai') { ?>
													<?php if (in_array($val->kotakabid, $dataBalai)) { ?>
														<?php if ($val->id_pemenuhan_kriteria != null) { ?>
															<?php if ($val->ekstensi_pemenuhan_kriteria == 'zip') { ?>
																<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_pemenuhan_kriteria; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
															<?php } else { ?>
																<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_pemenuhan_kriteria; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
															<?php } ?>
															<br>
															<?= $val->upload_time_pemenuhan_kriteria; ?>
														<?php } ?>
													<?php } ?>
												<?php } else { ?>
													<?php if ($val->id_pemenuhan_kriteria != null) { ?>
														<?php if ($val->ekstensi_pemenuhan_kriteria == 'zip') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_pemenuhan_kriteria; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_pemenuhan_kriteria; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_pemenuhan_kriteria; ?>
													<?php } ?>
												<?php } ?>
											<?php } ?>
										</td>


										<td style="border: 1px solid #000000 !important; text-align: left;">
											<?php if ($this->session->userdata('prive') == 'pemda') { ?>
												<?php if ($val->kotakabid == $this->session->userdata('kotakabid')) { ?>
													<?php if ($val->id_penyiapan_lahan != null) { ?>
														<?php if ($val->ekstensi_penyiapan_lahan == 'zip') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_penyiapan_lahan; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_penyiapan_lahan; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_penyiapan_lahan; ?>
													<?php } ?>
												<?php } ?>
												<?php if ($this->session->userdata('is_provinsi') == 'provinsi') { ?>
													<?php if ($val->id_penyiapan_lahan != null) { ?>
														<?php if ($val->ekstensi_penyiapan_lahan == 'zip') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_penyiapan_lahan; ?>')" disabled><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_penyiapan_lahan; ?>" class="btn btn-danger btn-icon" onclick="return false;" style="pointer-events: none;"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_penyiapan_lahan; ?>
													<?php } ?>
												<?php } ?>
											<?php } else { ?>
												<?php if ($this->session->userdata('prive') == 'balai') { ?>
													<?php if (in_array($val->kotakabid, $dataBalai)) { ?>
														<?php if ($val->id_penyiapan_lahan != null) { ?>
															<?php if ($val->ekstensi_penyiapan_lahan == 'zip') { ?>
																<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_penyiapan_lahan; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
															<?php } else { ?>
																<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_penyiapan_lahan; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
															<?php } ?>
															<br>
															<?= $val->upload_time_penyiapan_lahan; ?>
														<?php } ?>
													<?php } ?>
												<?php } else { ?>
													<?php if ($val->id_penyiapan_lahan != null) { ?>
														<?php if ($val->ekstensi_penyiapan_lahan == 'zip') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_penyiapan_lahan; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_penyiapan_lahan; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_penyiapan_lahan; ?>
													<?php } ?>
												<?php } ?>
											<?php } ?>
										</td>

										<td style="border: 1px solid #000000 !important; text-align: left;">
											<?php if ($this->session->userdata('prive') == 'pemda') { ?>
												<?php if ($val->kotakabid == $this->session->userdata('kotakabid')) { ?>
													<?php if ($val->id_kesanggupan_op != null) { ?>
														<?php if ($val->ekstensi_kesanggupan_op == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_kesanggupan_op; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_kesanggupan_op; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_kesanggupan_op; ?>
													<?php } ?>
												<?php } ?>
												<?php if ($this->session->userdata('is_provinsi') == 'provinsi') { ?>
													<?php if ($val->id_kesanggupan_op != null) { ?>
														<?php if ($val->ekstensi_kesanggupan_op == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_kesanggupan_op; ?>')" disabled><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_kesanggupan_op; ?>" class="btn btn-dark btn-icon" onclick="return false;" style="pointer-events: none;"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_kesanggupan_op; ?>
													<?php } ?>
												<?php } ?>
											<?php } else { ?>
												<?php if ($this->session->userdata('prive') == 'balai') { ?>
													<?php if (in_array($val->kotakabid, $dataBalai)) { ?>
														<?php if ($val->id_kesanggupan_op != null) { ?>
															<?php if ($val->ekstensi_kesanggupan_op == 'pdf') { ?>
																<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_kesanggupan_op; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
															<?php } else { ?>
																<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_kesanggupan_op; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
															<?php } ?>
															<br>
															<?= $val->upload_time_kesanggupan_op; ?>
														<?php } ?>
													<?php } ?>
												<?php } else { ?>
													<?php if ($val->id_kesanggupan_op != null) { ?>
														<?php if ($val->ekstensi_kesanggupan_op == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_kesanggupan_op; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_kesanggupan_op; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_kesanggupan_op; ?>
													<?php } ?>
												<?php } ?>
											<?php } ?>
										</td>

										<td style="border: 1px solid #000000 !important; text-align: left;">
											<?php if ($this->session->userdata('prive') == 'pemda') { ?>
												<?php if ($val->kotakabid == $this->session->userdata('kotakabid')) { ?>
													<?php if ($val->id_peningkatan_ip != null) { ?>
														<?php if ($val->ekstensi_peningkatan_ip == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_peningkatan_ip; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_peningkatan_ip; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_peningkatan_ip; ?>
													<?php } ?>
												<?php } ?>
												<?php if ($this->session->userdata('is_provinsi') == 'provinsi') { ?>
													<?php if ($val->id_peningkatan_ip != null) { ?>
														<?php if ($val->ekstensi_peningkatan_ip == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_peningkatan_ip; ?>')" disabled><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_peningkatan_ip; ?>" class="btn btn-dark btn-icon" onclick="return false;" style="pointer-events: none;"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_peningkatan_ip; ?>
													<?php } ?>
												<?php } ?>
											<?php } else { ?>
												<?php if ($this->session->userdata('prive') == 'balai') { ?>
													<?php if (in_array($val->kotakabid, $dataBalai)) { ?>
														<?php if ($val->id_peningkatan_ip != null) { ?>
															<?php if ($val->ekstensi_peningkatan_ip == 'pdf') { ?>
																<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_peningkatan_ip; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
															<?php } else { ?>
																<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_peningkatan_ip; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
															<?php } ?>
															<br>
															<?= $val->upload_time_peningkatan_ip; ?>
														<?php } ?>
													<?php } ?>
												<?php } else { ?>
													<?php if ($val->id_peningkatan_ip != null) { ?>
														<?php if ($val->ekstensi_peningkatan_ip == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_peningkatan_ip; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_peningkatan_ip; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_peningkatan_ip; ?>
													<?php } ?>
												<?php } ?>
											<?php } ?>
										</td>

										<td style="border: 1px solid #000000 !important; text-align: left;">
											<?php if ($this->session->userdata('prive') == 'pemda') { ?>
												<?php if ($val->kotakabid == $this->session->userdata('kotakabid')) { ?>
													<?php if ($val->id_dokumen_lingkungan != null) { ?>
														<?php if ($val->ekstensi_dokumen_lingkungan == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_dokumen_lingkungan; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_dokumen_lingkungan; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_dokumen_lingkungan; ?>
													<?php } ?>
												<?php } ?>
												<?php if ($this->session->userdata('is_provinsi') == 'provinsi') { ?>
													<?php if ($val->id_dokumen_lingkungan != null) { ?>
														<?php if ($val->ekstensi_dokumen_lingkungan == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_dokumen_lingkungan; ?>')" disabled><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_dokumen_lingkungan; ?>" class="btn btn-dark btn-icon" onclick="return false;" style="pointer-events: none;"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_dokumen_lingkungan; ?>
													<?php } ?>
												<?php } ?>
											<?php } else { ?>
												<?php if ($this->session->userdata('prive') == 'balai') { ?>
													<?php if (in_array($val->kotakabid, $dataBalai)) { ?>
														<?php if ($val->id_dokumen_lingkungan != null) { ?>
															<?php if ($val->ekstensi_dokumen_lingkungan == 'pdf') { ?>
																<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_dokumen_lingkungan; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
															<?php } else { ?>
																<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_dokumen_lingkungan; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
															<?php } ?>
															<br>
															<?= $val->upload_time_dokumen_lingkungan; ?>
														<?php } ?>
													<?php } ?>
												<?php } else { ?>
													<?php if ($val->id_dokumen_lingkungan != null) { ?>
														<?php if ($val->ekstensi_dokumen_lingkungan == 'pdf') { ?>
															<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_dokumen_lingkungan; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
														<?php } else { ?>
															<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_dokumen_lingkungan; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>
														<?php } ?>
														<br>
														<?= $val->upload_time_dokumen_lingkungan; ?>
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

		showModalURK = function(kotakabid) {
			$('#kotakabidBa').val(kotakabid);
			$('#modalURK').modal('show');
		}

		verifFunc = function(idData, idJnsData, kotakabid) {

			let kondisi = ($(`#${idData}`).prop('checked')) ? '1' : '0';

			ajaxUntukSemua(base_url() + 'VerifDataTeknis/prosesVerif', {
				kondisi,
				idJnsData,
				kotakabid
			}, function(data) {

				if (data.code == 200) {
					toastr.success('Data berhasil disimpan.!');
				} else {
					toastr.error('Data gagal disimpan.');
				}

			}, function(error) {
				toastr.error('Error :' + error);

			});


			if (idJnsData == '4') {

				if (kondisi == '1') {
					$('#idButton' + kotakabid).attr('disabled', false);
				} else {
					$('#idButton' + kotakabid).attr('disabled', true);
				}

			}



		}


	})
</script>

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


<!-- <script>
	function openNewWindow(select) {
		var url = select.value;
		if (url) {
			window.open(url, '_blank');
		}
	}
</script> -->