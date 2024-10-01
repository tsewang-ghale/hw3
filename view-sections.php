<h1> Sections </h1>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
      <th> ID </th>
      <th> Instructor_ID </th> <!-- Corrected typo here -->
      <th>Course_ID </th> 
      <th>Semester </th> 
      <th> Room </th> 
      <th> Day_Time </th> 
      </tr> 
    </thead>
    <tbody> 
<?php
while ($section = $sections -> fetch_assoc()){
?>
  <tr>
    <td><?php echo $section['section_id']; ?> </td>
    <td><?php echo $section['instructor_id']; ?></td>
    <td><?php echo $section['course_id']; ?></td> 
    <td><?php echo $section['semester']; ?></td> 
    <td><?php echo $section['room']; ?></td> 
    <td><?php echo $section['day_time']; ?></td> 
  </tr>
<?php
}
?>
    </tbody>
  </table>
</div>
