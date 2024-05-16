<section class="content">
	<div class="container-fluid">
		<br>
		<div class="row">
			<div class="card-body p-0 ">
				<div class="modal-body html-content" id="DivIdToPrint">
					<div class="row">
						<div class="col-md-12">
							<div class="card card-dark">
								<br><br> 

								<div class="row">
									<div class="card-body p-0 ">
										<div class="modal-body html-content" id="DivIdToPrint">
											<div class="row">
												<div class="col-md-6">
													<div class="card card-dark">
														<div class="card-header">
															<h3 class="card-title">Data Teknis Sandingan</h3>
														</div>
														<div class="card-body">
															<dl class="row">
																<dt class="col-sm-2">Pilih Tahun</dt>
																<dd class="col-sm-4">
																	<select class="form-control form-control-sm select2" id="taAwal">
																		<option value="" selected disabled>-- Pilih Tahun Awal --</option>
																		<option value="2024" <?= $tahunAwal == '2024' ? 'selected' : ''; ?>>2024</option>
																		<option value="2023" <?= $tahunAwal == '2023' ? 'selected' : ''; ?>>2023</option>
																		<option value="2022" <?= $tahunAwal == '2022' ? 'selected' : ''; ?>>2022</option>
																		<option value="2021" <?= $tahunAwal == '2021' ? 'selected' : ''; ?>>2021</option>
																		<option value="2020" <?= $tahunAwal == '2020' ? 'selected' : ''; ?>>2020</option>
																	</select>
																</dd>
																<dd class="col-sm-1 text-center" style="margin-top: 5px;"> S/D </dd>
																<dd class="col-sm-4">
																	<select class="form-control form-control-sm select2" id="taAkhir">
																		<option value="" selected disabled>-- Pilih Tahun Akhir --</option>
																		<option value="2024" <?= $tahunAkhir == '2024' ? 'selected' : ''; ?>>2024</option>
																		<option value="2023" <?= $tahunAkhir == '2023' ? 'selected' : ''; ?>>2023</option>
																		<option value="2022" <?= $tahunAkhir == '2022' ? 'selected' : ''; ?>>2022</option>
																		<option value="2021" <?= $tahunAkhir == '2021' ? 'selected' : ''; ?>>2021</option>
																		<option value="2020" <?= $tahunAkhir == '2020' ? 'selected' : ''; ?>>2020</option>
																	</select>
																</dd>
															</dl>
															<dl class="row">
																<dt class="col-sm-2">Provinsi</dt>
																<dd class="col-sm-4">
																	<select class="form-control form-control-sm select2" id="provid">
																		<option value="" selected disabled>-- Pilih Provinsi --</option>

																		<?php foreach ($dataProv as $key => $val) { ?>

																			<option value="<?= $val->provid; ?>" <?= $provid ==  $val->provid ? 'selected' : ''; ?>><?= $val->provinsi; ?></option>

																		<?php } ?>

																	</select>
																</dd>
															</dl>

															<dl class="row">
																<dt class="col-sm-2">Jenis Form</dt>
																<dd class="col-sm-4">
																	<select class="form-control form-control-sm select2" id="jnsForm">
																		<option value="" selected disabled>-- Pilih Jenis Form --</option>
																		<option value="2a" <?= $jnsForm == '2a' ? 'selected' : ''; ?>>2A</option>
																		<option value="2b" <?= $jnsForm == '2b' ? 'selected' : ''; ?>>2B</option>
																		<option value="2c" <?= $jnsForm == '2c' ? 'selected' : ''; ?>>2C</option>
																		<option value="2d" <?= $jnsForm == '2d' ? 'selected' : ''; ?>>2D</option>
																		<option value="2e" <?= $jnsForm == '2e' ? 'selected' : ''; ?>>2E</option>
																		<option value="4a" <?= $jnsForm == '4a' ? 'selected' : ''; ?>>4A</option>
																		<option value="4b" <?= $jnsForm == '4b' ? 'selected' : ''; ?>>4B</option>
																		<option value="4c" <?= $jnsForm == '4c' ? 'selected' : ''; ?>>4C</option>
																		<option value="4d" <?= $jnsForm == '4d' ? 'selected' : ''; ?>>4D</option>
																		<option value="4e" <?= $jnsForm == '4e' ? 'selected' : ''; ?>>4E</option>
																		<option value="5" <?= $jnsForm == '5' ? 'selected' : ''; ?>>5</option>
																		<option value="9" <?= $jnsForm == '9' ? 'selected' : ''; ?>>9</option>
																	</select>
																</dd>
															</dl>


															<!-- <a href=" DataSandingan/download" class="btn btn-info" title="Unduh"><i class="fas fa-file-excel"></i> Unduh</a> -->
															
															<?php if ($this->session->userdata('prive') == 'admin' or $this->session->userdata('prive') == 'pemda') { ?>

																<a href="<?= base_url(); ?>Form9/downloadTabel" class="btn btn-success float-right "><i class="fas fa-file-excel"></i> Unduh</a>

															<?php } ?> 

															<button class="btn btn-success float-right mr-2" onclick="cariX()"><i class="fa fa-search" aria-hidden="true"></i> TAMPILKAN</button>




														</div>
													</div>
												</div>

												<div class="col-md-6">
													<div class="card card-dark">
														<div class="card-header">
															<h3 class="card-title">Form Download Excel</h3>
														</div>

														<form class="form-horizontal" method="POST" action="<?= base_url(); ?>Form9/downloadExcel">
															<div class="card-body">
																<?php if ($this->session->userdata('prive') == 'admin') { ?>
																	<div class="form-group row">
																		<label for="prov" class="col-sm-3 col-form-label">Pilih Provinsi :</label>
																		<div class="col-sm-9">
																			<select id="prov" name="prov" class="form-control form-control-sm select2" required>
																				<option selected="" value="" selected disabled>- Pilih Provinsi -</option>
																				<?php foreach ($dataProv as $key => $value) { ?>
																					<option value="<?= $value->provid; ?>"><?= $value->provinsi; ?></option>
																				<?php } ?>
																			</select>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="kab" class="col-sm-3 col-form-label">Pilih Kab/Kota :</label>
																		<div class="col-sm-9">
																			<select id="kab" name="kab" class="form-control form-control-sm select2" required>
																				<option selected="" value="" selected disabled>- Pilih Kab/Kota -</option>
																			</select>
																		</div>
																	</div> 
																	<div class="form-group row">
																		<label for="tahunawal" class="col-sm-3 col-form-label">Jenis Form :</label>
																		<div class="col-sm-9">
																			<select class="form-control form-control-sm select2" id="jnsForm">
																				<option value="" selected disabled>-- Pilih Jenis Form --</option>
																				<option value="2a" <?= $jnsForm == '2a' ? 'selected' : ''; ?>>2A</option>
																				<option value="2b" <?= $jnsForm == '2b' ? 'selected' : ''; ?>>2B</option>
																				<option value="2c" <?= $jnsForm == '2c' ? 'selected' : ''; ?>>2C</option>
																				<option value="2d" <?= $jnsForm == '2d' ? 'selected' : ''; ?>>2D</option>
																				<option value="2e" <?= $jnsForm == '2e' ? 'selected' : ''; ?>>2E</option>
																				<option value="4a" <?= $jnsForm == '4a' ? 'selected' : ''; ?>>4A</option>
																				<option value="4b" <?= $jnsForm == '4b' ? 'selected' : ''; ?>>4B</option>
																				<option value="4c" <?= $jnsForm == '4c' ? 'selected' : ''; ?>>4C</option>
																				<option value="4d" <?= $jnsForm == '4d' ? 'selected' : ''; ?>>4D</option>
																				<option value="4e" <?= $jnsForm == '4e' ? 'selected' : ''; ?>>4E</option>
																				<option value="5" <?= $jnsForm == '5' ? 'selected' : ''; ?>>5</option>
																				<option value="9" <?= $jnsForm == '9' ? 'selected' : ''; ?>>9</option>
																			</select>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="tahunawal" class="col-sm-3 col-form-label">Tahun Awal:</label>
																		<div class="col-sm-9">

																			<select class="form-control form-control-sm select2" id="taAwal">
																				<option value="" selected disabled>-- Pilih Tahun Awal --</option>
																				<option value="2024" <?= $tahunAwal == '2024' ? 'selected' : ''; ?>>2024</option>
																				<option value="2023" <?= $tahunAwal == '2023' ? 'selected' : ''; ?>>2023</option>
																				<option value="2022" <?= $tahunAwal == '2022' ? 'selected' : ''; ?>>2022</option>
																				<option value="2021" <?= $tahunAwal == '2021' ? 'selected' : ''; ?>>2021</option>
																				<option value="2020" <?= $tahunAwal == '2020' ? 'selected' : ''; ?>>2020</option>
																			</select>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="tahunakhir" class="col-sm-3 col-form-label">Tahun Akhir:</label>
																		<div class="col-sm-9">
																			<select class="form-control form-control-sm select2" id="taAkhir">
																				<option value="" selected disabled>-- Pilih tahun Akhir --</option>
																				<option value="2024" <?= $tahunAkhir == '2024' ? 'seleected' : '' ?>>2024</option>
																				<option value="2023" <?= $tahunAkhir == '2023' ? 'seleected' : '' ?>>2023</option>
																				<option value="2022" <?= $tahunAkhir == '2022' ? 'seleected' : '' ?>>2022</option>
																				<option value="2021" <?= $tahunAkhir == '2021' ? 'seleected' : '' ?>>2021</option>
																				<option value="2020" <?= $tahunAkhir == '2020' ? 'seleected' : '' ?>>2020</option>
																			</select>
																		</div>
																	</div>
																<?php } ?>
																<button type="submit" class="btn btn-success float-right">Download</button>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="card-body p-0 ">
										<div class="modal-body html-content" id="DivIdToPrint">
											<div class="col-md-12">

												<!-- Jika Form 2 -->
												<?php if (substr($jnsForm, 0, 1) == '2') { ?>
													<div class="row">
														<table class="table table-bordered">

															<thead id="thead_data">
																<tr id="boxThField0" style="background-color:#b5aeae; color:black;">
																	<th style="border: thin solid black;" rowspan="2">No</th>
																	<th style="border: thin solid black;" colspan="1">Provinsi/Kab/Kota</th>
																	<?php for ($tahun = $tahunAwal; $tahun <= $tahunAkhir; $tahun++) { ?>
																		<th style="border: thin solid black;" colspan="2"><?= $tahun; ?></th>
																	<?php } ?>
																</tr>
																<tr id="boxThField1" style="background-color:#b5aeae; color:black;">
																	<th style="border: thin solid black;">Nama</th>

																	<?php for ($tahun = $tahunAwal; $tahun <= $tahunAkhir; $tahun++) { ?>
																		<th style="border: thin solid black;">Total IP (Ha)</th>
																		<th style="border: thin solid black;">IP (%)</th>
																	<?php } ?>
																</tr>
															</thead>
															<tbody id="tbody_data">
																<?php
																$no = 1;
																?>
																<?php foreach ($dataBody as $key => $value) { ?>
																	<tr>
																		<td style="border: thin solid black;" class="text-right"><?= $no++; ?></td>
																		<td style="border: thin solid black;" class="text-left"><?= cleanStr($value->kemendagri); ?></td>

																		<?php for ($tahun = $tahunAwal; $tahun <= $tahunAkhir; $tahun++) { ?>
																			<td style="border: thin solid black;"><?= cleanStr($value->{"totHa" . $tahun}); ?></td>
																			<td style="border: thin solid black;"><?= cleanStr($value->{"TotIp" . $tahun}); ?></td>
																		<?php } ?>
																	</tr>
																<?php } ?>
															</tbody>
														</table>
													</div>
												<?php } ?>
												<!-- End Form 2 -->
												<!-- Jika Form 4 -->
												<?php if (substr($jnsForm, 0, 1) == '4') { ?>
													<div class="row">
														<table class="table table-bordered">

															<thead id="thead_data">
																<tr id="boxThField0" style="background-color:#b5aeae; color:black;">
																	<th style="border: thin solid black;" rowspan="2">No</th>
																	<th style="border: thin solid black;" colspan="1">Provinsi/Kab/Kota</th>
																	<?php for ($tahun = $tahunAwal; $tahun <= $tahunAkhir; $tahun++) { ?>
																		<th style="border: thin solid black;" colspan="2"><?= $tahun; ?></th>
																	<?php } ?>
																</tr>
																<tr id="boxThField1" style="background-color:#b5aeae; color:black;">
																	<th style="border: thin solid black;">Nama</th>

																	<?php for ($tahun = $tahunAwal; $tahun <= $tahunAkhir; $tahun++) { ?>
																		<th style="border: thin solid black;">Kondisi (B/RR/RS/RB)</th>
																		<th style="border: thin solid black;">Nilai <br> (%)</th>
																	<?php } ?>
																</tr>
															</thead>


															<tbody id="tbody_data">
																<?php

																$no = 1;

																?>
																<?php foreach ($dataBody as $key => $value) { ?>
																	<tr>
																		<td style="border: thin solid black;" class="text-right"><?= $no++; ?></td>
																		<td style="border: thin solid black;" class="text-left"><?= cleanStr($value->kemendagri); ?></td>

																		<?php for ($tahun = $tahunAwal; $tahun <= $tahunAkhir; $tahun++) { ?>
																			<td style="border: thin solid black;">
																				<?php
																				$nilaiFix = cleanStr($value->{"TotNilai" . $tahun});
																				if ($nilaiFix !== 0) {
																					if ($nilaiFix > 90) {
																						echo 'B';
																					} elseif ($nilaiFix >= 80) {
																						echo 'RR';
																					} elseif ($nilaiFix >= 60) {
																						echo 'RS';
																					} elseif ($nilaiFix > 0) {
																						echo 'RB';
																					} else {
																						echo '';
																					}
																				} else {
																					echo '';
																				}

																				?>
																			</td>
																			<td style="border: thin solid black;"><?= cleanStr($value->{"TotNilai" . $tahun}); ?></td>
																		<?php } ?>
																	</tr>
																<?php } ?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									<?php } ?>
									<!-- End Form 4 -->

									<!-- Jika Form 5 -->
									<?php if (substr($jnsForm, 0, 1) == '5') { ?>
										<div class="row">
											<table class="table table-bordered">

												<thead id="thead_data">
													<tr id="boxThField0" style="background-color:#b5aeae; color:black;">
														<th style="border: thin solid black;" rowspan="2">No</th>
														<th style="border: thin solid black;" colspan="1">Provinsi/Kab/Kota</th>

														<?php for ($tahun = $tahunAwal; $tahun <= $tahunAkhir; $tahun++) { ?>

															<th style="border: thin solid black;"><?= $tahun; ?></th>

														<?php } ?>

													</tr>
													<tr id="boxThField1" style="background-color:#b5aeae; color:black;">
														<th style="border: thin solid black;">Nama</th>

														<?php for ($tahun = $tahunAwal; $tahun <= $tahunAkhir; $tahun++) { ?>
															<th style="border: thin solid black;">Dana Op <br> (Rp)</th>
														<?php } ?>
													</tr>
												</thead>


												<tbody id="tbody_data">
													<?php

													$no = 1;

													?>
													<?php foreach ($dataBody as $key => $value) { ?>
														<tr>
															<td style="border: thin solid black;" class="text-right"><?= $no++; ?></td>
															<td style="border: thin solid black;" class="text-left"><?= cleanStr($value->kemendagri); ?></td>

															<?php for ($tahun = $tahunAwal; $tahun <= $tahunAkhir; $tahun++) { ?>
																<td style="border: thin solid black;" class="text-right"><?= cleanStr($value->{"totNilai" . $tahun}); ?></td>
															<?php } ?>

														</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
									<?php } ?>
									<!-- End Form 5 -->

									<!-- Jika Form 9 -->
									<?php if (substr($jnsForm, 0, 1) == '9') { ?>
										<div class="row">
											<table class="table table-bordered">

												<thead id="thead_data">
													<tr id="boxThField0" style="background-color:#b5aeae; color:black;">
														<th style="border: thin solid black;" rowspan="2">No</th>
														<th style="border: thin solid black;" colspan="1">Provinsi/Kab/Kota</th>

														<?php for ($tahun = $tahunAwal; $tahun <= $tahunAkhir; $tahun++) { ?>

															<th style="border: thin solid black;" colspan="5"><?= $tahun; ?></th>

														<?php } ?>

													</tr>
													<tr id="boxThField1" style="background-color:#b5aeae; color:black;">
														<th style="border: thin solid black;">Nama</th>

														<?php for ($tahun = $tahunAwal; $tahun <= $tahunAkhir; $tahun++) { ?>
															<th style="border: thin solid black;">B</th>
															<th style="border: thin solid black;">RR</th>
															<th style="border: thin solid black;">RS</th>
															<th style="border: thin solid black;">RB</th>
															<th style="border: thin solid black;">IKSI</th>
														<?php } ?>
													</tr>
												</thead>


												<tbody id="tbody_data">
													<?php

													$no = 1;

													?>
													<?php foreach ($dataBody as $key => $value) { ?>
														<tr>
															<td style="border: thin solid black;" class="text-right"><?= $no++; ?></td>
															<td style="border: thin solid black;" class="text-left"><?= cleanStr($value->kemendagri); ?></td>

															<?php for ($tahun = $tahunAwal; $tahun <= $tahunAkhir; $tahun++) { ?>
																<td style="border: thin solid black;" class="text-right"><?= cleanStr($value->{"b" . $tahun}); ?></td>
																<td style="border: thin solid black;" class="text-right"><?= cleanStr($value->{"rr" . $tahun}); ?></td>
																<td style="border: thin solid black;" class="text-right"><?= cleanStr($value->{"rs" . $tahun}); ?></td>
																<td style="border: thin solid black;" class="text-right"><?= cleanStr($value->{"rb" . $tahun}); ?></td>
																<td style="border: thin solid black;" class="text-right"><?= cleanStr($value->{"persenTotal" . $tahun}); ?></td>
															<?php } ?>

														</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
									<?php } ?>
									<!-- End Form 9 -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script type="text/javascript">
		$(document).ready(function() {
			cariX = function() {

				let taAwal = $('#taAwal').val(),
				taAkhir = $('#taAkhir').val(),
				provid = $('#provid').val(),
				kabkotaid = $('#kabkotaid').val(),
				jnsForm = $('#jnsForm').val();

				if (taAwal == null) {
					toastr.error('Silahkan Pilih Tahun Awal');
					return;
				}

				if (taAkhir == null) {
					toastr.error('Silahkan Pilih Tahun Akhir');
					return;
				}

				if (taAwal > taAkhir) {
					toastr.error('Tahun awal tidak boleh lebih besar dari tahun akhir');
					return;
				}

				if (taAwal == taAkhir) {
					toastr.error('Tahun awal tidak boleh sama dengan tahun akhir');
					return;
				}

				if (provid == null) {
					toastr.error('Silahkan Pilih Provinsi');
					return;
				}

				if (jnsForm == null) {
					toastr.error('Silahkan Pilih Jenis/Form');
					return;
				}

				window.location.href = base_url() + `DataSandingan/index/${taAwal}/${taAkhir}/${provid}/${jnsForm}`;

			}


			$('#provid').change(function() {
				let provid = $(this).val();

				ajaxUntukSemua(base_url() + 'DataSandingan/getDataKabKota', {
					provid
				}, function(data) {

					let opt = `<option selected value="" disabled>- Pilih Kab/Kota -</option>`;

					$.each(data, function(index, obj) {

						opt += `<option value="${obj.kotakabid}" >${obj.kemendagri}</option>`;

					});

					$('#kabkotaid').html(opt);


				}, function(error) {
					console.log('Kesalahan:', error);
				});
			});
			$('.select2').select2({
				theme: 'default',
			})
		})
	</script>

	<script>
		$(document).ready(function(){

			$('.select2').select2({
				theme: 'default'
			})


			$('#prov').change(function() {
				let val = $(this).val();

				$.ajax({
					url: base_url()+'Form9/getDataKabKota',
					type: 'POST',
					dataType: 'json',
					data: {prov:val},
					success: function(data) {

						let opt = `<option selected value="" disabled>- Pilih Kab/Kota -</option>`;

						$.each(data, function(index, obj) {

							opt += `<option value="${obj.kotakabid}" >${obj.kemendagri}</option>`;

						});

						$('#kab').html(opt);
					},
					error: function(xhr, status, error) {
						console.error('Terjadi kesalahan:', status, error);
					}
				});

			});


			$('#prov-upload').change(function() {
				let val = $(this).val();

				$.ajax({
					url: base_url()+'Form9/getDataKabKota',
					type: 'POST',
					dataType: 'json',
					data: {prov:val},
					success: function(data) {

						let opt = `<option selected value="" disabled>- Pilih Kab/Kota -</option>`;

						$.each(data, function(index, obj) {

							opt += `<option value="${obj.kotakabid}" >${obj.kemendagri}</option>`;

						});

						$('#kab-upload').html(opt);

					},
					error: function(xhr, status, error) {
						console.error('Terjadi kesalahan:', status, error);
					}
				});

			});

		});
	</script>