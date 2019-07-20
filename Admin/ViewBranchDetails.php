<?php include_once("header.php");
    $Branch = $mysql->select("select * from _tbl_branches where BranchCode='".$_GET['BranchCode']."'");
?>
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">                              
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">View Branch</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-inline">
                                                <div class="col-sm-2">Branch Code</div>
                                                <div class="col-sm-4"><?php echo $Branch[0]['BranchCode'];?></div>
                                            </div>
                                            <div class="sub-header" style="border:none;padding-left: 25px;font-weight: bold;background: #f9f9f9;">
                                                <div class="Sub-title">Business Information</div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Branch Name</div>
                                                <div class="col-sm-10"><?php echo $Branch[0]['BranchName'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Address Line 1</div>
                                                <div class="col-sm-10"><?php echo $Branch[0]['AddressLine1'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Address Line 2</div>
                                                <div class="col-sm-10"><?php echo $Branch[0]['AddressLine2'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Address Line 3</div>
                                                <div class="col-sm-10"><?php echo $Branch[0]['AddressLine3'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-2">Pincode</div>
                                                <div class="col-sm-4"><?php echo $Branch[0]['AddressLine3'];?></div>
                                            </div>
                                            <div class="sub-header" style="border:none;padding-left: 25px;font-weight: bold;background: #f9f9f9;">
                                                <div class="Sub-title">Primary contact Information</div>
                                            </div>
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-2">Contact Person</div>
                                                <div class="col-sm-4"><?php echo $Branch[0]['PersonName'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Email Address</div>
                                                <div class="col-sm-4"><?php echo $Branch[0]['EmailID'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                            <div class="col-sm-2">Mobile Number</div>
                                                <div class="col-sm-2"><?php echo $Branch[0]['MobileNumber'];?></div>
                                            </div>
                                            <div class="sub-header" style="border:none;padding-left: 25px;font-weight: bold;background: #f9f9f9;">
                                                <div class="Sub-title">Login Details</div>
                                            </div>
                                             <div class="form-group form-inline">
                                                 <div class="col-sm-2">Login Name</div>
                                                <div class="col-sm-4"><?php echo $Branch[0]['Username'];?></div>
                                             </div>
                                             <div class="form-group form-inline"> 
                                                <div class="col-sm-2">Login Password</div>
                                                <div class="col-sm-4"><?php echo $Branch[0]['UserPassword'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Status</div>
                                                <div class="col-sm-4"><span class="<?php echo ($Branch[0]['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php if($Branch[0]['IsActive']==0){ echo "Deactive";} else { echo "Active"; }?></div>
                                            </div>
                                            <div class="card-action" style="Text-align:right">
                                    <a href="ManageBranch" class="btn btn-danger">Cancel</a>
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