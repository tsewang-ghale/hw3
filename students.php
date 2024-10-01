<?php
require_once("util-db.php");
require_once("model-students.php");
  
$pageTitle = "Students";
include "view-header.php";
$students = selectStudents();
include "view-students.php";
include "view-footer.php";
?>
