<style type="text/css">
	.fontLabel {
		font-size: 18px;
	}

	.keterangan {
		font-size: 12px;
		color: #bd4242;
		margin-top: -15px;
	}

	.tableX {
		font-size: 14px;
	}

	.tableX thead{
		background-color:#d6d6d6;
		color: solid gray;
	}
	.tableX th{
		padding:10px;
		margin:0px;
		text-align:center;
		vertical-align: center;
		font-size: 14px;
		border: 1px solid gray !important;
	}
	.tableX td{
		padding:4px;
		margin:0px;
		border: 1px solid gray !important;
	}
	.number, .disabled_nilai{
		text-align:right;
	}

	.tabelVerifikasi {
		width: 100%;
		font-size: 14px;
	}

	.tabelVerifikasi td{
		padding:4px;
		margin:0px;
		border: 1px solid #9eb9cd !important;
	}


	.tableKomponen {
		width: 100%;
		font-size: 13px;
	}

	.tableKomponen td{
		padding: 4px;
		margin:0px;
		border: 1px solid #9eb9cd !important;
	}
	
	tbody tr:hover{
		background-color:#E9DAC1;
	}


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
					<li class="breadcrumb-item"><a href="<?= base_url(); ?>Usulan/CheklistSimoni">Rekapitulasi Nasional</a></li>
					<li class="breadcrumb-item"><a href="<?= base_url(); ?>Usulan/rekapKabKotaSimoni/<?= $idProv; ?>"><?= $nm_prov; ?></a></li>
					<li class="breadcrumb-item active"><?= $nm_kotakab; ?></li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<!-- Presentase Berdasarkan Status -->
				<div class="card">
					<div class="card-body text-center">
						<h4 class="mt-4"> REKAPITULASI CHEKLIST URK DAK FISIK INFRASTRUKTUR PUPR TA. <?= $this->session->userdata('thang'); ?></h4>
						<h4 class="mb-2">PROVINSI <?= $nm_prov; ?></h4>
						<h4 class="mb-2"><?= $nm_kotakab; ?></h4>
						<?= $this->session->flashdata('psn'); ?>
						<form method="POST" action="<?= base_url(); ?>Usulan/SimpanCheklistKonreg">
							<input type="hidden" name="idkabkota" value="<?= $kotakabid; ?>">
							<table class=" table-bordered tableX " id="myTabelUsulan" style="width:100%;">
								<thead class="theadX">
									<!-- header utama -->
									<tr id="boxThField" >
										<th class="text-center" rowspan="2">No.</th>
										<th class="text-center" rowspan="2">DETAIL KEGIATAN</th>
										<th class="text-center" rowspan="2" style="width:17%;">KOMPONEN</th>
										<th class="text-center" colspan="2">OUTPUT KEGIATAN</th>
										<th class="text-center" rowspan="2">KEBUTUHAN <br> DANA</th>
										<th class="text-center" colspan="8">STATUS CHECKLIST</th>
									</tr>
									<tr id="boxThField">
										<th class="text-center">VOLUME</th>    
										<th class="text-center">SATUAN</th>
										<th class="text-center">PROVINSI</th>
										<th class="text-center">KOMEN <br> PROVINSI</th>
										<th class="text-center">BALAI</th>
										<th class="text-center">KOMEN <br> BALAI</th>             
										<th class="text-center">SDA</th>
										<th class="text-center">KOMEN  <br> SDA</th>
										<th class="text-center">PFID</th>
										<th class="text-center">KOMEN <br> PFID</th>
									</tr>								
								</thead>

								<?php 
								$prive = $this->session->userdata('prive');
								$is_prive = $this->session->userdata('sda');
								?>

								<tbody id="tbody_data">
									<?php if ($dataRekap != null) { ?>

										<?php $no=1; foreach ($dataRekap as $key => $val) { ?>

											<?php 

											$checklist_provinsi = ($val->verif_provinsi == '1') ? 'checked' : '';
											$checklist_balai = ($val->verif_balai == '1') ? 'checked' : '';
											$checklist_sda = ($val->verif_sda == '1') ? 'checked' : '';
											$checklist_pusat = ($val->verif_pusat == '1') ? 'checked' : '';

											?>

											<tr>
												<td class="text-right"><?= $no++; ?></td>
												<td class="text-left">

													<b><?= $val->nm_menu; ?></b>
													<br><br>
													<?php if ($val->kd_menu === '9') { ?>

														<b>WS</b>: <?= $val->nm_ws; ?>
														<br>
														<b>DAS</b> : <?= $val->nm_das; ?>	

														<br><br>

													<?php }else{ ?>
														<b><?= ($val->kategori_di == 'BARU') ? 'DI PEMBANGUNAN BARU' : $val->kategori_di; ?> - <?= $val->nm_di; ?></b>
														<br><br>
													<?php } ?>
													
													<b>Pengadaan</b> : <?= ($val->pengadaan == '1') ? 'Kontraktual' : 'Swakelola'; ?>
													<br><br>
													<b>Kecamatan</b> : <?= $val->keca; ?>
													<br>
													<b>Desa</b> : <?= $val->desa; ?>
												</td>
												<td class="text-right" style="vertical-align: top;">

													<!-- Cek Apakah Komponen ada -->
													<?php if ($val->komponen_json != null) { ?>

														<?php 
												// Konvert data komponen JSON -> Array
														$dataKomponenArray = json_decode($val->komponen_json, true);

														?>


														<table class="tableKomponen">
															<?php foreach ($dataKomponenArray as $datakomponen) { ?>
																<tr>
																	<td class="text-left" style="width:60%;"><?= $datakomponen['nm_komponen'] ?></td>
																	<td class="text-left" style="width:48%;"><?= $datakomponen['volume'] ?>  <?= $datakomponen['satuan'] ?></td>															
																</tr>
															<?php } ?>
														</table>
													<?php } ?>
												</td>
												<td class="text-right"><?= $val->output; ?></td>
												<td><?= $val->satuan_output; ?></td>
												<td class="text-right">Rp. <?= number_format($val->pagu_kegiatan,0,',','.'); ?></td>
												<td class="text-center">
													<input id='provinsi<?= $val->id; ?>' type="checkbox" name="cheklist_provinsi_<?= $val->id; ?>" class="option-input checkbox" <?= $checklist_provinsi; ?> <?= ($is_prive != 'disabled') ? 'disabled' : ''; ?>>
													<input type="hidden" name="id[<?= $val->id; ?>]">
													
												</td>
												<td class="text-center">
													<textarea class="form-control" rows="3" name="catat_provinsi[<?= $val->id; ?>]"
														<?= ($is_prive != 'provinsi') ? 'readonly' : ''; ?>><?= $val->catat_provinsi; ?></textarea>
													</td>
													<td class="text-center">
														<input id='balai<?= $val->id; ?>' type="checkbox" name="cheklist_balai_<?= $val->id; ?>" class="option-input checkbox" <?= $checklist_balai; ?> <?= ($prive != 'balai') ? 'disabled' : ''; ?>>
													</td>
													<td class="text-center">
														<textarea class="form-control" rows="3" name="catat_balai[<?= $val->id; ?>]"
															<?= ($prive != 'balai') ? 'readonly' : ''; ?>><?= $val->catat_balai; ?></textarea>
														</td>
														<td class="text-center">
															<input id='sda<?= $val->id; ?>' type="checkbox" name="cheklist_sda_<?= $val->id; ?>" class="option-input checkbox" <?= $checklist_sda; ?> <?= ($is_prive != 'sda') ? 'disabled' : ''; ?>>
														</td>
														<td class="text-center">
															<textarea class="form-control" rows="3" name="catat_sda[<?= $val->id; ?>]"
																<?= ($is_prive != 'sda') ? 'readonly' : ''; ?>><?= $val->catat_sda; ?></textarea>
															</td>
															<td class="text-center">
																<input id='pfid<?= $val->id; ?>' type="checkbox" class="option-input checkbox" name="cheklist_pfid_<?= $val->id; ?>" <?= $checklist_pusat; ?> <?= ($prive != 'admin') ? 'disabled' : ''; ?>>
															</td>
															<td class="text-center">
																<textarea class="form-control" rows="3" name="catat_pfid[<?= $val->id; ?>]" 
																	<?= ($prive != 'admin') ? 'readonly' : ''; ?>><?= $val->catat_pusat; ?></textarea>
																</td>
															</tr>


														<?php } ?>

													<?php }else{ ?>
														<tr>
															<td class="text-center" colspan="10"><b>DATA KOSONG.</b></td>
														</tr>
													<?php } ?>
												</tbody>
											</table>
											<?php if ($prive == 'admin' || $prive == 'balai' || $is_prive == 'sda' || $is_prive == 'provinsi') { ?>
												<button class="btn btn-primary m-2" type="submit" style="float:right;">SIMPAN</button>
											<?php } ?>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>