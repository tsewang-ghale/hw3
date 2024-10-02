<?php
require_once("util-db.php");
require_once("model-numbers-by-course.php");
  
$pageTitle = "Numbers by Course";
include "view-header.php";
$number = selectNumbersByCourse($_POST['cid']);
include "view-numbers-by-course.php";
include "view-footer.php";
?>
