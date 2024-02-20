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
  $move = $_POST['move'];
  $id = $_POST['id'];
  $status = $_POST['status'];
  if($move == "l") $status--;
  else $status++;
  $wpdb->update($tasks, array("status" => $status), array("id" => $id));
}

if (isset($_POST['del'])) {
  $id = $_POST['id'];
  $wpdb->delete($tasks, array("id" => $id));
}