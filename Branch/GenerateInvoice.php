<?php include_once("header.php");?>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Invoice Generated</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <?php
                                if (isset($_POST['GenerateInvoiceBtn'])) {
                                    
                                    $orderInfo = $mysql->select("select * from `_tbl_orders` where CreatedBy='".$_SESSION['User']['BranchID']."' and `OrderNumber`='".$_POST['OrderNumber']."'");
                                    
                                    if (sizeof($orderInfo)>0) {
                                        if ($orderInfo[0]['InvoiceID']==0) {
                                            
                                            $invoiceNumber = SeqMaster::GetNextInvoiceNumber();
                                            
                                            $invoiceID=$mysql->insert("_tbl_invoices",array("OrderID"       => $orderInfo[0]['OrderID'],
                                                                                            "OrderNumber"   => $orderInfo[0]['OrderNumber'],
                                                                                            "OrderDate"     => $orderInfo[0]['OrderDate'],
                                                                                            "InvoiceNumber" => $invoiceNumber,
                                                                                            "InvoiceDate"   => date("Y-m-d H:i:s"),
                                                                                            "CustomerID"    => $orderInfo[0]['CustomerID'],
                                                                                            "CustomerName"  => $orderInfo[0]['CustomerName'],
                                                                                            "EmailID"       => $orderInfo[0]['EmailID'],
                                                                                            "MobileNumber"  => $orderInfo[0]['MobileNumber'],
                                                                                            "AddressLine1"  => $orderInfo[0]['AddressLine1'],
                                                                                            "AddressLine2"  => $orderInfo[0]['AddressLine2'],
                                                                                            "AddressLine3"  => $orderInfo[0]['AddressLine3'],
                                                                                            "Pincode"       => $orderInfo[0]['Pincode'],
                                                                                            "InvoiceValue"  => $orderInfo[0]['OrderValue'],
                                                                                            "Createdon"     => date("Y-m-d H:i:s"),
                                                                                            "CreatedBy"     => $_SESSION['User']['BranchID'],
                                                                                            "BranchName"    => $_SESSION['User']['BranchName'],
                                                                                            "BalanceAmount" => $orderInfo[0]['OrderValue'],
                                                                                            "PaidAmount"    => "0"));
                                            $mysql->execute("update _tbl_orders set InvoiceId='".$invoiceID."',InvoiceNumber='".$invoiceNumber."' where OrderID='".$orderInfo[0]['OrderID']."'");
                                            $orderItems = $mysql->select("select * from `_tbl_orders_items` where `OrderID`='".$orderInfo[0]['OrderID']."'");                              
                                            
                                            foreach($orderItems as $items) {
                                                $mysql->insert("_tbl_invoices_items",array("InvoiceID"       => $invoiceID,
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
                                        ?>
                                        Invoice Successfully Generated.<br>Invoice Number : <?php echo $invoiceNumber;?><br><Br>
                                        <a href="ViewInvoices.php">Continue</a>
                                <?php   } else { ?>
                                    Invoice Already Generated. 
                                <?php
                                }
                                    } else {
                                                 ?>
                                                    Access Denied. Please Contact Administrator.
                                                 <?php
                                             }
                                             }
                                           ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php  include_once("footer.php");?>