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

</style>

<section class="content">
	<div class="container-fluid">
		<br>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="text-center">
							<h4 class="font-weight-bolder">USULAN RENCANA KEGIATAN KONREG</h4>
							<h4 class="font-weight-bolder"><?= $nmKabkota; ?></h4>
							<h4 class="font-weight-bolder">TA. <?= $this->session->userdata('thang')+1; ?></h4>
						</div>
						<?= $this->session->flashdata('psn'); ?>
						<?php if ($this->session->userdata('prive') == 'pemda') { ?>
							<!-- <button class="btn btn-sm btn-primary" style="float:right; margin-bottom: 5px;" onclick="tambahData();"><i class="fa fa-plus" aria-hidden="true"></i> TAMBAH DATA</button> -->
						<?php } ?>

						<table class=" table-bordered tableX " id="myTabelUsulan" style="width:100%;">
							<thead class="theadX">
								<!-- header utama -->
								<tr id="boxThField" >
									<th class="text-center" rowspan="2">No.</th>
									<th class="text-center" rowspan="2">NAMA DI</th>
									<th class="text-center" rowspan="2">JENIS DI</th>
									<th class="text-center" rowspan="2">PENGADAAN</th>
									<th class="text-center" rowspan="2" style="width:17%;">KOMPONEN</th>
									<th class="text-center" colspan="2">OUTPUT KEGIATAN</th>
									<th class="text-center" rowspan="2">KEBUTUHAN <br> DANA</th>
									<th class="text-center" rowspan="2">STATUS <br> CHECKLIST</th>
								</tr>
								<tr id="boxThField">
									<th class="text-center">VOLUME</th>    
									<th class="text-center">SATUAN</th>             
								</tr>								
							</thead>

							<tbody id="tbody_data">

								<?php if ($dataKegiatan != null) { ?>

									<?php $no=1; foreach ($dataKegiatan as $key => $val) { ?>
										<tr>
											<td class="text-center">
												<?= $no++; ?> 
												<?php if (($val->verif_provinsi === '0' AND $val->verif_balai === '0' AND $val->verif_sda === '0' AND $val->verif_pusat === '0') or ($val->verif_provinsi === null AND $val->verif_balai === null AND $val->verif_sda === null AND $val->verif_pusat === null)) { ?>
													<br>
													<button class="btn btn-warning btn-sm" onclick="editData('<?= $val->id; ?>')"><i class="fa fa-eye" aria-hidden="true"></i></button>
												<?php } ?>
											</td>
											<td>
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
											<td><?= ($val->kategori_di == 'BARU') ? 'DI PEMBANGUNAN BARU' : $val->kategori_di; ?></td>
											<td><?= ($val->pengadaan == '1') ? 'Kontraktual' : 'Swakelola'; ?></td>
											<td class="text-right" style="vertical-align: top;">
												<?php if (($val->verif_provinsi === '0' AND $val->verif_balai === '0' AND $val->verif_sda === '0' AND $val->verif_pusat === '0') or ($val->verif_provinsi === null AND $val->verif_balai === null AND $val->verif_sda === null AND $val->verif_pusat === null)) { ?>
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
																<td class="text-left" style="width:48%;"><?= $datakomponen['volume'] ?>  <?= $datakomponen['satuan'] ?></td>
																<?php if (($val->verif_provinsi === '0' AND $val->verif_balai === '0' AND $val->verif_sda === '0' AND $val->verif_pusat === '0') or ($val->verif_provinsi === null AND $val->verif_balai === null AND $val->verif_sda === null AND $val->verif_pusat === null)) { ?>
																	<td class="text-center" style="width:1%;"><button class="btn btn-danger btn-sm" onclick="hapuskomponen('<?= $datakomponen['id']; ?>', '<?= $datakomponen['id_usulan_konreg']; ?>')"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
																<?php } ?>
															</tr>
														<?php } ?>
													</table>
												<?php } ?>
											</td>
											<td class="text-right"><?= $val->output; ?></td>
											<td><?= $val->satuan_output; ?></td>
											<td class="text-right">Rp. <?= number_format($val->pagu_kegiatan,0,',','.'); ?></td>
											<td>
												<table class="tabelVerifikasi">
													<tr>
														<td style="width:10%;">Provinsi</td>
														<td style="width:10%;">
															<?php if ($val->verif_provinsi == '0' or $val->verif_provinsi == null) { ?>
																<i class="fa fa-times-circle text-danger" aria-hidden="true"></i>
																
															<?php }else{ ?>
																<i class="fa fa-check-circle text-success" aria-hidden="true"></i>
															<?php } ?>
														</td>
														<td style="width:80%;">
															<?= $val->catat_provinsi; ?>
														</td>
													</tr>
													<tr>
														<td style="width:10%;">Balai</td>
														<td style="width:10%;">
															<?php if ($val->verif_balai == '0' or $val->verif_balai == null) { ?>
																<i class="fa fa-times-circle text-danger" aria-hidden="true"></i>
															<?php }else{ ?>
																<i class="fa fa-check-circle text-success" aria-hidden="true"></i>
															<?php } ?>
														</td>
														<td style="width:80%;">
															<?= $val->catat_balai; ?>
														</td>
													</tr>
													<tr>
														<td style="width:10%;">SDA</td>
														<td style="width:10%;">
															<?php if ($val->verif_sda == '0' or $val->verif_sda == null) { ?>
																<i class="fa fa-times-circle text-danger" aria-hidden="true"></i>
															<?php }else{ ?>
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
															<?php }else{ ?>
																<i class="fa fa-check-circle text-success" aria-hidden="true"></i>
															<?php } ?>
														</td>
														<td style="width:80%;">
															<?= $val->catat_pusat; ?>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									<?php } ?>
								<?php }else{ ?>
									<tr>
										<td class="text-center" colspan="9" style="height: 20px;"><b>DATA KOSOSNG.!</b></td>
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
				<form method="POST" action="<?= base_url(); ?>Usulan/tambahDataKomponenKonreg">
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
				<form method="POST" action="<?= base_url(); ?>Usulan/editDataRkKonreg">
					<input type="hidden" name="idEditKonreg" id="idEditKonreg">
					<div class="form-group">
						<label for="daerahIrigasiBaru_edit" class="col-form-label">Nama DI :</label>
						<input type="text" class="form-control" name="daerahIrigasiBaru_edit" id="daerahIrigasiBaru_edit" required>
					</div>
					<div class="form-group">
						<label for="output_edit" class="col-form-label">Output (Hektar) :</label>
						<input type="text" class="form-control" id="output_edit" name="output_edit" required oninput="this.value = this.value.replace(/\D/g, '')">
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

						let html = `<option value="" selected disabled>-- Pilih Daerah Irigasi --</option>`;

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
					ajaxUntukSemua(base_url()+'Usulan/deleteKomponenKonreg', {id, idMasterData}, function(data) {
						location.reload();

					}, function(error) {
						alert(`Error : ${error}`);
						console.log('Kesalahan:', error);
					});


				}
			});


		}


		editData = function (id) {
			

			ajaxUntukSemua(base_url()+'Usulan/getDataRkKonreg', {id}, function(data) {

				$('#idEditKonreg').val(data.id);
				$('#daerahIrigasiBaru_edit').val(data.nm_di);
				$('#output_edit').val(data.output);
				$('#pengadaan_edit').val(data.pengadaan);
				$('#pagu_kegiatan_edit').val(data.pagu_kegiatan);

				$('#modalEdit').modal('show');

			}, function(error) {
				alert(`Error : ${error}`);
				console.log('Kesalahan:', error);
			});
		}


	});
</script>