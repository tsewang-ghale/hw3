<h1> Students </h1>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
      <th> ID </th>
      <th> First Name </th>
      <th> Last Name</th> 
      </tr> 
    </thead>
    <tbody> 
<?php
while ($student= $students -> fetch_assoc()){
?>
  <tr>
    <td><?php echo $student['student_id']; ?> </td>
    <td><?php echo $student['student_firstname']; ?></td>
    <td><?php echo $student['student_lastname']; ?></td> 
  </tr>
<?php
}
?>
    </tbody>
  </table>
</div>
