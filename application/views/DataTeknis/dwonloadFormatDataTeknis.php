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
						<!-- <div class="form-group text-center row p-2 mt-4">
							<label class="col-sm-8 col-form-label font-weight-normal fontLabel text-left">1. Checklist Irigasi</label>
							<div class="col-sm-2 text-left">
								<a href="<?= base_url(); ?>DataTeknis/downloadFile/1" class="btn btn-info" style="width: 90px;"><i class="fas fa-file-download"></i> Unduh</a>
							</div>
						</div> -->
						<div class="form-group  row p-2 mt-5">
							<label class="col-sm-8 col-form-label font-weight-normal fontLabel text-left">1. Checklist Pengendali Banjir</label>
							<div class="col-sm-2 text-left">
								<a href="<?= base_url(); ?>DataTeknis/downloadFile/2" class="btn btn-info" style="width: 90px;"><i class="fas fa-file-download"></i> Unduh</a>
							</div>
						</div>
						<div class="form-group  row p-2">
							<label class="col-sm-8 col-form-label font-weight-normal fontLabel text-left">2. Format Surat</label>
							<div class="col-sm-2 text-left">
								<a href="<?= base_url(); ?>DataTeknis/downloadFile/3" class="btn btn-info" style="width: 90px;"><i class="fas fa-file-download"></i> Unduh</a>
							</div>
						</div>
						<div class="form-group  row p-2">
							<label class="col-sm-8 col-form-label font-weight-normal fontLabel text-left">3. Format Surat Pernyataan Petani</label>
							<div class="col-sm-2 text-left">
								<a href="<?= base_url(); ?>DataTeknis/downloadFile/4" class="btn btn-info" style="width: 90px;"><i class="fas fa-file-download"></i> Unduh</a>
							</div>
						</div>
						<?php if ($this->session->userdata('prive') == 'admin') { ?>
							<div class="form-group  row p-2">
								<label class="col-sm-8 col-form-label font-weight-normal fontLabel text-left">4. Rekapitulasi Usulan</label>
								<div class="col-sm-2 text-left">
									<a href="<?= base_url(); ?>DataTeknis/downloadTabel" class="btn btn-info" style="width: 90px;"><i class="fas fa-file-download"></i> Unduh</a>
								</div>
							</div>
						<?php } ?>
						<br><br>
						<?php if ($this->session->userdata('prive') == 'admin') { ?>
							<div class="row">
								<h3 class="font-weight-bolder">REKAPITULASI PENILAIAN URK TA. <?= $this->session->userdata('thang'); ?></h3>
							</div>
							<?php
							$totalPagu = 0;
							foreach ($dataKegiatan as $key => $val) {
								if (is_numeric($val->pagu_kegiatan)) {
									$totalPagu += $val->pagu_kegiatan;
								}
							}
							?>
							<?php
							$totalApprove = 0;

							foreach ($dataKegiatan as $key => $val) {
								// Tentukan nilai yang akan digunakan, periksa apakah catat_verifikator2 valid
								if (is_numeric($val->catat_verifikator2) && !empty($val->catat_verifikator2)) {
									$nilai = $val->catat_verifikator2;
								} else {
									$nilai = $val->pagu_kegiatan;
								}

								// Tambahkan nilai ke totalApprove hanya jika verif_pusat3 == 1
								if ($val->verif_pusat3 == 1) {
									$totalApprove += $nilai;
								}
							}
							?>

							<?php
							$selisih = $totalPagu - $totalApprove;
							?>
							<div class="row mt-3 text-center">
								<label class="col-sm-8 col-form-label font-weight-normal fontLabel text-left" style="color: darkcyan; font-size:20px">
									Usulan Approve saat ini = Rp<?= number_format($totalApprove, 0, ',', '.'); ?>
								</label>
								<label class="col-sm-8 col-form-label font-weight-normal fontLabel text-left" style="color: darkcyan; font-size:20px">
									Usulan Reject/Selisih = Rp<?= number_format($selisih, 0, ',', '.'); ?>
								</label>
								<label class="col-sm-8 col-form-label font-weight-normal fontLabel text-left" style="color: darkcyan; font-size:20px">
									Total Usulan = Rp<?= number_format($totalPagu, 0, ',', '.'); ?>
								</label>
							</div>
							<br><br>
						<?php } ?>
						<br><br><br><br><br>


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