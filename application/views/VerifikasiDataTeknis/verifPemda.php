<style type="text/css">
	
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
					<li class="breadcrumb-item"><a href="<?= base_url(); ?>VerifDataTeknis">Rekapitulasi Nasional</a></li>
					<li class="breadcrumb-item active"><?= $nmProv->provinsi; ?></li>
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<!-- Presentase Berdasarkan Status -->
				<div class="card">
					<div class="card-body text-center">
						<h4 class="mt-4"> REKAPITULASI VERIFIKASI DATA TEKNIS TA. <?= $this->session->userdata('thang'); ?> </h4>
						<h4 class="mb-2"> PROVINSI <?= $nmProv->provinsi; ?> </h4>

						<table class="table table-bordered mt-3">

							<thead id="thead_data">

								<tr id="boxThField1" style="background-color:#18978F; color:#fff;">
									<th style="border: thin solid #006666; width: 1px;">No</th>
									<th style="border: thin solid #006666; width: 4px;">Kab/Kota</th>
									<th style="border: thin solid #006666; width: 4px;">Download <br> Berita Acara</th>
									<th style="border: thin solid #006666; width: 20px;" >Pemda <br> Verifikasi</th>
									<th style="border: thin solid #006666; width: 20px;" >Provinsi <br> Verifikasi</th>
									<th style="border: thin solid #006666; width: 20px;" >Balai <br> Verifikasi</th>
									<th style="border: thin solid #006666; width: 20px;" >Pusat <br> Verifikasi</th>
								</tr>
							</thead>


							<tbody id="tbody_data">

								<?php 

								$no=1;
								$priv = $this->session->userdata('prive');
								$is_provinsi = $this->session->userdata('is_provinsi');

								?>

								<?php foreach ($dataProv as $key => $val) { ?>

									<?php 

									$kondisi = '';

									if ($val->pusat_verif == '1') {
										$kondisi = 'data-toggle="tooltip" data-placement="top" title="Telah diverifikasi oleh Pusat." disabled';
									}


									if ($this->session->userdata('prive') == 'pemda') {

										if ($val->kotakabid != $this->session->userdata('kotakabid') and $this->session->userdata('is_provinsi') != 'provinsi') {

											$kondisi = 'disabled';
										}


									}

									?>


									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center"><?= $no++; ?></td>

										<td style="border: thin solid #006666; text-align: left;">


											<?php if ($this->session->userdata('prive') == 'pemda') { ?>

												<?php if ($val->kotakabid == $this->session->userdata('kotakabid')) { ?>

													<a href="<?= base_url(); ?>VerifDataTeknis/DetailForm/<?= $val->kotakabid; ?>"><?= $val->kemendagri; ?></a>

												<?php }else{ ?>

													<?= $val->kemendagri; ?>

												<?php } ?>

											<?php }else{ ?>

												<a href="<?= base_url(); ?>VerifDataTeknis/DetailForm/<?= $val->kotakabid; ?>"><?= $val->kemendagri; ?></a>

											<?php } ?>



										</td>
										
										<td  style="border: thin solid #006666;" class="text-center">
											<button id="idButton<?= $val->kotakabid; ?>" class="btn btn-danger" onclick="showModalBa('<?= $val->kotakabid; ?>');" 

												<?= $priv != 'admin' ? 'disabled' : ''; ?>

												<?= $val->pusat_verif !== '1' ? 'disabled' : ''; ?>

												><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>
											</td>

											<td  style="border: thin solid #006666;" class="text-center">
												<input id='pemda<?= $no; ?>' type="checkbox" class="option-input checkbox" <?= $priv != 'pemda' ? 'disabled' : ''; ?> <?= $kondisi; ?> onclick="verifFunc('pemda<?= $no; ?>', '1', '<?= $val->kotakabid; ?>')" 
												<?= $val->pemda_verif == '1' ? 'checked' : ''; ?>>
											</td>

											<td  style="border: thin solid #006666;" class="text-center">
												<input id='provinsi<?= $no; ?>' type="checkbox" class="option-input checkbox" <?= $is_provinsi != 'provinsi' ? 'disabled' : ''; ?> <?= $kondisi; ?> onclick="verifFunc('provinsi<?= $no; ?>', '2', '<?= $val->kotakabid; ?>')" <?= $val->provinsi_verif == '1' ? 'checked' : ''; ?>>
											</td>
											<td  style="border: thin solid #006666;" class="text-center">
												<input type="checkbox" id='balai<?= $no; ?>' class="option-input checkbox" <?= $priv != 'balai' ? 'disabled' : ''; ?> <?= $kondisi; ?> onclick="verifFunc('balai<?= $no; ?>', '3', '<?= $val->kotakabid; ?>')" 
												<?= $val->balai_verif == '1' ? 'checked' : ''; ?>>
											</td>

											<?php 

											$kondisi = '';

											if ($val->pemda_verif == '1' AND $val->provinsi_verif == '1' AND $val->balai_verif == '1') {
												$kondisi = 'data-toggle="tooltip" data-placement="top" title="Pemda/Provinsi/Balai. Belum Checklist." disabled ';
											}

											?>

											<td  style="border: thin solid #006666;" class="text-center">
												<input type="checkbox" id='pusat<?= $no; ?>' onclick="verifFunc('pusat<?= $no; ?>', '4', '<?= $val->kotakabid; ?>')" class="option-input checkbox" 
												<?= $priv != 'admin' ? 'disabled' : ''; ?> <?= $kondisi; ?> 
												<?= $val->pusat_verif == '1' ? 'checked' : ''; ?>>

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


	<div class="modal fade" id="modalBa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Modal Berita Acara</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url(); ?>VerifDataTeknis/downloadBa" method="POST">
						<div class="form-group">
							<label for="recipient-name" class="col-form-label">Desk :</label>
							<input type="text" class="form-control" name="desk" id="desk" required>
							<input type="hidden" class="form-control" name="kotakabidBa" id="kotakabidBa">
						</div>
						<div class="form-group">
							<label for="recipient-name" class="col-form-label">Nama Verifikator :</label>
							<input type="text" class="form-control" name="nm_verifikator" id="nm_verifikator" required>
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

			showModalBa = function (kotakabid) {
				$('#kotakabidBa').val(kotakabid);
				$('#modalBa').modal('show');
			}

			verifFunc = function (idData, idJnsData, kotakabid) {

				let kondisi = ($(`#${idData}`).prop('checked')) ? '1':'0' ;

				ajaxUntukSemua(base_url()+'VerifDataTeknis/prosesVerif', {kondisi, idJnsData, kotakabid}, function(data) {

					if (data.code == 200) {
						toastr.success('Data berhasil disimpan.!');
					}else{
						toastr.error('Data gagal disimpan.');
					}

				}, function(error) {
					toastr.error('Error :'+error);

				});


				if (idJnsData == '4') {

					if (kondisi == '1') {
						$('#idButton'+kotakabid).attr('disabled', false);
					}else{
						$('#idButton'+kotakabid).attr('disabled', true);
					}

				}



			}

		})
	</script>