<style type="text/css">
	.fontLabel {
		font-size: 18px;
	}

	.keterangan {
		font-size: 18px;
		color: #bd4242;
		margin-top: -15px;
	}

	.table {
		font-size: 12px;
	}

	.table thead {
		background-color: #18978F;
		color: #fff;
	}

	.table th {
		padding: 4px;
		margin: 0px;
		text-align: center;
		vertical-align: center;
	}

	.table td {
		padding: 4px;
		margin: 0px;
	}

	.number,
	.disabled_nilai {
		text-align: right;
	}

	.tr_0 {
		background-color: #FFF;
	}

	.tr_1 {
		background-color: #F7ECDE;
	}

	tbody tr:hover {
		background-color: #E9DAC1;
	}
</style>
<section class="content">
	<div class="container-fluid">
		<br>
		<div class="row ">
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-left" style="background-color:rgba(0, 255, 0, 0);">
					<li class="breadcrumb-item active">Rekapitulasi Nasional</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<!-- Presentase Berdasarkan Status -->
				<div class="card">
					<div class="card-body text-center">
						<h4 class="mt-4 mb-2"> REKAPITULASI DOKUMEN URK SIMONI DAK FISIK INFRASTRUKTUR PUPR TA. <?= $this->session->userdata('thang'); ?>
						</h4>
						<br>
						<div>
							<select class="form-control form-control-sm col-3" id="selectRekap" style="margin-bottom:-15px;">
								<option value="1" selected>Data Teknis Irigasi</option>
								<option value="2">Data Teknis Pengendali banjir</option>
							</select>
						</div>
						<br>

						<table class="table-bordered tableX mt-3">

							<thead id="thead_data">

								<tr id="boxThField1" style="background-color:#18978F; color:#fff;">
									<th style="border: thin solid #006666; width: 5%" rowspan="2">No</th>
									<th style="border: thin solid #006666; width: 25%;" rowspan="2">PROVINSI</th>
									<!-- <th style="border: thin solid #006666; width: 20%;" rowspan="2">TOTAL <br> KEGIATAN</th> -->
									<th style="border: thin solid #006666;" colspan="15">DOKUMEN</th>
								</tr>
								<tr id="boxThField1" style="background-color:#18978F; color:#fff;">
									<th style="border: thin solid #006666;" style="text-align: center;">LEMBAR CHECKLIST</th>
									<th style="border: thin solid #006666;">SID</th>
									<th style="border: thin solid #006666;">DED</th>
									<th style="border: thin solid #006666;">KAK</th>
									<th style="border: thin solid #006666;">SKEMA JARINGAN</th>
									<th style="border: thin solid #006666;">SKEMA BANGUNAN</th>
									<th style="border: thin solid #006666;">BC VOLUME</th>
									<th style="border: thin solid #006666;">RAB</th>
									<th style="border: thin solid #006666;">SMK3</th>
									<th style="border: thin solid #006666;">DPA</th>
									<th style="border: thin solid #006666;">DOKUMENTASI</th>
									<th style="border: thin solid #006666;">SURAT KEBENARAN DATA</th>
									<th style="border: thin solid #006666;">SURAT KRITERIA PEMBANGUNAN</th>
									<th style="border: thin solid #006666;">SURAT PENYIAPAN LAHAN</th>
									<th style="border: thin solid #006666;" align="center">SURAT KESANGGUPAN OP</th>
								</tr>
							</thead>
							<tbody id="tbody_data">
								<?php

								$provinsi = 0;
								$lembar_ck_irigasi = 0;
								$sid = 0;
								$ded = 0;
								$kak = 0;
								$skema_jaringan = 0;
								$skema_bangunan = 0;
								$bc_volume = 0;
								$rab = 0;
								$smk3 = 0;
								$dpa = 0;
								$dokumentasi = 0;
								$kebenaran_data = 0;
								$pemenuhan_kriteria = 0;
								$penyiapan_lahan = 0;
								$kesanggupan_op = 0;

								?>
								<?php $no = 1;
								foreach ($dataKegiatan as $key => $val) { ?>
									<tr style="background-color: #F7ECDE;">
										<td class="text-center" style="border: thin solid #006666;"><?= $no++; ?></td>
										<!-- <td class="text-left"><a href="<?= base_url(); ?>Usulan/rekapKabKotaSimoni/<?= $val->provid; ?>"><?= $val->provinsi; ?></a>
										</td> -->
										<td class="text-left" style="border: thin solid #006666;">
											<?php if ($this->session->userdata('prive') == 'pemda') { ?>
												<?php if ($val->provid == $this->session->userdata('provid')) { ?>
													<a href="<?= base_url(); ?>Usulan/rekapKabKotaSimoni/<?= $val->provid; ?>"><?= $val->provinsi; ?></a>
												<?php } else { ?>
													<?= $val->provinsi; ?>
												<?php } ?>
											<?php } else { ?>
												<?php if ($this->session->userdata('prive') == 'balai') { ?>
													<?php if (in_array($val->provid, $dataBalai)) { ?>
														<a href="<?= base_url(); ?>Usulan/rekapKabKotaSimoni/<?= $val->provid; ?>"><?= $val->provinsi; ?></a>
													<?php } else {
														echo $val->provinsi;
													} ?>

												<?php } else { ?>
													<a href="<?= base_url(); ?>Usulan/rekapKabKotaSimoni/<?= $val->provid; ?>"><?= $val->provinsi; ?></a>
												<?php } ?>
											<?php } ?>

										</td>

										<td class="text-right" style="border: thin solid #006666;"><?= $val->lembar_ck_irigasi; ?></td>
										<td class="text-right" style="border: thin solid #006666;"><?= $val->sid; ?></td>
										<td class="text-right" style="border: thin solid #006666;"><?= $val->ded; ?></td>
										<td class="text-right" style="border: thin solid #006666;"><?= $val->kak; ?></td>
										<td class="text-right" style="border: thin solid #006666;"><?= $val->skema_jaringan; ?></td>
										<td class="text-right" style="border: thin solid #006666;"><?= $val->skema_bangunan; ?></td>
										<td class="text-right" style="border: thin solid #006666;"><?= $val->bc_volume; ?></td>
										<td class="text-right" style="border: thin solid #006666;"><?= $val->rab; ?></td>
										<td class="text-right" style="border: thin solid #006666;"><?= $val->smk3; ?></td>
										<td class="text-right" style="border: thin solid #006666;"><?= $val->dpa; ?></td>
										<td class="text-right" style="border: thin solid #006666;"><?= $val->dokumentasi; ?></td>
										<td class="text-right" style="border: thin solid #006666;"><?= $val->kebenaran_data; ?></td>
										<td class="text-right" style="border: thin solid #006666;"><?= $val->pemenuhan_kriteria; ?></td>
										<td class="text-right" style="border: thin solid #006666;"><?= $val->penyiapan_lahan; ?></td>
										<td class="text-right" style="border: thin solid #006666;"><?= $val->kesanggupan_op; ?></td>
									</tr>
									<?php
									$lembar_ck_irigasi += (int)$val->lembar_ck_irigasi;
									$sid += (int)$val->sid;
									$ded += (int)$val->ded;
									$kak += (int)$val->kak;
									$skema_jaringan += (int)$val->skema_jaringan;
									$skema_bangunan += (int)$val->skema_bangunan;
									$bc_volume += (int)$val->bc_volume;
									$rab += (int)$val->rab;
									$smk3 += (int)$val->smk3;
									$dpa += (int)$val->dpa;
									$dokumentasi += (int)$val->dokumentasi;
									$kebenaran_data += (int)$val->kebenaran_data;
									$pemenuhan_kriteria += (int)$val->pemenuhan_kriteria;
									$penyiapan_lahan += (int)$val->penyiapan_lahan;
									$kesanggupan_op += (int)$val->kesanggupan_op;

									?>
								<?php } ?>
							</tbody>
							<tfoot>
								<tr style="background-color:#d9dee2;">
									<th class="text-center" colspan="2"><b>TOTAL</b></th>
									<th class="text-right"><b><?= $lembar_ck_irigasi; ?></b></th>
									<th class="text-right"><b><?= $sid; ?></b></th>
									<th class="text-right"><b><?= $ded; ?></b></th>
									<th class="text-right"><b><?= $kak; ?></b></th>
									<th class="text-right"><b><?= $skema_jaringan; ?></b></th>
									<th class="text-right"><b><?= $skema_bangunan; ?></b></th>
									<th class="text-right"><b><?= $bc_volume; ?></b></th>
									<th class="text-right"><b><?= $rab; ?></b></th>
									<th class="text-right"><b><?= $smk3; ?></b></th>
									<th class="text-right"><b><?= $dpa; ?></b></th>
									<th class="text-right"><b><?= $dokumentasi; ?></b></th>
									<th class="text-right"><b><?= $kebenaran_data; ?></b></th>
									<th class="text-right"><b><?= $pemenuhan_kriteria; ?></b></th>
									<th class="text-right"><b><?= $penyiapan_lahan; ?></b></th>
									<th class="text-right"><b><?= $kesanggupan_op; ?></b></th>
								</tr>
							</tfoot>



						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function() {
		$('#selectRekap').on('change', function() {
			let val = this.value;

			if (val == 2) {
				window.location.href = base_url() + "Usulan/CheklistSimoniPengendaliBanjir";
			}

		});
	});
</script>