<h1> Instructors </h1>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
      <th> ID </th>
      <th> Name </th>
      <th>Offices </th> 
      </tr> 
    </thead>
    <tbody> 
<?php
while ($instructor= $instructors -> fetch_assoc()){
?>
  <tr>
    <td><?php echo $instructor['instructor_id']; ?> </td>
    <td><?php echo $instructor['instructor_name']; ?></td>
    <td><?php echo $instructor['office_num']; ?></td> 
    <td> <a href = "courses-by-instructor.php?id=<?php echo $instructor['instructor_id']; ?>" >Courses</a></td>
  </tr>
<?php
}
?>
    </tbody>
  </table>
</div>
