<?php
    include_once("../config.php");
    echo $_GET['action']();
    
    function addProductToCart() {
        global $mysql;
        $Products = $mysql->select("select * from `_tbl_products` where `IsActive`='1'");
        $suppliers = $mysql->select("select * from `_tbl_suppliers`  where `IsActive`='1'");
        $formid = rand(9000,9999);
        ?>
        <div class="modal-header no-bd">
            <h5 class="modal-title"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
          <script>
             
$(document).ready(function () {
  $("#Amount").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrAmount").html("Digits Only").fadeIn("fast");
               return false;
    }}); 
    $("#Qty").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrQty").html("Digits Only").fadeIn("fast");
               return false;
    }});
    $("#Qty").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrQty").html("Digits Only").fadeIn("fast");
               return false;
    }});
    $("#ServiceCharge").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrServiceCharge").html("Digits Only").fadeIn("fast");
               return false;
    }}); 
   });
     function submitpopproduct(){
         $('#ErrQty').html("");
         $('#ErrAmount').html("");
         $('#ErrServiceCharge').html("");
         ErrorCount=0;
         
         IsNonEmpty("Qty","ErrQty","Please enter qty");
         IsNonEmpty("Amount","ErrAmount","Please enter amount");
         IsNonEmpty("ServiceCharge","ErrServiceCharge","Please enter ServiceCharge");
         
         if(( $('#Amount').val() > 0 &&  $('#Amount').val()<1000))  {
          document.getElementById("ErrAmount").innerHTML="allowed only below 1000";                 
          return false;
          }                                                                             
         if (ErrorCount==0) {
                            return true;
                        } else{
                            return false;
                        }
     }
   
          </script>
        <div class="modal-body">
            <form method="post" onsubmit="return submitpopproduct()" name="frm_<?php echo $formid;?>" id="frm_<?php echo $formid;?>">
            
                <div class="form-group row">
                    <div class="col-sm-12">Supplier<span id="star">*</span><select class="selectpicker form-control" data-live-search="true" id="Supplier"  name="SupplierCode">
                            <?php foreach($suppliers as $supplier) { ?>
                                <option value="<?php echo $supplier['SupplierCode'];?>"> <?php echo $supplier['SupplierName'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">Product<span id="star">*</span>
                        <select class="selectpicker form-control" data-live-search="true" id="Product"  name="ProductCode">
                            <?php foreach($Products as $Product) { ?>
                            <option value="<?php echo $Product['ProductCode'];?>"> <?php echo $Product['ProductName'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">Qty<span id="star">*</span>
                        <input type="text" class="form-control" name="Qty" id="Qty" style="text-align:right" placeholder="1">
                            <span class="errorstring" id="ErrQty"><?php echo isset($ErrQty)? $ErrQty : "";?></span>
                        </div>
                <div class="col-sm-4">Amount<span id="star">*</span>
                <input type="text" class="form-control" name="Amount" id="Amount" style="text-align:right" placeholder="1"><span class="errorstring" id="ErrCustomerName">
                        <span class="errorstring" id="ErrAmount"><?php echo isset($ErrAmount)? $ErrAmount : "";?></div>
               <div class="col-sm-4">Service Charge<span id="star">*</span>
               <input type="text" class="form-control" name="ServiceCharge" id="ServiceCharge" style="text-align:right" placeholder="0.00">
                    <span class="errorstring" id="ErrServiceCharge"><?php echo isset($ErrServiceCharge)? $ErrServiceCharge : "";?></div>
                </div>
                 <!--<div class="form-group">
                    <div class="col-sm-6">Date Of Journey </div>
                    <div class="col-sm-6"><input type="text" class="form-control" name="DateOfJourney" id="DateOfJourney"></div>
                </div>-->
                <div class="form-group row">
                    <div class="col-sm-6">Date Of Journey <input type="date" class="form-control" id="datePicker"></div>
                    <div class="col-sm-6">Time of Journey <input type="text" class="form-control" name="TimeOfJourney" id="TimeOfJourney" placeholder="00:00"></div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">Order Remarks<span id="star">*</span><input type="text" class="form-control" name="Remarks" id="Remarks"></div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">Official Remarks<span id="star">*</span><input type="text" class="form-control" name="OffRemarks" id="OffRemarks"></div>
                </div>
            </form>
        </div>
        
        <div class="modal-footer no-bd" style="float:left;color:red" id="product_body_error">
        </div>
        <div class="modal-footer no-bd" style="float:left">
            <button type="button" id="addRowButton" class="btn btn-primary" onclick="addToCart('frm_<?php echo $formid;?>');">Add</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        <?php
    }
    
    function addToCart() {
        global $mysql;
       
        $Products = $mysql->select("select * from _tbl_products where ProductCode='".$_POST['ProductCode']."'");
        $suppliers = $mysql->select("select * from _tbl_suppliers where SupplierCode='".$_POST['SupplierCode']."'");
        
        $serviceCharge = (isset($_POST['ServiceCharge']) && $_POST['ServiceCharge']>0) ? $_POST['ServiceCharge'] : 0;
        $qty = (isset($_POST['Qty']) && $_POST['Qty']>0) ? $_POST['Qty'] : 1;
        
        if (isset($_POST['Amount']) && $_POST['Amount']>0) {
        $item = array("ProductCode"     => $_POST['ProductCode'],
                      "ProductName"     => $Products[0]['ProductName'],
                      "ProductID"       => $Products[0]['ProductID'],
                      "SupplierID"      => $suppliers[0]['SupplierID'],
                      "SupplierCode"    => $_POST['SupplierCode'],
                      "SupplierName"    => $suppliers[0]['SupplierName'],
                      "Qty"             => $qty,
                      "Amount"          => $_POST['Amount'],
                      "TAmount"         => $qty*$_POST['Amount'],        
                      "ServiceCharge"   => $serviceCharge,        
                      "TSAmount"        => ($qty*$_POST['Amount'])+$serviceCharge,
                      "Remarks"         => $_POST['Remarks'],
                      "TimeOfJourney"   => $_POST['TimeOfJourney'],
                      "DateOfJourney"   => $_POST['DateOfJourney'],
                      "OffRemarks"      => $_POST['OffRemarks']);
        
        $_SESSION['order']['items'][]=$item;
            echo "success";
        } else {
            echo "Invalid Amount";
        }
        
    }
    
    function getCartItems() {
        
        $i=1;
         $totalAmt=0;
        ?>
        
        <table id="add-row" class="display table table-striped table-hover" >
            <thead>
                <tr>
                    <th>Sl No</th>
                    <th>Particulars</th>
                    <th style="text-align:center">Qty</th>
                    <th style="text-align:center">Price</th>
                    <th style="text-align:center">Amount</th>
                    <th style="text-align:center">Service Chrg</th>
                    <th style="text-align:center">Total</th>
                    <th style="width: 10%">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($_SESSION['order']['items'] as $items) {?>
                <tr>
                    <td style="text-align:right"><?php echo $i;?>.&nbsp;</td>
                    <td>
                        <?php echo $items['ProductName'];?><Br>
                        <span style="color:#555"><?php echo $items['Remarks'];?></span>
                    </td>
                    <td style="text-align:right"><?php echo $items['Qty'];?></td>
                    <td style="text-align:right"><?php echo number_format($items['Amount'],2);?></td>
                    <td style="text-align:right"><?php echo number_format($items['TAmount'],2);?></td>
                    <td style="text-align:right"><?php echo number_format($items['ServiceCharge'],2);?></td>
                    <td style="text-align:right"><?php echo number_format($items['TSAmount'],2);?></td>
                    <td>
                        <div class="form-button-action">
                            <button type="button" onclick="removeFromCart('<?php echo $items['ProductCode'];?>')" class="btn btn-link btn-danger" data-original-title="Remove">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php $i++; 
            $totalAmt+=$items['TSAmount'];
            } ?>
            <?php if (sizeof($_SESSION['order']['items'])==0) {?>
            <tr>
                <td colspan="8" style="text-align:center">No items found</td>
            </tr>
            <?php } ?>
            </tbody> 
        </table>
        <script>
            $('#PayableAmount').val("<?php echo number_format($totalAmt,2);?>")
        </script>
        
        <?php
    }
    
    function removeFromCart() {
        
        $newItems = array();
        
        foreach( $_SESSION['order']['items'] as $item) {
            if ($item['ProductCode']!=$_GET['PCode']) {
               $newItems[] = $item;
            }
        }
        $_SESSION['order']['items']= $newItems;
    }
    
    
    function getCustomers() {
        global $mysql;
        $customers = $mysql->select("SELECT * FROM _tbl_customers WHERE CustomerName LIKE '%".$_POST['CustomerDetails']."%' OR MobileNumber LIKE '%".$_POST['CustomerDetails']."%' OR EmailID LIKE '%".$_POST['CustomerDetails']."%'");
        ?>
        <table class="display table table-striped table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th>Mobile Number</th>
                <th>Email ID</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach($customers as $customer) {?>
             <tr>
                <td><?php echo $customer['CustomerName'];?></td>
                <td><?php echo $customer['MobileNumber'];?></td>
                <td><?php echo $customer['EmailID'];?></td>
                <td><a href="javascript:void(0)" onclick="SelCustomer('<?php echo $customer['CustomerCode'];?>')">Select</a></td>
            </tr>
            <?php } ?>
            <?php if (sizeof($customers)==0) {?>
            <tr>
                <td colspan="3" style="text-align:center">No records found</td>
            </tr>
            <?php } ?>
         </tbody>
        </table>
        <?php
    }
    
    function GetCustomerInfo() {
        global $mysql;
        $customers = $mysql->select("SELECT * FROM _tbl_customers WHERE CustomerCode='".$_GET['CCode']."'");
        ?>
        <div>
        <?php echo $customers[0]['CustomerName'];?>,<br>
        <?php
         echo strlen(trim($customers[0]['AddressLine1']))>0 ?  $customers[0]['AddressLine1'].",<br>" : ""; 
         echo strlen(trim($customers[0]['AddressLine2']))>0 ?  $customers[0]['AddressLine2'].",<br>" : ""; 
         echo strlen(trim($customers[0]['AddressLine3']))>0 ?  $customers[0]['AddressLine3'].",<br>" : ""; 
         echo strlen(trim($customers[0]['PinCode']))>0 ?  $customers[0]['PinCode'].",<br>" : ""; 
         ?>
        Mobile: <?php echo $customers[0]['MobileNumber'];?>,<br>
        Email: <?php echo $customers[0]['EmailID'];?>,<br>
        </div>
        <?php
    }
    
    function addCustomer() {
        
          global $mysql;
        $duplicate = $mysql->select("select * from  _tbl_customers where MobileNumber='".trim($_POST['MobileNumber'])."'");
        if (sizeof($duplicate)>0) {
             echo  "Mobile Number Already Exists"; 
             return;   
        }
        
        $eduplicate = $mysql->select("select * from  _tbl_customers where EmailID='".trim($_POST['EmaiIID'])."'");
        if (sizeof($eduplicate)>0) {
             echo  "Email ID Already Exists";    
             return ;
        }
           
        
                          
                          $customerCode = SeqMaster::GetNextCustomerCode();                                                      
        $Customer = $mysql->insert("_tbl_customers",array("CustomerCode"       => $customerCode,
                                                          "CustomerName"       => trim($_POST['CustomerName']),
                                                          "MobileNumber"       => trim($_POST['MobileNumber']),
                                                          "EmailID"            => trim($_POST['EmaiIID']),
                                                          "AddressLine1"       => trim($_POST['AddressLine1']),
                                                          "AddressLine2"       => trim($_POST['AddressLine2']),
                                                          "AddressLine3"       => trim($_POST['AddressLine3']),
                                                          "PinCode"            => trim($_POST['PinCode']),
                                                          "CreatedBy"          => "Branch",
                                                          "CreatedByID"          => $_SESSION['User']['BranchID'],
                                                          "CreatedByName"          => $_SESSION['User']['BranchName'],
                                                          "CreatedOn"          => date("Y-m-d H:i:s")));
                          echo   "Customer created successfully";                                          
                      ?>
                      <script>
                      SelCustomer('<?php echo $customerCode?>');
                       $('#addCusomer').modal("hide");
                      </script>
                      <?php
          
             
         
    }    
?>