<?php include_once("header.php");?>
<?php
     print_r($_POST);
    if (isset($_POST['btnCreateBranch'])) {
            
        $ErrorCount =0;
            
        $duplicate = $mysql->select("select * from  _tbl_branches where BranchCode='".trim($_POST['BranchCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrBranchCode="Branch Code Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from  _tbl_branches where Username='".trim($_POST['LoginName'])."'");
        if (sizeof($duplicate)>0) {
             $ErrLoginName="Login Name Already Exists";    
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_branches where MobileNumber='".trim($_POST['MobileNumber'])."'");
        if (sizeof($duplicate)>0) {
             $ErrMobileNumber="Mobile Number Already Exists";    
             $ErrorCount++;
        }
       /* if(sizeof($_POST['WhatsappNumber']>0)){
        $duplicate = $mysql->select("select * from  _tbl_branches where WhatsappNumber='".trim($_POST['WhatsappNumber'])."'");
        if (sizeof($duplicate)>0) {
             $ErrWhatsappNumber="Whatsapp Number Already Exists";    
             $ErrorCount++;
        }
        }*/
        $duplicate = $mysql->select("select * from  _tbl_branches where EmailID='".trim($_POST['EmailID'])."'");
        if (sizeof($duplicate)>0) {
             $ErrEmailID="Email ID Already Exists";    
             $ErrorCount++;
        }
        
       if ($ErrorCount==0) {                                                                           
   $Branch = $mysql->insert("_tbl_branches",array("BranchCode"          => trim($_POST['BranchCode']),
                                                  "BranchName"          => trim($_POST['BranchName']),
                                                  "AddressLine1"        => trim($_POST['AddressLine1']),
                                                  "AddressLine2"        => trim($_POST['AddressLine2']),
                                                  "AddressLine3"        => trim($_POST['AddressLine3']),
                                                  "PinCode"             => trim($_POST['Pincode']),
                                                  "PersonName"          => trim($_POST['PersonName']),
                                                  "EmailID"             => trim($_POST['EmailID']),
                                                  "MobileNumber"        => trim($_POST['MobileNumber']),
                                                  "WhatsappNumber"      => trim($_POST['WhatsappNumber']),
                                                  "LandlineNumer"       => trim($_POST['LandLineNumber']),
                                                  "Username"            => trim($_POST['LoginName']),
                                                  "UserPassword"        => trim($_POST['LoginPassword']),
                                                  "CreatedBy"           => "Admin",
                                                  "CreatedByID"         => $_SESSION['User']['AdminID'],
                                                  "CreatedByName"       => $_SESSION['User']['AdminName'],
                                                  "CreatedOn"           => date("Y-m-d H:i:s")));
      if ($Branch>0) {
            $successmessage = "Branch created successfully";
            unset($_POST);
        } else {
            $errorMessage = "Error occured. Couldn't save branch infomration";
        }
    
    }
    echo $errorMessage;
    
    }  
?>
<script>
 $(document).ready(function () {
  $("#MobileNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrMobileNumber").html("Digits Only").fadeIn().fadeIn("slow");
               return false;
    }
   });
  $("#ContactMobileNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrContactMobileNumber").html("Digits Only").fadeIn().fadeIn("slow");
               return false;
    }
   });
  $("#WhatsappNumber").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrWhatsappNumber").html("Digits Only").fadeIn().fadeIn("slow");
               return false;
    }
   });
 });
                    function submitBranchDetails() {
                        $('#ErrBranchCode').html("");
                        $('#ErrBranchName').html("");
                        $('#ErrAddressLine1').html("");
                        $('#ErrPincode').html("");
                        $('#ErrMobileNumber').html("");
                        $('#ErrWhatsappNumber').html("");
                        $('#ErrPersonName').html("");
                        $('#ErrEmailID').html("");
                        $('#ErrLoginPassword').html("");
                        $('#ErrLoginName').html("");
                        
                        ErrorCount = 0;
                        
                        IsNonEmpty("BranchCode", "ErrBranchCode", "Please Enter Valid Branch Code");
                        IsNonEmpty("BranchName", "ErrBranchName", "Please Enter Valid Branch Name");
                        IsNonEmpty("AddressLine1", "ErrAddressLine1", "Please Enter Valid Address");
                        IsNonEmpty("Pincode", "ErrPincode", "Please Enter Valid Pincode");
                        
                        if(IsNonEmpty("EmailID","ErrEmailID","Please Enter EmailID")) {
                            IsEmail("EmailID","ErrEmailID","Please Enter Valid EmailID"); 
                        }
                        
                        if(IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter MobileNumber")) {
                        IsMobileNumber("MobileNumber","ErrMobileNumber","Please Enter Valid MobileNumber");
                        }
                        
                        if(IsNonEmpty("PersonName", "ErrPersonName", "Please Enter Contact Person Name")){
                            IsAlphaNumeric("PersonName", "ErrPersonName", "Please Enter AlphaNumerics Character only");
                        }
                       
                        IsNonEmpty("LoginName", "ErrLoginName", "Please Enter Login Name");
                        IsNonEmpty("LoginPassword", "ErrLoginPassword", "Please Enter Login Password");

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
                                <div class="card-title">Create Branch</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                     <div class="form-group form-inline">
                                                 <div class="col-md-12"  style="text-align:left">
                                                    <span class="successmessage"><?php echo $successmessage; ?></span>
                                                    <span class="errormessage"><?php echo $errorMessage; ?></span>
                                                 </div>
                                            </div>
                                        <form method="POST" action="" onsubmit="return submitBranchDetails()">
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Branch Code<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="BranchCode" name="BranchCode" value="<?php echo isset($_POST['BranchCode']) ? $_POST['BranchCode'] : SeqMaster::GetNextBranchCode();?>" placeholder="Enter Branch Code" style="width:100%">
                                                    <span class="errorstring" id="ErrBranchCode"><?php echo isset($ErrBranchCode)? $ErrBranchCode : "";?></span>
                                                </div>
                                            </div>
                                            <div class="sub-header"  style="border:none;padding-left: 25px;font-weight: bold;background: #f9f9f9;">
                                                <div class="Sub-title">Business Information</div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Branch Name<span id="star">*</span></div>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="BranchName" name="BranchName" value="<?php echo (isset($_POST['BranchName']) ? $_POST['BranchName'] : "");?>" placeholder="Enter Branch Name" style="width:100%">
                                                    <span class="errorstring" id="ErrBranchName"><?php echo isset($ErrBranchName)? $ErrBranchName : "";?></span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Address Line 1<span id="star">*</span></div>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="AddressLine1" name="AddressLine1" value="<?php echo (isset($_POST['AddressLine1']) ? $_POST['AddressLine1'] : "");?>" placeholder="Enter Address Line 1" style="width:100%">
                                                    <span class="errorstring" id="ErrAddressLine1"><?php echo isset($ErrAddressLine1)? $ErrAddressLine1 : "";?> </span>
                                                 </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Address Line 2</div>
                                                <div class="col-sm-10"><input type="text" class="form-control" id="AddressLine2" name="AddressLine2" value="<?php echo (isset($_POST['AddressLine2']) ? $_POST['AddressLine2'] : "");?>" placeholder="Enter Address Line 2" style="width:100%"></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Address Line 3</div>
                                                <div class="col-sm-10"><input type="text" class="form-control" id="AddressLine3" name="AddressLine3" value="<?php echo (isset($_POST['AddressLine3']) ? $_POST['AddressLine3'] : "");?>" placeholder="Enter Address Line 3" style="width:100%"></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-2">Pincode<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="Pincode"  name="Pincode" value="<?php echo (isset($_POST['Pincode']) ? $_POST['Pincode'] : "");?>" placeholder="Enter Pincode" style="width:100%">
                                                 <span class="errorstring" id="ErrPincode"><?php echo isset($ErrPincode)? $ErrPincode : "";?></span>
                                                </div>
                                            </div>
                                            <div class="sub-header"  style="border:none;padding-left: 25px;font-weight: bold;background: #f9f9f9;">
                                                <div class="Sub-title">Primary contact Information</div>
                                            </div>
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-2">Contact Person<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="PersonName"  name="PersonName" value="<?php echo (isset($_POST['PersonName']) ? $_POST['PersonName'] : "");?>" placeholder="Enter Contact Person" style="width:100%">
                                                <span class="errorstring" id="ErrPersonName"><?php echo isset($ErrPersonName)? $ErrPersonName : "";?> </span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                            <div class="col-sm-2">Email Address<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="EmailID" name="EmailID" value="<?php echo (isset($_POST['EmailID']) ? $_POST['EmailID'] : "");?>" placeholder="Enter Email ID" style="width:100%"> 
                                                    <span class="errorstring" id="ErrEmailID"><?php echo isset($ErrEmailID)? $ErrEmailID : "";?></span>
                                                </div>
                                            </div>   
                                            <div class="form-group form-inline">
                                            <div class="col-sm-2">Mobile Number<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                    <input type="text" maxlength="10" class="form-control" id="MobileNumber"  name="MobileNumber" value="<?php echo (isset($_POST['MobileNumber']) ? $_POST['MobileNumber'] : "");?>" placeholder="Enter Mobile Number" style="width:100%">
                                                     <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span>
                                                </div>
                                            </div>
                                            <div class="sub-header"  style="border:none;padding-left: 25px;font-weight: bold;background: #f9f9f9;">
                                                <div class="Sub-title">Login Details</div>
                                            </div>
                                             <div class="form-group form-inline">
                                                 <div class="col-sm-2">Login Name<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="LoginName"  name="LoginName" value="<?php echo (isset($_POST['LoginName']) ? $_POST['LoginName'] : "");?>" placeholder="Enter Login Name" style="width:100%">
                                                <span class="errorstring" id="ErrLoginName"><?php echo isset($ErrLoginName)? $ErrLoginName : "";?> </span>
                                                </div>
                                            </div>
                                             <div class="form-group form-inline">
                                              <div class="col-sm-2">Login Password<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="LoginPassword" name="LoginPassword" value="<?php echo (isset($_POST['LoginPassword']) ? $_POST['LoginPassword'] : "");?>" placeholder="Enter Login Password" style="width:100%"> 
                                                    <span class="errorstring" id="ErrLoginPassword"><?php echo isset($ErrLoginPassword)? $ErrLoginPassword : "";?></span>
                                                </div>
                                             </div>   
                                            <div class="card-action" style="text-align:right">
                                    <button type="submit" class="btn btn-success" name="btnCreateBranch">Create Branch</button>&nbsp;
                                    <a href="ManageBranch" class="btn btn-danger">Cancel</a>
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