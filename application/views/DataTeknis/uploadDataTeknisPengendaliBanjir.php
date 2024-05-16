<style type="text/css">
	.fontLabel {
		font-size: 18px;
	}

	.keterangan {
		font-size: 18px;
		color: #bd4242;
		margin-top: -15px;
	}

</style>

<section class="content">
	<div class="container-fluid">
		<br>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body align-self-center">
						<div class="row text-center col-12" style="margin-left: 25%;">
							<h3 class="font-weight-bolder ">UPLOAD RC USULAN SIMONI <br> PENGENDALI BANJIR TA. <?= $this->session->userdata('thang'); ?></h3>
						</div><br>
						<form id="formDataTeknisIrigasi" class="form-horizontal" action="<?= base_url(); ?>DataTeknis/uplodaDataTeknisPengendaliBanjir" method="POST" enctype="multipart/form-data" >
							<?= $this->session->flashdata('psn'); ?>
							
						<!-- 	<div class="form-group text-center row p-2 mt-2">
								<label for="rk_pb" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">1. RK (Sudah ttd B/BWS dan Dinas Prov)</label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="rk_pb" name="rk_pb" accept="application/pdf">
									<label class="custom-file-label" for="rk_pb">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status : <?= $dataForm->rk_pb != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div> -->


							<div class="form-group text-center row p-2 mt-4">
								<label for="lembar_ck_pb" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">1. Lembar Checklist</label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="lembar_ck_pb" name="lembar_ck_pb" accept="application/pdf">
									<label class="custom-file-label" for="lembar_ck_pb">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status : <?= $dataForm->lembar_ck_pb != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div>


							<div class="form-group text-center row p-2 mt-2">
								<label for="sid_pb" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">2. SID</label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="sid_pb" name="sid_pb" accept=".rar,.zip">
									<label class="custom-file-label" for="sid_pb">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status : <?= $dataForm->sid_pb != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div>


							<div class="form-group text-center row p-2 mt-2">
								<label for="ded_pb" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">3. DED</label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="ded_pb" name="ded_pb" accept=".rar,.zip">
									<label class="custom-file-label" for="ded_pb">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status :  <?= $dataForm->ded_pb != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div>


							<div class="form-group text-center row p-2 mt-2">
								<label for="kak_pb" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">4. Kerangka Acuan Kerja</label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="kak_pb" name="kak_pb" accept=".rar,.zip">
									<label class="custom-file-label" for="kak_pb">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status : <?= $dataForm->kak_pb != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div>

							<div class="form-group text-center row p-2 mt-2">
								<label for="skema_jaringan_pb" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">5. Skema Jaringan</label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="skema_jaringan_pb" name="skema_jaringan_pb" accept="application/pdf">
									<label class="custom-file-label" for="skema_jaringan_pb">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status : <?= $dataForm->skema_jaringan_pb != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div>

							<div class="form-group text-center row p-2 mt-2">
								<label for="skema_bangunan_pb" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">6. Skema Bangunan</label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="skema_bangunan_pb" name="skema_bangunan_pb" accept="application/pdf">
									<label class="custom-file-label" for="skema_bangunan_pb">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status : <?= $dataForm->skema_bangunan_pb != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div>

							<div class="form-group text-center row p-2 mt-2">
								<label for="bc_volume_pb" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">7. Backup Volume</label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="bc_volume_pb" name="bc_volume_pb" accept=".rar,.zip">
									<label class="custom-file-label" for="bc_volume_pb">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status : <?= $dataForm->bc_volume_pb != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div>

							<div class="form-group text-center row p-2 mt-2">
								<label for="rab_pb" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">8. Rincian Anggaran Biaya</label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="rab_pb" name="rab_pb" accept=".rar,.zip">
									<label class="custom-file-label" for="rab_pb">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status : <?= $dataForm->rab_pb != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div>

							<div class="form-group text-center row p-2 mt-2">
								<label for="dokumentasi_pb" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">9. Dokumentasi</label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="dokumentasi_pb" name="dokumentasi_pb" accept=".rar,.zip">
									<label class="custom-file-label" for="dokumentasi_pb">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status : <?= $dataForm->dokumentasi_pb != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div>

							<div class="form-group text-center row p-2 mt-2">
								<label for="dok_amdal_pb" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">10. Dokumen Amdal</label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="dok_amdal_pb" name="dok_amdal_pb" accept="application/pdf">
									<label class="custom-file-label" for="dok_amdal_pb">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status : <?= $dataForm->dok_amdal_pb != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div>

							<div class="form-group text-center row p-2 mt-2">
								<label for="kesediaan_op_pb" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">11. Surat Kesediaan OP </label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="kesediaan_op_pb" name="kesediaan_op_pb" accept="application/pdf">
									<label class="custom-file-label" for="kesediaan_op_pb">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status : <?= $dataForm->kesediaan_op_pb != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div>
							
							<!-- <?php if ($this->session->userdata('prive') == 'pemda') { ?> -->

							<!-- <?php } ?> -->

							<button type="submit" class="btn btn-primary align-self-right" style="float: right;">SIMPAN</button>
						</form>
					</div>
					<div class="card-body">
						<p class="keterangan">*Untuk Dokumen Dengan Nomor Urut 1,5,6,10, dan 11 Harus Berekstensi PDF.</p>
						<p class="keterangan">*Untuk Dokumen Dengan Nomor Urut 2,3,4,7,8, dan 9 Harus Berekstensi ZIP/RAR.</p>
						<p class="keterangan">*Untuk Semua File Maximal File Size 100 mb.!</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">

</script>