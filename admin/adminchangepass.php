<?php 

if(!isset($_SESSION)){
   session_start();
}

include('./admininclude/header.php');
include('../dbconnection.php');


if(isset($_SESSION['is_admin_login'])){
   $adminEmail = $_SESSION['adminLogEmail'];
}else{
   echo "<script> location.href='../index.php'; </script>";
}
$adminEmail = $_SESSION['adminLogEmail'];
if(isset($_REQUEST['adminPassUpdateBtn'])){
    if(($_REQUEST['adminPass'] == "")){
        $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Fill All Fields</div>';
    }else{
        $sql = "SELECT * FROM admin WHERE admin_email='$adminEmail'";
        $result = $conn->query($sql);
        if($result->num_rows == 1){
            $adminPass = $_REQUEST['adminPass'];
            $sql = "UPDATE admin SET admin_pass = '$adminPass' WHERE admin_email = '$adminEmail'";
            if($conn->query($sql) == TRUE){
                $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Updated Successfully</div>';
            }else{
                $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Unable to Update</div>';
            }
        }
    }
 }
 ?>

<div class="col-sm-9 mt-5">
<h3 class="mt-5 bg-dark text-white p-2" style=" border-radius: 10px;">Change Your Password If Require</h3>

    <div class="row">
        <div class="col-sm-6">
            <form class="mt-5 mx-5">
                <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <input type="text" class="form-control" id="inputEmail" value="<?php echo $adminEmail ?>"readonly>
                </div>
                <div class="form-gorup">
                    <label for="inputnewpassword">New Password</label>
                    <input type="text" class="form-control" id="inputnewpassword" Placeholder="New Password" 
                     name="adminPass">
                </div>
                <button type="submit" class="btn btn-danger mr-4 mt-4" name="adminPassUpdateBtn">Update</button>
                <button type="reset" class="btn btn-secondary mt-4">Reset</button>
                <?php if(isset($passmsg)) {echo $passmsg;} ?>
            </form>
        </div>
    </div>
   </div>
   
   </div><!--  div Row close from Header -->
  </div> <!--  div Container fluid-fluid close from header -->



<?php 
include('./admininclude/footer.php');
?>