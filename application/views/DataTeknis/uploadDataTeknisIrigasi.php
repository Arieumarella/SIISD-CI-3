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
						<div class="row text-center" style="margin-left: 32%;">
							<h3 class="font-weight-bolder ">UPLOAD RC USULAN SIMONI <br> DAK IRIGASI TA. <?= $this->session->userdata('thang'); ?></h3>
						</div>
						<br>
						<form id="formDataTeknisIrigasi" class="form-horizontal" action="<?= base_url(); ?>DataTeknis/uplodaDataTeknisIrigasi" method="POST" enctype="multipart/form-data" >
							<?= $this->session->flashdata('psn'); ?>
						<!-- 	<div class="form-group text-center row p-2 mt-4">
								<label for="dataTeknis" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">1. File Data Teknis</label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="dataTeknis" name="dataTeknis" accept=".xlsx, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
									<label class="custom-file-label" for="dataTeknis">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status : <?= $dataForm->dataTeknis != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div> -->


							<div class="form-group text-center row p-2 mt-2">
								<label for="rk" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">1. Lembar Checklist</label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="lembar_ck_irigasi" name="lembar_ck_irigasi" accept="application/pdf">
									<label class="custom-file-label" for="lembar_ck_irigasi">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status : <?= $dataForm->lembar_ck_irigasi != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div>


							<div class="form-group text-center row p-2 mt-2">
								<label for="sid" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">2. SID</label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="sid" name="sid" accept=".rar,.zip">
									<label class="custom-file-label" for="sid">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status : <?= $dataForm->sid != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div>


							<div class="form-group text-center row p-2 mt-2">
								<label for="ded" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">3. DED</label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="ded" name="ded" accept=".rar,.zip">
									<label class="custom-file-label" for="ded">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status :  <?= $dataForm->ded != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div>


							<div class="form-group text-center row p-2 mt-2">
								<label for="kak" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">4. Kerangka Acuan Kerja</label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="kak" name="kak" accept=".rar,.zip">
									<label class="custom-file-label" for="kak">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status : <?= $dataForm->kak != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div>

							<div class="form-group text-center row p-2 mt-2">
								<label for="skema_jaringan" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">5. Skema Jaringan</label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="skema_jaringan" name="skema_jaringan" accept="application/pdf">
									<label class="custom-file-label" for="skema_jaringan">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status : <?= $dataForm->skema_jaringan != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div>

							<div class="form-group text-center row p-2 mt-2">
								<label for="skema_bangunan" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">6. Skema Bangunan</label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="skema_bangunan" name="skema_bangunan" accept="application/pdf">
									<label class="custom-file-label" for="skema_bangunan">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status : <?= $dataForm->skema_bangunan != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div>

							<div class="form-group text-center row p-2 mt-2">
								<label for="bc_volume" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">7. Backup Volume</label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="bc_volume" name="bc_volume" accept=".rar,.zip">
									<label class="custom-file-label" for="bc_volume">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status : <?= $dataForm->bc_volume != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div>

							<div class="form-group text-center row p-2 mt-2">
								<label for="rab" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">8. Rincian Anggaran Biaya</label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="rab" name="rab" accept=".rar,.zip">
									<label class="custom-file-label" for="rab">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status : <?= $dataForm->rab != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div>


							<div class="form-group text-center row p-2 mt-2">
								<label for="smk3" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">9. SMK3</label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="smk3" name="smk3" accept=".rar,.zip">
									<label class="custom-file-label" for="smk3">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status : <?= $dataForm->smk3 != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div>

							<div class="form-group text-center row p-2 mt-2">
								<label for="dpa" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">10. DPA</label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="dpa" name="dpa" accept="application/pdf">
									<label class="custom-file-label" for="dpa">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status : <?= $dataForm->dpa != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div>

							<div class="form-group text-center row p-2 mt-2">
								<label for="dokumentasi" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">11. Dokumentasi</label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="dokumentasi" name="dokumentasi" accept=".rar,.zip">
									<label class="custom-file-label" for="dokumentasi">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status : <?= $dataForm->dokumentasi != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div>

							<div class="form-group text-center row p-2 mt-2">
								<label for="kebenaran_data" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">12. Surat Pernyataan Kebenaran Data </label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="kebenaran_data" name="kebenaran_data" accept="application/pdf">
									<label class="custom-file-label" for="kebenaran_data">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status : <?= $dataForm->kebenaran_data != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div>

							<div class="form-group text-center row p-2 mt-2">
								<label for="pemenuhan_kriteria" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">13. Surat Pemenuhan Kriteria Pembangunan </label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="pemenuhan_kriteria" name="pemenuhan_kriteria" accept="application/pdf">
									<label class="custom-file-label" for="pemenuhan_kriteria">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status : <?= $dataForm->pemenuhan_kriteria != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div>

							<div class="form-group text-center row p-2 mt-2">
								<label for="penyiapan_lahan" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">14. Surat Pernyataan Penyediaan dan Penyiapan Lahan </label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="penyiapan_lahan" name="penyiapan_lahan" accept="application/pdf">
									<label class="custom-file-label" for="penyiapan_lahan">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status : <?= $dataForm->penyiapan_lahan != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div>

							<div class="form-group text-center row p-2 mt-2">
								<label for="kesanggupan_op" class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-left">15. Surat Pernyataan Kesanggupan OP Prasarana Jaringan Irigasi </label>
								<div class="col-lg-4 col-sm-12 text-left custom-file">
									<input type="file" class="custom-file-input file-sm" id="kesanggupan_op" name="kesanggupan_op" accept="application/pdf">
									<label class="custom-file-label" for="kesanggupan_op">Choose file</label>
								</div>
								<label class="col-lg-4 col-sm-12 col-form-label font-weight-bolder fontLabel text-right">Status : <?= $dataForm->kesanggupan_op != null ? 'Sudah Upload' : 'Belum Upload'; ?></label>
							</div>
							<?php if ($this->session->userdata('prive') == 'pemda' || $this->session->userdata('prive') == 'admin') { ?>
								<button type="submit" class="btn btn-primary align-self-right" style="float: right;">SIMPAN</button>
							<?php } ?>
						</form>
					</div>
					<div class="card-body">

						<p class="keterangan">*Untuk Dokumen Dengan Nomor Urut 1,5,6,10,12,13,14 dan 15 Harus Berekstensi PDF.</p>
						<p class="keterangan">*Untuk Dokumen Dengan Nomor Urut 2,3,4,7,8,9 dan 11 Harus Berekstensi ZIP/RAR.</p>
						<p class="keterangan">*Untuk Semua File Maximal File Size 100 mb.!</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">

</script>