    <?php include_once("header.php");?>
<?php

if (isset($_POST['ChangePassword'])) {
                    echo "qq";
$getpassword = $mysql->select("select * from _tbl_branches where BranchID='".$_SESSION['User']['BranchID']."'");
 echo "aa";
             if ($getpassword[0]['UserPassword']!=$_POST['CurrentPassword']) {
                 echo "bb";
                 $ErrCurrentPassword="Incorrect Current password"; 
             } 
             if ($getpassword[0]['UserPassword']==$_POST['CurrentPassword']) {
                 $mysql->execute("update _tbl_branches set UserPassword='".$_POST['ConfirmNewPassword']."' where BranchID='".$_SESSION['User']['BranchID']."'");
                $successMessage = "Password changed  successfully";
                unset($_POST);
        } else {
            $errorMessage =  "Some error occured, couldn't be change password";
        }
}

?> 
<script>
     function submitPassword() {
         
                $('#ErrCurrentPassword').html("");
                $('#ErrNewPassword').html("");
                $('#ErrConfirmNewPassword').html("");
                
                ErrorCount = 0;                                                                                               
                
                IsNonEmpty("CurrentPassword", "ErrCurrentPassword", "Please Enter Current Password");
                IsNonEmpty("NewPassword", "ErrNewPassword", "Please Enter New Password");
                IsNonEmpty("ConfirmNewPassword", "ErrConfirmNewPassword", "Please Enter Confirm New Password");
                
                 var password = document.getElementById("NewPassword").value;
                 var confirmPassword = document.getElementById("ConfirmNewPassword").value;
                  if (password != confirmPassword) {
                  ErrorCount++;
                  $('#ErrConfirmNewPassword').html("Passwords do not match.");
                  }

                  return (ErrorCount==0) ? true : false;
    }

</script>
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Change Passwords</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group form-inline">
                                                 <div class="col-md-12"  style="text-align:left">
                                                    <span class="successmessage"><?php echo $successMessage; ?></span>
                                                    <span class="errormessage"><?php echo $errorMessage; ?></span>
                                                 </div>
                                            </div>
                                        <form method="post" action="" onsubmit="return submitPassword();">
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-2" style="text-align:left">Current Password<span id="star">*</span></div>
                                                <div class="col-sm-4">                                                                                                              
                                                    <input type="password" class="form-control" id="CurrentPassword"  name="CurrentPassword" placeholder="Enter Current Password" style="width:100%" value="<?php echo (isset($_POST['CurrentPassword']) ? $_POST['CurrentPassword'] : "");?>">
                                                    <span class="errorstring" id="ErrCurrentPassword"><?php echo isset($ErrCurrentPassword)? $ErrCurrentPassword : "";?></span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">New Password<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                <input type="password" class="form-control" id="NewPassword" name="NewPassword" placeholder="Enter New Password" value="<?php echo (isset($_POST['NewPassword']) ? $_POST['NewPassword'] : "");?>" style="width:100%">
                                                <span class="errorstring" id="ErrNewPassword"><?php echo isset($ErrNewPassword)? $ErrNewPassword : "";?></span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Current Password<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                <input type="password" class="form-control" id="ConfirmNewPassword" name="ConfirmNewPassword" placeholder="Enter Confirm Password" value="<?php echo (isset($_POST['ConfirmNewPassword']) ? $_POST['ConfirmNewPassword'] : "");?>" style="width:100%">
                                                <span class="errorstring" id="ErrConfirmNewPassword"><?php echo isset($ErrConfirmNewPassword)? $ErrConfirmNewPassword : "";?></span>
                                                </div>
                                            </div>
                                            <div class="card-action" style="text-align:right">
                                    <button class="btn btn-success" name="ChangePassword">Change Password</button>
                                    <a href="ManageProduct.php" class="btn btn-danger">Cancel</a>
                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php include_once("footer.php");?>