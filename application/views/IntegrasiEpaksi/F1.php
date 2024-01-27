<?php 

$priv = $this->session->userdata('prive');

?>
<section class="content">
	<div class="container-fluid">
		<br>
		<div class="row">
			<div class="col-md-12">
				<div class="card" id="idForm">
					<div class="card-header">
						<h3 class="card-title">
							Data Form 1
						</h3>
					</div>

					<div class="card-body" >
						<dl class="row">	
							<dt class="col-sm-2">Provinsi</dt>
							<dd class="col-sm-2">
								<select class="form-control form-control-sm select2" id="provid">
									
									<?php if ($priv == 'admin') { ?>

										<option value="" selected disabled >-- Pilih Provinsi --</option>

										<?php foreach ($prov as $key => $val) { ?>

											<option value="<?= $val->provid; ?>"><?= $val->provinsi; ?></option>

										<?php } ?>

									<?php } ?>


									<?php if ($priv == 'pemda') { ?>
										<option value="<?= $prov->provid; ?>" selected><?= $prov->provinsi; ?></option>
									<?php } ?>
								</select>
							</dd>
						</dl>

						<dl class="row">	
							<dt class="col-sm-2">Kabupaten kota</dt>
							<dd class="col-sm-2">
								<select class="form-control form-control-sm select2" id="kotakab">
									
									<?php if ($priv == 'admin') { ?>
										<option value="" selected disabled >-- Pilih Kab/Kota --</option>
									<?php } ?>

									<?php if ($priv == 'pemda') { ?>
										<option value="<?= $kab->kotakabid; ?>" selected><?= $kab->kemendagri; ?></option>
									<?php } ?>

								</select>
							</dd>
						</dl>
						<dl class="row">
							<dd class="col-sm-4 text-right">
								<button class="btn btn-success" onclick="cariX()">Sinkronkan</button>
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

			$("#idForm").LoadingOverlay("show");

			let priv = '<?= $this->session->userdata('prive') ?>',
			provid = $('#provid').val(),
			kabkotaid = $('#kotakab').val();

			if (priv == 'admin') {

				if (provid == null) {
					toastr.error('Silahkan Pilih Provinsi');
					$("#idForm").LoadingOverlay("hide");
					return;
				}

			}

			ajaxUntukSemua(base_url()+'IntegrasiEpaksi/SinkronF1', {provid, kabkotaid}, function(data) {

				$("#idForm").LoadingOverlay("hide");
				toastr.success('Selesai.!');

			}, function(error) {
				$("#idForm").LoadingOverlay("hide");
				toastr.error(error);
				console.log('Kesalahan:', error);
			});

		}


		$('#provid').change(function() {
			let provid = $(this).val();

			ajaxUntukSemua(base_url()+'DataSandingan/getDataKabKota', {provid}, function(data) {

				let opt = `<option selected value="" disabled>- Pilih Kab/Kota -</option>`;

				$.each(data, function(index, obj) {

					opt += `<option value="${obj.kotakabid}" >${obj.kemendagri}</option>`;

				});

				$('#kotakab').html(opt);


			}, function(error) {
				console.log('Kesalahan:', error);
			});

		});



		$('.select2').select2({
			theme: 'default',

		})
	})
</script>