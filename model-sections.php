<?php
function selectSections() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT section_id, instructor_id, course_id, semester,room, day_time FROM `section`");
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
