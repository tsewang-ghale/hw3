<?php
require_once("util-db.php");
require_once("model-students.php");
  
$pageTitle = "Students";
include "view-header.php";
$courses = selectStudents();
include "view-students.php";
include "view-footer.php";
?>
