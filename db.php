<?php
session_start();

$conn = mysqli_connect(
  'localhost',
  'root',
  'rody1999',
  'php_crud'
) or die(mysqli_error($mysqli));
