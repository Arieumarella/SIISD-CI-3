<?php 

$priv = $this->session->userdata('prive');

?>

<section class="content">
	<div class="container-fluid">
		<br>
		<div class="row ">
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-left" style="background-color:rgba(0, 255, 0, 0);">
					<li class="breadcrumb-item"><a href="<?= base_url(); ?>VerifDataTeknis">Rekapitulasi Nasional</a></li>
					<li class="breadcrumb-item"><a href="<?= base_url(); ?>VerifDataTeknis/pemdaVerif/<?= $provid; ?>"><?= $nmProv->provinsi; ?></a></li>
					<li class="breadcrumb-item active"><?= $nmKabkota->kemendagri; ?></li>
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
						<h4 class="mb-2"> <?= $nmKabkota->kemendagri; ?> </h4>

						<form action="<?= base_url(); ?>VerifDataTeknis/prsSimpan" method="POST">
							<input type="hidden" name="kotakabid" value="<?= $dataTabel->kotakabid; ?>">


							<?= $this->session->flashdata('psn'); ?>

							<table class="table table-bordered mt-3">

								<thead id="thead_data" class="sticky-top">

									<tr id="boxThField1" style="background-color:#18978F; color:#fff;">
										<th style="border: thin solid #006666; width: 1px;">NO</th>
										<th style="border: thin solid #006666; width: 4px;">JENIS DATA</th>
										<th style="border: thin solid #006666; width: 20px;" >STATUS TANGGAL</th>
										<th style="border: thin solid #006666; width: 18%;" >STATUS <br> VERIFIKASI</th>
										<th style="border: thin solid #006666; width: 20px;" >CATATAN <br> VERIFIKASI</th>
									</tr>
								</thead>


								<tbody id="tbody_data" class="">

									<tr style="background-color: #d6d6d6;">
										<td style="border: thin solid #006666;" colspan="5" class="text-left"><b>PRASARANA FISIK</b></td>
									</tr>

									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center">1</td>
										<td style="border: thin solid #006666; text-align: left;">1A - Aset D.I.</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<a href="<?= base_url(); ?>FormTeknis/downloadTabel/<?= $dataTabel->kotakabid; ?>" class="btn btn-sm btn-success">1A - Aset D.I.</a>
											<br>
											<?= $dataTabel->tgl_1a; ?>
										</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<?php if ($priv == 'admin') { ?>
												<select class="form-control form-control-sm" name="sts_1a" aria-label=".form-select-sm example" style="">
													<option value="" selected disabled>-- Pilih Status --</option>
													<option value="1" <?= $dataTabel->sts_1a == '1' ? 'selected' : ''; ?>>Sesuai</option>
													<option value="2" <?= $dataTabel->sts_1a == '2' ? 'selected' : ''; ?>>Tidak Sesuai</option>
												</select>
											<?php }else{ 

												if ($dataTabel->sts_1a == '1') {
													echo 'Sesuai';
												}elseif ($dataTabel->sts_1a == '2') {
													echo 'Tidak Sesuai';
												}else{
													echo 'Belum Diverifikasi';
												}

											} ?>
										</td>
										<td  style="border: thin solid #006666;" align="center"><textarea class="form-control" data-bs-toggle="autosize" placeholder="" name="catat_1a" <?= $priv != 'admin' ? 'disabled':''; ?>><?= $dataTabel->catat_1a; ?></textarea></td>
									</tr>
									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center">2</td>
										<td style="border: thin solid #006666; text-align: left;">1B - Aset D.I.R</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<a href="<?= base_url(); ?>FormTeknis1B/downloadTabel/<?= $dataTabel->kotakabid; ?>" class="btn btn-sm btn-success">1B - Aset D.I.R</a>
											<br>
											<?= $dataTabel->tgl_1b; ?>
										</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<?php if ($priv == 'admin') { ?>
												<select class="form-control form-control-sm" name="sts_1b" aria-label=".form-select-sm example" style="">
													<option value="" selected disabled>-- Pilih Status --</option>
													<option value="1" <?= $dataTabel->sts_1b == '1' ? 'selected' : ''; ?> >Sesuai</option>
													<option value="2" <?= $dataTabel->sts_1b == '2' ? 'selected' : ''; ?> >Tidak Sesuai</option>
												</select>
											<?php }else{ 

												if ($dataTabel->sts_1b == '1') {
													echo 'Sesuai';
												}elseif ($dataTabel->sts_1b == '2') {
													echo 'Tidak Sesuai';
												}else{
													echo 'Belum Diverifikasi';
												}

											} ?>
										</td>
										<td  style="border: thin solid #006666;" align="center"><textarea class="form-control" data-bs-toggle="autosize" placeholder="" name="catat_1b" <?= $priv != 'admin' ? 'disabled':''; ?>><?= $dataTabel->catat_1b; ?></textarea></td>
									</tr>
									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center">3</td>
										<td style="border: thin solid #006666; text-align: left;">1C - Aset D.I.A.T</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<a href="<?= base_url(); ?>FormTeknis1C/downloadTabel/<?= $dataTabel->kotakabid; ?>" class="btn btn-sm btn-success">1C - Aset D.I.A.T</a>
											<br>
											<?= $dataTabel->tgl_1c; ?>
										</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<?php if ($priv == 'admin') { ?>
												<select class="form-control form-control-sm" name="sts_1c" aria-label=".form-select-sm example" style="">
													<option value="" selected disabled>-- Pilih Status --</option>
													<option value="1" <?= $dataTabel->sts_1c == '1' ? 'selected' : ''; ?> >Sesuai</option>
													<option value="2" <?= $dataTabel->sts_1c == '2' ? 'selected' : ''; ?> >Tidak Sesuai</option>
												</select>
											<?php }else{ 

												if ($dataTabel->sts_1c == '1') {
													echo 'Sesuai';
												}elseif ($dataTabel->sts_1c == '2') {
													echo 'Tidak Sesuai';
												}else{
													echo 'Belum Diverifikasi';
												}

											} ?>
										</td>
										<td  style="border: thin solid #006666;" align="center"><textarea class="form-control" data-bs-toggle="autosize" placeholder="" name="catat_1c" <?= $priv != 'admin' ? 'disabled':''; ?>><?= $dataTabel->catat_1c; ?></textarea></td>
									</tr>
									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center">4</td>
										<td style="border: thin solid #006666; text-align: left;">1D - Aset D.I.T</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<a href="<?= base_url(); ?>FormTeknis1D/downloadTabel/<?= $dataTabel->kotakabid; ?>" class="btn btn-sm btn-success">1D - Aset D.I.T</a>
											<br>
											<?= $dataTabel->tgl_1d; ?>
										</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<?php if ($priv == 'admin') { ?>
												<select class="form-control form-control-sm" name="sts_1d" aria-label=".form-select-sm example" style="">
													<option value="" selected disabled>-- Pilih Status --</option>
													<option value="1" <?= $dataTabel->sts_1d == '1' ? 'selected' : ''; ?> >Sesuai</option>
													<option value="2" <?= $dataTabel->sts_1d == '2' ? 'selected' : ''; ?> >Tidak Sesuai</option>
												</select>
											<?php }else{ 

												if ($dataTabel->sts_1d == '1') {
													echo 'Sesuai';
												}elseif ($dataTabel->sts_1d == '2') {
													echo 'Tidak Sesuai';
												}else{
													echo 'Belum Diverifikasi';
												}

											} ?>
										</td>
										<td  style="border: thin solid #006666;" align="center"><textarea class="form-control" data-bs-toggle="autosize" placeholder="" name="catat_1d" <?= $priv != 'admin' ? 'disabled':''; ?>><?= $dataTabel->catat_1d; ?></textarea></td>
									</tr>
									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center">5</td>
										<td style="border: thin solid #006666; text-align: left;">1E - Aset D.I.P</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<a href="<?= base_url(); ?>FormTeknis1E/downloadTabel/<?= $dataTabel->kotakabid; ?>" class="btn btn-sm btn-success">1E - Aset D.I.P</a>
											<br>
											<?= $dataTabel->tgl_1e; ?>
										</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<?php if ($priv == 'admin') { ?>
												<select class="form-control form-control-sm" name="sts_1e" aria-label=".form-select-sm example" style="">
													<option value="" selected disabled>-- Pilih Status --</option>
													<option value="1" <?= $dataTabel->sts_1e == '1' ? 'selected' : ''; ?> >Sesuai</option>
													<option value="2" <?= $dataTabel->sts_1e == '2' ? 'selected' : ''; ?> >Tidak Sesuai</option>
												</select>
											<?php }else{ 

												if ($dataTabel->sts_1e == '1') {
													echo 'Sesuai';
												}elseif ($dataTabel->sts_1e == '2') {
													echo 'Tidak Sesuai';
												}else{
													echo 'Belum Diverifikasi';
												}

											} ?>
										</td>
										<td  style="border: thin solid #006666;" align="center"><textarea class="form-control" data-bs-toggle="autosize" placeholder="" name="catat_1e" <?= $priv != 'admin' ? 'disabled':''; ?>><?= $dataTabel->catat_1e; ?></textarea></td>
									</tr>
									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center">6</td>
										<td style="border: thin solid #006666; text-align: left;">1F - Progres PAI</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<a href="<?= base_url(); ?>FormTeknis1F/downloadTabel/<?= $dataTabel->kotakabid; ?>" class="btn btn-sm btn-success">1F - Progres PAI</a>
											<br>
											<?= $dataTabel->tgl_1f; ?>
										</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<?php if ($priv == 'admin') { ?>
												<select class="form-control form-control-sm" name="sts_1f" aria-label=".form-select-sm example" style="">
													<option value="" selected disabled>-- Pilih Status --</option>
													<option value="1" <?= $dataTabel->sts_1f == '1' ? 'selected' : ''; ?> >Sesuai</option>
													<option value="2" <?= $dataTabel->sts_1f == '2' ? 'selected' : ''; ?> >Tidak Sesuai</option>
												</select>
											<?php }else{ 

												if ($dataTabel->sts_1f == '1') {
													echo 'Sesuai';
												}elseif ($dataTabel->sts_1f == '2') {
													echo 'Tidak Sesuai';
												}else{
													echo 'Belum Diverifikasi';
												}

											} ?>
										</td>
										<td  style="border: thin solid #006666;" align="center"><textarea class="form-control" data-bs-toggle="autosize" placeholder="" name="catat_1f" <?= $priv != 'admin' ? 'disabled':''; ?>><?= $dataTabel->catat_1f; ?></textarea></td>
									</tr>


									<tr style="background-color: #d6d6d6;">
										<td style="border: thin solid #006666;" colspan="5" class="text-left"><b>REASLISASI TANAM</b></td>
									</tr>


									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center">1</td>
										<td style="border: thin solid #006666; text-align: left;">2A - RTI D.I</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<a href="<?= base_url(); ?>RealisasiTanam2A/downloadTabel/<?= $dataTabel->kotakabid; ?>" class="btn btn-sm btn-success">2A - RTI D.I</a>
											<br>
											<?= $dataTabel->tgl_2a; ?>
										</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<?php if ($priv == 'admin') { ?>
												<select class="form-control form-control-sm" name="sts_2a" aria-label=".form-select-sm example" style="">
													<option value="" selected disabled>-- Pilih Status --</option>
													<option value="1" <?= $dataTabel->sts_2a == '1' ? 'selected' : ''; ?> >Sesuai</option>
													<option value="2" <?= $dataTabel->sts_2a == '2' ? 'selected' : ''; ?> >Tidak Sesuai</option>
												</select>
											<?php }else{ 

												if ($dataTabel->sts_2a == '1') {
													echo 'Sesuai';
												}elseif ($dataTabel->sts_2a == '2') {
													echo 'Tidak Sesuai';
												}else{
													echo 'Belum Diverifikasi';
												}

											} ?>
										</td>
										<td  style="border: thin solid #006666;" align="center"><textarea class="form-control" data-bs-toggle="autosize" placeholder="" name="catat_2a" <?= $priv != 'admin' ? 'disabled':''; ?>><?= $dataTabel->catat_2a; ?></textarea></td>
									</tr>
									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center">2</td>
										<td style="border: thin solid #006666; text-align: left;">2B - RTI D.I.R</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<a href="<?= base_url(); ?>RealisasiTanam2B/downloadTabel/<?= $dataTabel->kotakabid; ?>" class="btn btn-sm btn-success">2B - RTI D.I.R</a>
											<br>
											<?= $dataTabel->tgl_2b; ?>
										</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<?php if ($priv == 'admin') { ?>
												<select class="form-control form-control-sm" name="sts_2b" aria-label=".form-select-sm example" style="">
													<option value="" selected disabled>-- Pilih Status --</option>
													<option value="1" <?= $dataTabel->sts_2b == '1' ? 'selected' : ''; ?> >Sesuai</option>
													<option value="2" <?= $dataTabel->sts_2b == '2' ? 'selected' : ''; ?> >Tidak Sesuai</option>
												</select>
											<?php }else{ 

												if ($dataTabel->sts_2b == '1') {
													echo 'Sesuai';
												}elseif ($dataTabel->sts_2b == '2') {
													echo 'Tidak Sesuai';
												}else{
													echo 'Belum Diverifikasi';
												}

											} ?>
										</td>
										<td  style="border: thin solid #006666;" align="center"><textarea class="form-control" data-bs-toggle="autosize" placeholder="" name="catat_2b" <?= $priv != 'admin' ? 'disabled':''; ?>><?= $dataTabel->catat_2b; ?></textarea></td>
									</tr>
									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center">3</td>
										<td style="border: thin solid #006666; text-align: left;">2C - Aset D.I.A.T</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<a href="<?= base_url(); ?>RealisasiTanam2C/downloadTabel/<?= $dataTabel->kotakabid; ?>" class="btn btn-sm btn-success">2C - Aset D.I.A.T</a>
											<br>
											<?= $dataTabel->tgl_2c; ?>
										</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<?php if ($priv == 'admin') { ?>
												<select class="form-control form-control-sm" name="sts_2c" aria-label=".form-select-sm example" style="">
													<option value="" selected disabled>-- Pilih Status --</option>
													<option value="1" <?= $dataTabel->sts_2c == '1' ? 'selected' : ''; ?> >Sesuai</option>
													<option value="2" <?= $dataTabel->sts_2c == '2' ? 'selected' : ''; ?> >Tidak Sesuai</option>
												</select>
											<?php }else{ 

												if ($dataTabel->sts_2c == '1') {
													echo 'Sesuai';
												}elseif ($dataTabel->sts_2c == '2') {
													echo 'Tidak Sesuai';
												}else{
													echo 'Belum Diverifikasi';
												}

											} ?>
										</td>
										<td  style="border: thin solid #006666;" align="center"><textarea class="form-control" data-bs-toggle="autosize" placeholder="" name="catat_2c" <?= $priv != 'admin' ? 'disabled':''; ?>><?= $dataTabel->catat_2c; ?></textarea></td>
									</tr>

									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center">4</td>
										<td style="border: thin solid #006666; text-align: left;">2D - Aset D.I.T</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<a href="<?= base_url(); ?>RealisasiTanam2D/downloadTabel/<?= $dataTabel->kotakabid; ?>" class="btn btn-sm btn-success">2D - Aset D.I.T</a>
											<br>
											<?= $dataTabel->tgl_2d; ?>
										</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<?php if ($priv == 'admin') { ?>
												<select class="form-control form-control-sm" name="sts_2d" aria-label=".form-select-sm example" style="">
													<option value="" selected disabled>-- Pilih Status --</option>
													<option value="1" <?= $dataTabel->sts_2d == '1' ? 'selected' : ''; ?> >Sesuai</option>
													<option value="2" <?= $dataTabel->sts_2d == '2' ? 'selected' : ''; ?> >Tidak Sesuai</option>
												</select>
											<?php }else{ 

												if ($dataTabel->sts_2d == '1') {
													echo 'Sesuai';
												}elseif ($dataTabel->sts_2d == '2') {
													echo 'Tidak Sesuai';
												}else{
													echo 'Belum Diverifikasi';
												}

											} ?>
										</td>
										<td  style="border: thin solid #006666;" align="center"><textarea class="form-control" data-bs-toggle="autosize" placeholder="" name="catat_2d" <?= $priv != 'admin' ? 'disabled':''; ?>><?= $dataTabel->catat_2d; ?></textarea></td>
									</tr>

									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center">5</td>
										<td style="border: thin solid #006666; text-align: left;">2E - Aset D.I.P</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<a href="<?= base_url(); ?>RealisasiTanam2E/downloadTabel/<?= $dataTabel->kotakabid; ?>" class="btn btn-sm btn-success">2E - Aset D.I.P</a>
											<br>
											<?= $dataTabel->tgl_2e; ?>
										</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<?php if ($priv == 'admin') { ?>
												<select class="form-control form-control-sm" name="sts_2e" aria-label=".form-select-sm example" style="">
													<option value="" selected disabled>-- Pilih Status --</option>
													<option value="1" <?= $dataTabel->sts_2e == '1' ? 'selected' : ''; ?> >Sesuai</option>
													<option value="2" <?= $dataTabel->sts_2e == '2' ? 'selected' : ''; ?> >Tidak Sesuai</option>
												</select>
											<?php }else{ 

												if ($dataTabel->sts_2e == '1') {
													echo 'Sesuai';
												}elseif ($dataTabel->sts_2e == '2') {
													echo 'Tidak Sesuai';
												}else{
													echo 'Belum Diverifikasi';
												}

											} ?>
										</td>
										<td  style="border: thin solid #006666;" align="center"><textarea class="form-control" data-bs-toggle="autosize" placeholder="" name="catat_2e" <?= $priv != 'admin' ? 'disabled':''; ?>><?= $dataTabel->catat_2e; ?></textarea></td>
									</tr>


									<tr style="background-color: #d6d6d6;">
										<td style="border: thin solid #006666;" colspan="5" class="text-left"><b>SDM OP</b></td>
									</tr>

									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center">1</td>
										<td style="border: thin solid #006666; text-align: left;">3A - SDM OP</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<a href="<?= base_url(); ?>SdmOp3A/downloadTabel/<?= $dataTabel->kotakabid; ?>" class="btn btn-sm btn-success">3A - SDM OP</a>
											<br>
											<?= $dataTabel->tgl_3a; ?>
										</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<?php if ($priv == 'admin') { ?>
												<select class="form-control form-control-sm" name="sts_3a" aria-label=".form-select-sm example" style="">
													<option value="" selected disabled>-- Pilih Status --</option>
													<option value="1" <?= $dataTabel->sts_3a == '1' ? 'selected' : ''; ?> >Sesuai</option>
													<option value="2" <?= $dataTabel->sts_3a == '2' ? 'selected' : ''; ?> >Tidak Sesuai</option>
												</select>
											<?php }else{ 

												if ($dataTabel->sts_3a == '1') {
													echo 'Sesuai';
												}elseif ($dataTabel->sts_3a == '2') {
													echo 'Tidak Sesuai';
												}else{
													echo 'Belum Diverifikasi';
												}

											} ?>
										</td>
										<td  style="border: thin solid #006666;" align="center"><textarea class="form-control" data-bs-toggle="autosize" placeholder="" name="catat_3a" <?= $priv != 'admin' ? 'disabled':''; ?>><?= $dataTabel->catat_3a; ?></textarea></td>
									</tr>

									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center">2</td>
										<td style="border: thin solid #006666; text-align: left;">3B - PENUNJANG OP</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<a href="<?= base_url(); ?>SdmOp3B/downloadTabel/<?= $dataTabel->kotakabid; ?>" class="btn btn-sm btn-success">3B - PENUNJANG OP</a>
											<br>
											<?= $dataTabel->tgl_3b; ?>
										</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<?php if ($priv == 'admin') { ?>
												<select class="form-control form-control-sm" name="sts_3b" aria-label=".form-select-sm example" style="">
													<option value="" selected disabled>-- Pilih Status --</option>
													<option value="1" <?= $dataTabel->sts_3b == '1' ? 'selected' : ''; ?> >Sesuai</option>
													<option value="2" <?= $dataTabel->sts_3b == '2' ? 'selected' : ''; ?> >Tidak Sesuai</option>
												</select>
											<?php }else{ 

												if ($dataTabel->sts_3b == '1') {
													echo 'Sesuai';
												}elseif ($dataTabel->sts_3b == '2') {
													echo 'Tidak Sesuai';
												}else{
													echo 'Belum Diverifikasi';
												}

											} ?>
										</td>
										<td  style="border: thin solid #006666;" align="center"><textarea class="form-control" data-bs-toggle="autosize" placeholder="" name="catat_3b" <?= $priv != 'admin' ? 'disabled':''; ?>><?= $dataTabel->catat_3b; ?></textarea></td>
									</tr>

									<tr style="background-color: #d6d6d6;">
										<td style="border: thin solid #006666;" colspan="5" class="text-left"><b>INDEKS KINERJA</b></td>
									</tr>

									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center">1</td>
										<td style="border: thin solid #006666; text-align: left;">4A - DATA KONDISI D.I</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<a href="<?= base_url(); ?>IndexKinerja4A/downloadTabel/<?= $dataTabel->kotakabid; ?>" class="btn btn-sm btn-success">4A - DATA KONDISI D.I</a>
											<br>
											<?= $dataTabel->tgl_4a; ?>
										</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<?php if ($priv == 'admin') { ?>
												<select class="form-control form-control-sm" name="sts_4a" aria-label=".form-select-sm example" style="">
													<option value="" selected disabled>-- Pilih Status --</option>
													<option value="1" <?= $dataTabel->sts_4a == '1' ? 'selected' : ''; ?> >Sesuai</option>
													<option value="2" <?= $dataTabel->sts_4a == '2' ? 'selected' : ''; ?> >Tidak Sesuai</option>
												</select>
											<?php }else{ 

												if ($dataTabel->sts_4a == '1') {
													echo 'Sesuai';
												}elseif ($dataTabel->sts_4a == '2') {
													echo 'Tidak Sesuai';
												}else{
													echo 'Belum Diverifikasi';
												}

											} ?>
										</td>
										<td  style="border: thin solid #006666;" align="center"><textarea class="form-control" data-bs-toggle="autosize" placeholder="" name="catat_4a" <?= $priv != 'admin' ? 'disabled':''; ?>><?= $dataTabel->catat_4a; ?></textarea></td>
									</tr>

									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center">2</td>
										<td style="border: thin solid #006666; text-align: left;">4B - DATA KONDISI D.I.R</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<a href="<?= base_url(); ?>IndexKinerja4B/downloadTabel/<?= $dataTabel->kotakabid; ?>" class="btn btn-sm btn-success">4B - DATA KONDISI D.I.R</a>
											<br>
											<?= $dataTabel->tgl_4b; ?>
										</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<?php if ($priv == 'admin') { ?>
												<select class="form-control form-control-sm" name="sts_4b" aria-label=".form-select-sm example" style="">
													<option value="" selected disabled>-- Pilih Status --</option>
													<option value="1" <?= $dataTabel->sts_4b == '1' ? 'selected' : ''; ?> >Sesuai</option>
													<option value="2" <?= $dataTabel->sts_4b == '2' ? 'selected' : ''; ?> >Tidak Sesuai</option>
												</select>
											<?php }else{ 

												if ($dataTabel->sts_4b == '1') {
													echo 'Sesuai';
												}elseif ($dataTabel->sts_4b == '2') {
													echo 'Tidak Sesuai';
												}else{
													echo 'Belum Diverifikasi';
												}

											} ?>
										</td>
										<td  style="border: thin solid #006666;" align="center"><textarea class="form-control" data-bs-toggle="autosize" placeholder="" name="catat_4b" <?= $priv != 'admin' ? 'disabled':''; ?>><?= $dataTabel->catat_4b; ?></textarea></td>
									</tr>

									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center">3</td>
										<td style="border: thin solid #006666; text-align: left;">4C - DATA KONDISI D.I.A.T</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<a href="<?= base_url(); ?>IndexKinerja4C/downloadTabel/<?= $dataTabel->kotakabid; ?>" class="btn btn-sm btn-success">4C - DATA KONDISI D.I.A.T</a>
											<br>
											<?= $dataTabel->tgl_4c; ?>
										</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<?php if ($priv == 'admin') { ?>
												<select class="form-control form-control-sm" name="sts_4c" aria-label=".form-select-sm example" style="">
													<option value="" selected disabled>-- Pilih Status --</option>
													<option value="1" <?= $dataTabel->sts_4c == '1' ? 'selected' : ''; ?> >Sesuai</option>
													<option value="2" <?= $dataTabel->sts_4c == '2' ? 'selected' : ''; ?> >Tidak Sesuai</option>
												</select>
											<?php }else{ 

												if ($dataTabel->sts_4c == '1') {
													echo 'Sesuai';
												}elseif ($dataTabel->sts_4c == '2') {
													echo 'Tidak Sesuai';
												}else{
													echo 'Belum Diverifikasi';
												}

											} ?>
										</td>
										<td  style="border: thin solid #006666;" align="center"><textarea class="form-control" data-bs-toggle="autosize" placeholder="" name="catat_4c" <?= $priv != 'admin' ? 'disabled':''; ?>><?= $dataTabel->catat_4c; ?></textarea></td>
									</tr>

									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center">4</td>
										<td style="border: thin solid #006666; text-align: left;">4D - DATA KONDISI D.I.T</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<a href="<?= base_url(); ?>IndexKinerja4D/downloadTabel/<?= $dataTabel->kotakabid; ?>" class="btn btn-sm btn-success">4D - DATA KONDISI D.I.T</a>
											<br>
											<?= $dataTabel->tgl_4d; ?>
										</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<?php if ($priv == 'admin') { ?>
												<select class="form-control form-control-sm" name="sts_4d" aria-label=".form-select-sm example" style="">
													<option value="" selected disabled>-- Pilih Status --</option>
													<option value="1" <?= $dataTabel->sts_4d == '1' ? 'selected' : ''; ?> >Sesuai</option>
													<option value="2" <?= $dataTabel->sts_4d == '2' ? 'selected' : ''; ?>  >Tidak Sesuai</option>
												</select>
											<?php }else{ 

												if ($dataTabel->sts_4d == '1') {
													echo 'Sesuai';
												}elseif ($dataTabel->sts_4d == '2') {
													echo 'Tidak Sesuai';
												}else{
													echo 'Belum Diverifikasi';
												}

											} ?>
										</td>
										<td  style="border: thin solid #006666;" align="center"><textarea class="form-control" data-bs-toggle="autosize" placeholder="" name="catat_4d" <?= $priv != 'admin' ? 'disabled':''; ?>><?= $dataTabel->catat_4d; ?></textarea></td>
									</tr>

									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center">5</td>
										<td style="border: thin solid #006666; text-align: left;">4E - DATA KONDISI D.I.P</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<a href="<?= base_url(); ?>IndexKinerja4E/downloadTabel/<?= $dataTabel->kotakabid; ?>" class="btn btn-sm btn-success">4E - DATA KONDISI D.I.P</a>
											<br>
											<?= $dataTabel->tgl_4e; ?>
										</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<?php if ($priv == 'admin') { ?>
												<select class="form-control form-control-sm" name="sts_4e" aria-label=".form-select-sm example" style="">
													<option value="" selected disabled>-- Pilih Status --</option>
													<option value="1" <?= $dataTabel->sts_4e == '1' ? 'selected' : ''; ?> >Sesuai</option>
													<option value="2" <?= $dataTabel->sts_4e == '2' ? 'selected' : ''; ?>  >Tidak Sesuai</option>
												</select>
											<?php }else{ 

												if ($dataTabel->sts_4e == '1') {
													echo 'Sesuai';
												}elseif ($dataTabel->sts_4e == '2') {
													echo 'Tidak Sesuai';
												}else{
													echo 'Belum Diverifikasi';
												}

											} ?>
										</td>
										<td  style="border: thin solid #006666;" align="center"><textarea class="form-control" data-bs-toggle="autosize" placeholder="" name="catat_4e" <?= $priv != 'admin' ? 'disabled':''; ?>><?= $dataTabel->catat_4e; ?></textarea></td>
									</tr>


									<tr style="background-color: #d6d6d6;">
										<td style="border: thin solid #006666;" colspan="5" class="text-left"><b>SHARING APBD</b></td>
									</tr>


									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center">1</td>
										<td style="border: thin solid #006666; text-align: left;">5 - SHARING APBD</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<a href="#" class="btn btn-sm btn-success">5 - SHARING APBD</a>
											<br>
											<?= $dataTabel->tgl_5; ?>
										</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<?php if ($priv == 'admin') { ?>
												<select class="form-control form-control-sm" name="sts_5" aria-label=".form-select-sm example" style="">
													<option value="" selected disabled>-- Pilih Status --</option>
													<option value="1" <?= $dataTabel->sts_5 == '1' ? 'selected' : ''; ?> >Sesuai</option>
													<option value="2" <?= $dataTabel->sts_5 == '2' ? 'selected' : ''; ?> >Tidak Sesuai</option>
												</select>
											<?php }else{ 

												if ($dataTabel->sts_5 == '1') {
													echo 'Sesuai';
												}elseif ($dataTabel->sts_5 == '2') {
													echo 'Tidak Sesuai';
												}else{
													echo 'Belum Diverifikasi';
												}

											} ?>
										</td>
										<td  style="border: thin solid #006666;" align="center"><textarea class="form-control" data-bs-toggle="autosize" placeholder="" name="catat_5" <?= $priv != 'admin' ? 'disabled':''; ?>><?= $dataTabel->catat_5; ?></textarea></td>
									</tr>


									<tr style="background-color: #d6d6d6;">
										<td style="border: thin solid #006666;" colspan="5" class="text-left"><b>KELEMBAGAAN</b></td>
									</tr>


									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center">1</td>
										<td style="border: thin solid #006666; text-align: left;">6 - KELEMBAGAAN</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<a href="#" class="btn btn-sm btn-success">6 - KELEMBAGAAN</a>
											<br>
											<?= $dataTabel->tgl_6; ?>
										</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<?php if ($priv == 'admin') { ?>
												<select class="form-control form-control-sm" name="sts_6" aria-label=".form-select-sm example" style="">
													<option value="" selected disabled>-- Pilih Status --</option>
													<option value="1" <?= $dataTabel->sts_6 == '1' ? 'selected' : ''; ?> >Sesuai</option>
													<option value="2" <?= $dataTabel->sts_6 == '2' ? 'selected' : ''; ?> >Tidak Sesuai</option>
												</select>
											<?php }else{ 

												if ($dataTabel->sts_6 == '1') {
													echo 'Sesuai';
												}elseif ($dataTabel->sts_6 == '2') {
													echo 'Tidak Sesuai';
												}else{
													echo 'Belum Diverifikasi';
												}

											} ?>
										</td>
										<td  style="border: thin solid #006666;" align="center"><textarea class="form-control" data-bs-toggle="autosize" placeholder="" name="catat_6" <?= $priv != 'admin' ? 'disabled':''; ?>><?= $dataTabel->catat_6; ?></textarea></td>
									</tr>


									<tr style="background-color: #d6d6d6;">
										<td style="border: thin solid #006666;" colspan="5" class="text-left"><b>P3A,GP3A,IP3A</b></td>
									</tr>


									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center">1</td>
										<td style="border: thin solid #006666; text-align: left;">7 - P3A,GP3A,IP3A</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<a href="<?= base_url(); ?>Form7/downloadTabel/<?= $dataTabel->kotakabid; ?>" class="btn btn-sm btn-success">7 - P3A,GP3A,IP3A</a>
											<br>
											<?= $dataTabel->tgl_7; ?>
										</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<?php if ($priv == 'admin') { ?>
												<select class="form-control form-control-sm" name="sts_7" aria-label=".form-select-sm example" style="">
													<option value="" selected disabled>-- Pilih Status --</option>
													<option value="1" <?= $dataTabel->sts_7 == '1' ? 'selected' : ''; ?> >Sesuai</option>
													<option value="2" <?= $dataTabel->sts_7 == '2' ? 'selected' : ''; ?> >Tidak Sesuai</option>
												</select>
											<?php }else{ 

												if ($dataTabel->sts_7 == '1') {
													echo 'Sesuai';
												}elseif ($dataTabel->sts_7 == '2') {
													echo 'Tidak Sesuai';
												}else{
													echo 'Belum Diverifikasi';
												}

											} ?>
										</td>
										<td  style="border: thin solid #006666;" align="center"><textarea class="form-control" data-bs-toggle="autosize" placeholder="" name="catat_7" <?= $priv != 'admin' ? 'disabled':''; ?>><?= $dataTabel->catat_7; ?></textarea></td>
									</tr>


									<tr style="background-color: #d6d6d6;">
										<td style="border: thin solid #006666;" colspan="5" class="text-left"><b>e-PAKSI</b></td>
									</tr>

									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center">1</td>
										<td style="border: thin solid #006666; text-align: left;">8 - e-PAKSI</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<a href="<?= base_url(); ?>EPAKSI/downloadTabel/<?= $dataTabel->kotakabid; ?>" class="btn btn-sm btn-success">8 - e-PAKSI</a>
											<br>
											<?= $dataTabel->tgl_8; ?>
										</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<?php if ($priv == 'admin') { ?>
												<select class="form-control form-control-sm" name="sts_8" aria-label=".form-select-sm example" style="">
													<option value="" selected disabled>-- Pilih Status --</option>
													<option value="1" <?= $dataTabel->sts_8 == '1' ? 'selected' : ''; ?> >Sesuai</option>
													<option value="2" <?= $dataTabel->sts_8 == '2' ? 'selected' : ''; ?> >Tidak Sesuai</option>
												</select>
											<?php }else{ 

												if ($dataTabel->sts_8 == '1') {
													echo 'Sesuai';
												}elseif ($dataTabel->sts_8 == '2') {
													echo 'Tidak Sesuai';
												}else{
													echo 'Belum Diverifikasi';
												}

											} ?>
										</td>
										<td  style="border: thin solid #006666;" align="center"><textarea class="form-control" data-bs-toggle="autosize" placeholder="" name="catat_8" <?= $priv != 'admin' ? 'disabled':''; ?>><?= $dataTabel->catat_8; ?></textarea></td>
									</tr>

									<tr style="background-color: #d6d6d6;">
										<td style="border: thin solid #006666;" colspan="5" class="text-left"><b>AREAL TERDAMPAK DAN IKSI</b></td>
									</tr>


									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center">1</td>
										<td style="border: thin solid #006666; text-align: left;">9 - AREAL TERDAMPAK DAN IKSI</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<a href="<?= base_url(); ?>Form9/downloadTabel/<?= $dataTabel->kotakabid; ?>" class="btn btn-sm btn-success">9 - AREAL TERDAMPAK DAN IKSI</a>
											<br>
											<?= $dataTabel->tgl_9; ?>
										</td>
										<td  style="border: thin solid #006666;" align="center" class="align-middle">
											<?php if ($priv == 'admin') { ?>
												<select class="form-control form-control-sm" name="sts_9" aria-label=".form-select-sm example" style="">
													<option value="" selected disabled>-- Pilih Status --</option>
													<option value="1" <?= $dataTabel->sts_9 == '1' ? 'selected' : ''; ?> >Sesuai</option>
													<option value="2" <?= $dataTabel->sts_9 == '2' ? 'selected' : ''; ?> >Tidak Sesuai</option>
												</select>
											<?php }else{ 

												if ($dataTabel->sts_9 == '1') {
													echo 'Sesuai';
												}elseif ($dataTabel->sts_9 == '2') {
													echo 'Tidak Sesuai';
												}else{
													echo 'Belum Diverifikasi';
												}

											} ?>
										</td>
										<td  style="border: thin solid #006666;" align="center"><textarea class="form-control" data-bs-toggle="autosize" placeholder="" name="catat_9" <?= $priv != 'admin' ? 'disabled':''; ?>><?= $dataTabel->catat_9; ?></textarea></td>
									</tr>

								</tbody>
							</table>

							<?php if ($priv == 'admin') { ?>
								<button type="submit" class="btn btn-primary text-left" style="float:right;">SIMPAN</button>
							<?php } ?>

						</form>

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