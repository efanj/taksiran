<table style="width: auto;margin: 30px;padding:0;">
    <tr>
        <td style="width:65%;font-size:13px;">
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
        <td>
            <table style="width: auto;">
                <tr>
                    <td style="font-size:13px;">Ruj. Tuan</td>
                    <td style="font-size:13px;">:</td>
                    <td style="font-size:13px;"><?= $data['ruj_pemilik']; ?></td>
                </tr>
                <tr>
                    <td style="font-size:13px;">Ruj. Kami</td>
                    <td style="font-size:13px;">:</td>
                    <td style="font-size:13px;"><?= $data['ruj_pejabat']; ?></td>
                </tr>
                <tr>
                    <td style="font-size:13px;">Tarikh</td>
                    <td style="font-size:13px;">:</td>
                    <td style="font-size:13px;"><?= date("d/m/Y") ?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="2" style="font-size:13px;">Tuan/puan,</td>
    </tr>
    <tr>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="2" style="border-bottom: 1px solid black; font-size:15px;">
            <b><?= $data['perkara']; ?></b>
        </td>
    </tr>
    <tr>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="2" style="font-size:13px;">
            Dengan segala hormatnya perkara di atas dirujuk.<br /><br />
            2. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dimaklumkan bahawa pihak tuan dikenakan permit tahunan <b>RM <?= $data['amt_thnan']; ?></b> bermula <b><?= $data['prmt_tkh_bermula']; ?></b> bagi kelulusan
            Pelan Program Pemutihan Pengubahsuaian Bangunan /Binaan Tambahan Bagi Unit Kediaman. Bayaran permit tersebut perlu dijelaskan sebelum atau pada <b><?= $data['prmt_tkh_sebelum']; ?></b>.
            Resit bayaran hendaklah dikembalikan semula ke Jabatan Kejuruteraan selepas bayaran dibuat.
        </td>
    </tr>
    <tr>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="2" style="font-size:13px;">Sekian harap maklum, Terima kasih </td>
    </tr>
    <tr>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="2" style="font-size:13px;">
            <b>“ WAWASAN KEMAKMURAN BERSAMA 2030”<br />
                “ BRKHIDMAT UNTUK NEGARA”<br />
                “ KAMPAR BANDAR ILMU”</b>
        </td>
    </tr>
    <tr>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="2" style="font-size:13px;">Saya yang menjalankan amanah,</td>
    </tr>
    <tr>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="2" style="font-size:13px;">
            <b>( ROZZILLA BINTI MOHAMAD SOM )</b><br />
            Pegawai Tadbir ( Kejuruteraan )<br />
            Jabatan Kejuruteraan ,

        </td>
    </tr>
    <tr>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="2" style="font-size:15px; font-weight:bold; text-align:center;">“SEJAHTERA RAKYAT PERAK DARUL RIDZUAN”</td>
    </tr>
</table>