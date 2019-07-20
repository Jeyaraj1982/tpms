<?php include_once("header.php");
   $Product = $mysql->select("select * from _tbl_products where ProductCode='".$_GET['ProductCode']."'");
?>

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                                <div class="card-header">
                                    <div class="card-title">View Product</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-2" style="text-align:left">Product Code</div>
                                                <div class="col-sm-4"><?php echo $Product[0]['ProductCode'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Product Name</div>
                                                <div class="col-sm-4"><?php echo $Product[0]['ProductName'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Product Descriptions</div>
                                                <div class="col-sm-4"><?php echo $Product[0]['ProductDescription'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Remarks</div>
                                                <div class="col-sm-4"><?php echo $Product[0]['Remarks'];?></div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-2">Status</div>
                                                <div class="col-sm-4"><span class="<?php echo ($Product[0]['IsActive']==1) ? 'Activedot' : 'Deactivedot';?>"></span>&nbsp;&nbsp;<?php if($Product[0]['IsActive']==0){ echo "Deactive";} else { echo "Active"; }?></div>
                                            </div>
                                            <div class="card-action" style="text-align:right">
                                                <a href="ManageProduct.php" class="btn btn-danger">Cancel</a>
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