<?php include_once("header.php"); ?>
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">New Order</h4>
                            </div>
                        </div>
                        <?php
                            if (isset($_POST['customercode'])) {
                                
                                $customers = $mysql->select("SELECT * FROM _tbl_customers WHERE CustomerCode='".$_POST['customercode']."'");
                                
                                $OrderValue=0;
                                foreach($_SESSION['order']['items'] as $items) {
                                    $OrderValue+=$items['TSAmount'];
                                }
                                
                                $orderNumber = SeqMaster::GetNextOrderNumber();
  
                                $orderid=$mysql->insert("_tbl_orders",array("OrderDate"     => date("Y-m-d H:i:s"),
                                                                            "OrderNumber"   => $orderNumber,
                                                                            "CustomerID"    => $customers[0]['CustomerID'],
                                                                            "CustomerName"  => $customers[0]['CustomerName'],
                                                                            "EmailID"       => $customers[0]['EmailID'],
                                                                            "MobileNumber"  => $customers[0]['MobileNumber'],
                                                                            "AddressLine1"  => $customers[0]['AddressLine1'],
                                                                            "AddressLine2"  => $customers[0]['AddressLine2'],
                                                                            "AddressLine3"  => $customers[0]['AddressLine3'],
                                                                            "Pincode"       => $customers[0]['PinCode'],
                                                                            "OrderValue"    => $OrderValue,
                                                                            "Createdon"     => date("Y-m-d H:i:s"),
                                                                            "CreatedBy"     => $_SESSION['User']['BranchID'],
                                                                            "OrderedOn"     => "0000-00-00 00:00:00",
                                                                            "OrderedBy"     => "0",
                                                                            "BranchName"     => $_SESSION['User']['BranchName'],
                                                                            "InvoiceNumber" => "",
                                                                            "InvoiceID"     => "0"));

                                foreach($_SESSION['order']['items'] as $items) {
                                    
                                    $mysql->insert("_tbl_orders_items",array("OrderID"       => $orderid,
                                                                             "AddedOn"       => date("Y-m-d H:i:s"),
                                                                             "ProductID"     => $items['ProductID'],
                                                                             "ProductCode"   => $items['ProductCode'],
                                                                             "ProductName"   => $items['ProductName'],
                                                                             "SupplierID"    => $items['SupplierID'],
                                                                             "SupplierCode"  => $items['SupplierCode'],
                                                                             "SupplierName"  => $items['SupplierName'],
                                                                             "Qty"           => $items['Qty'],
                                                                             "Amount"        => $items['Amount'],
                                                                             "TAmount"       => $items['TAmount'],
                                                                             "ServiceCharge" => $items['ServiceCharge'],
                                                                             "TsAmount"      => $items['TSAmount'],
                                                                             "Remarks"       => $items['Remarks'],
                                                                             "TimeOfJourney" => $items['TimeOfJourney'],
                                                                             "DateOfJourney" => $items['DateOfJourney'],
                                                                             "OffRemarks"    => $items['OffRemarks']));
                                }
                                $_SESSION['order']=array();
                                    echo "<div style='padding:50px;text-align:center;'>
                                    
                                        Order saved successfully.<br>
                                        Your Order ID:<span style='color:green;font-weight:bold;'>" .$orderNumber."</span>  
                                        </div>";
                                ?>
                                <style>
                                #frm_OrderSubmit {display:none}
                                </style>
                                <?php
                            }
                        ?>
                        <form method="Post" id="frm_OrderSubmit" name="frm_OrderSubmit">
                            <input type="hidden" name="customercode" vaue="" id="customercode">
                            <div class="card-body">
                                <div class="form-group form-inline">
                                    <div class="col-sm-2" style="width:auto;padding-left:0px !important;flex: 0 0 0%;">Customer</div>
                                    <div class="col-sm-1"><a data-toggle="modal" data-target="#SearchCustomer" style="color:white" class="btn btn-primary btn-round ml-auto"><i class="fa fa-search search-icon"></i></a></div>
                                    <div class="col-sm-1"><a data-toggle="modal" data-target="#addCusomer" style="color:white" class="btn btn-primary btn-round ml-auto"><i class="fa fa-plus"></i></a></div>
                                </div>
                                <div class="form-group form-inline">
                                    <div class="col-sm-8" id="CustomerInformation" style="width:100%;padding-left:0px !important;"></div>
                                </div>
                                <div class="table-responsive" id="cart_body"></div>
                                <a class="btn btn-primary btn-round ml-auto" onclick="addProduct()" style="color:white">
                                    <i class="fa fa-plus"></i>
                                </a>
                                <div class="form-group form-inline">
                                    <div class="col-sm-8"></div> 
                                    <div class="col-sm-2" style="width:auto;padding-left:0px !important;flex: 0 0 0%;">Payable Amount</div>
                                    <div class="col-sm-2">
                                        <input type="text" disabled="disabled" class="form-control" id="PayableAmount" name="PayableAmount" placeholder="0.00" style="width:100%;text-align:right">
                                    </div>
                                    <div class="card-action">
                                        <button class="btn btn-success" type="button" onclick="submitOrder()" name="SaveOrder">Save Order</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="SearchCustomer" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header no-bd">
                            <h5 class="modal-title">Search Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="" id="frm_customersearch" name="frm_customersearch">
                                <div class="form-group">
                                    <div class="col-sm-6">Customer Details</div>
                                    <div class="col-sm-9">
                                        <input type="text" maxlength="10" class="form-control" id=CustomerDetails" name="CustomerDetails" placeholder="Mobile Number / EmaiID /Customer Name" style="width:100%">
                                        <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span>
                                    </div>
                                </div>
                                <div id="cus_searchresult">
                                                                           
                                </div>
                                <br>
                                <div class="card-action">
                                    <a class="btn btn-success" name="Search" onclick="getCustomers()" style="color: white;">Search</a>
                                    <button class="btn btn-danger">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="addCusomer" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header no-bd">
                            <h5 class="modal-title"><b>Add Customer</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <div id="msgDiv"></div>
                            <form method="post" id="addCustomerFrom" name="addCustomerFrom" action="NewBookingForm.php" >
                                <div class="form-group form-inline">
                                    <div class="col-sm-5">Customer Name</div>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="CustomerName" name="CustomerName" placeholder="Customer Name" style="width:100%">
                                        <span class="errorstring" id="ErrCustomerName"><?php echo isset($ErrCustomerName)? $ErrCustomerName : "";?></span>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <div class="col-sm-5">Mobile Number</div>
                                    <div class="col-sm-7">
                                        <input type="text" maxlength="10" class="form-control" id="MobileNumber" name="MobileNumber" placeholder="Mobile Number" style="width:100%">
                                        <span class="errorstring" id="ErrMobileNumber"><?php echo isset($ErrMobileNumber)? $ErrMobileNumber : "";?></span>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <div class="col-sm-5">Email Address</div>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="EmaiIID" name="EmaiIID" placeholder="Email Address" style="width:100%">
                                        <span class="errorstring" id="ErrEmaiIID"><?php echo isset($ErrEmaiIID)? $ErrEmaiIID : "";?></span>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <div class="col-sm-5">Address Line 1</div>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="AddressLine1" name="AddressLine1" placeholder="Address Line 1" style="width:100%">
                                        <span class="errorstring" id="ErrAddress"><?php echo isset($ErrAddress)? $ErrAddress : "";?></span>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <div class="col-sm-5">Address Line 2</div>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="AddressLine2" name="AddressLine2" placeholder="Address Line 2" style="width:100%">
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <div class="col-sm-5">Address Line 3</div>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="AddressLine3" name="AddressLine3" placeholder="Address Line 3" style="width:100%">
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <div class="col-sm-5">Pincode</div>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" maxlength="6" id="Pincode" name="Pincode" placeholder="Pincode" style="width:100%">
                                        <span class="errorstring" id="ErrPincode"><?php echo isset($ErrPincode)? $ErrPincode : "";?></span>
                                    </div>
                                </div>
                                <br>
                                <div class="card-action">
                                    <a class="btn btn-success" onclick="submitCustomerDetails()" name="CreateCustomer" style="color:white">Create</a>
                                    <a href="" class="btn btn-danger" style="color: white;">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="Product" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" id="product_body">
                    <script>
                       
                    </script>                             
                    </div>
                </div>
            </div>
            <script>
                function addProduct() {
                   $('#Product').modal('show');
                    
                   
                   $.ajax({url:'webservice.php?action=addProductToCart',
                            success:function(result) {
                                $('#product_body').html(result);
                            }});
                }
                
                function getCartItems() {
                   
                   $.ajax({url:'webservice.php?action=getCartItems',
                            success:function(result) {
                                $('#cart_body').html(result);
                            }});
                }
                
               
               
                function addToCart(formID) {
                   $('#Product').modal('show'); 
                   var param = $( "#"+formID).serialize();
                   $.post("webservice.php?action=addToCart",param,function(result2) {$('#product_body').html(result2);getCartItems();
                    $('#Product').modal("hide");
                   });
                }
                setTimeout("getCartItems()",1000); 
                
                 function removeFromCart(PCode) {
                     $.ajax({url:'webservice.php?action=removeFromCart&PCode='+PCode,
                             success:function(result) {
                                 getCartItems();
                             }});
                 }
                 
                 function getCustomers() {
                     var param = $( "#frm_customersearch").serialize();
        $.post("webservice.php?action=getCustomers",param,function(result2) {$('#cus_searchresult').html(result2);});
                }
                
                function SelCustomer(_CustomerCode) {
                    $('#SearchCustomer').modal("hide");
                     $('#customercode').val(_CustomerCode);
                     $.ajax({url:'webservice.php?action=GetCustomerInfo&CCode='+_CustomerCode,
                             success:function(result) {
                                 $('#CustomerInformation').html(result);
                             }});
                }
                
                function submitOrder() {
                    
                    if ($('#customercode').val().length>0) {
                        
                        if (parseInt($('#PayableAmount').val())>0) {
                                $('#frm_OrderSubmit').submit();
                        } else {
                            alert("Order doesn't have items, please select items");
                           addProduct(); 
                        }
                        
                    } else {
                        alert("Please select customer");
                        $('#SearchCustomer').modal('show'); 
                    }
                    //frm_OrderSubmit
                }
            
                                function submitCustomerDetails() {

                                    $('#ErrCustomerName').html("");
                                    $('#ErrMobileNumber').html("");
                                    $('#ErrEmaiIID').html("");
                                    $('#ErrAddressLine1').html("");
                                    $('#ErrPincode').html("");

                                    ErrorCount = 0;

                                    IsNonEmpty("CustomerName", "ErrCustomerName", "Please Enter Valid Customer Name");

                                      if(IsNonEmpty("MobileNumber","ErrMobileNumber","Please Enter MobileNumber")) {
                                     IsMobileNumber("MobileNumber","ErrMobileNumber","Please Enter Valid MobileNumber");
                                     }

                                    if (IsNonEmpty("EmaiIID", "ErrEmaiIID", "Please Enter Contact Email Address")) {
                                        IsEmail("EmaiIID", "ErrEmaiIID", "Please Enter valid Contact Email Address")
                                    }
                                    IsNonEmpty("AddressLine1", "ErrAddress", "Please Enter Valid Address");

                                    IsNonEmpty("Pincode", "ErrPincode", "Please Enter Pincode");

                                    if (ErrorCount == 0) {
                                                var param = $( "#addCustomerFrom").serialize();
        $.post("webservice.php?action=addCustomer",param,function(result2) {$('#cus_searchresult').html(result2);});
          
                                    } else {
                                        return false;
                                    }
                                }
                            </script>
<?php include_once("footer.php");?>