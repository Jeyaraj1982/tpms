<?php include_once("header.php");?>
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                 
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
                        $('#ErrAddress').html("");
                        $('#ErrPincode').html("");
                        $('#ErrMobileNumber').html("");
                        $('#ErrWhatsappNumber').html("");
                        $('#ErrContactPerson').html("");
                        $('#ErrContactEmailAddress').html("");
                        $('#ErrContactAddress').html("");
                        $('#ErrContactPincode').html("");
                        $('#ErrContactMobileNumber').html("");
                        $('#ErrLoginPassword').html("");
                        $('#ErrLoginName').html("");
                        
                        ErrorCount = 0;
                        
                        IsNonEmpty("BranchCode", "ErrBranchCode", "Please Enter Valid Branch Code");
                        IsNonEmpty("BranchName", "ErrBranchName", "Please Enter Valid Branch Name");
                        IsNonEmpty("Address", "ErrAddress", "Please Enter Valid Address");
                        IsNonEmpty("Pincode", "ErrPincode", "Please Enter Valid Pincode");
                        
                        if(IsNonEmpty("EmailAddress","ErrEmailAddress","Please Enter EmailID")) {
                            IsEmail("EmailAddress","ErrEmailAddress","Please Enter Valid EmailID"); 
                        }
                        
                        if(IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter MobileNumber")) {
                        IsMobileNumber("MobileNumber","ErrMobileNumber","Please Enter Valid MobileNumber");
                        }
                        
                        if(IsNonEmpty("WhatsappNumber", "ErrWhatsappNumber", "Please Enter Whatsapp Number")){
                        IsMobileNumber("WhatsappNumber", "ErrWhatsappNumber", "Please Enter Valid Whatsapp Number");
                        }
                        
                        IsNonEmpty("LandLineNumber", "ErrLandLineNumber", "Please Enter Valid LandLine Number");
                        IsNonEmpty("ContactPerson", "ErrContactPerson", "Please Enter Contact Person Name");
                        
                        if(IsNonEmpty("ContactEmailAddress", "ErrContactEmailAddress", "Please Enter Contact Email Address")){
                           IsEmail("ContactEmailAddress", "ErrContactEmailAddress", "Please Enter valid Contact Email Address") 
                        }
                        IsNonEmpty("ContactAddress", "ErrContactAddress", "Please Enter Contact Address");
                        IsNonEmpty("ContactPincode", "ErrContactPincode", "Please Enter Contact Pincode");
                        
                        if(IsNonEmpty("ContactMobileNumber","ErrContactMobileNumber","Please Enter MobileNumber")) {
                        IsMobileNumber("ContactMobileNumber","ErrContactMobileNumber","Please Enter Valid MobileNumber");
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Add Branch</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form method="post" action="" onsubmit="return submitBranchDetails()">
                                            <div class="form-group form-inline">
                                                <label for="BranchCode" class="col-sm-2">Branch Code</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="BranchCode" name="BranchCode" placeholder="Enter Branch Code" style="width:100%">
                                                    <span class="errorstring" id="ErrBranchCode"><?php echo isset($ErrBranchCode)? $ErrBranchCode : "";?></span>
                                                </div>
                                                <label for="BranchName" class="col-sm-2">Branch Name</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="BranchName" name="BranchName" placeholder="Enter Branch Name" style="width:100%">
                                                    <span class="errorstring" id="ErrBranchName"><?php echo isset($ErrBranchName)? $ErrBranchName : "";?></span>
                                                </div>
                                            </div>
                                            <div class="sub-header">
                                                <div class="Sub-title">Business Information</div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <label for="Address" class="col-sm-2">Address</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="Address" name="Address" placeholder="Enter Address" style="width:100%">
                                                    <span class="errorstring" id="ErrAddress"><?php echo isset($ErrAddress)? $ErrAddress : "";?>
                                                 </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <label for="Address1" class="col-sm-2">Address</label>
                                                <div class="col-sm-10"><input type="text" class="form-control" id="Address1" name="Address1" placeholder="Enter Address" style="width:100%"></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <label for="Address2" class="col-sm-2">Address</label>
                                                <div class="col-sm-10"><input type="text" class="form-control" id="Address2" name="Address2" placeholder="Enter Branch Name" style="width:100%"></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                 <label for="Pincode" class="col-sm-2">Pincode</label>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="Pincode"  name="Pincode" placeholder="Enter Pincode" style="width:100%">
                                                 <span class="errorstring" id="ErrPincode"><?php echo isset($ErrPincode)? $ErrPincode : "";?>
                                                </div>
                                                <label for="EmailAddress" class="col-sm-2">Email Address</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="EmailAddress" name="EmailAddress" placeholder="Enter Email Address" style="width:100%"> 
                                                    <span class="errorstring" id="ErrEmailAddress"><?php echo isset($ErrEmailAddress)? $ErrEmailAddress : "";?>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                 <label for="MobileNumber" class="col-sm-2">Mobile Number</label>
                                                <div class="col-sm-2">
                                                    <input type="text" maxlength="10" class="form-control" id="MobileNumber"  name="MobileNumber" placeholder="Enter Mobile Number" style="width:100%">
                                                     <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?>
                                                    </div>
                                                <label for="WhatsappNumber" class="col-sm-2">Whatsapp Number</label>
                                                <div class="col-sm-2">
                                                    <input type="text" maxlength="10" class="form-control" id="WhatsappNumber" name="WhatsappNumber" placeholder="Enter Whatsapp Number" style="width:100%">
                                                    <span class="errorstring" id="ErrWhatsappNumber"><?php echo isset($ErrWhatsappNumber)? $ErrWhatsappNumber : "";?>
                                                </div>
                                                <label for="LandLineNumber" class="col-sm-2">Land Line Number</label>
                                                <div class="col-sm-2">
                                                <input type="text" class="form-control" id="LandLineNumber" name="LandLineNumber" placeholder="Enter LandLine Number" style="width:100%">
                                                <span class="errorstring" id="ErrLandLineNumber"><?php echo isset($ErrLandLineNumber)? $ErrLandLineNumber : "";?>
                                                </div>
                                            </div>
                                            <div class="sub-header">
                                                <div class="Sub-title">Primary contact Information</div>
                                            </div>
                                            <div class="form-group form-inline">
                                                 <label for="ContactPerson" class="col-sm-2">Contact Person</label>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="ContactPerson"  name="ContactPerson" placeholder="Enter Contact Person" style="width:100%">
                                                <span class="errorstring" id="ErrContactPerson"><?php echo isset($ErrContactPerson)? $ErrContactPerson : "";?>
                                                </div>
                                                <label for="ContactEmailAddress" class="col-sm-2">Email Address</label>
                                                <div class="col-sm-4"><input type="text" class="form-control" id="ContactEmailAddress" name="ContactEmailAddress" placeholder="Enter Email Address" style="width:100%">
                                                <span class="errorstring" id="ErrContactEmailAddress"><?php echo isset($ErrContactEmailAddress)? $ErrContactEmailAddress : "";?>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                 <label for="ContactAddress" class="col-sm-2">Address</label>
                                                <div class="col-sm-10">
                                                <input type="text" class="form-control" id="ContactAddress" name="ContactAddress" placeholder="Enter Address" style="width:100%">
                                                    <span class="errorstring" id="ErrContactAddress"><?php echo isset($ErrContactAddress)? $ErrContactAddress : "";?>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <label for="ContactAddress1" class="col-sm-2">Address</label>
                                                <div class="col-sm-10"><input type="text" class="form-control" id="ContactAddress1" name="ContactAddress1" placeholder="Enter Address" style="width:100%"></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <label for="ContactAddress2" class="col-sm-2">Address</label>
                                                <div class="col-sm-10"><input type="text" class="form-control" id="ContactAddress2" name="ContactAddress2" placeholder="Enter Branch Name" style="width:100%"></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                 <label for="ContactPincode" class="col-sm-2">Pincode</label>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="ContactPincode" maxlength="6"  name="ContactPincode" placeholder="Enter Pincode" style="width:100%">
                                                    <span class="errorstring" id="ErrContactPincode"><?php echo isset($ErrContactPincode)? $ErrContactPincode : "";?>
                                                </div>
                                                <label for="ContactMobileNumber" class="col-sm-2">Mobile Number</label>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="ContactMobileNumber" name="ContactMobileNumber" placeholder="Enter Mobile Number" style="width:100%">
                                                <span class="errorstring" id="ErrContactMobileNumber"><?php echo isset($ErrContactMobileNumber)? $ErrContactMobileNumber : "";?>
                                                </div>
                                            </div>
                                            <div class="sub-header">
                                                <div class="Sub-title">Login Details</div>
                                            </div>
                                            <div class="form-group form-inline">
                                                 <label for="LoginName" class="col-sm-2">Login Name</label>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="LoginName"  name="LoginName" placeholder="Enter Login Name" style="width:100%">
                                                <span class="errorstring" id="ErrLoginName"><?php echo isset($ErrLoginName)? $ErrLoginName : "";?>
                                                </div>
                                                <label for="LoginPassword" class="col-sm-2">Login Password</label>
                                                <div class="col-sm-4"><input type="password" class="form-control" id="LoginPassword" name="LoginPassword" placeholder="Enter Login Password" style="width:100%">
                                                <span class="errorstring" id="ErrLoginPassword"><?php echo isset($ErrLoginPassword)? $ErrLoginPassword : "";?>
                                                </div>
                                            </div>
                                            <div class="card-action">
                                    <button class="btn btn-success" name="btnCreateBranch">Submit</button>
                                    <button class="btn btn-danger">Cancel</button>
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