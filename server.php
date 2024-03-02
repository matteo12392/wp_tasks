<?php
global $wpdb;
$tasks = "wp_tasks";
if (isset($_POST['save_task'])) {
  $title = $_POST['title'];
  $descr = $_POST['descr'];
  $status = $_POST['status'];
  $wpdb->insert($tasks, array("title" => $title, "descr" => $descr, "status" => $status));
}

if (isset($_POST['move'])) {
  $id = $_POST['id'];
  $newStatus = $_POST['status'];
  $newIndex = $_POST['index'];
  $wpdb->update($tasks, array("status" => $newStatus, "i" => $newIndex), array("id" => $id));
}

if (isset($_POST['del'])) {
  $id = $_POST['id'];
  $wpdb->delete($tasks, array("id" => $id));
}

if (isset($_POST['getId'])) {
  $sql = "SHOW TABLE STATUS LIKE $tasks";
  $res = $wpdb->get_results($sql);
  $id = $res[0]->auto_increment+1;
  wp_send_json_success(array('auto_increment' => $id));
}
