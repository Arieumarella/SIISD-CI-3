
<section class="content">
	<div class="container-fluid">
		<br>
		<div class="row ">
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-left" style="background-color:rgba(0, 255, 0, 0);">
					<li class="breadcrumb-item"><a href="<?= base_url(); ?>Usulan/CheklistSimoni">Rekapitulasi Nasional</a></li>
					<li class="breadcrumb-item active"><?= $nm_Provinsi; ?></li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<!-- Presentase Berdasarkan Status -->
				<div class="card">
					<div class="card-body text-center">
						<h4 class="mt-4"> REKAPITULASI CHEKLIST URK DAK FISIK INFRASTRUKTUR PUPR TA. <?= $this->session->userdata('thang')+1; ?></h4>
						<h4 class="mb-2">PROVINSI <?= $nm_Provinsi; ?></h4>
						<table class="table table-bordered mt-3">

							<thead id="thead_data">

								<tr id="boxThField1" style="background-color:#18978F; color:#fff;">
									<th style="border: thin solid #006666; width: 1%" rowspan="2">No</th>
									<th style="border: thin solid #006666; width: 30%;" rowspan="2">Kab/Kota</th>
									<th style="border: thin solid #006666; width: 20%;" rowspan="2">TOTAL <br> KEGIATAN</th>
									<th style="border: thin solid #006666;" colspan="4">CHEKLIST KEGIATAN</th>
								</tr>
								<tr id="boxThField1" style="background-color:#18978F; color:#fff;">
									
									<th style="border: thin solid #006666;">PROVINSI</th>
									<th style="border: thin solid #006666;">BALAI</th>
									<th style="border: thin solid #006666;">SDA</th>
									<th style="border: thin solid #006666;">PFID</th>
								</tr>
							</thead>


							<tbody id="tbody_data">

								<?php 

								$no=1;

								?>

								<?php foreach ($dataRekap as $key => $val) { ?>
									<tr style="background-color:#F7ECDE;">
										<td style="border: thin solid #006666;" align="center"><?= $no++; ?></td>
										<td style="border: thin solid #006666; text-align: left;">    
											<a href="<?= base_url(); ?>Usulan/cheklistURKSimoni/<?= $val->kotakabid; ?>"><?= $val->kemendagri; ?></a>
										</td>
										<td  style="border: thin solid #006666;" class="number"><?= $val->jml_data; ?></td>
										<td  style="border: thin solid #006666;" class="number"><?= $val->jml_prov; ?></td>
										<td  style="border: thin solid #006666;" class="number"><?= $val->jml_balai; ?></td>
										<td  style="border: thin solid #006666;" class="number"><?= $val->jml_sda; ?></td>
										<td  style="border: thin solid #006666;" class="number"><?= $val->jml_pusat; ?></td>
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