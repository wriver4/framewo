<?php
require_once dirname($_SERVER['DOCUMENT_ROOT']) . '/config/system.php';
$not->loggedin();
$users = new Users();

if ($dir == 'users' && $page == 'list') {
  $results = $users->get_all_active();
  $list = new UsersList($results, $lang);
  $list->create_table();
}

if ($dir == 'users' && $page == 'view') {
  $id = trim($_GET["id"]);
  $result = $users->get_by_id($id);
  $rname = $result["rname"];
  $prop_result = $users->get_user_properties_by_id($id);
  $prop_id = implode (', ', $prop_result);
  $full_name = $result["full_name"];
  $username = $result["username"];
  $password = $result["password"];
  $email = $result["email"];
  $status = $result["status"];
  $updated_at = $result["updated_at"];
  $created_at = $result["created_at"];
}

if ($dir == 'users' && $page == 'edit') {
  if ($form == "properties"){
    $id = trim($_GET["id"]);
    $result = $users->get_user_properties_by_id($id);
    $prop_id = implode (', ', $result);
  }
  if ($form == "profile"){
    $id = trim($_GET["id"]);
    $result = $users->get_by_id($id);
    $rid = $result["rid"];
    $full_name = $result["full_name"];
    $username = $result["username"];
    $password = $result["password"];
    $email = $result["email"];
    $status = $result["status"];
  }
}

if ($dir == 'users' && $page == 'delete') {
$id = trim($_GET["id"]);
$result = $users->get_by_id($id);
$rid = $result["rname"];
$jdcv = json_decode($result["prop_id"], true);
  if (is_array($jdcv)) {
    $jdvc_s = implode(', ', $jdcv);
    $prop_id = $jdvc_s;
  } else {
    $prop_id = $jdcv;
  }
$full_name = $result["full_name"];
$username = $result["username"];
$password = $result["password"];
$email = $result["email"];
$status = $helper->get_status($result["status"]);
$updated_at = $result["updated_at"];
$created_at = $result["created_at"];
}
