<?php
$info = $this->controller->user->getProfileInfo(Session::getUserId()); ?>
<div id="header" class="page-navbar header-fixed">
  <!-- .navbar-brand -->
  <a href="<?= PUBLIC_ROOT ?>User" class="navbar-brand hidden-xs hidden-sm">
    <img src="<?= PUBLIC_ROOT ?>img/logo.png" width="194px" height="40px" class="logo hidden-xs"
      alt="Majlis Daerah Perak Tengah">
    <img src="<?= PUBLIC_ROOT ?>img/logosm.png" class="logo-sm hidden-lg hidden-md" alt="Majlis Daerah Perak Tengah">
  </a>
  <!-- / navbar-brand -->
  <!-- .no-collapse -->
  <div id="navbar-no-collapse" class="navbar-no-collapse">
    <!-- top left nav -->
    <ul class="nav navbar-nav">
      <li class="toggle-sidebar">
        <a href="#">
          <i class="fa fa-reorder"></i>
          <span class="sr-only">Collapse sidebar</span>
        </a>
      </li>
    </ul>
    <!-- / top left nav -->
    <!-- top right nav -->
    <ul class="nav navbar-nav navbar-right">
      <li>
        <a href="<?= PUBLIC_ROOT . "Login/logOut" ?>">
          <i class="fa fa-power-off"></i>
          <span class="sr-only">Logout</span>
        </a>
      </li>
    </ul>
    <!-- / top right nav -->
  </div>
  <!-- / collapse -->
</div>
<div id="wrapper">
  <aside id="sidebar" class="page-sidebar sidebar-fixed hidden-md hidden-sm hidden-xs">
    <!-- Start .sidebar-inner -->
    <div class="sidebar-inner">
      <!-- Start .sidebar-scrollarea -->
      <div class="sidebar-scrollarea">
        <!--  .sidebar-panel -->
        <div class="sidebar-panel">
          <h5 class="sidebar-panel-title">Profil</h5>
        </div>
        <!-- / .sidebar-panel -->
        <div class="user-info clearfix">
          <img src="<?= $info["image"] ?>" alt="avatar">
          <span class="name"><?= $info["name"] ?></span>
          <div class="btn-group">
            <button type="button" class="btn btn-default btn-xs"><i class="l-basic-gear"></i>
            </button>
            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">Tetapan <span
                class="caret"></span>
            </button>
            <ul class="dropdown-menu right" role="menu">
              <li><a href="<?= PUBLIC_ROOT . "User/profile" ?>"><i class="fa fa-edit"></i>Kemaskini</a>
              </li>
              <li class="divider"></li>
              <li><a href="<?= PUBLIC_ROOT . "Login/logOut" ?>"><i class="fa fa-power-off"></i>Log
                  Keluar</a>
              </li>
            </ul>
          </div>
        </div>
        <!--  .sidebar-panel -->
        <div class="sidebar-panel">
          <h5 class="sidebar-panel-title">Navigasi</h5>
        </div>
        <!-- / .sidebar-panel -->
        <!-- .side-nav -->
        <div class="side-nav">
          <ul class="nav">
            <li><a href="<?= PUBLIC_ROOT ?>User"><i class="l-basic-laptop"></i><span class="txt">Laman Utama</span></a>
            </li>
            <?php if (Session::getUserRole() != "vendor") { ?>
            <li>
              <a href="#"><i class="l-software-layers2"></i> <span class="txt">Penilaian</span></a>
              <ul class="sub">
                <li>
                  <a href="#"><span class="txt">Selenggara</span></a>
                  <ul class="sub">
                    <li><a href="<?= PUBLIC_ROOT ?>filecode/landuse"><span class="txt">Kegunaan Tanah</span></a></li>
                    <li><a href="<?= PUBLIC_ROOT ?>filecode/landproperty"><span class="txt">Kegunaan HarTanah</span></a>
                    </li>
                    <li><a href="<?= PUBLIC_ROOT ?>filecode/ownertype"><span class="txt">Jenis Pemilik</span></a></li>
                    <li><a href="<?= PUBLIC_ROOT ?>filecode/buildingtypes"><span class="txt">Jenis Bangunan</span></a>
                    </li>
                    <li><a href="<?= PUBLIC_ROOT ?>filecode/buildingstructure"><span class="txt">Struktur
                          Bangunan</span></a></li>
                    <li><a href="<?= PUBLIC_ROOT ?>filecode/message"><span class="txt">Mesej MJP</span></a></li>
                    <li><a href="<?= PUBLIC_ROOT ?>filecode/meeting"><span class="txt">Mesyuarat MJP</span></a></li>
                    <li><a href="<?= PUBLIC_ROOT ?>filecode/annualrate"><span class="txt">Kadar Tahunan</span></a></li>
                    <li><a href="<?= PUBLIC_ROOT ?>filecode/location"><span class="txt">Kawasan</span></a></li>
                  </ul>
                </li>
                <li>
                  <a href="#"><span class="txt">Maklumat Akaun</span></a>
                  <ul class="sub">
                    <li><a href="<?= PUBLIC_ROOT ?>account/newaccount"><span class="txt">Jadual C</span></a></li>
                    <li><a href="<?= PUBLIC_ROOT ?>informations/handleinfo"><span class="txt">Maklumat
                          Pegangan</span></a></li>
                    <li><a href="<?= PUBLIC_ROOT ?>informations/ownerinfo"><span class="txt">Maklumat Pemilik</span></a>
                    </li>
                    <li><a href="<?= PUBLIC_ROOT ?>informations/vendorinfo"><span class="txt">Maklumat
                          Pelanggan</span></a></li>
                  </ul>
                </li>
                <li>
                  <a href="#"><span class="txt">Pemadanan</span></a>
                  <ul class="sub">
                    <li><a href="<?= PUBLIC_ROOT ?>macthing/macthing"><span class="txt">Pemadanan Data</span></a></li>
                    <li><a href="<?= PUBLIC_ROOT ?>macthing/remacthing"><span class="txt">Kemas Kini lokasi</span></a>
                    </li>
                  </ul>
                </li>
                <li><a href="<?= PUBLIC_ROOT ?>informations/sitereview"><span class="txt">Data Semakan</span></a></li>
                <li>
                  <a href="#"><span class="txt">Aras Nilaian</span></a>
                  <ul class="sub">
                    <li><a href="<?= PUBLIC_ROOT ?>vendor/rentbenchmark"><span class="txt">Kadar Sewa</span></a></li>
                    <li><a href="<?= PUBLIC_ROOT ?>vendor/costbenchmark"><span class="txt">Kadar Kos</span></a></li>
                  </ul>
                </li>
                <li>
                  <a href="#"><span class="txt">Pindaan</span></a>
                  <ul class="sub">
                    <li><a href="<?= PUBLIC_ROOT ?>amendment/amendlists"><span class="txt">Senarai Jadual</span></a>
                    </li>
                    <li><a href="<?= PUBLIC_ROOT ?>amendment/reviewlist"><span class="txt">Senarai Nilaian
                          Semula</span></a></li>
                    <li><a href="<?= PUBLIC_ROOT ?>amendment/verifylists"><span class="txt">Pengesahan</span></a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <?php } ?>
            <li>
              <a href="#"><i class="l-basic-sheet-pencil"></i> <span class="txt">Nilaian Semula</span></a>
              <ul class="sub">
                <li><a href="<?= PUBLIC_ROOT ?>filecode/reviewrate"><span class="txt">Kadar Nilaian Semula</span></a>
                </li>
                <?php if (Session::getUserRole() != "vendor") { ?>
                <li><a href="<?= PUBLIC_ROOT ?>amendment/reviewlist"><span class="txt">Senarai Nilaian Semula</span></a>
                </li>
                <li><a href="<?= PUBLIC_ROOT ?>amendment/reviewlist"><span class="txt">Senarai Serahan</span></a></li>
                <?php } ?>
                <?php if (Session::getUserRole() == "administrator" || Session::getUserRole() == "vendor") { ?>
                <li>
                  <a href="#"><span class="txt">Data Semakan</span></a>
                  <ul class="sub">
                    <li><a href="<?= PUBLIC_ROOT ?>informations/handleinfops"><span class="txt">Maklumat
                          Pegangan</span></a></li>
                    <li><a href="<?= PUBLIC_ROOT ?>vendor/sitereview"><span class="txt">Semakan Tapak</span></a></li>
                    <li><a href="<?= PUBLIC_ROOT ?>vendor/submitted"><span class="txt">Data Serahan</span></a></li>
                  </ul>
                </li>
                <li>
                  <a href="#"><span class="txt">Aras Nilaian</span></a>
                  <ul class="sub">
                    <li><a href="<?= PUBLIC_ROOT ?>vendor/rentbenchmark"><span class="txt">Kadar Sewa</span></a>
                    </li>
                    <li><a href="<?= PUBLIC_ROOT ?>vendor/costbenchmark"><span class="txt">Kadar Kos</span></a></li>
                  </ul>
                </li>
                <?php } ?>
              </ul>
            </li>
            <?php if (Session::getUserRole() == "administrator" || Session::getUserRole() == "jurutera") { ?>
            <li>
              <a href="#"><i class="l-basic-pencil-ruler"></i> <span class="txt">Kejuruteraan</span></a>
              <ul class="sub">
                <li><a href="<?= PUBLIC_ROOT ?>Engineering/semaktapak"><span class="txt">Tambahan/Ubahsuai</span></a>
                </li>
                <li>
                  <a href="#"><span class="txt">Pengeluaran Permit</span></a>
                  <ul class="sub">
                    <li><a href="<?= PUBLIC_ROOT ?>Engineering/permit"><span class="txt">Akaun Permit</span></a></li>
                    <li><a href="<?= PUBLIC_ROOT ?>Engineering/notis"><span class="txt">Notis Pengubahsuaian</span></a>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>
            <?php } ?>
            <li>
              <a href="#"><i class="l-ecommerce-graph1"></i> <span class="txt">Pelaporan</span></a>
              <ul class="sub">
                <?php if (Session::getUserRole() != "vendor" || Session::getUserRole() != "jurutera") { ?>
                <li>
                  <a href="#"><span class="txt">Senarai Penilaian</span></a>
                  <ul class="sub">
                    <li><a href="#"><span class="txt">Jadual A</span></a></li>
                    <li><a href="#"><span class="txt">Jadual B</span></a></li>
                    <li><a href=""><span class="txt">Jadual C</span></a></li>
                    <li><a href=""><span class="txt">Semula</span></a></li>
                  </ul>
                </li>
                <li>
                  <a href="#"><span class="txt">Rumusan Penilaian</span></a>
                  <ul class="sub">
                    <li><a href="#"><span class="txt">Jadual B</span></a></li>
                    <li><a href=""><span class="txt">Jadual C</span></a></li>
                    <li><a href=""><span class="txt">Semula</span></a></li>
                  </ul>
                </li>
                <?php } ?>
                <?php if (Session::getUserRole() == "administrator" || Session::getUserRole() == "vendor") { ?>
                <li>
                  <a href="#"><span class="txt">Nilaian Semula</span></a>
                  <ul class="sub">
                    <li><a href="<?= PUBLIC_ROOT ?>report/sitereview"><span class="txt">Semakan Tapak</span></a></li>
                    <li><a href="<?= PUBLIC_ROOT ?>report/approved"><span class="txt">Data Diluluskan</span></a></li>
                    <li><a href="<?= PUBLIC_ROOT ?>report/pending"><span class="txt">Semak Semula</span></a></li>
                  </ul>
                </li>
                <?php } ?>
                <?php if (Session::getUserRole() == "administrator" || Session::getUserRole() == "jurutera") { ?>
                <li>
                  <a href="#"><span class="txt">Kejuruteraan</span></a>
                  <ul class="sub">
                    <li><a href="<?= PUBLIC_ROOT ?>report/laporantaman"><span class="txt">Permit Taman</span></a>
                    </li>
                    <li><a href="<?= PUBLIC_ROOT ?>report/laporantahun"><span class="txt">Permit Tahun</span></a>
                    </li>
                  </ul>
                </li>
                <?php } ?>
              </ul>
            </li>
            <?php if (Session::getUserRole() == "administrator") { ?>
            <li>
              <a href="#"><i class="l-basic-settings"></i> <span class="txt">Ketetapan</span></a>
              <ul class="sub">
                <li><a href="<?= PUBLIC_ROOT ?>Admin/users"><span class="txt">Pengguna</span></a></li>
                <li><a href="<?= PUBLIC_ROOT ?>Admin/elements"><span class="txt">Elemen</span></a></li>
                <li><a href="<?= PUBLIC_ROOT ?>Admin/activity"><span class="txt">Aktiviti Pengguna</span></a></li>
                <li><a href="<?= PUBLIC_ROOT ?>Admin/errorlog"><span class="txt">Error Log</span></a></li>
              </ul>
            </li>
            <?php } ?>
          </ul>
        </div>
        <!-- / side-nav -->
      </div>
      <!-- End .sidebar-scrollarea -->
    </div>
    <!-- End .sidebar-inner -->
  </aside>