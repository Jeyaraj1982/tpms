<?php include_once("header.php");?>
<?php
    if (isset($_POST['CreateProduct'])) {
        
        $ErrorCount =0;
            
        $duplicate = $mysql->select("select * from  _tbl_products where ProductCode='".trim($_POST['ProductCode'])."'");
        if (sizeof($duplicate)>0) {
             $ErrProductCode="Product Code Already Exists";    
             $ErrorCount++;
        }
        
        $duplicate = $mysql->select("select * from  _tbl_products where ProductName='".trim($_POST['ProductName'])."'");
        if (sizeof($duplicate)>0) {
             $ErrProductName="Product Name Already Exists";    
             $ErrorCount++;
        }
           $createdby =$_SESSION['User']['AdminID'];
        
        if ($ErrorCount==0) {                                                                            
        $Product = $mysql->insert("_tbl_products",array("ProductCode"        => trim($_POST['ProductCode']),
                                                          "ProductName"        => trim($_POST['ProductName']),
                                                          "ProductDescription"        => trim($_POST['ProductDescription']),
                                                          "Remarks"        => trim($_POST['Remarks']),
                                                          "CreatedBy"           => "Admin",
                                                          "CreatedByID"         => $_SESSION['User']['AdminID'],
                                                          "CreatedByName"       => $_SESSION['User']['AdminName'],
                                                          "CreatedOn"           => date("Y-m-d H:i:s")));
                                                                  
        if ($Product>0) {
            $successMessage =  "Product information added successfully";
            unset($_POST);
        } else {
            $errorMessage =  "Error occured. Couldn't save product information";
        }
    
    }
    
    }   
    
?>

<script>
             function submitProductDetails() {
                 
                        $('#ErrProductCode').html("");
                        $('#ErrProductName').html("");
                        $('#ErrProductDescription').html("");
                        $('#ErrRemarks').html("");
                        
                        ErrorCount = 0;
                        
                        IsNonEmpty("ProductCode", "ErrProductCode", "Please Enter Product Code");
                        
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
                                    <div class="card-title">Add Product</div>
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
                                                 <div class="col-sm-3" style="text-align:left">Product Code<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="ProductCode"  name="ProductCode" placeholder="Enter Product Code" style="width:100%" value="<?php echo isset($_POST['ProductCode']) ? $_POST['ProductCode'] : SeqMaster::GetNextProductCode();?>">
                                                    <span class="errorstring" id="ErrProductCode"><?php echo isset($ErrProductCode)? $ErrProductCode : "";?></span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-3">Product Name<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="Enter Product Name" value="<?php echo (isset($_POST['ProductName']) ? $_POST['ProductName'] : "");?>" style="width:100%">
                                                <span class="errorstring" id="ErrProductName"><?php echo isset($ErrProductName)? $ErrProductName : "";?></span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-3">Product Descriptions<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="ProductDescription" name="ProductDescription" placeholder="Enter Description" value="<?php echo (isset($_POST['ProductDescription']) ? $_POST['ProductDescription'] : "");?>" style="width:100%">
                                                <span class="errorstring" id="ErrProductDescription"><?php echo isset($ErrProductDescription)? $ErrProductDescription : "";?></span>
                                                </div>
                                            </div>
                                            <div class="form-group form-inline">
                                                <div class="col-sm-3">Remarks<span id="star">*</span></div>
                                                <div class="col-sm-4">
                                                <input type="text" class="form-control" id="Remarks" name="Remarks" placeholder="Enter Remarks" value="<?php echo (isset($_POST['Remarks']) ? $_POST['Remarks'] : "");?>" style="width:100%">
                                                <span class="errorstring" id="ErrRemarks"><?php echo isset($ErrRemarks)? $ErrRemarks : "";?></span>
                                                </div>
                                            </div>
                                            <div class="card-action" style="text-align:right">
                                    <button class="btn btn-success" name="CreateProduct">Create</button>
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