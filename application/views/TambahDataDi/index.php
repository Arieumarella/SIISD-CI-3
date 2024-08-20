
<section class="content">
	<div class="container-fluid">
		<br>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							Pengajuan Daerah Irigasi Baru
						</h3>
					</div>

					<div class="card-body">
						<?= $this->session->flashdata('psn'); ?>
						<form action="<?= base_url(); ?>TambahDi/SimpanData" method="POST">
							<div class="row">
								<div class="form-group col-md-6 col-sm-12">
									<label for="prov">Provinsi</label>
									<select id="prov" class="form-control select2" name="prov" required>
										
										
										<?php if ($this->session->userdata('prive') == 'admin') { ?>
											<option value="" selected disabled>-- Pilih Provinsi --</option>
											<?php foreach ($prov as $key => $val) { ?>
												<option value="<?= $val->provid; ?>"><?= $val->provinsi; ?></option>
											<?php } ?>

										<?php } ?>

										<?php if ($this->session->userdata('prive') == 'pemda') { ?>

											<option value="<?= $prov->provid; ?>"><?= $prov->provinsi; ?></option>

										<?php } ?>
									</select>
								</div>

								<div class="form-group col-md-6 col-sm-12">
									<label for="kotakab">Kab/Kota</label>
									<select id="kotakab" class="form-control select2" name="kotakab" required>
										
										
										<?php if ($this->session->userdata('prive') == 'admin') { ?>

											<option value="" selected disabled>-- Pilih Kota/Kab --</option>

										<?php } ?>

										<?php if ($this->session->userdata('prive') == 'pemda') { ?>

											<option value="<?= $kotakabid->kotakabid; ?>"><?= $kotakabid->kemendagri; ?></option>

										<?php } ?>

									</select>
								</div>



								<div class="form-group col-md-6 col-sm-12">
									<label for="Di">Nama Daerah Irigasi</label>
									<input type="text" class="form-control" id="Di" name="nm_di" placeholder="Nama Daerah Irigasi" required>
								</div>
								<div class="form-group col-md-6 col-sm-12">
									<label for="kategori">Kategori Daerah Irigasi</label>
									<select id="kategori" class="form-control select2" name="Kategori" required>
										<option value="" selected disabled>-- Pilih Kategori --</option>
										<?php foreach ($kategoriDi as $key => $value) { ?>
											<option value="<?= $value->kategori; ?>"><?= $value->kategori; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group col-md-6 col-sm-12">
									<label for="luasPermen">Luas D.I Berdasarkan Permen 14/2015</label>
									<input type="text" class="form-control" id="luasPermen" name="luasPermen" placeholder="Luas D.I Berdasarkan Permen 14/2015" oninput="this.value = this.value.replace(/[^0-9,]/g, '')" required>
								</div>
								<div class="form-group col-md-6 col-sm-12">
									<label for="balai">Balai</label>
									<select id="balai" class="form-control select2" name="balai" required>
										<option value="" selected disabled>-- Pilih Balai --</option>
										<?php foreach ($dataBalai as $key => $value) { ?>
											<option value="<?= $value->balaiid; ?>"><?= $value->balai; ?></option>
										<?php } ?>
									</select>
								</div>

							</div>
							<button type="submit" class="btn btn-primary" style="float:right;">SIMPAN</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function() {

		$('#prov').change(function() {
			let provid = $(this).val();

			ajaxUntukSemua(base_url()+'TambahDi/getDataKabKota', {provid}, function(data) {

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