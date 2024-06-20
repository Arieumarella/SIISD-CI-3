<style type="text/css">
	.fontLabel {
		font-size: 18px;
	}

	.keterangan {
		font-size: 18px;
		color: #bd4242;
		margin-top: -15px;
	}

	.table {
		font-size: 12px;
	}

	.table thead {
		background-color: #18978F;
		color: #fff;
	}

	.table th {
		padding: 4px;
		margin: 0px;
		text-align: center;
		vertical-align: center;
	}

	.table td {
		padding: 4px;
		margin: 0px;
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
					<li class="breadcrumb-item"><a href="<?= base_url(); ?>Usulan/rekapIrigasiProvinsi">Rekapitulasi Nasional</a></li>
					<!-- <li class="breadcrumb-item active"><?= $nm_Provinsi; ?></li> -->
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="text-center">
							<h3 class="font-weight-bolder">REKAPITULASI DOKUMEN IRIGASI KAB/KOTA TA. <?= $this->session->userdata('thang'); ?></h3>
							<!-- <h4 class="mb-2">PROVINSI <?= $nm_Provinsi; ?></h4> -->
						</div>
						<br>
						<?php if ($this->session->userdata('prive') == 'admin' or $this->session->userdata('prive') == 'sda' or $this->session->userdata('balai')) { ?>

							<div>
								<select class="form-control form-control-sm col-2" id="selectRekap" style="margin-bottom:-15px;">
									<option selected>Pilih</option>
									<option value="2">Checklist Simoni</option>
								</select>
							</div>

						<?php } ?>
						<table class="table table-bordered mt-4 text-center">
							<thead id="thead_data" class="theadX ">
								<!-- header utama -->
								<tr id="boxThField" style="background-color:#18978F; color:#fff;" class="">
									<th class="text-center" style="border: thin solid #006666;" rowspan="2">No.</th>
									<th class="text-center" style="border: thin solid #006666;" rowspan="2">Kab/Kota</th>
									<!-- <?php if ($this->session->userdata('prive') == 'admin') { ?>
										<th class="text-center" style="border: thin solid #006666;" rowspan="2">URK</th>
										<?php } ?> -->
									<th class="text-center" style="border: thin solid #006666;" colspan="18"> DOKUMEN</th>
								</tr>
								<tr id="boxThField" style="background-color:#18978F; color:#fff;">
									<th class="text-center" style="border: thin solid #006666; text-align: center;">URK</th>
									<th class="text-center" style="border: thin solid #006666;">LEMBAR <br> CHECKLIST</th>
									<th class="text-center" style="border: thin solid #006666;">SID</th>
									<th class="text-center" style="border: thin solid #006666;">DED</th>
									<th class="text-center" style="border: thin solid #006666;">KAK</th>
									<th class="text-center" style="border: thin solid #006666;">SKEMA <br> JARINGAN</th>
									<th class="text-center" style="border: thin solid #006666;">SKEMA <br> BANGUNAN</th>
									<th class="text-center" style="border: thin solid #006666;">BC <br> VOLUME</th>
									<th class="text-center" style="border: thin solid #006666;">RAB</th>
									<th class="text-center" style="border: thin solid #006666;">SMK3</th>
									<th class="text-center" style="border: thin solid #006666;">DPA</th>
									<th class="text-center" style="border: thin solid #006666;">DOKUMENTASI</th>
									<th class="text-center" style="border: thin solid #006666;">SURAT <br> KEBENARAN DATA</th>
									<th class="text-center" style="border: thin solid #006666;">SURAT PEMENUHAN<br> KRITERIA PEMBANGUNAN</th>
									<th class="text-center" style="border: thin solid #006666;">SURAT PERNYATAAN<br> PENYEDIA & <br> PENYIAPAN LAHAN</th>
									<th class="text-center" style="border: thin solid #006666;">SURAT PERNYATAAN<br> KESANGGUPAN OP <br> PRASARANA HARINGAN IRIGASI</th>
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
									<tr>
										<td class="text-right"><?= $no++; ?></td>
										<!-- <td><?= $val->kemendagri; ?></td> -->
										<td class="text-left">
											<a href="<?= base_url(); ?>Usulan/cheklistURKSimoni/<?= $val->kotakabid; ?>"><?= $val->kemendagri; ?></a>

										</td>
										<!-- <?php if ($this->session->userdata('prive') == 'admin') { ?>
											<td  class="text-center" >
												<button id="idButton<?= $val->kotakabid; ?>" class="btn btn-success" button id="idButton<?= $val->kotakabid; ?>" class="btn btn-success" onclick="showModalURK('<?= $val->kotakabid; ?>');">
													<i class="fa fa-file-excel fa-lg" aria-hidden="true">

													</i>
												</button>
											</td>
											<?php } ?> -->

										<td class="number text-center">
											<button id="idButton<?= $val->kotakabid; ?>" class="btn btn-danger" button id="idButton<?= $val->kotakabid; ?>" class="btn btn-success" onclick="showModalURK('<?= $val->kotakabid; ?>');">
												<i class="fa fa-file-pdf fa-lg" aria-hidden="true">
												</i>
											</button>
											<!-- <a href="<?= base_url(); ?>Usulan/exportpdf/<?= $val->kotakabid; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a> -->
										</td>

										<td class="text-center">
											<?php if ($val->id_lembar_ck_irigasi != null) { ?>
												<?php if ($val->ekstensi_lembar_ck_irigasi == 'zip') { ?>
													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_lembar_ck_irigasi; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
												<?php } else { ?>
													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_lembar_ck_irigasi; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>
												<?php } ?>
												<br>
												<?= $val->upload_time_lembar_ck_irigasi; ?>

											<?php } ?>
										</td>


										<td class="text-center">
											<?php if ($val->id_sid != null) { ?>

												<?php if ($val->ekstensi_sid == 'pdf') { ?>

													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_sid; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

												<?php } else { ?>

													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_sid; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

												<?php } ?>
												<br>
												<?= $val->upload_time_sid; ?>
											<?php } ?>
										</td>


										<td class="text-center">
											<?php if ($val->id_ded != null) { ?>

												<?php if ($val->ekstensi_ded == 'pdf') { ?>

													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_ded; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

												<?php } else { ?>

													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_ded; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

												<?php } ?>
												<br>
												<?= $val->upload_time_ded; ?>

											<?php } ?>
										</td>

										<td class="text-center">
											<?php if ($val->id_kak != null) { ?>

												<?php if ($val->ekstensi_kak == 'pdf') { ?>

													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_kak; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

												<?php } else { ?>

													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_kak; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

												<?php } ?>
												<br>
												<?= $val->upload_time_kak; ?>

											<?php } ?>
										</td>

										<td class="text-center">
											<?php if ($val->id_skema_jaringan != null) { ?>

												<?php if ($val->ekstensi_skema_jaringan == 'zip') { ?>

													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_skema_jaringan; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

												<?php } else { ?>

													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_skema_jaringan; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>

												<?php } ?>
												<br>
												<?= $val->upload_time_skema_jaringan; ?>

											<?php } ?>
										</td>


										<td class="text-center">
											<?php if ($val->id_skema_bangunan != null) { ?>

												<?php if ($val->ekstensi_skema_bangunan == 'zip') { ?>

													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_skema_bangunan; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

												<?php } else { ?>

													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_skema_bangunan; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>

												<?php } ?>
												<br>
												<?= $val->upload_time_skema_bangunan; ?>

											<?php } ?>
										</td>


										<td class="text-center">
											<?php if ($val->id_bc_volume != null) { ?>

												<?php if ($val->ekstensi_bc_volume == 'pdf') { ?>

													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_bc_volume; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

												<?php } else { ?>

													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_bc_volume; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

												<?php } ?>
												<br>
												<?= $val->upload_time_bc_volume; ?>

											<?php } ?>
										</td>

										<td class="text-center">
											<?php if ($val->id_rab != null) { ?>

												<?php if ($val->ekstensi_rab == 'pdf') { ?>

													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_rab; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

												<?php } else { ?>

													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_rab; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

												<?php } ?>
												<br>
												<?= $val->upload_time_rab; ?>

											<?php } ?>
										</td>


										<td class="text-center">
											<?php if ($val->id_smk3 != null) { ?>

												<?php if ($val->ekstensi_smk3 == 'pdf') { ?>

													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_smk3; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

												<?php } else { ?>

													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_smk3; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

												<?php } ?>
												<br>
												<?= $val->upload_time_smk3; ?>

											<?php } ?>
										</td>


										<td class="text-center">
											<?php if ($val->id_dpa != null) { ?>

												<?php if ($val->ekstensi_dpa == 'zip') { ?>

													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_dpa; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

												<?php } else { ?>

													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_dpa; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>

												<?php } ?>
												<br>
												<?= $val->upload_time_dpa; ?>

											<?php } ?>
										</td>

										<td class="text-center">
											<?php if ($val->id_dokumentasi != null) { ?>

												<?php if ($val->ekstensi_dokumentasi == 'pdf') { ?>

													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_dokumentasi; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

												<?php } else { ?>

													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_dokumentasi; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

												<?php } ?>
												<br>
												<?= $val->upload_time_dokumentasi; ?>

											<?php } ?>
										</td>


										<td class="text-center">
											<?php if ($val->id_kebenaran_data != null) { ?>

												<?php if ($val->ekstensi_kebenaran_data == 'zip') { ?>

													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_kebenaran_data; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

												<?php } else { ?>

													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_kebenaran_data; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>

												<?php } ?>
												<br>
												<?= $val->upload_time_kebenaran_data; ?>

											<?php } ?>
										</td>


										<td class="text-center">
											<?php if ($val->id_pemenuhan_kriteria != null) { ?>

												<?php if ($val->ekstensi_pemenuhan_kriteria == 'zip') { ?>

													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_pemenuhan_kriteria; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

												<?php } else { ?>

													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_pemenuhan_kriteria; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>

												<?php } ?>
												<br>
												<?= $val->upload_time_pemenuhan_kriteria; ?>

											<?php } ?>
										</td>

										<td class="text-center">
											<?php if ($val->id_penyiapan_lahan != null) { ?>

												<?php if ($val->ekstensi_penyiapan_lahan == 'zip') { ?>

													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_penyiapan_lahan; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

												<?php } else { ?>

													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_penyiapan_lahan; ?>" class="btn btn-danger btn-icon"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></a>

												<?php } ?>
												<br>
												<?= $val->upload_time_penyiapan_lahan; ?>

											<?php } ?>
										</td>


										<td class="text-center">
											<?php if ($val->id_kesanggupan_op != null) { ?>

												<?php if ($val->ekstensi_kesanggupan_op == 'pdf') { ?>

													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_kesanggupan_op; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

												<?php } else { ?>

													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_kesanggupan_op; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

												<?php } ?>
												<br>
												<?= $val->upload_time_kesanggupan_op; ?>

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
				<h5 class="modal-title" id="exampleModalLabel">Download URK</h5>
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
				<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
				<button type="submit" class="btn btn-success">Download</button>
			</div>
			</form>
		</div>
	</div>
</div>


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

<script type="text/javascript">
	$(document).ready(function() {
		$('#selectRekap').on('change', function() {
			let val = this.value;

			if (val == 2) {
				window.location.href = base_url() + "Usulan/cheklistURKSimoni";
			}

		});
	});
</script>

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