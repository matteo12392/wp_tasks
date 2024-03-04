<?php
require_once("classes/lucz_tasks.php");
      
global $wpdb;
$lucz_tasks = new lucz_tasks;
$tasks = "wp_tasks";
if (isset($_POST['create_task'])) {
  $title = $_POST['title'];
  $descr = $_POST['descr'];
  $status = $_POST['status'];
  $index = $_POST['index'];
  $lucz_tasks->createTask($title, $descr, $status, $index);
}
if (isset($_POST['create_col'])) {
  $title = $_POST['title'];
  $descr = $_POST['descr'];
  $index = $_POST['index'];
  $lucz_tasks->createCol($title, $descr, $index);
}
if (isset($_POST['move_task'])) {
  $id = $_POST['id'];
  $newStatus = $_POST['status'];
  $newIndex = $_POST['index'];
  $lucz_tasks->moveTask($id, $newStatus, $newIndex);
}
if (isset($_POST['move_col'])) {
  $id = $_POST['id'];
  $newIndex = $_POST['index'];
  $lucz_tasks->moveCol($id, $newIndex);
}
if (isset($_POST['del'])) {
  $id = $_POST['id'];
  $lucz_tasks->delTask($id);
}
?>