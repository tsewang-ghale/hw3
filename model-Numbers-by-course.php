<?php
function selectNumbersByCourse($nid) {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT c.course_id, course_number, course_description, semester, room, day_time FROM `course` c join section s on s.course_id= ?");
        $stmt->bind_param("i", $nid);
        $stmt->execute();
        $result = $stmt->get_result();
        $conn->close();
        return $result;
    } catch (Exception $e) {
        $conn->close();
        throw $e;
    }
}
?>
