<div class="page-content sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <?php
      $info = $this->controller->engineering->getNoticeDetails($fileId);
      //print_r($info);
      ?>
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <div class="row align-items-center">
                <div class="col">
                  <h4 class="ml15">NOTIS PENGUBAHSUAIAN</h4>
                </div>
                <!--end col-->
                <div class="col-auto">
                  <div class="btn-group btn-group-sm mt5 mr5">
                    <button type="button" class="btn btn-default" data-id="<?= $fileId; ?>" id="print_notis"><i
                        class="glyphicon glyphicon-print"></i> Print</button>
                    <button type="button" class="btn btn-danger" data-id="<?= $fileId; ?>" id="print_export"><i
                        class="glyphicon glyphicon-export"></i> Export</button>
                  </div>
                </div>
                <!--end col-->
              </div>
            </div>
            <div class="panel-body" id="notis">
              <table style="margin: 30px;width:auto; font-size: 14px;">
                <tr>
                  <td width="75%" style="font-size:13px;">
                    <b><?= $info['prmt_nmpmk']; ?></b><br />
                    <?php
                    if ($info['prmt_adpg1'] != "") {
                      echo $info['prmt_adpg1'] . ", <br/>";
                    }
                    if ($info['prmt_adpg2'] != "") {
                      echo $info['prmt_adpg2'] . ", <br/>";
                    }
                    if ($info['prmt_adpg3'] != "") {
                      echo $info['prmt_adpg3'] . ", <br/>";
                    }
                    if ($info['prmt_adpg4'] != "") {
                      echo $info['prmt_adpg4'];
                    }
                    ?>
                    <br /><br />
                  </td>
                  <td style="font-size:14px;">
                    Ruj. Kami : <?= $info['rujfil']; ?><br /><br />
                    Tarikh&nbsp;&nbsp;&nbsp; : <?= date("d/m/Y", strtotime($info['tknotis'])); ?>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" style="font-size:14px;">Tuan/puan, <br /><br /></td>
                </tr>
                <tr>
                  <td colspan="2" style="border-bottom: 1px solid black; font-size:15px;"><b>NOTIS PENGUBAHSUAIAN/
                      BINAAN TAMBAHAN BANGUNAN TANPA KELULUSAN BERTULIS DARIPADA YANG DIPERTUA MAJLIS PERBANDARAN TELUK
                      INTAN</b>
                  </td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                </tr>
                <tr>
                  <td colspan="2" style="font-size:14px;">
                    <u><b>BAHAWASANYA</b></u> melalui semakan di tapak dan rekod pegangan menunjukkan bahawa kamu adalah
                    pemilik kediaman tersebut sekarang.<br /><br />
                    <u><b>DAN BAHAWASANYA</b></u> Majlis Daerah Kampar selanjutnya berpuas hati dari siasatan yang
                    dijalankan mendapati bahawa kerja- kerja :<br /><br />
                    <ol>
                      <li><b>PENGUBAHSUAIAN/ BINAAN TAMBAHAN BANGUNAN DIBUAT TANPA KELULUSAN YANG DIPERTUA MAJLIS
                          PERBANDARAN TELUK
                          INTAN; atau</b></li>
                      <li><b>MELENCONG DARI KELULUSAN ASAL YANG TELAH DILULUSKAN OLEH YANG DIPERTUA MAJLIS PERBANDARAN
                          TELUK
                          INTAN</b></li>
                    </ol>
                    <br />
                    dan ini adalah satu perbuatan yang berlawanan dengan seksyen 70 (11) Akta Jalan,Parit & Bangunan
                    1974 / Akta 133 dan boleh apabila disabitkan
                    dikenakan denda bagi kesalahan tidak lebih daripada RM25,000.00 (Ringgit Malaysia :Dua Puluh Lima
                    Ribu sahaja) atau dipenjarakan selama tempoh
                    tidak melebihi 3 (Tiga) tahun atau kedua-duanya.
                    <br /><br />
                    <u><b>SILA AMBIL PERHATIAN</b></u>, kamu dengan ini dikehendaki dalam tempoh <b>14 (Tujuh)</b> hari
                    dari tarikh notis ini disampaikan untuk:
                    <br /><br />
                    <ul>
                      <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>i. Mengemukakan pelan permohonan ubahan tambahan </b></li>
                      <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ii. Menyertai program pemutihan bangunan</b></li>
                      <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>iii. Memberitahu Majlis Perbandaran Teluk Intan secara
                          bertulis dengan
                          segera setelah mematuhi kehendak perenggan (i) tersebut di atas;</b></li>
                    </ul>
                    <br /><br />
                    <u><b>SELANJUTNYA AMBIL PERHATIAN</b></u>, iaitu sekiranya kamu tidak mematuhi kehendak notis ini
                    kamu adalah bersalah dan boleh <b>dikenakan kompaun
                      sebanyak RM 3,000.00 ( Ringgit Malaysia : Tiga Ribu sahaja) bagi kesalahan gagal mematuhi
                      notis</b> serta boleh juga dikenakan tindakan selanjut
                    mengikut undang- undang yang diperuntukkan.
                    <br /><br />
                    Sekian,sila ambil perhatian dan patuhi segera kehendak pentadbiran ini.
                  </td>
                </tr>
                <tr>
                  <td colspan="2" style="height: 20px;"></td>
                </tr>
                <tr>
                  <td colspan=" 2" style="font-size:14px;">
                    <!-- <b>“ WAWASAN KEMAKMURAN BERSAMA 2030”<br />
                      “ BRKHIDMAT UNTUK NEGARA”<br />
                      “ KAMPAR BANDAR ILMU”</b>
                    <br /><br /> -->
                    Saya yang menjalankan amanah,
                  </td>
                </tr>
                <tr>
                  <td colspan="2" style="height: 50px;"></td>
                </tr>
                <tr>
                  <td colspan="2" style="font-size:14px;">
                    <b>( xxxxxxxxxxxxxxxxx )</b><br />
                    Pegawai Tadbir ( Kejuruteraan )<br />
                    Jabatan Kejuruteraan ,

                  </td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>