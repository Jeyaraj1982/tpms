<?php include_once("header.php");?>
<?php
    if (isset($_POST['CreateSupplier'])) {
        
        $ErrorCount =0;
            
        $duplicate = $mysql->select("select * from  _tbl_suppliers where SupplierCode='".trim($_POST['SupplierCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrSupplierCode="Supplier Code Already Exists";    
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_suppliers where SupplierName='".trim($_POST['SupplierName'])."'");
        if (sizeof($duplicate)>0) {
             $ErrSupplierName="Supplier Name Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from  _tbl_suppliers where MobileNumber='".trim($_POST['MobileNumber'])."'");
        if (sizeof($duplicate)>0) {
             $ErrMobileNumber="Mobile Number Already Exists";    
             $ErrorCount++;
        }
        if(sizeof($_POST['LandlineNumber']>0)){
        $duplicate = $mysql->select("select * from  _tbl_suppliers where LandlineNumber='".trim($_POST['LandlineNumber'])."'");
        if (sizeof($duplicate)>0) {
             $ErrLandlineNumber="Landline Number Already Exists";    
             $ErrorCount++;
        }
        }
        $duplicate = $mysql->select("select * from  _tbl_suppliers where EmailID='".trim($_POST['EmailID'])."'");
        if (sizeof($duplicate)>0) {
             $ErrEmailID="Email ID Already Exists";    
             $ErrorCount++;
        }
        $duplicate = $mysql->select("select * from  _tbl_suppliers where WebsiteAddress='".trim($_POST['WebsiteAddress'])."'");
        if (sizeof($duplicate)>0) {
             $ErrWebsiteAddress="Website Address Already Exists";    
             $ErrorCount++;
        }
           $createdby =$_SESSION['User']['AdminID'];
        
        if ($ErrorCount==0) {                                                                            
        $Supplier = $mysql->insert("_tbl_suppliers",array("SupplierCode"        => trim($_POST['SupplierCode']),
                                                          "SupplierName"        => trim($_POST['SupplierName']),
                                                          "SupplierDescription" => trim($_POST['SupplierDescription']),
                                                          "PersonName"          => trim($_POST['PersonName']),
                                                          "AddressLine1"        => trim($_POST['AddressLine1']),
                                                          "AddressLine2"        => trim($_POST['AddressLine2']),
                                                          "AddressLine3"        => trim($_POST['AddressLine3']),
                                                          "Pincode"             => trim($_POST['Pincode']),
                                                          "WebsiteAddress"      => trim($_POST['WebsiteAddress']),
                                                          "EmailID"               => trim($_POST['EmailID']),
                                                          "MobileNumber"          => trim($_POST['MobileNumber']),
                                                          "CreatedBy"             => "Admin",
                                                          "CreatedByID"           => $_SESSION['User']['AdminID'],
                                                          "CreatedByName"         => $_SESSION['User']['AdminName'],
                                                          "CreatedOn"             => date("Y-m-d H:i:s")));
                                                                  
        if ($Supplier>0) {
            $successMessage =  "Supplier created successfully";
            unset($_POST);
        } else {
            $errorMessage =  "Error occured. Couldn't save supplier's infomation";
        }
    
    }
    
    }   
    
?>
<script>
             function submitSupplierDetails() {
                        $('#ErrSupplierCode').html("");
                        $('#ErrSupplierName').html("");
                        $('#ErrSupplierDescription').html("");
                        $('#ErrPersonName').html("");
                        $('#ErrAddressLine1').html("");
                        $('#ErrPincode').html("");
                        $('#ErrWebsiteAddress').html("");
                        $('#ErrEmailID').html("");
                        $('#ErrMobileNumber').html("");
                        
                        ErrorCount = 0;
                        
                        IsNonEmpty("SupplierCode", "ErrSupplierCode", "Please Enter Supplier Code");
                        
                        if(IsNonEmpty("SupplierName", "ErrSupplierName", "Please Enter Supplier Name")) {
                            IsAlphaNumeric("SupplierName", "ErrSupplierName", "Please Enter AlphaNumeric Characters Only"); 
                        }
                        
                        IsNonEmpty("SupplierDescription","ErrSupplierDescription","Please Enter Supplier Description");
                        
                        if(IsNonEmpty("PersonName", "ErrPersonName", "Please Enter Contact Person Name")){
                            IsAlphaNumeric("PersonName", "ErrPersonName", "Please Enter AlphaNumerics Character only");
                        }
                        
                        IsNonEmpty("AddressLine1","ErrAddressLine1","Please Enter AddressLine1");
                        
                        IsNonEmpty("Pincode","ErrPincode","Please Enter Pincode");        
                        
                        IsNonEmpty("WebsiteAddress","ErrWebsiteAddress","Please Enter WebsiteAddress");
                        if(IsNonEmpty("EmailID","ErrEmailID","Please Enter EmailID")) {
                            IsEmail("EmailID","ErrEmailID","Please Enter Valid EmailID"); 
                        }
                        
                        if(IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter MobileNumber")) {
                        IsMobileNumber("MobileNumber","ErrMobileNumber","Please Enter Valid MobileNumber");
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
                                    <div class="card-title">Add Supplier</div>
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
                                            
                                        <form method="post" action="" onsubmit="return submitSupplierDetails();">
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-2" style="text-align:left">Supplier Code<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="SupplierCode"  name="SupplierCode" placeholder="Enter Supplier Code" style="width:100%" value="<?php echo isset($_POST['SupplierCode']) ? $_POST['SupplierCode'] : SeqMaster::GetNextSupplierCode();?>">
                                                    <span class="errorstring" id="ErrSupplierCode"><?php echo isset($ErrSupplierCode)? $ErrSupplierCode : "";?></span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Supplier Name<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="SupplierName" name="SupplierName" placeholder="Enter Supplier Name" value="<?php echo (isset($_POST['SupplierName']) ? $_POST['SupplierName'] : "");?>" style="width:100%">
                                                <span class="errorstring" id="ErrSupplierName"><?php echo isset($ErrSupplierName)? $ErrSupplierName : "";?></span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Supplier Description<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="SupplierDescription"  name="SupplierDescription" value="<?php echo (isset($_POST['SupplierDescription']) ? $_POST['SupplierDescription'] : "");?>" placeholder="Enter Supplier Description" style="width:100%">
                                                <span class="errorstring" id="ErrSupplierDescription"><?php echo isset($ErrSupplierDescription)? $ErrSupplierDescription : "";?></span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-2">Contact Person<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="PersonName"  name="PersonName" value="<?php echo (isset($_POST['PersonName']) ? $_POST['PersonName'] : "");?>" placeholder="Enter Contact Person" style="width:100%">
                                                <span class="errorstring" id="ErrPersonName"><?php echo isset($ErrPersonName)? $ErrPersonName : "";?> </span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Address Line 1<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="AddressLine1" name="AddressLine1" value="<?php echo (isset($_POST['AddressLine1']) ? $_POST['AddressLine1'] : "");?>" placeholder="Enter Address Line 1" style="width:100%">
                                                    <span class="errorstring" id="ErrAddressLine1"><?php echo isset($ErrAddressLine1)? $ErrAddressLine1 : "";?> </span>
                                                 </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Address Line 2</div>
                                                <div class="col-sm-4"><input type="text" class="form-control" id="AddressLine2" name="AddressLine2" value="<?php echo (isset($_POST['AddressLine2']) ? $_POST['AddressLine2'] : "");?>" placeholder="Enter Address Line 2" style="width:100%"></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Address Line 3</div>
                                                <div class="col-sm-4"><input type="text" class="form-control" id="AddressLine3" name="AddressLine3" value="<?php echo (isset($_POST['AddressLine3']) ? $_POST['AddressLine3'] : "");?>" placeholder="Enter Address Line 3" style="width:100%"></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-2">Pincode<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="Pincode"  name="Pincode" value="<?php echo (isset($_POST['Pincode']) ? $_POST['Pincode'] : "");?>" placeholder="Enter Pincode" style="width:100%">
                                                 <span class="errorstring" id="ErrPincode"><?php echo isset($ErrPincode)? $ErrPincode : "";?></span>
                                            </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-2">Website Address<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="WebsiteAddress"  name="WebsiteAddress" value="<?php echo (isset($_POST['WebsiteAddress']) ? $_POST['WebsiteAddress'] : "");?>" placeholder="Enter Website Address" style="width:100%">
                                                 <span class="errorstring" id="ErrWebsiteAddress"><?php echo isset($ErrWebsiteAddress)? $ErrWebsiteAddress : "";?></span>
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
                                            </div><div class="form-group form-inline">
                                            <div class="col-sm-2">Landline Number</div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="LandlineNumber"  name="LandlineNumber" value="<?php echo (isset($_POST['LandlineNumber']) ? $_POST['LandlineNumber'] : "");?>" placeholder="Enter Landline Number" style="width:100%">
                                                     <span class="errorstring" id="ErrLandlineNumber"><?php echo isset($ErrLandlineNumber)? $ErrLandlineNumber : "";?></span>
                                                </div>
                                            </div>
                                            <div class="card-action" style="text-align:right">
                                    <button class="btn btn-success" name="CreateSupplier">Create</button>
                                    <a href="ManageSupplier.php" class="btn btn-danger">Cancel</a>
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