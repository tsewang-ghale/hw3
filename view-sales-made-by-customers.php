<h1>Sales Made by Customer </h1>
<div class="card-group">
<?php
while ($customer = $customers->fetch_assoc()) {
?>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title"><?php echo $customer['cust_firstname']; ?></h5>
      <p class="card-text">
      <ul class="list-group">
<?php
  $courses = selectCoursesByInstructor($instructor['instructor_id']);
  while ($course = $courses->fetch_assoc()) {
  ?>
    <li class="list-group-item"><?php echo $course['course_number']; ?> - <?php echo $course['semester']; ?> - <?php echo $course['room']; ?> - <?php echo $course['day_time']; ?></li>
  <?php 
    }
  ?>
      </ul>
      </p>
      <p class="card-text"><small class="text-body-secondary">Office: <?php echo $instructor['office_num']; ?></small></p>
    </div>
  </div>
<?php
}
?>
</div>


 
