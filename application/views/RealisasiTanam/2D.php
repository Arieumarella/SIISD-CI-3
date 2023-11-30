<style>
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

<div class="col-lg-12">

	<!-- begin:: Content -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row m-0 p-0 text-left">
				<div class="col-sm-3">
					<h5 class="m-0 text-dark" id="titleBox">Data Form 2D : RTI D.I.T</h5>
				</div>

				<div class="col-sm-12 mt-2">

					<div class="row">

						<?php if ($this->session->userdata('prive') == 'admin') { ?>

							<div class="col-lg-2 col-sm-12 p-0 mr-1">
								<select id="prov" name="prov" class="form-control select2 p-0" >
									<option value="" selected disabled >- Plilih Provinsi -</option>
									<?php foreach ($prov as $key => $value) { ?>
										<option value="<?= $value->provid; ?>" ><?= $value->provinsi; ?></option>
									<?php } ?>
								</select>
							</div>

							<div class="col-lg-2 col-sm-12 p-0 mr-1">
								<select id="kabkota" name="kabkota" class="form-control select3 p-0" >

								</select>
							</div>

						<?php }else if ($this->session->userdata('prive') == 'provinsi' or $this->session->userdata('prive') == 'pemda'){ ?>

							<input type="hidden" id="prov" name="prov">
							<input type="hidden" id="kabkota" name="kabkota">

						<?php }else if ($this->session->userdata('prive') == 'balai') { ?>

							<div class="col-sm-12 col-lg-2 p-0 mr-1">
								<select id="prov" name="prov" class="form-control select2 p-0" >
									<option value="" selected disabled >- Plilih Provinsi -</option>
									<?php foreach ($prov as $key => $value) { ?>
										<option value="<?= $value->provid; ?>" ><?= $value->provinsi; ?></option>
									<?php } ?>
								</select>
							</div>

							<div class="col-sm-12 col-lg-2 p-0 mr-1">
								<select id="kabkota" name="kabkota" class="form-control select3 p-0" >

								</select>
							</div>

						<?php }else{ ?>

							<input type="hidden" id="prov" name="prov">
							<input type="hidden" id="kabkota" name="kabkota">

						<?php } ?>

						<div class="col-sm-12 col-lg-3 p-0">
							<div class="input-group input-group-sm">

								<select id="in_irigasiid" name="nm_di" class="form-control select2_Irigasi p-0" >

								</select>

								<span class="input-group-append ml-1">
									<button id="btn_filter" onclick="cari()" linkPager='' aksi="false" class="btn btn-info btn-flat"><i class="fas fa-search-plus"></i> Cari</button>
								</span>

							</div>
						</div>
						<div class="row col-sm-12  col-lg-4 p-0 ml-1">
							<!-- <a href="#" class="btn btn-success btn-sm" aksi="rekap" title="Rekap Data"><i class="fas fa-file-excel"></i> a</a> -->
							<!-- -------------- -->

							<button type="submit" onclick="rekapform(this)" class="btn btn-info mr-1" title="Unduh"><i class="fas fa-file-excel"></i> Unduh</button>

							<!-- ---------------- -->

							<?php if ($this->session->userdata('prive') == 'admin' or $this->session->userdata('prive') == 'pemda' or $this->session->userdata('prive') == 'provinsi') { ?>

								<a href="<?= base_url(); ?>RealisasiTanam2D/TambahData" class="btn btn-primary mr-1" aksi="add" title="Tambah Data"><i class="fas fa-plus"></i> Tambah</a>

								<a href="<?= base_url(); ?>RealisasiTanam2D/formExcel" class="btn btn-success" aksi="add" title="Tambah Data"><i class="fas fa-file-excel"></i> Format Excel</a>

							<?php } ?>

							<!-- &nbsp;&nbsp;<button type="button" id="panel-fullscreen" title="Layar Penuh" class="btn btn-default btn-sm" titile="Layar Penuh"><i class="fa fa-expand"></i></button> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="content">
		<div class="container-fluid">

			<!-- box data teknis -->
			<div class="row">
				<div class="card-body table-responsive p-0 tableFixHead" style="position: relative; overflow-y: scroll; height: 83vh; background-color:#efebe9; padding:2px;">

					<?= $this->session->flashdata('psn'); ?>
					<table class="table table-bordered">
						

						<thead id="thead_data">
							<tr id="boxThField0" style="background-color:#18978F; color:#fff;">
								<th style="border: thin solid #006666;" colspan="1" rowspan="3">No</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="3">Provinsi</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="3">Kab/Kota</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="3">Nomeklatur/Nama D.I.</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="3">Luas D.I. Sesuai Permen 14/2015 (Ha)</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="3">Sawah/Fungsional (Pemetaan IGT) (Ha)</th>
								<th style="border: thin solid #006666;" colspan="6" rowspan="2">Pola Tambak</th>
								<th style="border: thin solid #006666;" colspan="5" rowspan="">IKAN</th>
								<th style="border: thin solid #006666;" colspan="5" rowspan="">UDANG</th>
								<th style="border: thin solid #006666;" colspan="5" rowspan="">KEPITING</th>
								<th style="border: thin solid #006666;" colspan="5" rowspan="">LAINNYA</th>
								<th style="border: thin solid #006666;" colspan="5" rowspan="">JUMLAH</th>
								<th style="border: thin solid #006666;" colspan="4" rowspan="">PRODUKTIVITAS IKAN</th>
							</tr>
							<tr id="boxThField1" style="background-color:#18978F; color:#fff;">
								<th style="border: thin solid #006666;" colspan="1" rowspan="">MT.1</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="">MT.2</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="">MT.3</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="">Total</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="">MT.1</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="">MT.2</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="">MT.3</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="">Total</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="">MT.1</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="">MT.2</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="">MT.3</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="">Total</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="">MT.1</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="">MT.2</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="">MT.3</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="">Total</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="">MT.1</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="">MT.2</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="">MT.3</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="">Total</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="">MT.1</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="">MT.2</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="">MT.3</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="">Rata2</th>
							</tr>

							<!-- header utama -->
							<tr id="boxThField" style="background-color:#18978F; color:#fff;">
								<th style="border: thin solid #006666;">I→I→I</th>                                                                                
								<th style="border: thin solid #006666;">I→I→L</th>                                                                                
								<th style="border: thin solid #006666;">I→L→L</th>                                                                                
								<th style="border: thin solid #006666;">I→I</th>                                                                                
								<th style="border: thin solid #006666;">I→L</th>                                                                                
								<th style="border: thin solid #006666;">I</th>                                                                                
								<th style="border: thin solid #006666;">Ha</th>                                                                                
								<th style="border: thin solid #006666;">Ha</th>                                                                                
								<th style="border: thin solid #006666;">Ha</th>                                                                                
								<th style="border: thin solid #006666;">Ha</th>                                                                               
								<th style="border: thin solid #006666;">IP(%)</th>                                                                              
								<th style="border: thin solid #006666;">Ha</th>                                                                                
								<th style="border: thin solid #006666;">Ha</th>                                                                                
								<th style="border: thin solid #006666;">Ha</th>                                                                                
								<th style="border: thin solid #006666;">Ha</th>                                                                                
								<th style="border: thin solid #006666;">IP(%)</th>                                                                                
								<th style="border: thin solid #006666;">Ha</th>                                                                                
								<th style="border: thin solid #006666;">Ha</th>                                                                                
								<th style="border: thin solid #006666;">Ha</th>                                                                                
								<th style="border: thin solid #006666;">Ha</th>                                                                                
								<th style="border: thin solid #006666;">IP(%)</th>                                                                                
								<th style="border: thin solid #006666;">Ha</th>                                                                                
								<th style="border: thin solid #006666;">Ha</th>                                                                                
								<th style="border: thin solid #006666;">Ha</th>                                                                                
								<th style="border: thin solid #006666;">Ha</th>                                                                                
								<th style="border: thin solid #006666;">IP(%)</th>                                                                               
								<th style="border: thin solid #006666;">Ha</th>                                                                               
								<th style="border: thin solid #006666;">Ha</th>                                                                                
								<th style="border: thin solid #006666;">Ha</th>                                                                                
								<th style="border: thin solid #006666;">Ha</th>                                                                                
								<th style="border: thin solid #006666;">IP(%)</th>                                                                                
								<th style="border: thin solid #006666;">Ton/Ha</th>                                                                                
								<th style="border: thin solid #006666;">Ton/Ha</th>                                                                                
								<th style="border: thin solid #006666;">Ton/Ha</th>                                                                                
								<th style="border: thin solid #006666;">Ton/Ha</th>                                                        
							</tr>

							<!-- nomor kolom -->
							<tr id="boxThNo" style="background-color:#18978F; color:#fff;">
								<th style="border: thin solid #006666;">1</th>
								<th style="border: thin solid #006666;">2</th>
								<th style="border: thin solid #006666;">3</th>
								<th style="border: thin solid #006666;">4</th>
								<th style="border: thin solid #006666;">5</th>
								<th style="border: thin solid #006666;">6</th>
								<th style="border: thin solid #006666;">7</th>
								<th style="border: thin solid #006666;">8</th>
								<th style="border: thin solid #006666;">9</th>
								<th style="border: thin solid #006666;">10</th>
								<th style="border: thin solid #006666;">11</th>
								<th style="border: thin solid #006666;">12</th>
								<th style="border: thin solid #006666;">13</th>
								<th style="border: thin solid #006666;">14</th>
								<th style="border: thin solid #006666;">15</th>
								<th style="border: thin solid #006666;">16</th>
								<th style="border: thin solid #006666;">17</th>
								<th style="border: thin solid #006666;">18</th>
								<th style="border: thin solid #006666;">19</th>
								<th style="border: thin solid #006666;">20</th>
								<th style="border: thin solid #006666;">21</th>
								<th style="border: thin solid #006666;">22</th>
								<th style="border: thin solid #006666;">23</th>
								<th style="border: thin solid #006666;">24</th>
								<th style="border: thin solid #006666;">25</th>
								<th style="border: thin solid #006666;">26</th>
								<th style="border: thin solid #006666;">27</th>
								<th style="border: thin solid #006666;">28</th>
								<th style="border: thin solid #006666;">29</th>
								<th style="border: thin solid #006666;">30</th>
								<th style="border: thin solid #006666;">31</th>
								<th style="border: thin solid #006666;">32</th>
								<th style="border: thin solid #006666;">33</th>
								<th style="border: thin solid #006666;">34</th>
								<th style="border: thin solid #006666;">35</th>
								<th style="border: thin solid #006666;">36</th>
								<th style="border: thin solid #006666;">37</th>
								<th style="border: thin solid #006666;">38</th>
								<th style="border: thin solid #006666;">39</th>
								<th style="border: thin solid #006666;">40</th>
								<th style="border: thin solid #006666;">41</th>
							</tr>


						</thead>


						<tbody id="tbody_data">

						</tbody>
					</table>
				</div>

				<div class="container">
					<div class="row justify-content-md-center">
						<div class="col-md-auto" id="table_page">

							<nav aria-label="Page navigation">
								<ul class="pagination">
									<div class="pagination" id="pagination">

									</div>

									<li class="page-item mt-1">
										<select id="rowpage" style="border:thin solid #ccc; padding:3px 0px;">
											<option value="10" selected="">10</option>
											<option value="50">50</option>
											<option value="150">150</option>
											<option value="250">250</option>
											<option value="350">350</option>
											<option value="450">450</option>
											<option value="9000">9000</option>

										</select>
									</li>
								</ul>
							</nav>               
						</div>
					</div>
				</div>

			</div>

		</div>
	</section>

	<!-- khusu form 8 ------------------------------------------------------------------- -->

</div>

<script type="text/javascript">

	$(document).ready(function() {

		var halamanSaatIni = '1',
		search = '',
		provid = '',
		kotakabid = '';

		getDataTabel = async function (page=null, providX=null, kotakabidX=null) {
			try{

				if (page != null) {
					halamanSaatIni = await page;
				}else{
					halamanSaatIni = 1;
				}

				if (providX != null && providX != '') {
					provid = await providX
				}

				if (kotakabidX != null && kotakabidX != '') {
					kotakabid = await kotakabidX
				}

				$('#tbody_data').empty();
				$('#tbody_data').html(` <tr><td class="text-center" colspan="4" style="font-size:20px;"><i class="fas fa-circle-notch fa-spin"></i> Loading Data ...</td></tr>`);

				console.log('Halaman Saat Ini ---->'+halamanSaatIni)

				var perhalaman = $("#rowpage").val();

				ajaxUntukSemua(base_url()+'RealisasiTanam2D/getDataTable', {perhalaman, halamanSaatIni, search, provid, kotakabid}, function(data) {

          // Set Data Body
					setTabelKonten(data.data)
          // End Set Data Body

          // Set Generet Pagination 
					generatePagination(data.jml_data.jml_data, perhalaman, halamanSaatIni);
          // End Set Generet Pagination


				}, function(error) {
					console.log('Kesalahan:', error);
				});


			}catch(err){
				console.log('Kesalahan:', error);
			}

		}

		getDataTabel();


		function setTabelKonten(data) {

			let tableConten = ``,
			warnaAwal = `#F7ECDE`,
			no = 1;


			$.each(data, function(key, value) {
				console.log(value)
				tableConten += `<tr style="background-color:${warnaAwal};">
				<td style="border: thin solid #006666;" align="center">${no}</td>
				<td id="laPermen_50581" style="border: thin solid #006666;" class="">${value.provinsi}</td>
				<td id="laPermen_50581" style="border: thin solid #006666;" class="">${value.kemendagri}</td>
				<td id="irigasiid_50581" style="border: thin solid #006666;" class="options menuALink"><a href="${base_url()}RealisasiTanam2D/getDetailData/${value.id}">${value.nama}</a></td>
				<td id="laPermen_50581" style="border: thin solid #006666;" class="number">${value.laPermen}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.sawahFungsional}</td>
				<td id="laPotensial_50581" style="border: thin solid #006666;" class="text-center"> ${ (value.polatambakIkan3 == 'V') ? '<i class="fas fa-check"></i>': '' }</td>
				<td id="laFungsional_50581" style="border: thin solid #006666;" class="text-center">${ (value.polatambakIkan2Lain == 'V') ? '<i class="fas fa-check"></i>': '' }</td>
				<td id="sumberAir_50581" style="border: thin solid #006666;" class="text-center">${ (value.polatambakIkanLain2 == 'V') ? '<i class="fas fa-check"></i>': '' }</td>
				<td id="buBendung_50581" style="border: thin solid #006666;" class="text-center">${ (value.polatambakIkan2 == 'V') ? '<i class="fas fa-check"></i>': '' }</td>
				<td id="buPengambilanBebas_50581" style="border: thin solid #006666;" class="text-center">${ (value.polatambakIkanLain == 'V') ? '<i class="fas fa-check"></i>': '' }</td>
				<td id="buStasiunPompa_50581" style="border: thin solid #006666;" class="text-center">${ (value.polatambakIkan == 'V') ? '<i class="fas fa-check"></i>': '' }</td>
				<td id="buEmbung_50581" style="border: thin solid #006666;" class="number">${value.ikanMT1}</td>
				<td id="sTipeSaluran_50581" style="border: thin solid #006666;" class="options">${value.ikanMT2}</td>
				<td id="sPrimer_50581" style="border: thin solid #006666;" class="number">${value.ikanMT3}</td>
				<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${value.ikanTotalHa}</td>
				<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${value.ikanTotalHaIp}</td>
				<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${value.udangMT1}</td>
				<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${value.udangMT2}</td>
				<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${value.udangMT3}</td>
				<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${value.udangTotalHa}</td>
				<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${value.udangTotalHaIp}</td>
				<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${value.kepitingMT1}</td>
				<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${value.kepitingMT2}</td>
				<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${value.kepitingMT3}</td>
				<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${value.kepitingTotalHa}</td>
				<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${value.kepitingTotalHaIp}</td>
				<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${value.lainMT1}</td>
				<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${value.lainMT2}</td>
				<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${value.lainMT3}</td>
				<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${value.lainTotalHa}</td>
				<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${value.lainTotalHaIp}</td>
				<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${value.jmlMT1}</td>
				<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${value.jmlMT2}</td>
				<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${value.jmlMT3}</td>
				<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${value.jmlTotalHa}</td>
				<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${value.jmlTotalIp}</td>
				<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${value.produktivitasIkanMT1}</td>
				<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${value.produktivitasIkanMT2}</td>
				<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${value.produktivitasIkanMT3}</td>
				<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${value.produktivitasIkanRata2}</td>
				</tr>`;

				warnaAwal = (warnaAwal == '#F7ECDE') ? '#FFF' : '#F7ECDE';
				no++;
			});

$('#tbody_data').html(tableConten);

}


function generatePagination(totalData, dataPerHalaman, halamanSaatIni) {
	var jumlahHalaman = Math.ceil(Number(totalData) / Number(dataPerHalaman));
	var paginationContainer = $('#pagination');
	paginationContainer.empty(); 

	var startingPage = 1;
	var endingPage = jumlahHalaman; 

	if (jumlahHalaman > 3) {
		startingPage = Math.max(1, halamanSaatIni - 1);
		endingPage = Math.min(jumlahHalaman, halamanSaatIni + 1);
	}

  // Menampilkan tombol First
	if (halamanSaatIni > 1) {
		var firstButton = $(`<li class="page-item"><a class="page-link c-pinter" linkpager="next" onclick="getDataTabel(${1})">First</a></li>`);
		paginationContainer.append(firstButton);
	}

	var prevButton = $(`<li class="page-item"><a class="page-link c-pinter" onclick="getDataTabel(${Math.max(1, halamanSaatIni - 1)})" linkpager="prev">Previous</a></li>`);
	paginationContainer.append(prevButton);

	for (var i = startingPage; i <= endingPage; i++) {
		var listItem = $('<li class="page-item"></li>');
		var linkItem = $(`<a class="page-link c-pinter" onclick="getDataTabel(${i})"></a>`);

		linkItem.text(i);

		if (Number(i) === Number(halamanSaatIni)) {
			listItem.addClass('active');
		}
		listItem.append(linkItem);
		paginationContainer.append(listItem);
	}

	if (halamanSaatIni < jumlahHalaman) {
		var nextButton = $(`<li class="page-item"><a class="page-link c-pinter" linkpager="next" onclick="getDataTabel(${Math.min(jumlahHalaman, halamanSaatIni + 1)})">Next</a></li>`);
		paginationContainer.append(nextButton);

		var lastButton = $(`<li class="page-item"><a class="page-link c-pinter" linkpager="last" onclick="getDataTabel(${jumlahHalaman})">Last</a></li>`);
		paginationContainer.append(lastButton);
	}
}


cari = function () {

	provid = $('#prov').val();
	kotakabid = $('#kabkota').val();
	search = $('#in_irigasiid').val();

	getDataTabel(null, provid, kotakabid)


}



$('#rowpage').change(function() {
	getDataTabel(null)

});


$('#prov').change(function() {
	var prov = $(this).val();

	$('.select2_Irigasi').val(null).trigger('change');


	ajaxUntukSemua(base_url()+'RealisasiTanam2D/getDataKabKota', {prov}, function(data) {

		let opt = `<option value="" selected disabled>- Plih Kab/Kota -</option>`;

		$.each(data, function(key, value) {
			opt += `<option value="${value.kotakabid}" >${value.kemendagri}</option>`;
		})

		$('#kabkota').html(opt);

	}, function(error) {
		console.log('Kesalahan:', error);
	});


});

$('#kabkota').change(function() {
	$('.select2_Irigasi').val(null).trigger('change');
});


$('.select2').select2({
	placeholder: '-Pilih Provinsi-',
	theme: 'default',

})

$('.select3').select2({
	placeholder: '-Pilih Kab/Kota-',
	theme: 'default',

})


$('.select2_Irigasi').select2({
	placeholder: '-Tentukan Daerah Irigasi-',
	theme: 'default',
	ajax: {
		url: base_url() + "RealisasiTanam2D/getDi",
		dataType: 'json',
		type: 'post',
		delay: 250,
		data: function (params) {
			var query = {
				searchDi: params.term,
				kdprov: $('#prov').val(),
				kdKab: $('#kabkota').val()
			};
			return query;
		},
		processResults: function (response) {

			response.data.unshift({ id: '', text: 'Tampilkan semua' });

			return {
				results: response.data 
			};
		},
		cache: true
	}
});



});

</script>