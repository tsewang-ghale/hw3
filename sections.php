<?php
require_once("util-db.php");
require_once("model-instructors.php");
  
$pageTitle = "Sections";
include "view-header.php";
$instructors = selectInstructors();
include "view-sections.php";
include "view-footer.php";
?>
