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
  $wpdb->update($tasks, array("status" => $newStatus), array("id" => $id));
}

if (isset($_POST['del'])) {
  $id = $_POST['id'];
  $wpdb->delete($tasks, array("id" => $id));
}