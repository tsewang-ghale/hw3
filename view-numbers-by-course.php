<h1> Numbers by Course </h1>
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
      <th> ID </th>
      <th> Number </th>
      <th> Description </th> 
      <th> Semseter </th> 
      <th> Room </th> 
      <th> Day_Time </th> 
      </tr> 
    </thead>
    <tbody> 
<?php
while ($number= $numbers -> fetch_assoc()){
?>
  <tr>
    <td><?php echo $number['course_id']; ?> </td>
    <td><?php echo $number['course_number']; ?></td>
    <td><?php echo $number['course_description']; ?></td> 
    <td><?php echo $number['semester']; ?></td> 
    <td><?php echo $number['room']; ?></td> 
    <td><?php echo $number['day_time']; ?></td> 
    
  </tr>
<?php
}
?>
    </tbody>
  </table>
</div>
