<?php

class Calculator extends Model
{
  public function escapeJsonString($value)
  {
    # list from www.json.org: (\b backspace, \f formfeed)
    $escapers = ["\""];
    $replacements = [""];
    $result = str_replace($escapers, $replacements, $value);
    return $result;
  }

  public function landSubmit($userId, $workerId, $siriNo, $acctNo, $comparison, $breadth_land, $price_land, $current, $discount, $even, $yearly, $rate, $tax)
  {
    $comparison = empty($comparison) ? null : $comparison;
    $breadth_land = empty($breadth_land) ? 0 : $breadth_land;
    $price_land = empty($price_land) ? 0 : $price_land;
    $discount = empty($discount) ? 0 : $discount;
    $current = empty($current) ? 0 : $current;
    $even = empty($even) ? 0 : $even;
    $yearly = empty($yearly) ? 0 : $yearly;
    $rate = empty($rate) ? 0 : $rate;
    $tax = empty($tax) ? 0 : $tax;
    $total = $breadth_land * $price_land;
    // $corner = $corner == false ? 0 : 1;
    $calcType = 2;
    $capital = 0;

    $database = Database::openConnection();

    $info = $this->getAccountInfo($siriNo);

    $land = "INSERT INTO data.items_land(siri_no, breadth, price, total) values ('" . $siriNo . "', " . $breadth_land . ", " . $price_land . ", " . $total . ")";
    $database->prepare($land);
    $database->execute();
    $land_id = $database->lastInsertedId();

    if ($comparison != null) {
      $comparison = $this->escapeJsonString(str_replace(["[", "]"], ["{", "}"], json_encode($comparison)));
    } else {
      $comparison = $comparison;
    }

    $query = "INSERT INTO data.calculator(calc_type, siri_no, account_no, comparison, land, bmain, bout, capital, discount, rental, yearly_price, even, rate, assessment_tax) ";
    $query .= "VALUES(" . $calcType . ", '" . $siriNo . "', " . $acctNo . ", '" . $comparison . "', '" . $land_id . "', null, ";
    $query .= "null, '" . $capital . "', " . $discount . ", '" . $current . "', " . $yearly . ", " . $even . ", " . $rate . ", " . $tax . ")";
    $database->prepare($query);
    $result = $database->execute();

    if ($result) {
      if ($info['form'] == "B") {
        $update = "UPDATE data.t_hacmjb SET mjb_nilth = " . $info['peg_nilth'] . ", mjb_bnilt = " . $yearly . " WHERE mjb_nsiri = '" . $siriNo . "'";
      } else if ($info['form'] == "C") {
        $update = "UPDATE data.t_hacmjc SET mjc_nilth = " . $yearly . " WHERE mjc_nsiri = '" . $siriNo . "'";
      } else if ($info['form'] == "PS") {
        $update = "UPDATE data.t_hacmjb SET mjb_nilth = " . $info['peg_nilth'] . ", mjb_bnilt = " . $yearly . " WHERE mjb_nsiri = '" . $siriNo . "'";
      }
      $database->prepare($update);
      $database->execute();
    }

    // if ($result) {
    //   $activity = "Pengiraan Nilaian : No Siri - " . $siriNo;
    //   $database->logActivity($userId, $activity);
    // }

    return true;
  }

  public function buildingSubmit($userId, $workerId, $siriNo, $acctNo, $comparison, $breadth_land, $price_land, $section_one, $section_two, $discount, $rental, $even, $yearly, $rate, $tax)
  {
    $comparison = empty($comparison) ? null : $comparison;
    $breadth_land = empty($breadth_land) ? 0 : $breadth_land;
    $price_land = empty($price_land) ? 0 : $price_land;
    $discount = empty($discount) ? 0 : $discount;
    $rental = empty($rental) ? 0 : $rental;
    $even = empty($even) ? 0 : $even;
    $yearly = empty($yearly) ? 0 : $yearly;
    $rate = empty($rate) ? 0 : $rate;
    $tax = empty($tax) ? 0 : $tax;
    $total = $breadth_land * $price_land;
    // $corner = $corner == false ? 0 : 1;
    $calcType = 2;
    $capital = 0;
    $sectionsOne_id = "";
    $sectionsTwo_id = "";

    $database = Database::openConnection();

    $info = $this->getAccountInfo($siriNo);

    $land = "INSERT INTO data.items_land(siri_no, breadth, price, total) values ('" . $siriNo . "', " . $breadth_land . ", " . $price_land . ", " . $total . ")";
    $database->prepare($land);
    $database->execute();
    $land_id = $database->lastInsertedId();

    $itemsOne_id = [];
    $itemsOne_sum = [];
    foreach ($section_one as $val) {
      if ($val["main_title"] != "") {
        $sectionOne = "INSERT INTO data.section(section_type, siri_no, title) values (1,'" . $siriNo . "','" . $val["main_title"] . "')";
        $database->prepare($sectionOne);
        $database->execute();
        $sectionsOne_id = $database->lastInsertedId();
      }
      if ($sectionsOne_id == null || $sectionsOne_id == "") {
        $sectionsOne_id = 0;
      } else {
        $sectionsOne_id = $sectionsOne_id;
      }
      foreach ($val['item'] as $value) {
        $breadth_one = empty($value["breadth_one"]) ? 0 : $value["breadth_one"];
        $price_one = empty($value["price_one"]) ? 0 : $value["price_one"];
        $total_one = empty($value["total_one"]) ? 0 : $value["total_one"];

        $sql = "INSERT INTO data.items_main(section_id, siri_no, title, breadth, breadthtype, price, pricetype, total) values ";
        $sql .= "(" . $sectionsOne_id . ",'" . $siriNo . "','" . $value["title_one"] . "'," . $breadth_one . ",'" . $value["breadthtype_one"] . "'," . $price_one . ",'" . $value["pricetype_one"] . "'," . $total_one . ")";
        $database->prepare($sql);
        $database->execute();
        $itemsOne_id[] = $database->lastInsertedId();
        $itemsOne_sum[] = $value["total_one"];
      }
    }

    $itemsTwo_id = [];
    $itemsTwo_sum = [];
    foreach ($section_two as $val) {
      if ($val["external_title"] != "") {
        $sectionTwo = "INSERT INTO data.section(section_type, siri_no, title) values (2,'" . $siriNo . "','" . $val["external_title"] . "')";
        $database->prepare($sectionTwo);
        $database->execute();
        $sectionsTwo_id = $database->lastInsertedId();
      }
      if ($sectionsTwo_id == null || $sectionsTwo_id == "") {
        $sectionsTwo_id = 0;
      } else {
        $sectionsTwo_id = $sectionsTwo_id;
      }
      foreach ($val['item'] as $value) {
        $breadth_two = empty($value["breadth_two"]) ? 0 : $value["breadth_two"];
        $price_two = empty($value["price_two"]) ? 0 : $value["price_two"];
        $total_two = empty($value["total_two"]) ? 0 : $value["total_two"];

        $query = "INSERT INTO data.items_out(section_id, siri_no, title, breadth, breadthtype, price, pricetype, total) values ";
        $query .= "(" . $sectionsTwo_id . ",'" . $siriNo . "','" . $value["title_two"] . "'," . $breadth_two . ",'" . $value["breadthtype_two"] . "'," . $price_two . ",'" . $value["pricetype_two"] . "'," . $total_two . ")";
        $database->prepare($query);
        $database->execute();
        $itemsTwo_id[] = $database->lastInsertedId();
        $itemsTwo_sum[] = $value["total_two"];
      }
    }

    if ($comparison != null) {
      $comparison = $this->escapeJsonString(str_replace(["[", "]"], ["{", "}"], json_encode($comparison)));
    } else {
      $comparison = $comparison;
    }
    $idItemsOne = $this->escapeJsonString(str_replace(["[", "]"], ["{", "}"], json_encode($itemsOne_id)));
    $idItemsTwo = $this->escapeJsonString(str_replace(["[", "]"], ["{", "}"], json_encode($itemsTwo_id)));

    // $sumItemOne = array_sum($itemsOne_sum);
    // $sumItemTwo = array_sum($itemsTwo_sum);

    $query = "INSERT INTO data.calculator(calc_type, siri_no, account_no, comparison, land, bmain, bout, capital, discount, rental, yearly_price, even, rate, assessment_tax) ";
    $query .= "VALUES(" . $calcType . ", '" . $siriNo . "', " . $acctNo . ", '" . $comparison . "', " . $land_id . ", '" . $idItemsOne . "', '" . $idItemsTwo . "', ";
    $query .= "'" . $capital . "', " . $discount . ", '" . $rental . "', " . $yearly . ", " . $even . ", " . $rate . ", " . $tax . ")";
    $database->prepare($query);
    $result = $database->execute();

    if ($result) {
      if ($info['form'] == "B") {
        $update = "UPDATE data.t_hacmjb SET mjb_nilth = " . $info['peg_nilth'] . ", mjb_bnilt = " . $yearly . " WHERE mjb_nsiri = '" . $siriNo . "'";
      } else if ($info['form'] == "C") {
        $update = "UPDATE data.t_hacmjc SET mjc_nilth = " . $yearly . " WHERE mjc_nsiri = '" . $siriNo . "'";
      } else if ($info['form'] == "PS") {
        $update = "UPDATE data.t_hacmjb SET mjb_nilth = " . $info['peg_nilth'] . ", mjb_bnilt = " . $yearly . " WHERE mjb_nsiri = '" . $siriNo . "'";
      }
      $database->prepare($update);
      $database->execute();
    }

    if ($result) {
      $activity = "Pengiraan Nilaian : No Siri - " . $siriNo;
      $database->logActivity($userId, $activity);
    }

    return true;
  }

  public function buildingEdit($userId, $workerId, $siriNo, $acctNo, $comparison, $breadth_land, $price_land, $section_one, $section_two, $discount, $rental, $even, $yearly, $rate, $tax)
  {
    $comparison = empty($comparison) ? null : $comparison;
    $breadth_land = empty($breadth_land) ? 0 : $breadth_land;
    $price_land = empty($price_land) ? 0 : $price_land;
    $discount = empty($discount) ? 0 : $discount;
    $rental = empty($rental) ? 0 : $rental;
    $even = empty($even) ? 0 : $even;
    $yearly = empty($yearly) ? 0 : $yearly;
    $rate = empty($rate) ? 0 : $rate;
    $tax = empty($tax) ? 0 : $tax;
    $total = $breadth_land * $price_land;
    // $corner = $corner == false ? 0 : 1;
    $calcType = 2;
    $capital = 0;

    $database = Database::openConnection();

    $info = $this->getAccountInfo($siriNo);

    $land = "UPDATE data.items_land SET breadth = " . $breadth_land . ", price = " . $price_land . ", total = " . $total . " WHERE siri_no = '" . $siriNo . "'";
    $database->prepare($land);
    $database->execute();

    foreach ($section_one as $key => $val) {
      if ($val["main_title"] != "") {

        $sectionOne = "UPDATE data.section SET title = '" . $val["main_title"] . "' WHERE siri_no = '" . $siriNo . "' AND id = " . $key;
        $database->prepare($sectionOne);
        $database->execute();

        foreach ($val['item'] as $keyid => $value) {
          $breadth_one = empty($value["breadth_one"]) ? 0 : $value["breadth_one"];
          $price_one = empty($value["price_one"]) ? 0 : $value["price_one"];
          $total_one = empty($value["total_one"]) ? 0 : $value["total_one"];


          $sql = "UPDATE data.items_main SET title='" . $value["title_one"] . "', breadth=" . $breadth_one . ", breadthtype='" . $value["breadthtype_one"] . "', price=" . $price_one . ", pricetype='" . $value["pricetype_one"] . "', total=" . $total_one;
          $sql .= " WHERE siri_no = '" . $siriNo . "' AND id = " . $keyid;
          $database->prepare($sql);
          $database->execute();
        }
      }
    }

    foreach ($section_two as $key => $val) {
      if ($val["external_title"] != "") {
        $breadth_two = empty($value["breadth_two"]) ? 0 : $value["breadth_two"];
        $price_two = empty($value["price_two"]) ? 0 : $value["price_two"];
        $total_two = empty($value["total_two"]) ? 0 : $value["total_two"];

        $sectionTwo = "UPDATE data.section SET title = '" . $val["external_title"] . "' WHERE siri_no = '" . $siriNo . "' AND id = " . $key;
        $database->prepare($sectionTwo);
        $database->execute();

        foreach ($val['item'] as $keyid => $value) {
          $query = "UPDATE data.items_out SET title = '" . $value["title_two"] . "', breadth = " . $breadth_two . ", breadthtype = '" . $value["breadthtype_two"] . "', price = " . $price_two . ", pricetype = '" . $value["pricetype_two"] . "', total = " . $total_two;
          $query .= " WHERE siri_no = '" . $siriNo . "' AND id = " . $keyid;
          $database->prepare($query);
          $database->execute();
        }
      }
    }

    if ($comparison != null) {
      $comparison = $this->escapeJsonString(str_replace(["[", "]"], ["{", "}"], json_encode($comparison)));
    } else {
      $comparison = "{}";
    }

    $query = "UPDATE data.calculator SET comparison = '" . $comparison . "', capital = '" . $capital . "', discount = " . $discount . ", rental = '" . $rental . "', yearly_price = " . $yearly . ", even = " . $even . ", rate = " . $rate . ", assessment_tax = " . $tax;
    $query .= " WHERE siri_no = '" . $siriNo . "'";
    $database->prepare($query);
    $result = $database->execute();

    // if ($result) {
    //   if ($info['form'] == "B") {
    //     $update = "UPDATE data.t_hacmjb SET mjb_nilth = " . $info['peg_nilth'] . ", mjb_bnilt = " . $yearly . " WHERE mjb_nsiri = '" . $siriNo . "'";
    //   } else if ($info['form'] == "C") {
    //     $update = "UPDATE data.t_hacmjc SET mjc_nilth = " . $yearly . " WHERE mjc_nsiri = '" . $siriNo . "'";
    //   } else if ($info['form'] == "PS") {
    //     $update = "UPDATE data.t_hacmjb SET mjb_nilth = " . $info['peg_nilth'] . ", mjb_bnilt = " . $yearly . " WHERE mjb_nsiri = '" . $siriNo . "'";
    //   }
    //   $database->prepare($update);
    //   $database->execute();
    // }

    // if ($result) {
    //   $activity = "Pengiraan Nilaian : No Siri - " . $siriNo;
    //   $database->logActivity($userId, $activity);
    // }

    return true;
  }

  public function getAccountInfo($siriNo)
  {
    $database = Database::openConnection();
    $query = "SELECT h.*, v.form FROM data.v_submitioninfo v ";
    $query .= "LEFT JOIN data.hvnduk h ON v.no_akaun = h.peg_akaun ";
    $query .= "WHERE v.no_siri = :siriNo";
    $database->prepare($query);
    $database->bindValue(":siriNo", $siriNo);
    $database->execute();
    $info = $database->fetchAssociative();

    return $info;
  }

  public function getCalculation($userId, $workerId, $siriNo, $form)
  {
    $database = Database::openConnection();
    $query = "SELECT h.*, v.form FROM data.v_submitioninfo v ";
    $query .= "LEFT JOIN data.hvnduk h ON v.no_akaun = h.peg_akaun ";
    $query .= "WHERE v.no_siri = :siriNo";
    $database->prepare($query);
    $database->bindValue(":siriNo", $siriNo);
    $database->execute();
    $info = $database->fetchAssociative();

    return $info;
  }
}