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
</style>

<section class="content">
	<div class="container-fluid">
		<br>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="text-center">
							<h4 class="font-weight-bolder">USULAN RENCANA KEGIATAN SIMONI</h4>
							<h4 class="font-weight-bolder"><?= $nmKabkota; ?></h4>
							<h4 class="font-weight-bolder">TA. <?= $this->session->userdata('thang') + 1; ?></h4>
						</div>
						<?= $this->session->flashdata('psn'); ?>
						<?php if ($this->session->userdata('prive') == 'pemda') { ?>
							<button class="btn btn-sm btn-primary" style="float:right; margin-bottom: 5px;" onclick="tambahData();"><i class="fa fa-plus" aria-hidden="true"></i> TAMBAH DATA</button>
						<?php } ?>

						<table class=" table-bordered tableX " id="myTabelUsulan" style="width:100%;">
							<thead class="theadX">
								<!-- header utama -->
								<tr id="boxThField">
									<th class="text-center" rowspan="2">No.</th>
									<th class="text-center" rowspan="2">DETAIL KEGIATAN</th>
									<th class="text-center" rowspan="2">JENIS DI</th>
									<th class="text-center" rowspan="2">PENGADAAN</th>
									<th class="text-center" rowspan="2" style="width:17%;">KOMPONEN</th>
									<th class="text-center" colspan="2">OUTPUT KEGIATAN</th>
									<th class="text-center" rowspan="2">KEBUTUHAN <br> DANA</th>
									<th class="text-center" rowspan="2">STATUS <br> CHECKLIST</th>
									<th class="text-center" rowspan="2" style="width:7%;">AKSI</th>

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
												<?php } ?>
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
											<td>
												<table class="tabelVerifikasi">
													<tr>
														<td style="width:10%;">Provinsi</td>
														<td style="width:10%;">
															<?php if ($val->verif_provinsi == '0' or $val->verif_provinsi == null) { ?>
																<i class="fa fa-times-circle text-danger" aria-hidden="true"></i>

															<?php } else { ?>
																<i class="fa fa-check-circle text-success" aria-hidden="true"></i>
															<?php } ?>
														</td>
														<td style="width:80%;">

														</td>
													</tr>
													<tr>
														<td style="width:10%;">Balai</td>
														<td style="width:10%;">
															<?php if ($val->verif_balai == '0' or $val->verif_balai == null) { ?>
																<i class="fa fa-times-circle text-danger" aria-hidden="true"></i>
															<?php } else { ?>
																<i class="fa fa-check-circle text-success" aria-hidden="true"></i>
															<?php } ?>
														</td>
														<td style="width:80%;">

														</td>
													</tr>
													<tr>
														<td style="width:10%;">SDA</td>
														<td style="width:10%;">
															<?php if ($val->verif_sda == '0' or $val->verif_sda == null) { ?>
																<i class="fa fa-times-circle text-danger" aria-hidden="true"></i>
															<?php } else { ?>
																<i class="fa fa-check-circle text-success" aria-hidden="true"></i>
															<?php } ?>
														</td>
														<td style="width:80%;">
															<?= $val->catat_sda; ?>
														</td>
													</tr>
													<tr>
														<td style="width:10%;">PFID</td>
														<td style="width:10%;">
															<?php if ($val->verif_pusat == '0' or $val->verif_pusat == null) { ?>
																<i class="fa fa-times-circle text-danger" aria-hidden="true"></i>
															<?php } else { ?>
																<i class="fa fa-check-circle text-success" aria-hidden="true"></i>
															<?php } ?>
														</td>
														<td style="width:80%;">
															<?= $val->catat_pusat; ?>
														</td>
													</tr>
												</table>
											</td>
											<td class="text-center">
												<?php if ($val->verif_provinsi === '0' and $val->verif_balai === '0' and $val->verif_sda === '0' and $val->verif_pusat === '0') { ?>

													<br>
													<button class="btn btn-danger btn-sm" onclick="hapusMainData('<?= $val->id; ?>')"><i class="fa fa-trash" aria-hidden="true"></i></button>
													<button class="btn btn-warning btn-sm" onclick="editnData('<?= $val->id; ?>')"><i class="fa fa-eye" aria-hidden="true"></i></button>

												<?php } ?>
											</td>
										</tr>
									<?php } ?>
								<?php } else { ?>
									<tr>
										<td class="text-center" colspan="10" style="height: 20px;"><b>DATA KOSOSNG.!</b></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>

					<!-- <div class="card-body">
						<table class=" table-bordered tableX " id="myTabelUsulan2" style="width:40%;">
							<thead class="theadX">
								<tr id="boxThField" >
									<th class="text-center">Nama Dinas</th>
									<th class="text-center">Nama <br> Kepala Dinas</th>
									<th class="text-center">NIP <br> Kepala Dinas</th>
									<th class="text-center">Tanda Tangan Kepala Dinas</th>
								</tr>								
							</thead>

							<tbody id="tbody_data2">
							</tbody>
						</table>
					</div> -->

				</div>
			</div>
		</div>
	</div>
</section>

<!-- Modal Tambah Data -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog ">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title font-weight-bold" id="exampleModalLabel">TAMBAH DATA</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="<?= base_url(); ?>Usulan/simpanUsulanKegiatanSimoni">
					<div class="form-group">
						<label for="menuKegiatan" class="col-form-label">Pilih Menu :</label>
						<select class="form-control" name="menuKegiatan" id="menuKegiatan" required>
							<option value="" selected disabled>-- Pilih Menu --</option>
							<?php foreach ($dataMenu as $key => $val) { ?>
								<option value="<?= $val->id; ?>"><?= $val->nm_menu; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group" id="pilih-ws" style="display: none;">
						<label for="wsPilih" class="col-form-label">Pilih WS :</label>
						<select class="form-control" name="wsPilih" id="wsPilih" required>
							<option value="" selected disabled>-- Pilih WS --</option>
							<?php foreach ($dataWS as $key => $val) { ?>
								<option value="<?= $val->id_ws; ?>"><?= $val->nm_ws; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group" id="pilih-das" style="display: none;">
						<label for="das" class="col-form-label">Pilih DAS :</label>
						<select class="form-control" name="das" id="das" required>
							<option value="" selected disabled>-- Pilih DAS --</option>

						</select>
					</div>
					<div class="form-group" id="pilih-kategori-di" style="display: none;">
						<label for="kategoriDi" class="col-form-label">Pilih Kategori D.I :</label>
						<select class="form-control" name="kategoriDi" id="kategoriDi" required>
							<option value="" selected disabled>-- Pilih Kategori D.I --</option>
							<option value="DIT">DIT</option>
							<option value="DI">DI</option>
							<option value="DIR">DIR</option>
							<option value="DIP">DIP</option>
							<option value="DIAT">DIAT</option>
							<option value="BARU">DI PEMBANGUNAN BARU</option>
						</select>
					</div>
					<div class="form-group" id="irigasi-input" style="display: none;">
						<label for="daerahIrigasi" class="col-form-label">Pilih Daerah irigasi :</label>
						<select class="form-control select2" name="daerahIrigasi" id="daerahIrigasi" required>
							<option value="" selected disabled>-- Pilih Daerah Irigasi --</option>
						</select>
						<input type="hidden" name="nm_di" id="nm_di">
					</div>

					<div class="form-group" id="irigasi-baru-input" style="display: none;">
						<label for="daerahIrigasiBaru" class="col-form-label">Pilih/Input Daerah Irigasi Baru :</label>
						<select class="form-control" name="daerahIrigasiBaru" id="daerahIrigasiBaru" required>
							<option value="" selected disabled>-- Pilih/Input Daerah Irigasi --</option>
							<?php foreach ($dataDiPembangunan as $key => $val) { ?>
								<option value="<?= $val->nm_di; ?>"><?= $val->nm_di; ?></option>
							<?php } ?>

						</select>
					</div>
					<div class="form-group" id="pilih-outcome" style="display: none;">
						<label for="jenisOutcome" class="col-form-label">Jenis Outcome :</label>
						<select class="form-control" name="jenisOutcome" id="jenisOutcome" required>
							<option value="" selected disabled>-- Pilih Jenis Outcome --</option>
							<option value="IP">IP</option>
							<option value="Luasan">Luasan</option>
						</select>
					</div>
					<div class="form-group">
						<label for="output" class="col-form-label">Output (Hektar) :</label>
						<input type="text" class="form-control" id="output" name="output" required oninput="this.value = this.value.replace(/\D/g, '')">
					</div>
					<div class="form-group">
						<label for="kecamatan" class="col-form-label">Pilih Kecamatan :</label>
						<select class="form-control select4" name="kecamatan" id="kecamatan" required>
							<option value="" selected disabled>-- Pilih Kecamatan --</option>
							<?php foreach ($dataKecamatan as $key => $val) { ?>
								<option value="<?= $val->kecaid; ?>"><?= $val->keca; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="desa" class="col-form-label">Pilih Desa :</label>
						<select class="form-control select5" name="desa" id="desa" required>
							<option value="" selected disabled>-- Pilih Desa --</option>

						</select>
					</div>
					<div class="form-group">
						<label for="pengadaan" class="col-form-label">Pilih Pengadaan :</label>
						<select class="form-control" name="pengadaan" id="pengadaan" required>
							<option value="" selected disabled>-- Pilih Pengadaan --</option>
							<option value="0">Swakelola</option>
							<option value="1">Kontraktual</option>
						</select>
					</div>
					<div class="form-group">
						<label for="pagu_kegiatan" class="col-form-label">Kebutuhan Dana :</label>
						<input type="text" class="form-control" id="pagu_kegiatan" name="pagu_kegiatan" required oninput="this.value = this.value.replace(/\D/g, '')">
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
<!-- End Modal tambah Data -->

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
				<form method="POST" action="<?= base_url(); ?>Usulan/editUsulanKegiatanSimoni">
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

<!-- Modal Tambah Komponen -->
<div class="modal fade" id="modalKomponen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog ">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title font-weight-bold" id="exampleModalLabel">TAMBAH KOMPONEN</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="<?= base_url(); ?>Usulan/tambahDataKomponen">
					<div class="form-group">
						<label for="komponen" class="col-form-label">Pilih Komponen :</label>
						<select class="form-control select3" name="komponen" id="komponen" required>
							<option value="" selected disabled>-- Pilih Komponen --</option>
							<?php foreach ($dataKomponen as $key => $val) { ?>
								<option value="<?= $val->id ?>"><?= $val->nm_komponen . ' (' . $val->satuan . ')'; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="volume" class="col-form-label">Volume :</label>
						<input type="text" class="form-control" id="volume" name="volume" required oninput="this.value = this.value.replace(/\D/g, '')">
						<input type="hidden" name="idData" id="idData">
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
<!-- End Modal tambah Komponen -->

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

					}
					if (data.dataSimoni.kd_menu == '1') {
						$('#kategoriDi_edit').html(`
						<option value="DIT">DIT</option>
						<option value="BARU">DI</option>
						<option value="DIAT">DIAT</option>
						<option value="DIP">DIP</option>
						`);
						$('#pilih-kategori-di-edt').show();
						$('#pilih-ws-edit').hide();
						$('#pilih-das-edit').hide();
						$('#wsPilihEdit').prop('required', false);
						$('#dasEdit').prop('required', false);
						$('#kategoriDi_edit').prop('required', true);




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
					}


					if (data.dataSimoni.kd_menu == '2') {

						$('#pilih-outcome-edit').show();
						$('#jenisOutcome-edit').prop('required', true);
						$('#jenisOutcome-edit').val(data.dataSimoni.jns_luasan);

					} else {
						$('#pilih-outcome-edit').hide();
						$('#jenisOutcome-edit').prop('required', false);
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
					<option value="DIAT">DIAT</option>
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
					<option value="DIAT">DIAT</option>
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
					<option value="DIAT">DIAT</option>
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

	});
</script>