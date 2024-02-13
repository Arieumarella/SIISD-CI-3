<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?= base_url(); ?>" class="brand-link">
    <img src="<?= base_url(); ?>assets/admin/favicon.ico" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8">
    <span class="brand-text font-weight-light text-center" >SIISD <br> <font size="-1">(Sistem Informasi Irigasi dan Sungai Daerah)</font></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <br>
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= base_url(); ?>assets/admin/Ite/dist/img/<?= $this->session->userdata('gambar') == null ? 'user.png' : $this->session->userdata('gambar'); ?>" alt="er Image" class="circle elevation-2" style="border-radius: 30%; width: 40px; height: 40px; object-fit: cover; border: 2px solid #fff; box-shadow: 0 0 5px rgba(0, 0, 0, 0.3); margin-top: 10px;">
      </div>
      <div class="info">
        <a href="<?= base_url(); ?>" class="d-block"><?= $this->session->userdata('nama'); ?> <br> <i style="font-size: 15px;"><i class="fa fa-circle text-success" style="font-size:8px;" aria-hidden="true"></i> <?= $this->session->userdata('prive'); ?></i></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2" style="font-size:12px;">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
          <span class="nav-link">
            <a href="/ta">
              <i class="nav-icon far fa-calendar-alt"></i>
            </a>
            <p  class="col-sm-6 p-0 m-0" style="">
              <select class="form-control form-control-sm" id="in_kuTaAktifX">
                <option value="2015" <?= $this->session->userdata('thang') == '2015' ? 'selected' : ''; ?>>2015</option>
                <option value="2016" <?= $this->session->userdata('thang') == '2016' ? 'selected' : ''; ?>>2016</option>                
                <option value="2017" <?= $this->session->userdata('thang') == '2017' ? 'selected' : ''; ?>>2017</option>
                <option value="2018" <?= $this->session->userdata('thang') == '2018' ? 'selected' : ''; ?>>2018</option>
                <option value="2019" <?= $this->session->userdata('thang') == '2019' ? 'selected' : ''; ?>>2019</option>
                <option value="2020" <?= $this->session->userdata('thang') == '2020' ? 'selected' : ''; ?>>2020</option>
                <option value="2021" <?= $this->session->userdata('thang') == '2021' ? 'selected' : ''; ?>>2021</option>
                <option value="2022" <?= $this->session->userdata('thang') == '2022' ? 'selected' : ''; ?>>2022</option>
                <option value="2023" <?= $this->session->userdata('thang') == '2023' ? 'selected' : ''; ?>>2023</option>
                <option value="2024" <?= $this->session->userdata('thang') == '2024' ? 'selected' : ''; ?>>2024</option>
              </select>
            </p>
          </span>
        </li>
        <li class="nav-item">
          <a href="<?= base_url(); ?>Dashboard" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p> Dashboard </p>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="/irigasi" class="nav-link">
            <i class="nav-icon fas fa-water"></i>
            <p>
              Portal Irigasi
            </p>
          </a>
        </li> -->
        
        <?php 


        $arrayDataTeknis = ['FormTeknis', 'FormTeknis1B', 'FormTeknis1C', 'FormTeknis1D', 'FormTeknis1E', 'FormTeknis1F'];
        $uri1 = @$this->uri->segment(1);


        $arrayDataTeknisBase = ['FormTeknis', 'FormTeknis1B', 'FormTeknis1C', 'FormTeknis1D', 'FormTeknis1E', 'FormTeknis1F', 'RealisasiTanam2A', 'RealisasiTanam2B', 'RealisasiTanam2C', 'RealisasiTanam2D', 'RealisasiTanam2E', 'SdmOp3A', 'SdmOp3B', 'IndexKinerja4A', 'IndexKinerja4B', 'IndexKinerja4C', 'IndexKinerja4D', 'IndexKinerja4E', 'SharingAPBD', 'Kelembagaan', 'Form7', 'EPAKSI', 'Form9'];

        ?>

        <li class="nav-item has-treeview <?= (in_array($uri1, $arrayDataTeknisBase)) ? 'menu-open' : ''; ?>" style="#ccc; width:95%;">
          <a href="#" class="nav-link ">
            <i class="nav-icon fas fa-columns"></i>
            <p>
              Form Data Teknis
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview pl-1" style="border-left: thin solid rgb(204, 204, 204); display: <?= (in_array($uri1, $arrayDataTeknisBase)) ? 'block;' : 'none'; ?>;">
            <li class="nav-item has-treeview <?= (in_array($uri1, $arrayDataTeknis)) ? 'menu-open' : ''; ?>">
              <a href="#" class="nav-link">
                <p>
                  1 - Prasarana Fisik                  
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview pl-2" style="border-left: thin solid rgb(204, 204, 204); display: <?= (in_array($uri1, $arrayDataTeknis)) ? 'block;' : 'none'; ?>;">
                <li class="nav-item pl-2 m-0 ">
                  <a href="<?= base_url(); ?>FormTeknis" class="nav-link p-1 m-0  <?= $tittle == '1A' ? 'active' : ''; ?>">
                    <p>1A - Aset D.I.</p>
                  </a>
                </li>
                <li class="nav-item pl-2 m-0 ">
                  <a href="<?= base_url(); ?>FormTeknis1B" class="nav-link p-1 m-0  <?= $tittle == '1B' ? 'active' : ''; ?>">
                    <p>1B - Aset D.I.R</p>
                  </a>
                </li>
                <li class="nav-item pl-2 m-0 ">
                  <a href="<?= base_url(); ?>FormTeknis1C" class="nav-link p-1 m-0 <?= $tittle == '1C' ? 'active' : ''; ?>">
                    <p>1C - Aset D.I.A.T</p></a>
                  </li>
                  <li class="nav-item pl-2 m-0 ">
                    <a href="<?= base_url(); ?>FormTeknis1D" class="nav-link p-1 m-0  <?= $tittle == '1D' ? 'active' : ''; ?>">
                      <p>1D - Aset D.I.T</p>
                    </a>
                  </li>
                  <li class="nav-item pl-2 m-0 "><a href="<?= base_url(); ?>FormTeknis1E" class="nav-link p-1 m-0 <?= $tittle == '1E' ? 'active' : ''; ?> ">
                    <p>1E - Aset D.I.P</p>
                  </a>
                </li>
                <li class="nav-item pl-2 m-0 "><a href="<?= base_url(); ?>FormTeknis1F" class="nav-link p-1 m-0 <?= $tittle == '1F' ? 'active' : ''; ?> ">
                  <p>1F - Progres PAI</p>
                </a>
              </li>
            </ul>
          </li>

          <?php 

          $arrayDataTeknis = ['RealisasiTanam2A', 'RealisasiTanam2B', 'RealisasiTanam2C', 'RealisasiTanam2D', 'RealisasiTanam2E'];
          $uri1 = @$this->uri->segment(1);

          ?>          

          <li class="nav-item has-treeview  <?= (in_array($uri1, $arrayDataTeknis)) ? 'menu-open' : ''; ?>">
            <a href="#" class="nav-link">
              <p>
                2 - Realisasi Tanam                  
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview pl-2" style="border-left: thin solid rgb(204, 204, 204); display: <?= (in_array($uri1, $arrayDataTeknis)) ? 'block;' : 'none'; ?>;">
              <li class="nav-item pl-2 m-0 <?= (in_array($uri1, $arrayDataTeknis)) ? 'menu-open' : ''; ?>">
                <a href="<?= base_url(); ?>RealisasiTanam2A" class="nav-link p-1 m-0  <?= $tittle == '2A' ? 'active' : ''; ?>">
                  <p>2A - RTI D.I</p>
                </a>
              </li>
              <li class="nav-item pl-2 m-0 "><a href="<?= base_url(); ?>RealisasiTanam2B" class="nav-link p-1 m-0  <?= $tittle == '2B' ? 'active' : ''; ?>">
                <p>2B - RT1 D.I.R</p>
              </a>
            </li>
            <li class="nav-item pl-2 m-0 "><a href="<?= base_url(); ?>RealisasiTanam2C" class="nav-link p-1 m-0 <?= $tittle == '2C' ? 'active' : ''; ?>">
              <p>2C - RTI D.I.A.T</p>
            </a>
          </li>
          <li class="nav-item pl-2 m-0 ">
            <a href="<?= base_url(); ?>RealisasiTanam2D" class="nav-link p-1 m-0  <?= $tittle == '2D' ? 'active' : ''; ?>">
              <p>2D - RTI D.I.T</p>
            </a>
          </li>
          <li class="nav-item pl-2 m-0 ">
            <a href="<?= base_url(); ?>RealisasiTanam2E" class="nav-link p-1 m-0  <?= $tittle == '2E' ? 'active' : ''; ?>">
              <p>2E - RTI D.I.P</p>
            </a>
          </li>
        </ul>
      </li>

      

      <?php 

      $arrayDataTeknis = ['SdmOp3A', 'SdmOp3B'];
      $uri1 = @$this->uri->segment(1);

      ?>  

      <li class="nav-item has-treeview <?= (in_array($uri1, $arrayDataTeknis)) ? 'menu-open' : ''; ?>">
        <a href="#" class="nav-link">
          <p>
            3 - SDM OP       
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview pl-2" style="border-left: thin solid rgb(204, 204, 204); display: <?= (in_array($uri1, $arrayDataTeknis)) ? 'block;' : 'none'; ?>;">
          <li class="nav-item pl-2 m-0 <?= (in_array($uri1, $arrayDataTeknis)) ? 'menu-open' : ''; ?>">
            <a href="<?= base_url(); ?>SdmOp3A" class="nav-link p-1 m-0  <?= $tittle == '3A' ? 'active' : ''; ?>">
              <p>3A - SDM OP</p>
            </a>
          </li>
          <li class="nav-item pl-2 m-0 "><a href="<?= base_url(); ?>SdmOp3B" class="nav-link p-1 m-0 <?= $tittle == '3B' ? 'active' : ''; ?>">
            <p>3B - PENUNJ. OP</p>
          </a>
        </li>                
      </ul>
    </li>

    <?php 

    $arrayDataTeknis = ['IndexKinerja4A', 'IndexKinerja4B', 'IndexKinerja4C', 'IndexKinerja4D', 'IndexKinerja4E'];
    $uri1 = @$this->uri->segment(1);

    ?>  

    <li class="nav-item has-treeview <?= (in_array($uri1, $arrayDataTeknis)) ? 'menu-open' : ''; ?>">
      <a href="#" class="nav-link">
        <p>
          4 - Indeks Kinerja       
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview pl-2" style="border-left: thin solid rgb(204, 204, 204); display: <?= (in_array($uri1, $arrayDataTeknis)) ? 'block;' : 'none'; ?>;">
        <li class="nav-item pl-2 m-0 <?= (in_array($uri1, $arrayDataTeknis)) ? 'menu-open' : ''; ?>">
          <a href="<?= base_url(); ?>IndexKinerja4A" class="nav-link p-1 m-0  <?= $tittle == '4A' ? 'active' : ''; ?>">
            <p>4A - DATA KONDISI  D.I</p>
          </a>
        </li>
        <li class="nav-item pl-2 m-0 <?= (in_array($uri1, $arrayDataTeknis)) ? 'menu-open' : ''; ?>">
          <a href="<?= base_url(); ?>IndexKinerja4B" class="nav-link p-1 m-0  <?= $tittle == '4B' ? 'active' : ''; ?>">
            <p>4B - DATA KONDISI  D.I.R</p>
          </a>
        </li>
        <li class="nav-item pl-2 m-0 <?= (in_array($uri1, $arrayDataTeknis)) ? 'menu-open' : ''; ?>">
          <a href="<?= base_url(); ?>IndexKinerja4C" class="nav-link p-1 m-0  <?= $tittle == '4C' ? 'active' : ''; ?>">
            <p>4C - DATA KONDISI  D.I.A.T</p>
          </a>
        </li>
        <li class="nav-item pl-2 m-0 <?= (in_array($uri1, $arrayDataTeknis)) ? 'menu-open' : ''; ?>">
          <a href="<?= base_url(); ?>IndexKinerja4D" class="nav-link p-1 m-0  <?= $tittle == '4D' ? 'active' : ''; ?>">
            <p>4D - DATA KONDISI  D.I.T</p>
          </a>
        </li>
        <li class="nav-item pl-2 m-0 <?= (in_array($uri1, $arrayDataTeknis)) ? 'menu-open' : ''; ?>">
          <a href="<?= base_url(); ?>IndexKinerja4E" class="nav-link p-1 m-0  <?= $tittle == '4E' ? 'active' : ''; ?>">
            <p>4E - DATA KONDISI  D.I.P</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a href="<?= base_url(); ?>SharingAPBD" class="nav-link <?= $tittle == 'Sharing APBD' ? 'active' : ''; ?>">
        <p>5 - Sharing APBD</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="<?= base_url(); ?>Kelembagaan" class="nav-link <?= $tittle == 'kelembagaan' ? 'active' : ''; ?>">
        <p>6 - Kelembagaan</p>
      </a>
    </li>  
    <li class="nav-item">
      <a href="<?= base_url(); ?>Form7" class="nav-link <?= $tittle == 'Form 7' ? 'active' : ''; ?>">
        <p>7 - P3A,GP3A,IP3A</p>
      </a>
    </li>                         
    <li class="nav-item">
      <a href="<?= base_url(); ?>EPAKSI" class="nav-link <?= $tittle == 'Form 8' ? 'active' : ''; ?>">
        <p>8 - e-PAKSI</p>
      </a>
    </li>                          
 
    <li class="nav-item"><a href="<?= base_url(); ?>Form9" class="nav-link <?= $tittle == 'Form 9' ? 'active' : ''; ?>">
      <p>9 - Areal Terdampak dan IKSI</p>
    </a>
  </li>            
</ul>
</li>


<li class="nav-item">
  <a href="<?= base_url(); ?>InfrastrukturPBanjir" class="nav-link <?= $tittle == 'Infrastruktur Pengendali Banjir' ? 'active' : ''; ?>">
    <i class="nav-icon fas fa-th"></i>
    <p>
      Infrastruktur<br/>Pengendalian Banjir
    </p>
  </a>
</li>

<?php 

$uri1 = @$this->uri->segment(1);


$arrayDataTeknisBase = ['TambahDi', 'StsVerifikasiDi'];

?>

<?php if ($this->session->userdata('prive') == 'admin' or $this->session->userdata('prive') == 'pemda') { ?>
  <li class="nav-item has-treeview <?= (in_array($uri1, $arrayDataTeknisBase)) ? 'menu-open' : ''; ?>" style="#ccc; width:95%;">
    <a href="#" class="nav-link ">
      <i class="nav-icon fa fa-plus"></i>
      <p>
        Daerah Irigasi Baru
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview pl-1" style="border-left: thin solid rgb(204, 204, 204); display: <?= (in_array($uri1, $arrayDataTeknisBase)) ? 'block;' : 'none'; ?>;">

      <li class="nav-item">
        <a href="<?= base_url(); ?>StsVerifikasiDi" class="nav-link <?= $tittle == 'Verifikasi DI' ? 'active' : ''; ?>">
          <p>
            <?= $this->session->userdata('prive') == 'admin' ? '1 - Verifikasi Data DI' : '1 - Status Pengajuan'; ?>
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?= base_url(); ?>TambahDi" class="nav-link <?= $tittle == 'Pengajuan DI Baru' ? 'active' : ''; ?>">
          <p>2 - Pengajuan DI Baru</p>
        </a>
      </li> 
    </ul>
  </li>
<?php } ?>

<?php 

$uri1 = @$this->uri->segment(1);


$arrayDataTeknisBase = ['IntegrasiEpaksi', 'KodefikasiDI'];

?>

<?php if ($this->session->userdata('prive') == 'admin') { ?>
  <li class="nav-item has-treeview <?= (in_array($uri1, $arrayDataTeknisBase)) ? 'menu-open' : ''; ?>" style="#ccc; width:95%;">
    <a href="#" class="nav-link ">
      <i class="nav-icon fa fa-random"></i>
      <p>
        Integrasi Data Epaksi
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview pl-1" style="border-left: thin solid rgb(204, 204, 204); display: <?= (in_array($uri1, $arrayDataTeknisBase)) ? 'block;' : 'none'; ?>;">

      <li class="nav-item">
        <a href="<?= base_url(); ?>KodefikasiDI" class="nav-link <?= $tittle == 'Kodefikasi DI' ? 'active' : ''; ?>">
          <p>
           1. - Pengkodean Daerah Irigasi
         </p>
       </a>
     </li>

     <li class="nav-item">
      <a href="<?= base_url(); ?>IntegrasiEpaksi/F1" class="nav-link <?= $tittle == 'Form 1' ? 'active' : ''; ?>">
        <p>
         2. - Form 1
       </p>
     </a>
   </li>

   <li class="nav-item">
    <a href="<?= base_url(); ?>IntegrasiEpaksi/F9" class="nav-link <?= $tittle == 'Form 9' ? 'active' : ''; ?>">
      <p>
       3. - Form 9
     </p>
   </a>
 </li>

 <li class="nav-item">
  <a href="<?= base_url(); ?>IntegrasiEpaksi/F4" class="nav-link <?= $tittle == 'Form 4' ? 'active' : ''; ?>">
    <p>
     4. - Form 4
   </p>
 </a>
</li> 

</ul>
</li>
<?php } ?>

<?php if ($this->session->userdata('prive') == 'admin') { ?>

  <li class="nav-item">
    <a href="<?= base_url(); ?>DataSandingan" class="nav-link <?= $tittle == 'Data Teknis Sandingan' ? 'active' : ''; ?>">
      <i class="nav-icon fa fa-database"></i>
      <p>
        Data Teknis Sandingan
      </p>
    </a>
  </li>

<?php } ?>

<li class="nav-item">
  <a href="<?= base_url(); ?>VerifDataTeknis" class="nav-link <?= $tittle == 'Verifikasi Data Teknis' ? 'active' : ''; ?>">
    <i class="nav-icon fa fa-check"></i>
    <p>
      Verifikasi Data Teknis
    </p>
  </a>
</li>

<li class="nav-item">
  <a href="<?= base_url(); ?>RiwayatPenaganan" class="nav-link <?= $tittle == 'Riwayat Penaganan' ? 'active' : ''; ?>">
    <i class="nav-icon fa fa-history"></i>
    <p>
      Riwayat Penanganan
    </p>
  </a>
</li>


<!-- <li class="nav-item">
  <a href="<?= base_url(); ?>Pengusulan" class="nav-link <?= $tittle == 'Pengusulan' ? 'active' : ''; ?>">
    <i class="nav-icon fa fa-list-alt"></i>
    <p>
      Pengusulan Pekerjaan
    </p>
  </a>
</li> -->

<!-- <li class="nav-item">
  <a href="#" class="nav-link ">
    <i class="nav-icon fa fa-history"></i>
    <p> Riwayat Penanganan </p>
  </a>
</li> -->


<?php 

$uri1 = @$this->uri->segment(1);


$arrayDataTeknisBase = ['Profile', 'DataUser'];

?>


<li class="nav-item has-treeview <?= (in_array($uri1, $arrayDataTeknisBase)) ? 'menu-open' : ''; ?>" style="#ccc; width:95%;">
  <a href="#" class="nav-link ">
    <i class="nav-icon fas fa-users"></i>
    <p>
      Manajemen Pengguna
      <i class="fas fa-angle-left right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview pl-1" style="border-left: thin solid rgb(204, 204, 204); display: <?= (in_array($uri1, $arrayDataTeknisBase)) ? 'block;' : 'none'; ?>;">

    <li class="nav-item">
      <a href="<?= base_url(); ?>Profile" class="nav-link <?= $tittle == 'Profile' ? 'active' : ''; ?>">
        <p>
         1. - Profile
       </p>
     </a>
   </li>
   <?php if ($this->session->userdata('prive') == 'admin') { ?>
     <li class="nav-item">
      <a href="<?= base_url(); ?>DataUser" class="nav-link <?= $tittle == 'Data User' ? 'active' : ''; ?>">
        <p>
          2. - Data User
        </p>
      </a>
    </li>
  <?php } ?>
</ul>
</li>



</ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
