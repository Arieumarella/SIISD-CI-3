
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
			<div class="col-md-12">
				<!-- Presentase Berdasarkan Status -->
				<div class="card">
					<div class="card-body text-center">
						<h4 class="mt-4"> REKAPITULASI CHEKLIST URK DAK FISIK INFRASTRUKTUR PUPR TA. <?= $this->session->userdata('thang'); ?></h4>
						<h4 class="mb-2">PROVINSI <?= $nm_Provinsi; ?></h4>
						<table class="table table-bordered mt-3">

							<thead id="thead_data">

								<tr id="boxThField1" style="background-color:#18978F; color:#fff;">
									<th style="border: thin solid #006666; width: 1%" rowspan="2">No</th>
									<th style="border: thin solid #006666; width: 30%;" rowspan="2">Kab/Kota</th>
									<th style="border: thin solid #006666; width:" rowspan="2"> Download </th>
									<th style="border: thin solid #006666; width: 20%;" rowspan="2">TOTAL <br> KEGIATAN</th>
									<th style="border: thin solid #006666;" colspan="4">CHEKLIST KEGIATAN</th>
								</tr>
								<tr id="boxThField1" style="background-color:#18978F; color:#fff;">
									
									<th style="border: thin solid #006666;">PROVINSI</th>
									<th style="border: thin solid #006666;">BALAI</th>
									<th style="border: thin solid #006666;">SDA</th>
									<th style="border: thin solid #006666;">PFID</th>
								</tr>
							</thead>


							<tbody id="tbody_data">

								<?php 

								$no=1;

								?>

								<?php foreach ($dataRekap as $key => $val) { ?>
									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center"><?= $no++; ?></td>
										<td style="border: thin solid #006666; text-align: left;">    
											<a href="<?= base_url(); ?>Usulan/cheklistURKSimoni/<?= $val->kotakabid; ?>"><?= $val->kemendagri; ?></a>
										</td>
										<td style="border: thin solid #006666;" class="number text-center" >
											<button id="idButton<?= $val->kdkabkota; ?>" class="btn btn-success" button id="idButton<?= $val->kdkabkota; ?>" class="btn btn-success" onclick="showModalURK('<?= $val->kdkabkota; ?>');">
												<i class="fa fa-file-excel fa-lg" aria-hidden="true">
													
												</i>
											</button>
										</td>
										<td style="border: thin solid #006666;" class="number"><?= $val->jml_data; ?></td>
										<td style="border: thin solid #006666;" class="number"><?= $val->jml_prov; ?></td>
										<td style="border: thin solid #006666;" class="number"><?= $val->jml_balai; ?></td>
										<td style="border: thin solid #006666;" class="number"><?= $val->jml_sda; ?></td>
										<td style="border: thin solid #006666;" class="number"><?= $val->jml_pusat; ?></
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

			showModalURK = function (kotakabid) {
				$('#kotakabidBa').val(kotakabid);
				$('#modalURK').modal('show');
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


	