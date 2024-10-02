<?php
function selectCourses() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT course_id, course_number, course_description FROM `course`");
        $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();
        return $result;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}
function insertCourses($cNumbers, $cDesc) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("INSERT INTO `course` ( `course_number`, `course_description`) VALUES (?, ?)`");
        $stmt->bind_param("ss", $cNumber, $cDesc)
        $success = $stmt->execute(); 
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }

        function updateCourses($cNumbers, $cDesc, $cid) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("UPDATE `course` set `course_number` = ?, `course_description`= ? where course_id= ?`");
        $stmt->bind_param("ssi", $cNumber, $cDesc, $cid)
        $success = $stmt->execute(); 
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
        
        function deleteCourses($cid) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("delete from course where course_id = ?");
        $stmt->bind_param("i",$cid)
        $success = $stmt->execute(); 
        $conn->close();
        return $success;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
?>
