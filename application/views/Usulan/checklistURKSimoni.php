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

	.tableX thead{
		background-color:#d6d6d6;
		color: solid gray;
	}
	.tableX th{
		padding:10px;
		margin:0px;
		text-align:center;
		vertical-align: center;
		font-size: 14px;
		border: 1px solid gray !important;
	}
	.tableX td{
		padding:4px;
		margin:0px;
		border: 1px solid gray !important;
	}
	.number, .disabled_nilai{
		text-align:right;
	}

	.tabelVerifikasi {
		width: 100%;
		font-size: 14px;
	}

	.tabelVerifikasi td{
		padding:4px;
		margin:0px;
		border: 1px solid #9eb9cd !important;
	}


	.tableKomponen {
		width: 100%;
		font-size: 13px;
	}

	.tableKomponen td{
		padding: 4px;
		margin:0px;
		border: 1px solid #9eb9cd !important;
	}
	
	tbody tr:hover{
		background-color:#E9DAC1;
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
		display:flex;
		content: '\f00c';
		font-size: 15px;
		font-weight:bold;
		position: absolute;
		align-items:center;
		justify-content:center;
		font-family:'Font Awesome 5 Free';
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
					<li class="breadcrumb-item"><a href="<?= base_url(); ?>Usulan/rekapIrigasiProvinsi">Rekapitulasi Nasional</a></li>
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
						
						<table class=" table-bordered tableX " id="myTabelUsulan" style="width:100%;">
							<thead class="theadX">
								<!-- header utama -->
								<tr id="boxThField" >
									<th class="text-center" rowspan="2">No.</th>
									<?php if ($this->session->userdata('prive') == 'admin') { ?>
										<th class="text-center" rowspan="2" style="width:8%;">AKSI</th>
									<?php } ?>
									<th class="text-center" rowspan="2">DETAIL KEGIATAN</th>
									<th class="text-center" rowspan="2" style="width:17%;">KOMPONEN</th>
									<th class="text-center" colspan="2">OUTPUT KEGIATAN</th>
									<th class="text-center" rowspan="2">KEBUTUHAN <br> DANA</th>
									<th class="text-center" colspan="6">STATUS CHECKLIST</th>	
								</tr>
								<tr id="boxThField">
									<th class="text-center">VOLUME</th>    
									<th class="text-center">SATUAN</th>
									<th class="text-center">PROVINSI</th>
									<th class="text-center">BALAI</th>            
									<th class="text-center">DIRJEN IRAGASI RAWA</th>
									<th class="text-center">CATATAN  <br> DIRJEN IRIGASI RAWA</th>
									<th class="text-center">PFID</th>
									<th class="text-center">CATATAN <br> PFID</th>
								</tr>								
							</thead>
							<?php 
							$prive = $this->session->userdata('prive');
							$is_prive = $this->session->userdata('sda');
							?>

							<tbody id="tbody_data">
								<?php if ($dataRekap != null) { ?>

									<?php $no=1; foreach ($dataRekap as $key => $val) { ?>
										<?php 
										$checklist_provinsi = ($val->verif_provinsi == '1') ? 'checked' : '';
										$checklist_balai = ($val->verif_balai == '1') ? 'checked' : '';
										$checklist_sda = ($val->verif_sda == '1') ? 'checked' : '';
										$checklist_pusat = ($val->verif_pusat == '1') ? 'checked' : '';
										?>

										<tr>
											<td class="text-right"><?= $no++; ?><br></td>
											<?php if ($prive == 'admin') { ?>
												<td class="text-left" style="vertical-align: center;">
													<button class="btn btn-danger" onclick="hapusMainData('<?= $val->id; ?>')">
														<i class="fa fa-trash" aria-hidden="true">
														</i>
													</button> 
													<button class="btn btn-warning" onclick="editnData('<?= $val->id; ?>')"><i class="fa fa-eye" aria-hidden="true"></i>
													</button>
												</td>
											<?php } ?>
											<form method="POST" action="<?= base_url(); ?>Usulan/SimpanCheklistSimoni">
												<input type="hidden" name="idkabkota" value="<?= $kotakabid; ?>">
												<td class="text-left">

													<b><?= $val->nm_menu; ?></b>
													<br><br>
													<?php if ($val->kd_menu === '9') { ?>

														<b>WS</b>: <?= $val->nm_ws; ?>
														<br>
														<b>DAS</b> : <?= $val->nm_das; ?>	

														<br><br>

													<?php }else{ ?>
														<b><?= ($val->kategori_di == 'BARU') ? 'DI PEMBANGUNAN BARU' : $val->kategori_di; ?> - <?= $val->nm_di; ?></b>
														<br><br>
													<?php } ?>

													<b>Pengadaan</b> : <?= ($val->pengadaan == '1') ? 'Kontraktual' : 'Swakelola'; ?>
													<br><br>
													<b>Kecamatan</b> : <?= $val->keca; ?>
													<br>
													<b>Desa</b> : <?= $val->desa; ?>
												</td>
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
																	<td class="text-left" style="width:48%;"><?= $datakomponen['volume'] ?>  <?= $datakomponen['satuan'] ?></td>															
																</tr>
															<?php } ?>
														</table>
													<?php } ?>
												</td>
												<td class="text-right"><?= $val->output; ?></td>
												<td><?= $val->satuan_output; ?></td>
												<td class="text-right">Rp.<?= number_format($val->pagu_kegiatan,0,',','.'); ?></td>
												<td class="text-center">
													<input id='provinsi<?= $val->id; ?>' type="checkbox" name="cheklist_provinsi_<?= $val->id; ?>" class="option-input checkbox" <?= $checklist_provinsi; ?> <?= ($is_prive != 'disabled') ? 'disabled' : ''; ?>>
													<input type="hidden" name="id[<?= $val->id; ?>]">

												</td>
												<td class="text-center">
													<input id='balai<?= $val->id; ?>' type="checkbox" name="cheklist_balai_<?= $val->id; ?>" class="option-input checkbox" <?= $checklist_balai; ?> <?= ($prive != 'balai') ? 'disabled' : ''; ?>>
												</td>
												<td class="text-center">
													<input id='sda<?= $val->id; ?>' type="checkbox" name="cheklist_sda_<?= $val->id; ?>" class="option-input checkbox" <?= $checklist_sda; ?> <?= ($is_prive != 'sda') ? 'disabled' : ''; ?>>
												</td>
												<td class="text-center">
													<textarea class="form-control" rows="3" name="catat_sda[<?= $val->id; ?>]"
														<?= ($is_prive != 'sda') ? 'readonly' : ''; ?>><?= $val->catat_sda; ?></textarea>
													</td>
													<td class="text-center">
														<input id='pfid<?= $val->id; ?>' type="checkbox" class="option-input checkbox" name="cheklist_pfid_<?= $val->id; ?>" <?= $checklist_pusat; ?> <?= ($prive != 'admin') ? 'disabled' : ''; ?>>
													</td>
													<td class="text-center">
														<textarea class="form-control" rows="3" name="catat_pfid[<?= $val->id; ?>]" 
															<?= ($prive != 'admin') ? 'readonly' : ''; ?>><?= $val->catat_pusat; ?>
														</textarea>
													</td>
												</tr>
											<?php } ?>
										<?php }else{ ?>
											<tr>
												<td class="text-center" colspan="13"><b>DATA KOSONG.</b></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
								<?php if ($prive == 'admin' || $prive == 'balai' || $is_prive == 'sda' || $is_prive == 'provinsi') { ?>
									<button class="btn btn-primary m-2" type="submit" style="float:right;">SIMPAN</button>
								<?php } ?>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

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
							<label for="daerahIrigasiBaru_edit" class="col-form-label">Input Daerah Irigasi Baru:</label>
							<input type="text" class="form-control" name="daerahIrigasiBaru_edit" id="daerahIrigasiBaru_edit" required>
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
								<option value="" selected disabled>-- Pilih  Komponen --</option>
								<?php foreach ($dataKomponen as $key => $val) { ?>
									<option value="<?= $val->id ?>"><?= $val->nm_komponen.' ('.$val->satuan.')'; ?></option>
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
		$( document ).ready(function() {

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

			tambahData = function () {
				$('#modalTambah').modal('show');
			}

			$('#kategoriDi').on('change', function() {

				let val = this.value;

				if (val == 'BARU') {

					$('#daerahIrigasi').prop('required', false);
					$('#daerahIrigasiBaru').prop('required', true);
					$('#irigasi-input').hide();
					$('#irigasi-baru-input').show();

				}else{

					$('#daerahIrigasi').prop('required', true);
					$('#daerahIrigasiBaru').prop('required', false);

					ajaxUntukSemua(base_url()+'Usulan/getDataDiByKategori', {kategori:val}, function(data) {

						if (data != null) {

							let html = ``;

							$.map(data, function (val, key) {
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

				ajaxUntukSemua(base_url()+'Usulan/getDesa', {kdkec:val}, function(data) {


					let html = ``;

					$.map(data, function (val, key) {
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


			showModalKomponen = function (id) {
				$('#idData').val(id);
				$('#modalKomponen').modal('show');
			}


			hapuskomponen = function (id, idMasterData) {

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

						ajaxUntukSemua(base_url()+'Usulan/deleteKomponen', {id, idMasterData}, function(data) {

							location.reload();

						}, function(error) {
							alert(`Error : ${error}`);
							console.log('Kesalahan:', error);
						});
					}
				});
			}

			hapusMainData = function (id) {

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

						ajaxUntukSemua(base_url()+'Usulan/deleteBaseDaata', {id}, function(data) {
							location.reload();
						}, function(error) {
							alert(`Error : ${error}`);
							console.log('Kesalahan:', error);
						});


					}
				});


			}


			editnData = function (id) {

				ajaxUntukSemua(base_url()+'Usulan/getDataByIdSimoni', {idSimoni:id}, async function(data) {

					if (data.dataSimoni.kd_menu == '9') {
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

					}else{

						$('#pilih-kategori-di-edit').show();
						$('#pilih-ws-edit').hide();
						$('#pilih-das-edit').hide();

						$('#wsPilihEdit').prop('required', false);
						$('#dasEdit').prop('required', false);
						$('#kategoriDi_edit').prop('required', true);


						await $('#kategoriDi_edit').val(data.dataSimoni.kategori_di);

						if (data.dataSimoni.kategori_di == 'BARU') {

							await $('#daerahIrigasi_edit').prop('required', false);
							await $('#daerahIrigasiBaru_edit').prop('required', true);
							await $('#irigasi-input-edit').hide();
							await $('#irigasi-baru-input-edit').show();
							await $('#daerahIrigasiBaru_edit').val(data.dataSimoni.nm_di);

						}else{

							await $('#nm_di_edit').val(data.dataSimoni.nm_di)
							await $('#daerahIrigasi_edit').prop('required', true);
							await $('#daerahIrigasiBaru_edit').prop('required', false);
							await $('#irigasi-input-edit').show();
							await $('#irigasi-baru-input-edit').hide();
							await $('#daerahIrigasiBaru_edit').val('');

							if (data.dataDi != null) {

								let html = await ``;

								await $.map(data.dataDi, function (val, key) {
									html += `<option value="${val.irigasiid}">${val.nama}</option>`;
								})

								$('#daerahIrigasi_edit').html(html);
							}

							await $('#daerahIrigasi_edit').val(data.dataSimoni.kd_di);

						}

					}

					let html = await ``;

					await $.map(data.dataDesa, function (val, key) {
						html += `<option value="${val.desaid}">${val.desa}</option>`;
					})

					await $('#desa_edit').html(html);

					let html2 = await ``;

					await $.map(data.dataDas, function (val, key) {
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

				}, function(error) {
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

				}else{

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

				ajaxUntukSemua(base_url()+'Usulan/getDesa', {kdkec:val}, function(data) {


					let html = ``;

					$.map(data, function (val, key) {
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

				}else{

					$('#daerahIrigasi_edit').prop('required', true);
					$('#daerahIrigasiBaru_edit').prop('required', false);
					$('#irigasi-input-edit').show();
					$('#irigasi-baru-input-edit').hide();

					ajaxUntukSemua(base_url()+'Usulan/getDataDiByKategori', {kategori:val}, function(data) {

						if (data != null) {

							let html = ``;

							$.map(data, function (val, key) {
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

				if (val == '9') {
					$('#pilih-kategori-di').hide();
					$('#irigasi-input').hide();
					$('#irigasi-baru-input').hide();
					$('#pilih-ws').show();
					$('#pilih-das').show();

					$('#wsPilih').prop('required', true);
					$('#das').prop('required', true);
					$('#kategoriDi').prop('required', false);
					$('#daerahIrigasi').prop('required', false);
					$('#daerahIrigasiBaru').prop('required', false);

				}else{

					$('#pilih-kategori-di').show();
					$('#pilih-ws').hide();
					$('#pilih-das').hide();

					$('#wsPilih').prop('required', false);
					$('#das').prop('required', false);
					$('#kategoriDi').prop('required', true);

				}

			});

			$('#wsPilih').on('change', function() {

				let val = this.value;

				ajaxUntukSemua(base_url()+'Usulan/getDas', {kdws:val}, function(data) {


					let html = ``;

					$.map(data, function (val, key) {
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