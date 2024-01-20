
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
						<h4 class="mt-4 mb-2"> REKAPITULASI VERIFIKASI DATA TEKNIS TA. <?= $this->session->userdata('thang'); ?> </h4>

						<table class="table table-bordered mt-3">

							<thead id="thead_data">

								<tr id="boxThField1" style="background-color:#18978F; color:#fff;">
									<th style="border: thin solid #006666; width: 1px;">No</th>
									<th style="border: thin solid #006666; width: 4px;">Provinsi</th>
									<th style="border: thin solid #006666; width: 20px;" >Pemda <br> Verifikasi</th>
									<th style="border: thin solid #006666; width: 20px;" >Provinsi <br> Verifikasi</th>
									<th style="border: thin solid #006666; width: 20px;" >Balai <br> Verifikasi</th>
									<th style="border: thin solid #006666; width: 20px;" >Pusat <br> Verifikasi</th>
								</tr>
							</thead>


							<tbody id="tbody_data">

								<?php 

								$no=1;

								?>

								<?php foreach ($dataProv as $key => $val) { ?>
									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center"><?= $no++; ?></td>
										<td style="border: thin solid #006666; text-align: left;"><a href="<?= base_url(); ?>VerifDataTeknis/pemdaVerif/<?= $val->provid; ?>"><?= $val->provinsi; ?></a></td>
										<td  style="border: thin solid #006666;" class="number"><?= $val->totPemdaVerif; ?></td>
										<td  style="border: thin solid #006666;" class="number"><?= $val->totProvinsiVerif; ?></td>
										<td  style="border: thin solid #006666;" class="number"><?= $val->totBalaiVerif; ?></td>
										<td  style="border: thin solid #006666;" class="number"><?= $val->totPusatVerif; ?></td>
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