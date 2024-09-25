<?php
function get_db_connection(){
    // Create connection
    $conn = new mysqli('138.197.17.168', 'tsewangg_hw3user', 'smd19UWCRCN@2001', 'tsewangg_hw3');
    
    // Check connection
    if ($conn->connect_error) {
      return false;
    }
    return $conn;
}
?>
