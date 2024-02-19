<?php
global $wpdb;

if (isset($_POST['save_task'])) {
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $descr = mysqli_real_escape_string($conn, $_POST['descr']);
  $status = mysqli_real_escape_string($conn, $_POST['status']);
  $query = "INSERT INTO $listTable (title, descr, status) VALUES('$title', '$descr', '$status')";
  mysqli_query($conn, $query);
}

if (isset($_POST['move'])) {
  $move = mysqli_real_escape_string($conn, $_POST['move']);
  $id = mysqli_real_escape_string($conn, $_POST['id']);
  $status = mysqli_real_escape_string($conn, $_POST['status']);
  if($move == "l") $status--;
  else $status++;
  $query = "UPDATE $listTable SET  status = '$status' WHERE id = '$id'";
  mysqli_query($conn, $query);
}

if (isset($_POST['del'])) {
  $id = mysqli_real_escape_string($conn, $_POST['id']);
  $query = "DELETE FROM $listTable WHERE id = '$id'";
  mysqli_query($conn, $query);
}