<style type="text/css">
	.fontLabel {
		font-size: 18px;
	}
</style>
<section class="content">
	<div class="container-fluid">
		<br>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body align-self-center">
						<?= $this->session->flashdata('psn'); ?>
						<div class="row">
							<h3 class="font-weight-bolder">DOWNLOAD LEMBAR CHECKLIST TA. <?= $this->session->userdata('thang'); ?></h3>
						</div>
						<div class="form-group text-center row p-2 mt-4">
							<label class="col-sm-8 col-form-label font-weight-normal fontLabel text-left">1. Checklist Irigasi</label>
							<div class="col-sm-2 text-center">
								<a href="<?= base_url(); ?>DataTeknis/downloadFile/1" class="btn btn-info" style="width: 90px;"><i class="fas fa-file-download"></i> Unduh</a>
							</div>
						</div>
						<div class="form-group  row p-2">
							<label class="col-sm-8 col-form-label font-weight-normal fontLabel text-left">2. Checklist Pengendali Banjir</label>
							<div class="col-sm-2 text-center">
								<a href="<?= base_url(); ?>DataTeknis/downloadFile/2" class="btn btn-info" style="width: 90px;"><i class="fas fa-file-download"></i> Unduh</a>
							</div>
						</div>
						<div class="form-group  row p-2">
							<label class="col-sm-8 col-form-label font-weight-normal fontLabel text-left">3. Format Surat</label>
							<div class="col-sm-2 text-center">
								<a href="<?= base_url(); ?>DataTeknis/downloadFile/3" class="btn btn-info" style="width: 90px;"><i class="fas fa-file-download"></i> Unduh</a>
							</div>
						</div>
						<?php if ($this->session->userdata('prive') == 'admin') { ?>
							<div class="form-group  row p-2">
								<label class="col-sm-8 col-form-label font-weight-normal fontLabel text-left">4. Rekapitulasi Usulan</label>
								<div class="col-sm-2 text-center">
									<a href="<?= base_url(); ?>DataTeknis/downloadTabel" class="btn btn-info" style="width: 90px;"><i class="fas fa-file-download"></i> Unduh</a>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function() {


	})
</script>