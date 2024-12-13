<?php
function selectSongs() {
    try {
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT c.group_name, COUNT(s.song_id) AS count_songs 
                                FROM `Songs` s 
                                JOIN `IdolGroups` c ON c.group_id = s.group_id 
                                GROUP BY c.group_name");
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
