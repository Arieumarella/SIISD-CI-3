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
							<h3 class="font-weight-bolder">REKAPITULASI DOKUMEN DATA TEKNIS IRIGASI KAB/KOTA TA. <?= $this->session->userdata('thang'); ?></h3>
						</div>
						<table class="table table-bordered mt-4">
							<thead id="thead_data">
								<tr id="boxThField" style="background-color:#18978F; color:#fff;">
									<th class="text-center" style="border: thin solid #006666;" rowspan="2">No.</th>
									<th class="text-center" style="border: thin solid #006666;" rowspan="2">PROVINSI</th>
									<th class="text-center" style="border: thin solid #006666;" colspan="12">TOTAL DOKUMEN</th>                                            
								</tr>
								<tr id="boxThField" style="background-color:#18978F; color:#fff;">   
									<th class="text-center" style="border: thin solid #006666;">RK</th>
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
								
								<?php $no=1; foreach ($dataRekap as $key => $val) { ?>
									<tr>
										<td class="text-right"><?= $no++; ?></td>
										<td><?= $val->kemendagri; ?></td>
										
										<td class="text-center">
											<?php if ($val->id_rk_pb != null) { ?>

												<?php if ($val->ekstensi_rk_pb == 'pdf') { ?>

													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_rk_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

												<?php }else{ ?>

													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_rk_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

												<?php } ?>
												<br>
												<?= $val->upload_time_rk_pb; ?>

											<?php } ?>
										</td>

										<td class="text-center">
											<?php if ($val->id_lembar_ck_pb != null) { ?>

												<?php if ($val->ekstensi_lembar_ck_pb == 'pdf') { ?>

													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_lembar_ck_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

												<?php }else{ ?>

													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_lembar_ck_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

												<?php } ?>
												<br>
												<?= $val->upload_time_lembar_ck_pb; ?>

											<?php } ?>
										</td>


										<td class="text-center">
											<?php if ($val->id_sid_pb != null) { ?>

												<?php if ($val->ekstensi_sid_pb == 'pdf') { ?>

													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_sid_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

												<?php }else{ ?>

													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_sid_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

												<?php } ?>
												<br>
												<?= $val->upload_time_sid_pb; ?>

											<?php } ?>
										</td>


										<td class="text-center">
											<?php if ($val->id_ded_pb != null) { ?>

												<?php if ($val->ekstensi_ded_pb == 'pdf') { ?>

													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_ded_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

												<?php }else{ ?>

													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_ded_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

												<?php } ?>
												<br>
												<?= $val->upload_time_ded_pb; ?>

											<?php } ?>
										</td>

										<td class="text-center">
											<?php if ($val->id_kak_pb != null) { ?>

												<?php if ($val->ekstensi_kak_pb == 'pdf') { ?>

													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_kak_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

												<?php }else{ ?>

													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_kak_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

												<?php } ?>
												<br>
												<?= $val->upload_time_kak_pb; ?>

											<?php } ?>
										</td>

										<td class="text-center">
											<?php if ($val->id_skema_jaringan_pb != null) { ?>

												<?php if ($val->ekstensi_skema_jaringan_pb == 'pdf') { ?>

													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_skema_jaringan_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

												<?php }else{ ?>

													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_skema_jaringan_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

												<?php } ?>
												<br>
												<?= $val->upload_time_skema_jaringan_pb; ?>

											<?php } ?>
										</td>


										<td class="text-center">
											<?php if ($val->id_skema_bangunan_pb != null) { ?>

												<?php if ($val->ekstensi_skema_bangunan_pb == 'pdf') { ?>

													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_skema_bangunan_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

												<?php }else{ ?>

													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_skema_bangunan_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

												<?php } ?>
												<br>
												<?= $val->upload_time_skema_bangunan_pb; ?>

											<?php } ?>
										</td>


										<td class="text-center">
											<?php if ($val->id_bc_volume_pb != null) { ?>

												<?php if ($val->ekstensi_bc_volume_pb == 'pdf') { ?>

													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_bc_volume_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

												<?php }else{ ?>

													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_bc_volume_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

												<?php } ?>
												<br>
												<?= $val->upload_time_bc_volume_pb; ?>

											<?php } ?>
										</td>

										<td class="text-center">
											<?php if ($val->id_rab_pb != null) { ?>

												<?php if ($val->ekstensi_rab_pb == 'pdf') { ?>

													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_rab_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

												<?php }else{ ?>

													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_rab_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

												<?php } ?>
												<br>
												<?= $val->upload_time_rab_pb; ?>

											<?php } ?>
										</td>


										<td class="text-center">
											<?php if ($val->id_dokumentasi_pb != null) { ?>

												<?php if ($val->ekstensi_dokumentasi_pb == 'pdf') { ?>

													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_dokumentasi_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

												<?php }else{ ?>

													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_dokumentasi_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

												<?php } ?>
												<br>
												<?= $val->upload_time_dokumentasi_pb; ?>

											<?php } ?>
										</td>


										<td class="text-center">
											<?php if ($val->id_dok_amdal_pb != null) { ?>

												<?php if ($val->ekstensi_dok_amdal_pb == 'pdf') { ?>

													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_dok_amdal_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

												<?php }else{ ?>

													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_dok_amdal_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

												<?php } ?>
												<br>
												<?= $val->upload_time_dok_amdal_pb; ?>

											<?php } ?>
										</td>
										
										<td class="text-center">
											<?php if ($val->id_kesediaan_op_pb != null) { ?>

												<?php if ($val->ekstensi_kesediaan_op_pb == 'pdf') { ?>

													<button class="btn btn-danger btn-icon" onclick="showPdf('<?= $val->path_kesediaan_op_pb; ?>')"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i></button>

												<?php }else{ ?>

													<a href="<?= base_url(); ?>DataTeknis/downloadFileById/<?= $val->id_kesediaan_op_pb; ?>" class="btn btn-dark btn-icon"><i class="fa fa-file-archive fa-lg" aria-hidden="true"></i></a>

												<?php } ?>
												<br>
												<?= $val->upload_time_kesediaan_op_pb; ?>

											<?php } ?>
										</td>										
									</tr>
									
								<?php } ?>
							</tbody>
						</table>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$( document ).ready(function() {
		
		showPdf = async function (path) {

			let cekString = path.indexOf("/var/www/html/");

			if (cekString == -1) {

				var sliceString = path.substring(11);

				var spasiJadiPersen = sliceString.replace(' ', '%20'); 
				var parent = await $('embed#idEmbed').parent();
				var newElement = await "<embed src='"+base_url()+'assets/2022/'+spasiJadiPersen+"' id='idEmbed' frameborder='0' width='100%' height='100%'>";

				await $('embed#idEmbed').remove();
				await parent.append(newElement);
				await $('#modalPdf').modal('show');

			}else{

				var sliceString = path.substring(14);

				var spasiJadiPersen = sliceString.replace(' ', '%20'); 
				var parent = await $('embed#idEmbed').parent();
				var newElement = await "<embed src='"+base_url()+spasiJadiPersen+"' id='idEmbed' frameborder='0' width='100%' height='100%'>";
				await $('embed#idEmbed').remove();
				await parent.append(newElement);
				await $('#modalPdf').modal('show');

			}


		}

	});
</script>