<section class="content">
	<div class="container-fluid">
		<br>
		<div class="row">
			<div class="col-md-12">
				<!-- Presentase Berdasarkan Status -->
				<div class="card">
					<div class="card-body text-center">
						<h3> Selamat Datang </h3>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="card">
				<div class="card-body text-center d-flex">
					<div class="col-md-6">
						<div class="card mb-3">
							<div class="card-body text-center">
								<img src="<?= base_url(); ?>assets/admin/images/bagan.jpg" style="width: 50%; height:auto;">
							</div>
						</div>
						<div class="card">
							<div class="card-body text-center">
								<canvas id="pie"></canvas>
							</div>
						</div>
					</div>
					<div class="col-md-6 d-flex align-items-center">
						<div class="card w-100">
							<div class="card-body text-center">
								<canvas id="BarLine"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<br>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body text-center">
						<canvas id="myChart"></canvas>
					</div>
				</div>
			</div>
		</div>

		<script>
			// Grafik Pertama
			const labels1 = [
				'ACEH', 'BALI', 'BANTEN', 'BENGKULU', 'DI YOGYAKARTA', 'GORONTALO', 'JAMBI', 'JAWA BARAT', 'JAWA TENGAH', 'JAWA TIMUR',
				'KALIMANTAN BARAT', 'KALIMANTAN SELATAN', 'KALIMANTAN TENGAH', 'KALIMANTAN TIMUR', 'KALIMANTAN UTARA', 'KEPULAUAN BANGKA BELITUNG',
				'LAMPUNG', 'MALUKU', 'MALUKU UTARA', 'NUSA TENGARA BARAT', 'NUSA TENGGARA TIMUR', 'PAPUA', 'PAPUA BARAT', 'PAPUA BARAT DAYA',
				'PAPUA PEGUNUNGAN', 'PAPUA SELATAN', 'PAPUA TENGAH', 'RIAU', 'SULAWESI BARAT', 'SULAWESI SELATAN', 'SULAWESI TENGAH',
				'SULAWESI TENGGARA', 'SULAWESI UTARA', 'SUMATERA BARAT', 'SUMATERA SELATAN', 'SUMATERA UTARA'
			];

			const data1 = {
				labels: labels1,
				datasets: [{
					label: 'TREN CAPAIAN IMMEDIATE OUTCOME DAK BIDANG IRIGASI TA 2023',
					data: [47, 105, 66, 90, 100, 56, 101, 77, 85, 95, 78, 94, 78, 94, 100, 96, 99, 71, 50, 107, 78, 0, 0, 50, 57, 120, 74, 163, 96, 89, 59, 68, 100, 88, 49, 97],
					backgroundColor: [
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 159, 64, 0.2)',
						'rgba(255, 205, 86, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(153, 102, 255, 0.2)',
						'rgba(201, 203, 207, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 159, 64, 0.2)',
						'rgba(255, 205, 86, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 159, 64, 0.2)',
						'rgba(255, 205, 86, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(153, 102, 255, 0.2)',
						'rgba(201, 203, 207, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 159, 64, 0.2)',
						'rgba(255, 205, 86, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 159, 64, 0.2)',
						'rgba(255, 205, 86, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(153, 102, 255, 0.2)',
						'rgba(201, 203, 207, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 159, 64, 0.2)',
						'rgba(255, 205, 86, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(153, 102, 255, 0.2)',
						'rgba(201, 203, 207, 0.2)',
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 159, 64, 0.2)',
					],
					borderColor: [
						'rgb(255, 99, 132)',
						'rgb(255, 159, 64)',
						'rgb(255, 205, 86)',
						'rgb(75, 192, 192)',
						'rgb(54, 162, 235)',
						'rgb(153, 102, 255)',
						'rgb(201, 203, 207)',
						'rgb(255, 99, 132)',
						'rgb(255, 159, 64)',
						'rgb(255, 205, 86)',
						'rgb(255, 99, 132)',
						'rgb(255, 159, 64)',
						'rgb(255, 205, 86)',
						'rgb(75, 192, 192)',
						'rgb(54, 162, 235)',
						'rgb(153, 102, 255)',
						'rgb(201, 203, 207)',
						'rgb(255, 99, 132)',
						'rgb(255, 159, 64)',
						'rgb(255, 205, 86)',
						'rgb(255, 99, 132)',
						'rgb(255, 159, 64)',
						'rgb(255, 205, 86)',
						'rgb(75, 192, 192)',
						'rgb(54, 162, 235)',
						'rgb(153, 102, 255)',
						'rgb(201, 203, 207)',
						'rgb(255, 99, 132)',
						'rgb(255, 159, 64)',
						'rgb(255, 205, 86)',
						'rgb(75, 192, 192)',
						'rgb(54, 162, 235)',
						'rgb(153, 102, 255)',
						'rgb(201, 203, 207)',
						'rgb(255, 99, 132)',
						'rgb(255, 159, 64)',
					],
					borderWidth: 1
				}]
			};

			const config1 = {
				type: 'bar',
				data: data1,
				options: {
					scales: {
						y: {
							beginAtZero: true
						}
					}
				}
			};

			// Grafik Kedua
			const labels2 = ['DAK 2020', 'DAK 2021', 'DAK 2022', 'DAK 2023', 'DAK 2024'];
			const data2 = {
				labels: labels2,
				datasets: [{
					label: 'Tren Alokasi DAK Bidang Irigasi 2020 - 2024',
					data: [16900000000, 290000000000, 14700000000, 160000000000, 166000000000],
					borderColor: 'rgb(54, 162, 235)',
					backgroundColor: 'rgb(54, 162, 235)',
					order: 1
				}, {
					label: 'Jumlah Penerima DAK',
					data: [374, 406, 247, 168, 268],
					borderColor: 'rgb(251, 140, 1)',
					type: 'line',
					order: 0
				}]
			};

			const config2 = {
				type: 'bar',
				data: data2,
				options: {
					responsive: true,
					plugins: {
						legend: {
							position: 'top',
						},
						title: {
							display: true,
							text: 'Chart.js Combined Line/Bar Chart'
						},
						tooltip: {
							callbacks: {
								label: function(context) {
									let label = context.dataset.label || '';
									if (label) {
										label += ': ';
									}
									if (context.parsed.y !== null) {
										label += new Intl.NumberFormat('id-ID', {
											style: 'currency',
											currency: 'IDR'
										}).format(context.parsed.y);
									}
									return label;
								}
							}
						}
					},
					scales: {
						y: {
							ticks: {
								callback: function(value) {
									return new Intl.NumberFormat('id-ID', {
										style: 'currency',
										currency: 'IDR'
									}).format(value);
								}
							}
						}
					}
				}
			};

			// Grafik Pie
			const labels3 = ['Kabupaten/Kota', 'Pusat', 'Provinsi'];
			const data3 = {
				labels: labels3,
				datasets: [{
					label: 'Dataset 1',
					data: [48, 34, 18],
					backgroundColor: [
						'rgb(255, 99, 132)',
						'rgb(75, 192, 192)',
						'rgb(54, 162, 235)'
					],
				}]
			};

			const config3 = {
				type: 'pie',
				data: data3,
				options: {
					responsive: true,
					plugins: {
						legend: {
							position: 'top',
						},
						title: {
							display: true,
							text: 'Chart.js Pie Chart'
						},
						datalabels: {
							formatter: (value, ctx) => {
								let sum = ctx.dataset.data.reduce((a, b) => a + b, 0);
								let percentage = (value * 100 / sum).toFixed(2) + "%";
								return percentage;
							},
							color: '#fff',
						}
					}
				},
			};

			window.onload = function() {
				const ctx1 = document.getElementById('myChart').getContext('2d');
				new Chart(ctx1, config1);

				const ctx2 = document.getElementById('BarLine').getContext('2d');
				new Chart(ctx2, config2);

				const ctx3 = document.getElementById('pie').getContext('2d');
				new Chart(ctx3, config3);
			};
		</script>

		</script>


	</div>
</section>