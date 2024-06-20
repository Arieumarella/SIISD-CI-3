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
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="text-center">
							<h3 class="font-weight-bolder">REKAPITULASI DOKUMEN PENGENDALI BANJIR PROVINSI TA. <?= $this->session->userdata('thang'); ?></h3>
						</div>
						<br>
						<div>
							<select class="form-control form-control-sm col-2" id="selectRekap" style="margin-bottom:-15px;">
								<option value="1">Data Teknis Irigasi</option>
								<option value="2" selected>Data Teknis Pengendali banjir</option>
							</select>
						</div>
						<table class="table table-bordered mt-4">
							<thead id="thead_data">
								<!-- header utama -->
								<tr id="boxThField" style="background-color:#18978F; color:#fff;">
									<th class="text-center" style="border: thin solid #006666;" rowspan="2">No.</th>
									<th class="text-center" style="border: thin solid #006666;" rowspan="2">PROVINSI</th>
									<th class="text-center" style="border: thin solid #006666;" colspan="12">TOTAL DOKUMEN</th>
								</tr>
								<tr id="boxThField" style="background-color:#18978F; color:#fff;">
									<th class="text-center" style="border: thin solid #006666;">LEMBAR<br>CHECKLIST</th>
									<th class="text-center" style="border: thin solid #006666;">SID</th>
									<th class="text-center" style="border: thin solid #006666;">DED</th>
									<th class="text-center" style="border: thin solid #006666;">KAK</th>
									<th class="text-center" style="border: thin solid #006666;">SKEMA <br> JARINGAN</th>
									<th class="text-center" style="border: thin solid #006666;">SKEMA <br> BANGUNAN</th>
									<th class="text-center" style="border: thin solid #006666;">BC <br> VOLUME</th>
									<th class="text-center" style="border: thin solid #006666;">RAB</th>
									<th class="text-center" style="border: thin solid #006666;">DOKUMENTASI</th>
									<th class="text-center" style="border: thin solid #006666;">AMDAL</th>
									<th class="text-center" style="border: thin solid #006666;">SURAT <br> KESEDIAAN OP</th>
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
								foreach ($dataRekap as $key => $val) { ?>
									<tr>
										<td class="text-right"><?= $no++; ?></td>
										<td>
											<?php if ($this->session->userdata('prive') == 'pemda') { ?>
												<?php if ($val->provid == $this->session->userdata('provid')) { ?>
													<a href="<?= base_url(); ?>Usulan/rekapPengendaliBanjirKabKota/<?= $val->provid; ?>"><?= $val->provinsi; ?></a>
												<?php } else { ?>
													<?= $val->provinsi; ?>
												<?php } ?>
											<?php } else { ?>
												<?php if ($this->session->userdata('prive') == 'balai') { ?>
													<?php if (in_array($val->provid, $dataBalai)) { ?>
														<a href="<?= base_url(); ?>Usulan/rekapPengendaliBanjirKabKota/<?= $val->provid; ?>"><?= $val->provinsi; ?></a>
													<?php } else {
														echo $val->provinsi;
													} ?>
												<?php } else { ?>
													<a href="<?= base_url(); ?>Usulan/rekapPengendaliBanjirKabKota/<?= $val->provid; ?>"><?= $val->provinsi; ?></a>
												<?php } ?>
											<?php } ?>
										</td>
										<td class="text-right"><?= $val->lembar_ck_pb; ?></td>
										<td class="text-right"><?= $val->sid_pb; ?></td>
										<td class="text-right"><?= $val->ded_pb; ?></td>
										<td class="text-right"><?= $val->kak_pb; ?></td>
										<td class="text-right"><?= $val->skema_jaringan_pb; ?></td>
										<td class="text-right"><?= $val->skema_bangunan_pb; ?></td>
										<td class="text-right"><?= $val->bc_volume_pb; ?></td>
										<td class="text-right"><?= $val->rab_pb; ?></td>
										<td class="text-right"><?= $val->dokumentasi_pb; ?></td>
										<td class="text-right"><?= $val->dok_amdal_pb; ?></td>
										<td class="text-right"><?= $val->kesediaan_op_pb; ?></td>
									</tr>
									<?php

									$lembar_ck_irigasi += (int)$val->lembar_ck_pb;
									$sid += (int)$val->sid_pb;
									$ded += (int)$val->ded_pb;
									$kak += (int)$val->kak_pb;
									$skema_jaringan += (int)$val->skema_jaringan_pb;
									$skema_bangunan += (int)$val->skema_bangunan_pb;
									$bc_volume += (int)$val->bc_volume_pb;
									$rab += (int)$val->rab_pb;
									$smk3 += (int)$val->dokumentasi_pb;
									$dpa += (int)$val->dok_amdal_pb;
									$dokumentasi += (int)$val->kesediaan_op_pb;

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

			if (val == 1) {
				window.location.href = base_url() + "Usulan/rekapIrigasiProvinsi";
			}

		});
	});
</script>