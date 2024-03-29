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
					<h5 class="m-0 text-dark" id="titleBox">Data Form 4E : DATA KONDISI D.I.P</h5>
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

							<?php if ($this->session->userdata('prive') == 'admin' or $this->session->userdata('prive') == 'pemda') { ?>

								<!-- <a href="<?= base_url(); ?>IndexKinerja4E/downloadTabel" class="btn btn-info mr-1"><i class="fas fa-file-excel"></i> Unduh</a> -->

							<?php } ?>

							<!-- ---------------- -->

							<?php if ($this->session->userdata('prive') == 'admin' or $this->session->userdata('prive') == 'pemda' or $this->session->userdata('prive') == 'provinsi') { ?>

								<a href="<?= base_url(); ?>IndexKinerja4E/TambahData" class="btn btn-primary mr-1" aksi="add" title="Tambah Data"><i class="fas fa-plus"></i> Tambah</a>

								<a href="<?= base_url(); ?>IndexKinerja4E/formExcel" class="btn btn-success" aksi="add" title="Tambah Data"><i class="fas fa-file-excel"></i> Format Excel</a>

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
								<th style="border: thin solid #006666;" colspan="1" rowspan="4">Kab/Kota</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="4">Nomeklatur/Nama D.I.</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="4">Luas D.I. Sesuai Permen 14/2015 (Ha)</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="4">Sawah/Fungsional (Pemetaan IGT) (Ha)</th>
								<th style="border: thin solid #006666;" colspan="86" rowspan="1">Kondisi Fisik Jaringan Irigasi Pompa</th>
								<th style="border: thin solid #006666;" colspan="1" rowspan="4">Keterangan</th>
							</tr>
							<tr id="boxThField1" style="background-color:#18978F; color:#fff;">
								<th style="border: thin solid #006666;" colspan="8" rowspan="1">Bangunan Utama*</th>
								<th style="border: thin solid #006666;" colspan="24" rowspan="1">Saluran*</th>
								<th style="border: thin solid #006666;" colspan="8" rowspan="1">Bangunan Pengatur dan Pengukur*</th>
								<th style="border: thin solid #006666;" colspan="10" rowspan="1">Bangunan Pembawa*</th>
								<th style="border: thin solid #006666;" colspan="14" rowspan="1">Bangunan Lindung*</th>
								<th style="border: thin solid #006666;" colspan="14" rowspan="1">Bangunan Pelengkap*</th>
								<th style="border: thin solid #006666;" colspan="6" rowspan="1">Sarana*</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="2">Rata-Rata Jaringan</th>
							</tr>
							<tr id="boxThField2" style="background-color:#18978F; color:#fff;">
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Pompa</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Rumah Pompa</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Jembatan Pengambilan</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Rumah Genset &amp; Panel Elektrikal</th>
								<th style="border: thin solid #006666;" colspan="6" rowspan="1">Saluran Primer</th>
								<th style="border: thin solid #006666;" colspan="6" rowspan="1">Saluran Sekunder</th>
								<th style="border: thin solid #006666;" colspan="6" rowspan="1">Saluran Tersier</th>
								<th style="border: thin solid #006666;" colspan="6" rowspan="1">Saluran Pembuang</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Bagi**</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Bagi Sadap**</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Sadap**</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Bangunan Pengukur</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Gorong-Gorong</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Sipon</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Talang</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Terjunan</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Got Miring</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Krib</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Pelimpah</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Saluran Gendong</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Pelepas Tekan</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Bak Kontrol</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Tanggul</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Perkuatan Tebing</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Jalan Inspeksi</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Jembatan</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Kantor Pengamat</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Gudang</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Rumah Jaga</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Sanggar Tani</th>
								<th style="border: thin solid #006666;" colspan="2" rowspan="1">Tampungan Air/Reservoir</th>
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
								<th style="border: thin solid #006666;">90</th>
								<th style="border: thin solid #006666;">91</th>
								<th style="border: thin solid #006666;">92</th>
								<th style="border: thin solid #006666;">93</th>
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
		kotakabid = '',
		priveXX = '<?= $this->session->userdata('prive'); ?>';

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

				ajaxUntukSemua(base_url()+'IndexKinerja4E/getDataTable', {perhalaman, halamanSaatIni, search, provid, kotakabid}, function(data) {

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

		if (priveXX != 'admin') {
			getDataTabel();
		}


		async function setTabelKonten(data) {
			try {

				let tableConten = ``,
				warnaAwal = `#F7ECDE`,
				no = 1;


				for (const [key, value] of Object.entries(data)) {
					try{

						let nilaiSaluarB = await hasilKaliSaluran(value.saluranPrimerB, value.pjg_saluranPrimerB),
						nilaiSaluarBR = await hasilKaliSaluran(value.saluranPrimerBR, value.pjg_saluranPrimerBR),
						nilaiSaluarRS = await hasilKaliSaluran(value.saluranPrimerRS, value.pjg_saluranPrimerRS),
						nilaiSaluarRB = await hasilKaliSaluran(value.saluranPrimerRB, value.pjg_saluranPrimerRB),
						totalPanjangSaluranPrimer = await totalPanjangSaluran(value.pjg_saluranPrimerB, value.pjg_saluranPrimerBR, value.pjg_saluranPrimerRS, value.pjg_saluranPrimerRB),
						retaRataNilaiKondisi = await isNaN(hitungNilaiKondisiKerusakanExcelForm4(nilaiSaluarB, nilaiSaluarBR, nilaiSaluarRS, nilaiSaluarRB)/hitungSUmSaluran(nilaiSaluarB, nilaiSaluarBR, nilaiSaluarRS, nilaiSaluarRB)) ? 0:hitungNilaiKondisiKerusakanExcelForm4(nilaiSaluarB, nilaiSaluarBR, nilaiSaluarRS, nilaiSaluarRB)/hitungSUmSaluran(nilaiSaluarB, nilaiSaluarBR, nilaiSaluarRS, nilaiSaluarRB);



						let sekunderNilaiSaluarB = await hasilKaliSaluran(value.saluranSekunderB, value.pjg_saluranSekunderB),
						sekunderNilaiSaluarBR = await hasilKaliSaluran(value.saluranSekunderBR, value.pjg_saluranSekunderBR),
						sekunderNilaiSaluarRS = await hasilKaliSaluran(value.saluranSekunderRS, value.pjg_saluranSekunderRS),
						sekunderNilaiSaluarRB = await hasilKaliSaluran(value.saluranSekunderRB, value.pjg_saluranSekunderRB),
						totalPanjangSaluranSekunder = await totalPanjangSaluran(value.pjg_saluranSekunderB, value.pjg_saluranSekunderBR, value.pjg_saluranSekunderRS, value.pjg_saluranSekunderRB),
						retaRataNilaiKondisiSekunder = await isNaN(hitungNilaiKondisiKerusakanExcelForm4(sekunderNilaiSaluarB, sekunderNilaiSaluarBR, sekunderNilaiSaluarRS, sekunderNilaiSaluarRB)/hitungSUmSaluran(sekunderNilaiSaluarB, sekunderNilaiSaluarBR, sekunderNilaiSaluarRS, sekunderNilaiSaluarRB)) ? 0:hitungNilaiKondisiKerusakanExcelForm4(sekunderNilaiSaluarB, sekunderNilaiSaluarBR, sekunderNilaiSaluarRS, sekunderNilaiSaluarRB)/hitungSUmSaluran(sekunderNilaiSaluarB, sekunderNilaiSaluarBR, sekunderNilaiSaluarRS, sekunderNilaiSaluarRB);

						let TersierNilaiSaluarB = await hasilKaliSaluran(value.saluranTersierB, value.pjg_saluranTersierB),
						TersierNilaiSaluarBR = await hasilKaliSaluran(value.saluranTersierBR, value.pjg_saluranTersierBR),
						TersierNilaiSaluarRS = await hasilKaliSaluran(value.saluranTersierRS, value.pjg_saluranTersierRS),
						TersierNilaiSaluarRB = await hasilKaliSaluran(value.saluranTersierRB, value.pjg_saluranTersierRB),
						totalPanjangSaluranTersier = await totalPanjangSaluran(value.pjg_saluranTersierB, value.pjg_saluranTersierBR, value.pjg_saluranTersierRS, value.pjg_saluranTersierRB),
						retaRataNilaiKondisiTersier = await isNaN(hitungNilaiKondisiKerusakanExcelForm4(TersierNilaiSaluarB, TersierNilaiSaluarBR, TersierNilaiSaluarRS, TersierNilaiSaluarRB)/hitungSUmSaluran(TersierNilaiSaluarB, TersierNilaiSaluarBR, TersierNilaiSaluarRS, TersierNilaiSaluarRB)) ? 0 : hitungNilaiKondisiKerusakanExcelForm4(TersierNilaiSaluarB, TersierNilaiSaluarBR, TersierNilaiSaluarRS, TersierNilaiSaluarRB)/hitungSUmSaluran(TersierNilaiSaluarB, TersierNilaiSaluarBR, TersierNilaiSaluarRS, TersierNilaiSaluarRB);

						let PembuangNilaiSaluarB = await hasilKaliSaluran(value.saluranPembuangB, value.pjg_saluranPembuangB),
						PembuangNilaiSaluarBR = await hasilKaliSaluran(value.saluranPembuangBR, value.pjg_saluranPembuangBR),
						PembuangNilaiSaluarRS = await hasilKaliSaluran(value.saluranPembuangRS, value.pjg_saluranPembuangRS),
						PembuangNilaiSaluarRB = await hasilKaliSaluran(value.saluranPembuangRB, value.pjg_saluranPembuangRB),
						totalPanjangSaluranPembuang = await totalPanjangSaluran(value.pjg_saluranPembuangB, value.pjg_saluranPembuangBR, value.pjg_saluranPembuangRS, value.pjg_saluranPembuangRB),
						retaRataNilaiKondisiPembuang = await isNaN(hitungNilaiKondisiKerusakanExcelForm4(PembuangNilaiSaluarB, PembuangNilaiSaluarBR, PembuangNilaiSaluarRS, PembuangNilaiSaluarRB)/hitungSUmSaluran(PembuangNilaiSaluarB, PembuangNilaiSaluarBR, PembuangNilaiSaluarRS, PembuangNilaiSaluarRB)) ? 0 : hitungNilaiKondisiKerusakanExcelForm4(PembuangNilaiSaluarB, PembuangNilaiSaluarBR, PembuangNilaiSaluarRS, PembuangNilaiSaluarRB)/hitungSUmSaluran(PembuangNilaiSaluarB, PembuangNilaiSaluarBR, PembuangNilaiSaluarRS, PembuangNilaiSaluarRB);

						let saluran1 = await hitungSaluranTotal(nilaiSaluarB, nilaiSaluarBR, nilaiSaluarRS, nilaiSaluarRB, 1),
						saluran2 = await hitungSaluranTotal(sekunderNilaiSaluarB, sekunderNilaiSaluarBR, sekunderNilaiSaluarRS, sekunderNilaiSaluarRB, 1),
						saluran3 = await hitungSaluranTotal(TersierNilaiSaluarB, TersierNilaiSaluarBR, TersierNilaiSaluarRS, TersierNilaiSaluarRB, 1),
						saluran4 = await hitungSaluranTotal(PembuangNilaiSaluarB, PembuangNilaiSaluarBR, PembuangNilaiSaluarRS, PembuangNilaiSaluarRB, 1);


						let arrayRataRata = [
							value.buPompaB,
							value.buRumahPompaB,
							value.buJembatanPengambilanB,
							value.buRumahB,
							value.bppBagiB,
							value.bppBagiSadapB,
							value.bppSadapB,
							value.bppBangunanPengukurB,
							value.bPembawaGorongB,
							value.bPembawaSiponB,
							value.bPembawaTalangB,
							value.bPembawaTerjunanB,
							value.bPembawaGotMiringB,
							value.blinKribB,
							value.blinPelimpahB,
							value.blinSaluranGendongB,
							value.blinPelepasTekanB,
							value.blinBakKontrolB,
							value.blinTanggungB,
							value.blinPerkuatanTebingB,
							value.balengJalanInspeksiB,
							value.balengJembatanB,
							value.balengKantorPengamatB,
							value.balengGudangB,
							value.balengRumahJagaB,
							value.balengSanggarTaniB,
							value.balengTampunganB,
							value.saranaPintuAirB,
							value.saranaControlValveB,
							value.saranaAlatUkurB,
							retaRataNilaiKondisi,
							retaRataNilaiKondisiSekunder,
							retaRataNilaiKondisiTersier,
							retaRataNilaiKondisiPembuang
							];

						

						let totalNilai = await hitungTotalRataRataAllForm4(arrayRataRata, 2),
						totalNilaiKondisi = await hitungTotalRataRataAllForm4(arrayRataRata, 1);


						tableConten += `<tr style="background-color:${warnaAwal};">
						<td style="border: thin solid #006666;" align="center">${no}</td>
						<td id="laPermen_50581" style="border: thin solid #006666;" class="">${value.provinsi}</td>
						<td id="laPermen_50581" style="border: thin solid #006666;" class="">${value.kemendagri}</td>
						<td id="irigasiid_50581" style="border: thin solid #006666;" class="options menuALink"><a href="${base_url()}IndexKinerja4E/getDetailData/${value.irigasiidX}">${cleanStr(value.nama)}</a></td>
						<td id="laPermen_50581" style="border: thin solid #006666;" class="number">${cleanStr(value.lper)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${cleanStr(value.sawahFungsional)}</td>

						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.buPompaA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${cleanStr(value.buPompaB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.buRumahPompaA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${cleanStr(value.buRumahPompaB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.buJembatanPengambilanA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${cleanStr(value.buJembatanPengambilanB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.buRumahA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${cleanStr(value.buRumahB)}</td>

						<td id="sSekunder_50581" style="border: thin solid #006666; ${bgTabelKolom(value.saluranPrimerBx)}" class="number">${cleanStr(value.saluranPrimerB)}</td>
						<td id="sSekunder_50581" style="border: thin solid #006666; ${bgTabelKolom(value.saluranPrimerBRx)}" class="number">${cleanStr(value.saluranPrimerBR)}</td>
						<td id="sSekunder_50581" style="border: thin solid #006666; ${bgTabelKolom(value.saluranPrimerRSx)}" class="number">${cleanStr(value.saluranPrimerRS)}</td>
						<td id="sSekunder_50581" style="border: thin solid #006666; ${bgTabelKolom(value.saluranPrimerRBx)}" class="number">${cleanStr(value.saluranPrimerRB)}</td>
						<td id="sSekunder_50581" style="border: thin solid #006666;" class="">${cleanStr(getNilaiRataRataKondisi(retaRataNilaiKondisi))}</td>
						<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${cleanStr(retaRataNilaiKondisi)}</td>

						<td id="sSekunder_50581" style="border: thin solid #006666;  ${bgTabelKolom(value.saluranSekunderBx)}" class="number">${cleanStr(value.saluranSekunderB)}</td>
						<td id="sSekunder_50581" style="border: thin solid #006666;  ${bgTabelKolom(value.saluranSekunderBRx)}" class="number">${cleanStr(value.saluranSekunderBR)}</td>
						<td id="sSekunder_50581" style="border: thin solid #006666;  ${bgTabelKolom(value.saluranSekunderRSx)}" class="number">${cleanStr(value.saluranSekunderRS)}</td>
						<td id="sSekunder_50581" style="border: thin solid #006666;  ${bgTabelKolom(value.saluranSekunderRBx)}" class="number">${cleanStr(value.saluranSekunderRB)}</td>
						<td id="sSekunder_50581" style="border: thin solid #006666;" class="">${cleanStr(getNilaiRataRataKondisi(retaRataNilaiKondisiSekunder))}</td>
						<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${cleanStr(retaRataNilaiKondisiSekunder)}</td>


						<td id="sSekunder_50581" style="border: thin solid #006666; ${bgTabelKolom(value.saluranTersierBx)} " class="number">${cleanStr(value.saluranTersierB)}</td>
						<td id="sSekunder_50581" style="border: thin solid #006666; ${bgTabelKolom(value.saluranTersierBRx)} " class="number">${cleanStr(value.saluranTersierBR)}</td>
						<td id="sSekunder_50581" style="border: thin solid #006666; ${bgTabelKolom(value.saluranTersierRSx)} " class="number">${cleanStr(value.saluranTersierRS)}</td>
						<td id="sSekunder_50581" style="border: thin solid #006666; ${bgTabelKolom(value.saluranTersierRBx)} " class="number">${cleanStr(value.saluranTersierRB)}</td>
						<td id="sSekunder_50581" style="border: thin solid #006666;" class="">${cleanStr(getNilaiRataRataKondisi(retaRataNilaiKondisiTersier))}</td>
						<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${cleanStr(retaRataNilaiKondisiTersier)}</td>


						<td id="sSekunder_50581" style="border: thin solid #006666; ${bgTabelKolom(value.saluranPembuangBx)} " class="number">${cleanStr(value.saluranPembuangB)}</td>
						<td id="sSekunder_50581" style="border: thin solid #006666; ${bgTabelKolom(value.saluranPembuangBRx)} " class="number">${cleanStr(value.saluranPembuangBR)}</td>
						<td id="sSekunder_50581" style="border: thin solid #006666; ${bgTabelKolom(value.saluranPembuangRSx)} " class="number">${cleanStr(value.saluranPembuangRS)}</td>
						<td id="sSekunder_50581" style="border: thin solid #006666; ${bgTabelKolom(value.saluranPembuangRBx)} " class="number">${cleanStr(value.saluranPembuangRB)}</td>
						<td id="sSekunder_50581" style="border: thin solid #006666;" class="">${cleanStr(getNilaiRataRataKondisi(retaRataNilaiKondisiPembuang))}</td>
						<td id="sSekunder_50581" style="border: thin solid #006666;" class="number">${cleanStr(retaRataNilaiKondisiPembuang)}</td>

						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.bppBagiA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666; ${bgTabelKolom(value.bppBagiBx)}" class="number">${cleanStr(value.bppBagiB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.bppBagiSadapA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666; ${bgTabelKolom(value.bppBagiSadapBx)}" class="number">${cleanStr(value.bppBagiSadapB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.bppSadapA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666; ${bgTabelKolom(value.bppSadapBx)}" class="number">${cleanStr(value.bppSadapB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.bppBangunanPengukurA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666; ${bgTabelKolom(value.bppBangunanPengukurBx)}" class="number">${cleanStr(value.bppBangunanPengukurB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.bPembawaGorongA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${cleanStr(value.bPembawaGorongB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.bPembawaSiponA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${cleanStr(value.bPembawaSiponB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.bPembawaTalangA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666; ${bgTabelKolom(value.bPembawaTalangBx)}" class="number">${cleanStr(value.bPembawaTalangB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.bPembawaTerjunanA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666; ${bgTabelKolom(value.bPembawaTerjunanBx)}" class="number">${cleanStr(value.bPembawaTerjunanB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.bPembawaGotMiringA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;  ${bgTabelKolom(value.bPembawaGotMiringBx)}" class="number">${cleanStr(value.bPembawaGotMiringB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.blinKribA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666; ${bgTabelKolom(value.blinKribBx)}" class="number">${cleanStr(value.blinKribB)}</td>

						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.blinPelimpahA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${cleanStr(value.blinPelimpahB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.blinSaluranGendongA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666; ${bgTabelKolom(value.blinSaluranGendongBx)}" class="number">${cleanStr(value.blinSaluranGendongB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.blinPelepasTekanA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${cleanStr(value.blinPelepasTekanB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.blinBakKontrolA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${cleanStr(value.blinBakKontrolB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.blinTanggungA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666; ${bgTabelKolom(value.blinTanggungBx)}" class="number">${cleanStr(value.blinTanggungB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.blinPerkuatanTebingA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${cleanStr(value.blinPerkuatanTebingB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.balengJalanInspeksiA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666; ${bgTabelKolom(value.balengJalanInspeksiBx)}" class="number">${cleanStr(value.balengJalanInspeksiB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.balengJembatanA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666; ${bgTabelKolom(value.balengJembatanBx)}" class="number">${cleanStr(value.balengJembatanB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.balengKantorPengamatA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${cleanStr(value.balengKantorPengamatB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.balengGudangA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666; ${bgTabelKolom(value.balengGudangBx)}" class="number">${cleanStr(value.balengGudangB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.balengRumahJagaA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${cleanStr(value.balengRumahJagaB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.balengSanggarTaniA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${cleanStr(value.balengSanggarTaniB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.balengTampunganA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${cleanStr(value.balengTampunganB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.saranaPintuAirA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${cleanStr(value.saranaPintuAirB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.saranaControlValveA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${cleanStr(value.saranaControlValveB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.saranaAlatUkurA)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${cleanStr(value.saranaAlatUkurB)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(totalNilaiKondisi)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="number">${cleanStr(totalNilai)}</td>
						<td id="laBaku_50581" style="border: thin solid #006666;" class="">${cleanStr(value.keterangan)}</td>

						</tr>`;

						warnaAwal = (warnaAwal == '#F7ECDE') ? '#FFF' : '#F7ECDE';
						no++;
					} catch (err) {
						console.error('Error saat looping tabel:', err);
					}
				}

				$('#tbody_data').html(tableConten);

			} catch (err) {
				console.error('Error:', err);
			}
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

			if (priveXX == 'admin') {
				if (kotakabid == null || kotakabid == '') {
					toastr.error('Pilih kabupaten kota terlebih dahulu')
					return;
				}
			}


			getDataTabel(null, provid, kotakabid)


		}



		$('#rowpage').change(function() {
			getDataTabel(null)

		});


		$('#prov').change(function() {
			var prov = $(this).val();

			$('.select2_Irigasi').val(null).trigger('change');


			ajaxUntukSemua(base_url()+'IndexKinerja4E/getDataKabKota', {prov}, function(data) {

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
				url: base_url() + "IndexKinerja4E/getDi",
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