<section class="content">
	<div class="container-fluid">
		<br>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							Riwayat Penanganan
						</h3>
					</div>

					<div class="card-body">

						<?php
						$startingYear = $this->session->userdata('thang');
						$numOfYears = 6;

						$yearArray = range($startingYear - $numOfYears + 1, $startingYear);

						print_r($yearArray);
						?>

						<table class="table table-bordered">
							<thead>
								<tr>
									<th rowspan="3">No</th>
									<th rowspan="3">Nama Pemerintah Daerah</th>
									<th rowspan="3">DI</th>
									<th rowspan="3">Luas (Ha)</th>
									<th colspan="20">Outcome Riwayat Penanganan DAK (Ha)</th>
									<th rowspan="3">Keterangan</th>
								</tr>
								<tr>
									<?php foreach ($yearArray as $ta) { ?>
										<th colspan="3"><?= $ta; ?></th>
									<?php } ?>
								</tr>
								<tr>
									<th>PB</th>
									<th>PK</th>
									<th>R</th>
									<th>PB</th>
									<th>PK</th>
									<th>R</th>
									<th>PB</th>
									<th>PK</th>
									<th>R</th>
									<th>PB</th>
									<th>PK</th>
									<th>R</th>
									<th>PB</th>
									<th>PK</th>
									<th>R</th>
									<th>PB</th>
									<th>PK</th>
									<th>R</th>
									
								</tr>
							</thead>
							<tbody id="boxTbody">

							</tbody>
						</table>

					</div>

				</div>

			</div>
		</div>
	</div>
</section>