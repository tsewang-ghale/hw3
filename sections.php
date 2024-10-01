<?php
require_once("util-db.php");
require_once("model-instructors.php");
  
$pageTitle = "Sections";
include "view-header.php";
$sections = selectSections();
include "view-sections.php";
include "view-footer.php";
?>
