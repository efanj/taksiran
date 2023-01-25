<?php
$info = $this->controller->user->getProfileInfo(Session::getUserId()); ?>
<div id="header" class="header-fixed">
  <!-- #header -->
  <div class="container">
    <a href="#" class="responsive-menu-toggle">
      <i class="fa fa-reorder"></i>
      <span class="sr-only">Open Menu</span>
    </a>
    <a href="<?= PUBLIC_ROOT ?>User" class="logo">
      <img src="<?php echo PUBLIC_ROOT; ?>img/logo/logosm.png" alt="<?= Config::get("WEBSITE_NAME") ?> logo">
    </a>
    <div class="site-nav">
      <ul>
        <li>
          <a href="<?= PUBLIC_ROOT ?>User">Laman Utama</a>
        </li>
        <?php if (Session::getUserRole() != "vendor") { ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Taksiran</a>
          <ul class="dropdown-menu right" role="menu">
            <li class="dropdown-submenu">
              <a tabindex="-1" href="#">Selenggara</a>
              <ul class="dropdown-menu">
                <li><a tabindex="-1" href="<?= PUBLIC_ROOT ?>filecode/landuse">Kegunaan Tanah</a></li>
                <li><a href="<?= PUBLIC_ROOT ?>filecode/landproperty">Kegunaan Harta Tanah</a></li>
                <li><a href="<?= PUBLIC_ROOT ?>filecode/ownertype">Jenis Pemilik</a></li>
                <li><a href="<?= PUBLIC_ROOT ?>filecode/buildingtypes">Jenis Bangunan</a></li>
                <li><a href="<?= PUBLIC_ROOT ?>filecode/buildingstructure">Struktur Bangunan</a></li>
                <li><a href="<?= PUBLIC_ROOT ?>filecode/message">Mesej Mesyuarat MJP</a></li>
                <li><a href="<?= PUBLIC_ROOT ?>filecode/meeting">Selenggara Mesyuarat MJP</a></li>
                <li><a href="<?= PUBLIC_ROOT ?>filecode/annualrate">Kadar Tahunan</a></li>
                <li><a href="<?= PUBLIC_ROOT ?>filecode/location">Mukim / Kawasan / Jalan</a></li>
              </ul>
            </li>
            <li class="dropdown-submenu">
              <a tabindex="-1" href="#">Maklumat Akaun</a>
              <ul class="dropdown-menu">
                <li class="dropdown-submenu">
                <li><a href="<?= PUBLIC_ROOT ?>account/newaccount">Akaun Baru (Jadual C)</a></li>
                <li><a href="<?= PUBLIC_ROOT ?>informations/handleinfo">Maklumat Pegangan</a></li>
                <li><a href="<?= PUBLIC_ROOT ?>informations/ownerinfo">Maklumat Pemilik</a></li>
                <li><a href="<?= PUBLIC_ROOT ?>informations/vendorinfo">Maklumat Pelanggan</a></li>
                <li class="dropdown-submenu">
                  <a tabindex="-1" href="#">Pemadanan</a>
                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="<?= PUBLIC_ROOT ?>macthing/macthing">Pemadanan Data</a></li>
                    <li><a href="<?= PUBLIC_ROOT ?>macthing/remacthing">Kemas Kini lokasi</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="dropdown-submenu">
              <a tabindex="-1" href="#">Data Semakan</a>
              <ul class="dropdown-menu">
                <li><a href="<?= PUBLIC_ROOT ?>informations/sitereview">Semakan Tapak</a></li>
                <li class="dropdown-submenu">
                  <a href="#">Aras Nilaian</a>
                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="<?= PUBLIC_ROOT ?>vendor/rentbenchmark">Kadar Sewa</a></li>
                    <li><a href="<?= PUBLIC_ROOT ?>vendor/costbenchmark">Kadar Kos</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="dropdown-submenu">
              <a tabindex="-1" href="#">Pindaan</a>
              <ul class="dropdown-menu">
                <li><a href="<?= PUBLIC_ROOT ?>amendment/amendlists">Senarai Jadual</a></li>
                <li><a href="<?= PUBLIC_ROOT ?>amendment/reviewlist">Senarai Nilaian Semula</a></li>
                <li><a href="<?= PUBLIC_ROOT ?>amendment/verifylists">Pengesahan</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <?php } ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Nilaian Semula
          </a>
          <ul class="dropdown-menu right" role="menu">
            <li><a href="<?= PUBLIC_ROOT ?>filecode/reviewrate">Kadar Nilaian Semula</a></li>
            <?php if (Session::getUserRole() != "vendor") { ?>
            <li><a href="<?= PUBLIC_ROOT ?>amendment/reviewlist">Senarai Nilaian Semula</a></li>
            <li><a href="<?= PUBLIC_ROOT ?>amendment/reviewlist">Senarai Serahan</a></li>
            <?php } ?>
            <?php if (Session::getUserRole() == "administrator" || Session::getUserRole() == "vendor") { ?>
            <li class="dropdown-submenu">
              <a tabindex="-1" href="#">Data Semakan</a>
              <ul class="dropdown-menu">
                <li><a tabindex="-1" href="<?= PUBLIC_ROOT ?>informations/handleinfops">Maklumat Pegangan</a></li>
                <li class="dropdown-submenu">
                  <a href="#">Aras Nilaian</a>
                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="<?= PUBLIC_ROOT ?>vendor/rentbenchmark">Kadar Sewa</a></li>
                    <li><a href="<?= PUBLIC_ROOT ?>vendor/costbenchmark">Kadar Kos</a></li>
                  </ul>
                </li>
                <li><a href="<?= PUBLIC_ROOT ?>vendor/sitereview">Semakan Tapak</a></li>
                <li><a href="<?= PUBLIC_ROOT ?>vendor/submitted">Data Serahan</a></li>
              </ul>
            </li>
            <?php } ?>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Pelaporan </a>
          <ul class="dropdown-menu right" role="menu">
            <?php if (Session::getUserRole() != "vendor") { ?>
            <li class="dropdown-submenu">
              <a tabindex="-1" href="#">Senarai Penilaian</a>
              <ul class="dropdown-menu">
                <li><a tabindex="-1" href="#">Report</a></li>
                <li><a href="">Report</a></li>
                <li><a href="">Report</a></li>
              </ul>
            </li>
            <li class="dropdown-submenu">
              <a tabindex="-1" href="#">Rumusan Penilaian</a>
              <ul class="dropdown-menu">
                <li><a tabindex="-1" href="#">Report</a></li>
                <li><a href="">Report</a></li>
                <li><a href="">Report</a></li>
              </ul>
            </li>
            <?php } ?>
            <?php if (Session::getUserRole() == "administrator" || Session::getUserRole() == "vendor") { ?>
            <li class="dropdown-submenu">
              <a tabindex="-1" href="#">Nilaian Semula</a>
              <ul class="dropdown-menu">
                <li><a tabindex="-1" href="<?= PUBLIC_ROOT ?>vendor/approved">Data Diluluskan</a></li>
                <li><a href="<?= PUBLIC_ROOT ?>vendor/pending">Semak Semula</a></li>
              </ul>
            </li>
            <?php } ?>
          </ul>
        </li>
        <?php if (Session::getUserRole() != "vendor") { ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Pengurusan </a>
          <ul class="dropdown-menu right" role="menu">
            <li><a href="<?= PUBLIC_ROOT ?>Accounts/">Pengguna</a></li>
            <li><a href="<?= PUBLIC_ROOT ?>Accounts/">Elemen</a></li>
            <li><a href="<?= PUBLIC_ROOT ?>Accounts/">Aktiviti Pengguna</a></li>
            <li><a href="<?= PUBLIC_ROOT ?>Accounts/">Log Ralat</a></li>
          </ul>
        </li>
        <?php } ?>
        <li class="dropdown">
          <a href="#" data-toggle="dropdown">
            <img src="<?= $info["image"] ?>" class="avatar" alt="avatar" /> <?= $info["name"] ?>
          </a>
          <ul class="dropdown-menu right" role="menu">
            <li>
              <div class="user-info clearfix">
                <img src="<?= $info["image"] ?>" alt="avatar" />
                <span class="name"><?= $info["name"] ?></span>
              </div>
            </li>
            <li>
              <a href="<?= PUBLIC_ROOT . "User/profile" ?>" class="split"><i class="fa fa-user"></i> Profile</a>
            </li>
            <li>
              <a href="<?= PUBLIC_ROOT . "Login/logOut" ?>" class="split color-red"><i
                  class="fa fa-power-off color-red"></i> Log
                Keluar</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- / .site-nav -->
  </div>
  <!-- / .container -->
</div>

<div id="wrapper">