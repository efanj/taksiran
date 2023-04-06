<?php
$info = $this->controller->engineering->getNoticeDetails($fileId);
// print_r($info);
?>
<table style="margin: 30px;width:auto;" id="notis">
    <tr>
        <td width="65%" style="font-size:13px;">
            <b><?= $info['prmt_nmpmk']; ?></b><br />
            <?php
            if ($info['prmt_adpg1'] != "") {
                echo $info['prmt_adpg1'] . ", ";
            }
            if ($info['prmt_adpg2'] != "") {
                echo $info['prmt_adpg2'] . ", ";
            }
            if ($info['prmt_adpg3'] != "") {
                echo $info['prmt_adpg3'] . ", ";
            }
            if ($info['prmt_adpg4'] != "") {
                echo $info['prmt_adpg4'];
            }
            ?>
        </td>
        <td>
            <table>
                <tr>
                    <td style="font-size:13px;">Ruj. Kami</td>
                    <td style="font-size:13px;">:</td>
                    <td style="font-size:13px;"><?= $info['rujfil']; ?></td>
                </tr>
                <tr>
                    <td style="font-size:13px;">Tarikh</td>
                    <td style="font-size:13px;">:</td>
                    <td style="font-size:13px;"><?= date("d/m/Y", strtotime($info['tknotis'])); ?></td>
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
        <td colspan="2" style="border-bottom: 1px solid black; font-size:15px;"><b>NOTIS PENGUBAHSUAIAN/ BINAAN TAMBAHAN BANGUNAN TANPA KELULUSAN BERTULIS DARIPADA YANG DIPERTUA MAJLIS DAERAH KAMPAR</b></td>
    </tr>
    <tr>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="2" style="font-size:13px;">
            <u><b>BAHAWASANYA</b></u> melalui semakan di tapak dan rekod pegangan menunjukkan bahawa kamu adalah pemilik kediaman tersebut sekarang.<br /><br />
            <u><b>DAN BAHAWASANYA</b></u> Majlis Daerah Kampar selanjutnya berpuas hati dari siasatan yang dijalankan mendapati bahawa kerja- kerja :<br /><br />
            <ol>
                <li><b>PENGUBAHSUAIAN/ BINAAN TAMBAHAN BANGUNAN DIBUAT TANPA KELULUSAN YANG DIPERTUA MAJLIS DAERAH KAMPAR; atau</b></li>
                <li><b>MELENCONG DARI KELULUSAN ASAL YANG TELAH DILULUSKAN OLEH YANG DIPERTUA MAJLIS DAERAH KAMPAR</b></li>
            </ol>
            <br />
            dan ini adalah satu perbuatan yang berlawanan dengan seksyen 70 (11) Akta Jalan,Parit & Bangunan 1974 / Akta 133 dan boleh apabila disabitkan
            dikenakan denda bagi kesalahan tidak lebih daripada RM25,000.00 (Ringgit Malaysia :Dua Puluh Lima Ribu sahaja) atau dipenjarakan selama tempoh
            tidak melebihi 3 (Tiga) tahun atau kedua-duanya.
            <br /><br />
            <u><b>SILA AMBIL PERHATIAN</b></u>, kamu dengan ini dikehendaki dalam tempoh <b>14 (Tujuh)</b> hari dari tarikh notis ini disampaikan untuk:
            <br /><br />
            <ul>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>i. Mengemukakan pelan permohonan ubahan tambahan </b></li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ii. Menyertai program pemutihan bangunan</b></li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>iii. Memberitahu Majlis Daerah Kampar secara bertulis dengan segera setelah mematuhi kehendak perenggan (i) tersebut di atas;</b></li>
            </ul>
            <br /><br />
            <u><b>SELANJUTNYA AMBIL PERHATIAN</b></u>, iaitu sekiranya kamu tidak mematuhi kehendak notis ini kamu adalah bersalah dan boleh <b>dikenakan kompaun
                sebanyak RM 3,000.00 ( Ringgit Malaysia : Tiga Ribu sahaja) bagi kesalahan gagal mematuhi notis</b> serta boleh juga dikenakan tindakan selanjut
            mengikut undang- undang yang diperuntukkan.
            <br /><br />
            Sekian,sila ambil perhatian dan patuhi segera kehendak pentadbiran ini.
        </td>
    </tr>
    <tr>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan="2" style="font-size:13px;">
            <b>“ WAWASAN KEMAKMURAN BERSAMA 2030”<br />
                “ BRKHIDMAT UNTUK NEGARA”<br />
                “ KAMPAR BANDAR ILMU”</b>
            <br /><br />
            Saya yang menurut perintah,
        </td>
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
</table>

<?php

$htd = new Htmltoword();

$htd->createDoc('#notis','Notis.docx',true);
