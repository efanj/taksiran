<div class="page-content sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <?php
            $data = $this->controller->engineering->getNoticeYearDetails($fileId);
            // print_r($info);
            ?>
      <div class="row">
        <div class="col-sm-12">
          <div class="panel">
            <div class="panel-heading bg-primary">
              <div class="row align-items-center">
                <div class="col">
                  <h4 class="ml15">NOTIS TAHUNAN</h4>
                </div>
                <!--end col-->
                <div class="col-auto">
                  <div class="btn-group btn-group-sm mt5 mr5">
                    <button type="button" class="btn btn-default" data-id="<?= $fileId; ?>" id="print_notisthn"><i
                        class="glyphicon glyphicon-print"></i> Print</button>
                    <button type="button" class="btn btn-danger" data-id="<?= $fileId; ?>" id="export_notisthn"><i
                        class="glyphicon glyphicon-export"></i> Export</button>
                  </div>
                </div>
                <!--end col-->
              </div>
            </div>
            <div class="panel-body" id="notistahunan">
              <table style="width: auto;margin: 30px;padding:0;">
                <tr>
                  <td style="width:70%;font-size:13px;">
                    <b><?= $data['nmbil']; ?></b><br /><br />
                    <?php
                                        if ($data['adpg1'] != "") {
                                            echo $data['adpg1'] . ",<br/>";
                                        }
                                        if ($data['adpg2'] != "") {
                                            echo $data['adpg2'] . ",<br/>";
                                        }
                                        if ($data['adpg3'] != "") {
                                            echo $data['adpg3'] . ",<br/>";
                                        }
                                        if ($data['adpg4'] != "") {
                                            echo $data['adpg4'];
                                        }
                                        ?>
                  </td>
                  <td style="width:13%;font-size:13px;">
                    Ruj. Tuan</br>
                    Ruj. Kami</br>
                    Tarikh
                  </td>
                  <td style="width:2%;font-size:13px;">
                    :</br>
                    :</br>
                    :
                  </td>
                  <td style="width:15%;font-size:13px;">
                    <?= $data['rujpegthn']; ?></br>
                    <?= $data['rujfilthn']; ?></br>
                    <?= date("d/m/Y", strtotime($data['tknotisthn'])); ?>
                  </td>
                </tr>
                <tr>
                  <td colspan="4" style="font-size:13px;height:50px;">Tuan/puan,</td>
                </tr>
                <tr>
                  <td colspan="4" style="border-bottom: 1px solid black; font-size:15px;">
                    <b><?= $data['perkarathn']; ?></b>
                  </td>
                </tr>
                <tr>
                  <td colspan="4" style="font-size:13px;height:20px;"></td>
                </tr>
                <tr>
                  <td colspan="4" style="font-size:13px;">
                    Dengan segala hormatnya perkara di atas dirujuk.<br /><br />
                    2. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dimaklumkan bahawa pihak tuan dikenakan permit tahunan <b>RM
                      <?= $data['nildedthn']; ?></b> bermula <b><?= $data['tkmulathn']; ?></b> bagi kelulusan
                    Pelan Program Pemutihan Pengubahsuaian Bangunan /Binaan Tambahan Bagi Unit Kediaman. Bayaran permit
                    tersebut perlu dijelaskan sebelum atau pada <b><?= $data['tksblomthn']; ?></b>.
                    Resit bayaran hendaklah dikembalikan semula ke Jabatan Kejuruteraan selepas bayaran dibuat.
                  </td>
                </tr>
                <tr>
                  <td colspan="4" style="font-size:13px;height:50px;">Sekian harap maklum, Terima kasih </td>
                </tr>
                <tr>
                  <td colspan="4" style="font-size:13px;">
                    <!-- <b>“ WAWASAN KEMAKMURAN BERSAMA 2030”<br />
                      “ BERKHIDMAT UNTUK NEGARA”<br />
                      “ KAMPAR BANDAR ILMU”</b> -->
                  </td>
                </tr>
                <tr>
                  <td colspan="4" style="height:20px;"></td>
                </tr>
                <tr>
                  <td colspan="4" style="font-size:13px;">Saya yang menjalankan amanah,</td>
                </tr>
                <tr>
                  <td colspan="2" style="height: 50px;"></td>
                </tr>
                <tr>
                  <td colspan="4" style="font-size:13px;">
                    <b>( ROZZILLA BINTI MOHAMAD SOM )</b><br />
                    Pegawai Tadbir ( Kejuruteraan )<br />
                    Jabatan Kejuruteraan ,

                  </td>
                </tr>
                <tr>
                  <td colspan="4" style="font-size:15px; font-weight:bold; text-align:center;">“SEJAHTERA RAKYAT PERAK
                    DARUL RIDZUAN”</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>