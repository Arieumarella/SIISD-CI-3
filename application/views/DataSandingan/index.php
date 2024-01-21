
<section class="content">
	<div class="container-fluid">
		<br>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							Data Teknis Sandingan
						</h3>
					</div>

					<div class="card-body">
						<dl class="row">
							<dt class="col-sm-2">Pilih Tahun</dt>
							<dd class="col-sm-2">
								<select class="form-control form-control-sm select2" id="taAwal">
									<option value="" selected disabled>-- Pilih Tahun Awal --</option>
									<option value="2020">2020</option>
									<option value="2021">2021</option>
									<option value="2023">2023</option>
									<option value="2024">2024</option>
								</select>
							</dd>
							<dd class="col-sm-1 text-center" style="margin-top: 5px;"> SD </dd>
							<dd class="col-sm-2">
								<select class="form-control form-control-sm select2" id="taAkhir">
									<option value="" selected disabled>-- Pilih Tahun Akhir --</option>
									<option value="2020">2020</option>
									<option value="2021">2021</option>
									<option value="2023">2023</option>
									<option value="2024">2024</option>
								</select>
							</dd>
						</dl>
						<dl class="row">	
							<dt class="col-sm-2">Provinsi</dt>
							<dd class="col-sm-2">
								<select class="form-control form-control-sm select2" id="provid">
									<option value="" selected disabled >-- Pilih Provinsi --</option>

									<?php foreach ($dataProv as $key => $val) { ?>

										<option value="<?= $val->provid; ?>"><?= $val->provinsi; ?></option>

									<?php } ?>

								</select>
							</dd>
						</dl>
						<dl class="row">	
							<dt class="col-sm-2">Kab/Kota</dt>
							<dd class="col-sm-2">
								<select class="form-control form-control-sm select2" id="kabkotaid">
									<option value="" selected disabled >-- Pilih Kab/Kota --</option>

								</select>
							</dd>
						</dl>

						<dl class="row">	
							<dt class="col-sm-2">Jenis Form</dt>
							<dd class="col-sm-2">
								<select class="form-control form-control-sm select2" id="jnsForm">
									<option value="" selected disabled >-- Pilih Jenis Form --</option>
									<option value="2a">2a</option>
									<option value="2b">2b</option>
									<option value="2c">2c</option>
									<option value="2d">2d</option>
									<option value="2e">2e</option>
									<option value="4a">4a</option>
									<option value="4b">4b</option>
									<option value="4c">4c</option>
									<option value="4d">4d</option>
									<option value="4e">4e</option>
									<option value="5">5</option>
								</select>
							</dd>
						</dl>
						<dl class="row">
							<dd class="col-sm-7 text-right">
								<button class="btn btn-primary" onclick="cariX()"><i class="fa fa-search" aria-hidden="true"></i> Cari</button>
							</dd>
						</dl>

					</div>

				</div>

			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function() {

		cariX = function () {

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

			if (kabkotaid == null) {
				toastr.error('Silahkan Pilih Kab/Kota');
				return;
			}

			if (jnsForm == null) {
				toastr.error('Silahkan Pilih Jenis/Form');
				return;
			}



		}


		$('#provid').change(function() {
			let provid = $(this).val();

			ajaxUntukSemua(base_url()+'DataSandingan/getDataKabKota', {provid}, function(data) {

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