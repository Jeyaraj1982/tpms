<?php include_once("header.php");?>
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Forms</h4>
                    <ul class="breadcrumbs">
                        <li class="nav-home">
                            <a href="#">
                                <i class="flaticon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Forms</a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">                                                              
                            <a href="#">Basic Form</a>
                        </li>
                    </ul>
                </div>
<script>
             function submitCustomerDetails() {
                 
                        $('#ErrCustomerCode').html("");
                        $('#ErrCustomerName').html("");
                        $('#ErrContactMobileNumber').html("");
                        $('#ErrContactEmailAddress').html("");
                        $('#ErrAddress').html("");
                        $('#ErrPincode').html("");
                        $('#ErrReferedBy').html("");
                        
                        ErrorCount = 0;
                        
                        IsNonEmpty("CustomerCode", "ErrCustomerCode", "Please Enter Valid Customer Code");
                        IsNonEmpty("CustomerName", "ErrCustomerName", "Please Enter Valid Customer Name");
                        
                       /*  if(IsNonEmpty("ContactMobileNumber","ErrContactMobileNumber","Please Enter MobileNumber")) {
                        IsMobileNumber("ContactMobileNumber","ErrContactMobileNumber","Please Enter Valid MobileNumber");
                        }*/
                        
                        if(IsNonEmpty("ContactEmailAddress", "ErrContactEmailAddress", "Please Enter Contact Email Address")){
                           IsEmail("ContactEmailAddress", "ErrContactEmailAddress", "Please Enter valid Contact Email Address") 
                        }        
                        IsNonEmpty("Address", "ErrAddress", "Please Enter Valid Address");
                        
                        IsNonEmpty("Pincode", "ErrPincode", "Please Enter Pincode");
                        IsNonEmpty("ReferedBy", "ErrReferedBy", "Please Enter Refered By");

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
                                    <div class="card-title">Add Customer</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <form method="post" action="" onsubmit="return submitCustomerDetails()">
                                            <div class="form-group form-inline">
                                                 <label for="CustomerCode" class="col-sm-2">Customer Code</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="CustomerCode"  name="CustomerCode" placeholder="Enter Customer Code" style="width:100%">
                                                    <span class="errorstring" id="ErrCustomerCode"><?php echo isset($ErrCustomerCode)? $ErrCustomerCode : "";?></span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <label for="CustomerName" class="col-sm-2">Customer Name</label>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="CustomerName" name="CustomerName" placeholder="Enter Customer Name" style="width:100%">
                                                <span class="errorstring" id="ErrCustomerName"><?php echo isset($ErrCustomerName)? $ErrCustomerName : "";?></span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <label for="MobileNumber" class="col-sm-2">Mobile Number</label>
                                                <div class="col-sm-4">
                                                <input type="text" maxlength="10" class="form-control" id="MobileNumber"  name="MobileNumber" placeholder="Enter Mobile Number" style="width:100%">
                                                <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <label for="ContactEmailAddress" class="col-sm-2">Email Address</label>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="ContactEmailAddress" name="ContactEmailAddress" placeholder="Enter Email Address" style="width:100%">
                                                <small id="emailHelp2" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                                <span class="errorstring" id="ErrContactEmailAddress"><?php echo isset($ErrContactEmailAddress)? $ErrContactEmailAddress : "";?></span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                 <label for="Address" class="col-sm-2">Address</label>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="Address" name="Address" placeholder="Enter Address" style="width:100%">
                                                <span class="errorstring" id="ErrAddress"><?php echo isset($ErrAddress)? $ErrAddress : "";?></span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <label for="Address1" class="col-sm-2">Address</label>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="Address1" name="Address1" placeholder="Enter Address" style="width:100%">
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                 <label for="Pincode" class="col-sm-2">Pincode</label>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" maxlength="6" id="Pincode"  name="Pincode" placeholder="Enter Pincode" style="width:100%">
                                                <span class="errorstring" id="ErrPincode"><?php echo isset($ErrPincode)? $ErrPincode : "";?></span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <label for="ReferedBy" class="col-sm-2">Refered By</label>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="ReferedBy" name="ReferedBy" placeholder="Enter Refered By" style="width:100%">
                                                <span class="errorstring" id="ErrReferedBy"><?php echo isset($ErrBranchCode)? $ErrReferedBy : "";?></span>
                                                </div>
                                            </div>
                                            <div class="card-action">
                                    <button class="btn btn-success" name="CreateCustomer">Create</button>
                                    <button class="btn btn-danger">Cancel</button>
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