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
				<div class="col-sm-4">
					<h5 class="m-0 text-dark" id="titleBox">Data Form 4C : DATA KONDISI D.I.A.T</h5>
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

								<a href="<?= base_url(); ?>IndexKinerja4C/TambahData" class="btn btn-primary mr-1" aksi="add" title="Tambah Data"><i class="fas fa-plus"></i> Tambah</a>

								<a href="<?= base_url(); ?>IndexKinerja4C/formExcel" class="btn btn-success" aksi="add" title="Tambah Data"><i class="fas fa-file-excel"></i> Format Excel</a>

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
								<th style="border: thin solid #006666;" colspan="1" rowspan="4">No</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="4">Provinsi</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="4">Kab/Kota.</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="4">Nomeklatur/Nama D.I.</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="4">Luas D.I. Sesuai Permen 14/2015 (Ha)</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="4">Sawah/Fungsional (Pemetaan IGT) (Ha)</th>
								<th style="border: thin solid #006666;" colspan="82" rowspan="1">Kondisi Fisik Jaringan Irigasi Air Tanah</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="4">Keterangan</th>
							</tr>
							<tr id="boxThField1" style="background-color:#18978F; color:#fff;">
								<th style="border: thin solid #006666;" colspan="8" rowspan="1">Bangunan Utama*</th>
								<th style="border: thin solid #006666;" colspan="24" rowspan="1">Saluran*</th>
								<th style="border: thin solid #006666;" colspan="8" rowspan="1">Bangunan Pengatur dan Pengukur*</th>
								<th style="border: thin solid #006666;" colspan="10" rowspan="1">Bangunan Pembawa*</th>
								<th style="border: thin solid #006666;" colspan="10" rowspan="1">Bangunan Lindung*</th>
								<th style="border: thin solid #006666;" colspan="14" rowspan="1">Bangunan Pelengkap*</th>
								<th style="border: thin solid #006666;" colspan="6" rowspan="1">Sarana*</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="2">Rata-Rata Jaringan</th>
							</tr>
							<tr id="boxThField2" style="background-color:#18978F; color:#fff;">
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Sumur</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Pompa</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Rumah Pompa</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Rumah Genset/Panel Elektrikal</th>
								<th style="border: thin solid #006666;" colspan="6" rowspan="1">Saluran Primer</th>
								<th style="border: thin solid #006666;" colspan="6" rowspan="1">Saluran Sekunder</th>
								<th style="border: thin solid #006666;" colspan="6" rowspan="1">Saluran Tersier</th>
								<th style="border: thin solid #006666;" colspan="6" rowspan="1">Saluran Pembuang</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Bagi**</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Bagi Sadap**</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Sadap**</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Bangunan Pengukur</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Gorong</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Sipon</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Talang</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Terjun</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Got Miring</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Pelimpah</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Saluran Gendong</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Pelepas Tekan</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Bak Kontrol</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Perkuatan Tebing</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Tampungan Air/Reservoir</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Jalan Inspeksi</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Jembatan</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Kantor Pengamat</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Gudang</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Rumah Jaga</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Sanggar Tani</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Pintu Air</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Control Valve</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Alat Ukur</th>
							</tr>

							<!-- header utama -->
							<tr id="boxThField" style="background-color:#18978F; color:#fff;">
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                                
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                                                                             
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                               
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                                                                             
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                               
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                                                                            
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                               
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th> 
								<th style="border: thin solid #006666;">B (%)</th>                                                                                
								<th style="border: thin solid #006666;">RR (%)</th>                                                                              
								<th style="border: thin solid #006666;">RS (%)</th>                                                                              
								<th style="border: thin solid #006666;">RB (%)</th>                                                                              
								<th style="border: thin solid #006666;">Rerata (B/RR/RS/RB)</th>                                                                            
								<th style="border: thin solid #006666;">Nilai Kondisi Kerusakan (%)</th>                                                                   
								<th style="border: thin solid #006666;">B (%)</th>                                                                                
								<th style="border: thin solid #006666;">RR (%)</th>                                                                                
								<th style="border: thin solid #006666;">RS (%)</th>                                                                               
								<th style="border: thin solid #006666;">RB (%)</th>                                                                              
								<th style="border: thin solid #006666;">Rerata (B/RR/RS/RB)</th>                                                                           
								<th style="border: thin solid #006666;">Nilai Kondisi Kerusakan (%)</th>                                                           
								<th style="border: thin solid #006666;">B (%)</th>                                                                       
								<th style="border: thin solid #006666;">RR (%)</th>                                                                                
								<th style="border: thin solid #006666;">RS (%)</th>                                                                               
								<th style="border: thin solid #006666;">RB (%)</th>                                                                              
								<th style="border: thin solid #006666;">Rerata (B/RR/RS/RB)</th>                                                                           
								<th style="border: thin solid #006666;">Nilai Kondisi Kerusakan (%)</th>        
								<th style="border: thin solid #006666;">B (%)</th>                                                                               
								<th style="border: thin solid #006666;">RR (%)</th>                                                                                
								<th style="border: thin solid #006666;">RS (%)</th>                                                                                
								<th style="border: thin solid #006666;">RB (%)</th>                                                                               
								<th style="border: thin solid #006666;">Rerata (B/RR/RS/RB)</th>        
								<th style="border: thin solid #006666;">Nilai Kondisi Kerusakan (%)</th>
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                                
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                                                                              
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                                
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                               
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                 
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                                
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                                                                             
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                               
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                                                                             
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                               
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                                                                             
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                               
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                                                                             
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                                
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                                                                             
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                               
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                                                                              
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                               
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                                                                             
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                              
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                                                                             
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                               
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                                                                             
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                               
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                                                                              
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                               
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                                                                              
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                               
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                                                                              
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                               
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                                                                              
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>               
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                                                                              
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                                
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                                                                              
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                                                                              
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                                
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                                                                             
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                                
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                                                                              
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                                
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                                                                             
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                                
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                                                                             
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                               
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                                                                              
								<th style="border: thin solid #006666;">B/RR/RS/RB</th>                                                                               
								<th style="border: thin solid #006666;">Nilai Kondisi (%)</th>                                                                                             
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
								<th style="border: thin solid #006666;">42</th>
								<th style="border: thin solid #006666;">43</th>
								<th style="border: thin solid #006666;">44</th>
								<th style="border: thin solid #006666;">45</th>
								<th style="border: thin solid #006666;">46</th>
								<th style="border: thin solid #006666;">47</th>
								<th style="border: thin solid #006666;">48</th>
								<th style="border: thin solid #006666;">49</th>
								<th style="border: thin solid #006666;">50</th>
								<th style="border: thin solid #006666;">51</th>
								<th style="border: thin solid #006666;">52</th>
								<th style="border: thin solid #006666;">53</th>
								<th style="border: thin solid #006666;">54</th>
								<th style="border: thin solid #006666;">55</th>
								<th style="border: thin solid #006666;">56</th>
								<th style="border: thin solid #006666;">57</th>
								<th style="border: thin solid #006666;">58</th>
								<th style="border: thin solid #006666;">59</th>
								<th style="border: thin solid #006666;">60</th>
								<th style="border: thin solid #006666;">61</th>
								<th style="border: thin solid #006666;">62</th>
								<th style="border: thin solid #006666;">63</th>
								<th style="border: thin solid #006666;">64</th>
								<th style="border: thin solid #006666;">65</th>
								<th style="border: thin solid #006666;">66</th>
								<th style="border: thin solid #006666;">67</th>
								<th style="border: thin solid #006666;">68</th>
								<th style="border: thin solid #006666;">69</th>
								<th style="border: thin solid #006666;">70</th>
								<th style="border: thin solid #006666;">71</th>
								<th style="border: thin solid #006666;">72</th>
								<th style="border: thin solid #006666;">73</th>
								<th style="border: thin solid #006666;">74</th>
								<th style="border: thin solid #006666;">75</th>
								<th style="border: thin solid #006666;">76</th>
								<th style="border: thin solid #006666;">77</th>
								<th style="border: thin solid #006666;">78</th>
								<th style="border: thin solid #006666;">79</th>
								<th style="border: thin solid #006666;">80</th>
								<th style="border: thin solid #006666;">81</th>
								<th style="border: thin solid #006666;">82</th>
								<th style="border: thin solid #006666;">83</th>
								<th style="border: thin solid #006666;">84</th>
								<th style="border: thin solid #006666;">85</th>
								<th style="border: thin solid #006666;">86</th>
								<th style="border: thin solid #006666;">87</th>
								<th style="border: thin solid #006666;">88</th>
								<th style="border: thin solid #006666;">89</th>
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

				ajaxUntukSemua(base_url()+'IndexKinerja4C/getDataTable', {perhalaman, halamanSaatIni, search, provid, kotakabid}, function(data) {

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
				<td id="irigasiid_50581" style="border: thin solid #006666;" class="options menuALink"><a href="${base_url()}IndexKinerja4C/getDetailData/${value.id}">${value.nama}</a></td>
				<td id="laPermen_50581" style="border: thin solid #006666;" class="number">${value.laPermen}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.sawahFungsional}</td>

				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.buSumurA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.buSumurB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.buPompaA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.buPompaB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.buRumahPompaA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.buRumahPompaB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.buRumahA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.buRumahB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.saluranPrimerB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.saluranPrimerBR}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.saluranPrimerRS}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.saluranPrimerRB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.saluranPrimerRerata}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.saluranPrimerNilai}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.saluranSekunderB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.saluranSekunderBR}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.saluranSekunderRS}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.saluranSekunderRB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.saluranSekunderRerata}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.saluranSekunderNilai}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.saluranTersierB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.saluranTersierBR}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.saluranTersierRS}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.saluranTersierRB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.saluranTersierRerata}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.saluranTersierNilai}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.saluranPembuangB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.saluranPembuangBR}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.saluranPembuangRS}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.saluranPembuangRB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.saluranPembuangRerata}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.saluranPembuangNilai}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.bppBagiA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.bppBagiB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.bppBagiSadapA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.bppBagiSadapB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.bppSadapA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.bppSadapB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.bppBangunanPengukurA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.bppBangunanPengukurB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.bPembawaGorongA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.bPembawaGorongB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.bPembawaSiponA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.bPembawaSiponB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.bPembawaTalangA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.bPembawaTalangB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.bPembawaTerjunanA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.bPembawaTerjunanB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.bPembawaGotMiringA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.bPembawaGotMiringB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.blinPelimpahA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.blinPelimpahB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.blinSaluranGendongA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.blinSaluranGendongB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.blinPelepasTekanA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.blinPelepasTekanB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.blinBakKontrolA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.blinBakKontrolB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.blinPerkuatanTebingA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.blinPerkuatanTebingB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.balengTampungA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.balengTampungB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.balengJalanInspeksiA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.balengJalanInspeksiB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.balengJembatanA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.balengJembatanB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.balengKantorPengamatA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.balengKantorPengamatB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.balengGudangA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.balengGudangB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.balengRumahJagaA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.balengRumahJagaB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.balengSanggarTaniA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.balengSanggarTaniB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.saranaPintuAirA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.saranaPintuAirB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.saranaControlValveA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.saranaControlValveB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.saranaAlatUkurA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.saranaAlatUkurB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.rataJaringanA}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${value.rataJaringanB}</td>
				<td id="laBaku_50581" style="border: thin solid #006666;" class="">${value.keterangan}</td>
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


	ajaxUntukSemua(base_url()+'IndexKinerja4C/getDataKabKota', {prov}, function(data) {

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
		url: base_url() + "IndexKinerja4C/getDi",
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