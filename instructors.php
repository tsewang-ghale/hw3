<?php
require_once("util-db.php");
require_once("model-instructors.php")
  
$pageTitle = "Instructors";
include "view_header.php";
$instructors = selectInstructors();
include "view-instructors.php";
include "view_footer.php";
?>
