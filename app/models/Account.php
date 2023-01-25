<?php

class Account extends Model
{
  public function generateSiriNo()
  {
    $siriNo = mt_rand(100000, 999999);
    return $siriNo;
  }

  public function checkNull($data)
  {
    if ($data == null or $data == "0") {
      return "-";
    } else {
      return $data;
    }
  }

  public function createAcct(
    $userId,
    $workerId,
    $mjcTkhpl,
    $mjcTkhtk,
    $mjcTkhoc,
    $mjcAkaun,
    $mjcDigit,
    $mjcHsiri,
    $mjcStcbk,
    $mjcOldac,
    $mjcNobil,
    $mjcNolot,
    $mjcBllot,
    $mjcJlkod,
    $kawKwkod,
    $mjcAdpg1,
    $mjcAdpg2,
    $mjcThkod,
    $mjcBgkod,
    $mjcHtkod,
    $mjcStkod,
    $mjcJpkod,
    $mjcCodex,
    $mjcCodey,
    $mjcDiskn,
    $mjcSmpah,
    $mjcNompt,
    $mjcRjfil,
    $mjcPelan,
    $mjcHkmlk,
    $mjcBilpk,
    $mjcRjmmk,
    $mjcLsbgn,
    $mjcLstnh,
    $mjcLsans,
    $mjcSbkod,
    $mjcMesej,
    $mjcNmbil,
    $mjcPlgid,
    $mjcAmtid
  ) {
    $mjcTkhpl = empty($mjcTkhpl) ? null : $mjcTkhpl;
    $mjcTkhtk = empty($mjcTkhtk) ? null : $mjcTkhtk;
    $mjcTkhoc = empty($mjcTkhoc) ? null : $mjcTkhoc;
    $mjcHsiri = empty($mjcHsiri) ? "0" : $mjcHsiri;
    $mjcNsiri = $this->generateSiriNo();
    $mjcAkaun = empty($mjcAkaun) ? "0" : $mjcAkaun;
    $mjcStcbk = empty($mjcStcbk) ? "T" : $mjcStcbk;
    $mjcOldac = empty($mjcOldac) ? null : $mjcOldac;
    $mjcNobil = empty($mjcNobil) ? null : $mjcNobil;
    $mjcNolot = empty($mjcNolot) ? null : $mjcNolot;
    $mjcBllot = empty($mjcBllot) ? "0" : $mjcBllot;
    $mjcJlkod = empty($mjcJlkod) ? "0" : $mjcJlkod;
    $mjcThkod = empty($mjcThkod) ? "0" : $mjcThkod;
    $kawKwkod = empty($kawKwkod) ? "0" : $kawKwkod;
    $mjcAdpg1 = empty($mjcAdpg1) ? null : $mjcAdpg1;
    $mjcAdpg2 = empty($mjcAdpg2) ? null : $mjcAdpg2;
    $mjcBgkod = empty($mjcBgkod) ? "0" : $mjcBgkod;
    $mjcHtkod = empty($mjcHtkod) ? "0" : $mjcHtkod;
    $mjcStkod = empty($mjcStkod) ? "0" : $mjcStkod;
    $mjcJpkod = empty($mjcJpkod) ? "0" : $mjcJpkod;
    $mjcCodex = empty($mjcCodex) ? null : substr($mjcCodex, 0, 15);
    $mjcCodey = empty($mjcCodey) ? null : substr($mjcCodey, 0, 15);
    $mjcDiskn = empty($mjcDiskn) ? "0" : $mjcDiskn;
    $mjcSmpah = empty($mjcSmpah) ? null : $mjcSmpah;
    $mjcNompt = empty($mjcNompt) ? null : $mjcNompt;
    $mjcNilth = null;
    $mjcRjfil = empty($mjcRjfil) ? null : $mjcRjfil;
    $mjcPelan = empty($mjcPelan) ? null : $mjcPelan;
    $mjcHkmlk = empty($mjcHkmlk) ? null : $mjcHkmlk;
    $mjcBilpk = empty($mjcBilpk) ? "0" : $mjcBilpk;
    $mjcRjmmk = empty($mjcRjmmk) ? null : $mjcRjmmk;
    $mjcLsbgn = empty($mjcLsbgn) ? null : floatval($mjcLsbgn);
    $mjcLstnh = empty($mjcLstnh) ? null : floatval($mjcLstnh);
    $mjcLsans = empty($mjcLsans) ? null : floatval($mjcLsans);
    $mjcStatf = null;
    $mjcMesej = empty($mjcMesej) ? null : $mjcMesej;
    $mjcNmbil = empty($mjcNmbil) ? null : $mjcNmbil;
    $mjcPlgid = empty($mjcPlgid) ? null : $mjcPlgid;
    $mjcAmtid = empty($mjcAmtid) ? "0" : $mjcAmtid;
    $mjcDigit = empty($mjcDigit) ? "0" : $mjcDigit;
    $mjcOnama = empty($workerId) ? "0" : $workerId;
    $mjcEtdate = date("Y-m-d");
    $mjcTkpos = null;

    if ($mjcTkhpl != null) {
      $mjcTkhplPg = str_replace("/", "-", $mjcTkhpl);
      $mjcTkhplPg = date("Y-m-d", strtotime($mjcTkhplPg));
    }

    if ($mjcTkhtk != null) {
      $mjcTkhtkPg = str_replace("/", "-", $mjcTkhtk);
      $mjcTkhtkPg = date("Y-m-d", strtotime($mjcTkhtkPg));
    }

    if ($mjcTkhoc != null) {
      $mjcTkhocPg = str_replace("/", "-", $mjcTkhoc);
      $mjcTkhocPg = date("Y-m-d", strtotime($mjcTkhocPg));
    }

    if ($mjcHtkod == "11" || $mjcHtkod == "12" || $mjcHtkod == "13" || $mjcHtkod == "14" || $mjcHtkod == "15" || $mjcHtkod == "28" || $mjcHtkod == "29" || $mjcHtkod == "30" || $mjcHtkod == "31" || $mjcHtkod == "32" || $mjcHtkod == "33" || $mjcHtkod == "34" || $mjcHtkod == "35") {
      // $calcType = "calcland";
      $calcType = "1";
    } else {
      // $calcType = "calcbuilding";
      $calcType = "2";
    }

    $database = Database::openConnection();
    $query = "INSERT INTO data.t_hacmjc ";
    $query .= "(mjc_nsiri, mjc_akaun, mjc_digit, mjc_jlkod, mjc_thkod, mjc_htkod, mjc_jpkod, mjc_bgkod, mjc_stkod, mjc_nmbil, mjc_plgid, mjc_amtid, mjc_adpg1, mjc_tkhoc, ";
    $query .= "mjc_rjfil, mjc_tkhpl, mjc_tkhtk, mjc_nolot, mjc_bllot, mjc_pelan, mjc_nompt, mjc_nilth, mjc_hkmlk, mjc_bilpk, mjc_lsbgn, mjc_lstnh, mjc_lsans, mjc_statf, mjc_hsiri, ";
    $query .= "mjc_onama, mjc_rjmmk, mjc_nobil, mjc_sbkod, mjc_mesej, mjc_stcbk, mjc_adpg2, mjc_smpah, mjc_oldac, mjc_codex, mjc_codey, mjc_diskn, mjc_tkpos, mjc_etdate, mjc_calcty) ";
    $query .= "VALUES (:mjc_nsiri, :mjc_akaun, :mjc_digit, :mjc_jlkod, :mjc_thkod, :mjc_htkod, :mjc_jpkod, :mjc_bgkod, :mjc_stkod, :mjc_nmbil, :mjc_plgid, :mjc_amtid, :mjc_adpg1, :mjc_tkhoc, ";
    $query .= ":mjc_rjfil, :mjc_tkhpl, :mjc_tkhtk, :mjc_nolot, :mjc_bllot, :mjc_pelan, :mjc_nompt, :mjc_nilth, :mjc_hkmlk, :mjc_bilpk, :mjc_lsbgn, :mjc_lstnh, :mjc_lsans, :mjc_statf, :mjc_hsiri, ";
    $query .= ":mjc_onama, :mjc_rjmmk, :mjc_nobil, :mjc_sbkod, :mjc_mesej, :mjc_stcbk, :mjc_adpg2, :mjc_smpah, :mjc_oldac, :mjc_codex, :mjc_codey, :mjc_diskn, :mjc_tkpos, :mjc_etdate, :mjc_calcty) ";

    $database->prepare($query);
    $database->bindValue(":mjc_nsiri", $mjcNsiri);
    $database->bindValue(":mjc_akaun", $mjcAkaun);
    $database->bindValue(":mjc_digit", $mjcDigit);
    $database->bindValue(":mjc_jlkod", $mjcJlkod);
    $database->bindValue(":mjc_thkod", $mjcThkod);
    $database->bindValue(":mjc_htkod", $mjcHtkod);
    $database->bindValue(":mjc_jpkod", $mjcJpkod);
    $database->bindValue(":mjc_bgkod", $mjcBgkod);
    $database->bindValue(":mjc_stkod", $mjcStkod);
    $database->bindValue(":mjc_nmbil", $mjcNmbil);
    $database->bindValue(":mjc_plgid", $mjcPlgid);
    $database->bindValue(":mjc_amtid", $mjcAmtid);
    $database->bindValue(":mjc_adpg1", $mjcAdpg1);
    $database->bindValue(":mjc_tkhoc", $mjcTkhocPg);
    $database->bindValue(":mjc_rjfil", $mjcRjfil);
    $database->bindValue(":mjc_tkhpl", $mjcTkhplPg);
    $database->bindValue(":mjc_tkhtk", $mjcTkhtkPg);
    $database->bindValue(":mjc_nolot", $mjcNolot);
    $database->bindValue(":mjc_bllot", $mjcBllot);
    $database->bindValue(":mjc_pelan", $mjcPelan);
    $database->bindValue(":mjc_nompt", $mjcNompt);
    $database->bindValue(":mjc_nilth", $mjcNilth);
    $database->bindValue(":mjc_hkmlk", $mjcHkmlk);
    $database->bindValue(":mjc_bilpk", $mjcBilpk);
    $database->bindValue(":mjc_lsbgn", $mjcLsbgn);
    $database->bindValue(":mjc_lstnh", $mjcLstnh);
    $database->bindValue(":mjc_lsans", $mjcLsans);
    $database->bindValue(":mjc_statf", $mjcStatf);
    $database->bindValue(":mjc_hsiri", $mjcHsiri);
    $database->bindValue(":mjc_onama", $mjcOnama);
    $database->bindValue(":mjc_rjmmk", $mjcRjmmk);
    $database->bindValue(":mjc_nobil", $mjcNobil);
    $database->bindValue(":mjc_sbkod", $mjcSbkod);
    $database->bindValue(":mjc_mesej", $mjcMesej);
    $database->bindValue(":mjc_stcbk", $mjcStcbk);
    $database->bindValue(":mjc_adpg2", $mjcAdpg2);
    $database->bindValue(":mjc_smpah", $mjcSmpah);
    $database->bindValue(":mjc_oldac", $mjcOldac);
    $database->bindValue(":mjc_codex", $mjcCodex);
    $database->bindValue(":mjc_codey", $mjcCodey);
    $database->bindValue(":mjc_diskn", $mjcDiskn);
    $database->bindValue(":mjc_tkpos", $mjcTkpos);
    $database->bindValue(":mjc_etdate", $mjcEtdate);
    $database->bindValue(":mjc_calcty", $calcType);

    $result = $database->execute();

    if ($database->countRows() !== 1) {
      throw new Exception("Gagal untuk masukkan data jadual c.");
    }

    // if ($result) {
    //   $activity = "Jadual C : No Siri - " . $mjcNsiri;
    //   $database->logActivity($userId, $activity);
    // }

    return ["success" => true, "sirino" => Encryption::encryptId($mjcNsiri), "calctype" => $calcType];
  }

  public function createA($userId, $workerId, $mjaTkhpl, $mjaTkhtk, $mjaAkaun, $mjaDigit, $mjaStatf, $mjaStcbk, $mjaSbkod, $mjaMesej)
  {
    if ($mjaTkhpl != null) {
      $mjaTkhplPg = str_replace("/", "-", $mjaTkhpl);
      $mjaTkhplPg = date("Y-m-d", strtotime($mjaTkhplPg));
    }

    if ($mjaTkhtk != null) {
      $mjaTkhtkPg = str_replace("/", "-", $mjaTkhtk);
      $mjaTkhtkPg = date("Y-m-d", strtotime($mjaTkhtkPg));
    }
    $mjaAkaun = empty($mjaAkaun) ? null : $mjaAkaun;
    $mjaNsiri = $this->generateSiriNo();
    $mjaDigit = empty($mjaDigit) ? 0 : $mjaDigit;
    $mjaStatf = empty($mjaStatf) ? null : $mjaStatf;
    $mjaStcbk = empty($mjaStcbk) ? "T" : $mjaStcbk;
    $mjaSbkod = empty($mjaSbkod) ? null : $mjaSbkod;
    $mjaMesej = empty($mjaMesej) ? null : $mjaMesej;
    $mjaHsiri = "0";
    $mjaTkpos = null;
    $mjaEtdate = date("Y-m-d");

    $database = Database::openConnection();
    $query = "INSERT INTO data.t_hacmja(mja_nsiri, mja_akaun, mja_digit, mja_tkhtk, mja_tkhpl, mja_onama, mja_sbkod, mja_mesej, mja_statf, mja_hsiri, mja_stcbk, mja_tkpos, mja_etdate) ";
    $query .= "VALUES(:mja_nsiri, :mja_akaun, :mja_digit, :mja_tkhtk, :mja_tkhpl, :mja_onama, :mja_sbkod, :mja_mesej, :mja_statf, :mja_hsiri, :mja_stcbk, :mja_tkpos, :mja_etdate)";
    $database->prepare($query);
    $database->bindValue(":mja_nsiri", $mjaNsiri);
    $database->bindValue(":mja_akaun", $mjaAkaun);
    $database->bindValue(":mja_digit", $mjaDigit);
    $database->bindValue(":mja_tkhtk", $mjaTkhtkPg);
    $database->bindValue(":mja_tkhpl", $mjaTkhplPg);
    $database->bindValue(":mja_onama", $workerId);
    $database->bindValue(":mja_sbkod", $mjaSbkod);
    $database->bindValue(":mja_mesej", $mjaMesej);
    $database->bindValue(":mja_statf", $mjaStatf);
    $database->bindValue(":mja_hsiri", $mjaHsiri);
    $database->bindValue(":mja_stcbk", $mjaStcbk);
    $database->bindValue(":mja_tkpos", $mjaTkpos);
    $database->bindValue(":mja_etdate", $mjaEtdate);
    $result = $database->execute();

    if ($database->countRows() !== 1) {
      throw new Exception("Gagal untuk masukkan data hapus.");
    }

    // if ($result) {
    //   $activity = "Jadual A : No akaun - " . $mjaAkaun . " No Siri - " . $mjaNsiri;
    //   $database->logActivity($userId, $activity);
    // }
    return ["success" => true];
  }

  public function createB($userId, $workerId, $mjbTkhpl, $mjbTkhtk, $mjbAkaun, $mjbDigit, $mjbStcbk, $kawKwkod, $mjbThkod, $mjbBgkod, $mjbHtkod, $mjbStkod, $mjbJpkod, $mjbCodex, $mjbCodey, $mjbSbkod, $mjbMesej)
  {
    if ($mjbTkhpl != null) {
      $mjbTkhplPg = str_replace("/", "-", $mjbTkhpl);
      $mjbTkhplPg = date("Y-m-d", strtotime($mjbTkhplPg));
    }

    if ($mjbTkhtk != null) {
      $mjbTkhtkPg = str_replace("/", "-", $mjbTkhtk);
      $mjbTkhtkPg = date("Y-m-d", strtotime($mjbTkhtkPg));
    }

    if ($mjbHtkod == "11" || $mjbHtkod == "12" || $mjbHtkod == "13" || $mjbHtkod == "14" || $mjbHtkod == "15" || $mjbHtkod == "28" || $mjbHtkod == "29" || $mjbHtkod == "30" || $mjbHtkod == "31" || $mjbHtkod == "32" || $mjbHtkod == "33" || $mjbHtkod == "34" || $mjbHtkod == "35") {
      $calcUrl = "calcland";
      $calcType = "1";
    } else {
      $calcUrl = "calcbuilding";
      $calcType = "2";
    }

    $mjbNsiri = $this->generateSiriNo();
    $mjbAkaun = empty($mjbAkaun) ? "0" : $mjbAkaun;
    $mjbDigit = empty($mjbDigit) ? "0" : $mjbDigit;
    $mjbTkhpl = empty($mjbTkhpl) ? null : $mjbTkhplPg;
    $mjaTkhtk = empty($mjbTkhtk) ? null : $mjbTkhtkPg;
    $mjbThkod = empty($mjbThkod) ? "0" : $mjbThkod;
    $mjbBgkod = empty($mjbBgkod) ? "0" : $mjbBgkod;
    $mjbHtkod = empty($mjbHtkod) ? "0" : $mjbHtkod;
    $mjbStkod = empty($mjbStkod) ? "0" : $mjbStkod;
    $mjbJpkod = empty($mjbJpkod) ? "0" : $mjbJpkod;
    $mjbCodex = empty($mjbCodex) ? "0" : $mjbCodex;
    $mjbCodey = empty($mjbCodey) ? "0" : $mjbCodey;
    $mjbSbkod = empty($mjbSbkod) ? null : $mjbSbkod;
    $mjbMesej = empty($mjbMesej) ? null : $mjbMesej;
    $mjbStcbk = empty($mjbStcbk) ? "T" : $mjbStcbk;
    $mjbStatf = null;
    $mjbHsiri = "0";
    $mjbTkpos = null;
    $mjbEtdate = date("Y-m-d");
    $mjbVerify = "0";
    $mjbVnama = null;
    $mjbVfdate = null;

    $database = Database::openConnection();

    $database->getByNoAcct("hvnduk", "peg_akaun", $mjbAkaun);
    $info = $database->fetchAssociative();

    $qry = "INSERT INTO data.coordinates (akaun, plgid, nama, codex, codey, nolot)";
    $qry .= "VALUES(" . $mjbAkaun . ", '" . $info['pmk_plgid'] . "', '" . $info['pmk_nmbil'] . "', " . $mjbCodex . ", " . $mjbCodey . ", '" . $info['peg_nolot'] . "')";
    $database->prepare($qry);
    $database->execute();


    $query = "INSERT INTO data.t_hacmjb(mjb_nsiri, mjb_akaun, mjb_digit, mjb_tkhtk, mjb_tkhpl, mjb_thkod, mjb_htkod, mjb_jpkod, mjb_bgkod, mjb_stkod, mjb_sbkod, mjb_mesej, mjb_statf, ";
    $query .= "mjb_hsiri, mjb_stcbk, mjb_tkpos, mjb_onama, mjb_etdate, mjb_calcty) ";
    $query .= "VALUES(:mjb_nsiri, :mjb_akaun, :mjb_digit, :mjb_tkhtk, :mjb_tkhpl, :mjb_thkod, :mjb_htkod, :mjb_jpkod, :mjb_bgkod, :mjb_stkod, :mjb_sbkod, :mjb_mesej, :mjb_statf, ";
    $query .= ":mjb_hsiri, :mjb_stcbk, :mjb_tkpos, :mjb_onama, :mjb_etdate, :mjb_calcty)";

    $database->prepare($query);
    $database->bindValue(":mjb_nsiri", $mjbNsiri);
    $database->bindValue(":mjb_akaun", $mjbAkaun);
    $database->bindValue(":mjb_digit", $mjbDigit);
    $database->bindValue(":mjb_tkhtk", $mjaTkhtk);
    $database->bindValue(":mjb_tkhpl", $mjbTkhpl);
    $database->bindValue(":mjb_thkod", $mjbThkod);
    $database->bindValue(":mjb_htkod", $mjbHtkod);
    $database->bindValue(":mjb_jpkod", $mjbJpkod);
    $database->bindValue(":mjb_bgkod", $mjbBgkod);
    $database->bindValue(":mjb_stkod", $mjbStkod);
    $database->bindValue(":mjb_sbkod", $mjbSbkod);
    $database->bindValue(":mjb_mesej", $mjbMesej);
    $database->bindValue(":mjb_statf", $mjbStatf);
    $database->bindValue(":mjb_hsiri", $mjbHsiri);
    $database->bindValue(":mjb_stcbk", $mjbStcbk);
    $database->bindValue(":mjb_tkpos", $mjbTkpos);
    $database->bindValue(":mjb_onama", $workerId);
    $database->bindValue(":mjb_etdate", $mjbEtdate);
    $database->bindValue(":mjb_calcty", $calcType);
    $database->execute();

    if ($database->countRows() !== 1) {
      throw new Exception("Gagal untuk masukkan data pindaan.");
    }

    // if($result){
    //     $activity = "Nilaian Semula : No akaun - ". $mjbAkaun ." No Siri - ". $mjbNsiri;
    //     $database->logActivity($userId, $activity);
    // }
    return ["success" => true, "sirino" => Encryption::encryptId($mjbNsiri), "calcUrl" => $calcUrl];
  }

  public function createPS($userId, $workerId, $mjbTkhpl, $mjbTkhtk, $mjbAkaun, $mjbDigit, $mjbStcbk, $kawKwkod, $mjbThkod, $mjbBgkod, $mjbHtkod, $mjbStkod, $mjbJpkod, $mjbSbkod, $mjbMesej)
  {
    if ($mjbTkhpl != null) {
      $mjbTkhplPg = str_replace("/", "-", $mjbTkhpl);
      $mjbTkhplPg = date("Y-m-d", strtotime($mjbTkhplPg));
    }

    if ($mjbTkhtk != null) {
      $mjbTkhtkPg = str_replace("/", "-", $mjbTkhtk);
      $mjbTkhtkPg = date("Y-m-d", strtotime($mjbTkhtkPg));
    }

    if ($mjbHtkod == "11" || $mjbHtkod == "12" || $mjbHtkod == "13" || $mjbHtkod == "14" || $mjbHtkod == "15" || $mjbHtkod == "28" || $mjbHtkod == "29" || $mjbHtkod == "30" || $mjbHtkod == "31" || $mjbHtkod == "32" || $mjbHtkod == "33" || $mjbHtkod == "34" || $mjbHtkod == "35") {
      // $calcType = "calcland";
      $calcType = "1";
    } else {
      // $calcType = "calcbuilding";
      $calcType = "2";
    }

    $mjbNsiri = $this->generateSiriNo();
    $mjbAkaun = empty($mjbAkaun) ? "0" : $mjbAkaun;
    $mjbDigit = empty($mjbDigit) ? "0" : $mjbDigit;
    $mjbTkhpl = empty($mjbTkhpl) ? null : $mjbTkhplPg;
    $mjaTkhtk = empty($mjbTkhtk) ? null : $mjbTkhtkPg;
    $mjbThkod = empty($mjbThkod) ? "0" : $mjbThkod;
    $mjbBgkod = empty($mjbBgkod) ? "0" : $mjbBgkod;
    $mjbHtkod = empty($mjbHtkod) ? "0" : $mjbHtkod;
    $mjbStkod = empty($mjbStkod) ? "0" : $mjbStkod;
    $mjbJpkod = empty($mjbJpkod) ? "0" : $mjbJpkod;
    $mjbSbkod = empty($mjbSbkod) ? null : $mjbSbkod;
    $mjbMesej = empty($mjbMesej) ? null : $mjbMesej;
    $mjbStcbk = empty($mjbStcbk) ? "T" : $mjbStcbk;
    $mjbStatf = null;
    $mjbHsiri = "0";
    $mjbTkpos = null;
    $mjbEtdate = date("Y-m-d");
    $mjbVerify = "0";
    $mjbVnama = null;
    $mjbVfdate = null;

    $database = Database::openConnection();
    $query = "INSERT INTO data.ps_hacmjb(mjb_nsiri, mjb_akaun, mjb_digit, mjb_tkhtk, mjb_tkhpl, mjb_thkod, mjb_htkod, mjb_jpkod, mjb_bgkod, mjb_stkod, mjb_sbkod, mjb_mesej, mjb_statf, ";
    $query .= "mjb_hsiri, mjb_stcbk, mjb_tkpos, mjb_onama, mjb_etdate, mjb_calcty) ";
    $query .= "VALUES(:mjb_nsiri, :mjb_akaun, :mjb_digit, :mjb_tkhtk, :mjb_tkhpl, :mjb_thkod, :mjb_htkod, :mjb_jpkod, :mjb_bgkod, :mjb_stkod, :mjb_sbkod, :mjb_mesej, :mjb_statf, ";
    $query .= ":mjb_hsiri, :mjb_stcbk, :mjb_tkpos, :mjb_onama, :mjb_etdate, :mjb_calcty)";

    $database->prepare($query);
    $database->bindValue(":mjb_nsiri", $mjbNsiri);
    $database->bindValue(":mjb_akaun", $mjbAkaun);
    $database->bindValue(":mjb_digit", $mjbDigit);
    $database->bindValue(":mjb_tkhtk", $mjaTkhtk);
    $database->bindValue(":mjb_tkhpl", $mjbTkhpl);
    $database->bindValue(":mjb_thkod", $mjbThkod);
    $database->bindValue(":mjb_htkod", $mjbHtkod);
    $database->bindValue(":mjb_jpkod", $mjbJpkod);
    $database->bindValue(":mjb_bgkod", $mjbBgkod);
    $database->bindValue(":mjb_stkod", $mjbStkod);
    $database->bindValue(":mjb_sbkod", $mjbSbkod);
    $database->bindValue(":mjb_mesej", $mjbMesej);
    $database->bindValue(":mjb_statf", $mjbStatf);
    $database->bindValue(":mjb_hsiri", $mjbHsiri);
    $database->bindValue(":mjb_stcbk", $mjbStcbk);
    $database->bindValue(":mjb_tkpos", $mjbTkpos);
    $database->bindValue(":mjb_onama", $workerId);
    $database->bindValue(":mjb_etdate", $mjbEtdate);
    $database->bindValue(":mjb_calcty", $calcType);
    $result = $database->execute();

    if ($database->countRows() !== 1) {
      throw new Exception("Gagal untuk masukkan data nilaian semula.");
    }

    // if($result){
    //     $activity = "Nilaian Semula : No akaun - ". $mjbAkaun ." No Siri - ". $mjbNsiri;
    //     $database->logActivity($userId, $activity);
    // }
    return ["success" => true, "sirino" => Encryption::encryptId($mjbNsiri), "calctype" => $calcType];
  }

  public function getAccountInfo($fileId)
  {
    $database = Database::openConnection();
    $query = "SELECT s.*, h.tnh_tnama, b.bgn_bnama, st.stb_snama FROM data.hvnduk s ";
    $query .= "LEFT JOIN data.htanah h ON s.peg_thkod = h.tnh_thkod ";
    $query .= "LEFT JOIN data.hbangn b ON s.peg_bgkod = b.bgn_bgkod ";
    $query .= "LEFT JOIN data.hstbgn st ON s.peg_stkod = st.stb_stkod ";
    $query .= "WHERE s.peg_akaun = :akaun ";
    $database->prepare($query);
    $database->bindValue(":akaun", Encryption::decryptId($fileId));
    $database->execute();

    $info = $database->fetchAssociative();
    return $info;
  }

  public function viewamendAdetail($siriNo)
  {
    $database = Database::openConnection();
    $query = "SELECT a.*, s.*, h.tnh_tnama, b.bgn_bnama, st.stb_snama, sb.acm_sbktr, u.name FROM data.t_hacmja a ";
    $query .= "LEFT JOIN data.hvnduk s ON a.mja_akaun = s.peg_akaun ";
    $query .= "LEFT JOIN data.htanah h ON s.peg_thkod = h.tnh_thkod ";
    $query .= "LEFT JOIN data.hbangn b ON s.peg_bgkod = b.bgn_bgkod ";
    $query .= "LEFT JOIN data.hstbgn st ON s.peg_stkod = st.stb_stkod ";
    $query .= "LEFT JOIN data.hmjacm sb ON a.mja_sbkod = sb.acm_sbkod ";
    $query .= "LEFT JOIN public.users u ON a.mja_onama = u.workerid ";
    $query .= "WHERE a.mja_nsiri = :nsiri ";
    $database->prepare($query);
    $database->bindValue(":nsiri", Encryption::decryptId($siriNo));
    $database->execute();

    $info = $database->fetchAssociative();
    return $info;
  }

  public function viewamendBdetail($siriNo)
  {
    $database = Database::openConnection();
    $query = "SELECT b.*, s.*, h.tnh_tnama, bg.bgn_bnama, st.stb_snama, jp.jpk_jnama, sb.acm_sbktr, u.name FROM data.t_hacmjb b ";
    $query .= "LEFT JOIN data.hvnduk s ON b.mjb_akaun = s.peg_akaun ";
    $query .= "LEFT JOIN data.htanah h ON s.peg_thkod = h.tnh_thkod ";
    $query .= "LEFT JOIN data.hbangn bg ON s.peg_bgkod = bg.bgn_bgkod ";
    $query .= "LEFT JOIN data.hstbgn st ON s.peg_stkod = st.stb_stkod ";
    $query .= "LEFT JOIN data.hmjacm sb ON b.mjb_sbkod = sb.acm_sbkod ";
    $query .= "LEFT JOIN data.hjenpk jp ON b.mjb_jpkod = jp.jpk_jpkod ";
    $query .= "LEFT JOIN public.users u ON b.mjb_onama = u.workerid ";
    $query .= "WHERE b.mjb_nsiri = :nsiri ";
    $database->prepare($query);
    $database->bindValue(":nsiri", Encryption::decryptId($siriNo));
    $database->execute();

    $info = $database->fetchAssociative();
    return $info;
  }

  public function viewamendCdetail($siriNo)
  {
    $database = Database::openConnection();
    $query = "SELECT c.*, h.tnh_tnama, b.bgn_bnama, st.stb_snama FROM data.t_hacmjc c ";
    $query .= "LEFT JOIN data.htanah h ON c.mjc_thkod = h.tnh_thkod ";
    $query .= "LEFT JOIN data.hbangn b ON c.mjc_bgkod = b.bgn_bgkod ";
    $query .= "LEFT JOIN data.hstbgn st ON c.mjc_stkod = st.stb_stkod ";
    $query .= "WHERE c.mjc_nsiri = :nsiri ";
    $database->prepare($query);
    $database->bindValue(":nsiri", Encryption::decryptId($siriNo));
    $database->execute();

    $info = $database->fetchAssociative();
    return $info;
  }

  public function viewamendPSdetail($siriNo)
  {
    $database = Database::openConnection();
    $query = "SELECT ps.*, s.*, v.smk_lsbgn_tmbh, v.smk_lsans_tmbh, h.tnh_tnama, b.bgn_bnama, st.stb_snama FROM data.ps_hacmjb ps ";
    $query .= "LEFT JOIN data.v_semak v ON ps.mjb_akaun = v.smk_akaun ";
    $query .= "LEFT JOIN data.hvnduk s ON ps.mjb_akaun = s.peg_akaun ";
    $query .= "LEFT JOIN data.htanah h ON s.peg_thkod = h.tnh_thkod ";
    $query .= "LEFT JOIN data.hbangn b ON s.peg_bgkod = b.bgn_bgkod ";
    $query .= "LEFT JOIN data.hstbgn st ON s.peg_stkod = st.stb_stkod ";
    $query .= "WHERE ps.mjb_nsiri = :nsiri ";
    $database->prepare($query);
    $database->bindValue(":nsiri", Encryption::decryptId($siriNo));
    $database->execute();

    $info = $database->fetchAssociative();
    return $info;
  }

  public function getSumbangan($jpkod)
  {
    $database = Database::openConnection();

    $query = "SELECT jpk_stcbk ";
    $query .= "FROM data.hjenpk ";
    $query .= "WHERE jpk_jpkod = :jpk_jpkod LIMIT 1";

    $database->prepare($query);
    $database->bindValue(":jpk_jpkod", $jpkod);
    $database->execute();

    $info = $database->fetchAssociative();
    return $info;
  }
}