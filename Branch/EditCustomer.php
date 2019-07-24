<?php include_once("header.php");?>
<?php
    if (isset($_POST['UpdateCustomer'])) {
        
        $ErrorCount =0;
        $Customer = $mysql->select("select * from _tbl_customers where  CreatedByID='".$_SESSION['User']['BranchID']."' and CustomerCode='".$_GET['CusCode']."'");
        if (sizeof($Customer)==0) {
          $errorMessage = "Invlaid Customer";  
          $ErrorCount++;
        }
        $duplicate= $mysql->select("select * from  _tbl_customers where MobileNumber='".$_POST['MobileNumber']."' and CustomerCode<>'".$_GET['CusCode']."'");
        if (sizeof($duplicate)>0) {
             $ErrMobileNumber="Mobile Number Already Exists";    
             $ErrorCount++;
        }
        $duplicate= $mysql->select("select * from  _tbl_customers where EmailID='".$_POST['EmailID']."' and CustomerCode<>'".$_GET['CusCode']."'");
        if (sizeof($duplicate)>0) {
             $ErrEmailID="Email ID Already Exists";    
             $ErrorCount++;
        }
        if ($ErrorCount==0) {
            
        $CustomerID= $mysql->execute("update _tbl_customers set CustomerName='".$_POST['CustomerName']."',
                                                               MobileNumber='".$_POST['MobileNumber']."', 
                                                               EmailID='".$_POST['EmailID']."', 
                                                               EmailID='".$_POST['EmailID']."', 
                                                               AddressLine1='".$_POST['AddressLine1']."', 
                                                               AddressLine2='".$_POST['AddressLine2']."', 
                                                               AddressLine3='".$_POST['AddressLine3']."', 
                                                               PinCode='".$_POST['PinCode']."'
                                                               where CustomerCode= '".$_GET['CusCode']."'");
        $successMessage = "Customer information has been updated successfully";
        } else {
            $errorMessage = "Some error occured, couldn't be update customer information.";
        }
    }
    $Customer = $mysql->select("select * from _tbl_customers where  CreatedByID='".$_SESSION['User']['BranchID']."' and CustomerCode='".$_GET['CusCode']."'");
?>
<script>
$(document).ready(function () {
  $("#MobileNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrMobileNumber").html("Digits Only").fadeIn("slow");
               return false;
    }
   });
   });

             function submitCustomerDetails() {
                 
                        $('#ErrCustomerName').html("");
                        $('#ErrMobileNumber').html("");
                        $('#ErrEmailID').html("");
                        
                        ErrorCount = 0;
                        
                        if(IsNonEmpty("CustomerName", "ErrCustomerName", "Please Enter Customer Name")) {
                            IsAlphaNumeric("CustomerName", "ErrCustomerName", "Please Enter AlphaNumeric Characters Only"); 
                        }
                        
                        if(IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter MobileNumber")) {
                            IsMobileNumber("MobileNumber","ErrMobileNumber","Please Enter Valid MobileNumber");
                        }  
                        
                        if(IsNonEmpty("EmailID", "ErrEmailID", "Please Enter Email Address")) {
                            IsEmail("EmailID", "ErrEmailID", "Please Enter valid  Email Address"); 
                        }        
                        if (ErrorCount == 0) {
                            return true;
                        } else {
                            return false;
                        }
                    }
</script>
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Edit Customer</div>
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
                                        <form method="post" action="" onsubmit="return submitCustomerDetails();">
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-2" style="text-align:left">Customer Code</div>
                                                <div class="col-sm-4">
                                                    <input type="text" disabled="disabled" class="form-control" id="CustomerCode"  name="CustomerCode" placeholder="Enter Customer Code" style="width:100%" value="<?php echo $Customer[0]['CustomerCode'];?>">
                                                    <span class="errorstring" id="ErrCustomerCode"><?php echo isset($ErrCustomerCode)? $ErrCustomerCode : "";?></span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Customer Name<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="CustomerName" name="CustomerName" placeholder="Enter Customer Name" value="<?php echo (isset($_POST['CustomerName']) ? $_POST['CustomerName'] : $Customer[0]['CustomerName']);?>" style="width:100%">
                                                <span class="errorstring" id="ErrCustomerName"><?php echo isset($ErrCustomerName)? $ErrCustomerName : "";?></span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Mobile Number<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                <input type="text" maxlength="10" class="form-control" id="MobileNumber"  name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : $Customer[0]['MobileNumber']);?>" placeholder="Enter Mobile Number" style="width:100%">
                                                <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Email Address<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="EmailID" name="EmailID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : $Customer[0]['EmailID']);?>" placeholder="Enter Email Address" style="width:100%">
                                                <span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID : "";?></span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-2">Address Line 1<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="AddressLine1" name="AddressLine1" value="<?php echo (isset($_POST['AddressLine1']) ? $_POST['AddressLine1'] : $Customer[0]['AddressLine1']);?>" placeholder="Enter Address Line 1" style="width:100%">
                                                <span class="errorstring" id="ErrAddressLine1"><?php echo isset($ErrAddressLine1)? $ErrAddressLine1 : "";?></span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Address Line 2</div>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="AddressLine2" name="AddressLine2" value="<?php echo (isset($_POST['AddressLine2']) ? $_POST['AddressLine2'] : $Customer[0]['AddressLine2']);?>" placeholder="Enter Address Line 2" style="width:100%">
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Address Line 3</div>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="AddressLine3" name="AddressLine3" value="<?php echo (isset($_POST['AddressLine3']) ? $_POST['AddressLine3'] : $Customer[0]['AddressLine3']);?>" placeholder="Enter Address Line 3" style="width:100%">
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-2">Pincode<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" maxlength="6" id="PinCode" value="<?php echo (isset($_POST['PinCode']) ? $_POST['PinCode'] : $Customer[0]['PinCode']);?>"  name="PinCode" placeholder="Enter Pincode" style="width:100%">
                                                <span class="errorstring" id="ErrPinCode"><?php echo isset($ErrPinCode)? $ErrPinCode : "";?></span>
                                                </div>
                                            </div>
                                            <div class="card-action" style="text-align:right">
                                    <button class="btn btn-success" name="UpdateCustomer">Update</button>
                                    <a href="ViewCustomers.php" class="btn btn-danger">Cancel</a>
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