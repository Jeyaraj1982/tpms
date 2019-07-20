<?php include_once("header.php");
   $Supplier = $mysql->select("select * from _tbl_suppliers where SupplierCode='".$_GET['SuplierCode']."'");
?>

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                                <div class="card-header">
                                    <div class="card-title">View Supplier</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-3" style="text-align:left">Supplier Code</div>
                                                <div class="col-sm-4"><?php echo $Supplier[0]['SupplierCode'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-3">Supplier Name</div>
                                                <div class="col-sm-4"><?php echo $Supplier[0]['SupplierName'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-3">Supplier Description</div>
                                                <div class="col-sm-4"><?php echo $Supplier[0]['SupplierDescription'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-3">Person Name</div>
                                                <div class="col-sm-4"><?php echo $Supplier[0]['PersonName'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-3">AddressLine1</div>
                                                <div class="col-sm-4"><?php echo $Supplier[0]['AddressLine1'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-3">AddressLine2</div>
                                                <div class="col-sm-4"><?php echo $Supplier[0]['AddressLine2'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-3">AddressLine3</div>
                                                <div class="col-sm-4"><?php echo $Supplier[0]['AddressLine3'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-3">Pincode</div>
                                                <div class="col-sm-4"><?php echo $Supplier[0]['Pincode'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-3">Website Address</div>
                                                <div class="col-sm-4"><?php echo $Supplier[0]['WebsiteAddress'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-3">Email Address</div>
                                                <div class="col-sm-4"><?php echo $Supplier[0]['EmailID'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-3">Mobile Number</div>
                                                <div class="col-sm-4"><?php echo $Supplier[0]['MobileNumber'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-3">Landline Number</div>
                                                <div class="col-sm-4"><?php echo $Supplier[0]['LandlineNumber'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-3">Status</div>
                                                <div class="col-sm-4"><span class="<?php echo ($Supplier[0]['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php if($Supplier[0]['IsActive']==0){ echo "Deactive";} else { echo "Active"; }?></div>
                                            </div>
                                            <div class="card-action" style="text-align:right">
                                                <a href="ManageSupplier.php" class="btn btn-danger">Cancel</a>
                                            </div>
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