<?php 
if(!isset($_SESSION)){
   session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
}

include('instHeader.php');
include_once('../dbconnection.php');

if(isset($_SESSION['is_login'])){
   $stuLogEmail = $_SESSION['stuLogEmail'];
}else{
   echo "<script> location.href='../index.php'; </script>";
}
?>

<div class="col-sm-6 mt-5 mx-3 jumbotron text-dark">
  <div class="row">
   <h3 class="text-center text-light">All Courses</h3>

   <?php
         if(isset($stuLogEmail)){
            $sql = "SELECT * FROM course where author_email = '$stuLogEmail'";    
            $result = $conn->query($sql);
            if($result->num_rows > 0){
               while($row = $result->fetch_assoc()){ ?>
                  <div class="bg-light mb-3">
                  <h5 class="card-header" style="text-transform: uppercase; margin-top: 25px; background-color: #212529; color: #fff;"><?php echo $row['course_name']; ?></h5>
                  <hr/>
                     <div class="row">
                        <div class="col-sm-3">
                           <img src="<?php echo $row['course_img'];?>" class="card-img-top mt-4" alt="pic">
                        </div>
                        <div class="col-sm-6 mb-3">
                           <div class="card-body">
                              <p class="card-title"><?php echo $row['course_desc']; ?></p>
                              <small class="card-text">Duration: <?php echo $row['course_duration']; ?></small><br/>
                              <small class="card-text">Instructon: <?php echo $row['course_author']; ?></small><br/>
                              <p class="card-text d-inline">Price: <small><del>&#8377 <?php echo $row['course_original_price']; ?></del></small>
                              <span class="font-weight-bolder">&#8377 <?php echo $row['course_price']; ?></span></p>
                              <div class="float-right">
                              <a href="alllessons.php?course_id=<?php echo $row['course_id']?>" class="btn btn-dark mt-5">View Lessons</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               <?php
               }
            }
         }
      ?>
   <hr/> 

    
</div>
</div>


<?php  
include('instFooter.php');
?>



