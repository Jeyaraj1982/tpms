<?php include_once("header.php");?>
<?php
    if (isset($_POST['UpdateProduct'])) {
        
        $ErrorCount =0;
   
        $duplicate = $mysql->select("select * from  _tbl_products where ProductName='".trim($_POST['ProductName'])."' and ProductCode<>'".$_GET['ProductCode']."'");
        if (sizeof($duplicate)>0) {
             $ErrProductName="Product Name Already Exists";    
             $ErrorCount++;
        }
        
        if ($ErrorCount==0) {                                                                            
        $mysql->execute("update _tbl_products set ProductName='".$_POST['ProductName']."',
                                                  ProductDescription='".$_POST['ProductDescription']."',
                                                  Remarks='".$_POST['Remarks']."',
                                                  IsActive='".$_POST['IsActive']."'
                                                  where ProductCode= '".$_GET['ProductCode']."'");
                $successMessage = "Product information has been updated successfully";
        } else {
            $errorMessage =  "Some error occured, couldn't be update product information";
        }
}
    $Product = $mysql->select("select * from _tbl_products where ProductCode='".$_GET['ProductCode']."'");
?> 
<script>
             function submitProductDetails() {
                 
                        $('#ErrProductName').html("");
                        $('#ErrProductDescription').html("");
                        $('#ErrRemarks').html("");
                        
                        ErrorCount = 0;
                        
                        
                        IsNonEmpty("ProductName", "ErrProductName", "Please Enter Product Name");
                        
                        IsNonEmpty("ProductDescription", "ErrProductDescription", "Please Enter Description");
                        
                        IsNonEmpty("Remarks", "ErrRemarks", "Please Enter Remarks");
                        
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
                                    <div class="card-title">Edit Product</div>
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
                                        <form method="post" action="" onsubmit="return submitProductDetails();">
                                            <div class="form-group form-inline">
                                                 <div class="col-sm-3" style="text-align:left">Product Code</div>
                                                <div class="col-sm-4">                                                                                                              
                                                    <input type="text" disabled="disabled" class="form-control" id="ProductCode"  name="ProductCode" placeholder="Enter Product Code" style="width:100%" value="<?php echo $Product[0]['ProductCode'];?>">
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-3">Product Name<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="Enter Product Name" value="<?php echo (isset($_POST['ProductName']) ? $_POST['ProductName'] : $Product[0]['ProductName']);?>" style="width:100%">
                                                <span class="errorstring" id="ErrProductName"><?php echo isset($ErrProductName)? $ErrProductName : "";?></span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-3">Product Descriptions<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="ProductDescription" name="ProductDescription" placeholder="Enter Product Description" value="<?php echo (isset($_POST['ProductDescription']) ? $_POST['ProductDescription'] : $Product[0]['ProductDescription']);?>" style="width:100%">
                                                <span class="errorstring" id="ErrProductDescription"><?php echo isset($ErrProductDescription)? $ErrProductDescription : "";?></span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-3">Remarks<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="Remarks" name="Remarks" placeholder="Enter Remarks" value="<?php echo (isset($_POST['Remarks']) ? $_POST['Remarks'] : $Product[0]['Remarks']);?>" style="width:100%">
                                                <span class="errorstring" id="ErrRemarks"><?php echo isset($ErrRemarks)? $ErrRemarks : "";?></span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-3">IsActive<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                    <select name="IsActive" class="form-control" style="width:80px">
                                                        <option value="1" <?php echo ($Product[0]['IsActive']==1) ? " selected='selected' " : "";?>>Yes</option>
                                                        <option value="0" <?php echo ($Product[0]['IsActive']==0) ? " selected='selected' " : "";?>>No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card-action" style="text-align:right">
                                    <button class="btn btn-success" name="UpdateProduct">Update</button>
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