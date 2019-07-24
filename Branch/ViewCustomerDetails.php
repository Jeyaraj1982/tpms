<?php include_once("header.php");
   $Customer = $mysql->select("select * from _tbl_customers where    `CreatedByID`='".$_SESSION['User']['BranchID']."' and CustomerCode='".$_GET['CusCode']."'");
?>

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                                <div class="card-header">
                                    <div class="card-title">View Customer</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-2" style="text-align:left">Customer Code</div>
                                                <div class="col-sm-4"><?php echo $Customer[0]['CustomerCode'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Customer Name</div>
                                                <div class="col-sm-4"><?php echo $Customer[0]['CustomerName'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Mobile Number</div>
                                                <div class="col-sm-4"><?php echo $Customer[0]['MobileNumber'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Email Address</div>
                                                <div class="col-sm-4"><?php echo $Customer[0]['EmailID'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-2">Address Line1</div>
                                                <div class="col-sm-4"><?php echo $Customer[0]['AddressLine1'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-2">Address Line2</div>
                                                <div class="col-sm-4"><?php echo $Customer[0]['AddressLine2'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-2">Address Line3</div>
                                                <div class="col-sm-4"><?php echo $Customer[0]['AddressLine3'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-2">Pincode</div>
                                                <div class="col-sm-4"><?php echo $Customer[0]['PinCode'];?></div>
                                            </div>
                                            <div class="card-action" style="text-align:right">
                                                <a href="ManageCustomer.php" class="btn btn-danger">Cancel</a>
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