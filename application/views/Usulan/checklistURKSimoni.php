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

	.option-input:checked::before {
		width: 28px;
		height: 28px;
		display: flex;
		content: '\f00c';
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
					<div class="card-body text-center">
						<h4 class="mt-4"> REKAPITULASI CHEKLIST URK DAK FISIK INFRASTRUKTUR PUPR TA. <?= $this->session->userdata('thang'); ?></h4>
						<h4 class="mb-2">PROVINSI <?= $nm_prov; ?></h4>
						<h4 class="mb-2"><?= $nm_kotakab; ?></h4>
						<?= $this->session->flashdata('psn'); ?>
						<br><br>
						<?php if ($this->session->userdata('prive') == 'admin' or $this->session->userdata('prive') == 'sda') { ?>
							<select class="form-control form-control-sm col-2" id="selectRekap" tyle="margin-bottom:-15px;">
								<option> --Pilih-- </option>
								<option value="1">CHECKLIST PFID</option>
								<option value="2">CHECKLIST IRWA</option>
							</select>
						<?php } ?>
						<br><br>
						<form method="POST" action="<?= base_url(); ?>Usulan/SimpanCheklistSimoni">
							<input type="hidden" name="idkabkota" value="<?= $kotakabid; ?>">
							<table class=" table-bordered tableX " id="myTabelUsulan" style="width:100%;">
								<thead class="theadX">
									<!-- header utama -->
									<tr id="boxThField">
										<th class="text-center" rowspan="2">No.</th>
										<th class="text-center" rowspan="2">DETAIL KEGIATAN</th>
										<th class="text-center" rowspan="2">JENIS DI</th>
										<th class="text-center" rowspan="2">PENGADAAN</th>
										<th class="text-center" rowspan="2" style="width:17%;">KOMPONEN</th>
										<th class="text-center" colspan="2">OUTCOME KEGIATAN</th>
										<th class="text-center" rowspan="2">KEBUTUHAN <br> DANA</th>
										<th class="text-center" rowspan="2" style="width:8%;">AKSI</th>

									</tr>
									<tr id="boxThField">
										<th class="text-center">VOLUME</th>
										<th class="text-center">SATUAN</th>
									</tr>
								</thead>

								<?php
								$prive = $this->session->userdata('prive');
								$is_prive = $this->session->userdata('sda');
								?>

								<tbody id="tbody_data">
									<?php $hasData = false;
									if ($dataKegiatan != null) { ?>
										<?php $no = 1;
										foreach ($dataKegiatan as $key => $val) { ?>
											<?php
											$checklist_provinsi = ($val->verif_provinsi == '1') ? 'checked' : '';
											$checklist_balai = ($val->verif_balai == '1') ? 'checked' : '';
											$checklist_sda = ($val->verif_sda == '1') ? 'checked' : '';
											$checklist_pusat = ($val->verif_pusat == '1') ? 'checked' : '';
											?>

											<?php if ($val->kd_menu === '1' or $val->kd_menu === '2' or $val->kd_menu === '3' or $val->kd_menu === '9') {
												$hasData = true; ?>
												<tr>
													<td class="text-center" rowspan="6">
														<?= $no++; ?>
													</td>
													<td class="text-left">
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
														<br>

													</td>
													<td><?= ($val->kategori_di == 'BARU') ? 'DI PEMBANGUNAN BARU' : $val->kategori_di; ?></td>
													<td><?= ($val->pengadaan == '1') ? 'Kontraktual' : 'Swakelola'; ?></td>
													<td class="text-right" style="vertical-align: top;">

														<!-- Cek Apakah Komponen ada -->
														<?php if ($val->komponen_json != null) { ?>

															<?php
															// Konvert data komponen JSON -> Array
															$dataKomponenArray = json_decode($val->komponen_json, true);
															?>
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
													<td class="text-right"><?= ($val->jns_luasan != null) ? '<b>' . $val->jns_luasan . ' : </b>' : ''; ?> <?= $val->output; ?></td>
													<td><?= $val->satuan_output; ?></td>
													<td class="text-left"><b>- Dana :</b> Rp <?= number_format($val->pagu_kegiatan, 0, ',', '.'); ?> <br> <b>- Harga Satuan :</b>
														Rp <?= number_format($val->pagu_kegiatan / $val->output, 0, ',', '.'); ?></td>

													<?php if ($prive == 'admin') { ?>
														<td class="text-left" style="vertical-align: center;" rowspan="6">
															<button type="button" class="btn btn-danger" onclick="hapusMainData('<?= $val->id; ?>')">
																<i class="fa fa-trash" aria-hidden="true"></i>
															</button>
															<button type="button" class="btn btn-warning" onclick="editnData('<?= $val->id; ?>')">
																<i class="fa fa-eye" aria-hidden="true"></i>
															</button>
														</td>
													<?php } ?>
												</tr>
												<tr id="boxThField">
												<tr>
													<td colspan="2"><b>CHECKLIST</b></td>
													<td colspan="5"><b>CATATAN</b></td>
												</tr>
												<tr>
													<td>PFID <input type="hidden" name="id[<?= $val->id; ?>]"></td>

													<td>
														<input id='pfid<?= $val->id; ?>' type="checkbox" class="option-input checkbox" name="cheklist_pfid_<?= $val->id; ?>" <?= $checklist_pusat; ?> <?= ($prive != 'admin') ? 'disabled' : ''; ?>>
													</td>
													<td colspan="5"><textarea class="form-control" rows="3" name="catat_pfid[<?= $val->id; ?>]" <?= ($prive != 'admin') ? 'readonly' : ''; ?>><?= $val->catat_pusat; ?></textarea></td>
												</tr>
												<tr>
													<td>IRWA</td>
													<td>
														<input id='sda<?= $val->id; ?>' type="checkbox" name="cheklist_sda_<?= $val->id; ?>" class="option-input checkbox" <?= $checklist_sda; ?> <?= ($is_prive != 'sda') ? 'disabled' : ''; ?>>
													</td>
													<td colspan="5"><textarea class="form-control" rows="3" name="catat_sda[<?= $val->id; ?>]" <?= ($is_prive != 'sda') ? 'readonly' : ''; ?>><?= $val->catat_sda; ?></textarea></td>
												</tr>
												<tr>
													<td>BALAI</td>
													<td>
														<input id='balai<?= $val->id; ?>' type="checkbox" name="cheklist_balai_<?= $val->id; ?>" class="option-input checkbox" <?= $checklist_balai; ?> <?= ($prive != 'balai') ? 'disabled' : ''; ?>>
													</td>
													<td colspan="5"><textarea class="form-control" rows="3" name="catat_balai[<?= $val->id; ?>]" <?= ($prive != 'balai') ? 'readonly' : ''; ?>><?= $val->catat_balai; ?></textarea></td>
												</tr>
												</tr>

											<?php } ?>
										<?php } ?>

								</tbody>
							</table>
							<?php if ($prive == 'admin' || $prive == 'balai' || $is_prive == 'sda') { ?>
								<button class="btn btn-primary m-2" type="submit" style="float:right;"><i class="fa fa-save" aria-hidden="true"></i> SIMPAN</button>
							<?php } ?>
							<?php foreach ($dataKegiatan as $key => $val) { ?>
								<?php if ($this->session->userdata('prive') == 'admin') { ?>
									<?php if (isset($val->kotakabid) && $val->kotakabid == $this->session->userdata('kotakabid')) { ?>
										<a href="<?= base_url(); ?>ExportPdf/export_pdf/<?= $val->kotakabid; ?>" class="btn btn-success btn-icon" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
									<?php } ?>
								<?php } ?>
							<?php } ?>
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
						<select class="form-control" name="menuKegiatan_edit" id="menuKegiatan_edit" required>
							<option value="" selected disabled>-- Pilih Menu --</option>
							<?php foreach ($dataMenu as $key => $val) { ?>
								<option value="<?= $val->id; ?>"><?= $val->nm_menu; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group" id="pilih-ws-edit" style="display: none;">
						<label for="wsPilihEdit" class="col-form-label">Pilih WS :</label>
						<select class="form-control" name="wsPilihEdit" id="wsPilihEdit" required>
							<option value="" selected disabled>-- Pilih WS --</option>
							<?php foreach ($dataWS as $key => $val) { ?>
								<option value="<?= $val->id_ws; ?>"><?= $val->nm_ws; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group" id="pilih-das-edit" style="display: none;">
						<label for="dasEdit" class="col-form-label">Pilih DAS :</label>
						<select class="form-control" name="dasEdit" id="dasEdit" required>
							<option value="" selected disabled>-- Pilih DAS --</option>

						</select>
					</div>
					<div class="form-group" id="pilih-kategori-di-edit" style="display: none;">
						<label for="kategoriDi_edit" class="col-form-label">Pilih Kategori D.I :</label>
						<select class="form-control" name="kategoriDi_edit" id="kategoriDi_edit" required>
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
						<select class="form-control select2" name="daerahIrigasi_edit" id="daerahIrigasi_edit" required>
							<option value="" selected disabled>-- Pilih Daerah Irigasi --</option>
						</select>
						<input type="hidden" name="nm_di_edit" id="nm_di_edit">
					</div>
					<div class="form-group" id="irigasi-baru-input-edit" style="display: none;">
						<label for="daerahIrigasiBaru_edit" class="col-form-label">Pilih/Input Daerah Irigasi Baru :</label>
						<select class="form-control" name="daerahIrigasiBaru_edit" id="daerahIrigasiBaru_edit" required>
							<?php foreach ($dataDiPembangunan as $key => $val) { ?>
								<option value="<?= $val->nm_di; ?>"><?= $val->nm_di; ?></option>
							<?php } ?>

						</select>
					</div>

					<div class="form-group" id="pilih-outcome-edit" style="display: none;">
						<label for="jenisOutcome-edit" class="col-form-label">Jenis Outcome :</label>
						<select class="form-control" name="jenisOutcome-edit" id="jenisOutcome-edit" required>
							<option value="" selected disabled>-- Pilih Jenis Outcome --</option>
							<option value="IP">IP</option>
							<option value="Luasan">Luasan</option>
						</select>
					</div>
					<div class="form-group">
						<label for="output_edit" class="col-form-label">Output (Hektar) :</label>
						<input type="text" class="form-control" id="output_edit" name="output_edit" required oninput="this.value = this.value.replace(/\D/g, '')">
					</div>
					<div class="form-group">
						<label for="kecamatan_edit" class="col-form-label">Pilih Kecamatan :</label>
						<select class="form-control " name="kecamatan_edit" id="kecamatan_edit" required>
							<option value="" selected disabled>-- Pilih Kecamatan --</option>
							<?php foreach ($dataKecamatan as $key => $val) { ?>
								<option value="<?= $val->kecaid; ?>"><?= $val->keca; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="desa_edit" class="col-form-label">Pilih Desa :</label>
						<select class="form-control" name="desa_edit" id="desa_edit" required>
							<option value="" selected disabled>-- Pilih Desa --</option>

						</select>
					</div>
					<div class="form-group">
						<label for="pengadaan_edit" class="col-form-label">Pilih Pengadaan :</label>
						<select class="form-control" name="pengadaan_edit" id="pengadaan_edit" required>
							<option value="" selected disabled>-- Pilih Pengadaan --</option>
							<option value="0">Swakelola</option>
							<option value="1">Kontraktual</option>
						</select>
					</div>
					<div class="form-group">
						<label for="pagu_kegiatan_edit" class="col-form-label">Kebutuhan Dana :</label>
						<input type="text" class="form-control" id="pagu_kegiatan_edit" name="pagu_kegiatan_edit" required oninput="this.value = this.value.replace(/\D/g, '')">
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

<div class="modal fade" id="modalParaf" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog ">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title font-weight-bold" id="exampleModalLabel">Paraf Verifikator</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="<?= base_url(); ?>Usulan/simpanParafVerif" enctype="multipart/form-data">
					<div class="form-group">
						<label for="output" class="col-form-label">Nama Verifikator :</label>
						<input type="text" class="form-control" id="nm_verif" name="nm_verif" required oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '')" required>
					</div>
					<div class="form-group">
						<label for="output" class="col-form-label">Desk :</label>
						<input type="text" class="form-control" id="desk" name="desk" required oninput="this.value = this.value.replace(/\D/g, '')" required>
					</div>
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Paraf Verifikator :</label>
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="paraf_verif" name="paraf_verif" accept="image/*" required>
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